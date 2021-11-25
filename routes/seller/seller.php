<?php
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\SellerController;
use App\Http\Controllers\Backend\Auth\User\UserController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\DeliveryController;
// All route names are prefixed with 'seller.'.
Route::redirect('/', '/seller/dashboard', 301);
Route::any('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('dashboard/changerole', [DashboardController::class, 'roleChageDashboard'])->name('dashboard.changerole');
Route::POST('get-product-ajax', [ProductController::class, 'getProductAjax'])->name('trading.getproduct');
Route::resource('trading/stock','OfferController');
Route::resource('trading/sales','SaleController');
Route::resource('trading/offersent','OffersentController');
Route::any('transport/deliveries/sellerdeliveries', [DeliveryController::class, 'sellerdeliveries'])->name('deliveries.sellerdeliveries');
Route::resource('transport/deliveries','DeliveryController');
Route::resource('transport/transportlist','TransportlistController');
Route::resource('trading/matches','MatchsController');
Route::resource('buyers','BuyerController');
Route::resource('sellers','SellerController');
Route::POST('get_city_list/{country}', [OfferController::class, 'get_city_list'])->name('stock.get_city_list');
Route::POST('get_postal_code/{city}', [OfferController::class, 'get_postal_code'])->name('stock.get_postal_code');
Route::POST('get-vcolor-ajax', [OfferController::class, 'getvcolorAjax'])->name('trading.getcolor');
Route::get('maching-requests-ajax/{offer}', [OfferController::class, 'matchingRequests'])->name('stock.matchings');
Route::POST('maching-requests-apply', [OfferController::class, 'applyMatchingRequest'])->name('stock.matching.apply');
Route::resource('accounts/purchaseorder','PurchaseOrderController');
// Route::any('OrderInvoiceView/{order}', [AccountController::class, 'OrderInvoiceView'])->name('accounts.OrderInvoiceView');
// Route::any('OrderInvoiceSend/{order}', [AccountController::class, 'OrderInvoiceSend'])->name('accounts.OrderInvoiceSend');
Route::resource('accounts/invoices','InvoiceController');
Route::GET('accounts/invoices/{invoice_id}/payment','InvoiceController@payment')->name('invoices.payment');
Route::POST('get-psample-ajax', [OfferController::class, 'getproductsampleAjax'])->name('trading.getproductsample');
Route::GET('user/{id}/edit', [SellerController::class, 'editseller'])->name('user.edit');
//Route::POST('user/{id}/edit', [SellerController::class, 'updateseller'])->name('user.edit');
Route::POST('user/{id}/edit','SellerController@updateseller')->name('user.edit');

Route::any('trading/stockv2/card', [StockController::class, 'stockcardview'])->name('stockcardview');
Route::POST('trading/stockv2/stockmorecardview', [StockController::class, 'stockmorecardview'])->name('stockv2.stockmorecardview');

Route::resource('trading/stockv2','StockController');
Route::POST('get-product-stock-ajax', [ProductController::class, 'getProductStockAjax'])->name('trading.getproductforstock');
Route::POST('get_stock_count', [StockController::class, 'getStockCount'])->name('get_stock_count');
Route::any('get-stock', [StockController::class, 'getStock'])->name('get-stock');
Route::POST('trading/deliveries/adminmoredeliveries', [DeliveryController::class, 'adminmoredeliveries'])->name('deliveries.adminmoredeliveries');
Route::POST('get-product-stock-by-ajax', [StockController::class, 'stockcardviewbyAjax'])->name('trading.stockcardviewbyAjax');


Route::POST('get-product-buyerpref-by-ajax', [BuyerprefController::class, 'byyerprefcardviewbyAjax'])->name('trading.byyerprefcardviewbyAjax');
Route::POST('get-product-deliverie-ajax', [DeliveryController::class, 'getDeliveriesByAjax'])->name('trading.deliveriesbyAjax');
Route::POST('get-product-deliverycard-by-ajax', [DeliveryController::class, 'deliverycardviewbyAjax'])->name('trading.deliverycardviewbyAjax');
Route::GET('getVarity','ProductController@getVarity')->name('product.getVarity');
Route::GET('sellerSearch','SellerController@sellerSearch')->name('sellers.search');
Route::GET('buyerSearch','BuyerController@buyerSearch')->name('buyers.search');