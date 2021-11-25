@extends('backend.layouts.app')
@section('title', __('BuyerPref').' #'.$buyerprefWithproductPrefs->id . ' :: ' . app_name())
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
              <strong>BuyerPref Details #{{ $buyerprefWithproductPrefs->id }}</strong>
            </div>
            <div id="collapseofferDetails" class="collapse show" aria-labelledby="headingofferDetails" data-parent="#accordion">
              <div class="card-body"> 
                <div class="form-group"><strong>Buyer:</strong> {{ @$buyerprefWithproductPrefs->buyer->username }}</div>
                <div class="form-group"><strong>Product:</strong> {{ @$buyerprefWithproductPrefs->product->name }}</div>
                @foreach($nets as $display_name=>$net)
                  <div class="form-group"><strong>{{@$display_name}}:</strong> {{ implode(', ',$net) }}</div>
                @endforeach
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
        <a class="btn btn-primary" href="{{ route('admin.buyerpref.index') }}"> {{__('buttons.general.back')}}</a>
      </div>
    </div>
  </div>
</div>
@endsection