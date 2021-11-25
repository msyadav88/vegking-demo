@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.subproducts.create') . ' :: ' . app_name())
@section('content')
    {{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('menus.backend.trading.subproducts.create')
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('Product <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('product_id') }}
                            <div class="col-md-10">
                                {{ html()->select('product_id')
                                    ->class('select2 form-control')
                                    ->options($product_list)
                                    ->attribute('maxlength', 191)
                                    ->attribute('placeholder', 'Select Product')
                                }}
                                <div class="invalid-feedback"></div>
                            </div>
                            <!--col-->
                        </div>
                        <div class="form-group row">
                        {{ html()->label(__('Sub Product Name (EN) <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('sub_pro_name_en') }}
                            <div class="col-md-10">
                                {{ html()->text('sub_pro_name_en')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.products.sub_name'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('Sub Product Name (PL)<span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('sub_pro_name_pl') }}
                            <div class="col-md-10">
                                {{ html()->text('sub_pro_name_pl')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.products.sub_name'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('Sub Product Name (DE)<span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('sub_pro_name_de') }}
                            <div class="col-md-10">
                                {{ html()->text('sub_pro_name_de')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.products.sub_name'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Sub Product Image <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('image') }}
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="input-group input-file" name="image" id="image">
                                        <span class="input-group-prepend">
                                            <button class="btn btn-info btn-choose" type="button">Choose</button>
                                        </span>
                                        <input type="text" class="form-control" placeholder='Choose a file...' />
                                        <span class="input-group-append">
                                            <button class="btn btn-danger btn-reset" type="button">Reset</button>
                                        </span>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            {{ html()->label(__('Sub Product Type <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('sub_pro_type') }}
                            <div class="col-md-10">
                                {{ html()->select('sub_pro_type')
                                    ->class('select2 form-control')
                                    ->options($sub_pro_type_list)
                                    ->attribute('maxlength', 191)
                                    ->attribute('placeholder', 'Select Product Type')
                                }}
                                <div class="invalid-feedback"></div>
                            </div>
                            <!--col-->
                        </div>

                        <div class="form-group row">
                            {{ html()->label('Status')->class('col-md-2 form-control-label')->for('status') }}
                            <div class="col-md-10">
                                <div class="checkbox d-flex align-items-center">
                                    {{ html()->label(
                                        html()->checkbox('status',  1, '1')
                                        ->class('switch-input pref_check')
                                        ->id('status')
                                        . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
                                        ->class('switch switch-label switch-pill switch-success mr-2')
                                        ->for('status') 
                                    }}
                                </div>
                            </div>
                        </div>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.subproducts.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
    @php 
        $url = route('admin.subproducts.store'); 
        $redirect_url = route('admin.subproducts.index');
    @endphp
@endsection
@push('after-scripts')
<script type="text/javascript">
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
<style type="text/css">
    .is-invalid .invalid-feedback{
        display: block !important;
    }
</style>
@endpush