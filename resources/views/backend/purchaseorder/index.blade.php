@extends('backend.layouts.app')
@section('title', __('menus.backend.accounts.purchaseorder.all'). ' :: ' . app_name())
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
@if(Session::has('message'))
<div class="card-body alert-success">
    <div class="row">
        <div class="col-sm-12">
    {{Session::get('message')}}
</div>
</div>
</div>
@endif
@if(Session::has('error'))
<div class="card-body alert-danger">
    <div class="row">
        <div class="col-sm-12">
    {{Session::get('error')}}
</div>
</div>
</div>
@endif
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.accounts.purchaseorder.all') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
            <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
            @role('seller')
            @else
            <a href="{{ route($route_pre.'.purchaseorder.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')" dusk="create-click"><i class="fas fa-plus-circle"></i></a>
            @endif
                  
              </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-offers">
                                <table id="data_table" class="table table-bordered data-table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>StockID</th>
                                        <th>Buyer</th>
                                        <th>Seller</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Stock Confirmation</th>
                                        <th>Delivery Date</th>
                                        <th>@lang('labels.general.actions')</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                        <tr id="filter">
                                        <th data-title="ID"></th>
                                        <th data-title="Stock"></th>
                                        <th data-title="Buyer"></th>
                                        <th data-title="Seller"></th>
                                        <th data-title="Price"></th>
                                        <th data-title="Status"></th>
                                        <th data-title="confirm"></th>
                                        <th data-title="Delivery Date"></th>
                                        <th data-title=""></th>
                                        </tr>
                                    </tfoot>    
                                </table>
                            </div>
                        </div><!--col-->
                     </div><!--row-->
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
    $('#data_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
    var table = $('#data_table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route($route_pre.'.purchaseorder.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'stock_show_url', name: 'stock_show_url'},
            {data: 'buyer_name', name: 'buyer_name'},
            {data: 'seller_name', name: 'seller_name'},
            {data: 'price', name: 'price'},
            {data: 'status', name: 'status'},
            {data: 'confirm', name: 'confirm'},
            {data: 'delivery_date', name: 'delivery_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
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
        var order_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this Purchase Order!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url($route_pre.'/accounts/purchaseorder') }}"+'/'+order_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Purchase Order has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Purchase Order not deleted', 'error');
                }
            });
          }
        });
    });
    var viewinvoiceUrl,sendInvoiceUrl;
    $('body').on('click','.sendInvoice',function(e){
        e.preventDefault();
         viewinvoiceUrl = $(this).data("viewurl");
         sendInvoiceUrl = $(this).data("url");
        Swal.fire({
            title: "Are you sure?",
            html: '<div><button class="btn btn-primary" value="send" id="sendPdf">Send</button> <button class="btn btn-success" id="viewPdf">View PDF</button> <button class="btn btn-secondary" id="cancel">Cancel</button></div>',
            type: "warning",
            showConfirmButton: false,
            showCancelButton: false
        });
    });
    $('body').on('click','#sendPdf',function(e){
        e.preventDefault();
        window.location.href = sendInvoiceUrl;
        Swal.close();
    });

    // View pdf
    $('body').on('click','#viewPdf',function(e){
        e.preventDefault();
        window.open(viewinvoiceUrl, '_blank');
    });

    $('body').on('click','#cancel',function(e){
        e.preventDefault();
        Swal.close();
    });
  });
  </script>
  @endpush
