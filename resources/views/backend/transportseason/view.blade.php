@extends('backend.layouts.app')
@section('title', 'Transport Country Season Per Factor Information:: ' . app_name())
@section('content')
    
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7">
                        <h4 class="card-title mb-0">
                            Transport Country Season Per Factor Information
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                    @role('administrator')
                    <div class="col-md-5">
                        
                      <div class="btn-toolbar float-right" >
                          <a href="{{ route('admin.season.show') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="view all" data-original-title="Create New">View All</a>
                      </div><!--btn-toolbar-->
                    </div>
                    @endif
                </div><!--row-->

                <hr>

                <div class="row">
                    <div class="col-sm-12">
                        <p><b>Country</b> : {{$tra_season->country}}</p>
                        <p><b>Region</b> : {{$tra_season->region}}</p>
                        <p><b>fromTo</b> : {{$tra_season->fromTo}}</p>
                        <p><b>Season</b> : {{$tra_season->season}}</p>
                        <p><b>Factor</b> : {{$tra_season->factor}}</p>
                    </div>
                </div><!--row-->
				
            </div><!--card-body-->
        </div><!--card-->
  
@endsection

