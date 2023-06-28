<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;

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

    
    // START WishlistController
    Route::controller(WishlistController::class)->group(function(){
        
        Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-property', 'GetWishlistProperty');

    }); // END WishlistController

});// END USER






Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
}); // END ADMIN MIDDLEWARE






Route::middleware(['auth', 'role:agent'])->group(function() {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');
    Route::get('/agent/profile', [AgentController::class, 'AgentProfile'])->name('agent.profile');
    Route::post('/agent/profile/store', [AgentController::class, 'AgentProfileStore'])->name('agent.profile.store');
    Route::get('/agent/change/password', [AgentController::class, 'AgentChangePassword'])->name('agent.change.password');
    Route::post('/agent/update/password', [AgentController::class, 'AgentUpdatePassword'])->name('agent.update.password');
}); // END AGENT MIDDLEWARE






Route::middleware(['auth', 'role:admin'])->group(function() {

    // START PropertyTypeController
    Route::controller(PropertyTypeController::class)->group(function(){
        
        Route::get('/all/type', 'AllPropertyType')->name('all.type');
        Route::get('/add/type', 'AddPropertyType')->name('add.type');
        Route::post('/store/type', 'StorePropertyType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditPropertyType')->name('edit.type');
        Route::post('/update/type', 'UpdatePropertyType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeletePropertyType')->name('delete.type');

    }); // END PropertyTypeController



    // START Amenities
    Route::controller(PropertyTypeController::class)->group(function(){
        
        Route::get('/all/amenities', 'AllAmenities')->name('all.amenities');
        Route::get('/add/amenities', 'AddAmenities')->name('add.amenities');
        Route::post('/store/amenities', 'StoreAmenities')->name('store.amenities');
        Route::get('/edit/amenities/{id}', 'EditAmenities')->name('edit.amenities');
        Route::post('/update/amenities', 'UpdateAmenities')->name('update.amenities');
        Route::get('/delete/amenities/{id}', 'DeleteAmenities')->name('delete.amenities');

    }); // END Amenities



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
        Route::get('/admin/package/history', 'AdminPackageHistory')->name('admin.package.history');
        Route::get('/package/invoice/{id}', 'PackageInvoice')->name('package.invoice');

    }); // END PropertyController



    // START Agent Management
    Route::controller(AdminController::class)->group(function(){
        
        Route::get('/all/agent', 'AllAgent')->name('all.agent');
        Route::get('/add/agent', 'AddAgent')->name('add.agent');
        Route::post('/store/agent', 'StoreAgent')->name('store.agent');
        Route::get('/edit/agent/{id}', 'EditAgent')->name('edit.agent');
        Route::post('/update/agent', 'UpdateAgent')->name('update.agent');
        Route::get('/delete/agent/{id}', 'DeleteAgent')->name('delete.agent');
        Route::get('/changeStatus', 'changeStatus');

    }); // END Agent Management



}); // END ADMIN MIDDLEWARE





Route::middleware(['auth', 'role:agent'])->group(function() {
    
    // START Agent Property
    Route::controller(AgentPropertyController::class)->group(function(){
        
        Route::get('/agent/all/property', 'AllAgentProperty')->name('agent.all.property');
        Route::get('/agent/add/property', 'AddAgentProperty')->name('agent.add.property');
        Route::post('/agent/store/property', 'StoreAgentProperty')->name('agent.store.property');
        Route::get('/agent/edit/property/{id}', 'EditAgentProperty')->name('agent.edit.property');
        Route::post('/agent/update/property', 'UpdateAgentProperty')->name('agent.update.property');
        Route::post('/agent/update/property/thumbnail', 'AgentUpdatePropertyThumbnail')->name('agent.update.property.thumbnail');
        Route::post('/agent/update/property/multi-image', 'AgentUpdatePropertyMultiImage')->name('agent.update.property.multiImage');
        Route::get('/agent/delete/property/multi-image/{id}', 'AgentDeletePropertyMultiImage')->name('agent.delete.property.multiImage');
        Route::post('/agent/store/new/multi-image', 'AgentStoreNewMultiImage')->name('agent.store.new.multiImage');
        Route::post('/agent/update/property/facilities', 'AgentUpdatePropertyFacilities')->name('agent.update.property.facilities');
        Route::get('/agent/details/property/{id}', 'AgentDetailsProperty')->name('agent.details.property');
        Route::get('/agent/delete/property/{id}', 'AgentDeleteProperty')->name('agent.delete.property');

    }); // END Agent Property



    // START Agent Package
    Route::controller(AgentPropertyController::class)->group(function(){
        
        Route::get('/buy/package', 'BuyPackage')->name('buy.package');
        Route::get('/buy/business/plan', 'BuyBusinessPlan')->name('buy.business.plan');
        Route::post('/store/business/plan', 'StoreBusinessPlan')->name('store.business.plan');
        Route::get('/buy/professional/plan', 'BuyProfessionalPlan')->name('buy.professional.plan');
        Route::post('/store/professional/plan', 'StoreProfessionalPlan')->name('store.professional.plan');
        Route::get('/package/history', 'PackageHistory')->name('package.history');
        Route::get('/agent/package/invocie/{id}', 'AgentPackageInvoice')->name('agent.package.invoice');

    }); // END Agent Package

}); // END AGENT MIDDLEWARE


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');






// ------------ FRONTEND PROPERTY DETAILS ROUTE ------------ //






Route::get('/property/details/{id}/{slug}', [IndexController::class, 'PropertyDetails']);

// ADD TO WISHLIST
Route::post('/add-to-wishlist/{property_id}', [WishlistController::class, 'AddToWishlist']);



require __DIR__.'/auth.php';
