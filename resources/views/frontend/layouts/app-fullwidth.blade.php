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
        <meta name="google" value="notranslate">
		<link rel="icon" href="{{asset("img/".Settings()->site_favicon)}}" type="image/gif" sizes="16x16">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css').getAutoVersion('css/frontend.css')) }}
        <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/style.css').getAutoVersion('css/style.css')}}">
        <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css').getAutoVersion('css/jquery.fancybox.min.css')}}">
        <meta name="google" value="notranslate">
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
    z-index: 99999;
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
         <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/contact-panel.css').getAutoVersion('css/contact-panel.css')}}">
        @stack('after-styles')
    </head>
    <body>
 <div class="loading loading_hide"></div>
    <input id="ip" type="hidden" value=""/>
  <!--  <a data-fancybox data-src="#agreePopup" href="javascript:;">
	Trigger the fancybox
</a>-->
    <input type="hidden" id="token" value="{{ csrf_token() }}">
	@if(Session::has('Agreecookie'))
	<div style="display: none;">
	@else
    <div style="display: none;" id="agreePopup">
	@endif
        <div class="row">
            <div class="col-md-10">
                <h1>@if(app()->getLocale() == 'en')	
                {!! @$LanguageContent->site_name_en !!}
              @elseif(app()->getLocale() == 'pl')
                {!! @$LanguageContent->site_name_pl !!}
              @elseif(app()->getLocale() == 'de')
                {!! @$LanguageContent->site_name_de !!}
              @endif</h1>
                <p>@if(app()->getLocale() == 'en')	
                {!! @$LanguageContent->footer_about_en !!}
              @elseif(app()->getLocale() == 'pl')
                {!! @$LanguageContent->footer_about_pl !!}
              @elseif(app()->getLocale() == 'de')
                {!! @$LanguageContent->footer_about_de !!}
              @endif</p>
            </div>
            <div class="col-md-2">
                <ul>
                    <li><a class="agreebtn" data-fancybox-close>
                    @if(app()->getLocale() == 'en')	
                        {!! @$LanguageContent->agreebutton_en !!}
                    @elseif(app()->getLocale() == 'pl')
                        {!! @$LanguageContent->agreebutton_pl !!}
                    @elseif(app()->getLocale() == 'de')
                        {!! @$LanguageContent->agreebutton_de !!}
                    @endif     
                   </a></li>
                    <!--li><a class="cancelbtn">More information</a></li-->
                </ul>
            </div>
        </div>
    </div>

    @include('includes.partials.demo')

    <div id="app" class="@yield('classes', '')">
        @include('includes.partials.logged-in-as')
        @include('includes.partials.cameracheck')
        
        @include('frontend.includes.nav')
        @yield('slider')

        @include('includes.partials.messages')
        @yield('content')

        @include('frontend.includes.footer')
        @include('frontend.includes.modals')
        @include('frontend.includes.chat')
    </div><!-- #app -->
    <!-- Scripts -->
    @stack('before-scripts')
	{!! script(mix('js/manifest.js').getAutoVersion('js/manifest.js')) !!}
	{!! script(mix('js/vendor.js').getAutoVersion('js/vendor.js')) !!}
    {!! script(mix('js/frontend.js').getAutoVersion('js/frontend.js')) !!}
    <script type="text/javascript" src="{{asset('js/jquery.fancybox.min.js').getAutoVersion('js/jquery.fancybox.min.js')}}"></script>
    <script type="application/javascript" src="{{url('js/select2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    @stack('after-scripts')
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    @include('includes.partials.ga')
    @include('includes.partials.user-clicks')
    @include('frontend.comman-register')
    @include('frontend.camera')
        {{-- @include('frontend.sellercontact-new')
        @include('frontend.buyercontact') --}}
    {{--@include('frontend.buyerlead')--}}
	{{-- @include('frontend.buyerform') --}}
    
    <script type="text/javascript">
        $(document).ready(function(){
            /*grecaptcha.ready(function() {
                grecaptcha.execute("{{ env('CAPTCHA_KEY') }}", {
                        action: 'homepage'
                    }).then(function(token) {
                });
            });*/
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

            $("#camera").on("change", function() {
                if($('#camera').is(":checked"))
                {
                    $('#sellerbtn').html('<a class="btn home-btn mb-4 on-camera" role="seller" href="javascript:;">@lang("inner-content.frontend.homepage-content.sell")</a>');
                    $('#buyerbtn').html('<a class="btn home-btn mb-4 on-camera" role="buyer" href="javascript:;">@lang("inner-content.frontend.homepage-content.buy")</a>');

                    $('#sellmobile').html('<a class="btn home-btn text-uppercase on-camera" role="seller" href="javascript:;">@lang("inner-content.frontend.homepage-content.sell")</a>');
                    $('#buymobile').html('<a class="btn home-btn mr-3 text-uppercase on-camera" role="buyer" href="javascript:;">@lang("inner-content.frontend.homepage-content.buy")</a>');
                }
                else
                {
                    $('#sellerbtn').html('<a class="btn home-btn mb-4" data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('+"seller"+')" href="javascript:;">@lang("inner-content.frontend.homepage-content.sell")</a>');
                    $('#buyerbtn').html('<a class="btn home-btn mb-4" data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('+"buyer"+')" href="javascript:;">@lang("inner-content.frontend.homepage-content.buy")</a>');

                    $('#sellmobile').html('<a class="btn home-btn text-uppercase" @hasanyrole('+"seller"+') href="{{ url('+"seller/dashboard"+')}}" @else data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('+"seller"+')" href="javascript:;" @endhasanyrole>@lang("inner-content.frontend.homepage-content.sell")</a>');
                    $('#buymobile').html('<a class="btn home-btn mr-3 text-uppercase on-camera" @hasanyrole("buyer") href="{{ url('+"buyer/dashboard"+')}}" @else data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('+"buyer"+')" href="javascript:;" @endhasanyrole>@lang("inner-content.frontend.homepage-content.buy")</a>');
                }
            });

            $(document).on("click", '.on-camera', function() {
                $('#user_roles').val($(this).attr('role'));
                if($(window).width() <= 360){
                    Webcam.set({
                        width: 265,
                        height: 100,
                        image_format: 'jpeg',
                        jpeg_quality: 90
                    });
                }else{
                    Webcam.set({
                        width: 640,
                        height: 390,
                        image_format: 'jpeg',
                        jpeg_quality: 90
                    });
                }                
                Webcam.attach( '#my_camera' );
                $('#camera_modal').modal('show');
            });

            $(document).on("click", '#takesnapshot', function() {
                Webcam.snap( function(data_uri) {
                    $(".image-tag").val(data_uri);
                    $('#results').html('<img class="center" src="'+data_uri+'"/>');
                });
            });
        });
    </script>
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
        $('body').css("margin-top", navbarHeight);
        function hasScrolled() {
            var st = $(this).scrollTop();
            if(Math.abs(lastScrollTop - st) <= delta)
                return;
            if (st > lastScrollTop && st > navbarHeight){
                var heightplus = navbarHeight + 20;
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
