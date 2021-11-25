<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\UsersController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Backend\BuyerleadController;
use App\Http\Controllers\Frontend\NotificationController;


/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('unsubscribe/{id}', [HomeController::class, 'unsubscribe_email'])->name('unsubscribe.email');

Route::get('unsubscribeWhatsapp/{id}', [HomeController::class, 'unsubscribe_whatsapp'])->name('unsubscribe.whatsapp');



Route::get('confirmoffer/{match_id}', [HomeController::class, 'confirmoffer'])->name('confirmoffer');
Route::get('language/{lang}', [HomeController::class, 'index'])->name('language');
Route::get('referrer', [HomeController::class, 'referrer'])->name('referrer');

Route::get('privacy-policy', [HomeController::class, 'privacypolicy'])->name('privacy-policy');
Route::get('terms-conditions', [HomeController::class, 'termsconditions'])->name('terms-conditions');

Route::get('set_site_cookie', [HomeController::class, 'set_site_cookie'])->name('set_site_cookie');
Route::post('set_site_cookie', [HomeController::class, 'set_site_cookie'])->name('set_site_cookie');
Route::post('subscribe', [HomeController::class, 'subscribe'])->name('subscribe');

Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');
// Route::get('inquire', [ContactController::class, 'buyerlead'])->name('buyerlead');
Route::post('buyerlead', 'ContactController@buyercontact_send')->name('buyerlead.store');
// Route::any('buyerlead/send', [ContactController::class, 'buyerlead_send'])->name('buyerlead.send');
// Route::get('buyerlead/verification/{token}', [ContactController::class, 'buyerlead_verification'])->name('buyerlead.verification');
// Route::get('sellercontact', [ContactController::class, 'sellercontact'])->name('sellercontact');
// Route::post('sellercontact/send', [ContactController::class, 'send_sellercontact'])->name('sellercontact.send');
Route::get('authorize-seller/{user_id}', [HomeController::class, 'authorizeSeller'])->name('authorize.seller');
Route::get('confirm-order/{purchaseorder_id}', [HomeController::class, 'orderConfirmation'])->name('confirm.order');
Route::get('edit-order/{purchaseorder_id}', [HomeController::class, 'orderEdit'])->name('edit.order');
Route::post('user/tracker', [HomeController::class, 'tracker'])->name('user.tracker');
Route::post('user/iplocation', [HomeController::class, 'ipLocation'])->name('user.iplocation');
Route::post('user/firstvisit', [HomeController::class, 'firstvisit'])->name('user.firstvisit');
Route::post('user/action', [HomeController::class, 'action'])->name('user.action');
Route::get('currency_rate', [HomeController::class, 'currencyRate'])->name('currency_rate');

// View Account Specific
Route::get('publicpage_updateprofilepic/{user_id}', [UsersController::class, 'publicpage_updateprofilepic'])->name('publicpage_updateprofilepic');

Route::post('publicpage_updateprofilepic/updateimage', [UsersController::class, 'updateimage']);

//Save account details for affiliate
Route::get('ac={firstname}', [UsersController::class, 'useraffiliatecode'])->name('useraffiliatecode');

Route::post('savecard', [HomeController::class, 'savecard'])->name('savecard');

Route::post('contact_send', [ContactController::class, 'contact_send'])->name('contact_send');

//Cron notification job
Route::get('register-cron', [NotificationController::class, 'registerNotifications'])->name('register-cron');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        // User Dashboard Specific
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Account Specific
        Route::get('account', [AccountController::class, 'index'])->name('account');
		
		
        // User Profile Specific
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});

Route::POST('get_email_count', [HomeController::class, 'getemailCount'])->name('get_email_count');
Route::POST('get_phone_count', [HomeController::class, 'getphoneCount'])->name('get_phone_count');
		