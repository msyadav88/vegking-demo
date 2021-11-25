
<!-- <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/transport/deliveries*' ? 'active' : '' }}" href="{{ route('admin.deliveries.admindeliveries') }}">
            <i class="nav-icon fa fa-user"></i>
            Profile
          </a>
        </li> -->

<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-title">
        @lang('menus.backend.sidebar.general')
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() == 'admin/dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          @lang('menus.backend.sidebar.dashboard')
        </a>
      </li>
       @if ($logged_in_user->isAdmin())
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/profile/Auth()->user()->id/*' ? 'active' : '' }}" href="{{ $url = route('admin.profile.edit', Auth()->user()->id) }}">
            <i class="nav-icon fa fa-user"></i>
            Profile
          </a>
        </li>
      @endif
      @if ($logged_in_user->isAdmin())
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/accounts*' ? 'active' : '' }}" href="javascript:void(0);">
            <i class="nav-icon fas fa-file"></i> Analytics
          </a>
          <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/usertracking' ? 'active' : '' }}" href="{{ route('admin.user-ips.usertracking') }}">
            User Tracking
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/user-visits' ? 'active' : '' }}" href="{{ route('admin.analytics.user-visits') }}">
            User Visits
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/contact' ? 'active' : '' }}" href="{{ route('admin.analytics.contact') }}">
            Contact Us
            </a>
          </li>
          
          </ul>
        </li>
      @endif
      
      <li class="nav-item nav-dropdown {{ Request::segment(2) == 'trading' ? 'open' : '' }}">
        <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/trading*' ? 'active' : '' }}" href="#">
          <i class="nav-icon fas fa-cart-arrow-down"></i>
          @lang('menus.backend.trading.title')
          @if ($pending_approval > 0)
            <span class="badge badge-danger">{{ $pending_approval }}</span>
          @endif
        </a>
        <ul class="nav-dropdown-items">
          @can('view offer sent')
            <li class="nav-item"><a class="nav-link {{ Request::path() == 'admin/trading/offersent*' ? 'active' : '' }}" href="{{ route('admin.offersent.index') }}">Offer Sent</a></li>
          @endcan

          <!--@can('view stock')
            <li class="nav-item"><a class="nav-link {{ Request::path() == 'admin/trading/stock*' ? 'active' : '' }}" href="{{ route('admin.stock.index') }}">StocksV1</a></li>
          @endcan-->
          @can('view stock')
            <li class="nav-item"><a class="nav-link {{ Request::path() == 'admin/trading/stockv2*' ? 'active' : '' }}" href="{{ route('admin.stockcardview') }}">Stocks</a></li>
          @endcan

          {{--<li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/trading/products*' ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
              @lang('menus.backend.trading.products.all')
            </a>
          </li>--}}

          @can('view sales')
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/trading/sales*' ? 'active' : '' }}" href="{{ route('admin.sales.index') }}">
              @lang('menus.backend.trading.sales.all')
            </a>
          </li>
          @endcan

          <!--<li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/trading/order2*' ? 'active' : '' }}" href="{{ route('admin.order2.index') }}">
              @lang('menus.backend.trading.order2.all')
            </a>
          </li>-->

          @can('view matches')
            <li class="nav-item">
              <a class="nav-link {{ Request::path() == 'admin/trading/matches*' ? 'active' : '' }}" href="{{ route('admin.matches.index') }}">
                Matches
              </a>
            </li>
          @endcan

        @can('view buyer')
          <li class="nav-item"><a class="nav-link {{ Request::path() == 'admin/buyers' ? 'active' : '' }}" href="{{ route('admin.buyers.index') }}">Buyers</a></li>
        @endcan

        @can('view buyer pref')
         <li class="nav-item"> <a class="nav-link {{ Request::path() == 'admin/trading/buyerpref*' ? 'active' : '' }}" href="{{ route('admin.buyerpref.cardview') }}"> Buyer Pref </a> </li>
        @endcan

        @can('view buyer leads')
            <li class="nav-item"><a class="nav-link {{ Request::path() == 'admin/buyerleads' ? 'active' : '' }}" href="{{ route('admin.buyerleads.index') }}">Buyer Leads</a></li>
        @endcan

        @can('view seller')
          <li class="nav-item"><a class="nav-link {{ Request::path() == 'admin/sellers' ? 'active' : '' }}" href="{{ route('admin.sellers.index') }}">Sellers</a></li>
        @endcan
        @if ($logged_in_user->isAdmin())
          <li class="nav-item"> <a class="nav-link {{ Request::path() == 'admin/trading/appheads*' ? 'active' : '' }}" href="{{ route('admin.appheads.index') }}"> Settings </a> </li>
       @endif
        @can('view products')
          <li class="nav-item"> <a class="nav-link {{ Request::path() == 'admin/trading/products*' ? 'active' : '' }}" href="{{ route('admin.products.index') }}"> Products</a> </li>
          <li class="nav-item"> <a class="nav-link {{ Request::path() == 'admin/trading/subproducts*' ? 'active' : '' }}" href="{{ route('admin.subproducts.index') }}"> Sub Products</a> </li>
        @endif
        @can('view product spec')
          <li class="nav-item"> <a class="nav-link {{ Request::path() == 'admin/trading/productspecs*' ? 'active' : '' }}" href="{{ route('admin.productspecs.index') }}"> Product Spec </a> </li>
        @endif 
        @can('view product spec values')        
          <li class="nav-item"> <a class="nav-link {{ Request::path() == 'admin/trading/productspecvalues*' ? 'active' : '' }}" href="{{ route('admin.productspecvalues.index') }}"> Product Spec Values </a> </li>
        @endif 

        @can('view warehouse')
          <li class="nav-item"><a class="nav-link {{ Request::path() == 'admin/trading/warehouse*' ? 'active' : '' }}" href="{{ route('admin.warehouse.index') }}">@lang('menus.backend.trading.warehouse.all')</a></li>
        @endcan
        @can('view rejected stock')
          <li class="nav-item"><a class="nav-link {{ Request::path() == 'admin/trading/rejectedstock*' ? 'active' : '' }}" href="{{ route('admin.trading.rejectedstock') }}">@lang('menus.backend.trading.rejectedstock.all')</a></li>
        @endcan
      </ul>
    </li>

    <li class="nav-item">
    <a class="nav-link {{ Request::path() == 'admin/transport/deliveries*' ? 'active' : '' }}" href="{{ route('admin.deliveries.admindeliveries') }}">
          <i class="nav-icon fas fa-truck-loading"></i>
          Deliveries
        </a>
      </li>
   
    @if ($logged_in_user->isAdmin())

	  <li class="nav-item nav-dropdown">
      <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/accounts*' ? 'active' : '' }}" href="javascript:void(0);">
        <i class="nav-icon fas fa-file"></i> Account
      </a>
	    <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/accounts/buyer_templates*' ? 'active' : '' }}" href="{{ route('admin.accounts.buyer_templates') }}">
            Buyer templates
          </a>
        </li>
        <li class="nav-item"> <a class="nav-link {{ Request::path() == 'admin/accounts/purchaseorder*' ? 'active' : '' }}" href="{{ route('admin.purchaseorder.index') }}"> Purchase Order</a> </li>
        <li class="nav-item"> <a class="nav-link {{ Request::path() == 'admin/accounts/invoices*' ? 'active' : '' }}" href="{{ route('admin.invoices.index') }}"> Invoices</a> </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/accounts/buyer_invoice_history*' ? 'active' : '' }}" href="{{ route('admin.accounts.buyer_invoice_history') }}">
            Buyer invoice history
          </a>
        </li>
		  </ul>
    </li>
@endif
    @if($logged_in_user->hasAnyPermission(['view loads','view vehicles','view postal code','view transport list']))
    <li class="nav-item nav-dropdown @if(Request::segment(2) == 'transport' && Request::segment(3) != 'deliveries') {{ 'open' }} @endif">
      <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/transport*' ? 'active' : '' }}" href="#">
        <i class="nav-icon fas fa-truck"></i>
        Transport Excels
      </a>
      <ul class="nav-dropdown-items">
        @can('view loads')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/transport/loads*' ? 'active' : '' }}" href="{{ route('admin.loads.index') }}">
            Loads
          </a>
        </li>
        @endcan
        @can('view vehicles')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/transport/vehicles*' ? 'active' : '' }}" href="{{ route('admin.vehicles.index') }}">
            Vehicles
          </a>
        </li>
        @endcan
        @can('view postal code')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/transport/postalcodes*' ? 'active' : '' }}" href="{{ route('admin.postalcodes.index') }}">
            Postal Codes
          </a>
        </li>
        @endcan
        @can('view transport list')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/usertracking/list*' ? 'active' : '' }}" href="{{ route('admin.list.index') }}">
           Transport List
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endif
    @if($logged_in_user->hasAnyPermission(['view carrier list','view transport list']))
	  <li class="nav-item nav-dropdown @if(Request::segment(2) == 'transport' && Request::segment(3) != 'deliveries') {{ 'open' }} @endif">
      <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/transport*' ? 'active' : '' }}" href="#">
        <i class="nav-icon fas fa-truck"></i>
        Transport List
      </a>
      <ul class="nav-dropdown-items">
        @can('view carrier list')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/transport/transportlist*' ? 'active' : '' }}" href="{{ route('admin.transportlist.index') }}">
           Transport List
          </a>
        </li>
        @endcan
        @can('view transport list')
		    <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/transport/carrier*' ? 'active' : '' }}" href="{{ route('admin.carrier.index') }}">
           Carrier List
          </a>
        </li>
        @endcan
        @can('view transport list import')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/transport/transportlistimport*' ? 'active' : '' }}" href="{{ route('admin.transportlistimport.index') }}">
           Transport List Import
          </a>
        </li>
        @endcan
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::path() == 'admin/transportcosts/.*' ? 'active' : '' }}" href="{{ route('admin.transportcosts.index') }}">
        <i class="nav-icon fas fa-truck"></i>
        Transport & Cost
      </a>
    </li>
    <!--<li class="nav-item nav-dropdown">
      <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/transportcosts*' ? 'active' : '' }}" href="#">
        <i class="nav-icon fas fa-truck"></i>
          Transport Cost
      </a>
      <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/transport/.*' ? 'active' : '' }}" href="{{ route('admin.transport.index') }}">
            Country Regions
          </a>
        </li>-->
        <!--<li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/region/.*' ? 'active' : '' }}" href="{{ route('admin.region.index') }}">
            Regions
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/routeprices.*' ? 'active' : '' }}" href="{{ route('admin.routeprices.index') }}">
            Route Prices
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/season.*' ? 'active' : '' }}" href="{{ route('admin.season.index') }}">
            Transport Season
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/transportprice.*' ? 'active' : '' }}" href="{{ route('admin.transportprice.index') }}">
            Country Transport Prices
          </a>
        </li>
      </ul>
    </li>-->
  @endif
    
@if($logged_in_user->hasAnyPermission(['system settings','view currency rate','import buyers','import sellers','view pages','email templates']))
    <li class="nav-title">
      @lang('menus.backend.sidebar.system')
    </li>
    <li class="nav-item nav-dropdown {{ Request::segment(2) == 'transport' ? 'open' : '' }}">
      <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/setting*' ? 'active' : '' }}" href="#">
        <i class="nav-icon fa fa-cogs" aria-hidden="true"></i>
        Setting
      </a>
      <ul class="nav-dropdown-items">
        @can('system settings')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/setting' ? 'active' : '' }}" href="{{ route('admin.setting.index') }}">
            <i class="nav-icon fa fa-wrench" aria-hidden="true"></i>
            General Setting
          </a>
        </li>
        @endcan
        @can('system settings')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/translations' ? 'active' : '' }}" href="{{ route('admin.translations') }}">
            <i class="nav-icon fa fa-language" aria-hidden="true"></i>
            {{__('Translation Setting')}}
          </a>
        </li>
        @endcan
         @can('view currency rate')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/currencyrates' ? 'active' : '' }}" href="{{ route('admin.currencyrates.index') }}">
            <i class="nav-icon fa fa-language" aria-hidden="true"></i>
            {{__('Currency Rate')}}
          </a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/import-product' ? 'active' : '' }}" href="{{ route('admin.import_product') }}">
            <i class="nav-icon fa fa-language" aria-hidden="true"></i>
            {{__('Import Product')}}
          </a>
        </li>
        @can('import buyers')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/import-buyer' ? 'active' : '' }}" href="{{ route('admin.import_buyer') }}">
            <i class="nav-icon fa fa-language" aria-hidden="true"></i>
            {{__('Import Buyer')}}
          </a>
        </li>
        @endcan
        @can('import sellers')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/import-seller' ? 'active' : '' }}" href="{{ route('admin.import_seller') }}">
            <i class="nav-icon fa fa-language" aria-hidden="true"></i>
            {{__('Import Seller')}}
          </a>
        </li>
        @endcan
        @can('view pages')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/setting/pages*' ? 'active' : '' }}" href="{{ route('admin.pages.index') }}">
            <i class="nav-icon fa fa-file" aria-hidden="true"></i>
            Pages
          </a>
        </li>
        @endcan
        @can('view email templates')
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/email-templates*' ? 'active' : '' }}" href="{{ route('admin.email-templates.index') }}">
            <i class="nav-icon fa fa-file" aria-hidden="true"></i>
            Message Templates
          </a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/languagecontent*' ? 'active' : '' }}" href="{{ route('admin.languagecontent.index') }}">
            <i class="nav-icon fa fa-file" aria-hidden="true"></i>
           Language Content
          </a>
        </li>
        @can('system settings')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.clear.cache') }}"><i class="nav-icon fas fa-broom"></i> Clear Cache</a>
        </li>
        @endcan
      </ul>
    </li>
@endif
@if($logged_in_user->hasAnyPermission(['view log viewer']))
    <li class="divider"></li>
    <li class="nav-item nav-dropdown {{ Request::segment(2) == 'log-viewer' ? 'open' : '' }}">
      <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/log-viewer*' ? 'active' : '' }}" href="#">
        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
      </a>

      <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/log-viewer*' ? 'active' : '' }}" href="{{ route('log-viewer::dashboard') }}">
            @lang('menus.backend.log-viewer.dashboard')
          </a>
        </li>
          <li class="nav-item">
          <a class="nav-link " href="{{ route('admin.user-ips.index') }}">
            User Ips Management
            @if ($pending_approval > 0)
            <span class="badge badge-danger">{{ $pending_approval }}</span>
            @endif
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/log-viewer/logs*' ? 'active' : '' }}" href="{{ route('log-viewer::logs.list') }}">
            @lang('menus.backend.log-viewer.logs')
          </a>
        </li>
      </ul>
    </li>
@endcan

    @can('view user')
    <li class="nav-item nav-dropdown {{ Request::segment(2) == 'auth' ? 'open' : '' }}">
      <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/auth*' ? 'active' : '' }}" href="#">
        <i class="nav-icon far fa-user"></i>
        @lang('menus.backend.access.title')

        @if ($pending_approval > 0)
        <span class="badge badge-danger">{{ $pending_approval }}</span>
        @endif
      </a>

      <ul class="nav-dropdown-items">
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'admin/auth/user*' ? 'active' : '' }}" href="{{ route('admin.auth.user.index') }}">
            @lang('labels.backend.access.users.management')
            @if ($pending_approval > 0)
              <span class="badge badge-danger">{{ $pending_approval }}</span>
            @endif
          </a>
        </li>
        @if ($logged_in_user->isAdmin())
			<li class="nav-item">
				<a class="nav-link " href="{{ route('admin.affiliate.index') }}">
					Affiliate Management
					@if ($pending_approval > 0)
						<span class="badge badge-danger">{{ $pending_approval }}</span>
					@endif
				</a>
			</li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.referrer.index') }}">
              Referrer Management
              @if ($pending_approval > 0)
                <span class="badge badge-danger">{{ $pending_approval }}</span>
              @endif
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/auth/role*' ? 'active' : '' }}" href="{{ route('admin.auth.role.index') }}">
              @lang('labels.backend.access.roles.management')
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'admin/bizcards*' ? 'active' : '' }}" href="{{ route('admin.bizcards') }}">
              Business Cards
            </a>
          </li>
        @endif
      </ul>
     
    </li>
    @endcan
  </ul>
</nav>

<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->