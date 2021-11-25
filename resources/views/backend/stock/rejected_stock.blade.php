@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.rejectedstock.all') . ' :: '. app_name())
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trading.rejectedstock.all') }} <small class="text-muted"></small>
                </h4>
            </div>
            
            <div class="col-sm-7">
          
            </div>
        </div>
      <input type="hidden" name="show_matched" id="show_matched" value="loaded">
        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="warehouse_table" class="table table-bordered data-table">
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
                            <th>Load Status</th>
                            <th>@lang('labels.backend.trading.offers.table.status')</th>
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
        ajax: "{{ route('admin.trading.rejectedstock') }}",
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
            {data: 'load_status', name: 'load_status'},
            {data: 'status', name: 'status'}
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
