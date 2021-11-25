@extends('backend.layouts.app')
@section('title',  __('Buyers'). ' :: ' . app_name())

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
                    Buyers <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @can('export buyers')
                <div class="btn-toolbar float-right" role="toolbar" >
                  <a href="{{ route('admin.buyers.exports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                </div>
                @endcan
                @can('add buyer')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('admin.buyers.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->
                @endcan
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="buyer_table" class="table table-bordered data-table">
                        <thead>
                        <tr>                            
                            <th>Username</th>
                            <th>Post code</th>
                            <th>Extra transport cost per ton</th>
                            <th>Number of Trucks Loads Desired Per Week</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>@lang('labels.general.actions')</th>      
                            <th>ID</th>                     
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
                                <th data-title="Username"></th>
                                <th data-title="Post code"></th>
                                <th data-title="Extra transport cost per ton"></th>
                                <th data-title="Number of Trucks Loads Desired Per Week"></th>
                                <th data-title="Balance"></th>
                                <th data-title="Status"></th>
                                <th data-title="Date"></th>
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

    $('#buyer_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" style="width:100%" placeholder="" />' );
    } );
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route('admin.buyers.index') }}",
        columns: [
            
            {data: 'username', name: 'username'},
            {data: 'postalcode', name: 'postalcode'},
            {data: 'transportation', name: 'transportation'},
            {data: 'truck_quantity', name: 'truck_quantity'},
            {data: 'balance', name: 'balance'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            
        ],
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
                url: "{{ url('admin/buyers') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Buyer has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Buyer not deleted', 'error');
                }
            });
          }
        });
    });

  });
</script>
@endpush
