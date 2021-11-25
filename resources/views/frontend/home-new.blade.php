@extends('frontend.layouts.home-v2')
@section('title', Settings()->site_name . ' | ' . __('navs.general.home'))
@section('classes', 'home has-slider')
@push('after-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/style-v2.css').getAutoVersion('css/style-v2.css')}}">
@endpush
@section('slider')
@endsection
@section('content')
<div class="headerbg">
   <div class="overlay"></div>
   <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
      <source src="{{asset('video/vk-full.mp4')}}" type="video/mp4">
   </video>
   <div class="container">
      <h3 style="color:white;text-align:center"> {{ Session::get('message')}}</h3>
      <div class="d-flex slider-text-bottom text-center">
         <div class="slider-text-bottom text-white">
            <div class="bg-supplires">
               <h1 class="display-3">@lang('inner-content.home-new.header_text')</h1>
               <a data-toggle="modal" data-target="#sellercontact_modal" role="buyer" register-text="Buyer Register" href="javascript:;" class="setrole btn slider-btn btn-lg mt-4">@lang('inner-content.home-new.buy_now')</a>
            </div>
         </div>
      </div>
   </div>
</div>
<section id="value-money" class="about pt-5 pb-5">
   <div class="container mt-5 mb-5">
      <div class="row">
         <div class="col-md-4 mb-3">
            <div class="box-value">
               <div class="box-value-2">
                  <div class="value-image">
                     <img src="{{asset('images/home-v2/money1.png') }}">
                  </div>
                  <h4>@lang('inner-content.home-new.value_for_money')</h4>
               </div>
            </div>
         </div>
         <div class="col-md-4 mb-3">
            <div class="box-value">
               <div class="box-value-2">
                  <div class="value-image">
                     <img src="{{asset('images/home-v2/tranxport11.png') }}">
                  </div>
                  <h4>@lang('inner-content.home-new.transport_handled')</h4>
               </div>
            </div>
         </div>
         <div class="col-md-4 mb-3">
            <div class="box-value">
               <div class="box-value-2">
                  <div class="value-image">
                     <img src="{{asset('images/home-v2/quality11.png') }}">
                  </div>
                  <h4>@lang('inner-content.home-new.quality_control')</h4>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="infographic pb-5">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center">
            <h2 class="section-title"><span>@lang('inner-content.home-new.how_we_work')</span></h2>
            <div id="timelinenew">
               <div class="row timelinenew-movement">
                  <div class="offset-sm-5 col-sm-7 timelinenew-item">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="timelinenew-panel debits  anim animate  fadeInRight">
                              <ul class="timelinenew-panel-ul">
                                 <li>
                                    <div>
                                       <span class="cinfo">
                                       <img class="c" src="{{asset('images/home-v2/yellow-circlem.png') }}">
                                       </span>
                                       <span class="steinfo">
                                       <b>@lang('inner-content.home-new.steps') <font>01</font></b>
                                       </span>
                                       <span class="cnminfo">
                                          <p>@lang('inner-content.home-new.needs')</p>
                                       </span>
                                       <span class="qinfo">
                                       <img src="{{asset('images/home-v2/quest.png') }}">
                                       </span>
                                    </div>
                                 </li>
                                 <div class="clear"></div>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row timelinenew-movement">
                  <div class="col-sm-7 timelinenew-item">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="timelinenew-panel credits grninfo anim animatedm fadeInLeft">
                              <ul class="timelinenew-panel-ul">
							  <div class="clear"></div>
                                 <li class="grninfo1">
                                    <div>
                                       <span class="qinfo">
                                       <img src="{{asset('images/home-v2/doller-tag.png') }}">
                                       </span>
                                       <span class="steinfo">
                                       <b>@lang('inner-content.home-new.steps') <font>02</font></b>
                                       </span>
                                       <span class="cnminfo">
                                          <p>@lang('inner-content.home-new.offer')</p>
                                       </span>
                                       <span class="cinfo">
                                       <img src="{{asset('images/home-v2/green-circlem.png') }}">
                                       </span>
                                    </div>
                                 </li>
                                 <div class="clear"></div>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row timelinenew-movement">
                  <div class="offset-sm-5 col-sm-7 timelinenew-item">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="timelinenew-panel debits  anim animatedm  fadeInRight">
                              <ul class="timelinenew-panel-ul">
                                 <li class="linegren">
                                    <div>
                                       <span class="cinfo">
                                       <img class="c" src="{{asset('images/home-v2/yellow-circlem.png') }}">
                                       </span>
                                       <span class="steinfo">
                                       <b>@lang('inner-content.home-new.steps') <font>03</font></b>
                                       </span>
                                       <span class="cnminfo">
                                          <p>@lang('inner-content.home-new.you') <br>@lang('inner-content.home-new.compare')</p>
                                       </span>
                                       <span class="qinfo">
                                       <img src="{{asset('images/home-v2/scale-iconm.png') }}">
                                       </span>
                                    </div>
                                 </li>
                                 <div class="clear"></div>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row timelinenew-movement">
                  <div class="offset-sm-5 col-sm-7 timelinenew-item">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="timelinenew-panel debits  anim animatedm  fadeInRight">
                              <ul class="timelinenew-panel-ul">
                                 <li >
                                    <div>
                                       <span class="cinfo">
                                       <img class="c" src="{{asset('images/home-v2/yellow-circlem.png') }}">
                                       </span>
                                       <span class="steinfo">
                                       <b>@lang('inner-content.home-new.steps') <font>04</font></b>
                                       </span>
                                       <span class="cnminfo">
                                          <p>@lang('inner-content.home-new.you') <br>@lang('inner-content.home-new.choose')</p>
                                       </span>
                                       <span class="qinfo">
                                       <img src="{{asset('images/home-v2/check-icnm.png') }}">
                                       </span>
                                    </div>
                                 </li>
                                 <div class="clear"></div>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row timelinenew-movement">
                  <div class="col-sm-7 timelinenew-item">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="timelinenew-panel credits grninfo anim animatedm fadeInLeft">
                              <ul class="timelinenew-panel-ul">
                                 <li class="grninfo1">
                                    <div>
                                       <span class="qinfo">
                                       <img src="{{asset('images/home-v2/deil-iconm.png') }}">
                                       </span>
                                       <span class="steinfo">
                                       <b>@lang('inner-content.home-new.steps') <font>05</font></b>
                                       </span>
                                       <span class="cnminfo">
                                          <p>@lang('inner-content.home-new.we') <br>@lang('inner-content.home-new.deliver')</p>
                                       </span>
                                       <span class="cinfo">
                                       <img src="{{asset('images/home-v2/green-circlem.png') }}">
                                       </span>
                                    </div>
                                 </li>
                                 <div class="clear"></div>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-5"></div>
      </div>
   </div>
</section>
<section class="grew-business pb-5">
   <div class="container">
      <div class="col-md-12 text-center">
         <button class="btn slider-btn btn-lg mb-5" data-toggle="modal" data-target="#products_modal">@lang('inner-content.home-new.see_our_offers')</button>
         <div class="row">
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter potato">
               <div class="data-veg">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
                  <img src="{{asset('images/home-v2/apple_home.jpg') }}" class="img-responsive">
                  <div class="centered">@lang('inner-content.home-new.apple')</div>
                </a>
               </div>
            </div>
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter potato">
               <div class="data-veg">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
                  <img src="{{asset('images/home-v2/tomato.jpg') }}" class="img-responsive">
                  <div class="centered">@lang('inner-content.home-new.tomato')</div>
                </a>
               </div>
            </div>
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter potato">
               <div class="data-veg">
               <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
                  <img src="{{asset('images/home-v2/onion_peeled.jpg') }}" class="img-responsive">
                  <div class="centered">@lang('inner-content.home-new.peeled_onions')</div>
               </a>
               </div>
            </div>
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter tomato">
               <div class="data-veg">
               <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
                  <img src="{{asset('images/home-v2/cauliflower_home.jpg') }}" class="img-responsive">
                  <div class="centered">@lang('inner-content.home-new.cauliflower')</div>
               </a>
               </div>
            </div>
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter potato">
               <div class="data-veg">
               <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
                  <img src="{{asset('images/home-v2/brocolli_home.jpg') }}" class="img-responsive">
                  <div class="centered">@lang('inner-content.home-new.broccoli')</div>
               </a>
               </div>
            </div>
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter tomato">
               <div class="data-veg">
               <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
                  <img src="{{asset('images/home-v2/offer-potatoes.jpg') }}" class="img-responsive">
                  <div class="centered">@lang('inner-content.home-new.potato')</div>
               </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="save-money pb-5">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="container-bg">
               <div class="text-center">
                  <h2 class="section-title"><span>@lang('inner-content.home-new.buy_value') </span></h2>
               </div>
               <div class="save-money-content">
                  <h3>@lang('inner-content.home-new.buy_value_desc') </h3>
                  @lang('inner-content.home-new.buy_value_content')                        
               </div>
               <div class="mt-5 text-center">
                  <a data-toggle="modal" data-target="#sellercontact_modal" role="buyer" register-text="Buyer Register" href="javascript:;" class="setrole btn slider-btn btn-lg mt-4">@lang('inner-content.home-new.join_now')</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section id="service-sellers" class="about pb-5">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center mt-5">
            <h2 class="section-title"><span>@lang('inner-content.home-new.our_service_for_sellers')</span></h2>
         </div>
         <div class="col-md-12 service-text">
            <div class="row">
               <div class="col-md-4 mb-3">
                  <div class="box-value">
                     <div class="box-value-2">
                        <div class="value-image">
                           <img src="{{asset('images/home-v2/profit-increase.png') }}">
                        </div>
                        <h4>@lang('inner-content.home-new.profit_increase')</h4>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="box-value">
                     <div class="box-value-2">
                        <div class="value-image">
                           <img src="{{asset('images/home-v2/tranxport11.png') }}">
                        </div>
                        <h4>@lang('inner-content.home-new.transport_handled')</h4>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                  <div class="box-value">
                     <div class="box-value-2">
                        <div class="value-image">
                           <img src="{{asset('images/home-v2/quicksales.png') }}">
                        </div>
                        <h4>@lang('inner-content.home-new.quick_sales')</h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12 text-center mt-3 mb-5">
            <h3 class="mb-4">@lang('inner-content.home-new.sell_to_vegking')</h3>
            <a data-toggle="modal" data-target="#sellercontact_modal" role="seller" register-text="Seller Register" href="javascript:;" class="setrole btn slider-btn btn-lg mt-4">@lang('inner-content.home-new.join_now')</a>
         </div>
      </div>
   </div>
</section>
<section class="infographic pb-5">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center pb-5">
            <h2 class="section-title"><span>@lang('inner-content.home-new.how_we_work')</span></h2>
            <div id="timelinenew" class="linetime">
               <div class="row timelinenew-movement">
                  <div class="offset-sm-5 col-sm-7 timelinenew-item">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="timelinenew-panel debits  anim animate  fadeInRight">
                              <ul class="timelinenew-panel-ul">
                                 <li>
                                    <div>
                                       <span class="cinfo">
                                       <img class="c" src="{{asset('images/home-v2/yellow-circlem.png') }}">
                                       </span>
                                       <span class="steinfo">
                                       <b>@lang('inner-content.home-new.steps')<font>01</font></b>
                                       </span>
                                       <span class="cnminfo">
                                          <p>@lang('inner-content.home-new.upload') <br>@lang('inner-content.home-new.stocks')</p>
                                       </span>
                                       <span class="qinfo">
                                       <img src="{{asset('images/home-v2/up-iconm.png') }}">
                                       </span>
                                    </div>
                                 </li>
                                 <div class="clear"></div>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row timelinenew-movement">
                  <div class="col-sm-7 timelinenew-item">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="timelinenew-panel credits grninfo anim animatedm fadeInLeft">
                              <ul class="timelinenew-panel-ul">
                                 <li class="grninfo1">
                                    <div>
                                       <span class="qinfo">
                                       <img src="{{asset('images/home-v2/doller-tag.png') }}">
                                       </span>
                                       <span class="steinfo">
                                       <b>@lang('inner-content.home-new.steps') <font>02</font></b>
                                       </span>
                                       <span class="cnminfo">
                                          <p>@lang('inner-content.home-new.your') <br>@lang('inner-content.home-new.prices')</p>
                                       </span>
                                       <span class="cinfo">
                                       <img src="{{asset('images/home-v2/green-circlem.png') }}">
                                       </span>
                                    </div>
                                 </li>
                                 <div class="clear"></div>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row timelinenew-movement">
                  <div class="offset-sm-5 col-sm-7 timelinenew-item">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="timelinenew-panel debits  anim animatedm  fadeInRight">
                              <ul class="timelinenew-panel-ul">
                                 <li class="linegren">
                                    <div>
                                       <span class="cinfo">
                                       <img class="c" src="{{asset('images/home-v2/yellow-circlem.png') }}">
                                       </span>
                                       <span class="steinfo">
                                       <b>@lang('inner-content.home-new.steps') <font>03</font></b>
                                       </span>
                                       <span class="cnminfo">
                                          <p>@lang('inner-content.home-new.sell')<br>@lang('inner-content.home-new.earn_more')</p>
                                       </span>
                                       <span class="qinfo">
                                       <img src="{{asset('images/home-v2/cart-iconm.png') }}">
                                       </span>
                                    </div>
                                 </li>
                                 <div class="clear"></div>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
           
            </div>
        
         </div>
      </div>
   
   <div class="col-md-5" id="sell"></div>
   <div class="col-md-12 text-center">
      <button class="btn slider-btn btn-lg mb-5" data-toggle="modal" data-target="#products_modal">@lang('inner-content.home-new.see_our_offers')</button>
      <div class="mb-5"><br/></div>
      <div class="row">
         <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter tomato">
            <div class="data-veg">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
               <img src="{{asset('images/home-v2/offer-potatoes.jpg') }}" class="img-responsive">
               <div class="centered">@lang('inner-content.home-new.potato')</div>
            </a>
            </div>
         </div>
         <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter tomato">
            <div class="data-veg">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
               <img src="{{asset('images/home-v2/onion_home.jpg') }}" class="img-responsive">
               <div class="centered">@lang('inner-content.home-new.onion_red')</div>
            </a>
            </div>
         </div>
         <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter tomato">
            <div class="data-veg">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
               <img src="{{asset('images/home-v2/onion_home-2.jpg') }}" class="img-responsive">
               <div class="centered">@lang('inner-content.home-new.onion_yellow')</div>
            </a>
            </div>
         </div>
         <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter onion">
            <div class="data-veg">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
               <img src="{{asset('images/home-v2/cabbage_home.jpg') }}" class="img-responsive">
               <div class="centered">@lang('inner-content.home-new.cabbage_green')</div>
            </a>
            </div>
         </div>
         <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter onion">
            <div class="data-veg">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
               <img src="{{asset('images/home-v2/cabbage_red.jpg') }}" class="img-responsive">
               <div class="centered">@lang('inner-content.home-new.cabbage_red')</div>
            </a>
            </div>
         </div>
         <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter onion">
            <div class="data-veg">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#products_modal">
               <img src="{{asset('images/home-v2/beets_home.jpg') }}" class="img-responsive">
               <div class="centered">@lang('inner-content.home-new.beets')</div>
            </a>
            </div>
         </div>
      </div>
   </div>
  
   </div>
</section>
<section class="make-more-money pb-5">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="container-bg">
               <div class="text-center">
                  <h2 class="section-title"><span>@lang('inner-content.home-new.sell_earn')</span></h2>
               </div>
               <div class="money-content">
                  @lang('inner-content.home-new.sell_earn_content')                        
               </div>
               <div class="text-center mt-3">
                  <h3 class="mb-4">@lang('inner-content.home-new.earn_more_with_vegking')</h3>
                  <a data-toggle="modal" data-target="#sellercontact_modal" role="seller" register-text="Seller Register" href="javascript:;" class="setrole btn slider-btn btn-lg mt-4">@lang('inner-content.home-new.join_now')</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="sales-department pb-5">
   <div class="container">
   <div class="row">
      <div class="col-md-12 text-center">
         <h2 class="section-title"><span>@lang('inner-content.home-new.sales_department')</span></h2>
      </div>
      <div class="col-md-12">
         <div class="ContactHomeSec">
            <div class="row">
               <div class="col-md-6">
                  <div class="LocationaddressSec mb-2 sales">
                     <h4>@lang('inner-content.home-new.sales')</h4>
                     @lang('inner-content.home-new.sales_contact_list')
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="LocationaddressSec mb-2 sales">
                     @lang('inner-content.home-new.sales_contact_list_2')
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="newsletter ">
   <div class="newsletter-bg text-center pt-5 pb-5 container-fluid">
      <div class="col-md-12 newslatter-content">
         <h2 class="section-title text-white"><span>@lang('inner-content.home-new.newsletter')</span></h2>
         <p>@lang('inner-content.home-new.subscribe_text')</p>
         {{ html()->form('POST', route('frontend.subscribe'))->id('subscribe_form')->open() }}
         <div class="form-group">
            <input type="email" class="input-email" id="subscriber_email" name="email" placeholder="@lang('inner-content.home-new.enter_your_email')">
            <button type="submit" name="submit" class="btn slider-btn"><i class="fas fa-paper-plane"></i></button>
         </div>
         {{ html()->form()->close() }}
      </div>
   </div>
</section>
@endsection
@push('after-scripts')
<script>
   $(document).ready(function(){
   var $animation_elements = $('.anim');
   var $window = $(window);
   
   function check_if_in_view() {
   var window_height = $window.height();
   var window_top_position = $window.scrollTop();
   var window_bottom_position = (window_top_position + window_height);
   
   $.each($animation_elements, function() {
   var $element = $(this);
   var element_height = $element.outerHeight();
   var element_top_position = $element.offset().top;
   var element_bottom_position = (element_top_position + element_height);
   
   //check to see if this current container is within viewport
   if ((element_bottom_position >= window_top_position) &&
   (element_top_position <= window_bottom_position)) {
   $element.addClass('animatedm');
   } else {
   $element.removeClass('animatedm');
   }
   });
   }
   
   $window.on('scroll resize', check_if_in_view);
   $window.trigger('scroll');
   });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
@endpush