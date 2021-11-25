@extends('frontend.layouts.email')
@section('title', @trans('strings.emails.contact.email_body_title'))
@section('content')
<p><strong>@trans('validation.attributes.frontend.name'):</strong> {{ $request->name }}</p>
<p><strong>@trans('validation.attributes.frontend.email'):</strong> {{ $request->email }}</p>
<p><strong>@trans('validation.attributes.frontend.phone'):</strong> {{ $request->phone ?? 'N/A' }}</p>
<p><strong>@trans('validation.attributes.frontend.product'):</strong> {{ $request->product_name }}</p>
<p><strong>@trans('validation.attributes.frontend.prefered_method'):</strong> {{ $request->prefered_method }}</p>
<p><strong>@trans('validation.attributes.frontend.notes'):</strong> {{ $request->notes }}</p>
@endsection
