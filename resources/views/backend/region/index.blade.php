@extends('backend.layouts.app')
@section('title', 'Region:: ' . app_name())
@section('content')

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
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Region Details
                    <small class="text-muted"></small>
                </h4>
            </div><!--col-->
            @role('administrator')
            <div class="col-md-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('admin.region.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="Create New"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->
            </div>
            @endif
        </div><!--row-->

        <hr>

        <div class="row">
            <div class="col-sm-12">
                <div class="col">
                    <div class="table-offers">
                          <table id="warehouse_table" class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Region Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            </tfoot> 
                        </table>
                    </div>
                </div>
            </div>
        </div><!--row-->
    </div>
</div>
@endsection
@push('after-scripts')
<script type="text/javascript">
    $(function () {
        setTimeout(function() {
            $(".alert-danger").hide();
        }, 3000);
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.region.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'region_name', name: 'region_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('body').on('click', '.editItem', function () {
        var item_url = $(this).data("url");
        window.location.href = item_url;
    });
    $('body').on('click', '.deleteItem', function () {
        var item_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this Region record!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "GET",
                url: "{{ url('admin/region/delete') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Region  deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Region  not deleted', 'error');
                }
            });
          }
        });
    });
  });

</script>
@endpush