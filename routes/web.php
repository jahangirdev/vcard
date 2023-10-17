<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioCategoryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\QrCodeController;

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
Route::get('/vcard/{slug}', [\App\Http\Controllers\VcardController::class, 'view'])->name('vcard.view');
Route::get('/qrcode', [QrCodeController::class, 'index']);

/**
 * -------------------------------------------------------------------------
 *  Dashboard route groups.
 * -------------------------------------------------------------------------
 *  This route group is used for all routes which only work for a logged in user
 *  Auth middleware is added to this route.
 */

Route::middleware(['auth'])->group(function (){
    Route::view('/dashboard', 'dashboard.welcome')->name('dashboard.welcome');
    Route::resource('/portfolio', PortfolioController::class);
    Route::resource('/service', \App\Http\Controllers\ServiceController::class);
    Route::resource('/testimonial', \App\Http\Controllers\TestimonialController::class);
    Route::get('/template/preview/{id}', [\App\Http\Controllers\TemplateController::class, 'preview'])->name('template.preview');

    Route::get('/vcard/create/{id}', [\App\Http\Controllers\VcardController::class, 'create'])->name('vcard.create');
    Route::get('/vcard/{id}/edit', [\App\Http\Controllers\VcardController::class, 'edit'])->name('vcard.edit');
    Route::get('/vcard/index/{id}', [\App\Http\Controllers\VcardController::class, 'index'])->name('vcard.index');
    Route::get('vcard/slug-availability/{id}', [\App\Http\Controllers\VcardController::class, 'checkSlugAvailability']);
    Route::get('/vcard/preview/', [\App\Http\Controllers\VcardController::class, 'preview'])->name('vcard.preview');
    Route::put('/vcard/{id}/update/', [\App\Http\Controllers\VcardController::class, 'update'])->name('vcard.update');
    Route::post('/vcard/{id}/settings/', [\App\Http\Controllers\VcardController::class, 'settings'])->name('vcard.settings');

    Route::get('/profile/', [\App\Http\Controllers\VcardController::class, 'preview'])->name('profile.index');
    Route::get('/profile/edit/{id}', [\App\Http\Controllers\VcardController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/image/{id}/update', [\App\Http\Controllers\VcardController::class, 'updateProfileImage'])->name('profile.image.update');
    Route::post('/profile/cover/{id}/update', [\App\Http\Controllers\VcardController::class, 'updateProfileCover'])->name('profile.cover.update');

    Route::post('/social-link/{id}/update', [\App\Http\Controllers\SocialLinkController::class, 'update'])->name('social.update');

    Route::post('/business-hours/{id}/update', [\App\Http\Controllers\BusinessHoursController::class, 'update'])->name('business.hours.update');
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
