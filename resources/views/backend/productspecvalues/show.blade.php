@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.productspecvalues.show') . ' :: ' . app_name())
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
              <strong>Product Spec Details #{{ $productspecvalue->id }}</strong>
            </div>
            <div id="collapseofferDetails" class="collapse show" aria-labelledby="headingofferDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Name:</strong> {{ $productspecvalue->value }}</div>
                <div class="form-group"><strong>Product:</strong> {{ $product->name }}</div>
                <div class="form-group"><strong>Premium:</strong> {{ $productspecvalue->premium ?? '-' }}</div>
                <div class="form-group"><strong>Volume:</strong> {{ $productspecvalue->volume ?? '-' }}</div>
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
        <a class="btn btn-primary" href="{{ route('admin.productspecvalues.index') }}"> {{__('buttons.general.back')}}</a>
      </div>
    </div>
  </div>
</div>
@endsection
