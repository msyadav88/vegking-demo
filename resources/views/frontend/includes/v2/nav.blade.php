<header id="main-menu" class="Fixedheader">
  <div class="container">
    <div class="HeaderNew">
      <div class="LogoLeftSecNew"> <a href="{{ url('/') }}"><img src="{{asset('images/home-v2/logo.png') }}"></a> <a href="javascript:void(0);" class="MobileToggleIconNew"><img src="{{asset('img/toggleicon.png')}}"></a> </div>
      <div class="RightHeaderSecNew">
        <div class="RightHeaderFirstSecNew">
          <div class="LangugeSecNew"> @php
            $localelanguage = config('locale.languages');
            @endphp

            @if(config('locale.status') && count(config('locale.languages')) > 1)
            <ul>
              @foreach(array_keys(config('locale.languages')) as $lang)
              <li><a class="lang-link @if(app()->getLocale() == $lang) active @endif" href="<?php if($lang == 'pl' || $lang == 'en' || $lang == 'de' || $lang == 'ru' || $lang == 'es' || $lang == 'fr'){ echo url('lang',$lang); }else{ echo '#'; } ?>" title="@lang('menus.language-picker.langs.'.$lang)"><img src="<?php echo URL::to('/').'/'.$localelanguage[$lang][3]; ?>" alt="{{$lang}}"  width="100%;" height="100%;"></a></li>
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
              @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
                @lang('inner-content.home-new.about_us_footer')
              @endif
            </a></li>-->
              <li><a data-toggle="modal" id="offer_menu" data-target="#products_modal" href="javascript:;">
              @if(app()->getLocale() == 'en')	
                {!! @$LanguageContent->offer_en !!}
              @elseif(app()->getLocale() == 'pl')
                {!! @$LanguageContent->offer_pl !!}
              @elseif(app()->getLocale() == 'de')
                {!! @$LanguageContent->offer_de !!}
              @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
                @lang('inner-content.home-new.offer')
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
              <li><a href="javascript:void(0);" data-toggle="modal" data-target="#products_modal">@lang('inner-content.frontend.nav.register')</a></li>
        @endguest
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
