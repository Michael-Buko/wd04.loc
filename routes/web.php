<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CountryController;
use Spatie\Permission\Models\Role;

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

Route::get('/', [\App\Http\Controllers\SiteController::class, 'index'])
    ->name('/');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('role:admin')
    ->get('admin', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard'])
    ->name('admin');
Route::middleware('role:admin')
    ->get('admin/articles', [\App\Http\Controllers\Admin\ArticleController::class, 'index'])
    ->name('admin.articles');
Route::middleware('role:admin')
    ->get('admin/articles/create', [\App\Http\Controllers\Admin\ArticleController::class, 'create'])
    ->name('admin.create_article');
Route::middleware('role:admin')
    ->post('admin/articles/store', [\App\Http\Controllers\Admin\ArticleController::class, 'store'])
    ->name('admin.store_article');
Route::middleware('role:admin')
    ->get('admin/articles/{id}/edit', [\App\Http\Controllers\Admin\ArticleController::class, 'edit'])
    ->name('admin.edit_article');
Route::middleware('role:admin')
    ->put('admin/articles/{id}/update', [\App\Http\Controllers\Admin\ArticleController::class, 'update'])
    ->name('admin.update_article');
Route::middleware('role:admin')
    ->delete('admin/articles/{id}/delete', [\App\Http\Controllers\Admin\ArticleController::class, 'delete'])
    ->name('admin.delete_article');
Route::get('admin/cur_exchange_nbrb', [\App\Http\Controllers\Admin\CurrencyExchangeController::class, 'exchangeNbrb'])
    ->name('admin.cur_exchange_nbrb');

Route::get('test', function (\Illuminate\Http\Request $request) {
    $response = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])
        ->get('https://www.nbrb.by/api/exrates/rates?periodicity=0');
    foreach ($response->json() as $currency) {
        dump($currency);
    }
    dd($response->collect());
});

Route::name('admin.')
    ->middleware('role:admin')
    ->prefix('admin')
    ->group(function () {
        Route::resource('countries', CountryController::class)->except(['show']);
        Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
        Route::resource('product', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
    });

//Route::get('add-role', function () {
//    Role::create(['name' => 'admin']);
//    $role = Role::findByName('admin');
//
//    $user = App\Models\User::find(1);
//    $user->assignRole($role);
//    dd('ok');
//});
