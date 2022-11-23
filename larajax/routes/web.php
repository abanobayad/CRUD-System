<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth'])->namespace('App\Http\Controllers')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::post('/add-post', [PostController::class, 'add'])->name('post.add');
    Route::get('/edit-post/{id}', [PostController::class, 'edit'])->name('edit.post');
    Route::post('/update-post', [PostController::class, 'update'])->name('post.update');
    Route::get('/delete-post/{id}', [PostController::class, 'delete'])->name('delete.post');


});
