@extends('backend.layouts.app')
@section('title', __('Edit Trade Settings').' :: '.app_name())
@section('content')
{{ html()->form('POST')->id('formsubmit')->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
          Edit Trade Settings
          <small class="text-muted"></small>
        </h4>
      </div><!--col-->
    </div><!--row-->
    <hr>
    <div class="row mt-4 mb-4">
      <div class="col">

        <div class="form-group row">
          {{ html()->label(__('Name <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('Name') }}
          <div class="col-md-10">
            {{ html()->text('name')
            ->class('form-control')
            ->placeholder(__('Name'))
            ->value($apphead->name)
            ->attribute('maxlength', 191)
            }}
            <div class="invalid-feedback"></div>
          </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
          {{ html()->label(__('Product <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('Type') }}
          <div class="col-md-10">
            {{ html()->select('product_id')
              ->class('select2 form-control')
              ->options(products_list())
              ->value(@$apphead->product_id)
              ->placeholder(__('Select Product'))
              ->attribute('maxlength', 191)
            }}
            <div class="invalid-feedback"></div>
          </div><!--col-->
        </div>

        @php
        $types = array("product" => "Product", "potato_variety" => "Potato Variety","packaging" => "Packaging","purpose" => "Purpose","defects" => "Defects","flesh_color" => "Flesh color","soil" => "Soil","trust_level"=>"Trust Level");
        @endphp
        <div class="form-group row">
          {{ html()->label(__('Type <span style="color:red">*</span>'))->class('col-md-2 form-control-label')->for('Type') }}
          <div class="col-md-10">
            {{ html()->select('type')
            ->class('form-control')
            ->options($types)
            ->placeholder(__('Select Type'))
            ->attribute('maxlength', 191)
            ->attribute('onchange', 'fetch_select(this.value)')
            ->value($apphead->type)
          }}
          <div class="invalid-feedback"></div>
        </div><!--col-->
      </div>
		
		<div id="FleshColorParent" style="display:none">
			<div class="form-group row">
			  {{ html()->label(__('Parent'))->class('col-md-2 form-control-label')->for('desc') }}
			  <div class="col-md-10">
				{{ html()->select('parent_ref')
				->class('select2 form-control')
				->options(color_list())
				->attribute('maxlength', 191)
				->value(@$apphead->parent_ref)
				->placeholder(__('Select Parent'))
			  }}
			</div>
		  </div>
      </div>
	  
      <div id="FleshColor" style="display:none">
        <div class="form-group row">
          {{ html()->label(__('Flesh Color'))->class('col-md-2 form-control-label')->for('desc') }}
          <div class="col-md-10">
            {{ html()->select('color_id')
            ->class('select2 form-control')
            ->options(color_list())
            ->value($apphead->color_id)
            ->attribute('maxlength', 191)
          }}
        </div>
      </div>

      <div class="form-group row">
        {{ html()->label(__('Tuber Shape'))->class('col-md-2 form-control-label')->for('tuber_shape') }}
        <div class="col-md-10">
          {{ html()->text('tuber_shape')
          ->class('form-control')
          ->placeholder(__('Tuber Shape'))
          ->attribute('maxlength', 191)
          ->value($apphead->tuber_shape)
        }}
      </div><!--col-->
    </div><!--form-group-->

    <div class="form-group row">
      {{ html()->label(__('Colour of Skin'))->class('col-md-2 form-control-label')->for('colour_of_skin') }}
      <div class="col-md-10">
        {{ html()->text('colour_of_skin')
        ->class('form-control')
        ->placeholder(__('Colour of Skin'))
        ->attribute('maxlength', 191)
        ->value($apphead->colour_of_skin)
      }}
    </div><!--col-->
  </div><!--form-group-->

  <div class="form-group row">
    {{ html()->label(__('Depth of Eyes'))->class('col-md-2 form-control-label')->for('depth_of_eyes') }}
    <div class="col-md-10">
      {{ html()->text('depth_of_eyes')
      ->class('form-control')
      ->placeholder(__('Depth of Eyes'))
      ->attribute('maxlength', 191)
      ->value($apphead->depth_of_eyes)
    }}
  </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
  {{ html()->label(__('Smoothness of Skin'))->class('col-md-2 form-control-label')->for('smoothness_of_skin') }}
  <div class="col-md-10">
    {{ html()->text('smoothness_of_skin')
    ->class('form-control')
    ->placeholder(__('Smoothness of Skin'))
    ->attribute('maxlength', 191)
    ->value($apphead->smoothness_of_skin)
  }}
</div><!--col-->
</div><!--form-group-->

<div class="form-group row">
  {{ html()->label(__('Dry Matter %'))->class('col-md-2 form-control-label')->for('dry_matter') }}
  <div class="col-md-2">
    <input type="number" name="dry_matter" value="{{$apphead->dry_matter}}" data-decimals="2" min="0" max="100" step="0.1"/>
  </div><!--col-->
</div><!--form-group-->



</div>

<div class="form-group row">
  {{ html()->label(__('baseline price per ton in PLN'))->class('col-md-2 form-control-label')->for('base_price') }}
  <div class="col-md-2">
    <input type="number" id="base_price" value="{{$apphead->base_price}}" name="base_price" value="0" data-decimals="0" step="1"/>
  </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
  {{ html()->label(__('Premium %'))->class('col-md-2 form-control-label')->for('premium') }}
  <div class="col-md-2">
    <input type="number" id="premium" value="{{$apphead->premium}}" name="premium" value="0" data-decimals="0" min="-20" max="20" step="1"/>
  </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
  {{ html()->label(__('Volume Factor %'))->class('col-md-2 form-control-label')->for('volume') }}
  <div class="col-md-2">
    <input type="number" id="volume" value="{{$apphead->volume}}" name="volume" value="0" data-decimals="0" min="-20" max="20" step="1"/>
  </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
  {{ html()->label('Make Default ?')->class('col-md-2 form-control-label')->for('email') }}
  <div class="col-md-10">
    <div class="checkbox d-flex align-items-center">
      {{ html()->label(
        html()->checkbox('default', in_array($apphead->default, array('1')), 1)
        ->class('switch-input')
        ->id('default')
        . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
        ->class('switch switch-label switch-pill switch-success mr-2')
        ->for('default') }}
      </div>
    </div>
  </div>

<div class="form-group row">
  {{ html()->label('Active')->class('col-md-2 form-control-label')->for('active') }}
  <div class="col-md-10">
    <div class="checkbox d-flex align-items-center">
      {{ html()->label(
        html()->checkbox('is_active', in_array($apphead->is_active, array('1')), 1)
        ->class('switch-input')
        ->id('active')
        . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
        ->class('switch switch-label switch-pill switch-success mr-2')
        ->for('active') }}
      </div>
    </div>
  </div>
    @php 
    $is_checked = ($apphead->extra_supply_cost == NULL?0:1); 
    $is_disabled = ($apphead->extra_supply_cost == NULL?'disabled':'');@endphp
  <div class="form-group row">
      {{ html()->label(__('Extra Supply Cost'))->class('col-md-2 form-control-label')->for('Name') }}
      <div class="col-md-3">
        {{ html()->text('extra_supply_cost')
          ->class('form-control')
          ->id('extra_supply_cost')
          ->placeholder(__('Extra Supply Cost'))
          ->attribute('maxlength', 191) 
          ->attribute($is_disabled) 
          ->value($apphead->extra_supply_cost)
        }} </div>
        <div class="col-md-3">
        {{  html()->label(
        html()->checkbox('enable_extra_supply_cost', $is_checked, '1')
        ->class('switch-input')
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
          ->attribute('maxlength', 191)
          ->value($apphead->extra_cost_to_buyer_factor)
        }}
        <div class="invalid-feedback"></div>
      </div><!--col-->
    </div><!--form-group-->
    
  
  <div class="form-group row" id="Description">
    {{ html()->label(__('Description'))->class('col-md-2 form-control-label')->for('Description') }}
    <div class="col-md-10">
      {{ html()->textarea('desc')
      ->class('form-control')
      ->placeholder(__('Description'))
      ->value($apphead->desc)
      ->attribute('maxlength', 191)
    }}
  </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
  {{ html()->label('Example Image')->class('col-md-2 form-control-label')->for('image') }}
  <div class="col-md-10">
    @if($apphead->image)
    <a href="{{ asset('images/stock/'.$apphead->image) }}" target="_blank" class="mb-2" style="width:200px; display: block;height:200px; background:url('{{ asset('images/stock/'.$apphead->image) }}');background-size:cover"></a>
    @endif
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

</div><!--col-->
</div><!--row-->
</div><!--card-body-->

<div class="card-footer clearfix">
  <div class="row">
    <div class="col">
      {{ form_cancel(route('admin.appheads.index'), __('buttons.general.cancel')) }}
    </div><!--col-->

    <div class="col text-right">
      {{ form_submit(__('buttons.general.crud.update')) }}
    </div><!--col-->
  </div><!--row-->
</div><!--card-footer-->
</div><!--card-->
{{ html()->form()->close() }}
@endsection

@php  $url = route('admin.appheads.update', $apphead->id);  @endphp

@push('after-scripts')
<script type="text/javascript">
 
 $(document).ready(function() {
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
			var formData = new FormData($(this)[0]);
			formData.append('_method', 'PUT');
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
							window.location.href = "{{ url('admin/appheads?typename=') }}"+data.typename;
						}, 5000);
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
						})
					}
				}
			});
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
	});
$(function() {
  var val = $('#type').val();
  fetch_select(val);
});
function fetch_select(val){
  if(val == 'potato_variety'){
    $('#Description').hide();
    $('#FleshColor').show();
  }else if(val == 'flesh_color'){
	$('#FleshColorParent').show();
	$('#Description').show();
  }else{
    $('#Description').show();
    $('#FleshColor').hide();
  }
}
</script>
@endpush
