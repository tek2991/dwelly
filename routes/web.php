<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RentOutController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\AuditChecklistController;
use App\Http\Controllers\Property\PropertyController;
use App\Http\Controllers\NearbyEstablishmentController;
use App\Http\Controllers\Property\OnboardingController;
use App\Http\Controllers\Attributes\FurnitureController;

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

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [PublicPageController::class, 'index'])->name('home');
    Route::get('/all-properties', [PublicPageController::class, 'allProperties'])->name('allProperties');
    Route::get('/viewProperty/{property}', [PublicPageController::class, 'viewProperty'])->name('viewProperty');
    Route::get('/property-brocure/{property}', [PublicPageController::class, 'propertyBrocure'])->name('propertyBrocure');
    Route::get('/contact', [PublicPageController::class, 'contact'])->name('contact');
    Route::get('/about', [PublicPageController::class, 'about'])->name('about');
    Route::get('/owners', [PublicPageController::class, 'owners'])->name('owners');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('app.dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin|user'])->group(function () {
        Route::middleware(['role:admin'])->group(function () {
            // User Routes
            Route::resource('user', UserController::class)->only([
                'index', 'show', 'create', 'store', 'edit', 'update'
            ]);
            Route::delete('user/{user}/detatch-role/{role}', [UserController::class, 'detatchRole'])->name('user.detatchRole');
            Route::put('user/{user}/attach-role', [UserController::class, 'attachRole'])->name('user.attachRole');
            // Role Routes
            Route::resource('role', RoleController::class)->only([
                'index', 'show', 'create', 'store', 'edit', 'update'
            ]);
            Route::delete('role/{role}/detatch-permission/{permission}', [RoleController::class, 'detatchPermission'])->name('role.detatchPermission');
            Route::put('role/{role}/attach-permission', [RoleController::class, 'attachPermission'])->name('role.attachPermission');

            Route::resource('furniture', FurnitureController::class)->only([
                'index', 'show', 'create', 'store', 'edit', 'update'
            ]);
        });

        // Property Routes
        Route::resource('property', PropertyController::class)->only(['index', 'show']);

        // Onboarding Routes
        Route::resource('onboarding', OnboardingController::class)->only([
            'index', 'show'
        ]);

        // Onboarding Property Routes
        Route::get('onboarding/property/create', [OnboardingController::class, 'propertyCreate'])->name('onboarding.property.create');
        Route::get('onboarding/property/{property}/update', [OnboardingController::class, 'propertyUpdate'])->name('onboarding.property.update');
        // Onboarding Property Routes
        Route::get('onboarding/owner/{property}/create', [OnboardingController::class, 'ownerCreate'])->name('onboarding.owner.create');
        Route::get('onboarding/owner/{property}/update', [OnboardingController::class, 'ownerUpdate'])->name('onboarding.owner.update');
        // Onboarding Amenities Routes
        Route::get('onboarding/amenities/{property}/update', [OnboardingController::class, 'amenitiesUpdate'])->name('onboarding.amenities.update');
        // Onboarding Rooms Routes
        Route::get('onboarding/rooms/{property}/update', [OnboardingController::class, 'roomsUpdate'])->name('onboarding.rooms.update');
        // Onboarding Furnitures Routes
        Route::get('onboarding/furnitures/{property}/update', [OnboardingController::class, 'furnituresUpdate'])->name('onboarding.furnitures.update');

        // Contact Routes
        Route::resource('contactForm', ContactController::class)->only([
            'index', 'show'
        ]);

        // Rent Out Routes
        Route::resource('rentOut', RentOutController::class)->only([
            'index', 'show'
        ]);

        // Owner Routes
        Route::resource('owner', OwnerController::class)->only([
            'index', 'show', 'store'
        ]);
        Route::get('owner/create/{property}', [OwnerController::class, 'create'])->name('owner.create');

        // Download document route
        Route::get('document/download/{document}', [DocumentController::class, 'downloadDocument'])->name('document.download');

        //  Tenant Routes
        Route::resource('tenant', TenantController::class)->only([
            'index', 'show', 'store'
        ]);
        Route::get('tenant/create/{property}', [TenantController::class, 'create'])->name('tenant.create');

        // Audit Routes
        Route::resource('audit', AuditController::class)->only([
            'index', 'show', 'create'
        ]);

        // Audit Checklists Routes
        Route::resource('auditChecklist', AuditChecklistController::class)->only([
            'show', 'create'
        ]);

        // Task Routes
        Route::resource('task', TaskController::class)->only([
            'index', 'show'
        ]);
    });
});
