@extends('frontend.layouts.app')
@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<div class="container">
	<div class="row">
		<h2 class="ContactPageHeading">Affiliate Code</h2>
	</div>
	<div class="row" style="margin-bottom: 40px;">
	
	@foreach($user as $value)
		@if($value->user_code)
			User Code: {{$value->user_code}}
		@endif	
	@endforeach	
	</div>
</div>

@endsection

	
