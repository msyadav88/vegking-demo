@extends('frontend.layouts.email')
@section('title', @trans('strings.emails.contact.acknowledgement_title'))
@section('content')
<p><strong>Please click here to verify your email:</strong> <a href="{{  route('frontend.buyercontact.verification', $request->email_verification_code) }}">{{  route('frontend.buyercontact.verification', $request->email_verification_code) }}</a></p>
<p><strong>Product:</strong> {{ $request->product_name }}</p>
<p><strong>Contact Name:</strong> {{ $request->name }}</p>
<p><strong>Email:</strong> {{ $request->email }}</p>
<p><strong>Phone:</strong> {{ $request->phone ?? 'N/A' }}</p>
<p><strong>Preferred method of contact (you’ll get all you choose):</strong> {{ $request->prefered_method }}</p>
<p><strong>Notes:</strong> {{ $request->notes }}</p>
@endsection
