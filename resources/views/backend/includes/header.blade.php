
@php $roles = \Session::get('roles'); @endphp
<?php 
$multi_roles  = Auth()->user()->roles->toArray();
// echo "<pre>"; print_r($roles); exit('here')?>


<?php  
// echo "<pre>"; print_r($roles); exit('blue');  ?>
<style type="text/css">
    .flag{
        height: 20px;
        width:  20px;
        border-radius: 15px;
        margin-right: 10px;
       border:1px solid #d6d3d3;
    }


</style>
@if(Request::segment(1) == "admin" )
    @php $route_pre = 'admin'; @endphp
@elseif(Request::segment(1) == "buyer")
    @php $route_pre = 'buyer'; @endphp
@elseif(Request::segment(1) == "seller")
    @php $route_pre = 'seller'; @endphp
@else
    @php $route_pre = 'trader'; @endphp
@endif
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <!--<span class="navbar-toggler-icon"></span>-->
        <span class="fa fa-bars barstyle"></span>
    </button>
   
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <!--<span class="navbar-toggler-icon"></span>-->
        <span class="fa fa-bars barstyle"></span>
    </button>

    <ul class="nav navbar-nav">
        <li class="nav-item px-3 d-md-down-none">
            <a class="nav-link" href="{{ route('frontend.index') }}"><i class="fas fa-home"></i></a>
        </li>

        <li class="nav-item px-3 d-md-down-none">
            <a class="nav-link" href="{{ route($route_pre.'.dashboard') }}">@lang('navs.frontend.dashboard')</a>
        </li>
 
        @if(config('locale.status') && count(config('locale.languages')) > 1)
            <li class="nav-item px-3 dropdown d-md-down-none">
              <!--   <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span>@lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</span>
                </a> -->

                @include('includes.partials.lang')

            </li>

        @endif

         <li class="nav-item px-3 language-list">
           <!--  <img src="{{asset('img/german.jpg')}}" alt="german flag" class="flag">
            <img src="{{asset('img/polish.png')}}" alt="polish flag" class="flag">
            <img src="{{asset('img/english.jpg')}}" alt="english flag" class="flag"> -->
            @php
            $localelanguage = config('locale.languages');
            @endphp

            @if(config('locale.status') && count(config('locale.languages')) > 1)
            @foreach(array_keys(config('locale.languages')) as $lang)
            @if($lang=='en')
            <a class="lang-link @if(app()->getLocale() == $lang) active @endif" href="<?php if($lang == 'pl' || $lang == 'en' || $lang == 'de'){ echo url('lang',$lang); }else{ echo '#'; } ?>" title="@lang('menus.language-picker.langs.'.$lang)"><img src="<?php echo URL::to('/').'/'.$localelanguage[$lang][3]; ?>" alt="{{$lang}}" class="flag"  ></a>
            @endif
             @endforeach
              @foreach(array_keys(config('locale.languages')) as $lang)
              @if($lang!='en')
             <a class="lang-link @if(app()->getLocale() == $lang) active @endif" href="<?php if($lang == 'pl' || $lang == 'en' || $lang == 'de'){ echo url('lang',$lang); }else{ echo '#'; } ?>" title="@lang('menus.language-picker.langs.'.$lang)"><img src="<?php echo URL::to('/').'/'.$localelanguage[$lang][3]; ?>" alt="{{$lang}}" class="flag"  ></a>
             @endif
              @endforeach
            @endif
        </li>
    </ul>
  <ul class="ml-auto"><li><img class="d-md-down-none" style="width: 200px;" src="{{ url('/images/home-v2/logo.png')}}"></li></ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="fas fa-bell"></i>
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="fas fa-list"></i>
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="fas fa-map-marker-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
				@if($logged_in_user->avatar_location)         
					<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					<img src="{{ url('storage/app/public').'/'.$logged_in_user->avatar_location}}" class="img-avatar" alt="{{ $logged_in_user->email }}"> <span class="d-md-down-none px-3">{{ $logged_in_user->full_name }}</span>
				</a>       
				@else
					<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<img src="{{ $logged_in_user->picture }}" class="img-avatar" alt="{{ $logged_in_user->email }}"><span class="d-md-down-none px-3">{{ $logged_in_user->full_name }}</span>
					</a>     
				@endif
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Account</strong>
            </div>
            @php @$multi_roles  = Auth()->user()->roles->toArray() @endphp
            @if(count($multi_roles) > 1)
                @if($roles)
                    @if($roles =='administrator')
                    <a class="dropdown-item" href="{{ route('admin.profile.edit',isset($logged_in_user->id)?$logged_in_user->id:'') }}">
                        <i class="fa fa-user"></i> Profile  
                    </a>
                    @endif
                    @if($roles =='trader')
                    <a class="dropdown-item" href="{{ route('trader.profile.edit',isset($logged_in_user->id)?$logged_in_user->id:'') }}">
                        <i class="fa fa-user"></i> Profile  
                    </a>    
                    @endif
                    @if($roles =='seller')
                    <a class="dropdown-item" href="{{ route('seller.user.edit',isset($logged_in_user->id)?$logged_in_user->id:'') }}">
                        <i class="fa fa-user"></i> Profile  
                    </a>
                    @endif                    
                    @if($roles =='buyer')
                    <a class="dropdown-item" href="{{ route('buyer.user.edit',isset($logged_in_user->id)?$logged_in_user->id:'') }}">
                        <i class="fa fa-user"></i> Profile 
                    </a>
                    @endif
                @endif
                @if(auth()->user()->hasRole('administrator') && empty($roles))      
                    @role('administrator')
                     <a class="dropdown-item" href="{{ route('admin.profile.edit',isset($logged_in_user->id)?$logged_in_user->id:'') }}">
                        <i class="fa fa-user"></i> Profile  
                    </a>    
                    @endrole
                @endif   
            @else
                @role('administrator')
                     <a class="dropdown-item" href="{{ route('admin.profile.edit',isset($logged_in_user->id)?$logged_in_user->id:'') }}">
                        <i class="fa fa-user"></i> Profile  
                    </a>    
                @endrole
                @role('trader')
                    <a class="dropdown-item" href="{{ route('trader.profile.edit',isset($logged_in_user->id)?$logged_in_user->id:'') }}">
                        <i class="fa fa-user"></i> Profile  
                    </a>    
                @endrole
                @role('seller')
                    <a class="dropdown-item" href="{{ route('seller.user.edit',isset($logged_in_user->id)?$logged_in_user->id:'') }}">
                        <i class="fa fa-user"></i> Profile  
                    </a>
                @endrole
                @role('buyer')
                <a class="dropdown-item" href="{{ route('buyer.user.edit',isset($logged_in_user->id)?$logged_in_user->id:'') }}">
                    <i class="fa fa-user"></i> Profile 
                </a>
                @endrole
            @endif
            <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}">
                <i class="fas fa-lock"></i> @lang('navs.general.logout')
            </a>
          </div>
        </li>
    </ul>

</header>
