@extends('backend.layouts.app')

@section('title', 'Create Offer :: '.app_name())

@section('content')
{{ html()->form('POST', route('seller.stock.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
          @lang('menus.backend.trading.offers.create')
          <small class="text-muted"></small>
        </h4>
      </div><!--col-->
    </div><!--row-->

    <hr>

    <div class="row mt-4 mb-4">
      <div class="col">

        <div class="form-group row">
          {{ html()->label('Username')->class('col-md-2 form-control-label')->for('product') }}
          <div class="col-md-10">
            <input type="text" class="form-control" value="{{ get_buyer_by_user_id()->username }}" readonly>
            <input type="hidden" name="seller_id" value="{{ get_buyer_by_user_id()->id }}">
        </div>
      </div>

        <div class="form-group row">
          {{ html()->label('Product')->class('col-md-2 form-control-label')->for('product') }}
          <div class="col-md-10">
            {{ html()->select('product_id')
            ->class('select2 form-control')
            ->options(products_list())
            ->placeholder('Select Product')
            ->attribute('maxlength', 191)
            ->value('34')
            ->attribute('onchange', 'fetch_select(this.value)')
            ->required()
          }}
        </div>
      </div>
      <div class="form-group row">
        {{ html()->label('Variety')->class('col-md-2 form-control-label')->for('variety') }}
        <div class="col-md-10">
          {{ html()->select('variety')
          ->class('select2 form-control')
          ->options(variety_list())
          ->attribute('maxlength', 191)
    ->value(old('variety'))
     ->attribute('onchange', 'fetch_color(this.value)')
          ->placeholder('Choose Variety')
        }}
      </div>
    </div>

    <div class="form-group row">
      {{ html()->label('Packing')->class('col-md-2 form-control-label')->for('packing') }}
      <div class="col-md-10">
        {{ html()->select('packing')
        ->class('select2 form-control')
        ->options(packaging_list())
        ->value(old('packing'))
        ->attribute('maxlength', 191)
    ->placeholder('Choose Packing')
      }}
    </div>
  </div>

<div class="form-group row">
      {{ html()->label('Purpose')->class('col-md-2 form-control-label')->for('purpose') }}
      <div class="col-md-10">
        {{ html()->select('purpose')
        ->class('select2 form-control')
        ->options(purpose_list())
        ->value(old('purpose'))
        ->attribute('maxlength', 191)
    ->placeholder('Choose Purpose')
      }}
    </div>
  </div>

<div class="form-group row">
      {{ html()->label('Defects')->class('col-md-2 form-control-label')->for('defects') }}
      <div class="col-md-10">
        {{ html()->select('defects')
        ->class('select2 form-control')
        ->options(defects_list())
        ->value(old('defects'))
        ->attribute('maxlength', 191)
    ->placeholder('Choose Defects')
      }}
    </div>
  </div>


  <div class="form-group row">
    {{ html()->label('Size Range (mm)')->class('col-md-2 form-control-label')->for('dry_matter_content') }}
    <div class="col-md-10">
      <div class="form-group row">
        <div class="col-md-1" style="position:relative">
          <label class="form-control-label" for="size_from">From</label>
          <input class="form-control" type="text" value="45" placeholder="Min" name="size_from" id="size_from" /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
        </div>
        <div class="col-md-1" style="position:relative">
          <label class="form-control-label" for="size_to">To</label>
          <input class="form-control" type="text" value="65" placeholder="Max" name="size_to" id="size_to" /> <span style="position:absolute;bottom: 7px;right: 20px;">mm</span>
        </div>
      </div>
    </div><!--col-->
  </div><!--form-group-->


  <div class="form-group row">
     {{ html()->label('Number of 24T Truck Loads')->class('col-md-2 form-control-label')->for('quantity') }}

    <div class="col-md-10">
      {{ html()->text('quantity')
      ->class('form-control')
      ->placeholder(__('validation.attributes.backend.trading.offers.quantity'))
      ->attribute('maxlength', 191)
      ->required() }}
    </div><!--col-->
  </div><!--form-group-->

  <div class="form-group row">
    {{ html()->label('Flesh Color')->class('col-md-2 form-control-label')->for('flesh_color') }}
    <div class="col-md-10">
      {{ html()->select('flesh_color')
      ->class('select2 form-control')
      ->options(color_list())
      ->attribute('maxlength', 191)
      ->required()
    }}
  </div>
</div>


 <div class="form-group row">
{{ html()->label('Loading Address')->class('col-md-2 form-control-label')->for('company_name') }}
<div class="col-md-10">
  <div class="row">

  <div class="col-md-3">
    <div class="form-group">
    {{ html()->label('City <span style="color:red">*</span>')->class('form-control-label')->for('city') }}
    {{ html()->text('city')->class('form-control')->placeholder('City')->attribute('maxlength', 191) }}
    </div>
  </div><!--col-->

  <div class="col-md-3">
    <div class="form-group">
    {{ html()->label('Postal Code <span style="color:red">*</span>')->class('form-control-label')->for('postalcode') }}
    {{ html()->text('postalcode')->class('form-control')->placeholder('Postal Code')->attribute('maxlength', 191) }}
    </div>
  </div><!--col-->

  <div class="col-md-3">
    <div class="form-group">
    {{ html()->label('Street Address')->class('form-control-label')->for('street') }}
    {{ html()->text('street')->class('form-control')->placeholder('Street Address')->attribute('maxlength', 191) }}
    </div>
  </div><!--col-->

  <div class="col-md-3">
    <div class="form-group">
        {{ html()->label('Country')->class('form-control-label')->for('country') }}
        {{ html()->select('country')
          ->class('select2 form-control')
          ->options(country_list())
          ->value('UK')
          ->attribute('maxlength', 191)
        }}
    <!--{{ html()->text('country')->value('PL')->class('form-control')->placeholder('Country')->attribute('maxlength', 191)->attribute('onblur', 'changeRequered()')->required() }}-->
    </div>
  </div><!--col-->

  </div><!--form-group-->
</div>
</div>
<div class="form-group row">
  {{ html()->label('Price in GBP')->class('col-md-2 form-control-label')->for('price') }}

  <div class="col-md-10">
    {{ html()->text('price')
    ->class('form-control')
    ->placeholder(__('validation.attributes.backend.trading.offers.price'))
    ->attribute('maxlength', 191)
    ->required() }}
  </div><!--col-->
</div><!--form-group-->
<div class="form-group row">
  {{ html()->label('Note')->class('col-md-2 form-control-label')->for('note') }}
  <div class="col-md-10">
   <textarea class="form-control" name="note" rows="3" placeholder="Note" id="note"></textarea>
  </div>
</div>
<div class="form-group row">
  {{ html()->label('Stock Image')->class('col-md-2 form-control-label')->for('image') }}
  <div class="col-md-10">
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
  {{ html()->label('Example Picture')->class('col-md-2 form-control-label')->for('exp_image') }}
  <div class="col-md-5">
    <div class="form-group">
     @if($stock_image)
    <a href="{{ asset('images/stock/'.$stock_image) }}" target="_blank"><img src="{{ asset('images/stock/'.$stock_image) }}"  target="_blank" class="mb-2 img-thumbnail"></a>
    @endif
    </div>
  </div>
</div>
<div class="form-group row">
  {{ html()->label('Available From Date')->class('col-md-2 form-control-label')->for('available_from_date') }}
  <div class="col-md-3">
   {{ html()->text('available_from_date')->class('datepicker form-control')->placeholder('Available From Date')->attribute('maxlength', 191) }}
  </div>
</div>
<div class="form-group row">
  {{ html()->label('Available Per Day')->class('col-md-2 form-control-label')->for('available_per_day') }}
  <div class="col-md-3">
   {{ html()->text('available_per_day')->class('form-control')->placeholder('Available Per Day')->attribute('maxlength', 191) }}
  </div>
</div>
<div class="form-group row">
  {{ html()->label('Pallets Available')->class('col-md-2 form-control-label')->for('pallets_available') }}
  <div class="col-md-3">
   {{ html()->text('pallets_available')->class('form-control')->placeholder('Pallets Available')->attribute('maxlength', 191) }}
  </div>
</div>

</div><!--col-->
</div><!--row-->
</div><!--card-body-->

<div class="card-footer clearfix">
  <div class="row">
    <div class="col">
      {{ form_cancel(route('seller.stock.index'), __('buttons.general.cancel')) }}
    </div><!--col-->

    <div class="col text-right">
      {{ form_submit(__('buttons.general.crud.create')) }}
    </div><!--col-->
  </div><!--row-->
</div><!--card-footer-->
</div><!--card-->
{{ html()->form()->close() }}
@endsection


@push('after-scripts')
<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$( "#available_from_date" ).datepicker({
  format: "mm/dd/yyyy",
  weekStart: 0,
  calendarWeeks: true,
  autoclose: true,
});
function fetch_select(val){
  $.ajax({
    type: "POST",
    url: "{{ route('seller.trading.getproduct') }}",
    data: {pid:val},
    success: function (data) {
      $('#variety').val(data.variety);
      $('#variety').select2().trigger('change');
      $('#size_from').val(data.size_from);
      $('#size_to').val(data.size_to);
      $('#packing').val(data.packing);
      $('#packing').select2().trigger('change');
      $('#quantity').val(data.quantity);
      $('#flesh_color').val(data.flesh_color);
      $('#flesh_color').select2().trigger('change');
      $('#location_from').val(data.location);
      $('#price').val(data.price);
    }
  });
}
</script>
@endpush
