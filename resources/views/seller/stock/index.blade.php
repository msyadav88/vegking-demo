@extends('backend.layouts.app')

@section('title', __('menus.backend.trading.offers.all') . ' :: ' .app_name())


@section('content')

<div style="margin-bottom:20px">
  <span class="btn" style="font-size: 20px;font-weight: 600;padding: 0;">Welcome <em>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</em>, please click to </span>
  <a href="{{ route('seller.stock.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Add a New Stock"><i class="fas fa-plus-circle"></i> Add a New Stock</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trading.offers.all') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
              <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('seller.stock.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
              </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.trading.offers.table.id')</th>
                            <th>@lang('labels.backend.trading.requests.table.seller')</th>
                            <th>@lang('labels.backend.trading.offers.table.product')</th>
                            <th>@lang('labels.backend.trading.offers.table.variety')</th>
                            <th>@lang('labels.backend.trading.offers.table.size_from')</th>
                            <th>@lang('labels.backend.trading.offers.table.size_to')</th>
                            <th>@lang('labels.backend.trading.offers.table.packing')</th>
                            <th>@lang('labels.backend.trading.offers.table.quantity')</th>
                            <th>@lang('labels.backend.trading.offers.table.color')</th>
                            <th>Country</th>
                            <th>Price in GBP</th>
                            <th>@lang('labels.backend.trading.offers.table.status')</th>
                            <th>@lang('labels.backend.trading.offers.table.date')</th>
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
        ajax: "{{ route('seller.stock.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'seller.username', name: 'seller.username'},
            {data: 'product.name', name: 'product.name'},
            {data: 'variety_detail.name', name: 'variety_detail.name'},
            {data: 'size_from', name: 'size_from'},
            {data: 'size_to', name: 'size_to'},
            {data: 'packing_detail.name', name: 'packing_detail.name'},
            {data: 'quantity', name: 'quantity'},
            {data: 'flesh_color_detail.name', name: 'flesh_color_detail.name'},
            {data: 'country', name: 'country'},
            {data: 'price', name: 'price'},
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
                url: "{{ url('seller/trading/stock') }}"+'/'+product_id,
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
