@extends('frontend.layouts.app')
@section('title', app_name() . ' | ' . __('navs.general.home'))


@section('content')
<div class="container">
	<div class="row">

        <h2 class="ContactPageHeading">@lang('privacypolicy.frontend.top-section.heading')</h2>
		<p>@lang('privacypolicy.frontend.top-section.content')</p>

    </div>
	<div class="row">
		<h5>@lang('privacypolicy.frontend.section-1.heading')</h5>
	</div>
	<div class="row">
		@lang('privacypolicy.frontend.section-1.content')

	</div>
	<div class="row">
		<h5>@lang('privacypolicy.frontend.section-2.heading')</h5>
	</div>
	<div class="row">
		@lang('privacypolicy.frontend.section-2.content')
	</div>
	<div class="row">
		<h5>@lang('privacypolicy.frontend.section-3.heading')</h5>
	</div>
	<div class="row">
		@lang('privacypolicy.frontend.section-3.content')
	</div>
</div>
@endsection
