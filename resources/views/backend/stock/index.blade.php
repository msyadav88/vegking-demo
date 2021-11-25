@extends('backend.layouts.app')
@role('seller')
@php $route_pre = 'seller'; @endphp
@else
@php $route_pre = 'admin'; @endphp
@endif  

@role('seller')
@php $route_pre = 'seller';
 $redirecturl =  route($route_pre.'.stockv2.index');
 @endphp
@else
@php $route_pre = 'admin';
 $redirecturl =  route($route_pre.'.stockv2.index');
 @endphp
@endif
@section('title', __('menus.backend.trading.offers.all') . ' :: ' .app_name())
@push('after-styles')
    <style>
        .float-right form {
            position: relative;
        }

        #upload_stock > input.btn.btn-info.ml-1 {
            position:absolute;
            top:0;
            right:0;
            margin:0;
            bottom:0;
            opacity:0;
            filter:alpha(opacity=0);
            font-size:5px;
            cursor:pointer;
            width: 80px;
        }
    </style>
@endpush
@role('seller')
@php $route_pre = 'seller'; @endphp
@else
@php $route_pre = 'admin'; @endphp
@endif
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
            <div class="col-sm-4">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trading.offers.all') }} <small class="text-muted"></small>
                    @role('seller') 
                     <!-- route(seller.stock.index)  -->
                    <a href="{{ route($route_pre.'.stock.index') }}" class="btn btn-info btn-md ml-1" title="Card View" data-toggle="tooltip" ><i class="fas fa-list"></i></a>
                    @endrole
                </h4>
            </div><!--col-->
            <div class="col-sm-4">
                <div class="form-group row">
                   
                  <div class="col-md-10">
                    {{ html()->select('product_id')
                    ->class('select2 form-control')
                    ->attribute('maxlength', 191)
                    ->options($products)
                    ->value(@$_GET['product_id'])
                      ->attribute('onchange', 'fetch_select(this.value)')
                    
                  }}

                </div>
            </div>
            </div>
            <div class="col-sm-4">
                <div class="btn-toolbar float-right" role="toolbar" >
                    @role('seller')
                    @else
                        @can('export stocks')
                            <a href="{{ route('admin.stock.stocksexports') }}" class="btn btn-warning ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download">Download</i></a>
                        @endcan
                    @endif
                </div>
                
              <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                @can('add stock') 
                    @role('seller') 
                        <a href="javascript:void(0);" data-target="#createModals"  class="btn btn-success ml-1" data-toggle="modal" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                        @include('backend.includes.stock-modal2',['productimage' => '$productsimage'])
                    @else
                        <a href="{{ route($route_pre.'.stockcardview') }}" class="btn btn-info btn-md ml-1" title="Card View" data-toggle="tooltip" ><i class="fas fa-list"></i></a>
                    @endif    
                @endcan
            </div><!--btn-toolbar-->
            <div class="btn-toolbar float-right">
                @role('seller')
                @else
                <form action="{{ route('admin.stock.stockimport') }}" method="POST" enctype="multipart/form-data" id="upload_stock">
                    {{ csrf_field() }}
                    <span class="fileupload-exists btn btn-primary ml-1"><i class="fa fa-upload">Upload</i></span>    
                    <input type="file" name="stock_file" class="btn btn-info ml-1" onchange="$('#upload_stock').submit();" >
                </form>
                @endif
            </div>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                    <table id="stock_table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>@lang('labels.backend.trading.offers.table.id')</th>
                                <th>@lang('labels.backend.trading.requests.table.seller')</th>
                                <th>@lang('labels.backend.trading.offers.table.product')</th>
                                @foreach($ProdSpecArr as $spec)
                                    <th>{{ $spec }}</th>
                                @endforeach
                                <th>@lang('labels.backend.trading.offers.table.size')</th>
                                <th>Country</th>
                                <th>Price</th>
                                <th>Pallets</th>
                                <th>@lang('labels.backend.trading.offers.table.status')</th>
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
var save_stock_url = '{{route($route_pre.'.stockv2.store')}}';
var redirecturl = '{{ $redirecturl }}';

  $(function () {
    setTimeout(function() {
        $(".alert-danger").hide();
    }, 3000);

	$('#stock_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route($route_pre.'.stock.index') }}"+'?@if(isset($_GET['product_id']))product_id={{$_GET['product_id']}}@endif',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'seller_username', name: 'seller_username'},
            {data: 'product_name', name: 'product_name'},
            @if(isset($ProdSpecArrNames['field1']) && $ProdSpecArrNames['field2'] != '')
            {data: 'field1', name: 'field1'},
            @endif
            @if(isset($ProdSpecArrNames['field2']) && $ProdSpecArrNames['field2'] != '')
            {data: 'field2', name: 'field2'},
            @endif
            @if(isset($ProdSpecArrNames['field3']) && $ProdSpecArrNames['field3'] != '')
            {data: 'field3', name: 'field3'},
            @endif
            {data: 'size', name: 'size'},
            {data: 'country', name: 'country'},
            {data: 'price', name: 'price'},
            {data: 'pallets', name: 'pallets'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
/*
	table.columns().every( function () {
        var that = this;
		$( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
	} );
*/
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
                url: "{{ url($route_pre.'/trading/stock') }}"+'/'+product_id,
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
  function fetch_select(id){
    var rt = '{{ route($route_pre.'.stock.index') }}';
    window.location.href=rt+'?product_id='+id;
}
</script>
@endpush
