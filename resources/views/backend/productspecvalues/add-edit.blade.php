@extends('backend.layouts.app')

@if(!empty($productspecvalue->id))
    @section('title', __('menus.backend.trading.productspecvalues.edit') . ' :: ' . app_name())
@else
    @section('title', __('menus.backend.trading.productspecvalues.create') . ' :: ' . app_name())
@endif


@section('content')
    {{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @if(!empty($productspecvalue->id))
                                @lang('menus.backend.trading.productspecvalues.edit')
                            @else 
                                @lang('menus.backend.trading.productspecvalues.create')
                            @endif    
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
                                    ->value(@$productspecvalue->product_id)
                                    ->attribute('maxlength', 191)
                                    ->attribute('placeholder', 'Select Product')
                                    ->attribute('onchange', 'loadAttr(this.value)')
                                   
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->
						
                        <div class="form-group row">
                            {{ html()->label(__('Product Specification <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('product_specification_id') }}
                            <div class="col-md-10">
                                {{ html()->select('product_specification_id')
                                    ->class('select2 form-control')
                                    ->options(array(''=>'Select'))
                                    ->value(@$productspecvalue->product_specification_id)
                                    ->attribute('maxlength', 191)
                                    ->attribute('data-id', @$productspecvalue->product_specification_id)
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label(__('Name <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('Value') }}
                            <div class="col-md-10">
                                {{ html()->text('value')
                                    ->class('form-control')
                                    ->value(@$productspecvalue->value)
                                    ->attribute('maxlength', 191)
                                 }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="child-items"></div>
                        <!--childern-->
                        <div class="rules-section">

                          @if( isset($productschildvalue[0]->value) || isset($productschildvalue[0]->image) || isset($productschildvalue[0]->numeric_value) )
                                  @php $i=0; @endphp
                            @foreach( $productschildvalue as $producteditvalue )

                             <div class="form-group row rules-section-block">
                              
                                 @php  $i++;  @endphp 
                                 @php   if( $i==1 ){  @endphp

                                {{ html()->label('childrens')->class('col-md-2 form-control-label')->for('rules') }}
                                 @php  } else{  echo '<div class="col-md-2">&nbsp</div>'; } @endphp
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="childs[{{$i}}][name]"  placeholder="Name" value="{{$producteditvalue['value']}}">
                                    </div>

                                    <div class="col-md-2"> 
                                       <input type="text" class="form-control" name="childs[{{$i}}][numeric_value]"  placeholder="Numeric Value" value="{{$producteditvalue['numeric_value']}}">
                                    </div>

                                    <div class="col-md-2">
                                        <input type="file" class="form-control" name="childs[{{$i}}][image]" value="{{$producteditvalue['image']}}">

<input type="hidden" class="form-control" name="childs[{{$i}}][id]" value="{{$producteditvalue['id']}}">

                                    </div>
                                    @php 
                                    if($i==1) { @endphp 
                                     <div class="col-md-2">
                                        <input type="button" class="rule-add btn btn-primary" value="Add" id="childrens"/>
                                    </div>
                                    @php } else { @endphp 
                                    <div class="col-md-2">
                                        <input type="button" class="rule-remove btn btn-danger" value="Remove" id="childrens"/>
                                    </div>
                                @php } @endphp
                            </div>

                            @endforeach
                                   
                           @else

                            <div class="form-group row rules-section-block">
                                {{ html()->label('childrens')->class('col-md-2 form-control-label')->for('rules') }}

                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="childs[0][name]"  placeholder="Name">
                                </div>
                                <div class="col-md-2"> 
                                   <input type="text" class="form-control" name="childs[0][numeric_value]"  placeholder="Numeric_values">
                                </div>
                                <div class="col-md-2">
                                    <input type="file" class="form-control" name="childs[0][image]" >
                                </div>
                                <div class="col-md-2">
                                    <input type="button" class="rule-add btn btn-primary" value="Add" id="childrens"/>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('Premium %'))->class('col-md-2 form-control-label')->for('premium') }}
                            <div class="col-md-2">
                                <input type="number" id="premium" name="premium" value="{{@$productspecvalue->premium}}" data-decimals="0" min="-20" max="20" step="1"/>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('Volume Factor %'))->class('col-md-2 form-control-label')->for('volume') }}
                            <div class="col-md-2">
                                <input type="number" id="volume" name="volume" value="{{@$productspecvalue->volume}}" data-decimals="0" min="-20" max="20" step="1"/>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Make Default ?')->class('col-md-2 form-control-label')->for('default') }}
                            <div class="col-md-10">
                                <div class="checkbox d-flex align-items-center">
                                @if(!empty($productspecvalue->id))
                                    @php 
                                        if($productspecvalue->default == 1){
                                            $is_checked = '1';
                                        }else{
                                            $is_checked = '0';
                                        }
                                    @endphp
                                @else
                                    @php $is_checked = '0'; @endphp
                                @endif
                                {{ html()->label(
                                    html()->checkbox('default', $is_checked, $is_checked)
                                    ->class('switch-input pref_check')
                                    ->id('default')
                                    . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                                    ->class('switch switch-label switch-pill switch-success mr-2')
                                    ->for('default') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ html()->label('Status')->class('col-md-2 form-control-label')->for('status') }}
                            <div class="col-md-10">
                                <div class="checkbox d-flex align-items-center">
                                @if(!empty($productspecvalue->id))
                                    @php 
                                        if($productspecvalue->status == 1){
                                            $is_checked = '1';
                                        }else{
                                            $is_checked = '0';
                                        }
                                    @endphp
                                @else
                                    @php $is_checked = '1'; @endphp
                                @endif
                                {{ html()->label(
                                    html()->checkbox('status', $is_checked, $is_checked)
                                    ->class('switch-input pref_check')
                                    ->id('status')
                                    . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                                    ->class('switch switch-label switch-pill switch-success mr-2')
                                    ->for('status') }}
                                </div>
                            </div>
                        </div>
                        @if(!empty($productspecvalue->id))
                            @php 
                                if($productspecvalue->extra_supply_cost == 1){
                                    $is_checked = '1';
                                }else{
                                    $is_checked = '0';
                                }
                            @endphp
                        @else
                            @php 
                                $is_checked = '0';
                            @endphp
                        @endif
                        @php $is_disabled = (@$productspecvalue->extra_supply_cost == NULL?'disabled':'');@endphp
                        <div class="form-group row">
                            {{ html()->label(__('Extra Supply Cost'))->class('col-md-2 form-control-label')->for('Name') }}
                            <div class="col-md-3">
                                {{ html()->text('extra_supply_cost')
                                ->class('form-control')
                                ->id('extra_supply_cost')
                                ->value(@$productspecvalue->extra_supply_cost)
                                ->placeholder(__('Extra Supply Cost'))
                                ->attribute('maxlength', 191) 
                                ->attribute($is_disabled) 
                                ->value(@$productspecvalue->extra_supply_cost)
                                }} 
                            </div>
                            <div class="col-md-3">
                                {{  html()->label(
                                html()->checkbox('enable_extra_supply_cost', $is_checked, $is_checked)
                                ->class('switch-input pref_check')
                                ->id('enable_extra_supply_cost')
                                . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                                ->class('switch switch-label switch-pill switch-success mr-2')
                                ->for('enable_extra_supply_cost') }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('Extra Cost To Buyer Factor'))->class('col-md-2 form-control-label')->for('Name') }}
                            <div class="col-md-3">
                                {{ html()->text('extra_cost_to_buyer_factor')
                                    ->class('form-control')
                                    ->placeholder(__('Buyer Factor'))
                                    ->value(@$productspecvalue->extra_cost_to_buyer_factor)
                                    ->attribute('maxlength', 191) 
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label(__('EC'))->class('col-md-2 form-control-label')->for('ec') }}
                            <div class="col-md-3">
                                {{ html()->text('ec')
                                    ->class('form-control')
                                    ->placeholder(__('EC'))
                                    ->value(@$productspecvalue->ec)
                                    ->attribute('maxlength', 191) 
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('ECBF'))->class('col-md-2 form-control-label')->for('ecbf') }}
                            <div class="col-md-3">
                                {{ html()->text('ecbf')
                                    ->class('form-control')
                                    ->placeholder(__('ECBF'))
                                    ->value(@$productspecvalue->ecbf)
                                    ->attribute('maxlength', 191) 
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="form-group row" id="Description">
                            {{ html()->label(__('Description'))->class('col-md-2 form-control-label')->for('Description') }}
                            <div class="col-md-10">
                                {{ html()->textarea('description')
                                    ->class('form-control')
                                    ->placeholder(__('Description'))
                                    ->attribute('maxlength', 191)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                       
                        
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
                        <div class="form-group row">
                            {{ html()->label(__('Related Spec Id'))->class('col-md-2 form-control-label')->for('	related_spec_id') }}
                            <div class="col-md-3">
                                {{ html()->text('related_spec_id')
                                    ->class('form-control')
                                    ->placeholder(__('Related Spec Id'))
                                    ->value(@$productspecvalue->related_spec_id)
                                    ->attribute('maxlength', 191) 
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        <div class="form-group row">
                            {{ html()->label(__('Related Spec Val Id'))->class('col-md-2 form-control-label')->for('	related_spec_val_id') }}
                            <div class="col-md-3">
                                {{ html()->text('related_spec_val_id')
                                    ->class('form-control')
                                    ->placeholder(__('Related Spec Val Id'))
                                    ->value(@$productspecvalue->related_spec_val_id)
                                    ->attribute('maxlength', 191) 
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                        </div>
                        @php 
                        $arrayTags = explode(',',@$productspecvalue->tags);
                        //dd($arrayTags);
                        @endphp
                        <div class="form-group row">
                    {{ html()->label(__('Tags <span style="color:red"></span>'))->class('col-md-2 form-control-label') }}
                    @php $definedTags = array('Market', 'Processing', 'Checkbox', 'Radio', 'Class1','Class2'); @endphp
                    <div class="col-md-10">
                        <select class="select2 form-control" name="tags[]" id="tags[]" maxlength="191" placeholder="Select Tag" multiple="multiple">
                        @foreach($definedTags as $tag)
                        <option value="{{$tag}}"  <?php if(in_array($tag, $arrayTags)){ echo "selected";} ?>>{{$tag}} </option>
                        @endforeach
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
                                    ->value(@$productspecvalue->shortcode)
                                    ->attribute('maxlength', 191) 
                                }}
                                <div class="invalid-feedback"></div>
                            </div><!--col-->
                </div>
                        
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.productspecvalues.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->
                    <div class="col text-right">
                    @if(!empty($productspecvalue->id))
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    @else
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    @endif
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
    @if(!empty($productspecvalue->id))
        @php 
            $url =  route('admin.productspecvalues.update', $productspecvalue->id); 
            $redirect_url = route('admin.productspecvalues.index');
        @endphp
    @else
        @php 
            $url = route('admin.productspecvalues.store');
            $redirect_url = route('admin.productspecvalues.index');
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
       
    $(document).ready(function(){
        var pid = $("#product_id").val();
        loadAttr(pid);
    });
    
    var json = @json($productSpecRel);
    var psc_json = @json(@$product_specification_children);
    function loadAttr(id){
        var values = '<option value="">Select</option>';
        jQuery.each(json[id],function(key,value){
            values += '<option value="'+key+'">'+value['name']+'</option>';
        });
        $('#product_specification_id').html(values);
        $('#product_specification_id').val($("#product_specification_id").attr("data-id"));
        $('#product_specification_id').select2().trigger('change');
    }
    
    $("#product_specification_id").change(function(){
        var pid = $("#product_id").val();
        var psid = $(this).val();
        $(".child-items").html('');
        $.ajax({
            url: "{{ route('admin.trading.getproductspecvals') }}",
            method: 'POST',
            data: {product_spec_id:psid,product_id:pid},
            dataType: "json",
            success: function(data)
            {
                var values = '<option value="">Select</option>';
                jQuery.each(data,function(key,value){
                    values += '<option value="'+key+'">'+value+'</option>';
                });
                $('#parent_id').html(values);
                $('#parent_id').select2().trigger('change');
            }
        });
            
        if(typeof json[pid][psid] !== 'undefined'){
           jQuery.each(json[pid][psid]['children'],function(key,value){
               if (isNaN(key)) {
                    if(typeof psc_json[value.children_id] !== 'undefined'){
                        var selected_val = psc_json[value.children_id];
                    } else { var selected_val = ''; }
                    var values = '<option value="">Select</option>';
                    jQuery.each(value,function(keyval,val){
                        if(val.value){
                            if(val.value == selected_val){
                                is_selected = 'selected';
                            } else { is_selected = ''; }
                            values += '<option '+is_selected+' value="'+val.value+'">'+val.value+'</option>';
                        }
                    });
                    var select = '<select id="'+key.replace(/\s/g, '')+'" class="form-control" name="child_items['+value.children_id+']" >'+values+'</select>'
                    $(".child-items").append('<div class="form-group row"><label class="col-md-2 form-control-label" for="Value">'+key+'</label><div class="col-md-10">'+select+' <div class="invalid-feedback"></div></div> </div>');                   
                    $('#'+key.replace(/\s/g, '')).select2().trigger('change');
                }else{
                    if(typeof psc_json[key] !== 'undefined'){
                        val = psc_json[key];
                    } else { val = ''; }
                   
                    $(".child-items").append('<div class="form-group row"><label class="col-md-2 form-control-label" for="Value">'+value+'</label><div class="col-md-10"> <input class="form-control" type="text" name="child_items['+key+']" id="value" value="'+val+'" maxlength="191"> <div class="invalid-feedback"></div></div> </div>');                   
                }
            });
        }
    });
    
    
	$("#enable_extra_supply_cost").click(function(){
        state = $(this).prop('checked');
        if(state == true){
            $("#extra_supply_cost").prop('disabled', false);
            $("#extra_supply_cost").val('');
        } else {
            $("#extra_supply_cost").prop('disabled', true);
            $("#extra_supply_cost").val('');
        }
    });
		
    $('#formsubmit').on('submit', function(event) {
        event.preventDefault();
        
        $('.has-danger').next().children().children().css({"border": ""});
        $('.is-invalid').removeClass("is-invalid");
        $('.invalid-feedback').html("");
        $('.has-danger').removeClass("has-danger");

        var formData = new FormData(this);
        var productspecid = '{{ @$productspecvalue->id }}';
        $( ".pref_check" ).each(function( key, value ) {
            if(value.value == 0){
                formData.append(value.name, value.value);
            }
        });
        if(productspecid != '')
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
                        window.location.href = "{{ $redirect_url }}"; 
                    }, 5000);
                }
                if(data.status == 'error'){
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
                    })
                }
            }
        });
    });
    
    $('body').on('click', '.pref_check', function(){
        if(this.checked){
            $(this).val('1');
            $(this).attr('checked','checked');
        }else{
            $(this).val('0');
            $(this).removeAttr('checked');
        }
    })

    let k=100;
    $('body').on('click', '.rule-remove',function(event){
        $(this).parents('.rules-section-block').remove();  
    });

 
    $('#childrens').on('click', function(event){
        $('.rules-section').append('<div class="form-group row rules-section-block"><label class="col-md-2 form-control-label" for="rules">&nbsp;</label><div class="col-md-2">'+
        '<input type="text" class="form-control" name="childs['+k+'][name]" id="name'+k+'" placeholder="Name">'+
            '</div>'+
            '<div class="col-md-2">'+ 
               '<input class="form-control" type="text" name="childs['+k+'][numeric_value]" id="numeric_values'+k+'" placeholder="Numeric_values">'+
            '</div>'+
            '<div class="col-md-2">'+
                '<input type="file" class="form-control" name="childs['+k+'][image]" id="image'+k+'">'+
            '</div>'+
            '<div class="col-md-2">'+
                '<input type="button" class="rule-remove btn btn-danger" value="Remove" id="childrens"/>'+
            '</div>'+
            '</div>');
        k++;
    })
</script>
@endpush