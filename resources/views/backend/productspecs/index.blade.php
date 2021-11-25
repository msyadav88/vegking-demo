@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.productspecs.all') . ' :: ' . app_name())
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
                    {{ __('menus.backend.trading.productspecs.all') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @can('export product spec')
                <div class="btn-toolbar float-right" role="toolbar" >
                    <a href="{{ route('admin.productspecs.productspecexports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                </div>
                @endcan
                @can('add product spec')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('admin.productspecs.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->
                @endcan
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="order_table" class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product</th>
                            <th>Type Name</th>
                            <th>Display Name</th>
                            <th>Importance</th>
                            <th>Order</th>
                            <th>Shortcode</th>
                            <th>Buyer HasMany</th>
                            <th>Stock HasMany</th>
							<th>Display in transport</th>
                            <th>Required</th>
                            <th>Default</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
                                <th data-title="Id"></th>
                                <th data-title="Product"></th>
                                <th data-title="Type Name"></th>
                                <th data-title="Display Name"></th>
                                <th data-title="Importance"></th>
                                <th data-title="Order"></th>
                                <th data-title="Shortcode"></th>
                                <th data-title="Buyer HasMany"></th>
                                <th data-title="Stock HasMany"></th>
                                <th data-title="Display in transport"></th>
                                <th data-title="Required"></th>
                                <th data-title="Default"></th>
                                <th data-title=""></th>
                            </tr>
                        </tfoot>      
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
@push('after-styles')
<link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
<style>
table.dataTable tr th:first-child {cursor: move;}
table.dataTable tr td:first-child {cursor: move;}
</style>
@endpush
@push('after-scripts')
<script src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript">
  $(function () {
    setTimeout(function() {
        $(".alert-danger").hide();
    }, 3000);
    $('#order_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );  
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        responsive: {
            details: {
                type: 'column',
                target: 0,
            },
        },
        rowReorder: {
            selector: 'td:nth-child(2)',
            dataSrc: 1,
        },
        order: [ [5, 'asc'] ],
        ajax: "{{ route('admin.productspecs.index') }}",
        columns: [
                    {data:'id',name: 'id'},
                    {data: 'product_name', name: 'product_name'},
                    {data:'type_name', name:'type_name'},
                    {data: 'display_name', name: 'display_name'},
                    {data: 'importance', name: 'importance'},
                    {data: 'order', name: 'order'},
                    {data: 'shortcode', name: 'shortcode'},
                    {data: 'buyer_hasmany', name: 'buyer_hasmany'},
                    {data: 'stock_hasmany', name: 'stock_hasmany'},
                    {data: 'display_in_transport', name: 'display_in_transport'},
                    {data: 'required', name: 'required'},
                    {data: 'default_val', name: 'default_val'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]        
    });
	table.on( 'row-reorder', function ( e, diff, edit ) {
	    var myArray = [];
	    for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
	        var rowData = table.row( diff[i].node ).data();
      		myArray.push({
      		    id: rowData.id,
      		    position: diff[i].newPosition,
      		});
	    }
       var jsonString = JSON.stringify(myArray);
       console.log("jsonString",jsonString);
	   $.ajax({
              url     : '{{ route('admin.productspec.reorder') }}',
              type    : 'POST',
              data    : jsonString,
              dataType: 'json',
              success : function ( json ){
                    table.draw();
                        $.each(json, function (key, msg) {
                    	// handle json response
                        });
                    }
                });
  	});
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
                url: "{{ url('admin/trading/productspecs') }}"+'/'+item_id,
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
