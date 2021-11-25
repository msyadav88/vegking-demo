
@extends('frontend.layouts.buyeremail',['email_buyer_seller'=>$email_buyer_seller])
@section('content')
@if(@$email_content)
  {!! $email_content !!}
@endif
@endsection