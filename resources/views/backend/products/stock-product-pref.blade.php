@if(!empty($productSpecRel))
@foreach($productSpecRel as $pKey=>$productSpec)
@if($productSpec['field_type'] == 'dropdown_switchboxes')
  @if($productSpec['hasmany'] == 'No')
    <div class="form-group row mt-3 ml-2 mr-2">
      <label class="col-md-2 form-control-label" for="variety">{{ @$productSpec['name'] }} @if(@$productSpec["required"] == "Yes")<span style="color:red">*</span>@endif</label>
      <div class="col-md-10">
        <select class="select2 form-control" name="specification[{{ $pKey }}]" id="specification[{{ $pKey }}]" maxlength="191" @if(@$productSpec['can_edit'] == "No") disabled="disabled" @endif >
            <option value="">Select {{ @$productSpec['name'] }}</option>
          @foreach($productSpec['options'] as $opt_key=>$option)
            <option {{ (($productSpec["default"] == $opt_key)?"selected":"")}} value="{{$opt_key}}" data-field1="{{ @$productSpecChildRelation[$opt_key]['reference_id'] }}" data-field1-value="{{ @$productSpecChildRelation[$opt_key]['value'] }}">{{$option}}</option>
          @endforeach
          </select>
      </div>
    </div>
	@else

	<div class="form-group row entity mt-3 ml-2 mr-2">
    @if(isset($productSpec['options']))
    @if(count($productSpec['options']) > 0)
    @php $option_key_num = 0; @endphp
    <label class="col-md-12 form-control-label" for="purposes"><strong>{{ @$productSpec['name'] }} @if(@$productSpec["required"] == "Yes")<span style="color:red">*</span>@endif</strong></label>
	<div class="col-md-12">
	<div class="row app-head-group-entity">
		@foreach($productSpec['options'] as $key => $option)
		@php $option_key = str_slug($option['name'], "_"); @endphp
			<div class="flex_item ">
				<div class="checkbox switch-box d-flex align-items-center">
						{{ html()->label(
						html()->checkbox('specification['.$pKey.']['.$option_key_num.']', in_array($key, $productSpec['default']??array()), $key)
						->class('switch-input switch_select_item')
						->attribute('data-group','entity')
						->id($option_key)
						. '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
						->class('switch switch-label switch-pill switch-primary mr-2')
						->for($option_key)
						}}
               @if(!empty(@$option['ec']))
                  @if(!empty(@$ecs[$pKey][$key]))
                     @php $ecs_value = $ecs[$pKey][$key]; @endphp
                  @else
                     @php $ecs_value = @$option['ec'];   @endphp
                  @endif
                  <input type="text" name="ecs[{{ $pKey }}][{{$option_key_num}}]" value="{{ $ecs_value}}" class="form-control w-25" />
               @endif

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
@elseif($productSpec['field_type'] == 'inputfield')
    <div class="form-group row mt-3 ml-2 mr-2">
        {{ html()->label($productSpec['name'])->class('col-md-2 form-control-label') }}
        <div class="col-md-10">
            {{ html()->text('specification['.$pKey.']')
                ->class('select2 form-control')
                ->attribute('maxlength', 191)
            }}
        </div>
    </div>
@elseif($productSpec['field_type'] == 'optionrange')
    <div class="form-group row mt-3 ml-2 mr-2">
      {{ html()->label('Size Range (mm)')->class('col-md-2 form-control-label') }}
      <div class="col-md-10">
        <div class="form-group row">
          <div class="col-md-2 col-sm-6" style="position:relative">
            <label class="form-control-label" for="size_from">From</label>
            <input class="form-control" type="text" value="{{@$stock->size_from ?? '45'}}" placeholder="Min" name="specification[{{ $pKey }}][size_from]"  /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
          </div>
          <div class="col-md-2 col-sm-6" style="position:relative">
            <label class="form-control-label" for="size_to">To</label>
            <input class="form-control" type="text" value="{{@$stock->size_to ?? '65'}}" placeholder="Max" name="specification[{{ $pKey }}][size_to]"  /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
          </div>
        </div>
      </div><!--col-->
    </div><!--form-group-->
@endif
@endforeach
@endif