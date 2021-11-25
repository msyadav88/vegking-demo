@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.products.edit') . ' #'.$product->id . ' :: ' . app_name())
@section('content')
    {{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('menus.backend.trading.products.edit') 
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
                                    ->value($product->name)
                                    ->attribute('maxlength', 191)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('Name (PL)<span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('name_pl') }}
                            <div class="col-md-10">
                                {{ html()->text('name_pl')
                                    ->class('form-control')
                                    ->value($product->name_pl)
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
                                    ->value($product->name_de)
                                    ->placeholder(__('validation.attributes.backend.trading.products.name'))
                                    ->attribute('maxlength', 191)}}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->

                     <div class="form-group row">
                            {{ html()->label('Product Image')->class('col-md-2 form-control-label')->for('image') }}

                         
                            <div class="col-md-10">

                                 <input type="hidden" name="old_image" value="{{ $product->image }}"/>
                                <a href="{{ asset('images/products/'.$product->image) }}" data-fancybox data-caption="{{$product->name}}"><img src="{{ asset('images/products/'.$product->image) }}" class="mb-2 stock-image img-thumbnail" /></a>
                                <div class="form-group">
                            <div class="input-group input-file" name="image">
                              <span class="input-group-prepend">
                                <button class="btn btn-info btn-choose" type="button">Choose</button>
                              </span>
                              <input type="text" class="form-control" placeholder='Choose a file...' />
                              <span class="input-group-append">
                                <button class="btn btn-danger btn-reset" type="button">Reset</button>
                              </span>
                            </div>

                            </div>
                            </div>

                        </div>
                        
                        <div class="form-group row">
                            {{ html()->label('Stock Image')->class('col-md-2 form-control-label')->for('homepage_image') }}

                            <div class="col-md-10">

                                 <input type="hidden" name="old_home_image" value="{{ $product->homepage_image }}"/>
                                 <a href="{{ asset('images/products/'.$product->homepage_image) }}" data-fancybox data-caption="{{$product->name}}"><img src="{{ asset('images/products/'.$product->homepage_image) }}" class="mb-2 stock-image img-thumbnail" /></a>
                            <div class="form-group">
                            <div class="input-group input-file" name="homepage_image">
                              <span class="input-group-prepend">
                                <button class="btn btn-info btn-choose" type="button">Choose</button>
                              </span>
                              <input type="text" class="form-control" placeholder='Choose a file...' />
                              <span class="input-group-append">
                                <button class="btn btn-danger btn-reset" type="button">Reset</button>
                              </span>
                            </div>

                            </div>
                            </div>
                   

                          
                        </div>
                        
                      
                        <div class="form-group row">
                          {{ html()->label('Status')->class('col-md-2 form-control-label')->for('email') }}
                            <div class="col-md-10">
                                <div class="checkbox d-flex align-items-center">
                                    @if(!empty($product->id))
                                        @php $is_checked = $product->status @endphp
                                    @else
                                        @php $is_checked = 1 @endphp
                                    @endif
                                    {{ html()->label(
                                        html()->checkbox('required',  $is_checked, $is_checked)
                                        ->class('switch-input pref_check')
                                        ->id('required')
                                        . '<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span>')
                                        ->class('switch switch-label switch-pill switch-success mr-2')
                                        ->for('required') 
                                    }}
                                </div>
                            </div>
                        </div><!--col-->

                            @if($product->type == 'Product')    
                                @php $active = '1' @endphp
                            @else
                                @php $active = '0' @endphp
                            @endif

                        <div class="form-group row">
                          {{ html()->label('Type')->class('col-md-2 form-control-label')->for('Type') }}
                          <div class="col-md-10">
                            <div class="checkbox d-flex align-items-center produttype">
                              {{ html()->label(
                                html()->checkbox('required_type',  $active  , '1')
                                ->class('switch-input type_check')
                                ->id('required_type')
                                . '<span class="switch-slider" data-checked="product" data-unchecked="service"></span>')
                                ->class('switch switch-label switch-pill switch-success mr-2')
                                ->for('required_type') }}
                              </div>
                            </div>
                        </div>
                        <div class="form-group row">
                        {{ html()->label(__('Base Price <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('base_price') }}
                            <div class="col-md-10">
                                {{ html()->text('base_price')
                                    ->value($product->base_price)
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.products.price'))
                                    ->attribute('maxlength', 191)
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="rule-section">
                        <div class="form-group row rules-section-block">
                         {{ html()->label(__('Price'))->class('col-md-2 form-control-label')->for('price') }}
                            <div class="col-md-4">
                                <div class="col-md-10">
                                    <select class="select2 form-control select2-hidden-accessible" name="country[0]" id="country[0]" maxlength="191" placeholder="Select Tag" tabindex="-1" aria-hidden="true">
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}" >{{$country->name}}</option> 
                                     @endforeach      
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                               <input type="text" class="form-control" name="price[0]" id="price[0]" placeholder="Price">
                            </div>
                            <div class="col-md-2">
                                <input type="button" class="rule-add btn btn-primary" value="Add" id="Price"/>
                            </div>
                        </div>
                    </div>
                    </div><!--row-->
                </div><!--card-body-->

                <div class="card-footer clearfix">
                    <div class="row">
                        <div class="col">
                            {{ form_cancel(route('admin.products.index'), __('buttons.general.cancel')) }}
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
        $url = route('admin.products.update', $product->id); 
        $redirect_url = route('admin.products.index');
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
        formData.append('_method', 'PUT');
        
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
    let country = @json($countries);
    let countries;
    $.each(country,function(k,v){
        countries+= '<option value="'+v.id+'">'+v.name+'</option>'
    })
    $('#Price').click(function(){
        
        $('.rule-section').append('<div class="row"><div class="col-md-2"></div><div class="col-md-4">'+
                    '<div class="col-md-10">'+
                        '<select class="select2 form-control" name="country[0]" id="country[]" maxlength="191" placeholder="Select Tag" tabindex="-1" aria-hidden="true">'+countries+'</select>'+
                    '</div>'+
                    '</div>'+
            '<div class="col-md-4">'+
               '<input type="text" class="form-control" name="price" id="price" placeholder="Price">'+
            '</div>'+
             '<div class="col-md-2">'+
                '<input type="button" class="rule-remove btn btn-danger" value="Remove" id="priceremove"/>'+
            '</div></div>');
    })
        // $('body').on('click', '#priceremove', function(){
        //     $(this).parents('').remove();
        // })
</script>
@endpush