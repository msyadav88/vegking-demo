@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.products.all'). ' :: ' . app_name())
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
                    {{ __('menus.backend.trading.products.all') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @can('export products')
                <div class="btn-toolbar float-right" role="toolbar" >
                    <a href="{{ route('admin.products.productsexports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                </div>
                @endcan
                @can('add products')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
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
                                <th>@lang('labels.backend.trading.products.table.id')</th>
                                <th>@lang('labels.backend.trading.products.table.product')</th>
                                <th>@lang('labels.backend.trading.products.table.product') (PL)</th>
                                <th>@lang('labels.backend.trading.products.table.product') (DE)</th>
                                <th>@lang('labels.backend.trading.products.table.product_image')</th>
                                <th>@lang('labels.backend.trading.products.table.stock_image')</th>
                                <th>@lang('labels.backend.trading.products.table.status')</th>
                                <th>@lang('labels.backend.trading.products.table.type')</th>
                                <th>@lang('labels.backend.trading.products.table.date')</th>
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
        setTimeout(function() {
        $(".alert-danger").hide();
    }, 3000);
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.products.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'name_pl', name: 'name_pl'},
                {data: 'name_de', name: 'name_de'},
                {data: 'image', name: 'image', orderable: false, searchable: false, width: "200px"},
                {data: 'homepage_image', name: 'homepage_image', orderable: false, searchable: false, width: "200px"},
                {data: 'status', name: 'status'},
                {data: 'type', name: 'type'},
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
                text: 'You will not be able to recover this product!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/trading/products') }}"+'/'+product_id,
                    success: function (data) {
                        Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                        table.draw();
                    },
                    error: function (data) {
                    Swal.fire('Error!', 'Product not deleted', 'error');
                    }
                });
            }
            });
        });
    });
  </script>
  @endpush
