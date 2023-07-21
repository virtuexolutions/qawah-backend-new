<?php

use Illuminate\Support\Facades\Route;
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



Auth::routes();

// Routes For Front 

//Route::get('/', function () {return view('welcome');});

// Route::get('home', 'PageController@index')->name('home');
Route::get('cronjob-stripe',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"pkg_info"]); 
Route::get('cronjob-trail',[App\Http\Controllers\ApiControllers\SubcribtionsController::Class,"trail_package"]); 


// Admin Auth Routes
Route::get('/', [App\Http\Controllers\FrontControllers\PageController::class,'index']);
Route::get('/premium-features', [App\Http\Controllers\FrontControllers\PageController::class,'Premium_Features']);
Route::get('/qavah-gold', [App\Http\Controllers\FrontControllers\PageController::class,'qavah_gold']);
Route::get('/qavah-platinum', [App\Http\Controllers\FrontControllers\PageController::class,'qavah_platinum']);
Route::get('/qavah-live', [App\Http\Controllers\FrontControllers\PageController::class,'qavah_live']);
Route::get('/qavah-court', [App\Http\Controllers\FrontControllers\PageController::class,'qavah_court']);
Route::get('/about', [App\Http\Controllers\FrontControllers\PageController::class,'about']);
Route::get('/support', [App\Http\Controllers\FrontControllers\PageController::class,'support']);
Route::get('/safty', [App\Http\Controllers\FrontControllers\PageController::class,'safty']);
Route::get('/terms&condition', [App\Http\Controllers\FrontControllers\PageController::class,'terms']);
Route::get('/privacy', [App\Http\Controllers\FrontControllers\PageController::class,'privacy']);
Route::get('/contact-us', [App\Http\Controllers\FrontControllers\PageController::class,'contact']);






Route::get('/admin-login', [App\Http\Controllers\AdminControllers\Auth\LoginController::class,'ShowLoginForm'])->name('admin.login');
Route::post('admin-login', [App\Http\Controllers\AdminControllers\Auth\LoginController::class,'login'])->name('admin.login');
Route::get('logout', [App\Http\Controllers\AdminControllers\Auth\LoginController::class,'logout'])->name( 'admin.logout' );
// Routes For Admin 
Route::group(['middleware' => ['web','auth:admin']], function () {
//Dashboard Route
Route::get('admin/dashboard', [App\Http\Controllers\AdminControllers\DashboardController::class,'initContent'])->name('dashboard'); //This will resoluve AdminControllers\DashboardController file
//Change Password
Route::get('/change_password', [App\Http\Controllers\AdminControllers\DashboardController::class, 'change_password'])->name('change_password');
Route::post('/store_change_password', [App\Http\Controllers\AdminControllers\DashboardController::class, 'store_change_password'])->name('store_change_password');

//Banner section routes
Route::resource('slider','\App\Http\Controllers\AdminControllers\SliderController');
Route::get('slider/{slider}/{photokey}/','\App\Http\Controllers\AdminControllers\SliderController@delete_image')->name("slider.delete_image");
// InnerBanner section routes

Route::resource('banner','\App\Http\Controllers\AdminControllers\BannerController');



Route::get('logo', 'LogoController@addlogo');
Route::post('logo/upload', 'LogoController@update_logo')->name('logo.upload');

//Home section content routes
Route::get('home', 'HomePageController@index');
Route::get('home/add-content', 'HomePageController@create');
Route::post('homestore','HomePageController@store')->name('home.store');
Route::get('home/edit/{id}',['as'=>'home.edit', 'uses'=>'HomePageController@edit']);
Route::post('cms-update/{id}' , ['as' => 'cms.update' , 'uses' => 'HomePageController@update']);
Route::get('home/delete/{id}' , ['as' => 'home.delete' , 'uses' => 'HomePageController@destroy']);


//About section content routes
// Route::get('about', 'HomePageController@about');
// Route::get('about/add-content', 'HomePageController@create');
// Route::get('about/edit/{id}',['as'=>'about.edit', 'uses'=>'HomePageController@aboutEdit']);
// Route::get('about/delete/{id}' , ['as' => 'about.delete' , 'uses' => 'HomePageController@aboutDestroy']);


//Contact page content routes
Route::get('contact', 'HomePageController@contact');
Route::get('contact/add-content', 'HomePageController@create');
Route::get('contact/edit/{id}',['as'=>'contact.edit', 'uses'=>'HomePageController@contactEdit']);
Route::get('contact/delete/{id}' , ['as' => 'contact.delete' , 'uses' => 'HomePageController@contactDestroy']);


//Users section content routes
Route::get('users','\App\Http\Controllers\AdminControllers\UserController@showView')->name('users');
Route::get('user/add-user', '\App\Http\Controllers\AdminControllers\UserController@showUserForm');
Route::post('create-user','\App\Http\Controllers\AdminControllers\UserController@createUser')->name('create.user');
Route::get('user/edit/{id}',['as'=>'user.edit', 'uses'=>'\App\Http\Controllers\AdminControllers\UserController@edit']);
Route::post('user-update/{id}' , ['as' => 'user.update' , 'uses' => '\App\Http\Controllers\AdminControllers\UserController@update']);
Route::get('user/delete/{id}' , ['as' => 'user.delete' , 'uses' => '\App\Http\Controllers\AdminControllers\UserController@destroy']);
Route::get('user/show/{id}',['as'=>'user.show', 'uses'=>'\App\Http\Controllers\AdminControllers\UserController@show']);
Route::get('status/{id}/{status}','\App\Http\Controllers\AdminControllers\UserController@status')->name('user_status');
Route::post('deleteprofileimage/{id}','\App\Http\Controllers\AdminControllers\UserController@deleteprofileimage')->name('prifle_destroy');
Route::post('deletegalleryimage/{id}','\App\Http\Controllers\AdminControllers\UserController@deletegalleryimage')->name('galley_destroy');
Route::get('userspackages','\App\Http\Controllers\AdminControllers\UserController@userspackages')->name('userspackages');



// Category section routes
Route::get('category','CategoryController@index');
Route::get('add-category','CategoryController@show');
Route::post("create-category","CategoryController@create")->name('create.category');
Route::get('category/edit/{id}',['as'=>'category.edit', 'uses'=>'CategoryController@edit']);
Route::post('category-update/{id}' , ['as' => 'category.update' , 'uses' => 'CategoryController@update']);
Route::get('category/delete/{id}' , ['as' => 'category.delete' , 'uses' => 'CategoryController@destroy']);


// ajax category 
Route::post('fetch_package_category' , ['as' => 'fetch_package_category' , 'uses' => 'CategoryController@fetch_package_category']);

Route::get("events","\App\Http\Controllers\AdminControllers\EventController@index")->name('events_list');
Route::get("event-status/{id}/{status}","\App\Http\Controllers\AdminControllers\EventController@status")->name('event_stu');


// cms


Route::resource('pages', '\App\Http\Controllers\AdminControllers\PageController');
Route::resource('sections','\App\Http\Controllers\AdminControllers\SectionController');
Route::resource('promos', '\App\Http\Controllers\AdminControllers\PromoController');



Route::resource('roles', '\App\Http\Controllers\AdminControllers\RoleController');
Route::resource('managers', '\App\Http\Controllers\AdminControllers\ManageAdminController');
Route::resource('faqs', '\App\Http\Controllers\AdminControllers\FaqController');

// Menus section routes
Route::get('menus','MenusController@index');

// Product section routes
Route::get('product','ProductController@index');
Route::get('add-product','ProductController@show');
Route::post('productstore','ProductController@store')->name('product.store');
Route::get('product/edit/{id}',['as'=>'product.edit','uses'=>'ProductController@edit']);
Route::post('product-update/{id}' , ['as' => 'product.update' , 'uses' => 'ProductController@update']);
Route::get('product/delete/{id}' , ['as' => 'product.delete' , 'uses' => 'ProductController@destroy']);
Route::get('show-gallery/{id}',['as'=>'show.gallery', 'uses'=> 'ProductController@showGallery']);
Route::post('upload-images','ProductController@storeImages')->name('upload.images');
Route::get('gallery/delete/{id}' , ['as' => 'gallery.delete' , 'uses' => 'ProductController@galleryDestroy']);




// Packages section routes
Route::get('packages-catogeries','Package_catogeriesController@index')->name('packages-catogeries');
Route::get('add-packages-catogeries','Package_catogeriesController@add');
Route::post('packages-catogeries-store','Package_catogeriesController@store')->name('Package_catogeries.store');
Route::get('packages-catogeries/edit/{id}',['as'=>'Package_catogeries.edit','uses'=>'Package_catogeriesController@edit']);
Route::post('packages-catogeries-update/{id}' , ['as' => 'Package_catogeries.update' , 'uses' => 'Package_catogeriesController@update']);
Route::get('packages-catogeries/delete/{id}' , ['as' => 'Package_catogeries.delete' , 'uses' => 'Package_catogeriesController@destroy']);




Route::resource('packages','\App\Http\Controllers\AdminControllers\PackageController');
Route::get('packages-status/{id}/{status}','\App\Http\Controllers\AdminControllers\PackageController@status')->name('packages_status');
Route::resource('promotions','\App\Http\Controllers\AdminControllers\PromotionalPkgController');
Route::get('promotions-status/{id}/{status}','\App\Http\Controllers\AdminControllers\PromotionalPkgController@status')->name('promotions_status');




// Offer Package section routes
Route::get('subscription/create','\App\Http\Controllers\AdminControllers\SubscriptionController@create');
Route::post('subscription/store','\App\Http\Controllers\AdminControllers\SubscriptionController@store')->name('subscription.store');
Route::get('subscription/delete/{id}' , ['as' => 'subscription.delete' , 'uses' => '\App\Http\Controllers\AdminControllers\SubscriptionController@destroy']);
Route::get('subscription/status/{id}/{status}' , ['as' => 'subscription.status' , 'uses' => '\App\Http\Controllers\AdminControllers\SubscriptionController@status']);


// Subscription section routes
Route::get('subscription','\App\Http\Controllers\AdminControllers\SubscriptionController@index')->name('subscription');

Route::get('verification','\App\Http\Controllers\AdminControllers\UserVerificationController@index')->name('verification');
Route::get('verification-status/{id}/{status}','\App\Http\Controllers\AdminControllers\UserVerificationController@status')->name('verification_status');
Route::get('verification-delete/{id}','\App\Http\Controllers\AdminControllers\UserVerificationController@delete')->name('verification_delete');


// Order section routes
Route::get('order','OrderController@index');
// Route::get('add-category','CategoryController@show');
// Route::post("create-category","CategoryController@create")->name('create.category');
Route::get('order/edit/{id}',['as'=>'order.edit', 'uses'=>'OrderController@edit']);
Route::get('order/show/{id}',['as'=>'order.show', 'uses'=>'OrderController@show']);
// Route::post('category-update/{id}' , ['as' => 'category.update' , 'uses' => 'CategoryController@update']);
Route::get('order/delete/{id}' , ['as' => 'order.delete' , 'uses' => 'OrderController@destroy']);

// Inquiry and newsletter section routes
Route::get('show-inquiries','InquiryController@showInquiries');
Route::get('delete/inquiry/{id}',['as'=>'delete.inquiry', 'uses'=>'InquiryController@destroy']);
Route::post('get/Inquiry','InquiryController@getInquiryData');


Route::post('dropzone/upload', 'DashboardController@upload')->name('dropzone.upload');
Route::get('dropzone/fetch', 'DashboardController@fetch')->name('dropzone.fetch');
Route::get('dropzone/delete', 'DashboardController@delete')->name('dropzone.delete');



});
