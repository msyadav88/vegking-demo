@extends('backend.layouts.app')
@section('title', __('Show Buyer Lead').' #'.$buyerlead->id . ' :: '.app_name())
@push('after-styles')
<style>#accordion h4{cursor: pointer;}</style>
@endpush
@section('content')
<div class="card">
  <div class="card-body">
    <h4>Buyer Lead Detail</h4>
    <hr class="mb-3">
    <div class="form-group"><strong>Product:</strong> {{ @$product->name ?? 'N/A' }}</div>
    <div class="form-group"><strong>Company Name:</strong> {{ $buyerlead->company ?? 'N/A' }}</div>
    <div class="form-group"><strong>Name:</strong> {{ $buyerlead->name }}</div>
    <div class="form-group"><strong>Phone:</strong> {{ $buyerlead->phone ?? 'N/A' }}</div>
    <div class="form-group"><strong>E-mail:</strong> {{ $buyerlead->email ?? 'N/A' }}</div>
    <div class="form-group"><strong>Prefered Method:</strong> {{ $buyerlead->prefered_method ?? 'N/A' }}</div>
    <div class="form-group"><strong>Referral:</strong> {{ $buyerlead->referral ?? 'N/A' }}</div>
    <div class="form-group"><strong>Email Verified At:</strong> {{ $buyerlead->email_verified_at ?? 'N/A' }}</div>
  </div>

  <div class="card-footer clearfix">
    <div class="row">
      <div class="col">
        <a class="btn btn-primary" href="{{ route('admin.buyerleads.index') }}"> {{__('buttons.general.back')}}</a>
        <!-- <a class="btn btn-primary" href="{{ route('admin.buyerleads.edit', $buyerlead->id) }}"> <i class="fas fa-edit"></i></a> -->
      </div>
    </div>
  </div>
</div>
@endsection
