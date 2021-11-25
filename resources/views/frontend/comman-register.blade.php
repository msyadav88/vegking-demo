<style>
  #sellercontact_modal fieldset{padding: 15px;/*border: 1px solid #ced4da;*/ margin-bottom: 15px}
  #sellercontact_modal fieldset legend{font-size: 16px;font-weight:600; display: inline-block;width: auto;padding: 0 5px; text-transform:uppercase}
  #sellercontact_modal .modal-header{border-radius: 0px;}
</style>
<div class="modal fade" id="sellercontact_modal" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{ html()->form('POST',url('register'))->id('sellercontact_form')->open() }}
      <input type="hidden" name="referral" value="{{request()->referral}}">
      <input type="hidden" name="user_role" id="user_role" value="seller">
      <input type="hidden" name="ip" id="ipa" value="">
.      <input type="hidden" name="push_token" value="<?php if(isset($push_token)){ echo $push_token; } ?>">
      <div class="modal-header">
        <h3 class="modal-title-1"><img src="{{asset('img/vegking-logo-heading.png')}}"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body seller-model">
        <fieldset class="card-body">
          <legend id="register-form">@lang('inner-content.frontend.sell_popup.heading')</legend>
          <div class="row">
            <div class="col">
              @if(Auth::check())                  
                <div class="user-login text-center text-danger">You are already logged in as {{ Auth::user()->email }}.</div>
              @endif
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {{ html()->label(__('inner-content.frontend.sell_popup.name'))->for('name') }}
                    {{ html()->text('name', optional(auth()->user())->name)
                      ->class('form-control name ')
                      ->placeholder(__('inner-content.frontend.sell_popup.name'))
                      ->attributes(['maxlength'=>191,'pattern'=>'^[^<>:]*$','title'=>"Colon(:) is not allowed."])
                    }}
                    <div class="invalid-feedback"></div>
                  </div><!--form-group-->
                </div>
              </div>
            </div><!--col-->
          </div><!--row-->

          <div class="row">
            <div class="col">
              <div class="form-group">
                {{ html()->label(__('inner-content.frontend.sell_popup.company_name'))->for('company_name') }}
                {{ html()->text('company_name', optional(auth()->user())->company_name)
                  ->class('form-control company_name ')
                  ->placeholder(__('inner-content.frontend.sell_popup.company_name'))
                  ->attributes(['maxlength'=>191,'pattern'=>'^[^<>:]*$','title'=>"Colon(:) is not allowed."])
                }}
                <div class="invalid-feedback"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                {{ html()->label(__('inner-content.frontend.sell_popup.phone'))->for('phone') }}
                @php $country_data = country_with_ext_list(); @endphp
                <div class="row">                                         
                  <div class="col-md-12 phone-section">
                    <select class="select2 form-control select2-hidden-accessible country firstInput" name="country_code" id="country_code" required="">
                      <option value="">Country</option>
                      <?php foreach($country_data as $key => $value){ ?>
                        <option value="<?=$key?>"><?=$value." (+".$key.")"?></option>
                      <?php } ?>
                    </select>
                    {{ html()->number('phone')
                      ->class('form-control phone secondInput')
                      ->placeholder(__('inner-content.frontend.sell_popup.phone'))
                      ->attributes(['maxlength'=> 191,'minlength'=> 8])
                      ->required()
                    }}
                    <div class="error_phone notification-alert"></div>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div><!--form-group-->
            </div><!--col-->
          </div>
        
           
                {{ html()->label(__('Same for WhatsApp'))->for('phoneapp') }}
                {{ html()->checkbox('phonesame')
                ->attribute('checked')
              }}
         
           
        
        
          <div class="row whatsapp">
            <div class="col">
              <div class="form-group">
                {{ html()->label(__('WhatsApp phone'))->for('phone') }}
                @php $country_data = country_with_ext_list(); @endphp
                <div class="row">                                         
                  <div class="col-md-12 phone-section">
                    <select class="select2 form-control select2-hidden-accessible country firstInput" name="country_code_whatsapp" id="country_code_whatsapp" >
                      <option value="">Country</option>
                      <?php foreach($country_data as $key => $value){ ?>
                        <option value="<?=$key?>"><?=$value." (+".$key.")"?></option>
                      <?php } ?>
                    </select>
                    {{ html()->number('phonewhatsapp')
                      ->class('form-control phone secondInput')
                      ->placeholder(__('Whats App Number'))
                      ->attributes(['maxlength'=> 191])
                    }}
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div><!--form-group-->
            </div><!--col-->
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                {{ html()->label(__('inner-content.frontend.sell_popup.email'))->for('email') }}
                {{ html()->email('email', optional(auth()->user())->email)
                  ->class('form-control email')
                  ->placeholder(__('inner-content.frontend.sell_popup.email'))
                  ->attribute('maxlength', 191)
                }}
                <div class="error_email notification-alert"></div>
                <div class="invalid-feedback"></div>
              </div><!--form-group-->
            </div><!--col-->
          </div><!--row-->
          <div class="row">
            <div class="col">
              <div class="form-group">
                  {{ html()->label(__('inner-content.frontend.sell_popup.password'))->for('password') }}
                  {{ html()->password('password')
                    ->class('form-control password')
                    ->placeholder(__('inner-content.frontend.sell_popup.password'))
                    ->attributes(['maxlength'=>191,'onkeyup'=>"confirmPassword($(this))"])
                  }}
                  <div class="password_alert"></div>
               <div class="invalid-feedback"></div>
              </div><!--form-group-->
            </div><!--col-->
          </div>
          <input type="hidden" name="password_confirmation" id="password_confirmation">
          {{-- <div class="row">
              <div class="col">
                <div class="form-group">
                    {{ html()->label(__('inner-content.frontend.sell_popup.confirm_password'))->for('password_confirmation') }}
                    {{ html()->password('password_confirmation')
                      ->class('form-control')
                      ->placeholder(__('inner-content.frontend.sell_popup.confirm_password'))
                      ->attributes(['maxlength'=>191,'onkeyup'=>"validatePassword(this)"])
                    }}
                  <div class="invalid-feedback"></div>
                </div>
              </div>
          </div> --}}


          <div class="row">
            <div class="col">
              <div class="form-group form-check1">
                @lang('inner-content.frontend.buy_popup.agreecheckbox')
              </div><!--form-group-->
            </div><!--col-->
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group mb-0 clearfix">
                  {{ form_submit(__('inner-content.frontend.sell_popup.submit')) }}
              </div><!--form-group-->
            </div><!--col-->
          </div><!--row-->
        </fieldset>            
      </div>
     {{ html()->form()->close() }}
    </div>
  </div>
</div>
@if(config('access.captcha.contact'))
  @captchaScripts
@endif
<script type="application/javascript" src="{{url('js/select2.min.js')}}"></script>
<style type="text/css">
  .loading {
      z-index: 99999999 !important;
  }
</style>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.password').keyup(function(){
       var password=$('.password').val().length;
       if(password <= 5 && password != 0){
          $('.password_alert').text('Password must be 6+ characters') .css({"color": "#ea4335"});
       }else{
          $('.password_alert').text('Password must be 6+ characters') .css({"color": "#000000"});
       }
   });

   $('.email').blur(function(){
    var email=$('.email').val();
     $.ajax({
      url: "{{ route('frontend.get_email_count') }}",
      method: 'POST',
       data: { email:email },
      success: function(data)
      {
          if(data.email_count != 0 ){
           $('.error_email').text('Already registered');
           $("#sellercontact_form .btn.btn-success").addClass('disabled');
          }else{
            $('.error_email').text('');
          }
      }
     });
   });
   $('.phone').blur(function(){
    var phone=$('.phone').val();
     $.ajax({
      url: "{{ route('frontend.get_phone_count') }}",
      method: 'POST',
       data: { phone:phone },
      success: function(data)
      {
          if(data.phone_count != 0 ){
           $('.error_phone').text('Already registered');
           $("#sellercontact_form .btn.btn-success").addClass('disabled');
          }else{
            $('.error_phone').text('');
            $("#sellercontact_form .btn.btn-success").removeClass('disabled');
          }
      },
    });
   });

    @if(request()->input('sell') != '' && request()->input('sell') >= 0)
        setTimeout(function(){ $('#sellercontact_modal.modal').modal('show'); }, parseInt('{{request()->input("sell")}}'+'000'));
    @endif
      $('#sellercontact_form').on('submit', function(event) {
        event.preventDefault();
        @if (Auth::check())
        Swal.fire('Error!', 'You are already logged in as {{ Auth::user()->email }}.', 'error');
        @else
          $('#sellercontact_form .has-danger').next().children().children().css({"border": ""});
          $('#sellercontact_form .is-invalid').removeClass("is-invalid");
          $('#sellercontact_form .invalid-feedback').html("");
          $('#captcha').html("");
          $("#captcha").css("display", "none");
          $('#sellercontact_form .has-danger').removeClass("has-danger");
          var formData = new FormData(this);
          $.ajax({
            url: this.action,
            method: "post",
            processData: false,
            contentType: false,
            data: formData,
            beforeSend: function(){
              $('.loading').removeClass('loading_hide');
            },
          }).done(function(response){
            $('.loading').addClass('loading_hide');
            if(response.status == 'success'){
              callTracker();
                if(formData.get('user_role') == 'buyer'){
                    window.location.href = "{{route('buyer.dashboard')}}";
                }else{
                    window.location.href = "{{route('seller.dashboard')}}";
                }
            }else{
              Swal.fire('Error!', response.message, 'error');
            }
          }).fail(function(jqXHR, textStatus){
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', jqXHR.responseJSON.message, 'error');
            callTracker();
            if( jqXHR.status === 422 ) {
                $('.btn-success').removeAttr('disabled');
                var errors = [];
                errors = jqXHR.responseJSON.errors;
                $.each(errors, function (key, value) {
                  if(key == 'g-recaptcha-response'){
                    $("#captcha").css("display", "block");
                    $('#captcha').html(value);
                  }
                  $('.'+key).parent().addClass('has-danger');
                  $('.'+key).addClass('is-invalid');
                  $('.'+key).parent('.has-danger').find('.invalid-feedback').html(value);
                  $('.'+key).next().children().children().css({"border": "1px solid #f86c6b"});
                })
            }else{
                Swal.fire('Error!', 'Some error occured. Please try again.', 'error');
            }
          }).always(function(){
            $("#sellercontact_form .btn.btn-success").removeAttr('disabled');
          });
        @endif
    });

    function callTracker() {
      var data ={};
      data['button']= 'Seller Register';
      data['page']= "{{url()->current()}}";
      data['ip']= $("#ip").val();
      data['data']= 'Name: '+ $("#sellercontact_modal #first_name").val()+', Email: '+ $("#sellercontact_modal #email").val()+', Phone: '+ $("#sellercontact_modal #phone").val();
      data["_token"]="{{ csrf_token() }}";
      ga('send', 'event', data.button, data.page, 'Submit');
      $.ajax({
        url: "{{ route('frontend.user.tracker') }}",
        method: 'post',
        data: data,
        success: function(response){
          console.log(response);
        }
      });
    }

    function confirmPassword($obj) {
      $('#sellercontact_modal #password_confirmation').val($obj.val());
    } 

    $('.setrole').on('click',function(){
      $('#sellercontact_modal #user_role').val($(this).attr('role'));
      $('#register-form').html($(this).attr('register-text'));
    });

    $('#sellercontact_form select[name="country_code"]').on('change',function(){
        if($("#sms_number").val()=='')
        {
          $('#country_code_sms').val($(this).val());
          $('#country_code_sms').select2({templateResult: formatState,templateSelection: formatState}).trigger('change');
        }
        if($("#whatsapp_number").val()=='')
        {
          $('#country_code_whatsapp').val($(this).val());
          $('#country_code_whatsapp').select2({templateResult: formatState,templateSelection: formatState}).trigger('change');
        }
    });
    $('#sellercontact_form input[name="phone"]').on('change',function(){
        if($('#whatsapp_number').val() == ''){
          $('#whatsapp_number').val($(this).val());
        }
        if($('#sms_number').val() == ''){
          $('#sms_number').val($(this).val());
        }
    });
    $('#sellercontact_form input[name^="contact_"]').on('change',function(){
        if($(this).val() == '1'){
          if($(this).attr('name') == 'contact_sms'){
              $('#sms_number').attr('required','required');
              $('#sms_number').attr('minlength','8');
              $('#country_code_sms').attr('required','required');
          }else if($(this).attr('name') == 'contact_whatsapp'){
              $('#whatsapp_number').attr('required','required');
              $('#whatsapp_number').attr('minlength','8');
              $('#country_code_whatsapp').attr('required','required');
          }
        }else{
          if($(this).attr('name') == 'contact_sms'){
              $('#sms_number').removeAttr('required');
              $('#sms_number').removeAttr('minlength');
              $('#country_code_sms').removeAttr('required');
          }else if($(this).attr('name') == 'contact_whatsapp'){
              $('#whatsapp_number').removeAttr('required');
              $('#whatsapp_number').removeAttr('minlength');
              $('#country_code_whatsapp').removeAttr('required');
          }
        }
    });
</script>
  <link rel="stylesheet" type="text/css" href="{{url('css/select2.min.css')}}">
  <style type="text/css">
  .swal2-container {
    z-index: 999999999999999999;
  }
  </style>



<script type="text/javascript">
  $(document).ready(function() {
    $(".whatsapp").hide();
    $('body').on('click','#sellercontact_modal .switch-input',function() {
    var id = $(this).attr('id');
      if ($('#'+id).prop('checked')) {
        $('#'+id).val('1');
      } else {
        $('#'+id).val('0');
      }
    });
    $("#phonesame").click(function(){
      if($(this).prop('checked') == true){
        $(".whatsapp").hide();
        $('#phonewhatsapp').removeAttr('required');
        $('#phonewhatsapp').removeAttr('minlength');
        $('#country_code_whatsapp').val($('#country_code').val());
        $('#phonewhatsapp').val($('#phone').val());
      }else{
        $(".whatsapp").show();
        $('#phonewhatsapp').attr('required','required');
        $('#phonewhatsapp').attr('minlength',8);
     
      }
    });
    var current_lang = "{{ App::getLocale() }}";
    if(current_lang=="en"){
      $('#sellercontact_modal .select2.country').val(44);
      $('#sellercontact_modal .select2.country').select2().trigger('change');
    }else if(current_lang=="pl"){
      $('#sellercontact_modal .select2.country').val(48);
      $('#sellercontact_modal .select2.country').select2().trigger('change');
    }else if(current_lang=="es"){
      $('#sellercontact_modal .select2.country').val(34);
      $('#sellercontact_modal .select2.country').select2().trigger('change');
    }
    $("#sellercontact_modal .select2.country").select2({
      templateResult: formatState,
      templateSelection: formatStateSelected
    });
  });
</script>


