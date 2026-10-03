<?php

use App\Http\Controllers\AmenityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SiteContentController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/about', [WebsiteController::class, 'about'])->name('website.about');
Route::get('/properties', [WebsiteController::class, 'properties'])->name('website.properties');
Route::get('/properties/{property}', [WebsiteController::class, 'property'])->name('website.properties.show');
Route::post('/properties/{property}/inquiry', [WebsiteController::class, 'propertyInquiry'])->name('website.properties.inquiry');
Route::post('/properties/{property}/review', [WebsiteController::class, 'propertyReview'])->name('website.properties.review');
Route::get('/agents', [WebsiteController::class, 'agents'])->name('website.agents');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('website.contact');
Route::get('/become-a-leasing-agent', [WebsiteController::class, 'becomeAgent'])->name('website.become-agent');
Route::post('/become-a-leasing-agent', [WebsiteController::class, 'becomeAgentInquiry'])->name('website.become-agent.submit');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'create'])->name('login');
    Route::post('login', [AuthController::class, 'store']);
});

Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', fn () => redirect()->route('dashboard'));
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('properties', PropertyController::class);
    Route::resource('units', UnitController::class);
    Route::resource('leads', LeadController::class);
    Route::resource('tours', TourController::class);
    Route::resource('leases', LeaseController::class);
    Route::resource('amenities', AmenityController::class)->except(['show']);
    Route::resource('admins', AdminController::class)->except(['show']);

    Route::get('site-content', [SiteContentController::class, 'index'])->name('site-content.index');
    Route::get('site-content/{group}', [SiteContentController::class, 'edit'])->name('site-content.edit');
    Route::put('site-content/{group}', [SiteContentController::class, 'update'])->name('site-content.update');
});
