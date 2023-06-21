<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// USER FRONTEND ROUTES
Route::get('/', [UserController::class, 'Index']);
// END FRONTEND ROUTES





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// END DASHBOARD





Route::middleware('auth')->group(function () {
    
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
});// END USER






Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
}); // END ADMIN MIDDLEWARE






Route::middleware(['auth', 'role:admin'])->group(function() {

    // START PropertyTypeController
    Route::controller(PropertyTypeController::class)->group(function(){
        
        Route::get('/all/type', 'AllPropertyType')->name('all.type');
        Route::get('/add/type', 'AddPropertyType')->name('add.type');
        Route::post('/store/type', 'StorePropertyType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditPropertyType')->name('edit.type');
        Route::post('/update/type', 'UpdatePropertyType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeletePropertyType')->name('delete.type');
    });

    // START Amenities
    Route::controller(PropertyTypeController::class)->group(function(){
        
        Route::get('/all/amenities', 'AllAmenities')->name('all.amenities');
        Route::get('/add/amenities', 'AddAmenities')->name('add.amenities');
        Route::post('/store/amenities', 'StoreAmenities')->name('store.amenities');
        Route::get('/edit/amenities/{id}', 'EditAmenities')->name('edit.amenities');
        Route::post('/update/amenities', 'UpdateAmenities')->name('update.amenities');
        Route::get('/delete/amenities/{id}', 'DeleteAmenities')->name('delete.amenities');
    });

    // START PropertyController
    Route::controller(PropertyController::class)->group(function(){
        
        Route::get('/all/property', 'AllProperty')->name('all.property');
        Route::get('/add/property', 'AddProperty')->name('add.property');
        Route::post('/store/property', 'StoreProperty')->name('store.property');
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');
        Route::post('/update/property/thumbnail', 'UpdatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('/update/property/multi-image', 'UpdatePropertyMultiImage')->name('update.property.multiImage');
        Route::get('/delete/property/multi-image/{id}', 'DeletePropertyMultiImage')->name('delete.property.multiImage');
        Route::post('/store/new/multi-image', 'StoreNewMultiImage')->name('store.new.multiImage');
        Route::post('/update/property/facilities', 'UpdatePropertyFacilities')->name('update.property.facilities');
        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');
        Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');
        Route::post('/inactive/property', 'InactiveProperty')->name('inactive.property');
        Route::post('/active/property', 'ActiveProperty')->name('active.property');
    });
}); // END ADMIN MIDDLEWARE






Route::middleware(['auth', 'role:agent'])->group(function() {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
}); // END AGENT MIDDLEWARE


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

require __DIR__.'/auth.php';
