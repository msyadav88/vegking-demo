@extends('backend.layouts.app')
@section('title', 'Transport Route Prices :: ' . app_name())

@section('content')
@if(!empty($msg))
    <div class="card-body alert-danger">
        <div class="row">
            <div class="col-sm-12">
                <div>{{ $msg }}</div>
            </div>
        </div>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <h4 class="card-title mb-0">
                    Transport Route Prices <small class="text-muted"></small>
                </h4>
            </div><!--col-->
			@role('administrator')
            <div class="col-md-7">
                
              <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                  <a href="{{ route('admin.routeprices.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="Create New"><i class="fas fa-plus-circle"></i></a>
              </div><!--btn-toolbar-->
            </div>
			@endif
           
        </div><!--row-->
		<div class="row mt-2" style="padding:0px">
            <div class="col" style="">
                <div id="tag_container" class="table-offers" style="padding:0px">
                    
                    <table id="trans_table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>From Region</th>
                                <th>From City</th>
                                <th>To Region</th>
                                <th>To City</th>
                                <th>KMS</th>
                                <th>Price</th>
                                <th>Created</th>
                                <th>Updated</th>
                                @role('administrator')
                                <th>@lang('labels.general.actions')</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
							
                        </tfoot>   
					</table>      
                
				<div id="transload"></div>	
				
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
<script type="text/javascript">
  $(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route('admin.routeprices.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'from', name: 'from'},
            {data: 'to', name: 'to'},
            {data: 'to_region_id', name: 'to_region_id'},
            {data: 'from_region_id', name: 'from_region_id'},
            {data: 'kms', name: 'kms'},
            {data: 'price', name: 'price'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('body').on('click', '.editItem', function () {
        var item_url = $(this).data("url");
        window.location.href = item_url;
    });

    $('body').on('click', '.viewItem', function () {
        var item_url = $(this).data("url");
        window.location.href = item_url;
    });

    
    $('body').on('click', '.deleteItem', function () {
        var item_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this Route Price record!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "POST",
                url: "{{ url('admin/routeprices/delete') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Route price has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Route price not deleted', 'error');
                }
            });
          }
        });
    });
  });
</script>
@endpush