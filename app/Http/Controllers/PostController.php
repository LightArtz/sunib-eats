<?php

namespace App\Http\Controllers;

use App\Models\Post;
// jangan lupa ganti model sesuai dengan nama model yang digunakan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // jangan lupa ganti parameter function
    public function index()
    {
        $posts = Post::paginate(5);
        // $posts = Post::latest()->paginate(5);
        // $posts = Post::all();
        // ambil semua data post dengan pagination 5 data per halaman
        // dan simpan dalam variabel $posts
        return view('posts.index', compact('posts'));
        // kemudian kembalikan view 'posts.index' dengan data $posts
    }

    public function create()
    {
        return view('posts.create');
        // kembalikan view 'posts.create' untuk membuat post baru
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);
        // validasi inputan dari request

        $path = null;
        if ($request->hasFile('image')) {
            // Simpan file ke storage/app/public/post-images
            $path = $request->file('image')->store('post-images', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'image' => $path,
        ]);

        return redirect()->route('home')
            ->with('success', 'Post created successfully.');
        // redirect ke halaman index dengan pesan sukses
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
        // kembalikan view 'posts.show' dengan data post yang ditentukan
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
        // kembalikan view 'posts.edit' dengan data post yang akan diedit
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);
        // validasi inputan dari request

        $data = $request->except('image');

        // Cek apakah ada file gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama jika ada
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }

            // 2. Simpan gambar baru dan dapatkan path-nya
            $path = $request->file('image')->store('post-images', 'public');
            $data['image'] = $path; // Tambahkan path gambar baru ke data
        }

        // Update post dengan data baru
        $post->update($data);

        return redirect()->route('home')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        // hapus post yang ditentukan

        return redirect()->route('home')
            ->with('success', 'Post deleted successfully.');
        // redirect ke halaman index dengan pesan sukses
    }
}
