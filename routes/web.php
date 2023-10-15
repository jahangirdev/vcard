<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioCategoryController;
use App\Http\Controllers\PortfolioController;

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
    return view('front-end.welcome');
})->name('frontend.welcome');

/**
 * -------------------------------------------------------------------------
 *  Dashboard route groups.
 * -------------------------------------------------------------------------
 *  This route group is used for all routes which only work for a logged in user
 *  Auth middleware is added to this route.
 */

Route::middleware(['auth'])->group(function (){
    Route::view('/dashboard', 'dashboard.welcome')->name('dashboard.welcome');
    Route::resource('portfolio', PortfolioController::class);
    Route::resource('service', \App\Http\Controllers\ServiceController::class);
    Route::resource('testimonial', \App\Http\Controllers\TestimonialController::class);
    Route::get('template/preview/{id}', [\App\Http\Controllers\TemplateController::class, 'preview'])->name('template.preview');
});


Route::middleware(['auth', 'admin'])->group(function(){
    //route for welcome screen of dashboard
    Route::resource("/portfolio_category", PortfolioCategoryController::class);
    Route::resource('company', \App\Http\Controllers\CompanyController::class);
    Route::get('template/index', [\App\Http\Controllers\TemplateController::class, 'index'])->name('template.index');
    Route::get('template/disable/{id}', [\App\Http\Controllers\TemplateController::class, 'disable'])->name('template.disable');
    Route::get('template/enable/{id}', [\App\Http\Controllers\TemplateController::class, 'enable'])->name('template.enable');
    Route::get('template/default/{id}', [\App\Http\Controllers\TemplateController::class, 'default'])->name('template.default');
});

Route::middleware(['auth', 'company'])->group(function(){
    Route::resource("staff", \App\Http\Controllers\StaffController::class);


});



Route::view('/dashboard/unauthorize-access', 'dashboard.unauthorize')->name('unauthorize');
