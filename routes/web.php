<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\RoleController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CompareController;



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

    Route::get('/user/schedule/request', [UserController::class, 'UserScheduleRequest'])->name('user.schedule.request');


    // START WishlistController
    Route::controller(WishlistController::class)->group(function () {

        Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-property', 'GetWishlistProperty');
        Route::get('/wishlist-remove/{id}', 'WishlistRemove');

    }); // END WishlistController


    // START CompareController
    Route::controller(CompareController::class)->group(function () {

        Route::get('/user/compare', 'UserCompare')->name('user.compare');
        Route::get('/get-compare-property', 'GetCompareProperty');
        Route::get('/compare-remove/{id}', 'CompareRemove');

    }); // END CompareController

}); // END USER






Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');



}); // END ADMIN MIDDLEWARE






Route::middleware(['auth', 'roles:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');
    Route::get('/agent/profile', [AgentController::class, 'AgentProfile'])->name('agent.profile');
    Route::post('/agent/profile/store', [AgentController::class, 'AgentProfileStore'])->name('agent.profile.store');
    Route::get('/agent/change/password', [AgentController::class, 'AgentChangePassword'])->name('agent.change.password');
    Route::post('/agent/update/password', [AgentController::class, 'AgentUpdatePassword'])->name('agent.update.password');
}); // END AGENT MIDDLEWARE






Route::middleware(['auth', 'roles:admin'])->group(function () {

    // START PropertyTypeController
    Route::controller(PropertyTypeController::class)->group(function () {

        Route::get('/all/type', 'AllPropertyType')->name('all.type')->middleware('permission:all.type');
        Route::get('/add/type', 'AddPropertyType')->name('add.type')->middleware('permission:add.type');
        Route::post('/store/type', 'StorePropertyType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditPropertyType')->name('edit.type')->middleware('permission:edit.type');
        Route::post('/update/type', 'UpdatePropertyType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeletePropertyType')->name('delete.type')->middleware('permission:delete.type');

    }); // END PropertyTypeController



    // START Amenities
    Route::controller(PropertyTypeController::class)->group(function () {

        Route::get('/all/amenities', 'AllAmenities')->name('all.amenities')->middleware('permission:amenities.all');
        Route::get('/add/amenities', 'AddAmenities')->name('add.amenities')->middleware('permission:amenities.add');
        Route::post('/store/amenities', 'StoreAmenities')->name('store.amenities');
        Route::get('/edit/amenities/{id}', 'EditAmenities')->name('edit.amenities')->middleware('permission:amenities.edit');
        Route::post('/update/amenities', 'UpdateAmenities')->name('update.amenities');
        Route::get('/delete/amenities/{id}', 'DeleteAmenities')->name('delete.amenities')->middleware('permission:amenities.delete');

    }); // END Amenities



    // START PropertyController
    Route::controller(PropertyController::class)->group(function () {

        Route::get('/all/property', 'AllProperty')->name('all.property')->middleware('permission:property.all');
        Route::get('/add/property', 'AddProperty')->name('add.property')->middleware('permission:property.add');
        Route::post('/store/property', 'StoreProperty')->name('store.property');
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property')->middleware('permission:property.edit');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');
        Route::post('/update/property/thumbnail', 'UpdatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('/update/property/multi-image', 'UpdatePropertyMultiImage')->name('update.property.multiImage');
        Route::get('/delete/property/multi-image/{id}', 'DeletePropertyMultiImage')->name('delete.property.multiImage');
        Route::post('/store/new/multi-image', 'StoreNewMultiImage')->name('store.new.multiImage');
        Route::post('/update/property/facilities', 'UpdatePropertyFacilities')->name('update.property.facilities');
        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property')->middleware('permission:property.delete');
        Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');
        Route::post('/inactive/property', 'InactiveProperty')->name('inactive.property');
        Route::post('/active/property', 'ActiveProperty')->name('active.property');
        Route::get('/admin/package/history', 'AdminPackageHistory')->name('admin.package.history');
        Route::get('/package/invoice/{id}', 'PackageInvoice')->name('package.invoice');
        Route::get('/admin/property/message/', 'AdminPropertyMessage')->name('admin.property.message');

    }); // END PropertyController



    // START Agent Management
    Route::controller(AdminController::class)->group(function () {

        Route::get('/all/agent', 'AllAgent')->name('all.agent')->middleware('permission:agent.all');
        Route::get('/add/agent', 'AddAgent')->name('add.agent')->middleware('permission:agent.add');
        Route::post('/store/agent', 'StoreAgent')->name('store.agent');
        Route::get('/edit/agent/{id}', 'EditAgent')->name('edit.agent')->middleware('permission:agent.edit');
        Route::post('/update/agent', 'UpdateAgent')->name('update.agent');
        Route::get('/delete/agent/{id}', 'DeleteAgent')->name('delete.agent')->middleware('permission:agent.delete');
        Route::get('/changeStatus', 'changeStatus');

    }); // END Agent Management

    // ALL STATE ROUTES
    Route::controller(StateController::class)->group(function () {
        Route::get('/all/state', 'AllState')->name('all.state')->middleware('permission:state.all');
        Route::get('/add/state', 'AddState')->name('add.state')->middleware('permission:state.add');
        Route::post('/store/state', 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}', 'EditState')->name('edit.state')->middleware('permission:state.edit');
        Route::post('/update/state', 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state')->middleware('permission:state.delete');
    }); // END State Controller

    // Testimonials  All Route 
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('/all/testimonials', 'AllTestimonials')->name('all.testimonials')->middleware('permission:testimonials.all');
        Route::get('/add/testimonials', 'AddTestimonials')->name('add.testimonials')->middleware('permission:testimonials.add');
        Route::post('/store/testimonials', 'StoreTestimonials')->name('store.testimonials');
        Route::get('/edit/testimonials/{id}', 'EditTestimonials')->name('edit.testimonials')->middleware('permission:testimonials.edit');
        Route::post('/update/testimonials', 'UpdateTestimonials')->name('update.testimonials');
        Route::get('/delete/testimonials/{id}', 'DeleteTestimonials')->name('delete.testimonials')->middleware('permission:testimonials.delete');
    }); // END Testimonial Controller

    // Blog Cateory All Route 
    Route::controller(BlogController::class)->group(function () {
        Route::get('/all/blog/category', 'AllBlogCategory')->name('all.blog.category')->middleware('permission:category.all');
        Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
        Route::get('/blog/category/{id}', 'EditBlogCategory')->middleware('permission:category.edit');
        Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
        Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category')->middleware('permission:category.delete');
    }); // END Blog Controller

    // Testimonials  All Route 
    Route::controller(BlogController::class)->group(function () {

        Route::get('/all/post', 'AllPost')->name('all.post')->middleware('permission:post.all');
        Route::get('/add/post', 'AddPost')->name('add.post')->middleware('permission:post.add');
        Route::post('/store/post', 'StorePost')->name('store.post');
        Route::get('/edit/post/{id}', 'EditPost')->name('edit.post')->middleware('permission:post.edit');
        Route::post('/update/post', 'UpdatePost')->name('update.post');
        Route::get('/delete/post/{id}', 'DeletePost')->name('delete.post')->middleware('permission:post.delete');
    });// END Blog (post) Controller

    // SMTP Setting  All Route 
    Route::controller(SettingController::class)->group(function () {
        Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting')->middleware('permission:smtp.menu');
        Route::post('/update/smtp/setting', 'UpdateSmtpSetting')->name('update.smtp.setting');
    }); // END SMTP Setting Controller

    // Site Setting  All Route 
    Route::controller(SettingController::class)->group(function () {
        Route::get('/site/setting', 'SiteSetting')->name('site.setting')->middleware('permission:site.menu');
        Route::post('/update/site/setting', 'UpdateSiteSetting')->name('update.site.setting');
    });// END Site Setting Controller

     // Permission All Route 
    Route::controller(RoleController::class)->group(function(){

        Route::get('/all/permission', 'AllPermission')->name('all.permission')->middleware('permission:role.menu'); 
        Route::get('/add/permission', 'AddPermission')->name('add.permission')->middleware('permission:role.menu');
        Route::post('/store/permission', 'StorePermission')->name('store.permission'); 
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission')->middleware('permission:role.menu');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission')->middleware('permission:role.menu'); 
        Route::get('/export', 'Export')->name('export');
        Route::post('/import', 'Import')->name('import');

        Route::get('/import/permission', 'ImportPermission')->name('import.permission')->middleware('permission:role.menu');

    });

    // Roles All Route 
    Route::controller(RoleController::class)->group(function(){

        Route::get('/all/roles', 'AllRoles')->name('all.roles')->middleware('permission:role.menu'); 
        Route::get('/add/roles', 'AddRoles')->name('add.roles')->middleware('permission:role.menu');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles'); 
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles')->middleware('permission:role.menu');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles')->middleware('permission:role.menu');   

        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission')->middleware('permission:role.menu'); 
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store'); 
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission')->middleware('permission:role.menu'); 
        Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles')->middleware('permission:role.menu'); 
        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update'); 
        Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles')->middleware('permission:role.menu');

    });




    // Admin User All Route
    Route::controller(AdminController::class)->group(function () {

        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/add/admin', 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');

    });// END Site Setting Controller


}); // END ADMIN MIDDLEWARE





Route::middleware(['auth', 'roles:agent'])->group(function () {

    // START Agent Property
    Route::controller(AgentPropertyController::class)->group(function () {

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
        Route::get('/agent/property/message', 'AgentPropertyMessage')->name('agent.property.message');
        Route::get('/agent/message/details/{id}', 'AgentMessageDetails')->name('agent.message.details');

        // Schedule Request Route 
        Route::get('/agent/schedule/request/', 'AgentScheduleRequest')->name('agent.schedule.request');
        Route::get('/agent/details/schedule/{id}', 'AgentDetailsSchedule')->name('agent.details.schedule');
        Route::post('/agent/update/schedule/', 'AgentUpdateSchedule')->name('agent.update.schedule');

    }); // END Agent Property



    // START Agent Package
    Route::controller(AgentPropertyController::class)->group(function () {

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

// ADD TO COMPARE
Route::post('/add-to-compare/{property_id}', [CompareController::class, 'AddToCompare']);

// SEND PROPERTY MESSAGE
Route::post('/property/message', [IndexController::class, 'PropertyMessage'])->name('property.message');

// FRONTEND: AGENT DETAILS
Route::get('/agent/details/{id}', [IndexController::class, 'AgentDetails'])->name('agent.details');

// SEND AGENT DETAILS MESSAGE
Route::post('/agent/details/message', [IndexController::class, 'AgentDetailsMessage'])->name('agent.details.message');

// ALL PROPERTY FOR RENT
Route::get('/rent/property', [IndexController::class, 'RentProperty'])->name('rent.property');

// ALL PROPERTY FOR BUY
Route::get('/buy/property', [IndexController::class, 'BuyProperty'])->name('buy.property');

// ALL PROPERTY CATEGORIES
Route::get('/property/type/{id}', [IndexController::class, 'PropertyType'])->name('property.type');

// Get State Details Data 
Route::get('/state/details/{id}', [IndexController::class, 'StateDetails'])->name('state.details');

// Home Page Buy Seach Option
Route::post('/buy/property/search', [IndexController::class, 'BuyPropertySeach'])->name('buy.property.search');

// Home Page Rent Seach Option
Route::post('/rent/property/search', [IndexController::class, 'RentPropertySeach'])->name('rent.property.search');

// All Property Seach Option
Route::post('/all/property/search', [IndexController::class, 'AllPropertySeach'])->name('all.property.search');

// Blog Details Route 
Route::get('/blog/details/{slug}', [BlogController::class, 'BlogDetails']);
Route::get('/blog/cat/list/{id}', [BlogController::class, 'BlogCatList']);
Route::get('/blog', [BlogController::class, 'BlogList'])->name('blog.list');
Route::post('/store/comment', [BlogController::class, 'StoreComment'])->name('store.comment');
Route::get('/admin/blog/comment', [BlogController::class, 'AdminBlogComment'])->name('admin.blog.comment');
Route::get('/admin/comment/reply/{id}', [BlogController::class, 'AdminCommentReply'])->name('admin.comment.reply');
Route::post('/reply/message', [BlogController::class, 'ReplyMessage'])->name('reply.message');

// Schedule Message Request Route 
Route::post('/store/schedule', [IndexController::class, 'StoreSchedule'])->name('store.schedule');



require __DIR__ . '/auth.php';