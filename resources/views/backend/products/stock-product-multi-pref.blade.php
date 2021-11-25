@if(!empty($productSpecRel))
@php $i=0 @endphp
@foreach($productSpecRel as $pKey=>$productSpec)
@php $i = $i+1 @endphp
	@if($productSpec['hasmany'] == 'No')
		<div class="form-group row @if($i>3) more @endif">      
			{{ html()->label($productSpec['name'])->class('col-md-2 form-control-label')->for('variety') }}
			<div class="col-md-10">
				{{ html()->select('specification['.$pref_id.']['.$pKey.']')
					->class('select2 form-control')
					->options($productSpec['options'])
					->value(@$productSpec['default'])
					->attribute('maxlength', 191)
				}}
			</div>
		</div>
	@else
	<div class="form-group row app-head-group-outer @if($i>3) more @endif">
    @if(isset($productSpec['options']))
   @if(count($productSpec['options']) > 0)
    @php $option_key_num = 0; @endphp   
	{{ html()->label('<strong>'.$productSpec['name'].'</strong>')->class('col-md-12 form-control-label')->for('purposes') }}
	<div class="col-md-12">
    @if($productSpec['buyer_pref_anylogic'] == 'Yes')
    <div class="row app-head-group">
        <div class="flex_item form-group" style="width:100%">
            <div class="checkbox switch-box d-flex align-items-center">
                <label class="switch switch-label switch-pill switch-primary mr-2" for="app_head_group{{ $pKey}}">
                    <input class="switch-input any_type_selected" type="checkbox" data-group="app_head_group{{ $pKey}}" id="app_head_group{{ $pKey}}">
                    <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
                </label>
                <label class="flex-1" for="app_head_group{{ $pKey}}">Any</label>
            </div>
        </div>
    </div>
    @endif
   @if(count($productSpec['options']) > 12)
         <div class="flex_item form-group accept_all" style="width:100%">
            <div class="checkbox switch-box d-flex align-items-center">
                <label class="switch switch-label switch-pill switch-primary mr-2" for="app_head_group_{{ $pref_id}}_{{ $pKey}}">
                    <input name="accept_all[{{$pref_id}}][{{$pKey}}]" class="switch-input any_type_selected 12" type="checkbox" data-group="app_head_group_{{ $pref_id}}_{{ $pKey}}" id="app_head_group_{{ $pref_id}}_{{ $pKey}}" @if(in_array('all', $productSpec['default']??array())) checked="" @endif >
                    <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
                </label>
                <label class="flex-1" for="app_head_group{{ $pKey}}">Accept All </label>
            </div>
        </div>
      <div class="row">
      <div class="col-xl-10 col-lg-8">
         <select class="form-control select2" name="specification[{{$pref_id}}][{{$pKey}}][]" multiple="multiple" data-placeholder="{{$productSpec['name']}}">
            @php $premium_key = 0; @endphp
            @foreach($productSpec['options'] as $key => $option)
               @if(in_array($key, $productSpec['default']??array()))
                  @php $premium_key = $key; @endphp
               @endif
              <option value="{{$key}}" @if(in_array($key, $productSpec['default']??array())) selected @endif>{{ $option['name']}}</option>
            @endforeach
         </select>
      </div>
      <div class="col-xl-2 col-lg-4">
         <input type="number" name="premium_single[{{ $pref_id }}][{{$pKey}}]" value="{{@$productSpec['options'][@$premium_key]['premium']?? 0}}"  data-decimals="0" min="-15" max="15" step="1"/>
      </div>
   </div>
   @else
	<div class="row app-head-group-purpose">
		@foreach($productSpec['options'] as $key => $option)
		@php $option_key = str_slug($option['name'], "_"); @endphp
			<div class="flex_item purpose_item form-group">
				<div class="checkbox switch-box d-flex align-items-center switch_select_sub_item">
						{{ html()->label(
						html()->checkbox('specification['.$pref_id.']['.$pKey.']['.$option_key_num.']', in_array($key, $productSpec['default']??array()), $key)
						->class('switch-input switch_select_sub_item_cb')
						->attribute('data-group','purpose')
						->id($option_key.'_'.$pref_id.'_'.$key)
						. '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
						->class('switch switch-label switch-pill switch-primary mr-2')
						->for($option_key.'_'.$pref_id.'_'.$key)
						}}
					<input type="number" name="premium[{{ $pref_id }}][{{$key}}]" value="{{@$option['premium']?? 0}}"  data-decimals="0" min="-15" max="15" step="1"/>
					{{ html()->label(ucwords($option['name']))->for($option_key.'_'.$pref_id.'_'.$key)->class('flex-1') }}
				</div>
			</div>
            @php $option_key_num++; @endphp
		@endforeach
	</div>
   @endif
	</div>
    @endif
    @endif
	</div>
	@endif  
@endforeach
@if($i>3)
<div class="form-group row">
<button type="button" class="btn btn-sm btn-success mt-2 myBtn showmore" data-container="body" data-content="The given data was invalid." onclick="showMorePref($(this))" id="myBtn">Show more</button>
</div>
@endif
<div class="form-group row">
      {{ html()->label('Delivery Address')->class('col-md-2 form-control-label')->for('company_name') }}
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('delivery_city') }}
              {{ html()->text('delivery_city['.$pref_id.']')->class('form-control')->placeholder('City')->value(@$productProdRel[$pref_id][delivery_city])->attribute('maxlength', 191) }}
              <div class="invalid-feedback"></div>
            </div>
          </div><!--col-->

          <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('delivery_postalcode') }}
              {{ html()->text('delivery_postalcode['.$pref_id.']')->class('form-control')->placeholder('Postal Code')->value(@$productProdRel[$pref_id][delivery_postalcode])->attribute('maxlength', 191) }}
              <div class="invalid-feedback"></div>
            </div>
          </div><!--col-->

          <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('Street Address')->class('form-control-label')->for('delivery_street') }}
              {{ html()->text('delivery_street['.$pref_id.']')->class('form-control')->placeholder('Street Address')->value(@$productProdRel[$pref_id][delivery_street])->attribute('maxlength', 191) }}
            </div>
          </div><!--col-->

          <div class="col-md-3">
            <div class="form-group">
              {{ html()->label('Country')->class('form-control-label')->for('delivery_country') }}
              {{ html()->select('delivery_country['.$pref_id.']')
                ->class('select2 form-control')
                ->options(country_list())
                ->value(@$productProdRel[$pref_id][delivery_country] ?? 'UK')
                ->attribute('maxlength', 191)
              }}
            <!--{{ html()->text('country')->value('PL')->class('form-control')->placeholder('Country')->attribute('maxlength', 191)->attribute('onblur', 'changeRequered()')->required() }}-->
            </div>
          </div><!--col-->
        </div><!--form-group-->
      </div>
    </div>
@if(isset($productSpec['isfilter_type']) && $productSpec['isfilter_type']=='optionrange')
<div class="form-group row">
{{ html()->label('<strong>Size ranges</strong>')->class('col-md-12 form-control-label')->for('size_ranges_'.$pref_id) }}
	<div id="size_ranges_{{$pref_id}}" class="col-md-12" style="padding-bottom:40px; position:relative">
		<div class="r-group_{{$pref_id}} form-group row">
		<div class="col-md-3">
			<label class="form-control-label">Min</label>
			<input class="form-control" type="text" value="40" placeholder="From" name="size_range[0][from]" id="size_range_0_from" data-pattern-name="size_range[++][from]" data-pattern-id="size_range_++_from" />
		</div>
		<div class="col-md-3">
			<label class="form-control-label">Max</label>
			<input class="form-control" type="text" value="80" placeholder="to" name="size_range[0][to]" id="size_range_0_to" data-pattern-name="size_range[++][to]" data-pattern-id="size_range_++_to" />
		</div>
		<div class="col-md-3">
			<label class="form-control-label">Premium</label>
			<input class="form-control" type="number" name="size_range[0][premium]" id="size_range_0_premium" data-pattern-name="size_range[++][premium]" data-pattern-id="size_range_++_premium" value="0" data-decimals="0" min="-10" max="10" step="1"/>
		</div>
		<div class="col-md-3">
			<label class="form-control-label d-block">&nbsp;</label>
			<button type="button" class="r-btnRemove_{{$pref_id}} btn btn-danger btn-md">Remove -</button>
		</div>
		</div>
		<button style="position:absolute; bottom:0px; left:15px;" type="button" class="r-btnAdd_{{$pref_id}} btn btn-success btn-md">Add +</button>
	</div>
</div>
<script>
$(function() {

   $('#size_ranges_{{$pref_id}}').repeater({
     btnAddClass: 'r-btnAdd_{{$pref_id}}',
     btnRemoveClass: 'r-btnRemove_{{$pref_id}}',
     groupClass: 'r-group_{{$pref_id}}',
     minItems: 0,
     maxItems: 0,
     startingIndex: 0,
     showMinItemsOnLoad: true,
     reindexOnDelete: true,
     repeatMode: 'append',
     animation: null,
     animationSpeed: 400,
     animationEasing: 'swing',
     clearValues: true,
     afterAdd: function($doppleganger) {
         $('#size_ranges_{{$pref_id}}').find('input[type="number"]').nextAll('div[class^="input-group"]').remove();
         $('#size_ranges_{{$pref_id}} input[type="number"]').inputSpinner();
     },
   }, [
     @if(isset($buyer->size_range))
     @foreach(json_decode($buyer->size_range) as $key => $val)
       {"size_range[{{$key}}][from]":"{{$val->from}}", "size_range[{{$key}}][to]":"{{$val->to}}", "size_range[{{$key}}][premium]":"{{$val->premium}}"},
     @endforeach
     @endif
   ]);

});
</script>
@endif

@endif

<script type="text/javascript">
  function showMorePref($this) {
    if($this.hasClass("showmore")){
      $this.text("Show less");
      $('.active .more').show();
      $this.removeClass("showmore");
      $this.addClass("showless");
    }else if($this.hasClass("showless")){
      $this.text("Show more");
      $('.active .more').hide();
      $this.removeClass("showless");
      $this.addClass("showmore");
    }
  }
</script>