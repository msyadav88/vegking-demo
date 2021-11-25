@extends('backend.layouts.app')
@if(!empty($buyerpref->id))
    @section('title', __('menus.backend.trading.buyerpref.edit') . ' :: ' . app_name())
@else
    @section('title', __('menus.backend.trading.buyerpref.create') . ' :: ' . app_name())
@endIf


@section('content')
    {{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @if(!empty($buyerpref->id))
                              @lang('menus.backend.trading.buyerpref.edit')
                            @else
                              @lang('menus.backend.trading.buyerpref.create')
                            @endIf
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        @if(auth()->user()->hasRole('administrator'))
                        <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="buyer_id">{{__('Buyer')}}
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-10">
                                <select class="select2 form-control" name="buyer_id" id="buyer_id" maxlength="191">
                                  <option value="">{{__('Select Buyer')}}</option>
                                  @foreach(buyers_list() as $buyer)
                                    <option value="{{ $buyer->id}}" @if($buyer->id == @$buyerpref->buyer_id) selected @endif>{{ $buyer->username}}</option>
                                  @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        @elseif(auth()->user()->hasRole('buyer'))
                            <input type="hidden" name="buyer_id" value="{{$buyer_id}}"/>
                        @endif
                        <div class="form-group row">
                            
                            {{ html()->label(__('Product <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('product_id') }}
                            <div class="col-md-10">
                                {{ html()->select('product_id')
                                    ->class('select2 form-control')
                                    ->options($product_list)
                                    ->value(@$buyerpref->product_id)
                                    ->attribute('maxlength', 191)
                                    ->placeholder(__('Select Product'))
                                    ->attribute('onchange', 'fetch_product(this.value)')
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="combine-nets">
                            @if(!empty($first_product))
                            @foreach($productSpecRel[$first_product] as $pKey=>$productSpec)
							@if($productSpec['hasmany'] == 'No')
                                <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="variety">{{ @$productSpec['name'] }} @if(@$productSpec["required"] == "Yes")<span style="color:red">*</span>@endif</label>
                                    <div class="col-md-10">
                                        {{ html()->select('specification['.$pKey.']')
                                            ->class('select2 form-control')
                                            ->options($productSpec['options'])
                                            ->value(@$productSpec['default'])
                                            ->attribute('maxlength', 191)
                                        }}
                                    </div>
                                </div>
                            @else
                                <div class="form-group row Purpose">
                                    @if(isset($productSpec['options']))
                                    @if(count($productSpec['options']) > 0)
                                    @php $option_key_num = 0; @endphp
                                    <label class="col-md-12 form-control-label" for="purposes"><strong>{{ @$productSpec['name'] }} @if(@$productSpec["required"] == "Yes")<span style="color:red">*</span>@endif</strong></label>
                                    <div class="col-md-12">
                                        <div class="row app-head-group-purpose">
                                            @foreach($productSpec['options'] as $key => $option)
                                            @php $option_key = str_slug($option['name'], "_"); @endphp
                                               <div class="flex_item purpose_item form-group">
                                                    <div class="checkbox switch-box d-flex align-items-center">
                                                        {{ html()->label(
                                                            html()->checkbox('specification['.$pKey.']['.$option_key_num.']', in_array($key, $productSpec['default']??array()), $key)
                                                            ->class('switch-input switch_select_item')
                                                            ->attribute('data-group','purpose')
                                                            ->id($option_key)
                                                            . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                            ->class('switch switch-label switch-pill switch-primary mr-2')
                                                            ->for($option_key)
                                                        }}
                                                        <input type="number" name="premium[{{$key}}]" value="{{$option['premium']?? 0}}" data-decimals="0" min="-15" max="15" step="1"/>
                                                        {{ html()->label(ucwords($option['name']))->for($option_key)->class('flex-1') }}
                                                    </div>
                                                </div>
                                                @php $option_key_num++; @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            @endif
							@endforeach
                            @endif
						</div>    
                   
                        <div class="form-group row" style="display:none;">
                            {{ html()->label('Size ranges')->class('col-md-2 form-control-label')->for('size_ranges') }}
                            <div id="size_ranges" class="col-md-10" style="padding-bottom:40px; position:relative">
                                <div class="r-group form-group row">
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" placeholder="From" name="size_range[0][from]" id="size_range_0_from" data-pattern-name="size_range[++][from]" data-pattern-id="size_range_++_from" />
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" placeholder="to" name="size_range[0][to]" id="size_range_0_to" data-pattern-name="size_range[++][to]" data-pattern-id="size_range_++_to" />
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="r-btnRemove btn btn-danger btn-md">Remove -</button>
                                    </div>
                                </div>
                                <button style="position:absolute; bottom:0px; left:15px;" type="button" class="r-btnAdd btn btn-success btn-md">Add +</button>
                          </div>
                        </div>
                      
                        <div class="form-group row"  style="display:none;">
                            {{ html()->label('Price Ranges')->class('col-md-2 form-control-label')->for('price_ranges') }}
                            <div id="price_ranges" class="col-md-10" style="padding-bottom:40px; position:relative">
                                <div class="p-group form-group row">
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" placeholder="From" name="price_range[0][from]" id="price_range_0_from" data-pattern-name="price_range[++][from]" data-pattern-id="price_range_++_from" />
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" placeholder="to" name="price_range[0][to]" id="price_range_0_to" data-pattern-name="price_range[++][to]" data-pattern-id="price_range_++_to" />
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="p-btnRemove btn btn-danger btn-md">Remove -</button>
                                    </div>
                                </div>
                                <button style="position:absolute; bottom:0px; left:15px;" type="button" class="p-btnAdd btn btn-success btn-md">Add +</button>
                          </div>
                        </div>
                        
                        <div class="form-group row"  style="display:none;">
                            {{ html()->label('Location ranges')->class('col-md-2 form-control-label')->for('location_ranges') }}
                            <div id="location_ranges" class="col-md-10" style="padding-bottom:40px; position:relative">
                                <div class="l-group form-group row">
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" placeholder="From" name="location_range[0][from]" id="location_range_0_from" data-pattern-name="location_range[++][from]" data-pattern-id="location_range_++_from" />
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" placeholder="to" name="location_range[0][to]" id="location_range_0_to" data-pattern-name="location_range[++][to]" data-pattern-id="location_range_++_to" />
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="l-btnRemove btn btn-danger btn-md">Remove -</button>
                                    </div>
                                </div>
                                <button style="position:absolute; bottom:0px; left:15px;" type="button" class="l-btnAdd btn btn-success btn-md">Add +</button>
                          </div>
                        </div>
                        
                   </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->
            @if(starts_with(Route::currentRouteName(), 'admin.'))
                @php $route_prefix = "admin"; @endphp
            @elseif (starts_with(Route::currentRouteName(), 'buyer.'))
                @php $route_prefix = "buyer"; @endphp
            @elseif (starts_with(Route::currentRouteName(), 'seller.'))
                @php $route_prefix = "seller"; @endphp
            @elseif (starts_with(Route::currentRouteName(), 'trader.'))
                @php $route_prefix = "trader"; @endphp
            @endif            

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route($route_prefix.'.buyerpref.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->
                    <div class="col text-right">
                        @if(!empty($buyerpref->id))
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
@endif
@role('buyer')
  @php $route_pre = 'buyer'; @endphp
@endif
@role('administrator')
  @php $route_pre = 'admin'; @endphp
@endif  
    @if(!empty($buyerpref->id))
        @php 
            $url =  route($route_pre.'.buyerpref.update', $buyerpref->id); 
            $redirecturl = route($route_pre.'.buyerpref.index');
        @endphp
        
    @else
        @php 
            $url = route($route_pre.'.buyerpref.store');  
            $redirecturl = route($route_pre.'.buyerpref.index');
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
        
        $('.has-danger').next().children().children().css({"border": ""});
        $('.is-invalid').removeClass("is-invalid");
        $('.invalid-feedback').html("");
        $('.has-danger').removeClass("has-danger");

        var formData = new FormData(this);
        var buyerprefid = '{{ @$buyerpref->id }}';
        if(buyerprefid != '')
        {
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
            $('.loading').removeClass('loading_hide');
            },
            success: function(data)
            {
                $('.loading').addClass('loading_hide');
                if(data.status == 'success'){
                    Swal.fire('Sent!', data.message, 'success');
                    setTimeout(function(){
                        window.location.href = "{{ $redirecturl }}"; 
                    }, 1000);
                }
                if(data.status == 'error'){
                    $('.btn-success').removeAttr('disabled');
                    Swal.fire('Error!', data.message, 'error');
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
                        $('#'+key).css({"border": "1px solid #f86c6b"});
                    })
                }
            }
        });
    });
    
    
    function fetch_product(val){
    $.ajax({
      type: "POST",
      url: "{{ route($route_pre.'.trading.getproductforbuyer') }}",
      data: {pid:val},
      success: function (data) {
			$(".combine-nets").html(data);
			$("input[type='number']").inputSpinner()
			$( ".checkbox.switch-box .switch input" ).each(function( index,element ) {
				switchPremium(element.id);
			});
			return false;
      }
    });
  }
  
    $('#size_ranges').repeater({
        btnAddClass: 'r-btnAdd',
        btnRemoveClass: 'r-btnRemove',
        groupClass: 'r-group',
        minItems: 1,
        maxItems: 0,
        startingIndex: 0,
        showMinItemsOnLoad: true,
        reindexOnDelete: true,
        repeatMode: 'append',
        animation: null,
        animationSpeed: 400,
        animationEasing: 'swing',
        clearValues: true
    },[
        @if(isset($order->size_range))
        @foreach(json_decode($order->size_range) as $key => $val)
        {"size_range[{{$key}}][from]":"{{$val->from}}", "size_range[{{$key}}][to]":"{{$val->to}}"},
        @endforeach
        @endif
    ]);
    $('#location_ranges').repeater({
        btnAddClass: 'l-btnAdd',
        btnRemoveClass: 'l-btnRemove',
        groupClass: 'l-group',
        minItems: 1,
        maxItems: 0,
        startingIndex: 0,
        showMinItemsOnLoad: true,
        reindexOnDelete: true,
        repeatMode: 'append',
        animation: null,
        animationSpeed: 400,
        animationEasing: 'swing',
        clearValues: true
    }, [
        @if(isset($order->location_range))
        @foreach(json_decode($order->location_range) as $key => $val)
        {"location_range[{{$key}}][from]":"{{$val->from}}", "location_range[{{$key}}][to]":"{{$val->to}}"},
        @endforeach
        @endif
    ]);
    $('#price_ranges').repeater({
        btnAddClass: 'p-btnAdd',
        btnRemoveClass: 'p-btnRemove',
        groupClass: 'p-group',
        minItems: 1,
        maxItems: 0,
        startingIndex: 0,
        showMinItemsOnLoad: true,
        reindexOnDelete: true,
        repeatMode: 'append',
        animation: null,
        animationSpeed: 400,
        animationEasing: 'swing',
        clearValues: true
    },[
        @if(isset($order->location_range))
        @foreach(json_decode($order->price_range) as $key => $val)
        {"price_range[{{$key}}][from]":"{{$val->from}}", "price_range[{{$key}}][to]":"{{$val->to}}"},
        @endforeach
        @endif

    ]);
    
    
$(".any_type_selected").click(function(){
    dataGroup = $(this).attr('data-group');
    dataItem = $(this).attr('data-item');
    state = $(this).prop('checked');
    console.log(dataItem);
    $(".app-head-group-"+dataGroup).find("."+dataItem).each(function(){
        if(state == true){
            $(this).find('input[type=number]').prop('disabled', false);
            $(this).find('input[type=checkbox]').prop('checked', true);
        } else {
            $(this).find('input[type=number]').prop('disabled', true);
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

$(".switch_child_select_item").click(function(){
    dataGroup = $(this).attr('data-parent-group');
    console.log('pchild');
    state = $(this).prop('checked');
    if(state == false){
        $(".any_sub_type_selected[data-group='"+dataGroup+"']").prop('checked', false);
    }  
});


$(".any_sub_type_selected").click(function(){
    dataGroup = $(this).attr('data-group');
    state = $(this).prop('checked');
    $(".app-head-group-fleshcolor").find(".flesh_item[data-group='"+dataGroup+"']").each(function(){
        if(state == true){
            $(this).find('input[type=number]').prop('disabled', false);
            $(this).find('input[type=checkbox]').prop('checked', true);
        } else {
            $(this).find('input[type=number]').prop('disabled', true);
            $(this).find('input[type=checkbox]').prop('checked', false);
        }
    });
 
    
});


$('body').on('click','.switch',function() {
    switchPremium($(this).children('input').attr('id'));
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


</script>
@endpush
