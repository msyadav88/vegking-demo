@extends('backend.layouts.app')

@if(!empty(@$productspec->id))
    @section('title', __('menus.backend.trading.productspecs.edit') . ' :: ' . app_name())
@else
    @section('title', __('menus.backend.trading.productspecs.create') . ' :: ' . app_name())
@endif

@section('content')

{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @if(!empty($productspec->id))
                        @lang('menus.backend.trading.productspecs.edit')
                    @else
                        @lang('menus.backend.trading.productspecs.create')
                    @endif
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
                    {{ html()->label(__('Product <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('product_id') }}
                    <div class="col-md-10">
                        {{ html()->select('product_id')
                            ->class('select2 form-control')
                            ->options($product_list)
                            ->value(@$productspec->product_id)
                            ->attribute('maxlength', 191)
                            ->attribute('placeholder', 'Select Product')
                        }}
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div id="parent">
                    <div class="form-group row">
                        {{ html()->label(__('Parent'))->class('col-md-2 form-control-label')->for('desc') }}
                        <div class="col-md-10">
                            {{ html()->select('parent_id')
                                ->class('select2 form-control')
                                ->options($productSpecRel)
                                ->value(@$productspec->parent_id)
                                ->attribute('maxlength', 191)
                                ->placeholder(__('Select Parent'))
                            }}
                        </div>
                    </div>
                </div>

                <div class="reference-items">
                </div>
                
                
                 <div class="form-group row">
                    {{ html()->label(__('Type Name <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('type_name') }}
                    <div class="col-md-10">
                        {{ html()->text('type_name')
                            ->class('form-control')
                            ->value(@$productspec->type_name)
                            ->attribute('maxlength', 191)
                        }}
                        <div class="feedback">There is three default types name are Variety, Quality and Packing.</div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                
                <div class="form-group row">
                    {{ html()->label(__('Display Name <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('display_name') }}
                    <div class="col-md-10">
                        {{ html()->text('display_name')
                            ->class('form-control')
                            ->value(@$productspec->display_name)
                            ->attribute('maxlength', 191)
                        }}
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('Importance'))->class('col-md-2 form-control-label')->for('importance') }}
                    <div class="col-md-2">
                        {{ html()->number('importance')
                            ->class('form-control')
                            ->value(@$productspec->importance)
                            ->attribute('maxlength', 191)
                        }}
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                
                <div id="field_type">
                    <div class="form-group row">
                        {{ html()->label(__('Field Type'))->class('col-md-2 form-control-label')->for('desc') }}
                        <div class="col-md-10">
                            {{ html()->select('field_type')
                                ->class('select2 form-control')
                                ->options($field_types)
                                ->value(@$productspec->field_type)
                                ->attribute('maxlength', 191)
                                ->placeholder(__('Select Field Type'))
                            }}
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    {{ html()->label(__('Order'))->class('col-md-2 form-control-label')->for('order') }}
                    <div class="col-md-10">
                        {{ html()->text('order')
                            ->class('form-control')
                            ->value(@$productspec->order)
                            ->attribute('maxlength', 191)
                        }}
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ html()->label(__('Order For Seller'))->class('col-md-2 form-control-label')->for('Order For Seller') }}
                    <div class="col-md-10">
                        {{ html()->text('order_for_seller')
                            ->class('form-control')
                            ->value(@$productspec->order_for_seller)
                            ->attribute('maxlength', 191)
                        }}
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->
                <div class="form-group row">
                    {{ html()->label('Buyer HasMany')->class('col-md-2 form-control-label')->for('email') }}
                    <div class="col-md-2">
                        <div class="checkbox d-flex align-items-center">
                            @if(!empty(@$productspec->id))
                                @php 
                                    if( @$productspec->buyer_hasmany == 'Yes'){
                                        $is_checked = 'Yes';
                                        $is_hasmany = '1';
                                    }else{
                                        $is_checked = 'No';
                                        $is_hasmany = '0';
                                    }
                                @endphp
                            @else
                                @php 
                                    $is_hasmany = '0';
                                    $is_checked = 'No';
                                @endphp
                            @endif
                            {{ html()->label(
                                html()->checkbox('buyer_hasmany', $is_hasmany, $is_checked)
                                ->class('switch-input pref_check')
                                ->id('hasmany')
                                . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
                                ->class('switch switch-label switch-pill switch-success mr-2')
                                ->for('hasmany') 
                            }}
                        </div>
                    </div>
                    
                    {{ html()->label('Stock HasMany')->class('col-md-2 form-control-label')->for('email') }}
                    <div class="col-md-2">
                        <div class="checkbox d-flex align-items-center">
                            @if(!empty(@$productspec->id))
                                @php 
                                    if( @$productspec->stock_hasmany == 'Yes'){
                                        $is_checked = 'Yes';
                                        $is_hasmany = '1';
                                    }else{
                                        $is_checked = 'No';
                                        $is_hasmany = '0';
                                    }
                                @endphp
                            @else
                                @php 
                                    $is_hasmany = '0';
                                    $is_checked = 'No';
                                @endphp
                            @endif
                            {{ html()->label(
                                html()->checkbox('stock_hasmany', $is_hasmany, $is_checked)
                                ->class('switch-input pref_check')
                                ->id('stock_hasmany')
                                . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
                                ->class('switch switch-label switch-pill switch-success mr-2')
                                ->for('stock_hasmany') 
                            }}
                        </div>
                    </div>
                    
                    {{ html()->label('Required')->class('col-md-2 form-control-label')->for('email') }}
                    <div class="col-md-2">
                        <div class="checkbox d-flex align-items-center">
                            @if(!empty(@$productspec->id))
                                @php 
                                    if( @$productspec->required == 'Yes'){
                                        $is_checked = 'Yes';
                                        $is_hasmany = '1';
                                    }else{
                                        $is_checked = 'No';
                                        $is_hasmany = '0';
                                    }
                                @endphp
                            @else
                                @php 
                                    $is_hasmany = '0';
                                    $is_checked = 'No';
                                @endphp
                            @endif
                            {{ html()->label(
                                html()->checkbox('required', $is_hasmany, $is_checked)
                                ->class('switch-input pref_check')
                                ->id('required')
                                . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
                                ->class('switch switch-label switch-pill switch-success mr-2')
                                ->for('required') 
                            }}
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    {{ html()->label('Buyerpref Anylogic')->class('col-md-2 form-control-label')->for('buyer_pref_anylogic') }}
                    <div class="col-md-2">
                        <div class="checkbox d-flex align-items-center">
                            @if(!empty(@$productspec->id))
                                @php 
                                    $is_hasmany = @$productspec->buyer_pref_anylogic;
                                    if( @$productspec->buyer_pref_anylogic == 'Yes'){
                                        $is_checked = 'Yes';
                                        $is_hasmany = '1';
                                    }else{
                                        $is_checked = 'No';
                                        $is_hasmany = '0';
                                    }
                                @endphp
                            @else
                                @php 
                                    $is_hasmany = '1';
                                    $is_checked = 'Yes';
                                @endphp
                            @endif
                            {{ html()->label(
                                html()->checkbox('buyer_pref_anylogic', $is_hasmany, $is_checked)
                                ->class('switch-input pref_check')
                                ->id('buyer_pref_anylogic')
                                . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
                                ->class('switch switch-label switch-pill switch-success mr-2')
                                ->for('buyer_pref_anylogic') 
                            }}
                        </div>
                    </div>
                    
                    {{ html()->label('Display in transport')->class('col-md-2 form-control-label')->for('display_in_transport') }}
                    <div class="col-md-2">
                        <div class="checkbox d-flex align-items-center">
                            @if(!empty(@$productspec->id))
                                @php 
                                    $is_hasmany = @$productspec->display_in_transport;
                                    if( @$productspec->display_in_transport == 'Yes'){
                                        $is_checked = 'Yes';
                                        $is_hasmany = '1';
                                    }else{
                                        $is_checked = 'No';
                                        $is_hasmany = '0';
                                    }
                                @endphp
                            @else
                                @php 
                                    $is_hasmany = '0';
                                    $is_checked = 'No';
                                @endphp
                            @endif
                            {{ html()->label(
                                html()->checkbox('display_in_transport', $is_hasmany, $is_checked)
                                ->class('switch-input pref_check')
                                ->id('display_in_transport')
                                . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
                                ->class('switch switch-label switch-pill switch-success mr-2')
                                ->for('display_in_transport') 
                            }}
                        </div>
                    </div>

                    {{ html()->label('Can Edit')->class('col-md-2 form-control-label')->for('can_edit') }}
                    <div class="col-md-2">
                        <div class="checkbox d-flex align-items-center">
                            @if(!empty(@$productspec->id))
                                @php 
                                    if( @$productspec->can_edit == 'Yes'){
                                        $is_checked = 'Yes';
                                        $is_hasmany = '1';
                                    }else{
                                        $is_checked = 'No';
                                        $is_hasmany = '0';
                                    }
                                @endphp
                            @else
                                @php 
                                    $is_hasmany = '1';
                                    $is_checked = 'Yes';
                                @endphp
                            @endif
                            {{ html()->label(
                                html()->checkbox('can_edit', $is_hasmany, $is_checked)
                                ->class('switch-input pref_check')
                                ->id('can_edit')
                                . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
                                ->class('switch switch-label switch-pill switch-success mr-2')
                                ->for('can_edit') 
                            }}
                        </div>
                    </div>
                </div>
                
              
              <?php 
                    $arrayTags = explode(',',@$productspec->tags);
             ?>
             <?php if(!empty($display_name)){
                  $arrayTags = explode(',',@$productspec->tags);
                  ?>
                 <div class="form-group row">
                    {{ html()->label(__('Tags <span style="color:red"></span>'))->class('col-md-2 form-control-label') }}
                    <div class="col-md-10">
                       <select class="select2 form-control" name="tags[]" id="tags[]" maxlength="191" placeholder="Select Tag" multiple="multiple" 
                       >
                       
                       <option value="Conditional"  <?php if(in_array('Conditional',$arrayTags)){
                        echo "selected";
                    }?>>Conditional</option>
                       <option value="BuyerField" <?php if(in_array('BuyerField',$arrayTags)){
                        echo "selected";
                    }?>>BuyerField</option>
                       
                       </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
             <?php } ?>
              <div class="form-group row">
                    {{ html()->label(__('Tags <span style="color:red"></span>'))->class('col-md-2 form-control-label') }}
                    <div class="col-md-10">
                       <select class="select2 form-control" name="tags[]" id="tags[]" maxlength="191" placeholder="Select Tag" multiple="multiple" 
                       >
                       
                       <option value="Conditional"  <?php if(in_array('Conditional',$arrayTags)){
                        echo "selected";
                    }?>>Conditional</option>
                       <option value="BuyerField" <?php if(in_array('BuyerField',$arrayTags)){
                        echo "selected";
                    }?>>BuyerField</option>
                       
                       </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <!--col-->
                </div>
                <div class="form-group row">

                            {{ html()->label(__('Shortcode'))->class('col-md-2 form-control-label')->for('Shortcode') }}
                            <div class="col-md-3">
                                {{ html()->text('shortcode')
                                    ->class('form-control')
                                    ->placeholder(__('Shortcode'))
                                    ->value(@$productspec->shortcode)
                                    ->attribute('maxlength', 191) 
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->

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
                {{ form_cancel(route('admin.productspecs.index'), __('buttons.general.cancel')) }}
            </div>
            <!--col-->
            <div class="col text-right">
                @if(!empty(@$productspec->id))
                    {{ form_submit(__('buttons.general.crud.update')) }}
                @else
                    {{ form_submit(__('buttons.general.crud.create')) }}
                @endif
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-footer-->
</div>
<!--card-->
{{ html()->form()->close() }}
@if(!empty(@$productspec->id))
    @php 
        $url = route('admin.productspecs.update', @$productspec->id); 
        $redirect_url = route('admin.productspecs.index');
    @endphp
@else
    @php 
        $url = route('admin.productspecs.store');
        $redirect_url = route('admin.productspecs.index');
    @endphp
@endif
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

        var formData = new FormData(this);
        $( ".pref_check" ).each(function( key, value ) {
            if(value.value == 'No'){
                formData.append(value.name, value.value);
            }
        });
        var productspecid = '{{ @$productspec->id }}';
        if (productspecid != '') {
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

    function fetch_field_vals(val) {
        if (val == '' || val == 'undefined') {
            return false;
        }
        var product_id = $("#product_id").val();
        $.ajax({
            type: "POST",
            url: "{{ route('admin.trading.getappheadvalues') }}",
            data: {
                type: val,
                product_id: product_id
            },
            success: function(data) {
                $('#default').html(data);
                $('#default').select2().trigger('change');
            }
        });
    }

    $("#parent_id").change(function() {
        var parent_val = $(this).val();
        if (parent_val) {
            var parent_list = @json($productSpecRel);
            var pid = $("#product_id").val();
            var psid = $(this).val();
            $(".reference-items").html('');
            if (parent_list) {
                var values = '<option value="">Select</option>';
                jQuery.each(parent_list, function(key, value) {
                    if (value) {
                        values += '<option value="' + key + '">' + value + '</option>';
                    }
                });
                var select = '<select class="form-control Reference" name="reference_id" >' + values + '</select>'
                $(".reference-items").append('<div class="form-group row"><label class="col-md-2 form-control-label" for="Value">Reference</label><div class="col-md-10">' + select + '<span>Hint: Reference with parent value</span><div class="invalid-feedback"></div></div> </div>');
                $('.Reference').select2().trigger('change');
            }
        }else{
            $(".reference-items").html(''); 
        }
    });
    
    var productspec = @json(isset($productspec) ? $productspec : '');
    if (productspec) {
        var parent_list = @json($productSpecRel);
        if (parent_list) {
            var values = '<option value="">Select</option>';
            jQuery.each(parent_list, function(key, value) {
                if (value) {
                    if (productspec.reference_id == key) {
                        var selected = "selected";
                    } else {
                        var selected = "";
                    }
                    values += '<option value="' + key + '" ' + selected + ' >' + value + '</option>';
                }
            });
            var select = '<select class="form-control reference_select" name="reference_id" >' + values + '</select>'
            $('.reference_select').select2();
            $(".reference-items").append('<div class="form-group row"><label class="col-md-2 form-control-label" for="Value">Reference</label><div class="col-md-10">' + select + '<span>Hint: Reference with parent value</span> <div class="invalid-feedback"></div></div> </div>');
        }
    }

    $('body').on('click', '.pref_check', function(){
        if(this.checked){
            $(this).val('Yes');
            $(this).attr('checked','checked');
        }else{
            $(this).val('No');
            $(this).removeAttr('checked');
        }
    })
</script>
@endpush