<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua rute di dalam grup ini sekarang memerlukan login
Route::middleware('auth')->group(function () {
    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Postingan (SEKARANG SUDAH DIAMANKAN)
    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::resource('posts', PostController::class)->except(['index']);
    // dengan pakai resource, otomatis bikin semua route untuk CRUD
    // index, create, store, show, edit, update, destroy
    // jadi gak perlu bikin satu-satu
    // ini tuh diambil dari controller yang udah dibuat
});

<<<<<<< Updated upstream
// This route defines the URL for your restaurant page,
// points it to the correct controller action, and gives it the name
// 'restaurants.index' so the route() helper can find it.
Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');

=======
Route::get('/test', function () {
    $bladeCompiler = app('blade.compiler');
    dd($bladeCompiler->getAnonymousComponentNamespaces());
});


// Rute untuk autentikasi (login, register, dll.)
require __DIR__ . '/auth.php';
>>>>>>> Stashed changes
