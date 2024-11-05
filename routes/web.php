<?php

use App\Http\Middleware\ValidAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EbaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;



//Website Routes
Route::get('/',[EbaController::class,'home'])->name('home');
Route::get('/about',[EbaController::class,'about'])->name('about');
Route::get('/contact',[EbaController::class,'contact'])->name('contact');
Route::post('/contact',[EbaController::class,'contactPost'])->name('contact.post');
Route::get('/class',[EbaController::class,'class'])->name('class');
Route::get('/team',[EbaController::class,'team'])->name('team');


//Admin Routes
Route::prefix('admin')->middleware(['ValidAdmin'])->group(function(){
Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
Route::get('/inquiry',[AdminController::class,'inquiry'])->name('inquiry');
Route::get('removeInq/{id}',[AdminController::class,'removeInq'])->name('removeInq');
Route::get('/about',[AdminController::class,'about'])->name('admin.about');
Route::post('/about',[AdminController::class,'aboutPost'])->name('about.post');
Route::get('/cinfo',[AdminController::class,'companyInfo'])->name('companyInfo');
Route::post('/cinfo',[AdminController::class,'companyInfoPost'])->name('companyInfo.post');
Route::get('/testimonial',[AdminController::class,'testimonial'])->name('admin.testimonial');
Route::post('/testimonial-add',[AdminController::class,'testimonialAdd'])->name('testimonial.add');
Route::post('/testimonial-edit/{id}',[AdminController::class,'testimonialEdit'])->name('testimonial.edit');
Route::get('/removeTestimonial/{id}',[AdminController::class,'testimonialRemove'])->name('testimonial.remove');
Route::get('/logout',[AdminController::class,'logout'])->name('logout');
Route::get('/changePass',[AdminController::class,'changePassword'])->name('pass.change');
Route::post('/changePassPost',[AdminController::class,'changePasswordPost'])->name('changePass.post');
});

Route::get('login',[AdminController::class,'login'])->name('admin.login');
Route::post('login',[AdminController::class,'loginPost'])->name('login.post');  


Route::get('/test',[HomeController::class,'index'])->name('index');
Route::post('/test',[HomeController::class,'indexPost'])->name('index.post');