@extends('backend.layouts.app')
  @if(!empty($stock->id))
    @section('title', __('menus.backend.trading.offers.edit').' :: '.app_name())
  @else
    @section('title', __('menus.backend.trading.offers.create').' :: '.app_name())
  @endIf
@section('content')

@role('seller')
  @php $route_pre = 'seller'; @endphp
@else
  @php $route_pre = 'admin'; @endphp
@endif

{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
        @if(!empty($stock->id))
          @lang('menus.backend.trading.offers.edit')
        @else
          @lang('menus.backend.trading.offers.create')
        @endIf
          <small class="text-muted"></small>
        </h4>
      </div><!--col-->
    </div><!--row-->

    <hr>

    <div class="row mt-4 mb-4">
      <div class="col">
        @role('seller')
          <div class="form-group row">
            {{ html()->label('Username <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('product') }}
            <div class="col-md-10">
              <input type="text" class="form-control" value="{{ @get_buyer_by_user_id()->username }}" readonly>
              <input type="hidden" name="seller_id" value="{{ @get_buyer_by_user_id()->id }}">
              <div class="invalid-feedback"></div>
          </div>
        </div>
      @else
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="seller_id">{{__('validation.attributes.backend.trading.requests.seller')}} <span style="color:red">*</span></label>
          <div class="col-md-10">
            <select class="form-control select2" name="seller_id" id="seller_id" maxlength="191">
              <option value="">{{__('validation.attributes.backend.trading.requests.select_seller')}}</option>
              @foreach($sellers as $seller)
              <option {{old('seller_id')==$seller->id?'selected':''}} value="{{ $seller->id}}" @if(@$seller->id == @$stock->seller_id) selected @endif>{{ $seller->name}} ({{ $seller->username}})</option>
              @endforeach
            </select>
            <div class="invalid-feedback"></div>
          </div><!--col-->
        </div>
      @endrole

      <div class="form-group row">
        {{ html()->label('Product <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('product') }}
        <div class="col-md-10">
          {{ html()->select('product_id')
          ->class('select2 form-control change-image')
          ->attribute('maxlength', 191)
          ->options($products)
          ->value(@$stock->product->id)
          ->attribute('onchange', 'fetch_select(this.value)')
          ->placeholder('Choose Product')
        }}
        <div class="invalid-feedback"></div>
      </div>
    </div>

    @if(!empty($stock->id))
      <div class="product-nets">
        @include('backend.products.stock-product-pref', ['productSpecRel' => $productSpecRel,'productSpecChildRelation' => $productSpecChildRelation])
      </div>
    @else
      <div class="product-nets"></div>
    @endIf

    <div class="form-group row">
      {{ html()->label('Size Range (mm)')->class('col-md-2 form-control-label')->for('dry_matter_content') }}
      <div class="col-md-10">
        <div class="form-group row">
          <div class="col-md-2 col-sm-6" style="position:relative">
            <label class="form-control-label" for="size_from">From</label>
            <input class="form-control" type="text" pattern="[0-9]*" inputmode="numeric" value="{{@$stock->size_from ?? '45'}}" placeholder="Min" name="size_from" id="size_from" /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
          </div>
          <div class="col-md-2 col-sm-6" style="position:relative">
            <label class="form-control-label" for="size_to">To</label>
            <input class="form-control" type="text" pattern="[0-9]*" inputmode="numeric" value="{{@$stock->size_to ?? '65'}}" placeholder="Max" name="size_to" id="size_to" /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
          </div>
        </div>
      </div><!--col-->
    </div><!--form-group-->

    <div class="form-group row">
      {{ html()->label('Number of 24T Truck Loads <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('quantity') }}
      <div class="col-md-10">
        {{ html()->text('quantity')
        ->class('form-control')
        ->placeholder(__('validation.attributes.backend.trading.offers.quantity'))
        ->attribute('maxlength', 191)
        ->attribute('pattern', '[0-9]*')
        ->attribute('inputmode', 'numeric')
        ->value(@$stock->quantity) }}
        <div class="invalid-feedback"></div>
      </div><!--col-->
    </div><!--form-group-->
    <div class="form-group row">
      {{ html()->label('Available From Date <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('available_from_date') }}
      <div class="col-md-3">
        {{ html()->text('available_from_date')->class('datepicker form-control')->value(@$stock->available_from_date)->placeholder('Available From Date')->attribute('maxlength', 191) }}
        <div class="invalid-feedback"></div>
      </div>
    </div>
    <div class="form-group row">
      {{ html()->label('Truckloads available per day <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('available_per_day') }}
      <div class="col-md-3">
        <select name="available_per_day" id="available_per_day" class="form-control select2">
          <option value="">Select Available per day</option>
          <option value="1" <?php echo (@$stock->available_per_day=='1'?'selected':'')?>>1</option>
          <option value="2" <?php echo (@$stock->available_per_day=='2'?'selected':'')?>>2</option>
          <option value="3" <?php echo (@$stock->available_per_day=='3'?'selected':'')?>>3</option>
          <option value="4" <?php echo (@$stock->available_per_day=='4'?'selected':'')?>>4</option>
          <option value="5" <?php echo (@$stock->available_per_day=='5'?'selected':'')?>>5</option>
        </select>
        <div class="invalid-feedback"></div>
        {{-- {{ html()->text('available_per_day')->class('form-control')->placeholder('Available Per Day')->attribute('maxlength', 191) }} --}}
      </div>
    </div>
    <div class="form-group row">
      {{ html()->label('Pallets Available')->class('col-md-2 form-control-label')->for('pallets_available') }}
      <div class="col-md-3">
        <div class="checkbox d-flex align-items-center">
          @if(!empty($stock->id))
            @if($stock->pallets_available)
              @php $is_checked = 1 @endphp
            @else
              @php $is_checked = 0 @endphp
            @endif
          @else
            @php $is_checked = 1 @endphp
          @endif
          {{ html()->label(
            html()->checkbox('pallets_available', $is_checked, $is_checked)
            ->class('switch-input pallet_stock')
            ->id('pallets_available')
            . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
            ->class('switch switch-label switch-pill switch-success mr-2')
            ->for('pallets_available') }}
        </div>
        {{-- {{ html()->text('pallets_available')->class('form-control')->placeholder('Pallets Available')->attribute('maxlength', 191) }} --}}
      </div>
    </div>

    <div class="form-group row">
      {{ html()->label('Stock Status')->class('col-md-2 form-control-label')->for('stock_status') }}
      <div class="col-md-10">
        {{ html()->select('stock_status')
          ->class('select2 form-control')
          ->options(stock_status_list())
          ->value((!empty(@$stock->id)) ? $stock->stock_status : 'available')
          ->attribute('maxlength', 191)
          ->placeholder('Choose Stock Status')
        }}
        <div class="invalid-feedback"></div>
      </div>
    </div>

    <div class="form-group row">
      {{ html()->label('Loading Address')->class('col-md-2 form-control-label')->for('company_name') }}
      <div class="col-md-10">
        <div class="row">
        <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('Street Address')->class('form-control-label')->for('street') }}
              {{ html()->text('street')->class('form-control')->placeholder('Street Address')->value(@$stock->street)->attribute('maxlength', 191) }}
            </div>
          </div><!--col-->

        <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('Country')->class('form-control-label')->for('country') }}
              {{ html()->select('country')
                ->class('select2 form-control country')
                ->options(country_list())
                ->value(@$stock->country ?? '')
                ->attribute('maxlength', 191)
                ->placeholder("Choose Country")
              }}
              <div class="invalid-feedback"></div>
            </div>
          </div><!--col-->

          <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('city') }}
              <!-- {{ html()->text('city')->class('form-control')->placeholder('City')->value(@$stock->city)->attribute('maxlength', 191) }} -->
              {{ html()->select('city')
                ->class('select2 form-control city')
                ->options(@$stock->city)
                ->value(@$stock->city ?? '')
                ->attribute('maxlength', 191)
                ->placeholder("Choose City")
              }}
              <div class="invalid-feedback"></div>
            </div>
          </div><!--col-->

          <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('postalcode') }}
              <!-- {{ html()->text('postalcode')->class('form-control')->placeholder('Postal Code')->value(@$stock->postalcode)->attribute('maxlength', 191) }} -->
              {{ html()->select('postalcode')
                ->class('select2 form-control postal_code')
                ->options(@$stock->postalcode)
                ->value(@$stock->postalcode ?? '')
                ->attribute('maxlength', 191)
                ->placeholder("Choose Postal Code")
              }}
              <div class="invalid-feedback"></div>
            </div>
          </div><!--col-->
        </div><!--form-group-->
      </div>
    </div>
    <div class="form-group row">
      {{ html()->label('Price in GBP per ton <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('price') }}
      <div class="col-md-10">
        {{ html()->text('price')
        ->class('form-control')
        ->placeholder(__('validation.attributes.backend.trading.offers.price'))
        ->attribute('maxlength', 191)
        ->value(@$stock->price) }}
        <div class="invalid-feedback"></div>
      </div><!--col-->
    </div><!--form-group-->
    <div class="form-group row">
      {{ html()->label('Note')->class('col-md-2 form-control-label')->for('note') }}
      <div class="col-md-10">
        <textarea class="form-control" name="note" rows="3" placeholder="Note" id="note">{{ @$stock->note }}</textarea>
      </div>
    </div>
    <div class="form-group row">
      {{ html()->label('Stock Image')->class('col-md-2 form-control-label')->for('image') }}
      <div class="col-md-10">
        @php $images = (isset($stock->image) ? (is_array(json_decode(@$stock->image)) ? json_decode(@$stock->image) : array($stock->image)) : array()); @endphp
        @foreach(@$images as $img)
        <a href="{{ asset('images/stock/'.$img) }}" data-fancybox data-caption="{{@$stock->product->name}}"><img src="{{ asset('images/stock/'.$img) }}" class="mb-2 stock-image img-thumbnail" /></a>
        @endforeach
    <div class="form-group row">
      <div class="col-md-12">
      <div class="form-group">
          <div class="input-group" name="image">
            <input type="file" name="image[]" id="image" class="form-control" placeholder='Choose a file...' multiple="" />
            <div class="invalid-feedback"></div>
            <span class="input-group-append">
              <button class="btn btn-danger btn-reset" type="button" onclick="document.getElementById('image').value = null;">Delete</button>
            </span>
          </div>
          <label class="placehoder-notif">Upto 6 images can be uploaded. Each image max size 5MB.</label>
        </div>
      </div>
      </div>
      </div>
    </div>
	@if(@$product_image[0]->id)
	@if($product_image[0]->image != '')
    <div class="form-group row">
      {{ html()->label('Example Picture')->class('col-md-2 form-control-label')->for('exp_image') }}
      <div class="col-md-5">
        <div class="form-group" id="sample_image">
			<a href="{{ asset('images/products/') }}/{{$product_image[0]->image}}" data-fancybox data-caption="{{ $product_image[0]->name }}"><img src="{{ asset('images/products/'.$product_image[0]->image) }}" class="mb-2 img-thumbnail"></a>
        </div>
      </div>
    </div>
	@endif
    @endif
  </div><!--col-->
</div><!--row-->
</div><!--card-body-->

  <div class="card-footer clearfix">
    <div class="row">
      <div class="col">
        {{ form_cancel(route($route_pre.'.stock.index'), __('buttons.general.cancel')) }}
      </div><!--col-->

      <div class="col text-right">
        @if(!empty($stock->id))
          {{ form_submit(__('buttons.general.crud.update')) }}
        @else
          {{ form_submit(__('buttons.general.crud.create')) }}
        @endif
      </div><!--col-->
    </div><!--row-->
  </div><!--card-footer-->
</div><!--card-->
{{ html()->form()->close() }}
@role('seller')
  @php $route_pre = 'seller'; @endphp
@else
  @php $route_pre = 'admin'; @endphp
@endif

@if(!empty($stock->id))
  @php
    $url =  route($route_pre.'.stock.update', $stock->id);
    $redirecturl =  route($route_pre.'.stock.index');
    $stockid = $stock->id;
    $country = $stock->country;
    $cityid = $stock->city;
    $postalid = $stock->postalcode;
  @endphp
@else
  @php
    $url =  route($route_pre.'.stock.store');
    $redirecturl =  route($route_pre.'.stock.index');
    $stockid = 0;
    $country = '';
    $cityid = '';
    $postalid = '';
  @endphp
@endif
@endsection

@push('after-scripts')
<style>
  .datepicker > div.datepicker-days{display:block !important;}
</style>
<script type="text/javascript">
  var countryid = '{{ $country }}';
  var cityid = '{{ $cityid }}';
  var postalid = '{{ $postalid }}';
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function() {
    $('.Packing,.Defect,.Purpose').hide();
		$('#formsubmit').on('submit', function(event) {
      event.preventDefault();

      $('.has-danger').next().children().children().css({"border": ""});
      $('.is-invalid').removeClass("is-invalid");
      $('.invalid-feedback').html("");
      $('.has-danger').removeClass("has-danger");

      var formData = new FormData($(this)[0]);
        
      $( ".pallet_stock" ).each(function( key, value ) {
        if(value.value == 0){
          formData.append(value.name, value.value);
        }
      });

      $("select:disabled").each(function( key, value ) {
        if($(this).val() != ''){
          formData.append($(this).attr('name'), $(this).val());
        }
      });

      var stockid = {{ $stockid }};
      if(stockid != 0){
        formData.append('_method', 'PUT');
      }
      console.log(formData);

      $.ajax({
        url: "{{ $url }}",
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
              window.location.href = "{{ $redirecturl }}";
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

  $('.switch').click(function() {
    switchPremium($(this).children('input').attr('id'));
  });

  $('body').on('change','select',function() {
    field1 = $(this).find('option:selected').attr('data-field1');
    field1_value = $(this).find('option:selected').attr('data-field1-value');
    $('select[name="specification['+field1+']"]').find('option').each(function(k,v){
      if(this.text == field1_value){
        $(this).attr('selected','selected');
      } else {
        $(this).removeAttr('selected');
      }
    });
  });

  $('.country').on('change', function(){
    $('.city').empty();
    var country = $(this).val();
    $.ajax({
      type: "POST",
      url: "{{ url($route_pre.'/get_city_list') }}"+'/'+country,
      success: function (data) {
        $('.city').empty();
        $(".city").append('<option value="">Choose City</option>');
        $.each(data,function(key,value){
          $(".city").append('<option value="'+key+'">'+value+'</option>');
        });
      }
    });
  });

  $('.city').on('change', function(){
    $('.postal_code').empty();
    var city = $(this).val();
    $.ajax({
      type: "POST",
      url: "{{ url($route_pre.'/get_postal_code') }}"+'/'+city,
      success: function (data) {
                $('.postal_code').empty();
                $(".postal_code").append('<option value="">Choose Postal Code</option>');
                $.each(data,function(key,value){
                  $(".postal_code").append('<option value="'+key+'">'+value+'</option>');
              });
      }
    });
  });

  if(countryid != ''){
    var country = '{{ $country }}';
    $.ajax({
      type: "POST",
      url: "{{ url($route_pre.'/get_city_list') }}"+'/'+country,
      success: function (data) {
        $('.city').empty();
        $(".city").append('<option value="">Choose City</option>');
        $.each(data,function(key,value){
          if(cityid == key){
            $(".city").append('<option selected="selected" value="'+key+'">'+value+'</option>');
          }else{
            $(".city").append('<option value="'+key+'">'+value+'</option>');
          }
        });
      }
    });

    $('.postal_code').empty();
    var city = '{{ $cityid }}';
    $.ajax({
      type: "POST",
      url: "{{ url($route_pre.'/get_postal_code') }}"+'/'+city,
      success: function (data) {
        $('.postal_code').empty();
        $(".postal_code").append('<option value="">Choose Postal Code</option>');
        $.each(data,function(key,value){
          if(postalid == key){
            $(".postal_code").append('<option selected="selected" value="'+key+'">'+value+'</option>');
          }else{
            $(".postal_code").append('<option value="'+key+'">'+value+'</option>');
          }
        });
      }
    });
  }

  $(".any_type_selected").click(function(){
    dataGroup = $(this).attr('data-group');
    dataItem = $(this).attr('data-item');
    state = $(this).prop('checked');
    $(".app-head-group-"+dataGroup).find("."+dataItem).each(function(){
      if(state == true){
        $(this).find('input[type=checkbox]').prop('checked', true);
      } else {
        $(this).find('input[type=checkbox]').prop('checked', false);
      }
    });
  });

  $(".switch_select_item").click(function(){
    dataGroup = $(this).attr('data-group');
    state = $(this).prop('checked');
    if(state == false){
      $(".any_type_selected[data-group='"+dataGroup+"']").prop('checked', false);
    }
  });

  $( "#available_from_date" ).datepicker({
    format: "yyyy-mm-dd",
    weekStart: 0,
    calendarWeeks: true,
    autoclose: true,
  });

  $( ".checkbox.switch-box .switch input" ).each(function( index,element ) {
    switchPremium(element.id);
  });

  function switchPremium(id){
    if ($('input#'+id).prop('checked')) {
      $('input#'+id).parent().parent().find('input[type=number]').prop('disabled', false);
    } else {
      $('input#'+id).parent().parent().find('input[type=number]').prop('disabled', true);
    }
  }

  function fetch_select(val){
    $.ajax({
      type: "POST",
      url: "{{ route($route_pre.'.trading.getproduct') }}",
      data: {pid:val},
      success: function (data) {
        $('.product-nets').html(data);
        return false;
      }
    });
  }

  function fetch_color(val){
    $.ajax({
      type: "POST",
      url: "{{ route($route_pre.'.trading.getcolor') }}",
      data: {pid:val},
      success: function (data) {
        $('#flesh_color').val(data.color_id);
        $('#flesh_color').select2().trigger('change');
      }
    });
  }

  $('.change-image').on('change', function(){
    var product = $(this).val();
    $.ajax({
      type: "POST",
      url: "{{ route($route_pre.'.trading.getproductsample') }}",
      data: {pid:product},
      success: function (data) {
        $('#sample_image').empty();
        $('#sample_image').html(data);
      }
    });
  });

  $('body').on('click', '.pallet_stock', function(){
    if(this.checked){
      $(this).val(1);
      $(this).attr('checked','checked');
    }else{
      $(this).val(0);
      $(this).removeAttr('checked');
    }
  })

  </script>
@endpush