@extends('backend.layouts.app')
@section('title',  __('menus.backend.trading.offers.edit').' :: '.app_name())
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
          @lang('menus.backend.trading.offers.edit')
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
            <input type="text" class="form-control" value="{{ get_buyer_by_user_id()->username }}" readonly>
            <input type="hidden" name="seller_id" value="{{ get_buyer_by_user_id()->id }}">
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
            ->class('select2 form-control')
            ->options(products_list())
            ->attribute('maxlength', 191)
            ->value(@$stock->product->id ?? @$product->id)
            ->attribute('onchange', 'fetch_select(this.value)')
          }}
          <div class="invalid-feedback"></div>
        </div>
      </div>
      <div class="form-group row">
        {{ html()->label('Variety <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('variety') }}
        <div class="col-md-10">
          {{ html()->select('variety')
          ->class('select2 form-control')
          ->options($variety_list)
          ->attribute('maxlength', 191)
          ->value(@$stock->variety ?? old('variety'))
          ->placeholder('Choose Variety')
        }}
        <div class="invalid-feedback"></div>
      </div>
    </div>
    <div class="form-group row">
      {{ html()->label('Size Range (mm)')->class('col-md-2 form-control-label')->for('dry_matter_content') }}
      <div class="col-md-10">
        <div class="form-group row">
          <div class="col-md-2 col-sm-6" style="position:relative">
            <label class="form-control-label" for="size_from">From</label>
            <input class="form-control" type="text" value="{{@$stock->size_from ?? '45'}}" placeholder="Min" name="size_from" id="size_from" /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
          </div>
          <div class="col-md-2 col-sm-6" style="position:relative">
            <label class="form-control-label" for="size_to">To</label>
            <input class="form-control" type="text" value="{{@$stock->size_to ?? '65'}}" placeholder="Max" name="size_to" id="size_to" /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
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
          {{ html()->label(
            html()->checkbox('pallets_available', '1', '1')
            ->class('switch-input')
            ->id('pallets_available')
            . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
            ->class('switch switch-label switch-pill switch-success mr-2')
            ->for('pallets_available') }}
          </div>
          {{-- {{ html()->text('pallets_available')->class('form-control')->placeholder('Pallets Available')->attribute('maxlength', 191) }} --}}
        </div>
      </div>

      <div class="form-group row">
        {{ html()->label('Flesh Color <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('flesh_color') }}
        <div class="col-md-10">
          {{ html()->select('flesh_color')
            ->class('select2 form-control')
            ->options($color_list)
            ->value(@$stock->flesh_color)
            ->attribute('maxlength', 191)
            ->placeholder('Choose Flesh Color')
          }}
          <div class="invalid-feedback"></div>
      </div>
    </div>

        <div class="form-group row">
            {{ html()->label('Soil <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('soil') }}
            <div class="col-md-10">
                {{ html()->select('soil')
                    ->class('select2 form-control')
                    ->options(soil_list_without_anylogic())
                    ->value(@$stock->soil)
                    ->attribute('maxlength', 191)
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
              {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('city') }}
              {{ html()->text('city')->class('form-control')->placeholder('City')->value(@$stock->city)->attribute('maxlength', 191) }}
              <div class="invalid-feedback"></div>
            </div>
          </div><!--col-->

          <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('postalcode') }}
              {{ html()->text('postalcode')->class('form-control')->placeholder('Postal Code')->value(@$stock->postalcode)->attribute('maxlength', 191) }}
              <div class="invalid-feedback"></div>
            </div>
          </div><!--col-->

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
                ->class('select2 form-control')
                ->options(country_list())
                ->value(@$stock->country ?? 'UK')
                ->attribute('maxlength', 191)
              }}
            <!--{{ html()->text('country')->value('PL')->class('form-control')->placeholder('Country')->attribute('maxlength', 191)->attribute('onblur', 'changeRequered()')->required() }}-->
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
      <a href="{{ asset('images/stock/'.$img) }}" target="_blank"><img src="{{ asset('images/stock/'.$img) }}"  target="_blank" class="mb-2 img-thumbnail"></a>
      @endforeach
      <div class="form-group">
        <div class="input-group" name="image">
          <input type="file" name="image[]" id="image" class="form-control" placeholder='Choose a file...' multiple="" />
          <div class="invalid-feedback"></div>
          <span class="input-group-append">
            <button class="btn btn-danger btn-reset" type="button" onclick="document.getElementById('image').value = null;">Delete</button>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    {{ html()->label('Example Picture')->class('col-md-2 form-control-label')->for('exp_image') }}
    <div class="col-md-5">
      <div class="form-group">
        @if(@$stock_image)
        <a href="{{ asset('images/stock/'.$stock_image) }}" target="_blank"><img src="{{ asset('images/stock/'.$stock_image) }}"  target="_blank" class="mb-2 img-thumbnail"></a>
        @endif
      </div>
    </div>
  </div>
  
  @if(count($purpose_list) > 0)
  <div class="form-group row">
    {{ html()->label('<strong>Purpose or Condition (choose all that apply)</strong>')->class('col-md-12 form-control-label')->for('purposes') }}
    <div class="col-md-12">
      <div class="row app-head-group-purpose">
        @php
        $purposes_list_selected_keys = array();
        $purposes_list = $purpose_list;
        if(isset($stock->purposes) && !empty($stock->purposes)){
          $purposes_list_selected = json_decode($stock->purposes,true);
          $purposes_list_selected_keys = (is_array($purposes_list_selected)?array_keys($purposes_list_selected):array());
        }
        @endphp
        @foreach($purposes_list as $key => $purpose)
        @php if($purpose == 'Washing' || $purpose == 'Export'){
          $df_value = 10;
        }elseif($purpose == 'Peeling'){
          $df_value = '-15';
        }else{
          $df_value = 0;
        }
        @endphp
        @php $purpose_key = str_slug($purpose, "_"); @endphp
        @php 
            $explodename = explode(':',$purpose);
            $title = current($explodename);
        @endphp
        @if(end($explodename) != 'AnyLogic')
            <div class="flex_item purpose_item form-group">
              <div class="checkbox switch-box d-flex align-items-center">
                {{ html()->label(
                  html()->checkbox('purposes['.$purpose_key.']', in_array($purpose_key, $purposes_list_selected_keys), $purpose_key)
                  ->class('switch-input switch_select_item')
                  ->attribute('data-group','purpose')
                  ->id($purpose_key)
                  . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                  ->class('switch switch-label switch-pill switch-primary mr-2')
                  ->for($purpose_key)
                }}

                {{-- <input type="number" name="purposes[{{$purpose_key}}]" value="{{$purposes_list_selected["$purpose_key"] ?? $df_value}}" data-decimals="0" min="-15" max="15" step="1"/> --}}
                {{ html()->label(ucwords($purpose))->for($purpose_key)->class('flex-1') }}
              </div>
            </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  @endIf

  @if(count($defects_list) > 0)
  <div class="form-group row">
    {{ html()->label('<strong>Defects</strong>')->class('col-md-12 form-control-label')->for('defects') }}
    <div class="col-md-12">
      <div class="row app-head-group-defect">
        @php
        $defects_list_selected_keys = array();
        $defects_list = $defects_list;
        if(isset($stock->defects) && !empty($stock->defects)){
          $defects_list_selected = json_decode($stock->defects,true);
          $defects_list_selected_keys = (is_array($defects_list_selected)?array_keys($defects_list_selected):array());
        }
        @endphp
        @foreach($defects_list as $key => $defect)
        @php $defect_key = str_slug($defect, "_"); @endphp
        @php 
            $explodename = explode(':',$defect);
            $title = current($explodename);
        @endphp
        @if(end($explodename) != 'AnyLogic')
         <div class="flex_item defects_item form-group">
          <div class="checkbox switch-box d-flex align-items-center">
            {{ html()->label(
              html()->checkbox('defects['.$defect_key.']', in_array($defect_key, $defects_list_selected_keys), $defect_key)
               ->class('switch-input switch_select_item')
               ->attribute('data-group','defect')
              ->id($defect_key)
              . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
              ->class('switch switch-label switch-pill switch-primary mr-2')
              ->for($defect_key)
            }}
            {{ html()->label(ucwords($defect))->for($defect_key)->class('flex-1') }}
            {{-- <input type="number" name="defects[{{$defect_key}}]" value="{{$defects_list_selected["$defect_key"] ?? 0}}" data-decimals="0" min="-15" max="15" step="1"/> --}}
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>

  </div>
  @endIf
  @if(count($packaging_list) > 0)
  <div class="form-group row">
    {{ html()->label('<strong>Packing options available (choose all that apply)</strong>')->class('col-md-12 form-control-label')->for('soil') }}
    <div class="col-md-12">
      <div class="row app-head-group-packing">
        @php
        $packaging_list_selected_keys = array();
        $packaging_list = $packaging_list;
        if(isset($stock->packaging) && !empty($stock->packaging)){
          $packaging_list_selected = json_decode($stock->packaging,true);
          // $packaging_list_selected_keys = array_keys($packaging_list_selected);
          $packaging_list_selected_keys = (is_array($packaging_list_selected)?array_keys($packaging_list_selected):array());
        }
        @endphp
        @foreach($packaging_list as $key => $packaging)
        @php $packaging_key = str_slug($packaging, "_"); @endphp
        @php 
            $explodename = explode(':',$packaging);
            $title = current($explodename);
        @endphp
        @if(end($explodename) != 'AnyLogic')
         <div class="flex_item packaging_item form-group">
          <div class="checkbox switch-box d-flex align-items-center">
            {{ html()->label(
              html()->checkbox('packaging['.$packaging_key.']', in_array($packaging_key, array_values($packaging_list_selected_keys)), $packaging_key)
              ->class('switch-input switch_select_item')
               ->attribute('data-group','packing')
              ->id($packaging_key)
              . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
              ->class('switch switch-label switch-pill switch-primary mr-2')
              ->for($packaging_key)
            }}

            {{-- <input type="number" name="packaging[{{$packaging_key}}]" value="{{$packaging_list_selected["$packaging_key"] ?? 0}}" data-decimals="0" min="-15" max="15" step="1"/> --}}
            {{ html()->label(ucwords($packaging))->for($packaging_key)->class('flex-1') }}
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  @endIf

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
  @endphp
@else
  @php 
    $url =  route($route_pre.'.stock.store');
    $redirecturl =  route($route_pre.'.stock.index');
    $stockid = 0;
  @endphp
@endif
@endsection

@push('after-scripts')
<style>
  .datepicker > div.datepicker-days{display:block !important;}
</style>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
  $(document).ready(function() {
		$('#formsubmit').on('submit', function(event) {
			event.preventDefault();
			
      $('.has-danger').next().children().children().css({"border": ""});
      $('.is-invalid').removeClass("is-invalid");
      $('.invalid-feedback').html("");
      $('.has-danger').removeClass("has-danger");

			var formData = new FormData($(this)[0]);

      var stockid = {{ $stockid }};
      if(stockid != 0){
        formData.append('_method', 'PUT');
      }
			
			$.ajax({
				url: "{{ $url }}",
				method: 'POST',
				data: formData,
				contentType: false,							
				cache: false,
				processData: false,
				dataType: "json",
				beforeSend: function(){
				},
				success: function(data)
				{
					if(data.status == 'success'){
            Swal.fire('Sent!', data.message, 'success');
						setTimeout(function(){
							window.location.href = "{{ $redirecturl }}"; 
						}, 5000);
					}
					if(data.status == 'error'){
            Swal.fire('Error!', data.message, 'error');
            $('.btn-success').removeAttr('disabled');
					}
				},
				error :function( data ) {
					if( data.status === 422 ) {
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

    $(".any_type_selected").click(function(){
        dataGroup = $(this).attr('data-group');
        dataItem = $(this).attr('data-item');
        state = $(this).prop('checked');
        console.log(dataItem);
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
    // alert('dfd');
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
      data: {pid:val,psid:34},
      success: function (data) {
        $('#variety').html(data.variety_list);
        $('#variety').select2().trigger('change');
        $('#flesh_color').html(data.color_list);
        $('#flesh_color').select2().trigger('change');
        $('.app-head-group-packing').html(data.packaging_list);
        $('.app-head-group-purpose').html(data.purpose_list);
        $('.app-head-group-defect').html(data.defect_list);
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

  </script>
@endpush
