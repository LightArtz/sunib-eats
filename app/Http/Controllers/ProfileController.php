<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('pages.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Ambil data dari ProfileUpdateRequest
        $validatedData = $request->validated();

        if ($request->hasFile('profile_picture')) {
            $user = $request->user();

            // 1. Hapus gambar profil lama jika ada
            if ($user->profile_picture) {
                Storage::disk('cloudinary')->delete($user->profile_picture);
            }

            // 2. Simpan gambar baru dan dapatkan path-nya
            $path = $request->file('profile_picture')->store('profile-pictures', 'cloudinary');

            // 3. Tambahkan path gambar baru ke data yang akan disimpan
            $validatedData['profile_picture'] = $path;
        }

        // Isi model User dengan data yang sudah divalidasi (termasuk path gambar baru jika ada)
        $request->user()->fill($validatedData);

        // Reset verifikasi email jika email diubah
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Simpan
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->profile_picture) {
            Storage::disk('cloudinary')->delete($user->profile_picture);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
