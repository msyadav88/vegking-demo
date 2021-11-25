<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.translations', function ($trail) {
    $trail->push(__('strings.backend.translations.title'), route('admin.translations'));
});

Breadcrumbs::for('admin.import_buyer', function ($trail) {
    $trail->push(__('strings.backend.import_buyer.title'), route('admin.import_buyer'));
});

Breadcrumbs::for('admin.import_seller', function ($trail) {
    $trail->push(__('strings.backend.import_seller.title'), route('admin.import_seller'));
});
Breadcrumbs::for('admin.import_parse', function ($trail) {
    $trail->push(__('strings.backend.import_seller.title'), route('admin.import_parse'));
});
Breadcrumbs::for('admin.import_product', function ($trail) {
    $trail->push(__('strings.backend.import_product.title'), route('admin.import_product'));
});
Breadcrumbs::for('admin.stock.index', function ($trail) {
    $trail->push(__('menus.backend.trading.offers.all'), route('admin.stock.index'));
});

Breadcrumbs::for('admin.stock.create', function ($trail) {
    $trail->push(__('menus.backend.trading.offers.all'), route('admin.stock.index'));
    $trail->push(__('menus.backend.trading.offers.create'), route('admin.stock.create'));
});

Breadcrumbs::for('admin.stock.show', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.offers.all'), route('admin.stock.index'));
    $trail->push(__('menus.backend.trading.offers.show').' #'.$offer, route('admin.stock.show', $offer));
});

Breadcrumbs::for('admin.stock.edit', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.offers.all'), route('admin.stock.index'));
    $trail->push(__('menus.backend.trading.offers.edit'), route('admin.stock.edit', $offer));
});

Breadcrumbs::for('admin.products.index', function ($trail) {
    $trail->push(__('menus.backend.trading.products.all'), route('admin.products.index'));
});

Breadcrumbs::for('admin.products.create', function ($trail) {
    $trail->push(__('menus.backend.trading.products.all'), route('admin.products.index'));
    $trail->push(__('menus.backend.trading.products.create'), route('admin.products.create'));
});

Breadcrumbs::for('admin.products.show', function ($trail, $product) {
    $trail->push(__('menus.backend.trading.products.all'), route('admin.products.index'));
    $trail->push(__('menus.backend.trading.products.show').' #'.$product->id, route('admin.products.show', $product->id));
});

Breadcrumbs::for('admin.products.edit', function ($trail, $product) {
    $trail->push(__('menus.backend.trading.products.all'), route('admin.products.index'));
    $trail->push(__('menus.backend.trading.products.edit'), route('admin.products.edit', $product));
});

Breadcrumbs::for('admin.subproducts.index', function ($trail) {
    $trail->push(__('menus.backend.trading.subproducts.all'), route('admin.subproducts.index'));
});

Breadcrumbs::for('admin.subproducts.create', function ($trail) {
    $trail->push(__('menus.backend.trading.subproducts.all'), route('admin.subproducts.index'));
    $trail->push(__('menus.backend.trading.subproducts.create'), route('admin.subproducts.create'));
});

Breadcrumbs::for('admin.subproducts.show', function ($trail, $product) {
    $trail->push(__('menus.backend.trading.subproducts.all'), route('admin.subproducts.index'));
    $trail->push(__('menus.backend.trading.subproducts.show').' #'.$product->id, route('admin.subproducts.show', $product->id));
});

Breadcrumbs::for('admin.subproducts.edit', function ($trail, $product) {
    $trail->push(__('menus.backend.trading.subproducts.all'), route('admin.subproducts.index'));
    $trail->push(__('menus.backend.trading.subproducts.edit'), route('admin.subproducts.edit', $product));
});

Breadcrumbs::for('admin.requests.index', function ($trail) {
    $trail->push(__('menus.backend.trading.requests.all'), route('admin.requests.index'));
});

Breadcrumbs::for('admin.requests.create', function ($trail) {
    $trail->push(__('menus.backend.trading.requests.all'), route('admin.requests.index'));
    $trail->push(__('menus.backend.trading.requests.create'), route('admin.requests.create'));
});

Breadcrumbs::for('admin.requests.show', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.requests.all'), route('admin.requests.index'));
    $trail->push(__('menus.backend.trading.requests.show').' #'.$request->id, route('admin.requests.show', $request->id));
});

Breadcrumbs::for('admin.requests.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.requests.all'), route('admin.requests.index'));
    $trail->push(__('menus.backend.trading.requests.edit'), route('admin.requests.edit', $request->id));
});

Breadcrumbs::for('admin.sales.index', function ($trail) {
    $trail->push(__('menus.backend.trading.sales.all'), route('admin.sales.index'));
});

Breadcrumbs::for('admin.sales.create', function ($trail) {
    $trail->push(__('menus.backend.trading.sales.all'), route('admin.sales.index'));
    $trail->push(__('menus.backend.trading.sales.create'), route('admin.sales.create'));
});

Breadcrumbs::for('admin.sales.show', function ($trail, $sale) {
    $trail->push(__('menus.backend.trading.sales.all'), route('admin.sales.index'));
    $trail->push(__('menus.backend.trading.sales.show').' #'.$sale, route('admin.sales.show', $sale));
});

Breadcrumbs::for('admin.sales.edit', function ($trail, $sale) {
    $trail->push(__('menus.backend.trading.sales.all'), route('admin.sales.index'));
    $trail->push(__('menus.backend.trading.sales.edit'), route('admin.sales.edit', $sale));
});

Breadcrumbs::for('admin.vehicles.index', function ($trail) {
    $trail->push('Vehicles', route('admin.vehicles.index'));
});

Breadcrumbs::for('admin.loads.index', function ($trail) {
    $trail->push('Loads', route('admin.loads.index'));
});

Breadcrumbs::for('admin.sellers.index', function ($trail) {
    $trail->push('Sellers', route('admin.sellers.index'));
});

Breadcrumbs::for('admin.sellers.create', function ($trail) {
    $trail->push('Sellers', route('admin.sellers.index'));
    $trail->push('Add Seller', route('admin.sellers.create'));
});

Breadcrumbs::for('admin.sellers.show', function ($trail, $seller) {
    $trail->push('Sellers', route('admin.sellers.index'));
    $trail->push('Show Seller #'.$seller, route('admin.sellers.show', $seller));
});

Breadcrumbs::for('admin.sellers.edit', function ($trail, $seller) {
    $trail->push('Seller', route('admin.sellers.index'));
    $trail->push('Edit Seller', route('admin.sellers.edit', $seller));
});

Breadcrumbs::for('admin.buyers.index', function ($trail) {
    $trail->push('Buyers', route('admin.buyers.index'));
});

Breadcrumbs::for('admin.buyers.create', function ($trail) {
    $trail->push('Buyers', route('admin.buyers.index'));
    $trail->push('Add Buyer', route('admin.buyers.create'));
});
Breadcrumbs::for('admin.affiliate.index', function ($trail) {
    $trail->push('Affiliate', route('admin.affiliate.index'));
});
Breadcrumbs::for('admin.referrer.index', function ($trail) {
    $trail->push('Referrer', route('admin.referrer.index'));
});
Breadcrumbs::for('admin.user-ips.index', function ($trail) {
    $trail->push('User Ips', route('admin.user-ips.index'));
});
Breadcrumbs::for('admin.user-ips.usertracking', function ($trail) {
    $trail->push('User Tracking', route('admin.user-ips.usertracking'));
});
Breadcrumbs::for('admin.bizcards', function ($trail) {
    $trail->push('Business Cards', route('admin.bizcards'));
});
Breadcrumbs::for('admin.analytics.user-visits', function ($trail) {
    $trail->push('User Visits', route('admin.analytics.user-visits'));
});
Breadcrumbs::for('admin.analytics.contact', function ($trail) {
    $trail->push('Contact', route('admin.analytics.contact'));
});
Breadcrumbs::for('admin.buyers.show', function ($trail, $buyer) {
    $trail->push(__('Buyers'), route('admin.buyers.index'));
    $trail->push('Show Buyer #'.$buyer, route('admin.buyers.show', $buyer));
});

Breadcrumbs::for('admin.buyers.edit', function ($trail, $buyer) {
    $trail->push('Buyers', route('admin.buyers.index'));
    $trail->push('Edit Buyer', route('admin.buyers.edit', $buyer));
});

Breadcrumbs::for('admin.appheads.index', function ($trail) {
    $trail->push('Heads', route('admin.appheads.index'));
});

Breadcrumbs::for('admin.appheads.create', function ($trail) {
    $trail->push('Heads', route('admin.appheads.index'));
    $trail->push('Add Head', route('admin.appheads.create'));
});

Breadcrumbs::for('admin.appheads.edit', function ($trail, $apphead) {
    $trail->push('Edit Head', route('admin.appheads.index'));
    $trail->push('Edit Head', route('admin.appheads.edit', $apphead));
});


Breadcrumbs::for('admin.offersent.index', function ($trail) {
    $trail->push(__('menus.backend.trading.offersent.all'), route('admin.offersent.index'));
});

//Order2 start
Breadcrumbs::for('admin.order2.index', function ($trail) {
    $trail->push(__('menus.backend.trading.order2.all'), route('admin.order2.index'));
});

Breadcrumbs::for('admin.order2.create', function ($trail) {
    $trail->push(__('menus.backend.trading.order2.all'), route('admin.order2.index'));
    $trail->push(__('menus.backend.trading.order2.create'), route('admin.order2.create'));
});

Breadcrumbs::for('admin.order2.show', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.order2.all'), route('admin.order2.index'));
    $trail->push(__('menus.backend.trading.order2.show').' #'.$request->id, route('admin.order2.show', $request->id));
});

Breadcrumbs::for('admin.order2.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.order2.all'), route('admin.order2.index'));
    $trail->push(__('menus.backend.trading.order2.edit'), route('admin.order2.edit', $request->id));
});
//Order2 End

//Buyer Pref start
Breadcrumbs::for('admin.buyerpref.index', function ($trail) {
    $trail->push(__('menus.backend.trading.buyerpref.all'), route('admin.buyerpref.index'));
});

Breadcrumbs::for('admin.buyerpref.create', function ($trail) {
    $trail->push(__('menus.backend.trading.buyerpref.all'), route('admin.buyerpref.index'));
    $trail->push(__('menus.backend.trading.buyerpref.create'), route('admin.buyerpref.create'));
});

Breadcrumbs::for('admin.buyerpref.show', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.buyerpref.all'), route('admin.buyerpref.index'));
    $trail->push(__('menus.backend.trading.buyerpref.show').' #'.$request, route('admin.buyerpref.show', $request));
});

Breadcrumbs::for('admin.buyerpref.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.buyerpref.all'), route('admin.buyerpref.index'));
    $trail->push(__('menus.backend.trading.buyerpref.edit'), route('admin.buyerpref.edit', $request));
});

Breadcrumbs::for('buyer.buyerpref.index', function ($trail) {
    $trail->push(__('menus.backend.trading.buyerpref.all'), route('buyer.buyerpref.index'));
});

Breadcrumbs::for('buyer.buyerpref.create', function ($trail) {
    $trail->push(__('menus.backend.trading.buyerpref.all'), route('buyer.buyerpref.index'));
    $trail->push(__('menus.backend.trading.buyerpref.create'), route('buyer.buyerpref.create'));
});

Breadcrumbs::for('buyer.buyerpref.show', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.buyerpref.all'), route('buyer.buyerpref.index'));
    $trail->push(__('menus.backend.trading.buyerpref.show').' #'.$request, route('buyer.buyerpref.show', $request));
});

Breadcrumbs::for('buyer.buyerpref.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.buyerpref.all'), route('buyer.buyerpref.index'));
    $trail->push(__('menus.backend.trading.buyerpref.edit'), route('buyer.buyerpref.edit', $request));
});
Breadcrumbs::for('buyer.buyerpref.cardview', function ($trail) {
    $trail->push(__('Buyer Prefs'), route('buyer.buyerpref.cardview'));
});

Breadcrumbs::for('admin.buyerpref.cardview', function ($trail) {
    $trail->push(__('Buyer Prefs'), route('admin.buyerpref.cardview'));
});
//Buyer Pref End

//Buyer Lead start
Breadcrumbs::for('admin.buyerleads.index', function ($trail) {
    $trail->push('Buyer Leads', route('admin.buyerleads.index'));
});
Breadcrumbs::for('admin.buyerleads.show', function ($trail, $request) {
    $trail->push('Buyer Leads', route('admin.buyerleads.index'));
    $trail->push('Show Buyer Lead #'.$request, route('admin.buyerleads.show', $request));
});
//Buyer Lead End

//Product Specs start
Breadcrumbs::for('admin.productspecs.index', function ($trail) {
    $trail->push(__('menus.backend.trading.productspecs.all'), route('admin.productspecs.index'));
});

Breadcrumbs::for('admin.productspecs.create', function ($trail) {
    $trail->push(__('menus.backend.trading.productspecs.all'), route('admin.productspecs.index'));
    $trail->push(__('menus.backend.trading.productspecs.create'), route('admin.productspecs.create'));
});

Breadcrumbs::for('admin.productspecs.show', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.productspecs.all'), route('admin.productspecs.index'));
    $trail->push(__('menus.backend.trading.productspecs.show').' #'.$request, route('admin.productspecs.show', $request));
});

Breadcrumbs::for('admin.productspecs.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.productspecs.all'), route('admin.productspecs.index'));
    $trail->push(__('menus.backend.trading.productspecs.edit'), route('admin.productspecs.edit', $request   ));
});
//Buyer Pref End
Breadcrumbs::for('admin.warehouse.index', function ($trail) {
    $trail->push('Warehouse', route('admin.warehouse.index'));
});
//Rejected Stock
Breadcrumbs::for('admin.trading.rejectedstock', function ($trail) {
    $trail->push('Rejected Stock', route('admin.trading.rejectedstock'));
});


Breadcrumbs::for('admin.productspecvalues.index', function ($trail) {
    $trail->push(__('menus.backend.trading.productspecvalues.all'), route('admin.productspecvalues.index'));
});


Breadcrumbs::for('admin.productspecvalues.create', function ($trail) {
    $trail->push(__('menus.backend.trading.productspecvalues.all'), route('admin.productspecvalues.index'));
    $trail->push(__('menus.backend.trading.productspecvalues.create'), route('admin.productspecvalues.create'));
});

Breadcrumbs::for('admin.productspecvalues.show', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.productspecvalues.all'), route('admin.productspecvalues.index'));
    $trail->push(__('menus.backend.trading.productspecvalues.show').' #'.$request, route('admin.productspecvalues.show', $request));
});

Breadcrumbs::for('admin.productspecvalues.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.productspecvalues.all'), route('admin.productspecvalues.index'));
    $trail->push(__('menus.backend.trading.productspecvalues.edit'), route('admin.productspecvalues.edit', $request));
});




Breadcrumbs::for('admin.orders.index', function ($trail) {
    $trail->push(__('menus.backend.trading.orders.all'), route('admin.orders.index'));
});

Breadcrumbs::for('admin.orders.create', function ($trail) {
    $trail->push(__('menus.backend.trading.orders.all'), route('admin.orders.index'));
    $trail->push(__('menus.backend.trading.orders.create'), route('admin.orders.create'));
});

Breadcrumbs::for('admin.orders.show', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.orders.all'), route('admin.orders.index'));
    $trail->push(__('menus.backend.trading.orders.show').' #'.$request->id, route('admin.orders.show', $request->id));
});

Breadcrumbs::for('admin.orders.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.orders.all'), route('admin.orders.index'));
    $trail->push(__('menus.backend.trading.orders.edit'), route('admin.orders.edit', $request->id));
});


Breadcrumbs::for('admin.matches.index', function ($trail) {
    $trail->push('Matches', route('admin.matches.index'));
});

Breadcrumbs::for('admin.matches.create', function ($trail) {
    $trail->push(__('menus.backend.trading.offers.all'), route('admin.matches.index'));
    $trail->push(__('menus.backend.trading.offers.create'), route('admin.matches.create'));
});

Breadcrumbs::for('admin.matches.show', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.offers.all'), route('admin.matches.index'));
    $trail->push(__('menus.backend.trading.offers.show').' #'.$offer->id, route('admin.matches.show', $offer->id));
});

Breadcrumbs::for('admin.matches.edit', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.offers.all'), route('admin.matches.index'));
    $trail->push(__('menus.backend.trading.offers.edit'), route('admin.matches.edit', $offer));
});


Breadcrumbs::for('admin.postalcodes.index', function ($trail) {
    $trail->push('Postal Codes', route('admin.postalcodes.index'));
});

Breadcrumbs::for('admin.carrier.index', function ($trail) {
    $trail->push('Carrier', route('admin.carrier.index'));
});

Breadcrumbs::for('admin.postalcodes.create', function ($trail) {
    $trail->push('Postal Codes', route('admin.postalcodes.index'));
    $trail->push('Add Postal Codes', route('admin.postalcodes.create'));
});

Breadcrumbs::for('admin.carrier.create', function ($trail) {
    $trail->push('Carrier', route('admin.carrier.index'));
    $trail->push('Add Carrier', route('admin.carrier.create'));
});

Breadcrumbs::for('admin.carrier.show', function ($trail, $carrier) {
    $trail->push('carrier', route('admin.carrier.index'));
    $trail->push('carrier #'.$carrier, route('admin.carrier.show', $carrier));
});

Breadcrumbs::for('admin.postalcodes.show', function ($trail, $postalcode) {
    $trail->push('Postal Codes', route('admin.postalcodes.index'));
    $trail->push('Postal Codes #'.$postalcode->id, route('admin.postalcodes.show', $postalcode->id));
});
Breadcrumbs::for('admin.list.index', function ($trail) {
    $trail->push('Transport List', route('admin.list.index'));
});
Breadcrumbs::for('admin.transportlist.addtransport', function ($trail) {
    $trail->push('Transport List', route('admin.transportlist.addtransport'));
});

Breadcrumbs::for('admin.transportlist.index', function ($trail) {
    $trail->push('Transport List', route('admin.transportlist.index'));
});



Breadcrumbs::for('admin.transportlist.edit', function ($trail, $id) {
	
    $trail->push('Transport Edit', route('admin.transportlist.edit',$id));
});

Breadcrumbs::for('admin.deliveries.index', function ($trail) {
    $trail->push('Transport List', route('admin.deliveries.index'));
});
Breadcrumbs::for('admin.deliveries.edit', function ($trail,$id) {
    $trail->push('Deliveries Edit', route('admin.deliveries.edit',$id));
});
Breadcrumbs::for('trader.deliveries.edit', function ($trail,$id) {
    $trail->push('Deliveries Edit', route('trader.deliveries.edit',$id));
});

Breadcrumbs::for('buyer.deliveries.buyerdeliveries', function ($trail) {
    $trail->push('Delivery Card View', route('buyer.deliveries.buyerdeliveries'));
});

Breadcrumbs::for('admin.deliveries.admindeliveries', function ($trail) {
    $trail->push('Delivery Card View', route('admin.deliveries.admindeliveries'));
});

Breadcrumbs::for('trader.deliveries.traderdeliveries', function ($trail) {
    $trail->push('Delivery Card View', route('trader.deliveries.traderdeliveries'));
});

Breadcrumbs::for('seller.deliveries.sellerdeliveries', function ($trail) {
    $trail->push('Delivery Card View', route('seller.deliveries.sellerdeliveries'));
});

Breadcrumbs::for('admin.postalcodes.edit', function ($trail, $postalcode) {
    $trail->push('Postal Codes', route('admin.postalcodes.index'));
    $trail->push('Edit Postal Codes', route('admin.postalcodes.edit', $postalcode));
});

Breadcrumbs::for('admin.carrier.edit', function ($trail, $carrier) {
    $trail->push('Carrier', route('admin.carrier.index'));
    $trail->push('Edit Carrier', route('admin.carrier.edit', $carrier));
});

Breadcrumbs::for('admin.setting.index', function ($trail) {
    $trail->push(__('Setting'), route('admin.setting.index'));
});
Breadcrumbs::for('admin.pages.index', function ($trail) {
    $trail->push(__('menus.backend.trading.pages.all'), route('admin.pages.index'));
});

Breadcrumbs::for('admin.pages.create', function ($trail) {
    $trail->push(__('menus.backend.trading.pages.all'), route('admin.pages.index'));
    $trail->push(__('menus.backend.trading.pages.create'), route('admin.pages.create'));
});
Breadcrumbs::for('admin.pages.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.trading.pages.all'), route('admin.pages.index'));
    $trail->push(__('menus.backend.trading.pages.edit'), route('admin.pages.edit', $request));
});

Breadcrumbs::for('admin.messages.index', function ($trail) {
    $trail->push('Messages', route('admin.messages.index'));
});

Breadcrumbs::for('admin.languagecontent.index', function ($trail) {
    $trail->push('Loads', route('admin.languagecontent.index'));
});
//SELLER
Breadcrumbs::for('seller.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('seller.dashboard'));
});

Breadcrumbs::for('seller.offersent.index', function ($trail) {
    $trail->push(__('menus.backend.trading.offersent.all'), route('seller.offersent.index'));
});

Breadcrumbs::for('seller.stock.index', function ($trail) {
    $trail->push(__('menus.backend.trading.offers.all'), route('seller.stock.index'));
});

Breadcrumbs::for('seller.stock.create', function ($trail) {
    $trail->push(__('menus.backend.trading.offers.all'), route('seller.stock.index'));
    $trail->push(__('menus.backend.trading.offers.create'), route('seller.stock.create'));
});

Breadcrumbs::for('seller.stock.show', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.offers.all'), route('seller.stock.index'));
    $trail->push(__('menus.backend.trading.offers.show').' #'.$offer, route('seller.stock.show', $offer));
});

Breadcrumbs::for('seller.stock.edit', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.offers.all'), route('seller.stock.index'));
    $trail->push(__('menus.backend.trading.offers.edit'), route('seller.stock.edit', $offer));
});

Breadcrumbs::for('seller.matches.index', function ($trail) {
    $trail->push('Matches', route('seller.matches.index'));
});

Breadcrumbs::for('seller.matches.create', function ($trail) {
    $trail->push(__('menus.backend.trading.offers.all'), route('seller.matches.index'));
    $trail->push(__('menus.backend.trading.offers.create'), route('seller.matches.create'));
});

Breadcrumbs::for('seller.matches.show', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.offers.all'), route('seller.matches.index'));
    $trail->push(__('menus.backend.trading.offers.show').' #'.$offer->id, route('seller.matches.show', $offer->id));
});

Breadcrumbs::for('seller.matches.edit', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.offers.all'), route('seller.matches.index'));
    $trail->push(__('menus.backend.trading.offers.edit'), route('seller.matches.edit', $offer));
});

Breadcrumbs::for('seller.buyers.index', function ($trail) {
    $trail->push('Buyers', route('seller.buyers.index'));
});

Breadcrumbs::for('seller.buyers.create', function ($trail) {
    $trail->push('Buyers', route('seller.buyers.index'));
    $trail->push('Add Buyer', route('seller.buyers.create'));
});

Breadcrumbs::for('seller.buyers.show', function ($trail, $buyer) {
    $trail->push(__('Buyers'), route('seller.buyers.index'));
    $trail->push('Show Buyer #'.$buyer, route('seller.buyers.show', $buyer));
});

Breadcrumbs::for('seller.buyers.edit', function ($trail, $buyer) {
    $trail->push('Buyers', route('seller.buyers.index'));
    $trail->push('Edit Buyer', route('seller.buyers.edit', $buyer));
});

Breadcrumbs::for('seller.sellers.index', function ($trail) {
    $trail->push('Sellers', route('seller.sellers.index'));
});

Breadcrumbs::for('seller.sellers.create', function ($trail) {
    $trail->push('Sellers', route('seller.sellers.index'));
    $trail->push('Add Seller', route('seller.sellers.create'));
});

Breadcrumbs::for('seller.sellers.show', function ($trail, $seller) {
    $trail->push('Sellers', route('seller.sellers.index'));
    $trail->push('Show Seller #'.$seller, route('seller.sellers.show', $seller));
});

Breadcrumbs::for('seller.sellers.edit', function ($trail, $seller) {
    $trail->push('Seller', route('seller.sellers.index'));
    $trail->push('Edit Seller', route('seller.sellers.edit', $seller));
});

Breadcrumbs::for('admin.currencyrates.index', function ($trail) {
    $trail->push('Currency Rate', route('admin.currencyrates.index'));
});

Breadcrumbs::for('admin.currencyrates.create', function ($trail) {
    $trail->push('Currency Rate', route('admin.currencyrates.index'));
    $trail->push('Add Currency Rate', route('admin.currencyrates.create'));
});

Breadcrumbs::for('admin.currencyrates.edit', function ($trail, $apphead) {
    $trail->push('Currency Rate', route('admin.currencyrates.index'));
    $trail->push('Edit Currency Rate', route('admin.currencyrates.edit', $apphead));
});

//admin accounts
Breadcrumbs::for('admin.purchaseorder.index', function ($trail) {
    $trail->push(__('menus.backend.accounts.purchaseorder.all'), route('admin.purchaseorder.index'));
});
Breadcrumbs::for('admin.purchaseorder.create', function ($trail) {
    $trail->push(__('menus.backend.accounts.purchaseorder.all'), route('admin.purchaseorder.index'));
    $trail->push(__('menus.backend.accounts.purchaseorder.create'), route('admin.purchaseorder.create'));
});
Breadcrumbs::for('admin.purchaseorder.show', function ($trail, $request) {
    $trail->push(__('menus.backend.accounts.purchaseorder.all'), route('admin.purchaseorder.index'));
    $trail->push(__('menus.backend.accounts.purchaseorder.show').' #'.$request->id, route('admin.purchaseorder.show', $request->id));
});
Breadcrumbs::for('admin.purchaseorder.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.accounts.purchaseorder.all'), route('admin.purchaseorder.index'));
    $trail->push(__('menus.backend.accounts.purchaseorder.edit'), route('admin.purchaseorder.edit', $request
));
});

//seller accounts
Breadcrumbs::for('seller.purchaseorder.index', function ($trail) {
    $trail->push(__('menus.backend.accounts.purchaseorder.all'), route('seller.purchaseorder.index'));
});
Breadcrumbs::for('seller.purchaseorder.create', function ($trail) {
    $trail->push(__('menus.backend.accounts.purchaseorder.all'), route('seller.purchaseorder.index'));
    $trail->push(__('menus.backend.accounts.purchaseorder.create'), route('seller.purchaseorder.create'));
});
Breadcrumbs::for('seller.purchaseorder.show', function ($trail, $request) {
    $trail->push(__('menus.backend.accounts.purchaseorder.all'), route('seller.purchaseorder.index'));
    $trail->push(__('menus.backend.accounts.purchaseorder.show').' #'.$request->id, route('seller.purchaseorder.show', $request->id));
});
Breadcrumbs::for('seller.purchaseorder.edit', function ($trail, $request) {
    $trail->push(__('menus.backend.accounts.purchaseorder.all'), route('seller.purchaseorder.index'));
    $trail->push(__('menus.backend.accounts.purchaseorder.edit'), route('seller.purchaseorder.edit', $request));
});

//admin invoices
Breadcrumbs::for('admin.invoices.index', function ($trail) {
    $trail->push(__('menus.backend.accounts.invoices.all'), route('admin.invoices.index'));
});
Breadcrumbs::for('admin.invoices.create', function ($trail) {
    $trail->push(__('menus.backend.accounts.invoices.all'), route('admin.invoices.index'));
    $trail->push(__('menus.backend.accounts.invoices.create'), route('admin.invoices.create'));
});
Breadcrumbs::for('admin.invoices.show', function ($trail, $request) {
    $trail->push(__('menus.backend.accounts.invoices.all'), route('admin.invoices.index'));
    $trail->push(__('menus.backend.accounts.invoices.show').' #'.$request->id, route('admin.invoices.show', $request->id));
});
Breadcrumbs::for('admin.invoices.payment', function ($trail, $request) {
    $trail->push(__('menus.backend.accounts.invoices.all'), route('admin.invoices.index'));
    $trail->push(__('menus.backend.accounts.invoices.payment'), route('admin.invoices.payment', $request));
});

Breadcrumbs::for('admin.profile.edit', function ($trail, $request) {
$trail->push(__('Edit Profile'), route('admin.profile.edit', $request));
});

Breadcrumbs::for('trader.profile.edit', function ($trail, $request) {
$trail->push(__('Edit Profile'), route('trader.profile.edit', $request));
});

//seller invoices

Breadcrumbs::for('seller.invoices.index', function ($trail) {
    $trail->push(__('menus.backend.accounts.invoices.all'), route('seller.invoices.index'));
});
Breadcrumbs::for('seller.invoices.create', function ($trail) {
    $trail->push(__('menus.backend.accounts.invoices.all'), route('seller.invoices.index'));
    $trail->push(__('menus.backend.accounts.invoices.create'), route('seller.invoices.create'));
});
Breadcrumbs::for('seller.invoices.show', function ($trail, $request) {
    $trail->push(__('menus.backend.accounts.invoices.all'), route('seller.invoices.index'));
    $trail->push(__('menus.backend.accounts.invoices.show').' #'.$request->id, route('seller.invoices.show', $request->id));
});
Breadcrumbs::for('seller.invoices.payment', function ($trail, $request) {
    $trail->push(__('menus.backend.accounts.invoices.all'), route('seller.invoices.index'));
    $trail->push(__('menus.backend.accounts.invoices.payment'), route('seller.invoices.payment', $request));
});
// Seller Profile edit
Breadcrumbs::for('seller.user.edit', function ($trail, $request) {
    $trail->push(__('Edit Profile'), route('seller.user.edit', $request));
});

//Email Templates
Breadcrumbs::for('admin.email-templates.index', function ($trail) {
    $trail->push(__('Message Templates'), route('admin.email-templates.index'));
});
Breadcrumbs::for('admin.email-templates.create', function ($trail) {
    $trail->push(__('Message Templates'), route('admin.email-templates.index'));
    $trail->push(__('Create Message Template'), route('admin.email-templates.create'));
});
Breadcrumbs::for('admin.email-templates.edit', function ($trail, $request) {
    $trail->push(__('Message Templates'), route('admin.email-templates.index'));
    $trail->push(__('Edit Message Template'), route('admin.email-templates.edit', $request));
});
Breadcrumbs::for('admin.email-templates.header', function ($trail, $request) {
    $trail->push(__('Header Message Template'), url('admin/email-templates/header'));
    $trail->push(__('Header Message Template'), url('admin/email-templates/header', $request));
});

// BUYER
Breadcrumbs::for('buyer.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('buyer.dashboard'));
});
Breadcrumbs::for('buyer.deliveries.index', function ($trail) {
    $trail->push('Transport List', route('buyer.deliveries.index'));
});

// Buyer Profile edit
Breadcrumbs::for('buyer.user.edit', function ($trail, $request) {
    $trail->push(__('Edit Profile'), route('buyer.user.edit', $request));
});


Breadcrumbs::for('admin.stockv2.create', function ($trail) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('admin.stockv2.index'));
    $trail->push(__('menus.backend.trading.stockv2.create'), route('admin.stockv2.create'));
});

Breadcrumbs::for('admin.stockv2.index', function ($trail) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('admin.stockv2.index'));
    
});

Breadcrumbs::for('admin.stockv2.show', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('admin.stockv2.index'));
    $trail->push(__('menus.backend.trading.stockv2.show').' #'.$offer->id, route('admin.stockv2.show', $offer->id));
});

Breadcrumbs::for('admin.stockv2.edit', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('admin.stockv2.index'));
    $trail->push(__('menus.backend.trading.stockv2.edit'), route('admin.stockv2.edit', $offer->id));
});

Breadcrumbs::for('admin.stockcardview', function ($trail) {
    $trail->push(__('menus.backend.trading.offers.all'), route('admin.stockcardview'));
});

Breadcrumbs::for('seller.stockv2.create', function ($trail) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('seller.stockv2.index'));
    $trail->push(__('menus.backend.trading.stockv2.create'), route('seller.stockv2.create'));
});

Breadcrumbs::for('seller.stockv2.index', function ($trail) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('seller.stockv2.index'));
    
});

Breadcrumbs::for('seller.stockcardview', function ($trail) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('seller.stockcardview'));
});

Breadcrumbs::for('buyer.stockv2.buyerdeliveries', function ($trail) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('buyer.stockv2.buyerdeliveries'));
});

Breadcrumbs::for('seller.stockv2.sellerdeliveries', function ($trail) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('seller.stockv2.sellerdeliveries'));
});

Breadcrumbs::for('seller.sales.index', function ($trail) {
    $trail->push(__('menus.backend.trading.sales.all'), route('seller.sales.index'));
});

Breadcrumbs::for('seller.stockv2.show', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('seller.stockv2.index'));
    $trail->push(__('menus.backend.trading.stockv2.show').' #'.$offer->id, route('seller.stockv2.show', $offer->id));
});

Breadcrumbs::for('seller.stockv2.edit', function ($trail, $offer) {
    $trail->push(__('menus.backend.trading.stockv2.all'), route('seller.stockv2.index'));
    $trail->push(__('menus.backend.trading.stockv2.edit'), route('seller.stockv2.edit', $offer->id));
});

Breadcrumbs::for('seller.transportlist.index', function ($trail) {
    $trail->push('Transport List', route('seller.transportlist.index'));
});

Breadcrumbs::for('seller.transportlist.addtransport', function ($trail) {
    $trail->push('Transport List', route('seller.transportlist.addtransport'));
});

Breadcrumbs::for('seller.transportlist.edit', function ($trail, $id) {
	
    $trail->push('Transport Edit', route('seller.transportlist.edit',$id));
});

Breadcrumbs::for('seller.deliveries.index', function ($trail) {
    $trail->push('Transport List', route('seller.deliveries.index'));
});

// trader

Breadcrumbs::for('trader.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('trader.dashboard'));
});

Breadcrumbs::for('trader.deliveries.index', function ($trail) {
    $trail->push('Transport List', route('trader.deliveries.index'));
});

Breadcrumbs::for('admin.buyerproductrelation', function ($trail) {
    $trail->push('Product Spec Relation', route('admin.products.productSpecRelation'));
});

Breadcrumbs::for('admin.buyerproductrelation.create', function ($trail) {
    $trail->push('Product Spec Relation', route('admin.buyerproductrelation.create'));
});



Breadcrumbs::for('admin.transportlistimport.addtransport', function ($trail) {
    $trail->push('Transport List', route('admin.transportlistimport.addtransport'));
});

//route prices
Breadcrumbs::for('admin.routeprices.index', function ($trail) {
    $trail->push('Route Prices', route('admin.routeprices.index'));
});
Breadcrumbs::for('admin.routeprices.create', function ($trail) {
    $trail->push('Route Prices', route('admin.routeprices.index'));
    $trail->push('Add Route Price', route('admin.routeprices.create'));
});
Breadcrumbs::for('admin.routeprices.edit', function ($trail, $routeprice) {
    $trail->push('Route Prices', route('admin.routeprices.index'));
    $trail->push('Edit Route Price #'.$routeprice, route('admin.routeprices.edit', $routeprice));
});
Breadcrumbs::for('admin.routeprices.view', function ($trail, $routeprice) {
    $trail->push('Route Prices', route('admin.routeprices.index'));
    $trail->push('Edit Route Price #'.$routeprice, route('admin.routeprices.view', $routeprice));
});

// transport season
Breadcrumbs::for('admin.season.index', function ($trail) {
    $trail->push('Transport Country Season', route('admin.season.index'));
});
Breadcrumbs::for('admin.season.create', function ($trail) {
    $trail->push('Transport Country Season', route('admin.season.show'));
    $trail->push('Add Transport Country Season', route('admin.season.create'));
});
Breadcrumbs::for('admin.season.edit', function ($trail, $season) {
    $trail->push('Transport Country Season', route('admin.season.show'));
    $trail->push('Edit Transport Country Season #'.$season, route('admin.season.edit', $season));
});
Breadcrumbs::for('admin.season.view', function ($trail, $season) {
    $trail->push('Transport Country Season', route('admin.season.show'));
    $trail->push('Edit Transport Country Season #'.$season, route('admin.season.view', $season));
});

// transport price
Breadcrumbs::for('admin.transportprice.index', function ($trail) {
    $trail->push('Transport Price', route('admin.transportprice.index'));
});
Breadcrumbs::for('admin.transportprice.create', function ($trail) {
    $trail->push('Transport Country Price', route('admin.transportprice.show'));
    $trail->push('Add Transport Country Price', route('admin.transportprice.create'));
});
Breadcrumbs::for('admin.transportprice.edit', function ($trail, $trnsprice) {
    $trail->push('Transport Country Price', route('admin.transportprice.show'));
    $trail->push('Edit Transport Country Price #'.$trnsprice, route('admin.season.edit', $trnsprice));
});
Breadcrumbs::for('admin.transportprice.view', function ($trail, $season) {
    $trail->push('Transport Country Price', route('admin.transportprice.show'));
    $trail->push('View Transport Country Price #'.$season, route('admin.transportprice.view', $season));
});

Breadcrumbs::for('admin.transportprice', function ($trail) {
    $trail->push('Country Transport Prices', route('admin.transportprice'));
});
Breadcrumbs::for('admin.transport.index', function ($trail) {
    $trail->push('Country Regions', route('admin.transport.index'));
});
Breadcrumbs::for('admin.transportcosts.index', function ($trail) {
    $trail->push('Transport Costs', route('admin.transportcosts.index'));
});
Breadcrumbs::for('admin.region.index', function ($trail) {
    $trail->push('Regions', route('admin.region.index'));
});
Breadcrumbs::for('admin.region.show', function ($trail) {
    $trail->push('Regions', route('admin.region.show'));
});
Breadcrumbs::for('admin.region.create', function ($trail) {
    $trail->push('Regions', route('admin.region.create'));
});
Breadcrumbs::for('admin.region.edit', function ($trail, $routeprice) {
    $trail->push('Edit Route Price #'.$routeprice, route('admin.region.edit', $routeprice));
});

Breadcrumbs::for('admin.transportlistimport.index', function ($trail) {
    $trail->push('Transport List', route('admin.transportlistimport.index'));
});

Breadcrumbs::for('admin.transportlistimport.edit', function ($trail, $id) {    
    $trail->push('Transport Edit', route('admin.transportlistimport.edit',$id));
});


require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';