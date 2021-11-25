@extends('backend.layouts.app')

@section('title',  __('Sellers'). ' :: ' . app_name())

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
                    Seller <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @can('export sellers')
                    <div class="btn-toolbar float-right" role="toolbar" >
                        <a href="{{ route('admin.sellers.sellerexports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                    </div>
                @endcan
                @can('add seller')
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                      <a href="{{ route('admin.sellers.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                    </div><!--btn-toolbar-->
                @endcan
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="seller_table" class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Country</th>
                            <th># of Stocks Availalable</th>
                            <th>TSS</th>
                            <th>Truck Loads Sold</th>
                            <th>Trucks in last 28 days</th>
                            <th>Avg Profit</th>
                            <th>Status</th>
                            <th>@lang('labels.general.actions')</th>
                            <th>ID</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
                                <th data-title="Username"></th>
                                <th data-title="Country"></th>
                                <th data-title="# of Stocks Availalable"></th>
                                <th data-title="TSS"></th>
                                <th data-title="Truck Loads Sold"></th>
                                <th data-title="Trucks in last 28 days"></th>
                                <th data-title="Avg Profit"></th>
                                <th data-title="Status"></th>
                                <th data-title=""></th>
                                <th data-title="ID"></th>
                            </tr>
                        </tfoot>    
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
    $('#seller_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" style="width:100%" placeholder="" />' );
    } );
 
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route('admin.sellers.index') }}",
        columns: [
            {data: 'username', name: 'username'},
            {data: 'country', name: 'country'},
            {data: 'stock_count', name: 'stock_count'},
            {data: 'tss', name: 'tss'},
            {data: 'truck_loads_sold', name: 'truck_loads_sold'},
            {data: 'tls28', name: 'tls28'},
            {data: 'verified', name: 'verified'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
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
        var item_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/sellers') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Seller has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Seller not deleted', 'error');
                }
            });
          }
        });
    });

    $('body').on('click', '.resend_invite', function () {
        var item_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure?',
          text: 'Want to Resend Invite Link.',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, send it!',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "POST",
                url: "{{ url('admin/sellers/resend-invite') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Sent!', 'Invite Link has been sent.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Invite Link not sent', 'error');
                }
            });
          }
        });
    });

  });
</script>
@endpush
