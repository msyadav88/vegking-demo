@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.productspecs.show').' #'.$productspec->id . ' :: ' . app_name())
@push('after-styles')
<style>#accordion h4{cursor: pointer;}</style>
@endpush

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingofferDetails" data-toggle="collapse" data-target="#collapseofferDetails" aria-expanded="true" aria-controls="collapseofferDetails">
              <strong>Product Spec Details #{{ $productspec->id }}</strong>
            </div>
            <div id="collapseofferDetails" class="collapse show" aria-labelledby="headingofferDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Display Name:</strong> {{ $productspec->display_name }}</div>
                <div class="form-group"><strong>Product:</strong> {{ $productspec->product->name }}</div>
                <div class="form-group"><strong>Field:</strong> {{ $productspec->field }}</div>
                <div class="form-group"><strong>Importance:</strong> {{ $productspec->importance }}</div>
                <div class="form-group"><strong>Order:</strong> {{ $productspec->order }}</div>
                <div class="form-group"><strong>Required:</strong> {{ $productspec->required }}</div>
                <div class="form-group"><strong>HasMany:</strong> {{ $productspec->hasmany }}</div>
                <div class="form-group"><strong>Buyerpref AnyLogic:</strong> {{ @$productspec->buyer_pref_anylogic }}</div>
				<div class="form-group"><strong>Display in transport:</strong> {{ @$productspec->display_in_transport }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer clearfix">
    <div class="row">
      <div class="col">
        <a class="btn btn-primary" href="{{ route('admin.productspecs.index') }}"> {{__('buttons.general.back')}}</a>
      </div>
    </div>
  </div>
</div>
@endsection
