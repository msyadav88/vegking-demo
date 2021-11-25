@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.create'))

@section('content')
    {{ html()->form('PUT', route('admin.offers.update', $offer->id))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('menus.backend.trading.offers.edit')
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">

                      <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.trading.offers.product'))->class('col-md-2 form-control-label')->for('product_id') }}

                            <div class="col-md-10">
                                {{ html()->select('product_id')
                                    ->class('form-control')
                                    ->options($products)
                                    ->value($offer->product->id)
                                    ->placeholder(__('validation.attributes.backend.trading.offers.product_placeholder'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.offers.variety'))->class('col-md-2 form-control-label')->for('variety') }}

                            <div class="col-md-10">
                                {{ html()->text('variety')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.offers.variety'))
                                    ->attribute('maxlength', 191)
                                    ->value($offer->variety)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.offers.size'))->class('col-md-2 form-control-label')->for('variety') }}

                            <div class="col-md-10">
                                {{ html()->text('size')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.offers.size'))
                                    ->attribute('maxlength', 191)
                                    ->value($offer->size)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.offers.packing'))->class('col-md-2 form-control-label')->for('variety') }}

                            <div class="col-md-10">
                                {{ html()->text('packing')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.offers.packing'))
                                    ->attribute('maxlength', 191)
                                    ->value($offer->packing)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.offers.quantity'))->class('col-md-2 form-control-label')->for('variety') }}

                            <div class="col-md-10">
                                {{ html()->text('quantity')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.offers.quantity'))
                                    ->attribute('maxlength', 191)
                                    ->value($offer->quantity)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.offers.flesh_color'))->class('col-md-2 form-control-label')->for('variety') }}

                            <div class="col-md-10">
                                {{ html()->text('flesh_color')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.offers.flesh_color'))
                                    ->attribute('maxlength', 191)
                                    ->value($offer->flesh_color)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.offers.location_from'))->class('col-md-2 form-control-label')->for('variety') }}

                            <div class="col-md-10">
                                {{ html()->text('location_from')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.offers.location_from'))
                                    ->attribute('maxlength', 191)
                                    ->value($offer->location_from)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.offers.location_to'))->class('col-md-2 form-control-label')->for('variety') }}

                            <div class="col-md-10">
                                {{ html()->text('location_to')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.offers.location_to'))
                                    ->attribute('maxlength', 191)
                                    ->value($offer->location_to)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.trading.offers.price'))->class('col-md-2 form-control-label')->for('variety') }}

                            <div class="col-md-10">
                                {{ html()->text('price')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.trading.offers.price'))
                                    ->attribute('maxlength', 191)
                                    ->value($offer->price)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="seller_id">{{__('validation.attributes.backend.trading.requests.seller')}}</label>
                            <div class="col-md-10">
                                <select class="form-control" name="seller_id" id="seller_id" maxlength="191" required="">
                                  <option value="">{{__('validation.attributes.backend.trading.requests.select_seller')}}</value>
                                  @foreach($sellers as $seller)
                                  <option value="{{ $seller->id}}" @if($seller->id == $offer->seller_id) selected @endif>{{ $seller->fullname}} [{{ $seller->email}}]</option>
                                  @endforeach
                                </select>
                            </div><!--col-->
                        </div>


                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.offers.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
