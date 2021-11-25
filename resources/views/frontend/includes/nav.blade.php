<?php /*?><header>
  <nav id="topbar" class="navbar navbar-expand-md navbar-dark py-0 bg-dark shadow-sm">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbartop" aria-controls="navbartop" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbartop">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"><a href="mailto:{{ Settings()->email }}"><i class="fas fa-envelope-open-text"></i> {{ Settings()->email }}</a></li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item d-none"><a href="{{route('frontend.contact')}}" class="nav-link {{ Request::path() == 'contact*' ? 'active' : '' }}"><i class="fas fa-address-card"></i> @lang('inner-content.frontend.nav.contact')</a></li>
          @if(config('locale.status') && count(config('locale.languages')) > 1)
              <li class="nav-item dropdown d-none">
                  <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe"></i> @lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</a>
              </li>
          @endif

          @php
          $localelanguage = config('locale.languages');
          @endphp
          @if(config('locale.status') && count(config('locale.languages')) > 1)
          <li class="nav-item langs-menu"> <span class="nav-link"> @foreach(array_keys(config('locale.languages')) as $lang) <a class="lang-link @if(app()->getLocale() == $lang) active @endif" href="{{ url('lang/'.$lang)}}" title="@lang('menus.language-picker.langs.'.$lang)"><img src="<?php echo URL::to('/').'/'.$localelanguage[$lang][3]; ?>" alt="{{$lang}}" width="auto" height="22"></a> @endforeach </span> </li>
          @endif




          @auth
          <li class="nav-item d-none"><a href="{{route('frontend.user.dashboard')}}" class="nav-link {{ Request::path() == 'contact*' ? 'active' : '' }}">@lang('navs.frontend.dashboard')</a></li>
          @endauth

          @guest
          <li class="nav-item"><a href="{{route('frontend.auth.login')}}" class="nav-link {{ Request::path() == 'login*' ? 'active' : '' }}"><i class="fas fa-sign-in-alt"></i>@lang('inner-content.frontend.nav.login')</a></li>
          @if(config('access.registration'))
          @endif
          @else
          <li class="nav-item dropdown"> <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">{{ $logged_in_user->name }}</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser"> @can('view backend') <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a> @endcan
              @role('seller') <a href="{{ route('seller.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a> @endrole <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ Request::path() == 'contact*' ? 'active' : '' }}">@lang('navs.frontend.user.account')</a> <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a> </div>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
  <nav id="main-menu" class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
      <div class="mb-2 mt-1"> <a href="{{ url('/') }}" class="navbar-brand pb-0"><img class="stnd default-logo" style="height: 40px;" alt="{{ Settings()->site_name }}" src="img/{{ Settings()->site_logo }}"></a> @if(app()->getLocale() == 'en') <a  href="tel:@lang('inner-content.frontend.contactsec.phone-2')" style="color:#000;font-weight:700;font-size:18px"><i class="fas fa-phone-alt"></i> @lang('inner-content.frontend.contactsec.phone-2')</a> @elseif(app()->getLocale() == 'pl') <a  href="tel:{{ Settings()->phone }}" style="color:#000;font-weight:700;font-size:18px"><i class="fas fa-phone-alt"></i> {{ Settings()->phone }}</a> @endif </div>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')"> <span class="navbar-toggler-icon"></span> </button>
      <div class="MobileFlag"> @php
        $localelanguage = config('locale.languages');
        @endphp
        @if(config('locale.status') && count(config('locale.languages')) > 1)
        <li class="nav-item langs-menu"> <span class="nav-link"> @foreach(array_keys(config('locale.languages')) as $lang) <a class="lang-link @if(app()->getLocale() == $lang) active @endif" href="{{ url('lang/'.$lang)}}" title="@lang('menus.language-picker.langs.'.$lang)"><img src="<?php echo URL::to('/').'/'.$localelanguage[$lang][3]; ?>" alt="{{$lang}}" width="auto" height="22"></a> @endforeach </span> </li>
        @endif </div>
      <div class="collapse navbar-collapse justify-content-end" id="main-navbar">
        <ul class="navbar-nav">
          <li class="nav-item menubtn"> <a data-toggle="modal" data-target="#sellercontact_modal" href="javascript:;" class="nav-link">@lang('inner-content.frontend.homepage-content.sell')</a> <a data-toggle="modal" id="buy-popup-btn" data-target="#buyercontact_modal" href="javascript:;" class="nav-link">@lang('inner-content.frontend.homepage-content.buy')</a> </li>

          <!--<li class="nav-item"><a href="{{route('frontend.index')}}" class="nav-link {{ Request::path() == '' ? 'active' : '' }}"><i class="fas fa-home"></i> @lang('navs.frontend.home')</a></li>-->
          <li class="nav-item"><a href="#aboutus" class="nav-link {{ Request::path() == 'about-us' ? 'active' : '' }}">@lang('inner-content.frontend.menu.about-us')</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#products_modal" href="javascript:;">@lang('inner-content.frontend.menu.offer')</a></li>
          <li class="nav-item"><a href="{{route('frontend.contact')}}" class="nav-link {{ Request::path() == 'contact*' ? 'active' : '' }}">@lang('inner-content.frontend.menu.contact')</a></li>
          <div id="topbar_append">
            <div class="dropdown-divider"></div>
            @guest
            <li class="nav-item"><a href="{{route('frontend.auth.login')}}" class="nav-link {{ Request::path() == 'login*' ? 'active' : '' }}"><i class="fas fa-sign-in-alt"></i>@lang('inner-content.frontend.nav.login')</a></li>
            @else
            <li class="nav-item dropdown"> <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">{{ $logged_in_user->name }}</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser"> @can('view backend') <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a> @endcan
                @role('seller') <a href="{{ route('seller.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a> @endrole <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ Request::path() == 'contact*' ? 'active' : '' }}">@lang('navs.frontend.user.account')</a> <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a> </div>
            </li>
            @endguest
            <div class="dropdown-divider"></div>
            @php
            $localelanguage = config('locale.languages');
            @endphp
            @if(config('locale.status') && count(config('locale.languages')) > 1)
            <li class="nav-item langs-menu"> <span class="nav-link"> @foreach(array_keys(config('locale.languages')) as $lang) <a class="lang-link @if(app()->getLocale() == $lang) active @endif" href="{{ url('lang/'.$lang)}}" title="@lang('menus.language-picker.langs.'.$lang)"><img src="<?php echo URL::to('/').'/'.$localelanguage[$lang][3]; ?>" alt="{{$lang}}" width="auto" height="22"></a> @endforeach </span> </li>
            @endif
            <div class="dropdown-divider"></div>
          </div>
        </ul>
      </div>
    </div>
  </nav>
</header><?php */?>
<header id="main-menu" class="Fixedheader">
  <div class="container">
    <div class="HeaderNew">
      <div class="LogoLeftSecNew"> <a href="{{ url('/') }}"><img src="{{ url('/') }}/img/{{ Settings()->site_logo }}"></a> <a href="javascript:void(0);" class="MobileToggleIconNew"><img src="{{asset('img/toggleicon.png')}}"></a> </div>
      <div class="RightHeaderSecNew">
        <div class="RightHeaderFirstSecNew">
          <div class="LangugeSecNew"> @php
            $localelanguage = config('locale.languages');
            @endphp

            @if(config('locale.status') && count(config('locale.languages')) > 1)
            <ul>
              @foreach(array_keys(config('locale.languages')) as $lang)
              <li><a class="lang-link @if(app()->getLocale() == $lang) active @endif" href="<?php if($lang == 'pl' || $lang == 'en' || $lang == 'de'){ echo url('lang',$lang); }else{ echo '#'; } ?>" title="@lang('menus.language-picker.langs.'.$lang)"><img src="<?php echo URL::to('/').'/'.$localelanguage[$lang][3]; ?>" alt="{{$lang}}"  width="100%;" height="100%;"></a></li>
              @endforeach
            </ul>
            @endif </div>
          <div class="HeaderMenusSec">
            <ul>
              <!--<li><a href="{{ url('/') }}#aboutus" class="{{ Request::path() == 'about-us' ? 'active' : '' }}">
              @if(app()->getLocale() == 'en')	
                {!! @$LanguageContent->about_us_en !!}
              @elseif(app()->getLocale() == 'pl')
                {!! @$LanguageContent->about_us_pl !!}
              @elseif(app()->getLocale() == 'de')
                {!! @$LanguageContent->about_us_de !!}
              @endif
            </a></li>-->
              <li><a data-toggle="modal" id="offer_menu" data-target="#products_modal" href="javascript:;">
              @if(app()->getLocale() == 'en')	
                {!! @$LanguageContent->offer_en !!}
              @elseif(app()->getLocale() == 'pl')
                {!! @$LanguageContent->offer_pl !!}
              @elseif(app()->getLocale() == 'de')
                {!! @$LanguageContent->offer_de !!}
              @endif
              </a></li>
              <li><a href="{{route('frontend.contact')}}" class="{{ Request::path() == 'contact*' ? 'active' : '' }}">
              @if(app()->getLocale() == 'en')	
                {!! @$LanguageContent->contact_en !!}
              @elseif(app()->getLocale() == 'pl')
                {!! @$LanguageContent->contact_pl !!}
              @elseif(app()->getLocale() == 'de')
                {!! @$LanguageContent->contact_de !!}
              @endif</a></li>        
              <li><a class="setrole" @hasanyrole('buyer') href="{{ url('buyer/dashboard')}}" @else data-toggle="modal" data-target="#sellercontact_modal" role="buyer" register-text="@lang('inner-content.frontend.sell_popup.heading-buyer')" href="javascript:;" @endhasanyrole>@lang('inner-content.home-new.buy')</a></li>
              <li><a class="setrole" @hasanyrole('seller') href="{{ url('seller/dashboard')}}" @else data-toggle="modal" data-target="#sellercontact_modal" role="seller" register-text="@lang('inner-content.frontend.sell_popup.heading-seller')" href="javascript:;" @endhasanyrole>@lang('inner-content.home-new.sell')</a></li>
            </ul>



          </div>
        </div>
        <div class="RightHeaderSecondSecNew">
          <div class="CallUsNew">
            @if(app()->getLocale() == 'en') <a href="tel:@lang('inner-content.frontend.contactsec.phone-2')"><i class="fas fa-phone-alt"></i> @lang('inner-content.frontend.contactsec.phone-2')</a> @elseif(app()->getLocale() == 'pl') <a href="tel:@lang('inner-content.frontend.contactsec.phone-1')"><i class="fas fa-phone-alt"></i> @lang('inner-content.frontend.contactsec.phone-1')</a>
            @else
            <a href="tel:@lang('inner-content.frontend.contactsec.phone-2')"><i class="fas fa-phone-alt"></i> @lang('inner-content.frontend.contactsec.phone-2')</a>
            @endif
          </div>
          <div class="LoginRegSec">
            <ul>
             @auth
              <li class="d-none"><a href="{{route('frontend.user.dashboard')}}" class="{{ Request::path() == 'contact*' ? 'active' : '' }}">@lang('navs.frontend.dashboard')</a></li>
              @endauth

          @guest
          <li><a href="{{route('frontend.auth.login')}}" class="{{ Request::path() == 'login*' ? 'active' : '' }}">@lang('inner-content.frontend.nav.login')</a></li>
          @if(config('access.registration'))
          @endif
          @else
          <li class="dropdown"> <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">{{ $logged_in_user->name }}</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
               @can('view backend') 
                <a href="{{ route('admin.dashboard') }}" class="dropdown-item front">@lang('navs.frontend.user.administration')</a> 
               @endcan
              @role('seller') <a href="{{ route('seller.dashboard') }}" class="dropdown-item front">@lang('navs.frontend.seller')</a> @endrole
              @role('buyer') <a href="{{ route('buyer.dashboard') }}" class="dropdown-item front">@lang('navs.frontend.buyer')</a> @endrole
              @role('trader') <a href="{{ route('trader.dashboard') }}" class="dropdown-item front">@lang('navs.frontend.trader')</a> @endrole
              <a href="{{ route('frontend.user.account') }}" class="dropdown-item front {{ Request::path() == 'contact*' ? 'active' : '' }}">@lang('navs.frontend.user.account')</a> 
              <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item front">@lang('navs.general.logout')</a> </div>
          </li>
          
          @endguest





        @guest
              <li><a href="javascript:void(0);" data-toggle="modal" data-target="#sellercontact_modal">@lang('inner-content.frontend.nav.register')</a></li>
        @endguest
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
