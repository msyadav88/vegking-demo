@extends('backend.layouts.email')
@section('title', 'Stock Matched')
@section('content')
@foreach(@$matches as $match)
<p><strong>Match Id:</strong> {{ @$match['match']->id  }}</p>
<p><strong>Stock Id:</strong>{{ @$match['match']->stock->id }}</p>
<p><strong>Seller Username:</strong> {{ @$match['match']->stock->seller->username }}</p>
<p><strong>Buyer:</strong> {{ @$match['match']->buyerPref->buyer->username }}</p>
<p><strong>Product Name:</strong> {{ @$match['match']->stock->product->name }}</p>
<p><strong>Stock Price:</strong> {{ @$match['match']->stock->price }}</p>
<p><strong>Buyer Premiums:</strong> {{ @$match['match']->buyerPref->buyer->total_prefs }}%</p>
<p><strong>P/Ton:</strong> {{ @$match['pTonCalculation']['profitPerTon'] }}</p>
@if(@$match['role'] == 'trans')
<p><strong>Quantity:</strong> {{ @$match['match']->stock->quantity }}</p>
@endif
<p><strong>View all matches:</strong> <a href="{{route('admin.matches.index')}}">{{route('admin.matches.index')}}</a></p>
<hr/>
@endforeach
@endsection
