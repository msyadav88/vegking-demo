@extends('backend.layouts.app')
@section('title', __('menus.backend.accounts.invoices.all'). ' :: ' . app_name())
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

        <div class="col-sm-12">
      </div>
            <div class="col-sm-2">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.accounts.invoices.all') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->
            
            <div class="col-sm-10">
            <div class="form-group row">

        

          <div class="col-md-3">
            <select class="form-control select2" id="type_filter" name="type_filter">
              <option value="">Select Invoices Type</option>
              <option value="Trading" @if(isset($_GET['type']) && $_GET['type'] == "Trading") selected @endif>Trading</option>
              <option value="Transport" @if(isset($_GET['type']) && $_GET['type'] == "Transport") selected @endif>Transport</option>
              <option value="Purchase Order" @if(isset($_GET['type']) && $_GET['type'] == "Purchase Order") selected @endif>Purchase Order</option>
            </select>
          </div>
          @if(isset($seller_list))
          <div class="col-md-3">
            
                <select class="form-control select2" id="seller_filter" name="seller_filter">
                    <option value="">Select Seller</option>
                    @foreach($seller_list as $seller)
                    <option value="{{$seller->id}}" @if(isset($_GET['seller']) && $_GET['seller'] == $seller->id) selected @endif>
                    {{ @$seller->username}}
                    </option>
                    @endforeach
                </select>
            </div>
            @endif
            @if(isset($buyers_list))
            <div class="col-md-3">
                <select class="form-control select2" id="buyer_filter" name="buyer_filter">
                    <option value="">Select buyer</option>
                    @foreach($buyers_list as $buyer)
                    <option value="{{$buyer->id}}" @if(isset($_GET['buyer']) && $_GET['buyer'] == $buyer->id) selected @endif>
                    {{ @$buyer->username}}
                    </option>
                    @endforeach
                </select>
            </div>
        @endif
         
          <div class="col-md-2">
            <div class="matches_header">
              <button class="btn btn-success float-left" type="submit" name="filter_invoice" onclick="window.location.href='{{ route('admin.invoices.index') }}?type='+$('#type_filter').val()+'&seller='+$('#seller_filter').val()+'&buyer='+$('#buyer_filter').val()"><i class="fas fa-filter"></i>Filter</button>
            </div>
           
          </div>
        </div>
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
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Paid</th>
                                        <th>Status</th>
                                        <th>Buyer</th>
                                        <th>Seller</th>
                                        <th>Product</th>
                                        <th>Quantity Type</th>
                                        <th>Invoice Type</th>
                                        <th>Quantity</th>
                                        <th>Gross</th>
                                        <th>Net</th>
                                        <th>VAT</th>
                                        <th>@lang('labels.general.actions')</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                        <tr id="filter">
                                        <th data-title="ID"></th>
                                        <th data-title="Order ID"></th>
                                        <th data-title="Date"></th>
                                        <th data-title="Amount"></th>
                                        <th data-title="Paid"></th>
                                        <th data-title="Status"></th>
                                        <th data-title="Buyer"></th>
                                        <th data-title="Seller"></th>
                                        <th data-title="Product"></th>
                                        <th data-title="Quantity Type"></th>
                                        <th data-title="Invoice Type"></th>
                                        <th data-title="Quantity"></th>
                                        <th data-title="Gross"></th>
                                        <th data-title="Net"></th>
                                        <th data-title="VAT"></th>
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
        ajax: "{{ route($route_pre.'.invoices.index')}}?type={{@$_GET['type']}}&seller={{@$_GET['seller']}}&buyer={{@$_GET['buyer']}}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'sale_show_url', name: 'sale_show_url'},
            {data: 'date', name: 'date'},
            {data: 'amount', name: 'amount'},
            {data: 'paid', name: 'paid'},
            {data: 'status', name: 'status'},
            {data: 'buyer_name', name: 'buyer_name'},
            {data: 'seller_name', name: 'seller_name'},
            {data: 'product_name', name: 'product_name'},
            {data: 'quantity_type', name: 'quantity_type'},
            {data: 'invoice_type', name: 'invoice_type'},
            {data: 'quantity', name: 'quantity'},
            {data: 'gross', name: 'gross'},
            {data: 'net', name: 'net'},
            {data: 'vat', name: 'vat'},
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
          text: 'You will not be able to recover this Invoice!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url($route_pre.'/accounts/invoices') }}"+'/'+order_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Invoice has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Invoice not deleted', 'error');
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
    $('body').on('click', '.confirmOrder', function () {
        var order_id = $(this).data("id");
        var status = $(this).data("status");
        Swal.fire({
          title: 'Are you sure want to Confirm Order?',
          text: 'You will be able to Confirm Order!',
          type: 'info',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "POST",
                url: "{{ url('seller/confirm-order') }}/"+ order_id +"/"+status,
                success: function (data) {
                    Swal.fire('Deleted!', 'Purchase Order has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                    console.log(data);
                  Swal.fire('Error!', 'Purchase Order not deleted', 'error');
                }
            });
          }
        });
    });
  });
  </script>
  @endpush
