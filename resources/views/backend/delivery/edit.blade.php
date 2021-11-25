@extends('backend.layouts.app')
@section('title', __('Delivery Edit') . ' :: ' . app_name())
@section('content')
@if(auth()->user()->hasRole('trader') && Request::segment(1) == 'trader')
    @php $route_pre = 'trader'; @endphp
@else
    @php $route_pre = 'admin'; @endphp
@endif
    {{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('Deliveries Edit') 
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
       
                <div class="row mt-4 mb-4">
                    <div class="col">
                       <!--form-group-->
         @foreach($data as $d)
         @php  $delivery_date=date('Y-m-d', strtotime("-4 day", strtotime($d->trucks->delivery_date))) ;
         $pickupdate=date('Y-m-d', strtotime("-4 day", strtotime($d->trucks->delivery_date)));
        
         if($d->productspecvalue != Null)
        {
            $varity=$d->productspecvalue->value;
        } else { 
            $varity= "";
        }
         @endphp
              {{ html()->text('main_id')
              ->class('form-control')
              ->value($d->id)
              ->placeholder(__('validation.attributes.backend.trading.products.name'))
              ->attribute('style','display:none')
              ->attribute('maxlength', 191)}}

                {{ html()->text('trucks_id')
                ->class('form-control')
                ->value($d->trucks->sale_id)
                ->placeholder(__('validation.attributes.backend.trading.products.name'))
                ->attribute('style','display:none')
                ->attribute('maxlength', 191)}}

{{ html()->text('transport_id')
->class('form-control')
->value($d->transport_id)
->placeholder(__('validation.attributes.backend.trading.products.name'))
->attribute('maxlength', 191)
->attribute('style','display:none')

}}


                        <div class="form-group row">
                            {{ html()->label(__('Delivery Date<span style="color:red">*</span>'))->class('col-md-2 form-control-label') }}
                            <div class="col-md-10">
                                {{ html()->text('delivery_date')
                                    ->class('form-control')
                                    ->value($delivery_date)
                                    ->placeholder(__('validation.attributes.backend.trading.products.name'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->
                       
                        <div class="form-group row">
                            {{ html()->label(__('Variety<span style="color:red">*</span>'))->class('col-md-2 form-control-label') }}
                            <div class="col-md-10">
                                {{ html()->text('variety')
                                    ->class('form-control')
                                    ->value($varity)
                                    ->placeholder(__('Variety'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('Loaded Weight<span style="color:red">*</span>'))->class('col-md-2 form-control-label') }}
                            <div class="col-md-10">
                                {{ html()->text('loaded_weight')
                                    ->class('form-control')
                                    ->value(@$d->loaded_weight)
                                    ->placeholder('Loaded Weight')
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('Unloaded Weight<span style="color:red">*</span>'))->class('col-md-2 form-control-label') }}
                            <div class="col-md-10">
                                {{ html()->text('unloaded_weight')
                                    ->class('form-control')
                                    ->value(@$d->unloaded_weight)
                                    ->placeholder('Unloaded Weight')
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('Packaging Type <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('name_pl') }}
                           
                                <div class="col-md-10">
                                    {{ html()->text('packagin_type')
                                        ->class('form-control')
                                        ->value(@$d->packaging_type)
                                        ->placeholder('Packaging Type')
                                        ->attribute('maxlength', 191)}}
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="invalid-feedback"></div>
                           <!--col-->
                        </div>
                      
                        <div class="form-group row">
                            {{ html()->label(__('Number Of Packing <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('name_de') }}
                            <div class="col-md-10">
                                {{ html()->text('number_of_packing')
                                    ->class('form-control')
                                    ->value(@$d->number_of_packing_units)
                                    ->placeholder('Number Of Packing')
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        
                        <div class="form-group row">
                            {{ html()->label(__('Packup Date<span style="color:red">*</span>'))->class('col-md-2 form-control-label') }}
                            <div class="col-md-10">
                                {{ html()->text('packing_date')
                                    ->class('form-control')
                                    ->value($pickupdate)
                                    ->id('packupdate')
                                    ->placeholder('Packup Date')
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        
                        <div class="form-group row">
                            {{ html()->label(__('Delivery Address<span style="color:red">*</span>'))->class('col-md-2 form-control-label') }}
                            <div class="col-md-10">
                                {{ html()->text('delivery_address')
                                    ->class('form-control')
                                    ->value($d->trucks->delivery_location)
                                    ->placeholder(__('Delivery Address'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                        {{ html()->label(__('Truck Plates<span style="color:red">*</span>'))->class('col-md-2 form-control-label') }}
                            <div class="col-md-10">
                                {{ html()->text('truck_plates')
                                    ->class('form-control')
                                    ->value($d->transportdata->plate_numbers)
                                    ->placeholder(__('Truck Plates'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('Container Id<span style="color:red">*</span>'))->class('col-md-2 form-control-label') }}
                                <div class="col-md-10">
                                    {{ html()->text('Container_id')
                                        ->class('form-control')
                                        ->value($d->transportdata->carrier)
                                        ->placeholder(__('Container id'))
                                        ->attribute('maxlength', 191)}}
                                    <div class="invalid-feedback"></div>
                                </div><!--col-->
                            </div>
                            <div class="form-group row">
                                {{ html()->label(__('Transport Id<span style="color:red">*</span>'))->class('col-md-2 form-control-label') }}
                                    <div class="col-md-10">
                                        {{ html()->text('transport_id')
                                            ->class('form-control')
                                            ->value($d->transport_id)
                                            ->placeholder(__('Transport Id'))
                                            ->attribute('maxlength', 191)}}
                                        <div class="invalid-feedback"></div>
                                    </div><!--col-->
                                </div>
                                @endforeach
           </div><!--row-->
                </div><!--card-body-->

                <div class="card-footer clearfix">
                    <div class="row">
                        <div class="col">
                        {{ form_cancel(url()->previous(), __('buttons.general.cancel')) }}
                            </div><!--col-->

                        <div class="col text-right">
                            {{ form_submit(__('buttons.general.crud.update')) }}
                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-footer-->
            </div><!--card-->
        </div>
    {{ html()->form()->close() }}
    @php 
        $url = route($route_pre.'.deliveries.update'); 
        $redirect_url = route($route_pre.'.deliveries.index');
    @endphp
@endsection
@push('after-scripts')
<script type="text/javascript">
	$("#name_pl").datepicker({
		format: "mm/dd/yyyy",
		weekStart: 0,
		calendarWeeks: true,
		autoclose: true,
	});

	$("#packupdate").datepicker({
		format: "mm/dd/yyyy",
		weekStart: 0,
		calendarWeeks: true,
		autoclose: true,
	});

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#formsubmit').on('submit', function(event) {
        event.preventDefault();

        $('.has-danger').next().children().children().css({
            "border": ""
        });

        $('.is-invalid').removeClass("is-invalid");
        $('.invalid-feedback').html("");
        $('.has-danger').removeClass("has-danger");

        var formData = new FormData($(this)[0]);

        $( ".pref_check" ).each(function( key, value ) {
            if(value.value == 0){
                formData.append(value.name, value.value);
            }
        });
        formData.append('_method', 'POST');
        
        $.ajax({
            url: "{{ $url }}",
            method: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                $('.loading').removeClass('loading_hide');
            },
            success: function(data) {
                if (data.status == 'success') {
                    $('.loading').addClass('loading_hide');
                    Swal.fire('Sent!', data.message, 'success');
                    setTimeout(function() {
                        window.location.href = "{{ $redirect_url }}";
                    }, 500);
                }
                if (data.status == 'error') {
                    $('.loading').addClass('loading_hide');
                    Swal.fire('Error!', data.message, 'error');
                }
            },
            error: function(data) {
                if (data.status === 422) {
                    $('.loading').addClass('loading_hide');
                    Swal.fire('Error!', data.responseJSON.message, 'error');
                    $('.btn-success').removeAttr('disabled');
                    var errors = [];
                    errors = data.responseJSON.errors
                    $.each(errors, function(key, value) {
                        $('#' + key).parent().addClass('has-danger');
                        $('#' + key).addClass('is-invalid');
                        $('#' + key).parent('.has-danger').find('.invalid-feedback').html(value);
                        $('#' + key).next().children().children().css({
                            "border": "1px solid #f86c6b"
                        });
                    })
                }
            }
        });
    });

    $('body').on('click', '.pref_check', function(){
        if(this.checked){
            $(this).val(1);
            $(this).attr('checked','checked');
        }else{
            $(this).val(0);
            $(this).removeAttr('checked');
        }
    })
    $('body').on('click', '.type_check', function(){
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