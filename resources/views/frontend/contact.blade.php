@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')
<div class="container">



  <div class="row justify-content-center">
    <div class="col col-sm-10 align-self-center">

    <div class="COntactPageWidth">
    <div class="row">
      <div class="col-md-12">
        <h1 class="ContactPageHeading">
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


    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="SinglePersonDetails gregbg gregbgcopy mb-2">

					<div class="row">
			      <div class="col-md-4">
								<img src="<?php echo URL::to('/') ?>/img/c-user-profile-green.png" class="img-fluid UserProfileimg">
						</div>
						<div class="col-md-8">
							<ul class="ProfileDetails">
		            <li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-user-profile-name.png" class="userprofileicon"></span><span class="righttext">@lang('inner-content.frontend.salessec.name-2')</span></li>
		            <li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-whatsapcalling.png" class="whatsapcallingicon"></span><span class="righttext"><a class="righttext" href="https://wa.me/@lang('inner-content.frontend.salessec.phone-2')" target="_blank">@lang('inner-content.frontend.salessec.phone-2')</a></span></li>
		            <li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-email.png" class="emailicon"></span><span class="righttext"><a href="mailto:@lang('inner-content.frontend.salessec.email-2')">@lang('inner-content.frontend.salessec.email-2')</a></span></li>
		          </ul>
				</div>
        </div>
        </div>
      </div>
	   <div class="col-md-3"></div>
    </div>

	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="LocationaddressSec LocationaddressSecContact mb-3 pl-4 pr-4 pb-3" style="background-color: rgb(244, 244, 244);padding: 15px 0px 5px;border-radius: 10px;text-align: center; margin-top: 15px;margin-bottom: 30px !important;">
          @if(app()->getLocale() == 'en')	
          {!! @$LanguageContent->sale_email_en !!}
          @elseif(app()->getLocale() == 'pl')
            {!! @$LanguageContent->sale_email_pl !!}
          @elseif(app()->getLocale() == 'de')
            {!! @$LanguageContent->sale_email_de !!}
          @endif:
            <br>
				<a href="mailto:team@vegking.eu" class="" style="color: #000000;"><img src="<?php echo URL::to('/') ?>/img/c-email.png" class="emailicon2"> &nbsp;team@vegking.eu</a>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>

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
           <li class="polandAlignText"><span class="lefttext">@lang('inner-content.frontend.contactsec.country-1')</span><span class="righttext"><img src="<?php echo URL::to('/') ?>/img/c-polland-flag.png" class="LocationFlag"></span></li>
         </ul>
         <p class="AddressText" style="min-height: 90px;">@lang('inner-content.frontend.contactsec.address-1')</p>
         <div class="SinglePersonDetails">
           <ul class="ProfileDetails">
             <li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-whatsapcalling.png" class="whatsapcallingicon"></span><span class="righttext"><a class="righttext" href="https://wa.me/@lang('inner-content.frontend.contactsec.phone-1')" target="_blank">@lang('inner-content.frontend.contactsec.phone-1')</a></span></li>
             <li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-email.png" class="emailicon"></span><span class="righttext"><a href="mailto:@lang('inner-content.frontend.contactsec.email-1')">@lang('inner-content.frontend.contactsec.email-1')</a></span></li>
           </ul>
         </div>
       </div>
     </div>
     <div class="col-md-6">
       <div class="LocationaddressSec mb-2">
         <ul>
           <li><span class="lefttext">@lang('inner-content.frontend.contactsec.country-2')</span><span class="righttext"><img src="<?php echo URL::to('/') ?>/img/c-us-flag.png" class="LocationFlag"></span></li>
         </ul>
         <p class="AddressText">@lang('inner-content.frontend.contactsec.address-2')</p>
         <div class="SinglePersonDetails">
           <ul class="ProfileDetails">
             <li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-whatsapcalling.png" class="whatsapcallingicon"></span><span class="righttext"><a class="righttext" href="https://wa.me/@lang('inner-content.frontend.contactsec.phone-2')" target="_blank">@lang('inner-content.frontend.contactsec.phone-2')</a></span></li>
             <li><span class="lefticon"><img src="<?php echo URL::to('/') ?>/img/c-email.png" class="emailicon"></span><span class="righttext"><a href="mailto:@lang('inner-content.frontend.contactsec.email-2')">@lang('inner-content.frontend.contactsec.email-2')</a></span></li>
           </ul>
         </div>
       </div>
     </div>
   </div>

   <div class="row">
		<div class="col-md-4"></div>
        <div class="col-md-4">
			<div class="LocationaddressSec LocationaddressSecContact mb-3 pl-4 pr-4 pb-3" style="background-color: rgb(244, 244, 244);padding: 15px 0px 5px;border-radius: 10px;text-align: center;margin-top: 15px; margin-bottom: 30px !important;">
				@lang('inner-content.frontend.salessec.title-2-1'): <br>
				<img src="<?php echo URL::to('/') ?>/img/c-email.png" class="emailicon2">&nbsp;<a href="mailto:accounts@vegking.eu" class="" style="color: #000000;">accounts@vegking.eu</a>
			</div>
		</div>
		<div class="col-md-4"></div>
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
          @endif
        </p>
     </div>
   </div>
  </div>
</div>
</div>
</div>
<div class="row justify-content-center">
  <div class="col col-sm-8 align-self-center">
    <div class="card mb-5">
      <div class="card-header d-none"> <strong> @lang('labels.frontend.contact.box_title') </strong> </div>

      <div class="card-body"> {{ html()->form('POST')->id('form_contact_submit')->open() }}
        <div class="row">
          <div class="col">
            <div class="form-group"> {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}

              {{ html()->text('first_name', optional(auth()->user())->first_name)
              ->class('form-control')
              ->placeholder(__('validation.attributes.frontend.first_name'))
              ->attribute('maxlength', 191)
              }}
               <div class="invalid-feedback"></div>
            </div>
          </div>
          <div class="col">
            <div class="form-group"> {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

              {{ html()->text('last_name', optional(auth()->user())->last_name)
              ->class('form-control')
              ->placeholder(__('validation.attributes.frontend.last_name'))
              ->attribute('maxlength', 191)
              }}
               <div class="invalid-feedback"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group"> {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

              {{ html()->email('email', optional(auth()->user())->email)
              ->class('form-control')
              ->placeholder(__('validation.attributes.frontend.email'))
              ->attribute('maxlength', 191)
               }}
              <div class="invalid-feedback"></div>
             </div>
          </div>
          <div class="col">
            <div class="form-group"> {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }}

              {{ html()->number('phone')
              ->class('form-control')
              ->placeholder(__('validation.attributes.frontend.phone'))
              ->attribute('maxlength', 191)
              }}
               <div class="invalid-feedback"></div>
             </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group"> {{ html()->label(__('validation.attributes.frontend.message'))->for('message') }}

              {{ html()->textarea('message')
              ->class('form-control')
              ->placeholder(__('validation.attributes.frontend.message'))
              ->attribute('rows', 3)
               }}
                <div class="invalid-feedback"></div>
             </div>
          </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group form-check">
                    {{ html()->checkbox('agree')->class('form-check-input')->attributes(['required'=>'required']) }}
                    {{ html()->label(__('inner-content.frontend.buy_popup.agreecheckbox'))->class('form-check-label')->for('agree') }}
                </div><!--form-group-->
            </div><!--col-->
        </div>

        @if(config('access.captcha.contact'))
        <div class="row">
          <div class="col"> @captcha
            {{ html()->hidden('captcha_status', 'true') }} </div>
        </div>
        @endif
        <div class="row">
          <div class="col">
            <div class="form-group mb-0 clearfix"> {{ form_submit(__('labels.frontend.contact.button')) }} </div>
          </div>
        </div>
        {{ html()->form()->close() }} </div>
    </div>
  </div>
</div>

@endsection

@push('after-scripts')
    @if(config('access.captcha.contact'))
        @captchaScripts
    @endif
     <script type="text/javascript">
    $(document).ready(function() {
    $('#form_contact_submit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route('frontend.contact.send') }}",
        method: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        beforeSend: function(){
          $('.loading').removeClass('loading_hide');
        },
        success: function(data)
        {
          if(data.status == 'success'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Sent!', data.message, 'success');
            setTimeout(function(){
              window.location.href = "{{ route('frontend.contact') }}";
            }, 2000);
          }
          if(data.status == 'error'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', data.message, 'error');
            $('.btn-success').removeAttr('disabled');
          }
        },
        error :function( data ) {
          if( data.status === 422 ) {
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', data.responseJSON.message, 'error');
            $('.btn-success').removeAttr('disabled');
            var errors = [];
            errors = data.responseJSON.errors
            $.each(errors, function (key, value) {
              $('#'+key).parent().addClass('has-danger');
              $('#'+key).addClass('is-invalid');
              $('#'+key).parent('.has-danger').find('.invalid-feedback').html(value);
              $('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
            })
          }
        }
      });
    });
  });
    </script>
@endpush
