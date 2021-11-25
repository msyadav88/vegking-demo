<?php 
//echo "<pre>"; print_r($result); exit('kok'); ?>
@extends('frontend.layouts.app')
@section('title', app_name() . ' | ' . __('Subscription'))


@section('content')
	<div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="mb-5"></div>
            <div style="height: 26px;"></div>
            <div class="card mb-5">
                <div class="card-header">
                    <strong> Subscription </strong>
                </div><!--card-header-->
                
                <div class="alert alert-{{$result['status'] }}"  role="alert" style="text-align: center;">
                  {{$result['message'] }}
                </div>
            </div>
            <div class="mb-5"></div>
            <div style="height: 45px;"></div>
        </div>    


	</div>	
@endsection
