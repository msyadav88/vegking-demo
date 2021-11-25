@extends('backend.layouts.app')
@section('title',  __('Show Buyer'). ' # ' .$buyer->id . ' :: '.app_name())
@push('after-styles')
<style>#accordion h4{cursor: pointer;}</style>
@endpush
@php
$company = json_decode($buyer->company);
@endphp
@section('content')
<div class="card">
  <div class="card-body">
    <h4>Buyer Detail</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>Username:</strong> {{ $buyer->username }}</div>
    <div class="form-group"><strong>Company Name:</strong> {{ $buyer->company ?? 'N/A' }}</div>
    <div class="form-group"><strong>Company VAT:</strong> {{ $buyer->vat ?? 'N/A'}}</div>
    <div class="form-group"><strong>Phone:</strong> <a href="tel:{{ $buyer->phone }}">{{ $buyer->phone ?? 'N/A' }}</a></div>
    <div class="form-group"><strong>Name:</strong> {{ $buyer->name ?? 'N/A' }}</div>
    <div class="form-group"><strong>Email:</strong><a href="mailto:{{ $buyer->email }}"> {{ $buyer->email ?? 'N/A' }}</a></div>

    <h4>Company Address</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>City:</strong> {{ $buyer->city ?? 'N/A' }}</div>
    <div class="form-group"><strong>Postal Code :</strong> {{ $buyer->postalcode ?? 'N/A' }}</div>
    <div class="form-group"><strong>Street Address:</strong> {{ $buyer->address ?? 'N/A' }}</div>
    <div class="form-group"><strong>Country:</strong> {{ $buyer->country ?? 'N/A' }}</div>

    <h4>Delivery Address</h4>
    <hr class="mb-3">
    @if($buyer->delivery_same == '1')
    <div class="form-group"><strong>Same as company address</strong></div>
    @else
    @foreach(json_decode($buyer->delivery_address) as $key => $val)
    @if($val->city || $val->postalcode || $val->address || $val->country)
    <div class="form-group"><strong>Address {{$key+1}}:</strong> {{ $val->city }}, {{ $val->postalcode }}, {{ $val->address }}, {{ $val->country }}</div>
    @else
    <div class="form-group">N/A</div>
    @endif
    @endforeach
    @endif

    <h4>Company Detail</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>Company Name:</strong> {{ $buyer->company  ?? 'N/A' }}</div>
    <div class="form-group"><strong>Address:</strong> {{ $buyer->address  ?? 'N/A' }}</div>
    <div class="form-group"><strong>VAT No:</strong> {{ $buyer->vat  ?? 'N/A' }}</div>
    <div class="form-group"><strong>Credit Limit in PLN:</strong> {{ currency($buyer->credit_limit) }}</div>

    <h4>Product Preferences</h4>
    <hr class="mb-3">
    @foreach($buyerprefs as $buyerpref)
       <div class="form-group"><strong>Product:</strong> {{ @$buyerpref->product->name ?? 'N/A' }}</div>
        @foreach($buyerpref->productPrefs as $productPref)
            <div class="form-group"><strong>{{ @$productPref->productspec->display_name }}: </strong>{{ isset($productPref->productspecvalue)?@$productPref->productspecvalue->value:'' }}</div>
        @endforeach
    <hr class="mb-3">
    @endforeach
   
     <h4>Matches:</h4>
      @if($matches != '[]')
      @foreach($matches as $key2 => $match)
      <div>
        <ul>
        <li> Profit_per ton: {{ $match->profit_per_ton }}</li>
        <li> Profit per truck: {{ $match->profit_per_truck }}</li>
        <li> Total profit: {{ $match->total_profit }}</li>
        <li> Per ton Calculation: {{ $match->pton_calculation }}</li>
        </ul>
      </div>
       <hr>
        @endforeach
         @else
      <p>No matches found</p>
        @endif
       <br>
    <h4>Order and Offer Details:</h4>
    @if($sales != '[]')
      @foreach($sales as $key2 => $details)
      <div>
        <ul>
        <li> Product Name: {{ $details->product_name }}</li>
        <li> Offer Price: {{ $details->price }}</li>
        <li> Payment Status: {{ $details->payment_status }}</li>
        <li> Order Date: {{ $details->created_at }}</li>
        <li> Available From: {{ $details->available_from_date }}</li>
        </ul>
      </div>

      <hr>
      @endforeach
    @else
      <p>No Order and offer history</p>
    @endif

    </div>
  </div>

  <div class="card-footer clearfix">
    <div class="row">
      <div class="col">
        <a class="btn btn-primary" href="{{ route('admin.buyers.index') }}"> {{__('buttons.general.back')}}</a>
        <a class="btn btn-primary" href="{{ route('admin.buyers.edit', $buyer->id) }}"> <i class="fas fa-edit"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection
