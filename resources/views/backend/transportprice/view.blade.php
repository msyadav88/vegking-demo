@extends('backend.layouts.app')
@section('title', 'Transport Country Price Information:: ' . app_name())
@section('content')
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-7">
                    <h4 class="card-title mb-0">
                        Transport Country Price Information
                        <small class="text-muted"></small>
                    </h4>
                </div><!--col-->
                @role('administrator')
                <div class="col-md-5">
                    <div class="btn-toolbar float-right" >
                        <a href="{{ route('admin.transportprice.index') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="view all" data-original-title="Create New">View All</a>
                    </div><!--btn-toolbar-->
                </div>
                @endif
            </div><!--row-->

            <hr>

            <div class="row">
                <div class="col-sm-12">
                    <p><b>Country</b> : {{$tran_price->country}}</p>
                    <p><b>Price Per KM</b> : {{$tran_price->pricePerKm}}</p>
                </div>
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
  
@endsection

