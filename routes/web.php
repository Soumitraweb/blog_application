<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PostController::class, 'getAllPost'])->name('post_list');
Route::get('/add-post', [PostController::class, 'addPost'])->name('add_post');
Route::post('/insert-post', [PostController::class, 'insertPost'])->name('insert_post');