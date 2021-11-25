@extends('frontend.layouts.email')
@section('title', @trans('strings.emails.contact.email_body_title'))
@section('content')
@trans('validation.attributes.frontend.name'): {{ $request->name }}
@trans('validation.attributes.frontend.email'): {{ $request->email }}
@trans('validation.attributes.frontend.phone'): {{ $request->phone ?? 'N/A' }}
@trans('validation.attributes.frontend.message'): {{ $request->message }}
@endsection
