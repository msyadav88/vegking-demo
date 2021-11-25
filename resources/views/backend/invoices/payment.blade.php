@extends('backend.layouts.app')
@section('title', __('menus.backend.accounts.invoices.payment') . ' #'.$invoices->id . ' :: ' . app_name())
@role('seller')
@php $route_pre = 'seller'; @endphp
@else
@php $route_pre = 'admin'; @endphp
@endif
@section('content')
    {{ html()->form('PUT', route($route_pre.'.invoices.update', $invoices->id))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('menus.backend.accounts.invoices.payment')
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="product_id">{{__('validation.attributes.backend.trading.requests.product')}} <span style="color:red">*</span></label>
                    <div class="col-md-10">
                        <select class="form-control select2" name="product_id" id="product_id" maxlength="191">
                            <option value="">{{__('validation.attributes.backend.trading.requests.select_buyer')}}</option>
                            @foreach($product_list as $product)
                            <option {{old('product_id')==$product->id?'selected':''}} value="{{ $product->id}}" @if(@$product->id == @$invoices->product_id) selected @endif>{{ $product->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="buyer_id">{{__('validation.attributes.backend.trading.requests.buyer')}} <span style="color:red">*</span></label>
                    <div class="col-md-10">
                        <select class="form-control select2" name="buyer_id" id="buyer_id" maxlength="191">
                            <option value="">{{__('validation.attributes.backend.trading.requests.select_buyer')}}</option>
                            @foreach($buyers as $buyer)
                            <option {{old('buyer_id')==$buyer->id?'selected':''}} value="{{ $buyer->id}}" @if(@$buyer->id == @$invoices->buyer_id) selected @endif>{{ $buyer->username}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="seller_id">{{__('validation.attributes.backend.trading.requests.seller')}} <span style="color:red">*</span></label>
                    <div class="col-md-10">
                        <select class="form-control select2" name="seller_id" id="seller_id" maxlength="191">
                            <option value="">{{__('validation.attributes.backend.trading.requests.select_seller')}}</option>
                            @foreach($sellers as $seller)
                            <option {{old('seller_id')==$seller->id?'selected':''}} value="{{ $seller->id}}" @if(@$seller->id == @$invoices->seller_id) selected @endif>{{ $seller->name}} ({{ $seller->username}})</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                <div class="form-group row">
                    {{ html()->label(__('Paid <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('paid') }}
                    <div class="col-md-10">
                        {{ html()->text('paid')
                                    ->class('form-control')
                                    ->placeholder('Paid')
                                    ->value(@$invoices->paid)
                                    ->attribute('maxlength', 191,'disabled', 'disabled')}}
                    </div>
                    <!--col-->
                </div>
                <div class="form-group row">
				<label class="col-md-2 form-control-label" for="request_id">Invoice Type</label>
				<div class="col-md-10">
					<label class=""><input {{@$invoices['invoice_type'] == 'Trading' ?'checked':''}}  name="invoice_type" type="radio" value="Trading" id="invoice_type" /> Trading</label>
					&nbsp;
                    <label class=""><input {{@$invoices['invoice_type'] == 'Transport' ?'checked':''}} name="invoice_type" type="radio" value="Transport" id="invoice_type" /> Transport</label>
                    &nbsp;
                    <label class=""><input {{@$invoices['invoice_type'] == 'PurchaseOrder' ?'checked':''}} name="invoice_type" type="radio" value="Purchase Order" id="invoice_type" /> Purchase Order</label>
			  </div>
            </div>
            <div class="form-group row">
                    {{ html()->label('Date <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('available_from_date') }}
                    <div class="col-md-3">
                        {{ html()->text('date')->class('datepicker form-control')->value(@$invoices->date)->placeholder('Date')->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group row">
                    {{ html()->label(__('Amount <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('amount') }}
                    <div class="col-md-10">
                        {{ html()->text('amount')
                                    ->class('form-control')
                                    ->placeholder('Amount')
                                    ->value(@$invoices->amount)
                                    ->attribute('disabled', 'disabled') 
                                    ->attribute('maxlength', 191,'disabled', 'disabled')}}
                    </div>
                    <!--col-->
                </div>
                
                <!--form-group-->
                <div class="form-group row">
                    {{ html()->label(__('Quantity <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('quantity') }}
                    <div class="col-md-10">
                        {{ html()->text('quantity')
                                    ->class('form-control')
                                    ->placeholder('Quantity')
                                    ->value(@$invoices->quantity)
                                    ->attribute('disabled', 'disabled') 
                                    ->attribute('maxlength', 191,'disabled', 'disabled')}}
                    </div>
                    <!--col-->
                </div>
                
            </div>
            </div><!--card-body-->
            </div>
            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route($route_pre.'.invoices.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
@push('after-scripts')
<style>
    .datepicker>div.datepicker-days {
        display: block !important;
    }
</style>
<script>
    $("#date").datepicker({
        format: "yyyy-mm-dd",
        weekStart: 0,
        calendarWeeks: true,
        autoclose: true,
    });
    function fetch_stockid(val){
		$.ajax({
			type: "POST",
			url: "{{ route('admin.trading.getstock')}}",
			data: {stock_id:val},
			success: function (data){
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
</script>
@endpush