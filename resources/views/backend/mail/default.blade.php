@extends('frontend.layouts.email')
@section('title', @$subject)
@section('content')
{!! nl2br(@$body) !!}
@endsection
