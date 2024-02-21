<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post/index', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/post/like/{id}', [PostController::class, 'likebutton'])->name('post.likebutton');

    Route::get('/myposts', [PostController::class, 'myPosts'])->name('myposts');

    Route::get('/survey/create', [SurveyController::class, 'create'])->name('survey.create');
    // store
    Route::post('/survey/store', [SurveyController::class, 'store'])->name('survey.store');
    // vote1
    Route::get('/survey/vote1/{id}', [SurveyController::class, 'vote1'])->name('survey.vote1');
    // vote2
    Route::get('/survey/vote2/{id}', [SurveyController::class, 'vote2'])->name('survey.vote2');


});

require __DIR__.'/auth.php';

