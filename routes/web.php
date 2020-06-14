<?php

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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

Route::get('/lang/{locale}', function ($locale){
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

//--------------------------------------------

// Test For Database
Route::get('/insert', 'Api\SettingController@city');
//---------------------

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//---------------------------------------


//Route::get('/', function (){
//    return view('welcome');
//});

Route::get('/permission', function(){
    return view('admin_panel.access');
});


//-----------------------------------------


Route::get('/sign_in', 'Admin\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/sign_in', 'Admin\AdminLoginController@login')->name('admin.login.post');
Route::post('/sign_out', 'Admin\AdminLoginController@logout')->name('admin.logout');

Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function (){
    // Edit Profile
    Route::get('/edit_profile', 'AdminLoginController@editProfile')->name('edit_profile');
    Route::post('/edit_profile/{id}', 'AdminLoginController@updateProfile')->name('update_profile');
    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');
    // Portfolio
    Route::get('/portfolios', 'AdminPortfolioController@index')->name('all_portfolios');
    Route::get('/add_portfolio', 'AdminPortfolioController@adminCreate');
    Route::post('/add_portfolio', 'AdminPortfolioController@adminStore')->name('store_portfolio');
    Route::get('/edit_portfolio/{id}', 'AdminPortfolioController@adminEdit')->name('edit_portfolio');
    Route::post('/edit_portfolio/{id}', 'AdminPortfolioController@adminUpdate')->name('update_portfolio');
    Route::delete('/delete_portfolio/{id}', 'AdminPortfolioController@adminDestroy')->name('delete_portfolio');
    // Portfolio Image
    Route::get('/portfolio_image/{id}', 'AdminPortfolioImageController@index')->name('all_portfolio_image');
    // Route::get('/add_portfolio_image', 'AdminPortfolioImageController@adminCreate');
    Route::post('/add_portfolio_image', 'AdminPortfolioImageController@adminStore')->name('store_portfolio_image');
    // Route::get('/edit_portfolio_image/{id}', 'AdminPortfolioImageController@adminEdit')->name('edit_portfolio_image');
    // Route::post('/edit_portfolio_image/{id}', 'AdminPortfolioImageController@adminUpdate')->name('update_portfolio_image');
    Route::delete('/delete_portfolio_image/{id}', 'AdminPortfolioImageController@adminDestroy')->name('delete_portfolio_image');
    // Product
    Route::get('/products', 'AdminProductController@index')->name('all_products');
    Route::get('/add_product', 'AdminProductController@adminCreate');
    Route::post('/add_product', 'AdminProductController@adminStore')->name('store_product');
    Route::get('/edit_product/{id}', 'AdminProductController@adminEdit')->name('edit_product');
    Route::post('/edit_product/{id}', 'AdminProductController@adminUpdate')->name('update_product');
    Route::delete('/delete_product/{id}', 'AdminProductController@adminDestroy')->name('delete_product');
    // Product Image
    Route::get('/product_image/{id}', 'AdminProductImageController@index')->name('all_product_image');
    Route::post('/add_product_image', 'AdminProductImageController@adminStore')->name('store_product_image');
    Route::delete('/delete_product_image/{id}', 'AdminProductImageController@adminDestroy')->name('delete_product_image');
    // Service
    Route::get('/services', 'AdminServiceController@index')->name('all_services');
    Route::get('/add_service', 'AdminServiceController@adminCreate');
    Route::post('/add_service', 'AdminServiceController@adminStore')->name('store_service');
    Route::get('/edit_service/{id}', 'AdminServiceController@adminEdit')->name('edit_service');
    Route::post('/edit_service/{id}', 'AdminServiceController@adminUpdate')->name('update_service');
    Route::delete('/delete_service/{id}', 'AdminServiceController@adminDestroy')->name('delete_service');
    // Blog
    Route::get('/blogs', 'AdminBlogController@index')->name('all_blogs');
    Route::get('/add_blog', 'AdminBlogController@adminCreate');
    Route::post('/add_blog', 'AdminBlogController@adminStore')->name('store_blog');
    Route::get('/edit_blog/{id}', 'AdminBlogController@adminEdit')->name('edit_blog');
    Route::post('/edit_blog/{id}', 'AdminBlogController@adminUpdate')->name('update_blog');
    Route::delete('/delete_blog/{id}', 'AdminBlogController@adminDestroy')->name('delete_blog');
    Route::post('upload_image','AdminBlogController@uploadImage')->name('upload');
    // Partner
    Route::get('/partners', 'AdminPartnerController@index')->name('all_partner');
    Route::get('/add_partner', 'AdminPartnerController@adminCreate');
    Route::post('/add_partner', 'AdminPartnerController@adminStore')->name('store_partner');
    Route::get('/edit_partner/{id}', 'AdminPartnerController@adminEdit')->name('edit_partner');
    Route::post('/edit_partner/{id}', 'AdminPartnerController@adminUpdate')->name('update_partner');
    Route::delete('/delete_partner/{id}', 'AdminPartnerController@adminDestroy')->name('delete_partner');
    // Team
    Route::get('/teams', 'AdminTeamController@index')->name('all_team');
    Route::get('/add_team', 'AdminTeamController@adminCreate');
    Route::post('/add_team', 'AdminTeamController@adminStore')->name('store_team');
    Route::get('/edit_team/{id}', 'AdminTeamController@adminEdit')->name('edit_team');
    Route::post('/edit_team/{id}', 'AdminTeamController@adminUpdate')->name('update_team');
    Route::delete('/delete_team/{id}', 'AdminTeamController@adminDestroy')->name('delete_team');
    // About Us
    Route::get('/edit_about', 'AdminAboutController@adminEdit')->name('edit_about');
    Route::post('/edit_about/{id}', 'AdminAboutController@adminUpdate')->name('update_about');
    // Setting
    Route::get('/edit_setting', 'AdminSettingController@adminEdit')->name('edit_setting');
    Route::post('/edit_setting/{id}', 'AdminSettingController@adminUpdate')->name('update_setting');
    // Contact
    Route::get('contacts', 'AdminContactController@index')->name('contacts');
    Route::delete('contact_delete/{id}', 'AdminContactController@adminDestroy')->name('contact_delete');
    // Feedback
    Route::get('feedbacks', 'AdminFeedbackController@index');
    Route::delete('feedback_delete/{id}', 'AdminFeedbackController@adminDestroy')->name('feedback_delete');
    // Job
    Route::get('/jobs', 'AdminJobController@index')->name('all_jobs');
    Route::get('/add_job', 'AdminJobController@adminCreate');
    Route::post('/add_job', 'AdminJobController@adminStore')->name('store_job');
    Route::get('/edit_job/{id}', 'AdminJobController@adminEdit')->name('edit_job');
    Route::post('/edit_job/{id}', 'AdminJobController@adminUpdate')->name('update_job');
    Route::delete('/delete_job/{id}', 'AdminJobController@adminDestroy')->name('delete_job');
    // Ajax
    Route::post('changeStatus', 'AdminPortfolioController@changeStatus')->name('changeStatus');
});

Auth::routes();