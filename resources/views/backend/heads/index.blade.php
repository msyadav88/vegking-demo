@extends('backend.layouts.app')

@section('title', __('Trade Settings') . ' :: ' .app_name())


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
            <div class="col-sm-3">
                <h4 class="card-title mb-0">
                    Trade Settings <small class="text-muted"></small>
                </h4>
            </div><!--col-->
			<div class="col-sm-4">
			  <div class="form-group row">
				<label class="col-md-4 form-control-label" for="type">Type filter</label>
				<div class="col-md-8">
					<select class="form-control" id="type" name="type" onchange="window.location.href='{{ route('admin.appheads.index') }}?typename='+this.value">
					  <option value="">All Type</option>
					  <option value="product" @if(isset($_GET['typename']) && $_GET['typename'] =='product' ) selected @endif >Product</option>
                      <option value="potato_variety" @if(isset($_GET['typename']) && $_GET['typename'] =='potato_variety' ) selected @endif >Potato Variety</option>
					  <option value="packaging" @if(isset($_GET['typename']) && $_GET['typename'] =='packaging' ) selected @endif >Packaging</option>
					  <option value="purpose" @if(isset($_GET['typename']) && $_GET['typename'] =='purpose' ) selected @endif >Purpose</option>
					  <option value="defects" @if(isset($_GET['typename']) && $_GET['typename'] =='defects' ) selected @endif >Defects</option>
					  <option value="flesh_color" @if(isset($_GET['typename']) && $_GET['typename'] =='flesh_color' ) selected @endif >Flesh color</option>
					  <option value="soil" @if(isset($_GET['typename']) && $_GET['typename'] =='soil' ) selected @endif >Soil</option>
                 <option value="trust_level" @if(isset($_GET['typename']) && $_GET['typename'] =='trust_level' ) selected @endif >Trust Level</option>
					</select>
				</div>
			  </div>
			</div>
            <div class="col-sm-5">
              <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('admin.appheads.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
              </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                  <div id="result"></div>
                      <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.trading.offers.table.id')</th>
                            <th>@lang('labels.backend.trading.requests.table.name')</th>
                            <th>Product</th>
                            @if(isset($_GET['typename']) && $_GET['typename'] =='potato_variety')
                            <th>Flesh Color</th>
                            <th>Tuber Shape</th>
                            <th>Colour of Skin</th>
                            <th>Depth of Eyes</th>
                            <th>Smoothness of Skin</th>
                            <th>Dry Matter %</th>
                            @else
                            <th>@lang('labels.backend.trading.offers.table.desc')</th>
                            @endif
                            @if(isset($_GET['typename']) && $_GET['typename'] =='product')
                            <th>Price/Ton(PLN)</th>
                            @endif
                            <th>P %</th>
                            <th>VF %</th>
                            <th>ESC</th>
                            <th>ECBF</th>
                            <th>Default</th>
                            <th>@lang('labels.backend.trading.offers.table.type')</th>
                            <th>Order</th>
                            <th>Status</th>
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
@push('after-styles')
<link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
<style>
table.dataTable tr th:first-child {cursor: move;}
table.dataTable tr td:first-child {text-align: center;cursor: move;}
</style>
@endpush
@push('after-scripts')
<script src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript">
   $(function () {
    setTimeout(function() {
        $(".alert-danger").hide();
    }, 3000);
        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        rowReorder: {
            dataSrc: 'readingOrder',
            update: false
        },
        order: [ [10, 'asc'] ],
		ajax: "{{ route('admin.appheads.index') }}"+'?@if(isset($_GET['typename']))typename={{$_GET['typename']}}@endif',
		columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'product_id.name', name: 'product_id.name'},
            @if(isset($_GET['typename']) && $_GET['typename'] =='potato_variety')
            {data: 'flesh_color.name', name: 'flesh_color.name', defaultContent:''},
            {data: 'tuber_shape', name: 'tuber_shape'},
            {data: 'colour_of_skin', name: 'colour_of_skin'},
            {data: 'depth_of_eyes', name: 'depth_of_eyes'},
            {data: 'smoothness_of_skin', name: 'smoothness_of_skin'},
            {data: 'dry_matter', name: 'dry_matter'},
            @else
            {data: 'desc', name: 'desc'},
            @endif
            @if(isset($_GET['typename']) && $_GET['typename'] =='product')
            {data: 'base_price', name: 'base_price'},
            @endif
            {data: 'premium', name: 'premium'},
            {data: 'volume', name: 'volume'},
            {data: 'extra_supply_cost', name: 'extra_supply_cost'},
            {data: 'extra_cost_to_buyer_factor', name: 'extra_cost_to_buyer_factor'},
            {data: 'default', name: 'default'},
            {data: 'type', name: 'type'},
            {data: 'order', name: 'order'},
            {data: 'is_active', name: 'Active'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],

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
	   $.ajax({
              url     : '{{ route('admin.table.reorder') }}',
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



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.editItem', function () {
        var item_url = $(this).data("url");
        window.location.href = item_url;
    });

    $('body').on('click', '.deleteItem', function () {
        var product_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this Head!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/appheads') }}"+'/'+product_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Head has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Head not deleted', 'error');
                }
            });
          }
        });
    });

  });
</script>
@endpush
