@extends('backend.layouts.app')
@section('title', 'Route Price Information:: ' . app_name())
@section('content')
    
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Route Price Information
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                    @role('administrator')
                    <div class="col-md-7">
                        
                      <div class="btn-toolbar float-right" >
                          <a href="{{ route('admin.routeprices.show') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="view all" data-original-title="Create New">View All</a>
                      </div><!--btn-toolbar-->
                    </div>
                    @endif
                </div><!--row-->

                <hr>

                <div class="row">
                    <div class="col-sm-12">
                        <p><b>From</b> : {{$routeprice->from}}</p>
                        <p><b>To</b> : {{$routeprice->to}}</p>
                        <p><b>KMS</b> : {{$routeprice->kms}}</p>
                        <p><b>Price</b> : {{$routeprice->price}}</p>
                    </div>
                </div><!--row-->
				
            </div><!--card-body-->
        </div><!--card-->
  
@endsection

