@php $productTypeManualData = get_buyer_popup_product_types(); @endphp
@php $active_lang = App::getLocale(); @endphp

<div class="modal fade" id="buyercontact_modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     {{ html()->form('POST', url('register'))->id('buyercontact_form')->open() }}
         <input type="hidden" name="referral" value="{{request()->referral}}">
         <input type="hidden" name="user_role" value="buyer">
      <div class="modal-header">
        <h3 class="modal-title-1">@lang('inner-content.frontend.buy_popup.heading1')</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

        <div class="modal-body">
            <div class="card">
              <h4 class="modal-title" id="favoritesModalLabel">@lang('inner-content.frontend.buy_popup.heading')</h4>
            <!-- <ul class="PurchaseFoursteps">
				<li data-id="1" class="active"><a href="javascript:void(0);">1</a></li>
				<li data-id="2" ><a href="javascript:void(0);">2</a></li>
				<li data-id="3" ><a href="javascript:void(0);">3</a></li>
            </ul> -->
            <div class="row mt-2 mr-0 ml-0">
              <div class="col">
                <div class="form-group text-left">
                  <!--<button type="click" name="previous" class="btn btn-primary previous_btn" data-id="1" disabled="disabled" style="float: right;">Back</button>-->
                  <a href="javascript:;" class="BuyBackBtn btn btn-primary previous_btn" data-id="1" disabled="disabled">@lang('inner-content.frontend.buy_popup.back_Button')</a>
                </div>
              </div>
              <div class="col">
                <div class="form-group text-right">
                  <!--<button type="click" name="next" class="btn btn-primary next_btn" data-id="2">Next</button>-->
                  <a href="javascript:;" class="BuyNextBtn btn btn-primary next_btn disabled" data-id="2" disabled="disabled">@lang('inner-content.frontend.buy_popup.next_Button')</a>
                </div>
              </div>
            </div>
            </div>
        </div>

      <div class="modal-body">
            <div class="card">
                <div class="card-body">
                        @php $i=1; $products = get_products(); $pCount = count($products);
                          $pdata = $products->toArray(); @endphp
                          @foreach($pdata as $value)
                          @php
                            $product_id="";
                            if(strtolower(request()->product)==strtolower($value['name'])){
                              $product_id = $value['id'];
                              break;
                            }
                          @endphp
                        @endforeach                        
                  @if(Auth::check())                  
                    <div class="user-login text-center text-danger">You are already logged in as {{ Auth::user()->email }}.</div>
                  @endif
                  <div class="row">
                    @foreach($products as $product)                    
                      <div class="col-md-4 buyer_step1">
                        <p class="text-center ProductNameStyle">{{$product['name']}}</p>
                        <a href="javascript:void(0);" class="product-img-select" data-id="{{$product->id}}" data-caption="{{$product['name']}}">
                          <img src="{{ asset('images/products/') }}/{{$product->homepage_image}}" style="width:100%;" class="mb-2 img-thumbnail" />
                        </a>
                      </div><!--col-->
                      @php $i++; @endphp
                    @endforeach
                  </div>
                        <div class="row">
							<input type="hidden" id="product_id_buyer" name="product_id"/>
                           <input type="hidden" id="product_type" name="product_sub_type"/>
                        </div>
                        <div class="row buyer_step2" id="product_sub_type_outer">
                            @if(isset(request()->subtype))
                              @php $p_subtype = ucfirst(request()->subtype); @endphp
                            @endif
                                @php $i=1;
                $first_product = @$products[0];
                                if(!empty($productTypeManualData[$active_lang][@$first_product->name]['values'])){
                  $pCount = count($productTypeManualData[$active_lang][@$first_product->name]['values']);
                                } else { $pCount = 0; }
                                @endphp
                                @php
                                if(!empty($productTypeManualData[$active_lang][@$first_product->name]['values'])){
                                @endphp
                                @foreach($productTypeManualData[$active_lang][@$first_product->name]['values'] as $product)
                                @php if($i%2 == 1){ @endphp  @php } @endphp
                                    <div class="col-md-4 pl-0">
                                        <p class="text-center ProductNameStyle">{{$product['name']}}</p>
                                       <a href="javascript:void(0);" class="product-type-select" data-name="{{$product['name']}}" data-caption="{{ucfirst($product['name'])}}">
                                            <img src="{{ asset('images/product_type_images/') }}/{{$product['image']}}" style="width:100%;" class="mb-2 img-thumbnail" />
                                        </a>
                                    </div>
                                @php if($i%2 == 0 || $i == $pCount){ @endphp   @php } @endphp
                                @php $i++; @endphp
                                @endforeach
                                @php } @endphp
                        </div>
                        <!--div class="row buyer_step3">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.buy_popup.choose_products'))->for('product') }}
                                    <div class="col-md-12 pl-0 pr-0">
                                      {{ html()->select('product_id')
                                        ->class('select2 form-control product_id')
                                        ->placeholder(__('inner-content.frontend.buy_popup.choose_products'))
                                        ->options(products_list())
                                        ->value(getproductIdbyName('Potato'))
                                       }}
                                      <div class="invalid-feedback"></div>
                                     </div>
                                </div>
                            </div>
                        </div-->
                        <div class="row buyer_step3">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.buy_popup.contact_name'))->for('name') }}

                                    {{ html()->text('first_name', optional(auth()->user())->name)
                                        ->class('form-control')
                                        ->placeholder(__('inner-content.frontend.buy_popup.contact_name'))
                                        ->attributes(['maxlength'=>191,'pattern'=>'^[^<>:]*$','title'=>"Colon(:) is not allowed."])
                                        ->attribute('class', 'name username')
                                    }}
                                      <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        
                        <div class="row buyer_step3 ">
                          <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.buy_popup.phone'))->for('phone') }}
                                    <div class="row">
                                      <div class="col-md-4">
                                        @php $country_data = country_with_ext_list(); @endphp
                                        <select class="select2 form-control select2-hidden-accessible country" name="country_code" id="country_code_buyer" required="">
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
                                            ->placeholder(__('inner-content.frontend.buy_popup.phone'))
                                            ->attributes(['maxlength'=>191,'minlength'=>8])
                                            ->required()
                                            }}
                                            <div class="invalid-feedback"></div>
                                      </div>
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                        <div class="row buyer_step3">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.buy_popup.email'))->for('email') }}
                                    {{ html()->email('email', optional(auth()->user())->email)
                                        ->class('form-control email')
                                        ->placeholder(__('inner-content.frontend.buy_popup.email'))
                                        ->attribute('maxlength', 191)

                                       }}
                                       <div class="invalid-feedback"></div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <div class="row buyer_step3">
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
                        <div class="row buyer_step3">
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
                        <div class="row buyer_step3">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.buy_popup.prefered_method'))->for('prefered_method') }}
                                    @php
                                      $yes = __('inner-content.frontend.buy_popup.yes');
                                      $no = __('inner-content.frontend.buy_popup.no');
                                    @endphp
                                    <div class="col-md-12 col-form-label">
                                      <div class="form-check form-check-inline col-md-12 ">
                                          <label class="form-check-label col-md-4">@lang('inner-content.frontend.buy_popup.pm_email')</label>
                                          {{ html()->label(
                                          html()->checkbox('contact_email', 1, 1)
                                          ->class('switch-input contact_email')
                                          ->id('contact_email_buyer')
                                          . '<span class="switch-slider" data-checked="'.$yes.'" data-unchecked="'.$no.'"></span>')
                                          ->class('switch switch-label switch-pill switch-success mr-2')
                                          ->for('contact_email_buyer') }}
                                      </div>
                                    </div>
                                    <div class="col-md-12 col-form-label">
                                      <div class="form-check form-check-inline col-md-12 ">
                                          <label class="form-check-label  col-md-4">@lang('inner-content.frontend.buy_popup.pm_sms')</label>
                                          {{ html()->label(
                                          html()->checkbox('contact_sms', 1, 1)
                                          ->class('switch-input contact_sms')
                                          ->id('contact_sms_buyer')
                                          . '<span class="switch-slider" data-checked="'.$yes.'" data-unchecked="'.$no.'"></span>')
                                          ->class('switch switch-label switch-pill switch-success mr-2')
                                          ->for('contact_sms_buyer') }}
                                      </div>
                                    </div>

                                    <div class="col-md-12 col-form-label">
                                      <div class="form-check form-check-inline col-md-12 ">
                                         <label class="form-check-label col-md-4">@lang('inner-content.frontend.buy_popup.pm_whatsapp')</label>
                                          {{ html()->label(
                                          html()->checkbox('contact_whatsapp', 1, 1)
                                          ->class('switch-input contact_whatsapp')
                                          ->id('contact_whatsapp_buyer')
                                          . '<span class="switch-slider" data-checked="'.$yes.'" data-unchecked="'.$no.'"></span>')
                                          ->class('switch switch-label switch-pill switch-success mr-2')
                                          ->for('contact_whatsapp_buyer') }}
                                      </div>
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>
                        <div class="row buyer_step3 hide">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('inner-content.frontend.buy_popup.notes'))->for('notes') }}
                                    {{ html()->textarea('notes')
                                      ->class('form-control')
                                      ->placeholder(__('inner-content.frontend.buy_popup.notes'))
                                      ->attribute('rows', 3)
                                    }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div>

                        <div class="row buyer_step3 hide">
                          <div class="col">
                            <div class="form-group form-check">
                              <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                              <div class="invalid-feedback" id="captcha"></div>
                              {{ html()->checkbox('agree')->class('form-check-input')->attributes(['required'=>'required']) }}
                              {{ html()->label(__('inner-content.frontend.buy_popup.agreecheckbox'))->class('form-check-label')->for('agree') }}
                            </div><!--form-group-->
                          </div><!--col-->
                        </div>

                        <div class="row buyer_step3">
                          <div class="col">
                            <div class="form-group mb-0 clearfix">
                              {{ form_submit(__('inner-content.frontend.buy_popup.submit')) }}
                            </div><!--form-group-->
                          </div><!--col-->
                        </div><!--row-->
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
var manualData = JSON.parse('@json(@$productTypeManualData)');
      @if(request()->input('buy') != '' && request()->input('buy') >= 0)
          setTimeout(function(){ $('#buyercontact_modal.modal').modal({backdrop: 'static', keyboard: false, show: true}); }, parseInt('{{request()->input("buy")}}'+'000'));
      @endif
      // alert(url.searchParams.get('product'));

      $('body').on('click', '.product-img-select',function(event) { 
        @if(Auth::check())
          Swal.fire('Error!', 'You are already logged in as {{ Auth::user()->email }}.', 'error');
        @else
          $("#product_id_buyer").val($(this).data('id'));            
          var caption = $(this).data('caption');            
          caption = caption.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
          });

          var url = new URL(window.location);
          url.searchParams.set("product", caption); // setting your param
          window.history.pushState(null, document.title, url);
          $('#buyercontact_form .buyer_step1').hide();
          // alert('product img triggered');
          if(manualData['{{ App::getLocale()}}'][caption] == undefined){
            //alert('undefined');
            $('#buyercontact_form .buyer_step2').hide();
            $('#buyercontact_form .buyer_step3').show();
          }else{
            var list = manualData['{{ App::getLocale()}}'][caption]['values'];                  
            if(list == 'undefined'){
                $('#buyercontact_form .buyer_step2').hide();
                $('#buyercontact_form .buyer_step3').show();
            } else {
                var list = manualData['{{ App::getLocale()}}'][caption]['values'];                      
                if(typeof list === 'undefined'){
                  $('#buyercontact_form .buyer_step2').hide();
                  $('#buyercontact_form .buyer_step3').show();
                }else{
                  var values = '';
                  jQuery.each(list, function(key, value) {
                    if (value) {
                      values += '<div class="col-md-4 pl-0"><p class="text-center ProductNameStyle">'+value.name+'</p>   <a href="javascript:void(0);" class="col-md-4 product-type-select" data-name="'+value.name+'" data-caption="'+value.name+'">   <img src="{{ asset('images/product_type_images/') }}/'+value.image+'" style="width:100%;" class="mb-2 img-thumbnail" />   </a>  </div>';
                    }
                  });

                  $('#buyercontact_form .buyer_step2').html(values);
                  $('#buyercontact_form .buyer_step2').show();
                  $('#buyercontact_form .buyer_step3').hide();
                  $( ".PurchaseFoursteps li" ).eq( 0 ).removeClass('active');
                  $( ".PurchaseFoursteps li" ).eq( 1 ).addClass('active');
                }
            }
          }

          $('.previous_btn').removeAttr('disabled');
          $('.previous_btn').removeClass('disabled');
        @endif
      });
      $('body').on('click', '.product-type-select',function(event) {
        $("#product_type").val($(this).data('name'));
        // alert('product type clicked');
        // alert($(this).data('caption'));
          
        var url = new URL(window.location);
        url.searchParams.set("subtype", $(this).data('name'));
        window.history.pushState(null, document.title, url);
        $('#buyercontact_form .buyer_step2').hide();
        $('#buyercontact_form .buyer_step3').show();

        $( ".PurchaseFoursteps li" ).eq( 0 ).removeClass('active');
        $( ".PurchaseFoursteps li" ).eq( 1 ).removeClass('active');
        $( ".PurchaseFoursteps li" ).eq( 2 ).addClass('active');
        $('.previous_btn').data('id',2);
        $('.next_btn').attr('disabled');
        $('.next_btn').addClass('disabled');
      });

      $('#buyercontact_form').on('submit', function(event) {
        event.preventDefault();
        $('#buyercontact_form .has-danger').next().children().children().css({"border": ""});
        $('#buyercontact_form .is-invalid').removeClass("is-invalid");
        $('#buyercontact_form .invalid-feedback').html("");
        $('#buyercontact_form .has-danger').removeClass("has-danger");
        $("#captcha").css("display", "none");

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
              //Swal.fire('Congrats!',response.message,'success');
              Swal.fire({title:'Congrats!', text:response.message, type:'success'}).then(function(){
                window.location.href = "{{route('buyer.dashboard')}}";
              });
              $('#buyercontact_modal.modal').modal('toggle');
          }else{
              Swal.fire('Error!',response.message,'error');
          }
          // alert(response.message);
        }).fail(function(jqXHR, textStatus){
          $('.loading').addClass('loading_hide');
          if( jqXHR.status === 422 ) {
            Swal.fire('Error!', jqXHR.responseJSON.message, 'error');
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
          $("#buyercontact_form .btn.btn-success").removeAttr('disabled');
        });
    });

    $('body').on('change', '.change_buyer_product',function(event) {
      var data = $('.change_buyer_product').select2('data');
      if(data) {
        var product_name = data[0].text;
        var list = manualData[product_name]['values'];
        if(list == undefined){
          $("#product_sub_type_outer").hide();
        } else {
          var values = '<option value="">Select</option>';
          jQuery.each(list, function(key, value) {
              if (value) {
                values += '<option value="' + value + '">' + value + '</option>';
              }
          });
          var select = '<select class="form-control product_sub_type" name="product_sub_type" >' + values + '</select>'
          $("#product_sub_type_parent").html(select);
          $("#product_sub_type_outer").show();
          $('.product_sub_type').select2().trigger('change');
        }
      }
    });
</script>
<link rel="stylesheet" type="text/css" href="{{url('css/select2.min.css')}}">
<style type="text/css">
#buyercontact_modal .select2.select2-container {
  width: 100% !important;

}
.swal2-container {
  z-index: 999999999999999999;
}
  #buyercontact_modal .previous_btn, #buyercontact_modal .next_btn, #buyercontact_modal .previous_btn.disabled, #buyercontact_modal .next_btn.disabled, #buyercontact_modal .previous_btn:focus, #buyercontact_modal .next_btn:focus{
    background: #e2b900;
    border: none;
    box-shadow: none;
  }
  #buyercontact_modal .previous_btn:hover, #buyercontact_modal .next_btn:hover{
    background: #115640;
    border: none;
  }
</style>

<script type="text/javascript">
$(document).ready(function() {
  $('body').on('click','#buyercontact_modal .switch-input',function() {
   var id = $(this).attr('id');
    if ($('#'+id).prop('checked')) {
      $('#'+id).val('1');
    } else {
      $('#'+id).val('0');
    }
  });
  var current_lang = "{{ App::getLocale() }}";
  if(current_lang=="en"){
    $('#buyercontact_modal .select2.country').val(44);
    $('#buyercontact_modal .select2.country').select2().trigger('change');
  }else if(current_lang=="pl"){
    $('#buyercontact_modal .select2.country').val(48);
    $('#buyercontact_modal .select2.country').select2().trigger('change');
  }else if(current_lang=="es"){
    $('#buyercontact_modal .select2.country').val(34);
    $('#buyercontact_modal .select2.country').select2().trigger('change');
  }
  $("#buyercontact_modal .select2.country").select2({
    templateResult: formatState,
    templateSelection: formatState
  });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){

    $('#buyercontact_form .buyer_step1').show();
    $('#buyercontact_form .buyer_step2').hide();
    $('#buyercontact_form .buyer_step3').hide();
    $('.previous_btn').addClass('disabled');

    $(".next_btn").click(function(){
      var index_next = $(this).data('id');
      if(index_next == 1){
        $(this).data('id','2');
        $(this).removeAttr('disabled');
        $('.previous_btn').attr('disabled','disabled');
        $('.previous_btn').addClass('disabled');
        $('#buyercontact_form .buyer_step1').show();
        $('#buyercontact_form .buyer_step2').hide();
        $('#buyercontact_form .buyer_step3').hide();
      }else if(index_next == 2){
        if($("#product_id_buyer").val() != ''){
          $(this).data('id','3');
          $('.previous_btn').removeAttr('disabled');
          $('.previous_btn').removeClass('disabled');
          $('.previous_btn').data('id',2);
          $('#buyercontact_form .buyer_step1').hide();
          $('#buyercontact_form .buyer_step2').show();
          $('#buyercontact_form .buyer_step3').hide();
        }else{
          return false;
        }
      }else if(index_next == 3){
        if($("#product_id_buyer").val() != '' && $("#product_type").val() != ''){
          $(this).attr('disabled','disabled');
          $(this).addClass('disabled');
          $('.previous_btn').data('id',2);
          $('.previous_btn').removeAttr('disabled');
          $('.previous_btn').removeClass('disabled');
          $('#buyercontact_form .buyer_step1').hide();
          $('#buyercontact_form .buyer_step2').hide();
          $('#buyercontact_form .buyer_step3').show();
        }else{
          return false;
        }
      }
    });

    $(".previous_btn").click(function(){
      var index_previous = $(this).data('id');
      if(index_previous == 1){
        $(this).attr('disabled','disabled');
        $(this).addClass('disabled');
        $('.next_btn').removeAttr('disabled');
        $('.next_btn').removeClass('disabled');
        $('#buyercontact_form .buyer_step1').show();
        $('#buyercontact_form .buyer_step2').hide();
        $('#buyercontact_form .buyer_step3').hide();
        var url_single = window.location.href;
        var url_single = removeURLParameter(url_single, 'product');
        window.history.pushState("data","Title",url_single);
        $("#product_id_buyer").val("");
      }else if(index_previous == 2){
        $(this).removeAttr('disabled');
        $(this).removeClass('disabled');
        $('.next_btn').removeAttr('disabled');
        $('.next_btn').removeClass('disabled');
        $(this).data('id',1);
        $('.next_btn').data('id',3);
        $('#buyercontact_form .buyer_step1').hide();
        $('#buyercontact_form .buyer_step2').show();
        $('#buyercontact_form .buyer_step3').hide();
        var url_single = window.location.href;
        var url_single = removeURLParameter(url_single, 'subtype');
        window.history.pushState("data","Title",url_single);
        $("#product_type").val("");
      }else if(index_previous == 3){
        $(this).removeAttr('disabled');
        $(this).data('id',2);
        $('.next_btn').data('id',3);
        $('.next_btn').attr('disabled','disabled');
        $('.next_btn').addClass('disabled');
        $('#buyercontact_form .buyer_step1').hide();
        $('#buyercontact_form .buyer_step2').hide();
        $('#buyercontact_form .buyer_step3').show();
      }
    });

    $('#buyercontact_modal.modal').on('show.bs.modal', function () {
      var url = new URL(window.location);
      url.searchParams.set("buy", "0"); // setting your param
      window.history.pushState(null, document.title, url);
    });

    @if(request()->input('product') != '')
        $("#product_id_buyer").val('{{ $product_id }}');
        $('a[data-id="{{ $product_id }}"].product-img-select').trigger('click');
        @if(request()->input('subtype') != '')
          // alert('trigger product type');
          $("#product_type").val('{{ $p_subtype }}');
          $('a[data-name="{{ $p_subtype }}"].product-type-select').trigger('click');
        @endif
    @endif

    $('#buyercontact_modal').on('hidden.bs.modal', function () {
      $("#product_id_buyer").val("");
      $("#product_type").val("");
      $('#buyercontact_form .buyer_step1').show();
      $('#buyercontact_form .buyer_step2').hide();
      $('#buyercontact_form .buyer_step3').hide();
      var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
      });

});
</script>

<script type="text/javascript">
  function removeURLParameter(url, parameter) {
       //prefer to use l.search if you have a location/link object
       var urlparts= url.split('?');
       if (urlparts.length>=2) {

           var prefix= encodeURIComponent(parameter)+'=';
           var pars= urlparts[1].split(/[&;]/g);

           //reverse iteration as may be destructive
           for (var i= pars.length; i-- > 0;) {
               //idiom for string.startsWith
               if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                   pars.splice(i, 1);
               }
           }

           url= urlparts[0]+'?'+pars.join('&');
           return url;
       } else {
           return url;
       }
   }
</script>
