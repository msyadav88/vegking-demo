@extends('backend.layouts.app')

@section('title', __('menus.backend.trading.requests.all') . ' :: ' . app_name())


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trading.requests.all') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
              <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('admin.requests.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
              </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.trading.requests.table.id')</th>
                            <th>@lang('labels.backend.trading.requests.table.buyer')</th>
                            <th>@lang('labels.backend.trading.requests.table.product')</th>
                            <th>@lang('labels.backend.trading.requests.table.variety')</th>
                            <th>@lang('labels.backend.trading.requests.table.size_from')</th>
                            <th>@lang('labels.backend.trading.requests.table.size_to')</th>
                            <th>@lang('labels.backend.trading.requests.table.packing')</th>
                            <th>@lang('labels.backend.trading.requests.table.quantity')</th>
                            <th>@lang('labels.backend.trading.requests.table.color')</th>
                            <th>@lang('labels.backend.trading.requests.table.location_from')</th>
                            <th>@lang('labels.backend.trading.requests.table.location_to')</th>
                            <th>@lang('labels.backend.trading.requests.table.price_from')</th>
                            <th>@lang('labels.backend.trading.requests.table.price_to')</th>
                            <th>@lang('labels.backend.trading.requests.table.status')</th>
                            <th>@lang('labels.backend.trading.requests.table.date')</th>
                            <th>@lang('labels.general.actions')</th>
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
        ajax: "{{ route('admin.requests.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'buyer.full_name', name: 'buyer.full_name'},
            {data: 'product.name', name: 'product.name'},
            {data: 'variety', name: 'variety'},
            {data: 'size_from', name: 'size_from'},
            {data: 'size_to', name: 'size_to'},
            {data: 'packing', name: 'packing'},
            {data: 'quantity', name: 'quantity'},
            {data: 'flesh_color', name: 'flesh_color'},
            {data: 'location_from', name: 'location_from'},
            {data: 'location_to', name: 'location_to'},
            {data: 'price_from', name: 'price_from'},
            {data: 'price_to', name: 'price_to'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
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
        var item_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this request!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/trading/requests') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Request has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Request not deleted', 'error');
                }
            });
          }
        });
    });

  });
</script>
@endpush
