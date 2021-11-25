<div class="modal fade" id="sellercontact_modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     {{ html()->form('POST',url('register'))->id('sellercontact_form')->open() }}
         <input type="hidden" name="referral" value="{{request()->referral}}">
         <input type="hidden" name="user_role" value="seller">
      <div class="modal-header">
      <h3 class="modal-title-1">@lang('inner-content.frontend.sell_popup.heading1')</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
            <div class="card">
            <h4 class="modal-title" id="favoritesModalLabel">@lang('inner-content.frontend.sell_popup.heading')</h4>
                <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.sell_popup.choose_products'))->for('product') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                    {{ html()->select('product_id')
                                        ->class('select2 form-control')
                                        ->placeholder(__('inner-content.frontend.sell_popup.choose_products'))
                                        ->options(products_list())
                                        ->value(getproductIdbyName('Potato'))
                                         }}
                                     </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.sell_popup.name'))->for('first_name') }}

                                    {{ html()->text('first_name', optional(auth()->user())->first_name)
                                        ->class('form-control first_name username')
                                        ->placeholder(__('inner-content.frontend.sell_popup.name'))
                                        ->attributes(['maxlength'=>191,'pattern'=>'^[^<>:]*$','title'=>"Colon(:) is not allowed."])
                                    }}
                                    <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.sell_popup.phone'))->for('phone') }}
                                    <div class="row">
                                      <div class="col-md-4">
                                        @php $country_data = country_with_ext_list(); @endphp
                                        <select class="select2 form-control select2-hidden-accessible country" name="country_code" id="country_code" required="">
                                          <option value="">Country</option>
                                          <?php
                                            foreach($country_data as $key => $value){ ?>
                                              <option value="<?=$key?>"><?=$value." (+".$key.")"?></option>
                                            <?php } ?>
                                        </select>
                                      </div>
                                      <div class="col-md-8">
                                        {{ html()->number('phone')
                                          ->class('form-control phone')
                                          ->placeholder(__('inner-content.frontend.sell_popup.phone'))
                                          ->attributes(['maxlength'=> 191,'minlength'=> 8])
                                          ->required()
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
                                    <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row">
                             <div class="col">
                                 <div class="form-group">
                                     {{ html()->label(__('inner-content.frontend.sell_popup.password'))->for('password') }}
                                     <div class="notification-alert d-none" >@lang('inner-content.frontend.password_rule')</div>
                                     {{ html()->password('password')
                                         ->class('form-control password')
                                         ->placeholder(__('inner-content.frontend.sell_popup.password'))
                                         ->attribute('maxlength', 191)
                                         }}
                                    <div class="invalid-feedback"></div>
                                 </div><!--form-group-->
                             </div><!--col-->
                         </div>
                         <div class="row">
                             <div class="col">
                                 <div class="form-group">
                                     {{ html()->label(__('inner-content.frontend.sell_popup.confirm_password'))->for('password_confirmation') }}
                                     {{ html()->password('password_confirmation')
                                         ->class('form-control')
                                         ->placeholder(__('inner-content.frontend.sell_popup.confirm_password'))
                                         ->attributes(['maxlength'=>191,'onkeyup'=>"validatePassword(this)"])
                                          }}
                                    <div class="invalid-feedback"></div>
                                 </div><!--form-group-->
                             </div><!--col-->
                         </div>
                          <div class="row">
                              <div class="col">
                                  <div class="form-group">
                                      {{ html()->label(__('inner-content.frontend.sell_popup.location'))->for('country') }}
                                      <div class="col-md-12 pl-0 pr-0">
                                      {{ html()->select('country')
                                          ->class('select2 form-control')
                                          ->placeholder(__('inner-content.frontend.sell_popup.location'))
                                          ->options(country_list())
                                           }}
                                       </div>
                                  </div><!--form-group-->
                              </div><!--col-->
                          </div>
                          <div class="row">
                              <div class="col">
                                  <div class="form-group">
                                      {{ html()->label(__('inner-content.frontend.sell_popup.postal_code'))->for('postalcode') }}
                                      {{ html()->text('postalcode')
                                          ->class('form-control')
                                          ->placeholder(__('inner-content.frontend.sell_popup.postal_code'))
                                          ->attribute('maxlength', 191)
                                           }}
                                       <div class="invalid-feedback"></div>
                                  </div><!--form-group-->
                              </div><!--col-->
                          </div><!--row-->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.sell_popup.prefered_method'))->for('prefered_method') }}
                                    @php
                                      $yes = __('inner-content.frontend.sell_popup.yes');
                                      $no = __('inner-content.frontend.sell_popup.no');
                                    @endphp
                                    <div class="col-md-12 col-form-label">
                                      <div class="form-check form-check-inline col-md-12 ">
                                          <label class="form-check-label col-md-4">@lang('inner-content.frontend.sell_popup.pm_email')</label>
                                          {{ html()->label(
                                          html()->checkbox('contact_email', 1, 1)
                                          ->class('switch-input contact_email')
                                          ->id('contact_email')
                                          . '<span class="switch-slider" data-checked="'.$yes.'" data-unchecked="'.$no.'"></span>')
                                          ->class('switch switch-label switch-pill switch-success mr-2')
                                          ->for('contact_email') }}
                                      </div>
                                    </div>

                                    <div class="col-md-12 col-form-label">
                                      <div class="form-check form-check-inline col-md-12 ">
                                          <label class="form-check-label  col-md-4">@lang('inner-content.frontend.sell_popup.pm_sms')</label>
                                          {{ html()->label(
                                          html()->checkbox('contact_sms', 1, 1)
                                          ->class('switch-input contact_sms')
                                          ->id('contact_sms')
                                          . '<span class="switch-slider" data-checked="'.$yes.'" data-unchecked="'.$no.'"></span>')
                                          ->class('switch switch-label switch-pill switch-success mr-2')
                                          ->for('contact_sms') }}
                                          <div class="row">
                                            <div class="col-md-6">
                                              <select class="select2 form-control select2-hidden-accessible country" name="country_code_sms" id="country_code_sms" required="">
                                                <option value="">Country</option>
                                                <?php
                                                  foreach($country_data as $key => $value){ ?>
                                                    <option value="<?=$key?>"><?=$value." (+".$key.")"?></option>
                                                  <?php } ?>
                                              </select>
                                            </div>
                                            <div class="col-md-6">
                                              <input type="text" name="sms_number" id="sms_number" class="form-control sms_number" required="" minlength="8" maxlength="191">
                                              <div class="invalid-feedback"></div>
                                            </div>
                                          </div>
                                      </div>
                                    </div>

                                    <div class="col-md-12 col-form-label">
                                      <div class="form-check form-check-inline col-md-12 ">
                                          <label class="form-check-label col-md-4">@lang('inner-content.frontend.sell_popup.pm_whatsapp')</label>
                                          {{ html()->label(
                                          html()->checkbox('contact_whatsapp', 1, 1)
                                          ->class('switch-input contact_whatsapp')
                                          ->id('contact_whatsapp')
                                          . '<span class="switch-slider" data-checked="'.$yes.'" data-unchecked="'.$no.'"></span>')
                                          ->class('switch switch-label switch-pill switch-success mr-2')
                                          ->for('contact_whatsapp') }}
                                          <div class="row">
                                            <div class="col-md-6">
                                              <select class="select2 form-control select2-hidden-accessible country" name="country_code_whatsapp" id="country_code_whatsapp" required="">
                                                <option value="">Country</option>
                                                <?php
                                                  foreach($country_data as $key => $value){ ?>
                                                    <option value="<?=$key?>"><?=$value." (+".$key.")"?></option>
                                                  <?php } ?>
                                              </select>
                                            </div>
                                            <div class="col-md-6">
                                              <input type="text" name="whatsapp_number" id="whatsapp_number"  class="form-control whatsapp_number" required="" minlength="8" maxlength="191">
                                              <div class="invalid-feedback"></div>
                                            </div>
                                          </div>
                                      </div>
                                    </div>

                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.sell_popup.notes'))->for('notes') }}

                                    {{ html()->textarea('notes')
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.sell_popup.notes'))
                                        ->attribute('rows', 3)
                                    }}
                                </div><!--form-group-->
                            </div><!--col-->
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
                                <div class="col">
                                    @captcha
                                    {{ html()->hidden('captcha_status', 'true') }}
                                </div><!--col-->
                            </div><!--row-->
                        @endif
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    {{ form_submit(__('inner-content.frontend.sell_popup.submit')) }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                </div><!--card-body-->
            </div><!--card-->
      </div>
     {{ html()->form()->close() }}
    </div>
  </div>
</div>
@if(config('access.captcha.contact'))
  @captchaScripts
@endif
<style type="text/css">
    .loading {
    z-index: 99999999 !important;
}
#sellercontact_modal .select2-container{
  width: 100% !important;
}
</style>
<script type="text/javascript">
      $('.password').focus(function(){
        $('.notification-alert').removeClass('d-none');
      });

      @if(request()->input('sell') != '' && request()->input('sell') >= 0)
         setTimeout(function(){ $('#sellercontact_modal.modal').modal('show'); }, parseInt('{{request()->input("sell")}}'+'000'));
      @endif
       $('#sellercontact_form').on('submit', function(event) {
         event.preventDefault();
         $('#sellercontact_form .has-danger').next().children().children().css({"border": ""});
         $('#sellercontact_form .is-invalid').removeClass("is-invalid");
         $('#sellercontact_form .invalid-feedback').html("");
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
           console.log(response);
            if(response.status == 'success'){
                  window.location.href = "{{route('seller.dashboard')}}";
            }
            // alert(response.message);
            // show_notification(response.status,response.message);
         }).fail(function(jqXHR, textStatus){
           $('.loading').addClass('loading_hide');
            Swal.fire('Error!', jqXHR.responseJSON.message, 'error');
            if( jqXHR.status === 422 ) {
               $('.btn-success').removeAttr('disabled');
               var errors = [];
               errors = jqXHR.responseJSON.errors;
               console.log(errors);
               $.each(errors, function (key, value) {
                  $('.'+key).parent().addClass('has-danger');
                  $('.'+key).addClass('is-invalid');
                  $('.'+key).parent('.has-danger').find('.invalid-feedback').html(value);
                  $('.'+key).next().children().children().css({"border": "1px solid #f86c6b"});
               })
            }else{
               Swal.fire('Error!', 'Some error occured. Please try again.', 'error');
            }
            // alert('Some error occurred. Please try again.');
            // alert(jqXHR.responseText);
         }).always(function(){
            $("#sellercontact_form .btn.btn-success").removeAttr('disabled');
         });
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
@push('after-styles')
   <link rel="stylesheet" type="text/css" href="{{url('css/select2.min.css')}}">
   <style type="text/css">
   #sellercontact_modal .select2.select2-container {
      width: 100% !important;
   }
   </style>
@endpush

<script type="text/javascript">
$(document).ready(function() {
  $('body').on('click','#sellercontact_modal .switch-input',function() {
   var id = $(this).attr('id');
    if ($('#'+id).prop('checked')) {
      $('#'+id).val('1');
    } else {
      $('#'+id).val('0');
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
    templateSelection: formatState
  });
});
</script>
