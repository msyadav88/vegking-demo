@extends('frontend.layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                 {{$message}}
                              </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
             </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
