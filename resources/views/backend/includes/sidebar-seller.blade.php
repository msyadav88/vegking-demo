<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-title">
        @lang('menus.backend.sidebar.general')
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() == 'seller/dashboard' ? 'active' : '' }}" href="{{ route('seller.dashboard') }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          @lang('menus.backend.sidebar.dashboard')
        </a>
      </li>
      <li class="nav-item">
      <a class="nav-link {{ Request::path() == 'seller/user/edit/Auth()->user()->id/*' ? 'active' : '' }}" href="{{ $url = route('seller.user.edit', Auth()->user()->id) }}">
        <i class="nav-icon fa fa-user"></i>
        Profile
      </a>
     </li>
     
      @if(get_user_stock() > 0)
        @can('view stock')
          <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'seller/trading/stockv2' ? 'active' : '' }}" href="{{ route('seller.stockcardview') }}">
              <i class="nav-icon fas fa-shopping-basket"></i>
              My Stocks
            </a>
          </li>
        @endcan
      @endif
    @if(get_user_deliveris() > 0)
      <li class="nav-item">
        <a class="nav-link {{ Request::path() == 'seller/transport/deliveries*' ? 'active' : '' }}" href="{{ route('seller.deliveries.sellerdeliveries') }}">
          <i class="nav-icon fa fa-truck-loading"></i>
          Deliveries
        </a>
      </li>
    @endif
    @if(get_seller_account() > 0)
      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle {{ Request::path() == 'admin/accounts*' ? 'active' : '' }}" href="javascript:void(0);">
          <i class="nav-icon fas fa-file"></i> Account
        </a>
        <ul class="nav-dropdown-items">
          <li class="nav-item"> <a class="nav-link {{ Request::path() == 'seller/accounts/purchaseorder*' ? 'active' : '' }}" href="{{ route('seller.purchaseorder.index') }}"> Purchase Order</a> </li>
          <li class="nav-item"> <a class="nav-link {{ Request::path() == 'seller/accounts/invoices*' ? 'active' : '' }}" href="{{ route('seller.invoices.index') }}"> Invoices</a> </li>
        </ul>
      </li>
    @endif


  </ul>
</nav>

<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
