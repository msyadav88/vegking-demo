<?php
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\BuyerController;
use App\Http\Controllers\Backend\Auth\User\UserController;
use App\Http\Controllers\Backend\DeliveryController;
use App\Http\Controllers\Backend\BuyerprefController;
use App\Http\Controllers\Backend\StockController;

// All route names are prefixed with 'buyer.'.
Route::redirect('/', '/buyer/dashboard', 301);
Route::any('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('dashboard/changerole', [DashboardController::class, 'roleChageDashboard'])->name('dashboard.changerole');
Route::any('get_quote', [DashboardController::class, 'getQuotes'])->name('get_quote');
Route::any('updateBuyerPref','BuyerController@updateBuyerPref')->name('updateBuyerPref');
Route::POST('get-product-ajax-multiple', [ProductController::class, 'getProductAjaxMultiple'])->name('trading.getproductmultiple');
Route::GET('user/{id}/edit', [BuyerController::class, 'editbuyer'])->name('user.edit');
Route::POST('user/{id}/edit','BuyerController@updatebuyer')->name('user.edit');
Route::any('trading/buyerpref/cardview', [BuyerprefController::class, 'prefcardview'])->name('buyerpref.cardview');
Route::any('transport/deliveries/buyerdeliveries', [DeliveryController::class, 'buyerdeliveries'])->name('deliveries.buyerdeliveries');
Route::POST('transport/deliveries/adminmoredeliveries', [DeliveryController::class, 'adminmoredeliveries'])->name('deliveries.adminmoredeliveries');
Route::resource('transport/deliveries','DeliveryController');
Route::resource('trading/buyerpref','BuyerprefController');
Route::any('buyerprefexports', [BuyerprefController::class, 'buyerprefexports'])->name('buyerpref.buyerprefexports');

Route::GET('transport/gettransload', [DeliveryController::class, 'getTransload'])->name('transport.gettransload');
Route::POST('transport/Savetransload', [DeliveryController::class, 'Savetransload'])->name('transport.Savetransload');
Route::resource('buyers','BuyerController');
Route::POST('get-product-stock-ajax', [ProductController::class, 'getProductStockAjax'])->name('trading.getproductforstock');
Route::POST('create-buyer-pref', [BuyerprefController::class, 'storeajax'])->name('buyerpref.storeajax');
Route::any('trading/stockv2/buyerdeliveries-card', [StockController::class, 'buyerdeliveries'])->name('stockv2.buyerdeliveries');
Route::POST('get-product-buyer-ajax', [ProductController::class, 'getProductForBuyerAjax'])->name('trading.getproductforbuyer');
Route::POST('get_pref_count', [BuyerprefController::class, 'getPrefCount'])->name('get_pref_count');
Route::POST('get_pref','BuyerprefController@getPref');
Route::POST('updateajax','BuyerprefController@updateAjax')->name('buyerpref.updateajax');
Route::POST('trading/buyerpref/morecardview', [BuyerprefController::class, 'loadMorePrefCardView'])->name('buyerpref.morecardview');
Route::POST('get-product-buyerpref-by-ajax', [BuyerprefController::class, 'byyerprefcardviewbyAjax'])->name('trading.byyerprefcardviewbyAjax');

Route::POST('get-product-deliverie-ajax', [DeliveryController::class, 'getDeliveriesByAjax'])->name('trading.deliveriesbyAjax');
Route::POST('get-product-deliverycard-by-ajax', [DeliveryController::class, 'deliverycardviewbyAjax'])->name('trading.deliverycardviewbyAjax');

Route::GET('getVarity','ProductController@getVarity')->name('product.getVarity');
Route::GET('sellerSearch','SellerController@sellerSearch')->name('sellers.search');
Route::GET('buyerSearch','BuyerController@buyerSearch')->name('buyers.search');