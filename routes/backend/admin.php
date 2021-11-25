<?php


use App\BuyerPref;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\OfferRequestController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\Backend\LoadController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\BuyerController;
use App\Http\Controllers\Backend\SellerController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\AppHeadController;
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\MatchsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Backend\EmailTemplateController;
use App\Http\Controllers\Backend\OffersentController;
use App\Http\Controllers\Backend\ListtransportController;
use App\Http\Controllers\Backend\BuyerprefController;
use App\Http\Controllers\Backend\ProductspecsController;
use App\Http\Controllers\Backend\ProductspecvaluesController;
use App\Http\Controllers\Backend\WarehouseController;
use App\Http\Controllers\Backend\DeliveryController;
use App\Http\Controllers\Backend\ReferrerController;
use App\Http\Controllers\Backend\UserIpsController;
use App\Http\Controllers\Backend\UserActionController;
use App\Http\Controllers\Backend\UserVisitsController;
use App\Http\Controllers\Backend\TransportlistController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\BuyerProductRelationController;
use App\Http\Controllers\Backend\CountryRegionsController;
use App\Http\Controllers\Backend\CurrencyRateController;
use App\Http\Controllers\Backend\SubProductController;
use App\Http\Controllers\Backend\TransportCostsController;
use App\Http\Controllers\Backend\TransportListImportedController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::POST('updateajax','BuyerprefController@updateAjax')->name('buyerpref.updateajax');
Route::any('trading/buyerpref/ajax', [BuyerprefController::class, 'showAjax'])->name('buyerpref.ajax');
Route::any('subproductsexports', [SubProductController::class, 'subproductsexports'])->name('subproducts.subproductsexports');

Route::get('clear-cache', [SettingController::class, 'clearCache'])->name('clear.cache');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('profile/{id}', [UserActionController::class, 'editAdmin'])->name('profile.edit');

Route::POST('user/{id}/edit','UserActionController@updateAdmin')->name('user.edit');

Route::post('dashboard/changerole', [DashboardController::class, 'roleChageDashboard'])->name('dashboard.changerole');
Route::get('translations', [LanguageController::class, 'index'])->name('translations');
Route::resource('currencyrates','CurrencyRateController');

// buyer import
Route::get('import-buyer', [BuyerController::class, 'import_buyer'])->name('import_buyer');
Route::get('buyer_import_scrape', [BuyerController::class, 'buyer_import_scrape'])->name('buyer_import_scrape');
Route::post('import_parse', [BuyerController::class, 'parseImport'])->name('import_parse');

// seller import
Route::get('import-seller', [SellerController::class, 'import_seller'])->name('import_seller');
Route::get('seller_import_scrape', [SellerController::class, 'seller_import_scrape'])->name('seller_import_scrape');
Route::post('import_seller_parse', [SellerController::class, 'parseImport'])->name('import_seller_parse');

 //product import
Route::get('import-product', [ProductController::class, 'import_product'])->name('import_product');
Route::post('import_product_parse', [ProductController::class, 'parseImport'])->name('import_product_parse');
Route::post('saveProductVariety', [ProductController::class, 'SaveProductVariety'])->name('saveProductVariety');

Route::post('transport/getData', [CountryRegionsController::class, 'edit'])->name('transport.getData');
Route::post('transport/updateData', [CountryRegionsController::class, 'updateData'])->name('transport.updateData');
Route::post('transport/delete', [CountryRegionsController::class, 'delete'])->name('transport.delete');
Route::resource('transport','CountryRegionsController');

Route::post('transportcosts/getData', [TransportCostsController::class, 'edit'])->name('transportcosts.getData');
Route::post('transportcosts/updateData', [TransportCostsController::class, 'updateData'])->name('transportcosts.updateData');
Route::post('transportcosts/delete', [TransportCostsController::class, 'delete'])->name('transportcosts.delete');
Route::resource('transportcosts','TransportCostsController');

Route::get('languages/loadLanguageFile', [LanguageController::class, 'loadLanguageFile'])->name('languages.loadLanguageFile');

Route::POST('languages/saveLanguageTrans', [LanguageController::class, 'saveLanguageTrans'])->name('languages.saveLanguageTrans');
Route::DELETE('languages/deleteLanguageLine', [LanguageController::class, 'deleteLanguageLine'])->name('languages.deleteLanguageLine');
Route::GET('languages/getLanguageLine', [LanguageController::class, 'getLanguageLine'])->name('languages.getLanguageLine');

Route::get('maching-requests-ajax/{offer}', [OfferController::class, 'matchingRequests'])->name('stock.matchings');
Route::POST('get_city_list/{country}', [OfferController::class, 'get_city_list'])->name('stock.get_city_list');
Route::POST('get_postal_code/{city}', [OfferController::class, 'get_postal_code'])->name('stock.get_postal_code');
Route::POST('maching-requests-apply', [OfferController::class, 'applyMatchingRequest'])->name('stock.matching.apply');
Route::POST('sellers/resend-invite/{seller_id}', [SellerController::class, 'resendInvite'])->name('seller.resend.invite');
Route::POST('matches-shortname/', [MatchsController::class, 'updateShortName'])->name('matches.shortname');
Route::POST('matches-notify/{order}/{stock}', [MatchsController::class, 'sendNotification'])->name('matches.notify');
Route::POST('matches-makesale/{order}/{stock}', [MatchsController::class, 'makeSale'])->name('matches.makesale');
Route::any('matches-stock-api/{stock}', [MatchsController::class, 'matchStockAPI'])->name('matches.stock.api');
Route::any('matches-order-api/{order}', [MatchsController::class, 'matchOrderAPI'])->name('matches.order.api');
Route::any('check-matches-for-buyerprefs/{buyer}', [MatchsController::class, 'CheckMatchesForBuyerPrefId'])->name('matches.buyerprefs.api');
Route::any('check-matches-for-stock/{stock}', [MatchsController::class, 'CheckMatchesForStockId'])->name('matches.stockid.api');

Route::get('maching-offers-ajax/{offer_request}', [OfferRequestController::class, 'matchingOffers'])->name('requests.matchings');
Route::POST('maching-offers-apply', [OfferRequestController::class, 'applyMatchingOffer'])->name('requests.matching.apply');
Route::POST('get-product-ajax', [ProductController::class, 'getProductAjax'])->name('trading.getproduct');
Route::POST('get-product-spec', [ProductController::class, 'getProductSpec'])->name('trading.getproductspec');
Route::POST('get-product-spec-vals', [ProductController::class, 'getProductSpecVals'])->name('trading.getproductspecvals');
Route::POST('get-product-stock-ajax', [ProductController::class, 'getProductStockAjax'])->name('trading.getproductforstock');


Route::POST('get-product-deliverie-ajax', [DeliveryController::class, 'getDeliveriesByAjax'])->name('trading.deliveriesbyAjax');
Route::POST('get-product-deliverycard-by-ajax', [DeliveryController::class, 'deliverycardviewbyAjax'])->name('trading.deliverycardviewbyAjax');


Route::POST('get-product-stock-by-ajax', [StockController::class, 'stockcardviewbyAjax'])->name('trading.stockcardviewbyAjax');
Route::POST('get-product-buyerpref-by-ajax', [BuyerprefController::class, 'byyerprefcardviewbyAjax'])->name('trading.byyerprefcardviewbyAjax');




Route::POST('get-product-ajax-request', [ProductController::class, 'getProductAjaxRequest'])->name('trading.getproductajaxrequest');

Route::POST('get-product-ajax-multiple', [ProductController::class, 'getProductAjaxMultiple'])->name('trading.getproductmulitple');

Route::any('transport/deliveries/admindeliveries', [DeliveryController::class, 'admindeliveries'])->name('deliveries.admindeliveries');

Route::POST('get-product-buyer-ajax', [ProductController::class, 'getProductForBuyerAjax'])->name('trading.getproductforbuyer');
Route::POST('get-vcolor-ajax', [OfferController::class, 'getvcolorAjax'])->name('trading.getcolor');
Route::POST('get-psample-ajax', [OfferController::class, 'getproductsampleAjax'])->name('trading.getproductsample');
Route::POST('get-buyerpaymentpref-ajax', [SaleController::class, 'getbuyerpaymentprefAjax'])->name('trading.getbuyerpaymentpref');
Route::POST('get-getdeliveryaddress-ajax', [SaleController::class, 'getdeliveryaddressAjax'])->name('trading.getdeliveryaddress');
Route::POST('get-match-ajax', [SaleController::class, 'getmatchAjax'])->name('trading.getmatch');
Route::POST('get-buyer-ajax', [BuyerController::class, 'getBuyerAjax'])->name('trading.getbuyer');
Route::POST('get-stock-ajax', [SaleController::class, 'getStockAjax'])->name('trading.getstock');
Route::POST('get-apphead-values-ajax', [ProductspecsController::class, 'getAppHeadValues'])->name('trading.getappheadvalues');
Route::post('upload', 'UploadController@uploadSubmit');
Route::get('download', 'UploadController@downloadFile');
Route::POST('table-reorder-ajax', [AppHeadController::class, 'reorder'])->name('table.reorder');
Route::POST('transport/list', [ListtransportController::class, 'index'])->name('transport.update');

Route::any('trading/stockv2/ajax/{stockv2}', [StockController::class, 'showAjax'])->name('stockv2.ajax');

Route::any('trading/stockv2/card', [StockController::class, 'stockcardview'])->name('stockcardview');

Route::resource('trading/stock','OfferController');
Route::resource('trading/stockv2','StockController');
Route::resource('trading/products','ProductController');
Route::resource('trading/subproducts','SubProductController');

Route::resource('trading/offersent','OffersentController');

Route::POST('trading/buyerpref/morecardview', [BuyerprefController::class, 'loadMorePrefCardView'])->name('buyerpref.morecardview');

Route::POST('trading/deliveries/adminmoredeliveries', [DeliveryController::class, 'adminmoredeliveries'])->name('deliveries.adminmoredeliveries');

Route::POST('trading/stockv2/stockmorecardview', [StockController::class, 'stockmorecardview'])->name('stockv2.stockmorecardview');

Route::any('trading/buyerpref/cardview', [BuyerprefController::class, 'prefcardview'])->name('buyerpref.cardview');
Route::resource('trading/buyerpref','BuyerprefController');
Route::resource('trading/productspecs','ProductspecsController');
Route::resource('trading/productspecvalues','ProductspecvaluesController');
Route::resource('trading/warehouse','WarehouseController');
Route::get('trading/rejectedstock','OfferController@rejectedStock')->name('trading.rejectedstock');
Route::any('send_Invoice/{matchestemp}', [OffersentController::class, 'send_Invoice'])->name('matchestemp.send_Invoice');
Route::any('view_Invoice/{matchestemp}', [OffersentController::class, 'view_Invoice'])->name('matchestemp.view_Invoice');
Route::any('add_offersentnotes', [OffersentController::class, 'add_offersentnotes'])->name('matchestemp.add_offersentnotes');
Route::POST('get_offersentnotes','OffersentController@get_offersentnotes')->name('get_offersentnotes');
Route::any('add_makesalenotes', [MatchsController::class, 'add_makesalenotes'])->name('matchestemp.add_makesalenotes');
Route::POST('get_makesalenotes','MatchsController@get_makesalenotes')->name('get_makesalenotes');
Route::any('InvoiceSend/{match}', [MatchsController::class, 'InvoiceSend'])->name('matches.InvoiceSend');
Route::any('InvoiceView/{match}', [MatchsController::class, 'InvoiceView'])->name('matches.InvoiceView');
Route::any('InvoiceSendtoAll', [MatchsController::class, 'InvoiceSendtoAll'])->name('matches.InvoiceSendtoAll');
Route::any('getSpecsByProduct', [MatchsController::class, 'getSpecsByProduct'])->name('matches.getSpecsByProduct');
/*Route::resource('trading/requests','OfferRequestController', ['parameters' => ['requests' => 'offer_request']]);*/
Route::resource('trading/sales','SaleController');
Route::resource('trading/order2','SaleController');

Route::any('SaleInvoiceView/{sale}', [SaleController::class, 'InvoiceView'])->name('sales.SaleInvoiceView');
Route::resource('sellers','SellerController');
Route::resource('buyers','BuyerController');
Route::resource('affiliate','AffiliateController');
Route::resource('referrer','ReferrerController');
Route::get('usertracking', [UserIpsController::class, 'usertracking'])->name('user-ips.usertracking');
Route::resource('user-ips','UserIpsController');
Route::get('user-visits', [UserVisitsController::class, 'index'])->name('analytics.user-visits');
Route::get('contact', [ContactController::class, 'index'])->name('analytics.contact');
Route::any('exportExcel', [BuyerController::class, 'exportExcel'])->name('buyers.exportExcel');
Route::resource('appheads','AppHeadController');
Route::any('trading/matches/update-all','MatchsController@updateAll')->name('matches.updateAll');
Route::any('trading/matches/reloadOfferPrice','MatchsController@reloadOfferPrice')->name('matches.reloadOfferPrice');
Route::get('trading/matches/updatePton','MatchsController@updatePton')->name('matches.updatePton');
Route::resource('trading/matches','MatchsController');
Route::resource('trading/buyerleads','BuyerleadController');
Route::resource('trading/buyerproductrelation','BuyerProductRelationController');

Route::resource('transport/vehicles','VehicleController');
Route::resource('transport/loads','LoadController');
Route::resource('transport/postalcodes','PostalCodeController');
Route::resource('transport/carrier','CarrierController');

Route::resource('transport/list','ListtransportController');
Route::any('transport/deliveries/admindeliveries', [DeliveryController::class, 'admindeliveries'])->name('deliveries.admindeliveries');
Route::resource('transport/deliveries','DeliveryController');
Route::GET('transport/gettransload', [DeliveryController::class, 'getTransload'])->name('transport.gettransload');
Route::GET('deliveries/edit_deliveries/{id}', [DeliveryController::class, 'edit'])->name('deliveries.edit');
Route::GET('deliveries/index', [DeliveryController::class, 'index'])->name('deliveries.index');
Route::POST('deliveries/update', [DeliveryController::class, 'update'])->name('deliveries.update');

Route::POST('transport/deliveries/adminmoredeliveries', [DeliveryController::class, 'adminmoredeliveries'])->name('deliveries.adminmoredeliveries');

Route::POST('transport/Savetransload', [DeliveryController::class, 'Savetransload'])->name('transport.Savetransload');
Route::POST('transport/Saveuploadedfiles', [DeliveryController::class, 'Saveuploadedfiles'])->name('transport.Saveuploadedfiles');

//Route::POST('getsales','ListtransportController@getsales')->name('list.getsales');
//Route::POST('getsales', [ListtransportController::class, 'getsales'])->name('list.getsales');


Route::resource('transportcost','TransportcostController');
Route::get('transportcost','TransportcostController@index')->name('transportcost');

Route::resource('routeprices','RoutepriceController');
Route::get('routeprices/index', 'RoutepriceController@show')->name('routeprices.show');
Route::get('routeprices/create', 'RoutepriceController@create')->name('routeprices.create');
Route::post('routeprices/store', 'RoutepriceController@store')->name('routeprices.store');
Route::get('routeprices/edit/{id}', 'RoutepriceController@edit')->name('routeprices.edit');
Route::post('routeprices/update/{id}', 'RoutepriceController@update')->name('routeprices.update');
Route::post('routeprices/delete/{id}', 'RoutepriceController@destroy')->name('routeprices.delete');
Route::get('routeprices/view/{id}', 'RoutepriceController@view')->name('routeprices.view');

Route::get('region/show', 'RoutepriceController@add_route')->name('region.region_list');

Route::resource('region','RegionController');
Route::get('region/index', 'RegionController@show')->name('region.show');
Route::post('region/update/{id}', 'RegionController@update')->name('region.update');
Route::get('region/delete/{id}', 'RegionController@delete')->name('region.delete');
Route::resource('season','TransportseasonController');
Route::get('season/index','TransportseasonController@show')->name('season.show');
Route::get('season/create', 'TransportseasonController@create')->name('season.create');
Route::post('season/store', 'TransportseasonController@store')->name('season.store');
Route::get('season/edit/{id}', 'TransportseasonController@edit')->name('season.edit');
Route::post('season/update/{id}', 'TransportseasonController@update')->name('season.update');
Route::post('season/delete/{id}', 'TransportseasonController@destroy')->name('season.delete');
Route::get('season/view/{id}', 'TransportseasonController@view')->name('season.view');

Route::resource('transportprice','TransportpriceController');
Route::get('transportprice/index','TransportpriceController@show')->name('transportprice.show');
Route::get('transportprice/create', 'TransportpriceController@create')->name('transportprice.create');
Route::post('transportprice/store', 'TransportpriceController@store')->name('transportprice.store');
Route::get('transportprice/edit/{id}', 'TransportpriceController@edit')->name('transportprice.edit');
Route::post('transportprice/update/{id}', 'TransportpriceController@update')->name('transportprice.update');
Route::post('transportprice/delete/{id}', 'TransportpriceController@destroy')->name('transportprice.delete');
Route::get('transportprice/view/{id}', 'TransportpriceController@view')->name('transportprice.view');


Route::resource('transport/transportlist','TransportlistController');
Route::get('transport/addtransport','TransportlistController@addtransport')->name('transportlist.addtransport');
Route::POST('transport/uploadExcel','TransportlistController@uploadExcel')->name('transportlist.uploadExcel');
Route::POST('transport/savetransload','TransportlistController@savetransportload')->name('transportlist.savetransportload');

Route::POST('gettransportloads', [TransportlistController::class, 'gettransportloads'])->name('transportlist.gettransportloads');
Route::POST('downloadzip', [TransportlistController::class, 'downloadzip'])->name('transportlist.downloadzip');
Route::GET('transport/previewload/{id}', [TransportlistController::class, 'previewpdf'])->name('transportlist.previewpdf');
Route::POST('transport/sendloadpdf', [TransportlistController::class, 'sendloadpdf'])->name('transportlist.sendloadpdf');
Route::POST('updatetransportloadsajax', [TransportlistController::class, 'updatetransportloadsajax'])->name('transportlist.updatetransportloadsajax');
//Route::get('transport/transportlist/edittransport','TransportlistController@edittransport')->name('transportlist.edittransport');

Route::resource('setting','SettingController');
Route::resource('languagecontent','LanguageContentController');
Route::resource('messages','MessageController');
Route::resource('pages','PageController');
Route::get('accounts/buyer_templates',[AccountController::class, 'buyer_templates'])->name('accounts.buyer_templates');
Route::get('accounts/buyer_invoice_history',[AccountController::class, 'buyer_invoice_history'])->name('accounts.buyer_invoice_history');
Route::resource('accounts/purchaseorder','PurchaseOrderController');
Route::get('purchaseorder/confirm/{confirm}','PurchaseOrderController@confirm')->name('purchaseorder.confirm');
Route::get('purchaseorder/email_send/{id}','PurchaseOrderController@email_send')->name('purchaseorder.email_send');
Route::any('OrderInvoiceView/{order}', [AccountController::class, 'OrderInvoiceView'])->name('accounts.OrderInvoiceView');
Route::any('OrderInvoiceSend/{order}', [AccountController::class, 'OrderInvoiceSend'])->name('accounts.OrderInvoiceSend');
Route::resource('accounts/invoices','InvoiceController');
Route::GET('accounts/invoices/{invoice_id}/payment','InvoiceController@payment')->name('invoices.payment');
//Export Excel
Route::any('exports', [BuyerController::class,'exports'])->name('buyers.exports');
Route::any('exports', [SellerController::class,'exports'])->name('buyers.exports');
Route::any('offersentexports', [OffersentController::class,'offersentexports'])->name('offersent.offersentexports');
Route::any('stocksexports', [OfferController::class, 'stocksexports'])->name('stock.stocksexports');
Route::any('saleexports', [SaleController::class, 'saleexports'])->name('sales.saleexports');
Route::any('sales/saletotran', [SaleController::class, 'saletotran'])->name('sales.saletotran');
Route::any('matchesexports', [MatchsController::class, 'matchesexports'])->name('matches.matchesexports');
Route::any('buyerprefexports', [BuyerprefController::class, 'buyerprefexports'])->name('buyerpref.buyerprefexports');
Route::POST('create-buyer-pref', [BuyerprefController::class, 'storeajax'])->name('buyerpref.storeajax');
Route::any('sellerexports', [SellerController::class, 'sellerexports'])->name('sellers.sellerexports');
Route::any('transportexports', [TransportlistController::class, 'transportexports'])->name('sellers.transportexports');
Route::any('transportpdf', [TransportlistController::class, 'downloadpdf'])->name('sellers.downloadpdf');
Route::any('transportdoc', [TransportlistController::class, 'downloaddoc'])->name('sellers.downloaddoc');
Route::any('warehouseexports', [WarehouseController::class, 'warehouseexports'])->name('warehouse.warehouseexports');
Route::any('productsexports', [ProductController::class, 'productsexports'])->name('products.productsexports');
Route::any('product-spec-relation', [ProductController::class, 'productSpecRelation'])->name('products.productSpecRelation');
Route::any('product-spec-relation/create', [ProductController::class, 'productSpecRelationCreate'])->name('products.productSpecRelationCreate');
Route::any('product-spec-relation/store', [ProductController::class, 'productSpecRelationStore'])->name('products.productSpecRelationStore');
Route::any('productspecexports', [ProductspecsController::class, 'productspecexports'])->name('productspecs.productspecexports');
Route::any('productspecvaluesexports', [ProductspecvaluesController::class, 'productspecvaluesexports'])->name('productspecvalues.productspecvaluesexports');

//Import Excel
Route::post('stockimport', [OfferController::class, 'stockimport'])->name('stock.stockimport');

//Re-Order
Route::POST('product-spec-reorder-ajax', [ProductspecsController::class, 'reorder'])->name('productspec.reorder');

// Email Message email_templates
Route::POST('email-templates/headerFooter', [EmailTemplateController::class, 'headerFooter'])->name('email-templates.headerFooter');
Route::POST('email-templates/recipients', [EmailTemplateController::class, 'recipients'])->name('email-templates.recipients');
Route::GET('email-templates/header/{id}', [EmailTemplateController::class, 'header'])->name('email-templates.header');
Route::POST('email-templates/header-update', [EmailTemplateController::class, 'headerUpdate'])->name('email-templates.header-update');
Route::POST('email-templates/update_push', [EmailTemplateController::class, 'update_push'])->name('email-templates.update_push');
Route::resource('email-templates','EmailTemplateController');

// Business cards
Route::get('bizcards','BizcardsController@index')->name('bizcards');

// Get latest currencies

Route::POST('currency_rate', [CurrencyRateController::class, 'currencyRate'])->name('currencyRate');
Route::POST('get-stock', [StockController::class, 'getStock'])->name('get-stock');

/* START 13-02-2020*/
Route::resource('transport/transportlistimport','TransportListImportedController');
Route::POST('transport/getTransportList','TransportListImportedController@getTransportList')->name("getTransportList");
Route::POST('transport/uploadExcelFile','TransportListImportedController@uploadExcelFile')->name("uploadExcelFile");
/* END 13-02-2020*/

Route::POST('updateajax','BuyerprefController@updateAjax')->name('buyerpref.updateajax');
Route::GET('getVarity','ProductController@getVarity')->name('product.getVarity');
Route::GET('sellerSearch','SellerController@sellerSearch')->name('sellers.search');
Route::GET('buyerSearch','BuyerController@buyerSearch')->name('buyers.search');
Route::GET('getSeller','SellerController@getSeller')->name('seller.getSeller');

Route::get('account/confirm/resend', [UserConfirmationController::class, 'sendConfirmationEmail'])->name('user.account.confirm.resend');
