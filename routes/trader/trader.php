<?php
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DeliveryController;
use App\Http\Controllers\Backend\UserActionController;

// All route names are prefixed with 'trader.'.
Route::redirect('/', '/trader/dashboard', 301);
Route::any('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('dashboard/changerole', [DashboardController::class, 'roleChageDashboard'])->name('dashboard.changerole');
Route::any('transport/deliveries/traderdeliveries', [DeliveryController::class, 'traderdeliveries'])->name('deliveries.traderdeliveries');
Route::resource('transport/deliveries','DeliveryController');
Route::GET('deliveries/index', [DeliveryController::class, 'index'])->name('deliveries.index');
Route::GET('deliveries/edit_deliveries/{id}', [DeliveryController::class, 'edit'])->name('deliveries.edit');
Route::POST('deliveries/update', [DeliveryController::class, 'update'])->name('deliveries.update');
Route::POST('trading/deliveries/adminmoredeliveries', [DeliveryController::class, 'adminmoredeliveries'])->name('deliveries.adminmoredeliveries');

Route::POST('get-product-buyerpref-by-ajax', [BuyerprefController::class, 'byyerprefcardviewbyAjax'])->name('trading.byyerprefcardviewbyAjax');

// Route::POST('get-product-stock-ajax', [ProductController::class, 'getProductStockAjax'])->name('trading.getproductforstock');

Route::POST('get-product-stock-ajax', [DeliveryController::class, 'getProductStockAjax'])->name('trading.getproductforstock');


Route::get('profile/{id}', [UserActionController::class, 'editAdmin'])->name('profile.edit');

Route::POST('user/{id}/edit','UserActionController@updateAdmin')->name('user.edit');

Route::POST('get-product-deliverie-ajax', [DeliveryController::class, 'getDeliveriesByAjax'])->name('trading.deliveriesbyAjax');

Route::POST('get-product-deliverycard-by-ajax', [DeliveryController::class, 'deliverycardviewbyAjax'])->name('trading.deliverycardviewbyAjax');

