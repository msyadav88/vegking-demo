<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-title">
        @lang('menus.backend.sidebar.general')
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::path() == 'trader/dashboard' ? 'active' : '' }}" href="{{ route('trader.dashboard') }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          @lang('menus.backend.sidebar.dashboard')
        </a>
      </li>
      <li class="nav-item">
      <a class="nav-link {{ Request::path() == 'trader/profile/Auth()->user()->id/*' ? 'active' : '' }}" href="{{ $url = route('trader.profile.edit', Auth()->user()->id) }}">
        <i class="nav-icon fa fa-user"></i>
          Profile
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'trader/transport/deliveries*' ? 'active' : '' }}" href="{{ route('trader.deliveries.traderdeliveries') }}">
          <i class="nav-icon fa fa-truck-loading"></i>
          Deliveries
          </a>
        </li>
  
  </ul>
</nav>

<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
