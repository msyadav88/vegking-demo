@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.productspecvalues.all') . ' :: '. app_name())
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
            <div class="col-sm-3">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trading.productspecvalues.all') }} <small class="text-muted"></small>
                </h4>
            </div>
            <!--col-->
            <div class="col-sm-3">
			  <div class="form-group row">
              <label class="col-md-4 form-control-label" for="type">Product</label>
                  <div class="col-md-8">
                    {{ html()->select('product_id')
                    ->class('select2 form-control')
                    ->attribute('maxlength', 191)
                    ->options($products)
                    ->value(@$_GET['product_id'])
                      ->attribute('onchange', 'fetch_select(this.value)')
                      ->placeholder('Choose Product')
                  }}
				
			  </div>
			</div>    
			</div>   
            <div class="col-sm-3">
                <div class="form-group row">
                    <label class="col-md-4 form-control-label" for="type">Product Spec</label>
                    <div class="col-md-8">
                        <select class="form-control select2" id="product_spec_filter" name="product_spec_filter" onchange="window.location.href='{{ route('admin.productspecvalues.index') }}?product_id={{@$_GET['product_id']}}&typename='+this.value">
                            <option value="">Choose Product Specification</option>
                            @foreach($product_list_main as $value)
                            <option value="{{$value['display_name']}}" @if(isset($_GET['typename']) && $_GET['typename']==$value['display_name']) selected @endif>
                                {{ @$value['display_name']}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                @can('export product spec values')
                <div class="btn-toolbar float-right" role="toolbar" >
                    <a href="{{ route('admin.productspecvalues.productspecvaluesexports') }}?@if(isset($_GET['product_id']))product_id={{$_GET['product_id']}}@endif&@if(isset($_GET['typename']))typename={{$_GET['typename']}}@endif" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                </div>
                @endcan
                @can('add product spec values')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="{{ route('admin.productspecvalues.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                </div>
                @endcan
                <!--btn-toolbar-->
            </div>
            <!--col-->
        </div>
        <!--row-->
        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                    <table id="order_table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product</th>
                                <th>ProductSpec</th>
                                <th>Value</th>
                                <th>Shortcode</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
                                <th data-title="Id"></th>
                                <th data-title="Product"></th>
                                <th data-title="ProductSpec"></th>
                                <th data-title="Value"></th>
                                <th data-title="Shortcode"></th>
                                <th data-title="Status"></th>
                                <th data-title=""></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@push('after-scripts')
<script type="text/javascript">
    $(function() {
        setTimeout(function() {
        $(".alert-danger").hide();
    }, 3000);
        $('#order_table #filter th').each(function() {
            var title = $(this).attr('data-title');
            if (title != '')
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.productspecvalues.index') }}"+'?@if(isset($_GET['product_id']))product_id={{$_GET['product_id']}}@endif&@if(isset($_GET['typename']))typename={{$_GET['typename']}}@endif',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'product_name',
                    name: 'product_name'
                },
                {
                    data: 'product_spec',
                    name: 'product_spec'
                },
                {
                    data: 'value',
                    name: 'value'
                },
                {
                    data: 'shortcode',
                    name: 'shortcode'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change clear', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.editItem', function() {
            var item_url = $(this).data("url");
            window.location.href = item_url;
        });

        $('body').on('click', '.viewItem', function() {
            var item_url = $(this).data("url");
            window.location.href = item_url;
        });

        $('body').on('click', '.deleteItem', function() {
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
                        url: "{{ url('admin/trading/productspecvalues') }}" + '/' + item_id,
                        success: function(data) {
                            Swal.fire('Deleted!', 'Request has been deleted.', 'success');
                            table.draw();
                        },
                        error: function(data) {
                            Swal.fire('Error!', 'Request not deleted', 'error');
                        }
                    });
                }
            });
        });

    });
    function fetch_select(id){
        //alert(id);
     var rt = '{{ route('admin.productspecvalues.index') }}';
     window.location.href=rt+'?product_id='+id;
}
</script>
@endpush