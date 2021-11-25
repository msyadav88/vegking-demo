<div class="modal fade" id="buyerlead_modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
     {{ html()->form('POST', route('frontend.buyerlead.store'))->id('buyerlead_form')->open() }}
      <div class="modal-header">
         @php $percent =((request()->input('dcode') != '') ? '10%' : '') @endphp
        <h3 class="modal-title-1 text-center col-md-12">@lang('inner-content.frontend.buyerlead_popup.heading1',['percent'=>$percent])</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="col buyer_step1 EqualBuyerleadForm">
                                @if(Auth::check())                  
                                  <div class="user-login text-center text-danger">You are already logged in as {{ Auth::user()->email }}.</div>
                                @endif
                                <div class="form-group">    
                                  {{ html()->label(__('inner-content.frontend.buyerlead_popup.email'))->for('email') }}
                                  {{ html()->email('email', optional(auth()->user())->email)
                                      ->class('form-control email')
                                      ->placeholder(__('inner-content.frontend.buyerlead_popup.email'))
                                      ->attribute('maxlength', 191)
                                      ->required()
                                  }}
                                  <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                          <div class="col buyer_step2 d-none EqualBuyerleadForm">
                            <div class="form-group">
                                {{ html()->label(__('inner-content.frontend.buyerlead_popup.phone'))->for('phone') }}
                                @php
                                  $phonecode = $splitphone = "";
                                @endphp
                                @if(request()->input('phone') != '')
                                    @php $phone = request()->input('phone');  @endphp                                  
                                    @php $country_data = country_with_ext_list(); @endphp
                                    @foreach($country_data as $key => $value)
                                      @php $ccode[] = $key; @endphp
                                    @endforeach
                                    @php $phonecode = substr($phone,0,2); @endphp
                                    @php $splitphone = substr($phone,2); @endphp
                                    @if(!in_array($phonecode, $ccode))
                                      @php $phonecode = substr($phone,0,3); @endphp
                                      @php $splitphone = substr($phone,3); @endphp
                                    @endif
                                @endif
                                <div class="row">
                                  <div class="col-md-4 select-custom-css">
                                    @php $country_data = country_with_ext_list(); @endphp
                                    <select class="select2 form-control select2-hidden-accessible country" name="country_code" id="country_code_buyerlead" required="" disabled="">
                                      <option value="">Country</option>
                                      <?php
                                        foreach($country_data as $key => $value){ ?>
                                          <option value="<?=$key?>" <?php if($key==$phonecode) echo "selected"; ?>><?=$value." (+".$key.")"?></option>
                                        <?php } ?>
                                    </select>
                                  </div>
                                  <div class="col-md-8">
                                    {{ html()->number('phone')
                                        ->class('form-control phone')
                                        ->placeholder(__('inner-content.frontend.buyerlead_popup.phone'))
                                        ->attributes(['minlength'=>8, 'maxlength'=>191,'disabled'=>'disabled'])
                                        ->required()
                                        }}
                                        <div class="invalid-feedback"></div>
                                  </div>
                                </div>
                            </div><!--form-group-->
                          </div><!--col-->
                        </div><!--row-->
                        
                        <div class="row">
                          <div class="col buyer_step3 d-none EqualBuyerleadForm">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.buyerlead_popup.name'))->for('first_name') }}

                                    {{ html()->text('first_name', optional(auth()->user())->name)
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.buyerlead_popup.name'))
                                        ->attributes(['maxlength'=>191,'pattern'=>'^[^<>:]*$','title'=>"Colon(:) is not allowed.",'disabled'=>"disabled"])                                        
                                        ->attribute('class', 'name username')
                                        ->required() }}
                                      <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row">
                            <div class="col buyer_step3 d-none EqualBuyerleadForm">
                                <div class="form-group">
                                  {{  html()->label(__('inner-content.frontend.sell_popup.password'))->for('password') }}
                                  <div class="notification-alert d-none" >@lang('inner-content.frontend.password_rule')</div>
                                  {{ html()->password('password')
                                       ->class('form-control password')
                                       ->placeholder(__('inner-content.frontend.sell_popup.password'))
                                       ->attributes(['maxlength'=>191,'disabled'=>"disabled"])
                                       ->required()
                                  }}
                                <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col buyer_step3 d-none EqualBuyerleadForm">
                                <div class="form-group">
                                  {{ html()->label(__('inner-content.frontend.sell_popup.confirm_password'))->for('password_confirmation') }}
                                  {{ html()->password('password_confirmation')
                                     ->class('form-control')
                                     ->placeholder(__('inner-content.frontend.sell_popup.confirm_password'))
                                     ->attributes(['maxlength'=>191,'disabled'=>"disabled",'onkeyup'=>"validatePassword(this)"])
                                     ->required()
                                  }}
                                <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <!-- <div class="row hide">
                            <div class="col buyer_step3">
                                <div class="form-group form-check">
                                    {{ html()->checkbox('agree')->class('form-check-input')->attributes(['required'=>'required']) }}
                                    {{ html()->label(__('inner-content.frontend.buyerlead_popup.agreecheckbox'))->class('form-check-label')->for('agree') }}
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                        <div class="col buyer_step3 d-none EqualBuyerleadForm">
                                 <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                    <div class="invalid-feedback" id="captcha"></div>
                                 </div>
                             </div>
                         </div>

                        <div class="row mr-0">
                          <div class="col">
                            <div class="form-group text-left">
                               <!-- <a href="javascript:;" class="BuyNextBtn btn btn-primary next_btn" data-id="2">@lang('inner-content.frontend.buyerlead_popup.next_Button')</a> -->
                               <input type="hidden" name="current_step" id="current_step" class="current_step" value="1">
                               <input type="hidden" name="buyerlead_id" id="buyerlead_id" class="buyerlead_id" value="">
                               <input type="hidden" name="user_role" value="buyer">
                               <input type="hidden" name="from_buyerlead" value="1">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix SubmitBtn">
                                    {{ form_submit(__('inner-content.frontend.buyerlead_popup.submit')) }}
                                    <!--<a href="{{ url('/') }}" class="float-right"><img src="{{ url('/') }}/img/{{ Settings()->site_logo }}" width="200"></a>-->
                                </div>                            
                            </div>
                        </div>
                </div><!--card-body-->
            </div><!--card--->
      </div>
     {{ html()->form()->close() }}
    </div>
  </div>
</div>
<script type="application/javascript" src="{{url('js/select2.min.js')}}"></script>
@if(config('access.captcha.contact'))
    @captchaScripts
@endif
<script type="application/javascript">
      $('.password').focus(function(){
        $('.notification-alert').removeClass('d-none');
      });
      
      @if(app()->getLocale()=='pl' && request()->input('buynew') != '' && request()->input('buynew') >= 0)
          setTimeout(function(){ $('#buyerlead_modal.modal').modal({backdrop: 'static', keyboard: false, show: true}); }, parseInt('{{request()->input("buynew")}}'+'000'));
      @endif

       $('#buyerlead_form').on('submit', function(event) { 
        event.preventDefault();
        @if (Auth::check())
          Swal.fire('Error!', 'You are already logged in as {{ Auth::user()->email }}.', 'error');
        @else
          $('#buyerlead_form .has-danger').next().children().children().css({"border": ""});
          $('#buyerlead_form .is-invalid').removeClass("is-invalid");
          $('#buyerlead_form .invalid-feedback').html("");
          $('#buyerlead_form .has-danger').removeClass("has-danger");

           var url;
           if($("#buyerlead_modal input[name='current_step']").val()=="3"){
              url = "{{ url('register') }}";
           }else{ 
              url = this.action;
           }            

           var formData = new FormData(this);
           $.ajax({
              url: url,
              method: "post",
              processData: false,
              contentType: false,
              data: formData,
              beforeSend: function(){
                $('.loading').removeClass('loading_hide');
              },
           }).done(function(response){
              //alert(response.status);
              $('.loading').addClass('loading_hide');
              if(response.status == 'success'){
                  if(response.current_step == 1){
                    var email = $("#buyerlead_modal input[name='email']").val();
                    var url_buyerlead = new URL(window.location);
                    url_buyerlead.searchParams.set("email", email); // setting your param
                    window.history.pushState(null, document.title, url_buyerlead);

                    $("#buyerlead_modal input[name='current_step']").val("2");
                    $("#buyerlead_modal input[name='buyerlead_id']").val(response.buyerlead_id);
                    $("#buyerlead_modal select[name='country_code']").removeAttr('disabled');
                    $("#buyerlead_modal input[name='phone']").removeAttr('disabled');
                    $("#buyerlead_modal .buyer_step2").removeClass('d-none');
                    $('#buyerlead_modal .buyer_step1').hide();
                    $('#buyerlead_modal .buyer_step2').show();
                    $('#buyerlead_modal .buyer_step3').hide();
                    @if(request()->input('phone') != '')    
                        $("#buyerlead_modal select[name='country_code']").val("{{ $phonecode }}");
                        $('#buyerlead_modal .select2.country').select2().trigger('change');
                        $("#buyerlead_modal input[name='phone']").val("{{ $splitphone }}");
                        $('#buyerlead_modal .btn.btn-success').trigger('click');
                    @endif
                  }else if(response.current_step == 2){
                    var countrycode = $("#buyerlead_modal select[name='country_code']").val();
                    var phone = $("#buyerlead_modal input[name='phone']").val();              
                    var mobile = countrycode+phone;              
                    var url_buyerlead = new URL(window.location);
                    url_buyerlead.searchParams.set("phone", mobile); // setting your param
                    window.history.pushState(null, document.title, url_buyerlead);

                    $("#buyerlead_modal input[name='current_step']").val("3");
                    $("#buyerlead_modal input[name='buyerlead_id']").val(response.buyerlead_id);
                    $("#buyerlead_modal input[name='first_name']").removeAttr('disabled');
                    $("#buyerlead_modal input[name='password']").removeAttr('disabled');
                    $("#buyerlead_modal input[name='password_confirmation']").removeAttr('disabled');
                    $("#buyerlead_modal .buyer_step3").removeClass('d-none');
                    $('#buyerlead_modal .buyer_step1').hide();
                    $('#buyerlead_modal .buyer_step2').hide();
                    $('#buyerlead_modal .buyer_step3').show();
                  }else{                  
                    if($("#buyerlead_modal input[name='current_step']").val() == "3"){
                      $.ajax({
                        url: "{{ url('buyerlead') }}",
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
                              window.location.href = "{{route('buyer.dashboard')}}";
                          }
                      });
                    }
                  }
              }
           }).fail(function(jqXHR, textStatus){
             $('.loading').addClass('loading_hide');
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
              }
           }).always(function(){
              $("#buyerlead_form .btn.btn-success").removeAttr('disabled');
           });
        @endif
      });
   $(function(){
    $('#buyerlead_modal .select2.country').val(48);
    $('#buyerlead_modal .select2.country').select2().trigger('change');
   });
    </script>
<link rel="stylesheet" type="text/css" href="{{url('css/select2.min.css')}}">
<style type="text/css">
#buyerlead_modal .select2.select2-container {
  width: 100% !important;

}
.swal2-container {
  z-index: 999999999999999999;
}
  #buyerlead_modal .previous_btn, #buyerlead_modal .next_btn, #buyerlead_modal .previous_btn.disabled, #buyerlead_modal .next_btn.disabled, #buyerlead_modal .previous_btn:focus, #buyerlead_modal .next_btn:focus{
    background: #e2b900;
    border: none;
    box-shadow: none;
  }
  #buyerlead_modal .previous_btn:hover, #buyerlead_modal .next_btn:hover{
    background: #115640;
    border: none;
  }
</style>

<script type="text/javascript">
  $(document).ready(function(){
    $('#buyerlead_modal.modal').on('show.bs.modal', function () {
      var url = new URL(window.location);
      url.searchParams.set("buynew", "0"); // setting your param
      window.history.pushState(null, document.title, url);
    });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){

    $('#buyerlead_modal .buyer_step1').show();
    $('#buyerlead_modal .buyer_step2').hide();
    $('#buyerlead_modal .buyer_step3').hide();

    $('#buyerlead_modal.modal').on('show.bs.modal', function () {
      var url = new URL(window.location);
      url.searchParams.set("buy", "0"); // setting your param
      window.history.pushState(null, document.title, url);
    });

    $('#buyerlead_modal').on('hidden.bs.modal', function () {
      $('#buyerlead_modal .buyer_step1').show();
      $('#buyerlead_modal .buyer_step2').hide();
      $('#buyerlead_modal .buyer_step3').hide();
      var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
    });
});

@if(request()->input('email') != '')
  if($("#buyerlead_modal input[name='current_step']").val()=="1"){
    $("#buyerlead_modal input[name='email']").val("{{ request()->input('email') }}");
    $('#buyerlead_modal .btn.btn-success').trigger('click');
  }
@endif
</script>