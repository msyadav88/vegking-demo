<footer>
  <section class="footer pt-5 pb-2" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <!--<h6 class="text-white has-small-font-size">@lang('inner-content.home-new.about_vegking')</h6>
          <hr>
          <p class="about">@lang('inner-content.home-new.about_content')</p>-->
        </div>
        <div class="col-md-4">
          <h6 class="text-white has-small-font-size">

				@if(app()->getLocale() == 'en')	
					{!! @$LanguageContent->about_property_en !!}
				@elseif(app()->getLocale() == 'pl')
					{!! @$LanguageContent->about_property_pl !!}
				@elseif(app()->getLocale() == 'de')
          {!! @$LanguageContent->about_property_de !!}
        @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
          @lang('inner-content.home-new.about_property')
				@endif
          </h6>
          <hr>
          <ul class="has-small-font-size pl-0 list-unstyled">
            <!--<li class="footer-link"><a href="{{ url('/') }}#aboutus"><i class="fa fa-angle-right pr-1"></i>
              @if(app()->getLocale() == 'en')	
                {!! @$LanguageContent->about_us_footer_en !!}
              @elseif(app()->getLocale() == 'pl')
                {!! @$LanguageContent->about_us_footer_pl !!}
              @elseif(app()->getLocale() == 'de')
                {!! @$LanguageContent->about_us_footer_de !!}
              @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
                @lang('inner-content.home-new.about_us_footer')
              @endif
            </a></li>-->
            <li><a href="<?php echo url('privacy-policy'); ?>"><i class="fa fa-angle-right pr-1"></i> 
          
          @if(app()->getLocale() == 'en')	
            {!! @$LanguageContent->privacy_policy_en !!}
          @elseif(app()->getLocale() == 'pl')
            {!! @$LanguageContent->privacy_policy_pl !!}
          @elseif(app()->getLocale() == 'de')
            {!! @$LanguageContent->privacy_policy_de !!}
          @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
            @lang('inner-content.home-new.privacy_policy')
          @endif
        </a></li>
            <li><a href="<?php echo url('terms-conditions'); ?>"><i class="fa fa-angle-right pr-1"></i> 
           
          @if(app()->getLocale() == 'en')	
            {!! @$LanguageContent->terms_en !!}
          @elseif(app()->getLocale() == 'pl')
            {!! @$LanguageContent->terms_pl !!}
          @elseif(app()->getLocale() == 'de')
            {!! @$LanguageContent->terms_de !!}
          @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
            @lang('inner-content.home-new.terms')
          @endif
          </a></li>
            <!--li><a href="#"><i class="fa fa-angle-right pr-1"></i> @lang('inner-content.frontend.footer.disclaimer')</a></li-->
            <li><a href="{{url('contact')}}"><i class="fa fa-angle-right pr-1"></i>
          @if(app()->getLocale() == 'en')	
            {!! @$LanguageContent->contact_footer_en !!}
          @elseif(app()->getLocale() == 'pl')
            {!! @$LanguageContent->contact_footer_pl !!}
          @elseif(app()->getLocale() == 'de')
            {!! @$LanguageContent->contact_footer_de !!}
          @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
            @lang('inner-content.home-new.contact_footer')
          @endif
      </a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h6 class="text-white has-small-font-size">
          @if(app()->getLocale() == 'en')	
            {!! @$LanguageContent->contact_info_en !!}
          @elseif(app()->getLocale() == 'pl')
            {!! @$LanguageContent->contact_info_pl !!}
          @elseif(app()->getLocale() == 'de')
            {!! @$LanguageContent->contact_info_de !!}
          @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
            @lang('inner-content.home-new.contact_info')
          @endif
      </h6>
          <hr>
          <ul class="has-small-font-size pl-0 list-unstyled">
            <!--li><span class="text-white">{!! nl2br(Settings()->address) !!}</span></li-->
            <li><span class="text-white">
            @if(app()->getLocale() == 'en')	
              {!! @$LanguageContent->fulladdress_en !!}
            @elseif(app()->getLocale() == 'pl')
              {!! @$LanguageContent->fulladdress_pl !!}
            @elseif(app()->getLocale() == 'de')
              {!! @$LanguageContent->fulladdress_de !!}
            @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
              @lang('inner-content.home-new.fulladdress')
            @endif
            </span></li>
            @if(app()->getLocale() == 'en')
              <li><a href="tel:@lang('inner-content.frontend.contactsec.phone-2')"><i class="fas fa-phone-square-alt"></i> @lang('inner-content.frontend.contactsec.phone-2')</a></li>
            @elseif(app()->getLocale() == 'pl')
              <li><a href="tel:@lang('inner-content.frontend.contactsec.phone-1')"><i class="fas fa-phone-square-alt"></i> @lang('inner-content.frontend.contactsec.phone-1')</a></li>
            @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
              <li><a href="tel:@lang('inner-content.home-new.footer_phone')"><i class="fas fa-phone-square-alt"></i> @lang('inner-content.home-new.footer_phone')</a></li>
            @endif
            <li><a href="mailto:{{ Settings()->email }}"><i class="fas fa-envelope-open-text"></i> {{ Settings()->email }}</a></li>
          </ul>
        </div>
        <div class="col-md-2"></div>
      </div>
      <hr>
    </div>
    <div class="copyright text-center text-white pb-3">
      <p class="m-0 copyright">
      <li><span class="text-white">
            @if(app()->getLocale() == 'en')	
              {!! @$LanguageContent->copyright_en !!}
            @elseif(app()->getLocale() == 'pl')
              {!! @$LanguageContent->copyright_pl !!}
            @elseif(app()->getLocale() == 'de')
              {!! @$LanguageContent->copyright_de !!}
            @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
              @lang('inner-content.home-new.copyright')
            @endif
             © {{date('Y')}} <!--<a class="script-font" href="{{ url('/') }}">{{ env('APP_NAME')}}</a>-->.
             @if(app()->getLocale() == 'en')	
              {!! @$LanguageContent->copyright_content_en !!}
            @elseif(app()->getLocale() == 'pl')
              {!! @$LanguageContent->copyright_content_pl !!}
            @elseif(app()->getLocale() == 'de')
              {!! @$LanguageContent->copyright_content_de !!}
            @elseif(app()->getLocale() == 'ru' || app()->getLocale() == 'es' || app()->getLocale() == 'fr')
              @lang('inner-content.home-new.copyright_content')
            @endif.</p>
    </div>
  </section>
</footer>
