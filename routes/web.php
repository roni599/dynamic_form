<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FormTemplateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/category', [CategoryController::class, 'category'])->name('admin.category');
    Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('admin/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');

    Route::get('admin/formtemplate',[FormTemplateController::class,'formtemplate'])->name('admin.formtemplate');
    Route::get('admin/formtemplate/create',[FormTemplateController::class,'create'])->name('admin.formtemplate.create');
    Route::post('admin/formtemplate/store',[FormTemplateController::class,'store'])->name('admin.formtemplate.store');
    Route::get('admin/formtemplate/edit/{id}',[FormTemplateController::class, 'edit'])->name('admin.formtemplate.edit');
    Route::put('admin/formtemplate/update/{id}', [FormTemplateController::class, 'update'])->name('admin.formtemplate.update');
    Route::delete('admin/formtemplate/delete/{id}', [FormTemplateController::class, 'destroy'])->name('admin.formtemplate.delete');
});

Route::get('user/form/create',[SubmissionController::class,'formcreate'])->name('user.formcreate');
Route::get('user/form/category',[SubmissionController::class, 'formcategory'])->name('user.form.category');
Route::post('user/form/store',[SubmissionController::class, 'store'])->name('user.form.store');