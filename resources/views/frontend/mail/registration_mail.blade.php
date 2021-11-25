@extends('frontend.layouts.email')
@section('content')
@if(@$email_content)
  {!! @$email_content !!}
@endif
@endsection
