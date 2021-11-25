@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.sales.edit') . ' #'.$sale->id.' :: ' . app_name())
@section('content')
{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
          @lang('menus.backend.trading.sales.edit')
          <small class="text-muted"></small>
        </h4>
      </div>
    </div>
    <hr>
    <div class="row mt-4 mb-4">
      <div class="col">
			<div class="form-group row">
				{{ html()->label('Buyer')->class('col-md-2 form-control-label')->for('Buyer') }}
				<div class="col-md-10">
					{{ html()->select('buyer_id')
					->class('select2 form-control')
					->options($buyers)
					->attribute('maxlength', 191)
					->attribute('onchange', 'fetch_buyer(this.value);')
					->value($sale->buyer_id)
					->placeholder('Choose Buyer')
				  }}
				  <div class="invalid-feedback"></div>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="match_id">Match</label>
				<div class="col-md-10">
					<input class="form-control" name="match_id" value="{{$sale->match_id}}" onkeyup="fetch_match(this.value);" id="match_id" type="text"/>
					<div class="invalid-feedback"></div>
				</div>
            </div>
			
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="request_id">Stock ID </label>
				<div class="col-md-10">
					<input class="form-control" name="stock_id" value="{{$sale->stock_id}}" id="stock_id" type="text"/>
					<div class="invalid-feedback"></div>  
				</div>
            </div>

        
         
			<div class="form-group row stock_props" style="display:none;">
				<label class="col-md-2 form-control-label" for="request_id">&nbsp;</label>
				<div class="col-md-10">
					<label>Seller : <span id="stock_seller"></span></label><br/>
					<label>Product : <span id="stock_product"></span></label><br/>
					<label>Variety : <span id="stock_variety"></span></label><br/>
					<label>Size From : <span id="stock_size_from"></span></label><br/>
					<label>Size To : <span id="stock_size_to"></span></label><br/>
					<label>Packing : <span id="stock_packing"></span></label><br/>
					<label>Flesh Color : <span id="stock_color"></span></label><br/>
					<label>Postal Code : <span id="stock_postalcode"></span></label><br/>
					<label>Location : <span id="stock_location"></span></label>
				</div>
            </div>
			
			<div class="form-group row">
            <label class="col-md-2 form-control-label" for="request_id">Quantity </label>
            <div class="col-md-10">
				<input class="form-control" name="quantity" value="{{$sale->quantity}}" id="quantity" type="text" type="number"/>
				<div class="invalid-feedback"></div>
				<span class="quantity_error"></span>
              </div>
            </div>
			@php $dkey = 1; @endphp
			@foreach($saledelivery as $deliveryset)
			<div class="delivery_main" id="deld" data-id="{{$dkey}}">
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for=""><strong>Delivery {{$dkey}}</strong> </label>
				
				<div class="col-md-2">
					<div class="form-group">
					  	<label class="form-control-label" for="">Delivery Date</label>
 
						<input data-id="1" class="form-control delivery_date deldate delsdat " name="truck[{{$dkey}}][delivery_date]" id="truck_1_delivery_date" value="{{date('m/d/Y',strtotime($deliveryset->deliverymain))}}" placeholder="Delivery Date" type="text"/>
 						 
						<div class="invalid-feedback"></div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
					  	<label class="form-control-label" for="">Number of loads</label>
						<input class="form-control truck 1 number_of_loads" id="truck[$dkey][number_of_loads]" name="truck[$dkey][number_of_loads]" value="{{$deliveryset->loadcount}}" placeholder="Number of loads" type="text"/>
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
			
			<div class="additional_trucks">
			
				@php $tNumber= 1 @endphp
				@foreach($saleTrucks as $truck)
				@if($truck->deliveryid == $deliveryset->id)
					<div class="form-group row">
						<label class="col-md-2 form-control-label" for=""><strong>Load{{$tNumber}}</strong> </label>
						<div class="col-md-1">
						<div class="form-group">
							<label class="form-control-label" for="">Price</label>
							<input class="form-control" name="truck[{{$truck->id}}][price]" value="{{$truck->price}}" placeholder="Price" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="form-control-label" for="">Sale Date</label>
							<input class="form-control sale_date" name="truck[{{$truck->id}}][sale_date]" value="{{date('m/d/Y',strtotime($truck->sale_date))}}" autocomplete="off" placeholder="Sale Date" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="form-control-label" >Delivery Location</label>
							<input class="form-control" name="truck[{{$truck->id}}][delivery_location]" value="{{$truck->delivery_location}}" autocomplete="off"  placeholder="Delivery Location" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="form-control-label" for="">Delivery Date</label>
							<input class="form-control delivery_date" name="truck[{{$truck->id}}][delivery_date]" value="{{date('m/d/Y',strtotime($truck->delivery_date))}}" placeholder="Delivery Date" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group">
							<label class="form-control-label" >Truck loads</label>
							<input class="form-control" name="truck[{{$truck->id}}][truck_loads]" value="{{$truck->truck_loads}}" placeholder="Truck loads" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					
					<div class="col-md-2">
					<div class="form-group">
						<label class="form-control-label">Status</label>
						<select name="truck[1][load_status]" id="truck[1][load_status]" class="select2 form-control">
							<option value="">Select Option</option>
							@foreach($loads_status as $status)
							@if($truck->load_status==$status->id)
								<option value="{{ $status->id }}" selected="selected">{{ $status->status }}</option>
							@else
								<option value="{{ $status->id }}" >{{ $status->status }}</option>
							@endif
							@endforeach
						</select>
					</div>
				  </div>
					
				</div>
				@php $tNumber++; @endphp
				@endif
				
				@endforeach
				
			</div>
		
			</div>
			@php $dkey++; @endphp
			@endforeach
			
			
			<div class="form-group row">
            <label class="col-md-2 form-control-label" for="request_id">Payment Prefs</label>
            <div class="col-md-10">
              	<select class="select2 form-control" name="payment_options" id="payment_options" maxlength="191">
                	<option value="">Select Option</option>
				</select>
                <div class="invalid-feedback"></div>
              </div>
            </div>
			
				
			  <div class="form-group row">
				  {{ html()->label('Payment Term')->class('col-md-2 form-control-label')->for('Payment Term') }}
				  <div class="col-md-10">
					{{ html()->select('payment_term')
					->class('select2 form-control')
					->options($payment_terms)
					->attribute('maxlength', 191)
					->value($sale->payment_term)
					->placeholder('Choose Payment Term')
				  }}
				  <div class="invalid-feedback"></div>
				</div>
			  </div>
			  <div class="form-group row">
				<label class="col-md-2 form-control-label" for="match_id">Defect Percentage</label>
				<div class="col-md-10">
					<input class="form-control" name="defect_percentage" id="defect_percentage" value="{{$sale->defect_percentage}}" placeholder="eg +50% or -50%" type="text"/>
				</div>
            </div>
			<div class="form-group row">
				  {{ html()->label('Payment Type')->class('col-md-2 form-control-label')->for('Payment Type') }}
				  <div class="col-md-10">
					{{ html()->select('payment_type')
					->class('select2 form-control')
					->options($payment_types)
					->attribute('maxlength', 191)
					->value($sale->payment_type)
					->placeholder('Choose Payment Type')
				  }}
				  <div class="invalid-feedback"></div>
				</div>
			  </div>
			  
			
			<div class="form-group row">
				  {{ html()->label('Payment Currency')->class('col-md-2 form-control-label')->for('Payment Currency') }}
				  <div class="col-md-10">
					{{ html()->select('payment_currency')
					->class('select2 form-control')
					->options($currencyIds)
					->attribute('maxlength', 191)
					->value($sale->payment_currency)
					->placeholder('Choose Payment Currency')
				  }}
				  <div class="invalid-feedback"></div>
				</div>
			  </div>
			  
			  
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for="request_id">Status</label>
				<div class="col-md-10">
					<label class="radio-inline"><input  name="status" {{$sale->status == 'ordered'?'checked':''}} type="radio" value="ordered" id="delivery_date_paid" /> Ordered</label>
					&nbsp;
					<label class="radio-inline"><input  name="status" {{$sale->status == 'confirmed'?'checked':''}} type="radio" value="confirmed" id="delivery_date_unpaid" /> Confirmed</label>
			  </div>
            </div>           
          </div>
        </div>
      </div>
      <div class="card-footer clearfix">
        <div class="row">
          <div class="col">
            {{ form_cancel(route('admin.sales.index'), __('buttons.general.cancel')) }}
          </div>
          <div class="col text-right">
            {{ form_submit(__('buttons.general.crud.update')) }}
          </div>
        </div>
      </div>
    </div>
    {{ html()->form()->close() }}
    @endsection

@push('after-scripts')
<style>
.datepicker > div.datepicker-days{display:block !important;}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
	});

	$('#formsubmit').on('submit', function(event) {
		event.preventDefault();

		$('.has-danger').next().children().children().css({"border": ""});
		$('.is-invalid').removeClass("is-invalid");
		$('.invalid-feedback').html("");
		$('.has-danger').removeClass("has-danger");
		
		var formData = new FormData(this);
		formData.append('_method', 'PUT');
		
		$.ajax({
			url: "{{ route('admin.sales.update', $sale->id) }}",
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
				$('.loading').addClass('loading_hide');
				if(data.status == 'success'){
					setTimeout(function(){
						Swal.fire('Sent!', data.message, 'success');
						window.location.href = "{{ route('admin.sales.index') }}"; 
					}, 2000);
				}
				if(data.status == 'error'){
					setTimeout(function(){
						Swal.fire('Error!', data.message, 'error');
					}, 2000);
				}
			},
			error :function( data ) {
				$('.loading').addClass('loading_hide');
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

	$(".sale_date").datepicker({
		format: "mm/dd/yyyy",
		weekStart: 0,
		calendarWeeks: true,
		autoclose: true,
	});

	$(".delivery_date").datepicker({
		format: "mm/dd/yyyy",
		weekStart: 0,
		calendarWeeks: true,
		autoclose: true,
	});

	var loadstatus = JSON.parse('@json($loads_status)');
	//console.log(loadstatus);
	var selectOpt = '<option value="" selected="selected">Select Option</option>';
	$.each(loadstatus,function(key,value){
		selectOpt += '<option value="'+value.id+'">'+value.status+'</option>'
	});
	
	$('#quantity').keyup(function(){
		quantity = this.value;
		if(quantity > 10){
			$(".quantity_error").html('Quantity should not be greater than 10.');
			$('.additional_trucks').html('');
		} else {
			$(".quantity_error").html('');
			$('.additional_trucks').html('');
			for(var i=1;i<=quantity;i++){
				var html = '<div class="form-group row"> <label class="col-md-2 form-control-label" for=""><strong>Delivery'+i+'</strong> </label> <div class="col-md-1"> <div class="form-group"> <label class="form-control-label" for="">Price</label> <input class="form-control" name="truck['+i+'][price]" placeholder="Price" type="text"/></div></div><div class="col-md-2"> <div class="form-group"> <label class="form-control-label" for="">Sale Date</label><input class="form-control sale_date" name="truck['+i+'][sale_date]" autocomplete="off" placeholder="Sale Date" type="text"/></div></div><div class="col-md-2"><div class="form-group"><label class="form-control-label" >Delivery Location</label><input class="form-control" name="truck['+i+'][delivery_location]" id="truck['+i+'][delivery_location]" placeholder="Delivery Location" type="text"/><div class="invalid-feedback"></div></div></div><div class="col-md-2"> <div class="form-group"><label class="form-control-label" for="">Delivery Date</label><input class="form-control delivery_date" name="truck['+i+'][delivery_date]" placeholder="Delivery Date" type="text"/></div></div><div class="col-md-1"><div class="form-group"><label class="form-control-label" >Truck loads</label><input class="form-control" name="truck['+i+'][truck_loads]" id="truck['+i+'][truck_loads]" placeholder="Truck loads" type="text"/><div class="invalid-feedback"></div></div></div>';
				
				html +='<div class="col-md-2"><div class="form-group"><label class="form-control-label">Status</label><select name="truck['+i+'][load_status]" id="truck['+i+'][load_status]" class="select2 form-control">'+selectOpt+'</select></div></div>';
				
				html +='</div>';
				$('.additional_trucks').append(html);
				$('.select2').select2();
			}
			$(".sale_date").datepicker({
				format: "mm/dd/yyyy",
				weekStart: 0,
				calendarWeeks: true,
				autoclose: true,
			});
			$(".delivery_date").datepicker({
				format: "mm/dd/yyyy",
				weekStart: 0,
				calendarWeeks: true,
				autoclose: true,
			});
		}
	});


	$('#stock_id').keyup(function(){
		$.ajax({
			type: "POST",
			url: "{{ route('admin.trading.getstock')}}",
			data: {stock_id:this.value},
			success: function (data){
				$(".stock_props").show();
				$('#stock_seller').text(data.seller_username);
				$('#stock_product').text(data.product_name);
				$('#stock_variety').text(data.variety_detail_name);
				$('#stock_size_from').text(data.packing_detail_name);
				$('#stock_size_to').text(data.size_from);
				$('#stock_packing').text(data.size_to);
				$('#stock_color').text(data.flesh_color_detail_name);
				$('#stock_location').text(data.location);
				$('#stock_postalcode').text(data.postalcode);
			}
		});
	});

	$('#payment_options').change(function(){
		var pval = (this.value).split("_");
		console.log(pval);	
		$('#payment_type').val(pval[0]);
		$('#payment_type').select2().trigger('change');
		
		$('#payment_term').val(pval[1]);
		$('#payment_term').select2().trigger('change');
		
		$('#payment_currency').val(pval[2]);
		$('#payment_currency').select2().trigger('change');
			
	});
	$( document ).ready(function() {
		//fetch_buyer($('#buyer_id').val());
	});
	function fetch_buyer(val){
	$.ajax({
		type: "POST",
		url: "{{ route('admin.trading.getbuyerpaymentpref') }}",
		data: {buyer_id:val},
		success: function (data) {
			$('#payment_options').html(data.payment_options);
			$('#payment_options').select2().trigger('change');
		}
	});
	}

	function fetch_match(val){
	$.ajax({
		type: "POST",
		url: "{{ route('admin.trading.getmatch') }}",
		data: {match_id:val},
		success: function (data) {
			$(".stock_props").show();
			$('#stock_id').val(data.stock_id);
			$('#stock_seller').text(data.seller_username);
			$('#stock_product').text(data.product_name);
			$('#stock_variety').text(data.variety_detail_name);
			$('#stock_size_from').text(data.packing_detail_name);
			$('#stock_size_to').text(data.size_from);
			$('#stock_packing').text(data.size_to);
			$('#stock_color').text(data.flesh_color_detail_name);
			$('#stock_location').text(data.location);
			$('#stock_postalcode').text(data.postalcode);		
		}
	});
	}

</script>
@endpush