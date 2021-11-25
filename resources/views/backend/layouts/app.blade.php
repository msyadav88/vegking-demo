<!DOCTYPE html>
  @langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
  @else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @endlangrtl
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', app_name())">
    <meta name="author" content="@yield('meta_author', app_name())">
    @yield('meta')
    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')
    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css').getAutoVersion('css/backend.css')) }}
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css').getAutoVersion('css/jquery.fancybox.min.css')}}">
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css">
    @stack('after-styles')
  </head>

  <body class="{{ config('backend.body_classes') }}">
    <input id="ip" type="hidden" value=""/>
    <div class="loading loading_hide"></div>
    @include('backend.includes.header')
    <div class="app-body">
      @php $roles = \Session::get('roles');
      $count_role= count(auth()->user()->roles); 
      @endphp
    
      @if($count_role == 1)
          @if(auth()->user()->roles->pluck( 'name' )->contains( 'administrator' ))
          @include('backend.includes.sidebar')
          @elseif(auth()->user()->roles->pluck( 'name' )->contains( 'buyer' ))
          @include('backend.includes.sidebar-buyer')
          @elseif(auth()->user()->roles->pluck( 'name' )->contains( 'seller' ))
          @include('backend.includes.sidebar-seller')
          @elseif(auth()->user()->roles->pluck( 'name' )->contains( 'trader' ))
          @include('backend.includes.sidebar-trader')
          @endif
      @else
       @if(!$roles)
          @if(Request::segment(1) == "admin" )
          @include('backend.includes.sidebar')
          @endif
          @if(Request::segment(1) == "seller" )
          @include('backend.includes.sidebar-seller')
          @endif
          @if(Request::segment(1) == "buyer" )
          @include('backend.includes.sidebar-buyer')
          @endif
          @if(Request::segment(1) == "trader" )
          @include('backend.includes.sidebar-trader')
          @endif
      @else
          @if($roles == 'administrator')
            @include('backend.includes.sidebar')
          @elseif($roles == 'buyer')
            @include('backend.includes.sidebar-buyer')
          @elseif($roles == 'seller')
            @include('backend.includes.sidebar-seller')
          @elseif($roles == 'trader')
            @include('backend.includes.sidebar-trader')
          @endif
      @endif
     @endif
      <main class="main">
        @include('includes.partials.demo')
        @include('includes.partials.logged-in-as')
        {!! Breadcrumbs::render() !!}
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="content-header">
              @yield('page-header')
            </div><!--content-header-->
            @include('includes.partials.messages')
            @yield('content')
          </div><!--animated-->
        </div><!--container-fluid-->
      </main><!--main-->
      @include('backend.includes.aside')
    </div><!--app-body-->
    @include('backend.includes.footer')
    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    <script type="text/javascript">
      $(document).ready(function(){
        $.ajax({
          url: "https://jsonip.com",
          type: 'get',
          cache: false,
          success: function(res){ 
            $('#ip').val(res.ip);
          }
        });
      });
    </script>
    <script type="text/javascript" src="{{asset('js/jquery.fancybox.min.js').getAutoVersion('js/jquery.fancybox.min.js')}}"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
    @stack('after-scripts')
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    @include('includes.partials.ga')
    @include('includes.partials.user-clicks')
  </body>
</html>