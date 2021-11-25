@extends('backend.layouts.app')
@section('title',  __('Contact Us'). ' :: ' . app_name())

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
                    Contact  Us <small class="text-muted"></small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="contact_table" class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>E-mail</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
                                <th data-title="ID"></th>
                                <th data-title="Name"></th>
                                <th data-title="Company"></th>
                                <th data-title="E-mail"></th>
                                <th data-title="Phone"></th>
                                <th data-title="Message"></th>
                                <th data-title="Date"></th>
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

    $('#contact_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" style="width:100%" placeholder="" />' );
    } );
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: false,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route('admin.analytics.contact') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'company', name: 'company'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'message', name: 'message'},
            {data: 'created_at', name: 'created_at'},
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
  });
</script>
@endpush