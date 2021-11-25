@extends('frontend.layouts.app')
@section('title', app_name() . ' | ' . __('navs.general.home'))


@section('content')
<div class="container">
	<div class="row">
		<h2 class="ContactPageHeading">@lang('termcondition.frontend.top-section.topheading')</h2>
	</div>
	<div class="row">
		<h5>@lang('termcondition.frontend.top-section.heading')</h5>
	</div>
	<div class="row">
		<h5>@lang('termcondition.frontend.section-1.heading')</h5>
	</div>
	<div class="row">
		@lang('termcondition.frontend.section-1.content')
	</div>

	<div class="row">
		<h5>@lang('termcondition.frontend.section-2.heading')</h5>
	</div>
	<div class="row">
		@lang('termcondition.frontend.section-2.content')
	</div>
	<div class="row">
		<h5>@lang('termcondition.frontend.section-3.heading')</h5>
	</div>
	<div class="row">
		@lang('termcondition.frontend.section-3.content')
	</div>
	<div class="row">
		<h5>@lang('termcondition.frontend.section-4.heading')</h5>
	</div>
	<div class="row">
		@lang('termcondition.frontend.section-4.content')
	</div>

</div>
@endsection
