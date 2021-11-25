<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-title">
        @lang('menus.backend.sidebar.general')
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() == 'buyer/dashboard' ? 'active' : '' }}" href="{{ route('buyer.dashboard') }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          @lang('menus.backend.sidebar.dashboard')
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() == 'buyer/user/edit/Auth()->user()->id/*' ? 'active' : '' }}" href="{{ $url = route('buyer.user.edit', Auth()->user()->id) }}">
          <i class="nav-icon fa fa-user"></i>
          Profile
        </a>
      </li>  
      @if(get_user_buyer_deliveris() > 0)
      <li class="nav-item">
        <a class="nav-link {{ Request::path() == 'buyer/transport/deliveries*' ? 'active' : '' }}" href="{{ route('buyer.deliveries.buyerdeliveries') }}">
          <i class="nav-icon fa fa-truck-loading"></i>
          Deliveries
        </a>
      </li>
      @endif

      <li class="nav-item"> <a class="nav-link {{ Request::path() == 'buyer/trading/buyerpref*' ? 'active' : '' }}" href="{{ route('buyer.buyerpref.cardview') }}">
      <i class=" nav-icon fas fa-box"></i>My Preferences </a> </li>
      
  </ul>
</nav>

<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
