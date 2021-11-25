@extends('frontend.layouts.email')
@section('title', @trans('strings.emails.contact.subject'))
@section('content')
<p><strong>Name:</strong> {{ $request->first_name }} {{ $request->last_name }}</p>
<p><strong>Email:</strong> {{ $request->email }}</p>
<p><strong>Phone:</strong> {{ $request->phone ?? 'N/A' }}</p>
<p><strong>Message:</strong> {{ $request->message }}</p>
@endsection
