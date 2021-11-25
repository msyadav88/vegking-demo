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
		<link rel="icon" href="{{asset("img/".Settings()->site_favicon)}}" type="image/gif" sizes="16x16">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css').getAutoVersion('css/frontend.css')) }}
		<link media="all" type="text/css" rel="stylesheet" href="{{asset('css/style.css').getAutoVersion('css/style.css')}}">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>


        <style type="text/css">


 .loading:not(:required) {
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
}

.loading {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}
.loading_hide {
     display: none;
}
.loading:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));
    background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}
.loading:not(:required):after {
    content: '';
    display: block;
    font-size: 10px;
        position: relative;
    z-index: 999999999;
    width: 1em;
    height: 1em;
    margin-top: -0.5em;
    -webkit-animation: spinner 150ms infinite linear;
    -moz-animation: spinner 150ms infinite linear;
    -ms-animation: spinner 150ms infinite linear;
    -o-animation: spinner 150ms infinite linear;
    animation: spinner 150ms infinite linear;
    border-radius: 0.5em;
    -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
    box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}



/* include this only once */
@-webkit-keyframes spinner {
    0%   {
        -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(0deg);  /* IE 9 */
        transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
    }
    100% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
    }
}
@keyframes spinner {
    0%   {
        -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(0deg);  /* IE 9 */
        transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
    }
    100% {
        -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
        -ms-transform: rotate(360deg);  /* IE 9 */
        transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
    }
}




        </style>





        @stack('after-styles')
    </head>
    <body>
          <div class="loading loading_hide"></div>
        @include('includes.partials.demo')

        <div id="app" class="@yield('classes', '')">
            @include('includes.partials.logged-in-as')
            @include('frontend.includes.nav')
            @yield('slider')
            <div class="container">
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
            @include('frontend.includes.footer')
            @include('frontend.includes.modals')
        </div><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js').getAutoVersion('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js').getAutoVersion('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js').getAutoVersion('js/frontend.js')) !!}
        @stack('after-scripts')
        <script type="text/javascript">
            $(document).ready(function(){
            $('.MobileToggleIconNew').click(function(){
                $('.RightHeaderSecNew').slideToggle(300);
            });

            $.ajax({
                url: "https://jsonip.com",
                type: 'get',
                cache: false,
                success: function(res){
                    $('#ip').val(res.ip);
                    $('#ipa').val(res.ip);
                    var data = {};
                    data['ip'] = res.ip;
                    data["_token"]="{{ csrf_token() }}";
                    $.ajax({
                        url: "{{ route('frontend.user.iplocation') }}",
                        method: 'post',
                        data: data,
                        success: function(response){
                            if(response.status){
                                $('#country_code').append('<option value="1">United State (+1)</option>');
                            }
                    }})

                }
            });
        </script>
       <script async src='https://www.google-analytics.com/analytics.js'></script>
        @include('includes.partials.ga')
        @include('includes.partials.user-clicks')
        @include('frontend.comman-register')
        {{-- @include('frontend.sellercontact-new')
        @include('frontend.buyercontact') --}}
        @include('frontend.buyerlead')
		@include('frontend.buyerform')
          <script type="text/javascript">
      jQuery(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 200) {
                //jQuery("#main-menu").addClass("Fixedheader");
            }else {
                //jQuery("#main-menu").removeClass("Fixedheader");
            }
        });
        // Hide Header on on scroll down
        var didScroll;
        var lastScrollTop = 0;
        var delta = 5;
        var navbarHeight = $('#main-menu').outerHeight();
        $(window).scroll(function(event){
            didScroll = true;
        });
        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);
        $('body').css("margin-top", navbarHeight+30);
        function hasScrolled() {
            var st = $(this).scrollTop();
            if(Math.abs(lastScrollTop - st) <= delta)
                return;
            if (st > lastScrollTop && st > navbarHeight){
                var heightplus = navbarHeight + 20;
                //alsert(navbarHeight);
                $('header').css("top", '-'+heightplus+'px');
            } else {
                if(st + $(window).height() < $(document).height()) {
                    $('header').css("top", 0);
                }
            }
            lastScrollTop = st;
        }
     </script>
    </body>
</html>
