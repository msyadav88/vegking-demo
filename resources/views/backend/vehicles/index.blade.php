@extends('backend.layouts.app')
@section('title', 'Vehicles :: ' . app_name())
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Vehicles <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @can('add vehicles')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->
                @endcan
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>Index</th>
                            <th>Vehicle Id</th>
                            <th>Vehicle Display Size</th>
                            <th>Vehicle Ref</th>
                            <th>Status</th>
                            <th>Address</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                        </tr>
                        </thead>

                    </table>
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
        ajax: "{{ route('admin.vehicles.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'vehicleId', name: 'vehicleId'},
            {data: 'vehicleDisplaySize', name: 'vehicleDisplaySize'},
            {data: 'vehicleRef', name: 'vehicleRef'},
            {data: 'status', name: 'status'},
            {data: 'location.address', name: 'location.address'},
            {data: 'location.lat', name: 'location.lat'},
            {data: 'location.lng', name: 'location.lng'},
        ]
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
        var product_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this offer!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/trading/offers') }}"+'/'+product_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Offer has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Offer not deleted', 'error');
                }
            });
          }
        });
    });

  });
</script>
@endpush
