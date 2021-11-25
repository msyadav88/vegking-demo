@extends('backend.layouts.app')
@section('title', __('Show Seller').' #'.$seller->id . ' :: '.app_name())
@push('after-styles')
<style>#accordion h4{cursor: pointer;}</style>
@endpush
@php
$company = json_decode($seller->company);
@endphp
@section('content')
<div class="card">
  <div class="card-body">
    <h4>Seller Detail</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>Username:</strong> {{ $seller->username }}</div>
    <h4>Company Detail</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>Company Name:</strong> {{ $seller->company ?? 'N/A' }}</div>
    <div class="form-group"><strong>VAT No:</strong> {{ $seller->vat ?? 'N/A' }}</div>
    <div class="form-group"><strong>City:</strong> {{ $seller->city ?? 'N/A' }}</div>
    <div class="form-group"><strong>Street Address:</strong> {{ $seller->address ?? 'N/A' }}</div>
    <div class="form-group"><strong>Postalcode:</strong> {{ $seller->postalcode ?? 'N/A' }}</div>
    <div class="form-group"><strong>Country:</strong> {{ $seller->country ?? 'N/A' }}</div>
    <h4>Seller 1 Contact Info</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>Phone:</strong> <a href="tel:{{ $seller->phone }}">{{ $seller->phone ?? 'N/A' }}</a></div>
    <div class="form-group"><strong>Name:</strong> {{ $seller->name ?? 'N/A' }}</div>
    <div class="form-group"><strong>Email:</strong><a href="mailto:{{ $seller->email }}"> {{ $seller->email ?? 'N/A' }}</a></div>
    @php
	$buyer2_contact = json_decode($seller->buyer2_contact);
	$transport_contact = json_decode($seller->transport_contact);
	$accounts_contact = json_decode($seller->accounts_contact);
    @endphp
    @if($seller->buyer2_contact)
    <h4>Seller 2 Contact Info</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>Phone:</strong> {{ $buyer2_contact->phone ?? 'N/A' }}</div>
    <div class="form-group"><strong>Name:</strong> {{ $buyer2_contact->name ?? 'N/A' }}</div>
    <div class="form-group"><strong>Email:</strong> {{ $buyer2_contact->email ?? 'N/A' }}</div>
    @endif
    @if($seller->transport_contact)
    <h4>Transport Contact Info</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>Phone:</strong> {{ $transport_contact->phone ?? 'N/A' }}</div>
    <div class="form-group"><strong>Name:</strong> {{ $transport_contact->name ?? 'N/A' }}</div>
    <div class="form-group"><strong>Email:</strong> {{ $transport_contact->email ?? 'N/A' }}</div>
    @endif
    @if($seller->accounts_contact)
    <h4>Accounts Contact Info</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>Phone:</strong> {{ $accounts_contact->phone ?? 'N/A' }}</div>
    <div class="form-group"><strong>Name:</strong> {{ $accounts_contact->name ?? 'N/A' }}</div>
    <div class="form-group"><strong>Email:</strong> {{ $accounts_contact->email ?? 'N/A' }}</div>
    @endif
    <div class="form-group"><strong># of available stocks:</strong> {{ $seller->available_stocks ?? 'N/A' }}</div>
   @if($seller->note)
   <h4>Note</h4>
   <hr class="mb-3">
   <div class="form-group">{{ $seller->note ?? 'N/A' }}</div>
   @endif
  </div>
  <div class="card-footer clearfix">
    <div class="row">
      <div class="col">
        <a class="btn btn-primary" href="{{ route('admin.sellers.index') }}"> {{__('buttons.general.back')}}</a>
        <a class="btn btn-primary" href="{{ route('admin.sellers.edit', $seller->id) }}"> <i class="fas fa-edit"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection
