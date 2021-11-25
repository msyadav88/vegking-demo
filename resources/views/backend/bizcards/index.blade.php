@extends('backend.layouts.app')

@section('title', 'Business Cards'. ' | '.app_name() )

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="card-title mb-0">
                    Business Cards <small class="text-muted"></small>
                </h4>
            </div><!--col-->
            <div class="col-sm-8">
                <form action="{{ route('admin.bizcards') }}" name="filter_matches">
                    <div class="row">
                        <div class="col-md-4">
                        <input data-id="1" class="form-control deldate delsdat truck 1 " name="from_date" id="from_date" value="{{@$_GET['from_date']}}" autocomplete="off" placeholder="From Date" type="text"/>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-4">
                            <input data-id="1" class="form-control deldate delsdat truck 1 " name="to_date" id="to_date" value="{{@$_GET['to_date']}}" autocomplete="off" placeholder="To Date" type="text"/>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="btn-toolbar" role="toolbar" aria-label="Search">
                                <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <table class="table table-bordered data-table uservisits_tbl" id="uservisits_tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Id</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                        <tr id="filter">
                            <th data-title=""></th>
                            <th data-title="User Id"></th>
                            <th data-title=""></th>
                            <th data-title="Status"></th>
                            <th data-title="Date"></th>
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
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#uservisits_tbl tr:eq(1) th').each( function () {
                var title = $(this).attr('data-title');
                if(title != '')
                    $(this).html( '<input type="text" style="width:100%" placeholder="" />' );
            } );
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                orderCellsTop: true,
                fixedHeader: true,
                //scrollX: true,
                //responsive: false,
                ajax: "{{ route('admin.bizcards') }}?@if(isset($_GET['from_date']))from_date={{@$_GET['from_date']}}&to_date={{@$_GET['to_date']}}@endif",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'image', name: 'image'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
            table.columns().every( function () {
                var that = this;
                $( 'thead input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            $("#from_date").datepicker({
                format: "mm/dd/yyyy",
                weekStart: 0,
                calendarWeeks: true,
                autoclose: true,
            })
            $("#to_date").datepicker({
                format: "mm/dd/yyyy",
                weekStart: 0,
                calendarWeeks: true,
                autoclose: true,
            })
            
        });
    </script>
@endpush