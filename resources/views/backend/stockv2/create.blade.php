@extends('backend.layouts.app')
  @if(!empty($stock->id))
    @section('title', __('menus.backend.trading.offers.edit').' :: '.app_name())
  @else
    @section('title', __('menus.backend.trading.offers.create').' :: '.app_name())
  @endIf
@section('content')

@role('seller')
  @php $route_pre = 'seller'; @endphp
@else
  @php $route_pre = 'admin'; @endphp
@endif

{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
        @if(!empty($stock->id))
          @lang('menus.backend.trading.offers.edit')
        @else
          @lang('menus.backend.trading.offers.create')
        @endIf
          <small class="text-muted"></small>
        </h4>
      </div><!--col-->
    </div><!--row-->

    <hr>

    <div class="row mt-4 mb-4">
      <div class="col">
        @role('seller')
         
      @else
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="seller_id">{{__('validation.attributes.backend.trading.requests.seller')}} <span style="color:red">*</span></label>
          <div class="col-md-10">
            <select class="form-control select2" name="seller_id" id="seller_id" maxlength="191">
              <option value="">{{__('validation.attributes.backend.trading.requests.select_seller')}}</option>
              @foreach($sellers as $seller)
              <option data-city="{{ $seller->city }}" data-postalcode="{{ $seller->postalcode }}" data-address="{{ $seller->address }}" data-country="{{ $seller->country }}" {{old('seller_id')==$seller->id?'selected':''}} value="{{ $seller->id}}" @if(@$seller->id == @$stock->seller_id) selected @endif>{{ $seller->name}} ({{ $seller->username}})</option>
              @endforeach
            </select>
            <div class="invalid-feedback"></div>
          </div><!--col-->
        </div>
      @endrole

    @php $tab_key = 1; @endphp
    @php $tab_key_heading = $tab_key_heading2 = 1; @endphp
    <div id="product_prefs_box2" class="mb-4">
      
        <div id="products_specs">
            <div class="row">
                <div class="col-md-12" id="tabs">
                    <ul class="nav nav-tabs ui-sortable">
                        <li class="nav-item "><a class="nav-link {{ ($tab_key_heading ==1)?'active':'' }}" href="#pref{{ $tab_key_heading }}" data-toggle="tab">Stock #{{ $tab_key_heading }}</a></li>    
                    </ul>
                    <div class="tab-content">
                        <div data-pref-id="{{ $tab_key_heading2 }}" id="pref{{ $tab_key_heading2 }}" class="tab-pane {{ ($tab_key_heading2 ==1)?'active':'' }} product-group">
                            <div id="pref1-products" class="form-group row">
                                {{ html()->label('Product <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('product') }}
                                <div class="col-md-10">
                                  {{ html()->select('stock['.$tab_key.'][product_id]')
                                    ->class('select2 form-control change-product')
                                    ->attribute('maxlength', 191)
                                    ->options($products)
                                    ->value(@$stock->product->id)
                                    ->attribute('onchange', 'fetch_select(this,this.value)')
                                    ->placeholder('Choose Product')
                                  }}
                                <div class="invalid-feedback"></div>
                              </div>
                            </div> 
                            <div class="product-nets"></div>
                            <div class="form-group row">
                              {{ html()->label('Price per ton <span style="color:red">*</span>')->class('col-md-2 form-control-label')->for('price') }}
                              <div class="col-md-10">
                                {{ html()->text('stock['.$tab_key.'][price]')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.trading.offers.price'))
                                ->attribute('maxlength', 191)
                                ->value(@$stock->price) }}
                                <div class="invalid-feedback"></div>
                              </div><!--col-->
                            </div>
                            
                            <div id="pref1-size-range" class="form-group row">
                                  {{ html()->label('Size Range (mm)')->class('col-md-2 form-control-label')->for('dry_matter_content') }}
                                  <div class="col-md-10">
                                    <div class="form-group row">
                                      <div class="col-md-2 col-sm-6" style="position:relative">
                                        <label class="form-control-label" for="size_from">From</label>
                                        <input class="form-control" type="text" pattern="[0-9]*" inputmode="numeric" value="{{@$stock->size_from ?? '45'}}" placeholder="Min" name="stock[<?php echo $tab_key; ?>][size_from]" id="size_from" /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
                                      </div>
                                      <div class="col-md-2 col-sm-6" style="position:relative">
                                        <label class="form-control-label" for="size_to">To</label>
                                        <input class="form-control" type="text" pattern="[0-9]*" inputmode="numeric" value="{{@$stock->size_to ?? '65'}}" placeholder="Max" name="stock[<?php echo $tab_key; ?>][size_to]" id="" /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
                                      </div>
                                    </div>
                                  </div><!--col-->
                            </div><!--form-group-->
                            <div id="pref1-address" class="form-group row">
                              {{ html()->label('Loading Address')->class('col-md-2 form-control-label')->for('company_name') }}
                              <div class="col-md-10">
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('city') }}
                                      {{ html()->text('stock['.$tab_key.'][city]')->class('form-control city-control')->placeholder('City')->value(@$stock->city)->attribute('maxlength', 191) }}
                                      <div class="invalid-feedback"></div>
                                    </div>
                                  </div><!--col-->

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('postalcode') }}
                                      {{ html()->text('stock['.$tab_key.'][postalcode]')->class('form-control postalcode-control')->placeholder('Postal Code')->value(@$stock->postalcode)->attribute('maxlength', 191) }}
                                      <div class="invalid-feedback"></div>
                                    </div>
                                  </div><!--col-->

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      {{ html()->label('Street Address')->class('form-control-label')->for('street') }}
                                      {{ html()->text('stock['.$tab_key.'][street]')->class('form-control street-control')->placeholder('Street Address')->value(@$stock->street)->attribute('maxlength', 191) }}
                                    </div>
                                  </div><!--col-->

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      {{ html()->label('Country')->class('form-control-label')->for('country') }}
                                      {{ html()->select('stock['.$tab_key.'][country]')
                                        ->class('select2 form-control country-control')
                                        ->options(country_list())
                                        ->value(@$stock->country ?? 'UK')
                                        ->attribute('maxlength', 191)
                                      }}
                                  
                                    </div>
                                  </div><!--col-->
                                </div><!--form-group-->
                              </div>
                            </div>
                            <div id="pref1-show-more" class="form-group row ">
                                <button type="button" class="btn btn-secondary show_more vk_hide"  style="margin: 0 auto;">Show More</button>
                            </div>
                            @php $tab_key_heading++; $tab_key++; @endphp   
                        </div>
                    </div>
                </div>    
            </div>    
        </div>    
    </div>    
    
    
    <div class="form-group row">
        <div class="col-md-12">
            <button style="bottom:0px;margin-right:20px;" type="button" class="pro-btnAdd btn btn-warning btn-md">Add+</button>
            <button style="bottom:0px;" type="submit" class="btn btn-success btn-md">Done</button>
        </div>
    </div>
    
@role('seller')
  @php $route_pre = 'seller'; @endphp
@else
  @php $route_pre = 'admin'; @endphp
@endif

@if(!empty($stock->id))
  @php
    $url =  route($route_pre.'.stockv2.update', $stock->id);
    $redirecturl =  route($route_pre.'.stockv2.index');
    $stockid = $stock->id;
  @endphp
@else
  @php
    $url =  route($route_pre.'.stockv2.store');
    $redirecturl =  route($route_pre.'.stockv2.index');
    $stockid = 0;
  @endphp
@endif    

</div>
</div>
</div>
</div>
@endsection

@push('after-scripts')
<script type="text/javascript">
var tabn = {{$tab_key}};
var tab_key_heading = {{$tab_key_heading}};
var products = JSON.parse('@json($products)');
var countries = JSON.parse('@json(country_list())');
console.log(countries);
var selectOpt = '<option value="" selected="selected">Choose Product</option>';
var countryOpt = '<option value="" selected="selected">Country</option>';
$.each(products,function(key,value){
    selectOpt += '<option value="'+key+'">'+value+'</option>'
});
$.each(countries,function(key,value){
    countryOpt += '<option value="'+key+'">'+value+'</option>'
});
$('body').on('DOMNodeInserted', 'select', function () {
    $(this).select2();
}); 
var prefHtml = '';
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    
    function fetch_select(thisObject,val){
       
    }
    
    $(document).ready(function(){
        $('body').on('change','#seller_id', function(event) {
            var city  = $(this).find('option:selected').data('city');
            var postalcode  = $(this).find('option:selected').data('postalcode');
            var address  = $(this).find('option:selected').data('address');
            var country  = $(this).find('option:selected').data('country');
            $(".city-control").val(city);
            $(".street-control").val(address);
            $(".postalcode-control").val(postalcode);
            $(".country-control").val(country);
            $(".country-control").select2().trigger('change');
        });
        $("body").on('click','.remove-this-tab',function(){
            $(this).parent().remove();
            content_id = $(this).parent().attr('data-content-id');
            $('.tab-content').find('#pref'+content_id).remove();
            $('.nav-tabs a:first').tab('show');

        });
        $('body').on('click','.show_more', function(event) {
            var ths = $(this);
            var val = $(this).parents('.product-group').find('.change-product').val();
            var pref_id = $(this).parents('.product-group').attr('data-pref-id');
            $.ajax({
                type: "POST",
                url: "{{ route($route_pre.'.trading.getproductforstock') }}",
                data: {pid:val,pref_id:pref_id,show_more:true},
                success: function (data){
                    console.log(ths.parents('.product-group'));
                    ths.addClass('vk_hide');
                    ths.parents('.product-group').find('.product-nets').append(data.html);
                    return false;
                }
            });
            
        });
        $('body').on('change','.change-product', function(event) {
           
            var ths = $(this);
            var val = $(this).val();
            var pref_id = $(this).parents('.product-group').attr('data-pref-id');
            $.ajax({
                type: "POST",
                url: "{{ route($route_pre.'.trading.getproductforstock') }}",
                data: {pid:val,pref_id:pref_id},
                success: function (data){
                    if(data.show_more == true){
                        ths.parents('.product-group').find('.show_more').removeClass('vk_hide');
                    }
                    ths.parents('.product-group').find('.product-nets').html(data.html);
                    return false;
                }
            });
        });
        
        $('#formsubmit').on('submit', function(event) {
            event.preventDefault();
            $('.has-danger').next().children().children().css({"border": ""});
            $('.is-invalid').removeClass("is-invalid");
            $('.invalid-feedback').html("");
            $('.has-danger').removeClass("has-danger");
            var formData = new FormData($(this)[0]);
            var stockid = {{ $stockid }};
            if(stockid != 0){
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
                    if(data.status == 'success'){
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Sent!', data.message, 'success');
                        setTimeout(function(){
                            window.location.href = "{{ $redirecturl }}";
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
                            console.log(key);
                            var n = key.search(".");
                            var res = key.split(".");
                            if(res.length > 1){
                                key = res[0];
                                for(i=1;i<res.length;i++){
                                    key += "["+res[i]+"]";
                                }
                            }
                            
                            $("[id='"+key+"']").parent().addClass('has-danger');
                            $("[id='"+key+"']").addClass('is-invalid');
                            $("[id='"+key+"']").parent('.has-danger').find('.invalid-feedback').html(value);
                            $('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
                        })
                    }
                }
            });
        });
        
        
        console.log(prefHtml);
        $(".pro-btnAdd").click(function(){
            
            prefHtml = '<div id="pref2-products" class="form-group row"><label class="col-md-2 form-control-label" for="product">Product <span style="color:red">*</span></label><div class="col-md-10"><select class="select2 form-control change-product" data-pref-id="'+tabn+'" name="stock['+tabn+'][product_id]" id="stock['+tabn+'][product_id]" pref-id="0" tabindex="-1" aria-hidden="true">'+selectOpt+'</select> <div class="invalid-feedback"></div>  </div>   </div> <div class="product-nets"></div> <div class="form-group row">                              <label class="col-md-2 form-control-label" for="price">Price per ton <span style="color:red">*</span></label>                              <div class="col-md-10">    <input class="form-control" type="text" name="stock['+tabn+'][price]" id="stock['+tabn+'][price]" placeholder="Price" maxlength="191" value="">                                <div class="invalid-feedback"></div>                             </div>                           </div><div id="pref'+tabn+'-sizerange" class="form-group row"> <label class="col-md-2 form-control-label" for="dry_matter_content">Size Range (mm)</label>     <div class="col-md-10">  <div class="form-group row">    <div class="col-md-2 col-sm-6" style="position:relative">          <label class="form-control-label" for="size_from">From</label>                       <input class="form-control" type="text" pattern="[0-9]*" inputmode="numeric" value="45" placeholder="Min" name="stock['+tabn+'][size_from]" id=""> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>     </div>  <div class="col-md-2 col-sm-6" style="position:relative">     <label class="form-control-label" for="size_to">To</label> <input class="form-control" type="text" pattern="[0-9]*" inputmode="numeric" value="65" placeholder="Max" name="stock['+tabn+'][size_to]" id=""> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>   </div>  </div>  </div></div><div id="pref'+tabn+'-address" class="form-group row"><label class="col-md-2 form-control-label" for="company_name">Loading Address</label>  <div class="col-md-10">  <div class="row">  <div class="col-md-3">     <div class="form-group"><label class="form-control-label" for="city">City <span style="color:red">*</span></label>  <input class="form-control city-control" type="text" name="stock['+tabn+'][city]" id="stock['+tabn+'][city]" placeholder="City" value="" maxlength="191">     <div class="invalid-feedback"></div>  </div>  </div>    <div class="col-md-3">   <div class="form-group">      <label class="form-control-label" for="postalcode">Postal Code <span style="color:red">*</span></label>   <input class="form-control postalcode-control" type="text" name="stock['+tabn+'][postalcode]" id="stock['+tabn+'][postalcode]"  placeholder="Postal Code" value="" maxlength="191">  <div class="invalid-feedback"></div>      </div>        </div><div class="col-md-3">   <div class="form-group">   <label class="form-control-label" for="street">Street Address</label>    <input class="form-control street-control" type="text" name="stock['+tabn+'][street]" id="stock['+tabn+'][street]" placeholder="Street Address" value="" maxlength="191">  </div> </div>  <div class="col-md-3"> <div class="form-group"> <label class="form-control-label" for="country">Country</label> <select class="select2 form-control country-control" name="stock['+tabn+'][country]"  id="stock['+tabn+'][country]" maxlength="191" >'+countryOpt+'</select>  </div>     </div></div></div></div><div id="pref'+tabn+'-show-more" class="form-group row ">      <button type="button" class="btn btn-secondary show_more vk_hide"  style="margin: 0 auto;">Show More</button>  </div>';
           
            $('.nav-tabs').append('<li class="nav-item "><a class="nav-link" data-content-id="'+tabn+'" href="#pref'+tabn+'" data-toggle="tab">Stock #'+tab_key_heading+' <button class="close remove-this-tab" type="button">x</button></a></li>');
            $('.tab-content').append('<div data-pref-id="'+tabn+'" id="pref'+tabn+'" class="tab-pane product-group">'+prefHtml+'</div>');
            tabn++;
            tab_key_heading++;
        });
    });
    
</script>
@endpush
