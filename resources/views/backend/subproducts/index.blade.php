@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.subproducts.all'). ' :: ' . app_name())
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
                    {{ __('menus.backend.trading.subproducts.all') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @can('export products')
                <div class="btn-toolbar float-right" role="toolbar" >
                    <a href="{{ route('admin.subproducts.subproductsexports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                </div>
                @endcan
                @can('add products')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="{{ route('admin.subproducts.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
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
                                <th>@lang('labels.backend.trading.products.table.product') (EN)</th>
                                <th>@lang('labels.backend.trading.products.table.subproduct') (EN)</th>
                                <th>@lang('labels.backend.trading.products.table.subproduct') (PL)</th>
                                <th>@lang('labels.backend.trading.products.table.subproduct') (DE)</th>
                                <th>@lang('labels.backend.trading.products.table.sub_product_image')</th>
                                <th>@lang('labels.backend.trading.products.table.type')</th>
                                <th>@lang('labels.backend.trading.products.table.status')</th>
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
<div class=" modal fade" id="ImageModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header" style="padding:15px 10px;">
            <h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="trans_title"></span> </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:15px 10px;">
           <form id="msform2">
                                <div class="stock-gallery">         
                                    <!--Carousel Wrapper-->
                                    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                        <!--Slides-->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100 image" src="" height="250px">
                                            </div>
                                        </div>
                                        <!--/.Slides-->
                                        <!--Controls-->
                                        <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        <!--/.Controls-->
                                        <ol class="carousel-indicators">

                                          
                                        </ol>
                                    </div>
                                    <!--/.Carousel Wrapper-->        
                                </div>
                          
                    <div class="card-footer text-muted">
                        <!--<button type="button" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>-->
                        <div class="card">
                            <div class="col-xs-12 col-sm-12 col-md-12"> 
                                <div class="">
                                    <ul class="stock-card-list">
                                        <li><strong>Product: </strong><span id="product"></span> </li>
                                        <li><strong>Type: </strong><span id="type"></span></li>
                                     </ul>
                                    </div>
                                </div>
                            </div>
                    </div>
           </form>
        </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script type="text/javascript">
    $(function () {
        $('body').on('click', '.image', function (e) {
            $('.image').attr("src", $(this).find('img').attr('src'));
            $('#product').text($(this).find('img').data('product'));
            $('#type').text($($(this)).find('img').data('type'));
            $("#ImageModal").modal();
        });

        setTimeout(function() {
            $(".alert-danger").hide();
        }, 3000);
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.subproducts.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'sub_pro_name_en', name: 'sub_pro_name_en'},
                {data: 'sub_pro_name_pl', name: 'sub_pro_name_pl'},
                {data: 'sub_pro_name_de', name: 'sub_pro_name_de'},
                {data: 'image', name: 'image', orderable: false, searchable: false, width: "200px"},
                {data: 'sub_pro_type', name: 'sub_pro_type'},
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
                text: 'You will not be able to recover this product!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/trading/subproducts') }}"+'/'+product_id,
                    success: function (data) {
                        Swal.fire('Deleted!', 'Sub Product has been deleted.', 'success');
                        table.draw();
                    },
                    error: function (data) {
                    Swal.fire('Error!', 'Sub Product not deleted', 'error');
                    }
                });
            }
            });
        });
    });
  </script>
  @endpush
