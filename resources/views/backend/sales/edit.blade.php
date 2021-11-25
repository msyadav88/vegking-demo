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
			  {{ html()->label('Buyer <span style="color:red">*</span> ')->class('col-md-1 form-control-label')->for('Buyer') }}
				<div class="col-md-5">
				{{ html()->select('buyer_id')
					->class('select2 form-control buyer_id')
					->options($buyers)
					->attribute('maxlength', 191)
					->attribute('onchange', 'fetch_buyer(this.value);')
					->value($sale->buyer_id)
					->placeholder('Choose Buyer')
				  }}
				  <div class="invalid-feedback"></div>
				  
				</div>
				<label class="col-md-1 form-control-label" for="match_id">Match <span style="color:red">*</span></label>
				<div class="col-md-5">
					<input class="form-control match_id" name="match_id" value="{{$sale->match_id}}" onkeyup="fetch_match(this.value);" id="match_id" type="text"/>
					<div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="form-group row">
			<label class="col-md-1 form-control-label" for="request_id">Stock ID <span style="color:red">*</span></label>
				<div class="col-md-5">
				{{ html()->select('stock_id')
					->class('select2 form-control stock_id')
					->options($stockid)
					->value(@$sale->stock_id)
					->attribute('maxlength', 191)
					->attribute('onchange', 'fetch_stockid(this.value);')
					->placeholder('Choose Stock ID')
				  }}
					<div class="invalid-feedback"></div> 
					<div class="form-group row stock_props"  style="display:none;">
						<div class="col-md-12 stock_props_inner">
						</div>
					</div>
				</div>
				<div class="col-md-2">
				</div>
				</div>
				<div class="form-group row">
				<label class="col-md-1 form-control-label" for="request_id">Number of Delivery <span style="color:red">*</span></label>
				<div class="col-md-11">
					<input class="form-control quantity" name="quantity" value="{{$sale->quantity}}" id="quantity" type="text" type="number"/>
					<input class="form-control invisible" value="{{$sale->quantity}}" id="quantity_old" type="text" type="number"/>
					<div class="invalid-feedback"></div>
					<span class="quantity_error"></span>
				</div>
			</div>

			@php $dkey = 1; @endphp
			@foreach($saledelivery as $deliveryset)
			<div class="delivery_main" id="deld{{$dkey}}" data-id="{{$dkey}}">
			<div class="form-group row">
				<label class="col-md-2 form-control-label" for=""><strong>Delivery {{$dkey}} <span style="color:red">*</span></strong> </label>
				
				<div class="col-md-2">
					<div class="form-group">
					  	<label class="form-control-label" for="">Delivery Date <span style="color:red">*</span></label>
 
						<input data-id="1" class="form-control delivery_date deldate delsdat truck {{$dkey}}" name="truck[{{$dkey}}][delivery_date]" id="truck_1_delivery_date" value="{{date('m/d/Y',strtotime($deliveryset->deliverymain))}}" placeholder="Delivery Date" type="text"/>
 						 
						<div class="invalid-feedback"></div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
					  	<label class="form-control-label" for="">Number of loads <span style="color:red">*</span></label>
						<input class="form-control truck {{$dkey}} number_of_loads" data-key="{{$dkey}}" id="truck[{{$dkey}}][number_of_loads]" name="truck[{{$dkey}}][number_of_loads]" value="{{$deliveryset->loadcount}}" placeholder="Number of loads" type="text"/>
						<input class="form-control hidden invisible {{$dkey}} number_of_loads_old_{{$dkey}}"  value="{{$deliveryset->loadcount}}" placeholder="Number of loads" type="text"/>
						<div class="invalid-feedback"></div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				@php $tNumber= 1 @endphp
				@foreach($saleTrucks as $key => $truck)
				@if($truck->deliveryid == $deliveryset->id)
					
						<label class="col-md-2 form-control-label" for=""><strong>Loads {{$tNumber}}</strong> </label>
						<div class="col-md-1">
						<div class="form-group">
							<label class="form-control-label" for="">Price <span style="color:red">*</span></label>
							<input class="form-control truck {{$dkey}} {{$tNumber}} price" name="truck[{{$dkey}}][{{$tNumber}}][price]" id="truck[{{$dkey}}][{{$tNumber}}][price]" value="{{$truck->price}}" placeholder="Price" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="form-control-label" for="">Sale Date <span style="color:red">*</span></label>
							<input class="form-control sale_date truck {{$dkey}} {{$tNumber}} sale_date" name="truck[{{$dkey}}][{{$tNumber}}][sale_date]" id="truck[{{$dkey}}][{{$tNumber}}][sale_date]" value="{{date('m/d/Y',strtotime($truck->sale_date))}}" autocomplete="off" placeholder="Sale Date" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="form-control-label" >Delivery Location <span style="color:red">*</span></label>
							<input class="form-control truck {{$dkey}} {{$tNumber}} delivery_location" name="truck[{{$dkey}}][{{$tNumber}}][delivery_location]" id="truck[{{$dkey}}][{{$tNumber}}][delivery_location]" value="{{$truck->delivery_location}}" autocomplete="off"  placeholder="Delivery Location" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label class="form-control-label" for="">Delivery Date <span style="color:red">*</span></label>
							<input class="form-control delivery_date truck {{$dkey}} {{$tNumber}} delivery_date" name="truck[{{$dkey}}][{{$tNumber}}][delivery_date]" id="truck[{{$dkey}}][{{$tNumber}}][delivery_date]" value="{{date('m/d/Y',strtotime($truck->delivery_date))}}" placeholder="Delivery Date" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group">
							<label class="form-control-label" >Truck loads <span style="color:red">*</span></label>
							<input class="form-control truck {{$dkey}} {{$tNumber}} truck_loads" name="truck[{{$dkey}}][{{$tNumber}}][truck_loads]" id="truck[{{$dkey}}][{{$tNumber}}][truck_loads]" value="{{$truck->truck_loads}}" placeholder="Truck loads" type="text"/>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					
					<div class="col-md-2">
					<div class="form-group">
						<label class="form-control-label">Status <span style="color:red">*</span></label>
						<select name="truck[{{$dkey}}][{{$tNumber}}][load_status]" id="truck[{{$truck->id}}][load_status]" class="select2 form-control truck {{$dkey}} {{$truck->id}} load_status">
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
					
				@php $tNumber++; @endphp
				@endif
				
				@endforeach
					
			</div>
			<div class="loads_main"></div>
			</div>
			
			@php $dkey++; @endphp
			@endforeach
			<div class="additional_trucks">
			</div>
			
			<div class="form-group row">
			<label class="col-md-1 form-control-label" for="request_id">Payment Prefs</label>
				<div class="col-md-5">
					<select class="select2 form-control" name="payment_options" id="payment_options" maxlength="191">
						<option value="">Select Option</option>
					</select>
					<div class="invalid-feedback"></div>
				</div>
				{{ html()->label('Payment Term <span style="color:red">*</span>')->class('col-md-1 form-control-label')->for('Payment Term') }}
				<div class="col-md-5">
				{{ html()->select('payment_term')
					->class('select2 form-control payment_term')
					->options($payment_terms)
					->attribute('maxlength', 191)
					->value($sale->payment_term)
					->placeholder('Choose Payment Term')
				  }}
				  <div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="form-group row">
			<label class="col-md-1 form-control-label" for="match_id">Defect Percentage <span style="color:red">*</span></label>
				<div class="col-md-5">
					<input class="form-control" name="defect_percentage" id="defect_percentage" value="{{$sale->defect_percentage}}" placeholder="eg +50% or -50%" type="text"/>
					<div class="invalid-feedback"></div>
				</div>
				{{ html()->label('Payment Type <span style="color:red">*</span>')->class('col-md-1 form-control-label')->for('Payment Type') }}
				<div class="col-md-5">
				{{ html()->select('payment_type')
					->class('select2 form-control payment_type')
					->options($payment_types)
					->attribute('maxlength', 191)
					->value($sale->payment_type)
					->placeholder('Choose Payment Type')
				  }}
				  <div class="invalid-feedback"></div>
				</div>
			</div>
			<div class="form-group row">
			{{ html()->label('Payment Currency <span style="color:red">*</span>')->class('col-md-1 form-control-label')->for('Payment Currency') }}
				<div class="col-md-5">
				{{ html()->select('payment_currency')
					->class('select2 form-control payment_currency')
					->options($currencyIds)
					->attribute('maxlength', 191)
					->value($sale->payment_currency)
					->placeholder('Choose Payment Currency')
				  }}
					<div class="invalid-feedback"></div>
				</div>
				<label class="col-md-1 form-control-label" for="request_id">Status <span style="color:red">*</span></label>
				<div class="col-md-5 produttype">
					@if($sale->status == 'ordered')    
						@php $active = '1' @endphp
					@else
						@php $active = '0' @endphp
					@endif
					{{ html()->label(
						html()->checkbox('status', $active, 'Ordered')
						->class('switch-input status')
						->id('required_type')
						. '<span class="switch-slider" data-checked="Ordered" data-unchecked="Confirmed"></span>')
						->class('switch switch-label switch-pill switch-success mr-2')
						->for('required_type') 
					}}
				  <div class="invalid-feedback"></div>
				</div>
			</div>
			
			<!-- <div class="form-group row">
				
				<div class="col-md-10">
					<label class="radio-inline"><input  name="status" {{$sale->status == 'ordered'?'checked':''}} type="radio" value="ordered" id="delivery_date_paid" /> Ordered</label>
					&nbsp;
					<label class="radio-inline"><input  name="status" {{$sale->status == 'confirmed'?'checked':''}} type="radio" value="confirmed" id="delivery_date_unpaid" /> Confirmed</label>
			  </div>
            </div>            -->
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
.quantity_error{color:red;}
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
						$('.'+key).parent().addClass('has-danger');
						$('.'+key).addClass('is-invalid');
						$('.'+key).parent('.has-danger').find('.invalid-feedback').html(value);
						$('.'+key).next().children().children().css({"border": "1px solid #f86c6b"});
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

	function number_loads()
	{
		
		$('.number_of_loads').keyup(function(){
			var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
			var data_key = $(this).attr('data-key');
			var number_of_loads_old = $('.number_of_loads_old_'+data_key).val();
			var total_loads = this.value - number_of_loads_old;
            today = mm + '/' + dd + '/' + yyyy;
			number_loads = this.value;
			var qty_counter = $(this).parents('.delivery_main').attr('data-id');
			$(this).parents('.delivery_main').find('.loads_main').html('');
			for(var i=1;i<=total_loads;i++){
				var total_load = parseInt(number_of_loads_old)+i;
				var html = '<div class="form-group row"> <label class="col-md-2 form-control-label" for=""><strong>Loads '+total_load+'</strong> </label> <div class="col-md-1"> <div class="form-group"> <label class="form-control-label" for="">Price <span style="color:red">*</span></label> <input class="form-control truck '+qty_counter+' '+total_load+' price " name="truck['+qty_counter+']['+total_load+'][price]" placeholder="Price" type="text"/><div class="invalid-feedback"></div></div></div><div class="col-md-2"> <div class="form-group"> <label class="form-control-label" for="">Sale Date <span style="color:red">*</span></label><input type="text" class="form-control sale_date truck '+qty_counter+' '+total_load+' sale_date " value="'+today+'" name="truck['+qty_counter+']['+total_load+'][sale_date]" id="truck_'+qty_counter+'_'+total_load+'_sale_date" autocomplete="off" placeholder="Sale Date" type="text"/><div class="invalid-feedback"></div></div></div><div class="col-md-2"><div class="form-group"><label class="form-control-label" >Delivery Location <span style="color:red">*</span></label><input class="form-control truck '+qty_counter+' '+total_load+' delivery_location " name="truck['+qty_counter+']['+total_load+'][delivery_location]" id="truck['+qty_counter+']['+total_load+'][delivery_location]" placeholder="Delivery Location" type="text"/><div class="invalid-feedback"></div></div></div><div class="col-md-2"> <div class="form-group"><label class="form-control-label" for="">Delivery Date <span style="color:red">*</span></label><input class="form-control delivery_date childdate commondt truck '+qty_counter+' '+total_load+' delivery_date" data-id="'+total_load+'" name="truck['+qty_counter+']['+total_load+'][delivery_date]"  id="truck_'+qty_counter+'_'+total_load+'_delivery_date" placeholder="Delivery Date" type="text"/><div class="invalid-feedback"></div></div></div><div class="col-md-1"><div class="form-group"><label class="form-control-label" >Truck loads <span style="color:red">*</span></label><input class="form-control truck '+qty_counter+' '+total_load+' truck_loads " name="truck['+qty_counter+']['+total_load+'][truck_loads]" id="truck['+qty_counter+']['+total_load+'][truck_loads]" placeholder="Truck loads" type="text"/><div class="invalid-feedback"></div></div></div>';
 
					
					html +='<div class="col-md-2"><div class="form-group"><label class="form-control-label">Status</label><select name="truck['+qty_counter+']['+total_load+'][load_status]" id="truck['+qty_counter+']['+total_load+'][load_status]" class="select2 form-control">'+selectOpt+'</select></div></div>';
					
					html +='</div>';
					//qty_counter++;
				$(this).parents('.delivery_main').find('.loads_main').append(html);
				$('.select2').select2();
				$("#truck_"+qty_counter+"_"+total_load+"_sale_date").datepicker({
					format: "mm/dd/yyyy",
					weekStart: 0,
					calendarWeeks: true,
					autoclose: true,
				}).datepicker("update", $(this).parents('.delivery_main').find('.deldate').val()); 
				$("#truck_"+qty_counter+"_"+total_load+"_delivery_date").datepicker({
					format: "mm/dd/yyyy",
					weekStart: 0,
					calendarWeeks: true,
					autoclose: true,
				}).datepicker("update", $(this).parents('.delivery_main').find('.deldate').val());
			}
		});
	}
	
	$('#quantity').keyup(function(){
		var quantity_old = $('#quantity_old').val();
		var total_loads = this.value - quantity_old;
		quantity = this.value;
		if(quantity > 10){
			$(".quantity_error").html('Quantity should not be greater than 10.');
			$('.additional_trucks').html('');
			$('.loads_main').html('');
		} else {
			
			$(".quantity_error").html('');
			 $('.additional_trucks').html('');
			$('.loads_main').html('');
			for(var i=1;i<=total_loads;i++){
				var total_load = parseInt(quantity_old)+i;
				//var html = '<div class="form-group row"> <label class="col-md-2 form-control-label" for=""><strong>Delivery'+i+'</strong> </label> <div class="col-md-1"> <div class="form-group"> <label class="form-control-label" for="">Price</label> <input class="form-control" name="truck['+i+'][price]" placeholder="Price" type="text"/></div></div><div class="col-md-2"> <div class="form-group"> <label class="form-control-label" for="">Sale Date</label><input class="form-control sale_date" name="truck['+i+'][sale_date]" autocomplete="off" placeholder="Sale Date" type="text"/></div></div><div class="col-md-2"><div class="form-group"><label class="form-control-label" >Delivery Location</label><input class="form-control" name="truck['+i+'][delivery_location]" id="truck['+i+'][delivery_location]" placeholder="Delivery Location" type="text"/><div class="invalid-feedback"></div></div></div><div class="col-md-2"> <div class="form-group"><label class="form-control-label" for="">Delivery Date</label><input class="form-control delivery_date" name="truck['+i+'][delivery_date]" placeholder="Delivery Date" type="text"/></div></div><div class="col-md-1"><div class="form-group"><label class="form-control-label" >Truck loads</label><input class="form-control" name="truck['+i+'][truck_loads]" id="truck['+i+'][truck_loads]" placeholder="Truck loads" type="text"/><div class="invalid-feedback"></div></div></div>';
				
				//html +='<div class="col-md-2"><div class="form-group"><label class="form-control-label">Status</label><select name="truck['+i+'][load_status]" id="truck['+i+'][load_status]" class="select2 form-control">'+selectOpt+'</select></div></div>';
				
				//html +='</div>';
				
				var html = '<div class="delivery_main" id="deld'+total_load+'" data-id='+total_load+'><div class="form-group row"> <label class="col-md-2 form-control-label" for=""><strong>Delivery '+total_load+'</strong> </label>'+ 
				'<div class="col-md-2">'+
					'<div class="form-group">'+
					  	'<label class="form-control-label" for="">Delivery Date <span style="color:red">*</span></label>'+
 
						'<input data-id="'+total_load+'" class="form-control delivery_date delsdat childdate'+total_load+' truck '+total_load+' delivery_date" name="truck['+total_load+'][delivery_date]" id="truck['+total_load+'][delivery_date]" autocomplete="off" placeholder="Delivery Date" type="text"/>'+
 
						'<div class="invalid-feedback"></div>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-2">'+
					'<div class="form-group">'+
					  	'<label class="form-control-label" for="">Number of loads <span style="color:red">*</span></label>'+
						'<input class="form-control number_of_loads truck '+total_load+' number_of_loads" id="truck['+total_load+'][number_of_loads]" name="truck['+total_load+'][number_of_loads]" autocomplete="off" placeholder="Number of loads" type="text"/>'+
						'<div class="invalid-feedback"></div>'+
					'</div>'+
				'</div></div><div class="loads_main"></div></div>';
				
				$('.additional_trucks').append(html);
				
			}
			
			$('.number_of_loads').keyup(function(){
				number_loads = this.value;
				var qty_counter = $(this).parents('.delivery_main').attr('data-id');
				var delivery_date = $(this).parents('.delivery_main').find('#truck_'+qty_counter+'_delivery_date').val();
				
				$(this).parents('.delivery_main').find('.loads_main').html('');
				for(var i=1;i<=number_loads;i++){
 
					var html = '<div class="form-group row"> <label class="col-md-2 form-control-label" for=""><strong>Loads '+i+'</strong> </label> <div class="col-md-1"> <div class="form-group"> <label class="form-control-label" for="">Price <span style="color:red">*</span></label> <input class="form-control truck '+qty_counter+' '+i+' price " name="truck['+qty_counter+']['+i+'][price]" placeholder="Price" type="text"/><div class="invalid-feedback"></div></div></div><div class="col-md-2"> <div class="form-group"> <label class="form-control-label" for="">Sale Date</label><input class="form-control sale_date truck '+qty_counter+' '+i+' sale_date " name="truck['+qty_counter+']['+i+'][sale_date]" id="truck_'+qty_counter+'_'+i+'_sale_date" autocomplete="off"  value="" type="text"/></div></div><div class="col-md-2"><div class="form-group"><label class="form-control-label" >Delivery Location</label><input class="form-control truck '+qty_counter+' '+i+' delivery_location " name="truck['+qty_counter+']['+i+'][delivery_location]" id="truck['+qty_counter+']['+i+'][delivery_location]" placeholder="Delivery Location" type="text"/><div class="invalid-feedback"></div></div></div><div class="col-md-2"> <div class="form-group"><label class="form-control-label" for="">Delivery Date</label><input class="form-control delivery_date commondt truck '+qty_counter+' '+i+' delivery_date " name="truck['+qty_counter+']['+i+'][delivery_date]" id="truck_'+qty_counter+'_'+i+'_delivery_date" placeholder="Delivery Date" type="text"/><div class="invalid-feedback"></div></div></div><div class="col-md-1"><div class="form-group"><label class="form-control-label" >Truck loads</label><input class="form-control truck '+qty_counter+' '+i+' truck_loads " name="truck['+qty_counter+']['+i+'][truck_loads]" id="truck['+qty_counter+']['+i+'][truck_loads]" placeholder="Truck loads" type="text"/><div class="invalid-feedback"></div></div></div>';
 
					
					html +='<div class="col-md-2"><div class="form-group"><label class="form-control-label">Status</label><select name="truck['+qty_counter+']['+i+'][load_status]" id="truck['+qty_counter+']['+i+'][load_status]" class="select2 form-control">'+selectOpt+'</select></div></div>';
					
					html +='</div>';
					//qty_counter++;
					$(this).parents('.delivery_main').find('.loads_main').append(html);
					$('.select2').select2();
					
					$("#truck_"+qty_counter+"_"+i+"_delivery_date").datepicker({
						format: "mm/dd/yyyy",
						weekStart: 0,
						calendarWeeks: true,
						autoclose: true,
					}).datepicker("update", delivery_date);
				}
				
				$(".sale_date").datepicker({
					format: "mm/dd/yyyy",
					weekStart: 0,
					calendarWeeks: true,
					autoclose: true,
				}).datepicker("setDate", new Date());

				$(".delivery_date").datepicker({
					format: "mm/dd/yyyy",
					weekStart: 0,
					calendarWeeks: true,
					autoclose: true,
				});
				
		 		
	delchange();
				
			});
			
			$(".sale_date").datepicker({
				format: "mm/dd/yyyy",
				weekStart: 0,
				calendarWeeks: true,
				setDate: new Date(),
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

	number_loads();
	delchange();

	function delchange(){
	/*$('.deldate').change(function(){
		//alert($(this).val());
		$('.childdate').val($(this).val());
	});*/
	 
		$('.delsdat').change(function(){
			 var nmid = $(this).data("id");
			 
		//$('.commondt').val($(this).val());
		 $('.delsdat').parents('#deld'+nmid).find('.commondt').val($(this).val());
		});
		 
	 
	}

	// $('#stock_id').keyup(function(){
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "{{ route('admin.trading.getstock')}}",
	// 		data: {stock_id:this.value},
	// 		success: function (data){
	// 			$(".stock_props").show();
	// 			$('#stock_seller').text(data.seller_username);
	// 			$('#stock_product').text(data.product_name);
	// 			$('#stock_variety').text(data.variety_detail_name);
	// 			$('#stock_size_from').text(data.packing_detail_name);
	// 			$('#stock_size_to').text(data.size_from);
	// 			$('#stock_packing').text(data.size_to);
	// 			$('#stock_color').text(data.flesh_color_detail_name);
	// 			$('#stock_location').text(data.location);
	// 			$('#stock_postalcode').text(data.postalcode);
	// 		}
	// 	});
	// });
	function fetch_stockid(val){
		$.ajax({
			type: "POST",
			url: "{{ route('admin.trading.getstock')}}",
			data: {stock_id:val},
			success: function (data){
				console.log("data",data);
				
                $(".stock_props_inner").html('');
				if(data!='')
				{
					$.each(data,function(name,value){
					   $(".stock_props_inner").append('<label>'+name+': <span>'+value+'</span></label><br/>');
						 console.log(name);
					});
					$(".stock_props").show();
					console.log(data);
				}
				else{
					alert('Stock ID not found');
					$(this).focus();
				}
			}
		});
	}

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