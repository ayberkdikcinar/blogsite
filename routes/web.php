<?php

use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Homepage;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\AuthController;
use App\Models\Article;

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

//Back-end roots
Route::prefix('admin')->name('admin.')->middleware(['checkAdmin'])->group(function(){
    Route::get('panel',[Dashboard::class,'index'])->name('dashboard');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    /// ARTICLE ROOTS
    Route::get('articles/trash',[ArticleController::class,'trash'])->name('article.trash');
    Route::resource('articles', 'Back\ArticleController');
    Route::get('deletearticle/{id}',[ArticleController::class,'delete'])->name('article.delete');
    Route::get('article/takeback/{id}',[ArticleController::class,'takeback'])->name('article.takeback');
    Route::get('deletetrash/{id}',[ArticleController::class,'deleteFromTrash'])->name('article.delete.trash');
    /// CATEGORY ROOTS
    Route::get('categories',[CategoryController::class,'index'])->name('categories.index');
    Route::get('categories/edit',[CategoryController::class,'edit'])->name('categories.edit');
    Route::post('categories/create',[CategoryController::class,'create'])->name('categories.create');
    Route::post('categories/update',[CategoryController::class,'update'])->name('categories.update');
});
Route::get('admin/login',[AuthController::class,'index'])->name('admin.login');
Route::post('admin/login',[AuthController::class,'loginPost'])->name('admin.login.auth');



//////////////////--------------------//////////////////

//Front-end roots

Route::get('/',[Homepage::class,'index'])->name('homepage');
Route::get('/kategori/{category}',[Homepage::class,'category'])->name('category');
Route::get('/{category}/{slug}',[Homepage::class,'single'])->name('single');
Route::get('/about',[Homepage::class,'about'])->name('aboutpage');
Route::get('/contact',[Homepage::class,'contact'])->name('contact');
Route::post('/contact',[Homepage::class,'contactpost'])->name('contact.post');





