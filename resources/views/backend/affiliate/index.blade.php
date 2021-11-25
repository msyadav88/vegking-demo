@extends('backend.layouts.app')
@section('title', 'Affiliate :: ' .app_name())
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                  Affiliate Management <small class="text-muted"></small>
                </h4>
            </div><!--col-->  
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
                        <thead>
							<tr>
								<th>ID</th>
								<th>User ID</th>
								<th>User Name</th>
								<th>Aff Code</th>
								<th>User Code</th>
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
            ajax: "{{ route('admin.affiliate.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'u_id', name: 'u_id'},
				{data: 'name', name: 'name'},
                {data: 'aff_code', name: 'aff_code'},
                {data: 'user_code', name: 'user_code'},
            ]
        });
      
    });
  </script>
  @endpush