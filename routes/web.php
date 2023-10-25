<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\VisitorAuthController;
use App\Http\Controllers\CommentController;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/about',[HomeController::class,'about'])->name('about');

//Client Login Routes ------->
Route::get('/visitor/signup',[VisitorAuthController::class,'signupView'])->name('visitor.signupView');
Route::post('/visitor/signup',[VisitorAuthController::class,'signup'])->name('visitor.signup');

Route::get('/visitor/signin',[VisitorAuthController::class,'visitorSignIn'])->name('visitor.signin');
Route::post('/visitor/signin',[VisitorAuthController::class,'visitorLogInCheck'])->name('visitor.signin');
Route::get('/visitor/logout',[VisitorAuthController::class,'visitorLogOut'])->name('visitor.logout');
Route::post('/comment',[CommentController::class,'saveComment'])->name('comment');
Route::get('/blog/details/{slug}',[HomeController::class,'blogDetails'])->name('blog.details');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resources(['categories'=>CategoryController::class]);
    Route::resources(['blogs'=>BlogController::class]);


});
