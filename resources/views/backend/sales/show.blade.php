@extends('backend.layouts.app')
@section('title', 'Sale Details #'.$sale->id . ' :: ' . app_name())
@push('after-styles')
<style>#accordion h4{cursor: pointer;}</style>
@endpush

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      @if(isset($sale) && !empty($sale))
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingofferDetails" data-toggle="collapse" data-target="#collapseofferDetails" aria-expanded="true" aria-controls="collapseofferDetails">
              <strong>Sale Details #{{ $sale->id }}</strong>
            </div>
            <div id="collapseofferDetails" class="collapse show" aria-labelledby="headingofferDetails" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group"><strong>Buyer Name:</strong> #{{ $sale->buyer->name }}</div>
                @if(isset($offer) && !empty($offer))
                  <div class="form-group"><strong>Product Name:</strong> {{ $offer->product->name }}</div>
                  <div class="form-group"><strong>Size:</strong> {{ $offer->size_from }} - {{ $offer->size_to }}</div>
                @endif
                <div class="form-group"><strong>Quantity:</strong> {{ $sale->quantity }}</div>
                <div class="form-group"><strong>Price:</strong> {{ currency($sale->price) }}</div>
                <div class="form-group"><strong>Status:</strong> {{ $sale->payment_status }}</div>
                
                @if(isset($offer) && !empty($offer))
                  <h4 class="mt-4">Seller Details</h4>
                  <hr>
                  <div class="form-group"><strong>Seller ID:</strong> #{{ $offer->seller->id }}</div>
                  <div class="form-group"><strong>Name:</strong> {{ $offer->seller->username }}</div>
                  <div class="form-group"><strong>Email:</strong> {{ $offer->seller->email }}</div>
                  <div class="form-group"><strong>Phone:</strong> {{ $offer->seller->phone }}</div>
				        @endif

        				@php $tNumber= 1 @endphp
        				@foreach($saleTrucks as $truck)
        					<h4 class="mt-4">Load{{$tNumber}}</h4> 
                  <hr>
        					<div class="form-group"><strong>Price:</strong> {{ currency($truck->price) }}</div>
        					<div class="form-group"><strong>Sale Date:</strong> {{ $truck->sale_date }}</div>
        					<div class="form-group"><strong>Delivery Location:</strong> {{ $truck->delivery_location }}</div>
        					<div class="form-group"><strong>Delivery Date:</strong> {{ $truck->delivery_date }}</div>
        					<div class="form-group"><strong>Truck loads:</strong> {{ $truck->truck_loads }}</div>
        				@php $tNumber++; @endphp
        				@endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
        <div class="col-xs-12 col-sm-12 col-md-12"> No related data</div>
      @endif
    </div>
  </div>
  <div class="card-footer clearfix">
    <div class="row">
      <div class="col">
        <a class="btn btn-primary" href="{{ route('admin.sales.index') }}"> {{__('buttons.general.back')}}</a>
      </div>
    </div>
  </div>
</div>
@endsection
