@extends('frontend.layouts.app-fullwidth')
@section('title', Settings()->site_name . ' | ' . __('navs.general.home'))
@section('classes', 'home has-slider')
@section('slider')
<div class="page-header mb-0 pb-0 pt-0" style="background-image: url('{{ asset('img/vegking-banner-bg.png')}}');min-height: 100px;">
	<input type="hidden" name="ip" id="ip" value="">
	<div class="overlay" style="background-color: transparent;opacity:1"></div>
	<div class="page-header-bg text-center" style="position: static;opacity: 1;min-height: 100px;">
		<img src="{{ asset('img/Head-veking-map-background.jpg').getAutoVersion('img/Head-veking-map-background.jpg')}}" style="max-width:100%">
	</div>
	<div class="VegkingBannerBtns overlay-btns">
		<div class="wrap-inner">
			<div class="row">
				<div class="farmer-box" onmouseover="hoverfarmer(this);" onmouseout="unhoverfarmer(this);" >
					<div id="sellerbtn">
						<a class="btn home-btn mb-4" @hasanyrole('seller') href="{{ url('seller/dashboard')}}" @else data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('seller')" href="javascript:;" @endhasanyrole>@lang('inner-content.frontend.homepage-content.sell')</a>
					</div>
					<img id="farmer_img" src="{{ asset('img/farmer-yellow.png').getAutoVersion('img/farmer-yellow.png')}}" style="max-width:100%" @hasanyrole('seller') onclick="location.href = '{{ url('seller/dashboard')}}';" @else onclick="setRole('seller')" data-toggle="modal" data-target="#sellercontact_modal" @endhasanyrole>
				</div>
				<div class="logo-box">
					<?php if(app()->getLocale() != 'en'){ ?>
						<?php $image_name_sitewise = 'img/banner-middle-logo-'.app()->getLocale().'.png'; ?>
						<a href="{{ url('/?offer=0') }}"><img src="<?php echo asset($image_name_sitewise).getAutoVersion('img/banner-middle-logo.png') ?>" style="max-width:100%"></a>
					<?php }else{ ?>
						<?php $image_name_sitewise = 'img/banner-middle-logo.png'; ?>
						<a href="{{ url('/?offer=0') }}"><img src="<?php echo asset($image_name_sitewise).getAutoVersion('img/banner-middle-logo.png') ?>" style="max-width:100%"></a>
					<?php } ?>
				</div>
				<div class="market-box" onmouseover="hovermarket(this);" onmouseout="unhovermarket(this);">
					<div id="buyerbtn">
						<a class="btn home-btn mb-4" @hasanyrole('buyer') href="{{ url('buyer/dashboard')}}" @else data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('buyer')" href="javascript:;" @endhasanyrole>@lang('inner-content.frontend.homepage-content.buy')</a>
					</div>
					<img id="market_img" src="{{ asset('img/market-yellow.png').getAutoVersion('img/market-yellow.png')}}" style="max-width:100%" @hasanyrole('buyer') onclick="location.href = '{{ url('buyer/dashboard')}}';" @else onclick="setRole('buyer')" data-toggle="modal" data-target="#sellercontact_modal" @endhasanyrole>
				</div>
			</div>
			<div class="overlay-header-title d-none">
				<h1 class="display-4 text-white mb-3 text-center"><mark>@lang('inner-content.frontend.homepage-content.slider-title')</mark></h1>
			</div>
		</div>
	</div>
	<div class="container pb-3 butonsgrp-mobile" style="min-height:100px">
		<div class="text-center" style="width:100%">
			<div class="w-100 text-white">
				<h1 class="display-4 text-white mb-3">@lang('inner-content.frontend.homepage-content.slider-title')</h1>
				<div class="VegkingBannerBtns">
					<div id="buymobile">
						<a class="btn home-btn mr-3 text-uppercase" @hasanyrole('buyer') href="{{ url('buyer/dashboard')}}" @else data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('buyer')" href="javascript:;" @endhasanyrole>@lang('inner-content.frontend.homepage-content.buy')</a>
					</div>
					<div id="sellmobile">
						<a class="btn home-btn text-uppercase" @hasanyrole('seller') href="{{ url('seller/dashboard')}}" @else data-toggle="modal" data-target="#sellercontact_modal" onclick="setRole('seller')" href="javascript:;" @endhasanyrole>@lang('inner-content.frontend.homepage-content.sell')</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('content')
<section id="aboutus" class="about pt-5 pb-5">
	<div class="container">
		<div class="row pb-3">
			<div class="col-md-6">
				<div class="author-image mb-4">
					<!--<img src="{{asset('img/british-flag-1907933.jpg')}}" width="100%;" height="100%;">-->
					<div class="embed-responsive embed-responsive-16by9">
						<!--<iframe id="video_player"  class="embed-responsive-item" src="{{asset('img/Option3.mp4')}}" controls autoplay loop allowfullscreen></iframe>-->
						<video width="400" controls autoplay muted loop allowfullscreen onloadstart="this.volume=0.2">
	            @if(app()->getLocale() == 'pl')
	              <source src="{{asset('img/Option3.mp4')}}" type="video/mp4">
							@else
	              <source src="{{asset('img/VEG-KING-eng.mp4')}}" type="video/mp4">
	            @endif
						  Your browser does not support HTML5 video.
						</video>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				@if(app()->getLocale() == 'en')	
					{!! @$LanguageContent->section_1_en !!}
				@elseif(app()->getLocale() == 'pl')
					{!! @$LanguageContent->section_1_pl !!}
				@elseif(app()->getLocale() == 'de')
					{!! @$LanguageContent->section_1_de !!}
				@endif

				<button class="btn btn-outline-success btn-lg text-uppercase" id="LearnMoreBtnn">
				@if(app()->getLocale() == 'en')	
					{{@$LanguageContent->read_more_en}}
				@elseif(app()->getLocale() == 'pl')
					{{@$LanguageContent->read_more_pl}}
				@elseif(app()->getLocale() == 'de')
					{{@$LanguageContent->read_more_de}}
				@endif
				</button>
			</div>
			<div class="col-md-12" id="LearnMoredescription" style="display: none;">
				@if(app()->getLocale() == 'en')	
					{!! @$LanguageContent->read_more_content_en !!}
				@elseif(app()->getLocale() == 'pl')
					{!! @$LanguageContent->read_more_content_pl !!}
				@elseif(app()->getLocale() == 'de')
					{!! @$LanguageContent->read_more_content_de !!}
				@endif
			</div>
		</div>
	</div>
</section>

<section class="services-import section-first">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <h4 class="ImportExportText">
			
				@if(app()->getLocale() == 'en')	
					{!! @$LanguageContent->import_en !!}
				@elseif(app()->getLocale() == 'pl')
					{!! @$LanguageContent->import_pl !!}
				@elseif(app()->getLocale() == 'de')
					{!! @$LanguageContent->import_de !!}
				@endif
			</h4>
            </div>
        </div>
    </div>
	<div class="container" id="import-link">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 section-short">
				<!--<h2>@lang('inner-content.frontend.section-short-inner.import')</h2>-->
				<div class="section-short-inner">
					<figure> <img src="{{ asset('img/offer.png') }}" alt="" width="93" height="94"> </figure>
					<h5>
							@if(app()->getLocale() == 'en')	
							{!! @$LanguageContent->heading_col_1_en !!}
							@elseif(app()->getLocale() == 'pl')
								{!! @$LanguageContent->heading_col_1_pl !!}
							@elseif(app()->getLocale() == 'de')
								{!! @$LanguageContent->heading_col_1_de !!}
							@endif
					</h5>
					<span class="line"><em></em></span>
					<div>
						<p>
							@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->import_col_1_en !!}
							@elseif(app()->getLocale() == 'pl')
								{!! @$LanguageContent->import_col_1_pl !!}
							@elseif(app()->getLocale() == 'de')
								{!! @$LanguageContent->import_col_1_de !!}
							@endif
						</p>
					</div>
					<a href="" class="btn"></a> </div>
					<div class="bg" style="display: block; left: -100%; top: 0px; transition: all 333ms ease 0s;"></div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 section-short">
					<h2></h2>
					<div class="section-short-inner">
						<figure> <img src="{{ asset('img/import-2-yellow.png') }}" alt="" width="80" height="95"> </figure>
						<h5>
						@if(app()->getLocale() == 'en')	
							{!! @$LanguageContent->heading_col_2_en !!}
							@elseif(app()->getLocale() == 'pl')
								{!! @$LanguageContent->heading_col_2_pl !!}
							@elseif(app()->getLocale() == 'de')
								{!! @$LanguageContent->heading_col_2_de !!}
							@endif
						</h5>
						<span class="line"><em></em></span>
						<div>
							<p>
							@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->import_col_2_en !!}
							@elseif(app()->getLocale() == 'pl')
								{!! @$LanguageContent->import_col_2_pl !!}
							@elseif(app()->getLocale() == 'de')
								{!! @$LanguageContent->import_col_2_de !!}
							@endif
							</p>
						</div>
						<a href="" class="btn"></a> </div>
						<div class="bg" style="display: block; left: -100%; top: 0px; transition: all 333ms ease 0s;"></div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 section-short">
						<h2></h2>
						<div class="section-short-inner">
							<figure> <img src="{{ asset('img/vegetablesyellow.png') }}" alt="" width="95" height="101"> </figure>
							<h5>
								@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->heading_col_3_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->heading_col_3_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->heading_col_3_de !!}
								@endif
							</h5>
							<span class="line"><em></em></span>
							<div>
								<p>
								@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->import_col_3_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->import_col_3_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->import_col_3_de !!}
								@endif
								</p>
							</div>
							<a href="" class="btn"></a> </div>
							<div class="bg" style="display: block; left: -100%; top: 0px; transition: all 333ms ease 0s;"></div>
						</div>
					</div>
				</div>
			</section>

			<section class="services-export">
                <div class="container-fluid">
                   <div class="row">
                      <div class="col-md-12">
                        <h4 class="ImportExportText">
							@if(app()->getLocale() == 'en')	
							{!! @$LanguageContent->export_en !!}
							@elseif(app()->getLocale() == 'pl')
								{!! @$LanguageContent->export_pl !!}
							@elseif(app()->getLocale() == 'de')
								{!! @$LanguageContent->export_de !!}
							@endif
						</h4>
                      </div>
                   </div>
                </div>
				<div class="container" id="export-link">
					<div class="row"><div class="col-xs-12 col-sm-12 col-md-4 section-short">
						<!--<h2>@lang('inner-content.frontend.section-short-inner.export')</h2>-->
						<div class="section-short-inner">
							<figure>
								<img src="{{ asset('img/export-1.png') }}" alt="" width="92" height="94">
							</figure>
							<h5>
							@if(app()->getLocale() == 'en')	
							{!! @$LanguageContent->heading_row_1_en !!}
							@elseif(app()->getLocale() == 'pl')
								{!! @$LanguageContent->heading_row_1_pl !!}
							@elseif(app()->getLocale() == 'de')
								{!! @$LanguageContent->heading_row_1_de !!}
							@endif
							</h5>
							<span class="line"><em></em></span>
							<div>
								<p>
								@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->Export_row_1_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->Export_row_1_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->Export_row_1_de !!}
								@endif
								</p>
							</div>
							<a href="" class="btn"></a>
						</div>
						<div class="bg" style="display: block; left: -100%; top: 0px; transition: all 333ms ease 0s;"></div>
					</div><div class="col-xs-12 col-sm-12 col-md-4 section-short">
						<h2></h2>
						<div class="section-short-inner">
							<figure>
								<img src="{{ asset('img/fast-delivery-yellow.png') }}" alt="" width="94" height="96">
							</figure>
							<h5>
							@if(app()->getLocale() == 'en')	
							{!! @$LanguageContent->heading_row_2_en !!}
							@elseif(app()->getLocale() == 'pl')
								{!! @$LanguageContent->heading_row_2_pl !!}
							@elseif(app()->getLocale() == 'de')
								{!! @$LanguageContent->heading_row_2_de !!}
							@endif
							</h5>
							<span class="line"><em></em></span>
							<div>
								<p>
								@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->Export_row_2_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->Export_row_2_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->Export_row_2_de !!}
								@endif
								</p>
							</div>
							<a href="" class="btn"></a>
						</div>
						<div class="bg" style="display: block; left: -100%; top: 0px; transition: all 333ms ease 0s;"></div>
					</div><div class="col-xs-12 col-sm-12 col-md-4 section-short">
						<h2></h2>
						<div class="section-short-inner">
							<figure>
								<img src="{{ asset('img/export-3.png') }}" alt="" width="92" height="94">
							</figure>
							<h5>
							@if(app()->getLocale() == 'en')	
							{!! @$LanguageContent->heading_row_3_en !!}
							@elseif(app()->getLocale() == 'pl')
								{!! @$LanguageContent->heading_row_3_pl !!}
							@elseif(app()->getLocale() == 'de')
								{!! @$LanguageContent->heading_row_3_de !!}
							@endif
							</h5>
							<span class="line"><em></em></span>
							<div>
								<p>
								@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->Export_row_3_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->Export_row_3_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->Export_row_3_de !!}
								@endif
								</p>
							</div>
							<a href="" class="btn"></a>
						</div>
						<div class="bg" style="display: block; left: -100%; top: 0px; transition: all 333ms ease 0s;"></div>
					</div></div>
				</div>
			</section>

			<section class="container-fluid NewsLetterSec">
				<div class="row">
					<div class="col-md-4">
						<div class="SignUpSec">
							<h2>
							    @if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->newsletter_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->newsletter_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->newsletter_de !!}
								@endif
							</h2>
							<p>@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->newsletter_content_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->newsletter_content_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->newsletter_content_de !!}
								@endif

							</p>
							<div class="EqualLabelFiled">
								{{ html()->form('POST', route('frontend.subscribe'))->id('subscribe_form')->open() }}
								<input type="email" id="subscriber_email" name="email" placeholder="E-MAIL" required>
								<button class="signupbtn" type="submit"><img src="<?php echo URL::to('/') ?>/img/envelopegreen.png"></button>
								{{ html()->form()->close() }}
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="row NewproductSecmain">
							<div class="col-md-6">
								<div class="NewproductSec">
									<h2>
									@if(app()->getLocale() == 'en')	
									{!! @$LanguageContent->poffers_en !!}
									@elseif(app()->getLocale() == 'pl')
										{!! @$LanguageContent->poffers_pl !!}
									@elseif(app()->getLocale() == 'de')
										{!! @$LanguageContent->poffers_de !!}
									@endif
									</h2>
									<h6 class="newsleeterTextForDesktop">@lang('inner-content.frontend.newlettersec.beets')</h6>
									<p class="d-none">@lang('inner-content.frontend.newlettersec.beets-content')</p>
									<button class="Seeofferbtn" data-toggle="modal" data-target="#products_modal">@lang('inner-content.frontend.newlettersec.see-offer')</button>
                                    <h6 class="newsleeterTextForMobile">@lang('inner-content.frontend.newlettersec.beets')</h6>
								</div>
							</div>
							<div class="col-md-6">
								<div class="productimageSec" style="background-image:url('<?php echo URL::to('/') ?>/img/offer-potatoes.jpg');">
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="salesHomesec">
            <div class="container-fluid">
            <div class="row">
						<div class="col-md-12">
							<h1 class="ContactPageHeading ContactPageHeadingFirstt">
								@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->sale_tittle_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->sale_tittle_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->sale_tittle_de !!}
								@endif
							</h1>
						</div>
					</div>
            </div>
				<div class="container pb-5 pt-5">
					<div class="row">
						<div class="col-md-3">
							
						</div>
						<div class="col-md-6">
							<div class="SinglePersonDetails gregbg">

								<div class="row">
									<div class="col-md-4">
										<img src="<?php echo URL::to('/') ?>/img/c-user-profile-green.png" class="img-fluid UserProfileimg">
									</div>
									<div class="col-md-8">
										<ul class="ProfileDetails">
											<li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-user-profile-name.png" class="userprofileicon"></span><span class="righttext">@lang('inner-content.frontend.salessec.name-2')</span></li>
											<li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-whatsapcalling.png" class="whatsapcallingicon"></span><a class="righttext" href="https://wa.me/@lang('inner-content.frontend.salessec.phone-2')" target="_blank">@lang('inner-content.frontend.salessec.phone-2')</a></li>
											<li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-email.png" class="emailicon"></span><a class="righttext" href="mailto:@lang('inner-content.frontend.salessec.email-2')">@lang('inner-content.frontend.salessec.email-2')</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							
						</div>
					</div>

					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="LocationaddressSec mb-3 pl-4 pr-4 pb-3" style="background-color: rgb(244, 244, 244);padding: 15px 0px 5px;border-radius: 10px;text-align: center;">
								@if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->sale_email_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->sale_email_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->sale_email_de !!}
								@endif	
							<br>
								<img src="<?php echo URL::to('/') ?>/img/c-email.png" class="emailicon2"> &nbsp;<a href="mailto:team@vegking.eu" class="" style="color: #000000;">team@vegking.eu</a>
							</div>
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>
			</section>

			<section class="ContactHomeSec">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1 class="ContactPageHeading">
							   @if(app()->getLocale() == 'en')	
								{!! @$LanguageContent->contact_heading_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->contact_heading_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->contact_heading_de !!}
								@endif
							</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="LocationaddressSec mb-2">
								<ul>
									<li class="polandAlignText"><span class="righttext"><img src="<?php echo URL::to('/') ?>/img/c-polland-flag.png" class="LocationFlag"></span><span class="lefttext">@lang('inner-content.frontend.contactsec.country-1')</span></li>
								</ul>
								<p class="AddressText" style="min-height: 90px;">@lang('inner-content.frontend.contactsec.address-1')</p>
								<div class="SinglePersonDetails">
									<ul class="ProfileDetails">
										<li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-whatsapcalling.png" class="whatsapcallingicon"></span><a class="righttext" href="https://wa.me/@lang('inner-content.frontend.contactsec.phone-1')" target="_blank">@lang('inner-content.frontend.contactsec.phone-1')</a></li>
										<li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-email.png" class="emailicon"></span><a class="righttext" href="mailto:@lang('inner-content.frontend.contactsec.email-1')">@lang('inner-content.frontend.contactsec.email-1')</a></li>
									</ul>
								</div>
							</div>

							<?php /*?><div class="row">
								<div class="col-md-6">
									<div class="LocationaddressSec mb-3 pl-4 pr-4 pb-3 text-white">
										@if(app()->getLocale() == 'en')
										<i class="fas fa-envelope-open-text"></i> Accounting email: <br>
										<a href="mailto:accounts@vegking.eu" class="text-white">accounts@vegking.eu</a>
										@elseif(app()->getLocale() == 'pl')
										<i class="fas fa-envelope-open-text"></i> Księgowość email: <br>
										<a href="mailto:accounts@vegking.eu" class="text-white">accounts@vegking.eu</a>
										@endif
									</div>
								</div>
								<div class="col-md-6">
									<div class="LocationaddressSec mb-3 pl-4 pr-4 pb-3 text-white">
										@if(app()->getLocale() == 'en')
										<i class="fas fa-envelope-open-text"></i> @lang('inner-content.frontend.salessec.title-2'): <br>
										<a href="mailto:team@vegking.eu" class="text-white">team@vegking.eu</a>
										@elseif(app()->getLocale() == 'pl')
										<i class="fas fa-envelope-open-text"></i> @lang('inner-content.frontend.salessec.title-2'): <br>
										<a href="mailto:team@vegking.eu" class="text-white">team@vegking.eu</a>
										@endif

									</div>
								</div>
							</div><?php */?>

						</div>
						<div class="col-md-6">
							<div class="LocationaddressSec mb-2">
								<ul>
									<li><span class="righttext"><img src="<?php echo URL::to('/') ?>/img/c-us-flag.png" class="LocationFlag"></span><span class="lefttext">@lang('inner-content.frontend.contactsec.country-2')</span></li>
								</ul>
								<p class="AddressText">@lang('inner-content.frontend.contactsec.address-2')</p>
								<div class="SinglePersonDetails">
									<ul class="ProfileDetails">
										<li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-whatsapcalling.png" class="whatsapcallingicon"></span><a class="righttext" href="https://wa.me/@lang('inner-content.frontend.contactsec.phone-2')" target="_blank">@lang('inner-content.frontend.contactsec.phone-2')</a></li>
										<li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-email.png" class="emailicon"></span><a class="righttext" href="mailto:@lang('inner-content.frontend.contactsec.email-2')">@lang('inner-content.frontend.contactsec.email-2')</a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-12">
							<p class="footerbottomText">	
								@if(app()->getLocale() == 'en')	
									{!! @$LanguageContent->contact_content_en !!}
								@elseif(app()->getLocale() == 'pl')
									{!! @$LanguageContent->contact_content_pl !!}
								@elseif(app()->getLocale() == 'de')
									{!! @$LanguageContent->contact_content_de !!}
								@endif</p>
						</div>
					</div>
				</div>
			</section>

			@endsection

			@push('after-scripts')

			<script src="https://www.jqueryscript.net/demo/Detect-Browser-Device-OS/dist/jquery.device.detector.js"></script>

<script type="text/javascript">
function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
          tmp = item.split("=");
          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}
$(document).ready(function(){
    offer_param = findGetParameter('offer');
    if(offer_param != null){
        offer_param = offer_param * 1000;
        setTimeout(function(){
            $("#offer_menu").click();
        }, offer_param);
        
    }
});
jQuery(document).on("click",".HeaderMenusSec ul li a, .footer-link a",function(event){
            var thishref =$(this).attr("href");
            var url = thishref.substr(thishref.indexOf("#"));
            if(url.length>1){
                event.preventDefault();

                     if (window.matchMedia('(min-width: 992px)').matches) {
                        $('html, body').animate({
                                  scrollTop: $(url).offset().top
                        }, 1000);
                     } if (window.matchMedia('(max-width: 991px)').matches) {
                        $('html, body').animate({
                                  scrollTop: $(url).offset().top-210
                        }, 1000);
                     }

            }
    });

 /* jQuery(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 200) {
            jQuery("#main-menu").addClass("Fixedheader");
        }else {
            jQuery("#main-menu").removeClass("Fixedheader");
        }
    }); */

           
			$(".section-short").hover(function(){
				$(this).addClass('hovered');
				$(this).find('.bg').css({"left": "0", "top": "0"});
			}, function(){
				$(this).removeClass('hovered');
				$(this).find('.bg').css({"left": "100%", "top": "0"});
			});

			@if($user_id)
			@php $user_id = $user_id; @endphp
			@else
			@php $user_id = 0; @endphp
			@endif
			$( document ).ready(function() {
				var user_id = {{ $user_id }};
				$.ajax({
					url: "https://jsonip.com",
					type: 'get',
					cache: false,
					success: function(res){
						console.log(res.ip)	;
						$("#ip").val(res.ip);
						var ip = $("#ip").val();
						var instance = $.fn.deviceDetector;

						$.ajax({
							url: "{{ route('frontend.referrer') }}",
							type: 'get',
							cache: false,
							data:{'_token':$('meta[name="csrf-token"]').attr('content'), 'browser_name':instance.getBrowserName(),'os_name':instance.getOsName(),'os_version': instance.getOsVersion(),'ip':ip ,'user_id':user_id },
							success: function(result){
								console.log("success");
							}
						});
					}
				});
			});

			$(function(){
				$('#LearnMoreBtnn').click(function(){
					$('#LearnMoredescription').toggle("slow");
				});
				$('#more_cookies_btn').click(function(){
					$('#more_cookies').toggle("fast");
					if($('#more_cookies').is(":visible")){
						$('#more_cookies_btn').hide();
						$('#cookie_pre_text').removeClass('pre');
					}
				});
			});

       $('#subscribe_form').on('submit', function(event) {
         event.preventDefault();
         var formData = new FormData(this);
         $.ajax({
            url: this.action,
            method: "post",
            processData: false,
            contentType: false,
            data: formData,
         }).done(function(response){
            if(response.status == 'success'){
               $('#subscribe_form').parent().append('<div class="text-white">You have successfully subscribed!</div>');
							 $('#subscribe_form #subscriber_email').val('');
            }else if(response.status == 'updated'){
							 $('#subscribe_form').parent().append('<div class="text-white">You are already subscribed!</div>');
							 $('#subscribe_form #subscriber_email').val('');
						}
         }).fail(function(jqXHR, textStatus){
            alert('Some error occurred. Please try again.');
         }).always(function(){
            $("#buyercontact_form .btn.btn-success").removeAttr('disabled');
         });
      });

			function hoverfarmer(element) {
			  $('#farmer_img').attr('src', '{{ asset("img/farmer-green.png").getAutoVersion("img/farmer-green.png")}}');
			}
			function unhoverfarmer(element) {
			  $('#farmer_img').attr('src', '{{ asset("img/farmer-yellow.png").getAutoVersion("img/farmer-yellow.png")}}');
			}
			function hovermarket(element) {
			  $('#market_img').attr('src', '{{ asset("img/market-green.png").getAutoVersion("img/market-green.png")}}');
			}
			function unhovermarket(element) {
			  $('#market_img').attr('src', '{{ asset("img/market-yellow.png").getAutoVersion("img/market-yellow.png")}}');
			}
    </script>

		@endpush
