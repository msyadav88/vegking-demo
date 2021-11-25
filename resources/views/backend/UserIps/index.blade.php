@extends('backend.layouts.app')

@section('title', 'UserIps'. ' | '.app_name() )

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                  User Ip Tracking <small class="text-muted"></small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <table class="table table-bordered data-table usertracking_tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Ip Address</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Login</th>
                            <th>Time</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                    
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                   
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
@push('after-scripts')
<script type="text/javascript">
	
    $(function () {
		
		
		
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.user-ips.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'ip', name: 'ip'},
                {data: 'city', name: 'city'},
                {data: 'country', name: 'country'},
                {data: 'didlogin', name: 'didlogin'},
                {data: 'time', name: 'time'},
                {data: 'date', name: 'date'}, 
            ]
        });
      
    });
  </script>
  @endpush