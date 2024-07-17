<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $posts = [];
    if (Auth::check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function() {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        return view('admin-page');
    })->name('admin.page');
    Route::get('/admin', [UserController::class, 'showUsers'])->name('admin.page');

    Route::post('/create-post', [PostController::class, 'createPost']);
    Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
    Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
    Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

    Route::get('/admin', [UserController::class, 'showUsers'])->name('admin.page');
    Route::delete('/admin/delete/{id}', [UserController::class, 'deleteUser'])->name('admin.delete');
    Route::get('/admin/edit-user/{id}', [UserController::class, 'editUserForm'])->name('admin.edit');
    Route::post('/admin/update-user/{id}', [UserController::class, 'updateUser'])->name('admin.update');

    Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->name('post.delete');
    Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'])->name('post.edit');
    Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost'])->name('post.update');

    Route::get('/customer', function() {
        if (auth()->user()->role !== 'customer') {
            return redirect('/');
        }
        return view('customer');
    })->name('customer.page');
    Route::get('/customer', [UserController::class, 'showCustomerPage'])->name('customer.page');
});






