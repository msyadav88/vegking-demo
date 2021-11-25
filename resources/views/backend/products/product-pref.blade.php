@if(!empty($productSpecRel))
@foreach($productSpecRel as $pKey=>$productSpec)
	@if($productSpec['hasmany'] == 'No')
	@if(@$productSpec["required"] == "Yes")
		@php $validation = "required"; @endphp
	@else
		@php $validation = ""; @endphp
	@endif
		<div class="form-group row">
		<label class="col-md-2 form-control-label" for="variety">{{ @$productSpec['name'] }} @if(@$productSpec["required"] == "Yes")<span style="color:red">*</span>@endif</label>
			<div class="col-md-10">
				{{ html()->select('specification['.$pKey.']')
					->class('select2 form-control')
					->options($productSpec['options'])
					->value(@$buyerProductPref->variety)
					->attribute('maxlength', 191)
					->attribute($validation)
				}}
				<div class="invalid-feedback"></div>
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
		@php $option_key = 'specification'.$option['id']; @endphp
			<div class="flex_item purpose_item form-group">
				<div class="checkbox switch-box d-flex align-items-center">
						{{ html()->label(
						html()->checkbox('specification['.$pKey.']['.$option_key_num.']', in_array($key, array(1)), $key)
						->class('switch-input switch_select_item')
						->attribute('data-group','purpose')
						->id($option_key)
						. '<div class="invalid-feedback"></div><span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
						->class('switch switch-label switch-pill switch-primary mr-2')
						->for($option_key)
						}}

					<input type="number" name="premium[{{$key}}]" value="{{$purposes_list_selected["$key"] ?? 0}}" data-decimals="0" min="-15" max="15" step="1"/>

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
