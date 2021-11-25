@extends('backend.layouts.app')
@section('title', __('menus.backend.accounts.purchaseorder.create') . ' :: ' . app_name())
@role('seller')
@php $route_pre = 'seller'; @endphp
@else
@php $route_pre = 'admin'; @endphp
@endif
@section('content')
{{ html()->form('POST')->id('form_purchase_order_submit')->class('form-horizontal')->open() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('menus.backend.accounts.purchaseorder.create')
                    <small class="text-muted"></small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="request_id">Stock ID <span style="color:red">*</span></label>
                    <div class="col-md-10">

                        {{ html()->select('stock_id')
					->class('select2 form-control')
					->options($stockid)
					->attribute('maxlength', 191)
					->attribute('onchange', 'fetch_stockid(this.value);')
					->placeholder('Choose Stock ID')
				  }}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group row">
                    {{ html()->label('Buyer <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('Buyer') }}
                    <div class="col-md-10">
                        {{ html()->select('buyer_id')
					->class('select2 form-control')
					->options($buyers)
					->attribute('maxlength', 191)
					->attribute('onchange', 'fetch_buyer(this.value);')
					->placeholder('Choose Buyer')
				  }}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
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
                    </div>
                    <!--col-->
                </div>
                <div class="form-group row">
                    {{ html()->label(__('Price <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('price') }}
                    <div class="col-md-10">
                        {{ html()->text('price')
                                    ->class('form-control')
                                    ->placeholder('Price')
                                    ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label('Delivery Date <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('available_from_date') }}
                    <div class="col-md-3">
                        {{ html()->text('delivery_date')->class('datepicker form-control')->value(@$stock->available_from_date)->placeholder('Delivery Date')->attribute('maxlength', 191) }}
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->

    <div class="card-footer clearfix">
        <div class="row">
            <div class="col">
                {{ form_cancel(route($route_pre.'.purchaseorder.index'), __('buttons.general.cancel')) }}
            </div>
            <!--col-->

            <div class="col text-right">
                {{ form_submit(__('buttons.general.crud.create')) }}
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-footer-->
</div>
<!--card-->
{{ html()->form()->close() }}
@endsection

@push('after-scripts')
<style>
    .datepicker>div.datepicker-days {
        display: block !important;
    }
</style>
<script>
    $("#delivery_date").datepicker({
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
 <script type="text/javascript">
    $(document).ready(function() {
    $('#form_purchase_order_submit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route($route_pre.'.purchaseorder.store') }}",
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
              window.location.href = "{{ route($route_pre.'.purchaseorder.index') }}";
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