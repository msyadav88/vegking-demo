@extends('backend.layouts.app')
@section('title', 'Loads :: ' . app_name())
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Loads <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
              <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('admin.loads.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
              </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table class="table table-bordered data-table">
                        <thead>
                          <tr>
                              <th>Index</th>
                              <th>Load Id</th>
                              <th>From</th>
                              <th>To</th>
                              <th>Bearing In Deg</th>
                              <th>Vehicle Display Size</th>
                              <th>Pickup Time</th>
                              <th>Delivery Time</th>
                              <th>Pickup Period</th>
                              <th>Delivery Period</th>
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
        ajax: "{{ route('admin.loads.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'loadId', name: 'loadId'},
            {data: 'from.address', name: 'from.address'},
            {data: 'to.address', name: 'to.address'},
            {data: 'bearingInDeg', name: 'bearingInDeg'},
            {data: 'vehicleDisplaySize', name: 'vehicleDisplaySize'},
            {data: 'pickupTime', name: 'pickupTime'},
            {data: 'deliveryTime', name: 'deliveryTime'},
            {data: 'pickupPeriod', name: 'pickupPeriod'},
            {data: 'deliveryPeriod', name: 'deliveryPeriod'},
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
