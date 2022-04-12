<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CountryController;

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

Route::get('/', [\App\Http\Controllers\SiteController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard']);
Route::get('admin/articles', [\App\Http\Controllers\Admin\ArticleController::class, 'index'])
    ->name('admin.articles');
Route::get('admin/articles/create', [\App\Http\Controllers\Admin\ArticleController::class, 'create'])
    ->name('admin.create_article');
Route::post('admin/articles/store', [\App\Http\Controllers\Admin\ArticleController::class, 'store'])
    ->name('admin.store_article');
Route::get('admin/articles/{id}/edit', [\App\Http\Controllers\Admin\ArticleController::class, 'edit'])
    ->name('admin.edit_article');
Route::put('admin/articles/{id}/update', [\App\Http\Controllers\Admin\ArticleController::class, 'update'])
    ->name('admin.update_article');
Route::delete('admin/articles/{id}/delete', [\App\Http\Controllers\Admin\ArticleController::class, 'delete'])
    ->name('admin.delete_article');

Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::resource('countries', CountryController::class)->except(['show']);
    });

Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    });
