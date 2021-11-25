@extends('backend.layouts.app')
@section('title', __('Add Product Condition') . ' :: ' . app_name())
@section('content')
    {{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('Add Product Condition')
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">

                        <div class="form-group row">
                        {{ html()->label(__('Name <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('name') }}
                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.products.name'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('Name (PL)<span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('name_pl') }}
                            <div class="col-md-10">
                                {{ html()->text('name_pl')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.products.name'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('Name (DE)<span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('name_de') }}
                            <div class="col-md-10">
                                {{ html()->text('name_de')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.products.name'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Product <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('product') }}
                            <div class="col-md-10">
                              {{ html()->select('product_id')
                              ->class('select2 form-control')
                              ->attribute('maxlength', 191)
                              ->options($products)
                              ->placeholder('Choose Product')
                            }}
                            <div class="invalid-feedback"></div>
                          </div>
                        </div>
                            
                        <div class="form-group row">
                            {{ html()->label('Image <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('image') }}
                            
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

                        
                        <div class="rules-section">
                            <div class="form-group row rules-section-block">
                                {{ html()->label('Rules')->class('col-md-2 form-control-label')->for('rules') }}
                                <div class="col-md-2">
                                    <select name="rule[1][spec]" class="pspec form-control">
                                        <option>Select</option>
                                        @foreach($productSpecRel[1] as $productSpecId=>$productSpec)
                                            <option value="{{$productSpecId}}">
                                            {{$productSpec['name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="rule[1][spec_val]" class="pspecvals form-control">
                                        <option>Select</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-1">
                                    <select name="rule[1][type]" class="pspecvaltype form-control">
                                        <option  value="">Select</option>
                                        <option>Range</option>
                                        <option>Like</option>
                                    </select>
                                </div>
                                
                                
                                <div class="col-md-1 spec-childs-options vk_hide">
                                    <input placeholder="Min" name="rule[1][sub_spec_min]" class="form-control"/>
                                </div>
                                <div class="col-md-1 spec-childs-options vk_hide">
                                    <input placeholder="Max" name="rule[1][sub_spec_max]" class="form-control"/>
                                </div>
                                <div class="col-md-2">
                                    <select name="rule[1][op]" class="form-control"><option>Yes</option><option>No</option></select>
                                </div>
                                <div class="col-md-2">
                                    <input type="button" class="rule-add btn btn-primary" value="Add"/>
                                </div>
                            </div>
                        </div>
                        
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.products.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
    @php 
        $url = route('admin.products.productSpecRelationStore'); 
        $redirect_url = route('admin.products.index');
    @endphp
@endsection
@push('after-scripts')
<script type="text/javascript">
let k = 2;
let product_id = 1;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var productSpecRel = @json($productSpecRel);
    
    $(document).on('change','#product_id',function(event) {
        product_id = this.value;
        //alert();
    });
    $(document).on('change','.pspec',function(event) {
        id = $(this).val();
        vals = productSpecRel[product_id][id]['values'];
        
        childs = productSpecRel[product_id][id]['childs'];
        console.log(childs);
        if(childs != undefined){
            html = '<option>Select</option>';
            $.each(childs,function(k,v){
                console.log(v);
                html += '<option value="'+k+'">'+v['name']+'</option>';
            });
            console.log(html);
            $(this).parents('.rules-section-block').find('.pspecvals').html(html);
            $(this).parents('.rules-section-block').find('.pspecvals').addClass('spec-childs');
            $(this).parents('.rules-section-block').find('.spec-childs-options').removeClass('vk_hide');
            
        } else {
            console.log(vals);
            html = '<option>Select</option>';
            $.each(vals,function(k,v){
                console.log(v);
                html += '<option value="'+k+'">'+v+'</option>';
            });
            $(this).parents('.rules-section-block').find('.pspecvals').html(html);
            $(this).parents('.rules-section-block').find('.pspecvals').removeClass('spec-childs');
            $(this).parents('.rules-section-block').find('.spec-childs-options').addClass('vk_hide');
           
        }
    });
    
    $(document).on('change','.spec-childs',function(event) {
        
    });
    
    $('.rule-add').on('click', function(event) {
        
        vals = productSpecRel[1];
        html = '<option>Select</option>';
        $.each(vals,function(k,v){
            console.log(v);
            html += '<option value="'+k+'">'+v['name']+'</option>';
        });
       
        $('.rules-section').append('<div class="form-group row rules-section-block"><div class="col-md-2">&nbsp;</div><div class="col-md-2"> <select name="rule['+k+'][spec]" class="pspec form-control">'+html+'</select></div><div class="col-md-2"><select name="rule['+k+'][sub_spec]" class="pspecvals form-control"><option>Select</option></select></div><div class="col-md-1 spec-childs-options vk_hide"><input placeholder="Min" name="rule['+k+'][sub_spec_min]" class="form-control"/></div><div class="col-md-1 spec-childs-options vk_hide"><input placeholder="Max" name="rule['+k+'][sub_spec_max]" class="form-control"/></div> <div class="col-md-2"><select name="rule['+k+'][op]" class="form-control"><option>Yes</option><option>No</option></select></div> <div class="col-md-2"><input type="button" class="rule-remove btn btn-danger" value="Remove"/></div></div>');
        k++;
    });
                            
    $('#formsubmit1').on('submit', function(event) {
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

    
</script>
<style type="text/css">
    .is-invalid .invalid-feedback{
        display: block !important;
    }
</style>
@endpush