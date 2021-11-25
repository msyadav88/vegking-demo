@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.requests.edit') . ' #'.$offer_request->id . ' :: ' . app_name())
@section('content')
    {{ html()->form('PUT', route('admin.requests.update', $offer_request->id))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('menus.backend.trading.requests.edit')
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.trading.requests.product'))->class('col-md-2 form-control-label')->for('product_id') }}

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="buyer_id">{{__('validation.attributes.backend.trading.requests.buyer')}}</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="buyer_id" id="buyer_id" maxlength="191" required="">
                                      <option value="">{{__('validation.attributes.backend.trading.requests.select_buyer')}}</value>
                                      @foreach($buyers as $buyer)
                                      <option value="{{ $buyer->id}}" @if($buyer->id == $offer_request->buyer_id) selected @endif>{{ $buyer->fullname}} [{{ $buyer->email}}]</option>
                                      @endforeach
                                    </select>
                                </div><!--col-->
                            </div>

                            <div class="col-md-10">
                                {{ html()->select('product_id')
                                    ->class('form-control')
                                    ->options($products)
                                    ->placeholder(__('validation.attributes.backend.trading.requests.product_placeholder'))
                                    ->value($offer_request->product->id)
                                    ->attribute('maxlength', 191)
                                    ->attribute('onchange', 'fetch_select(this.value)')
                                    ->required()
                                }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.variety'))->class('col-md-2 form-control-label')->for('variety') }}

                            <div class="col-md-10">
                                {{ html()->text('variety')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.variety'))
                                    ->attribute('maxlength', 191)
                                    ->value($offer_request->variety)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.size_from'))->class('col-md-2 form-control-label')->for('size_from') }}

                            <div class="col-md-10">
                                {{ html()->text('size_from')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.size_from'))
                                    ->value($offer_request->size_from)
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.size_to'))->class('col-md-2 form-control-label')->for('size_to') }}

                            <div class="col-md-10">
                                {{ html()->text('size_to')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.size_to'))
                                    ->value($offer_request->size_to)
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.packing'))->class('col-md-2 form-control-label')->for('packing') }}

                            <div class="col-md-10">
                                {{ html()->text('packing')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.packing'))
                                    ->value($offer_request->packing)
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.quantity'))->class('col-md-2 form-control-label')->for('quantity') }}

                            <div class="col-md-10">
                                {{ html()->text('quantity')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.quantity'))
                                    ->value($offer_request->quantity)
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.flesh_color'))->class('col-md-2 form-control-label')->for('flesh_color') }}

                            <div class="col-md-10">
                                {{ html()->text('flesh_color')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.flesh_color'))
                                    ->value($offer_request->flesh_color)
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.location_from'))->class('col-md-2 form-control-label')->for('location_from') }}

                            <div class="col-md-10">
                                {{ html()->text('location_from')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.location_from'))
                                    ->value($offer_request->location_from)
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.location_to'))->class('col-md-2 form-control-label')->for('location_to') }}

                            <div class="col-md-10">
                                {{ html()->text('location_to')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.location_to'))
                                    ->value($offer_request->location_to)
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.price_from'))->class('col-md-2 form-control-label')->for('price_from') }}

                            <div class="col-md-10">
                                {{ html()->text('price_from')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.price_from'))
                                    ->value($offer_request->price_from)
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.requests.price_to'))->class('col-md-2 form-control-label')->for('price_to') }}

                            <div class="col-md-10">
                                {{ html()->text('price_to')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.requests.price_to'))
                                    ->value($offer_request->price_to)
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->





                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.requests.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
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
function fetch_select(val){
	 $.ajax({
		type: "POST",
		url: "{{ route('admin.trading.getproduct') }}",
		data: {pid:val},
		success: function (data) {
			$('#variety').val(data.variety);
			$('#size_from').val(data.size_from);
			$('#size_to').val(data.size_to);
			$('#packing').val(data.packing);
			$('#quantity').val(data.quantity);
			$('#flesh_color').val(data.flesh_color);
			$('#location_from').val(data.location);
			$('#price_from').val(data.price);
		}
	});
}
</script>
@endpush
