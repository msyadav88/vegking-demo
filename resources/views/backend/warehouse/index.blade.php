@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.warehouse.all') . ' :: '. app_name())
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trading.warehouse.all') }} <small class="text-muted"></small>
                </h4>
            </div>
            
            <div class="col-sm-7">
            <div class="btn-toolbar float-right" role="toolbar" >
                    <a href="{{ route('admin.warehouse.warehouseexports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                </div>
            </div>
        </div>

      <div id="warehouse" class="row col-md-12 mt-3">
          <ul class="nav nav-tabs col-md-12" role="tablist">
              <li class="nav-item"><a class="nav-link @if(request()->input('show_matched') == 'loaded') active @endif " href="loaded" data-toggle="tab" role="tab">Loaded</a></li>
              <li class="nav-item"><a class="nav-link @if(request()->input('show_matched') == 'rejected') active @endif" href="rejected" data-toggle="tab" role="tab">Rejected</a></li>
         </ul>
      </div>
      <input type="hidden" name="show_matched" id="show_matched" value="loaded">
        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="warehouse_table" class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Flesh Color</th>
                            <th>Purpose</th>
                            <th>Defect</th>
                            <th>Soil</th>
                            <th>Variety Name</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Postcode</th>
                            <th>Tons</th>
                            <th>Product</th>
                            <th>Date Stored</th>
                            <th>Notes</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
                                <th data-title="Id"></th>
                                <th data-title="Flesh Color"></th>
                                <th data-title="Purpose"></th>
                                <th data-title="Defect"></th>
                                <th data-title="Soil"></th>
                                <th data-title="Variety Name"></th>
                                <th data-title="Country"></th>
                                <th data-title="City"></th>
                                <th data-title="Postcode"></th>
                                <th data-title="Tons"></th>
                                <th data-title="Product"></th>
                                <th data-title="Date Stored"></th>
                                <th data-title="Notes"></th>
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

@push('after-scripts')
<script type="text/javascript">
  $(function () {
    $('#warehouse_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
     if (window.location.href.indexOf("=") > -1) {
        var url= window.location.href;
        var shw_mtch = url.split('=');
        var show_matched = shw_mtch[shw_mtch.length - 1];
    }else{
         var show_matched = 'loaded';
    }
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route('admin.warehouse.index') }}?show_matched="+show_matched,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'flesh_color', name: 'flesh_color'},
            {data: 'purposes', name: 'purposes'},
            {data: 'defect', name: 'defect'},
            {data: 'soil', name: 'soil'},
            {data: 'variety_name', name: 'variety_name'},
            {data: 'country', name: 'country'},
            {data: 'city', name: 'city'},
            {data: 'postcode', name: 'postcode'},
            {data: 'tons', name: 'tons'},
            {data: 'product', name: 'product'},
            {data: 'dateStored', name: 'dateStored'},
            {data: 'notes', name: 'notes'},
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
    $('#warehouse a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

      var show_matched = $(e.target).attr("href");
     
      window.location.href = "{{ route('admin.warehouse.index') }}?show_matched="+show_matched;
   });
  });
  </script>
  @endpush
