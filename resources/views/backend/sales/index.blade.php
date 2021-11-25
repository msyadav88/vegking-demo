@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.sales.all'). ' :: ' . app_name())
@if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
@php $route_pre = 'admin'; @endphp
@else
@php $route_pre = 'seller'; @endphp
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
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trading.sales.all') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @can('export sales')
                <div class="btn-toolbar float-right" role="toolbar" >
                    <a href="{{ route('admin.sales.saleexports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                </div>
                @endcan
                @can('add sales')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('admin.sales.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->
                @endcan
                @role('administrator')
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="" id="saltotrans" class="btn btn-primary" data-toggle="tooltip" title="@lang('labels.general.send_to_transport')">@lang('labels.general.send_to_transport')</a>
                </div><!--btn-toolbar {{ route('admin.sales.saletotran') }}-->
                @endif
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="sales_table" class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.trading.offers.table.id')</th>
                            @role('administrator')
                            <th>Buyer</th>
                            @endif
                            <th>Product Image</th>
                            <th>Payment Term</th>
                            <th>Payment Type</th>
                            <th>Payment Currency</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Order Status</th>
                            <th>@lang('labels.backend.trading.offers.table.status')</th>
                            <th>@lang('labels.backend.trading.offers.table.date')</th>
                            @role('administrator')
                            <th>@lang('labels.general.actions')</th>
                            @endif
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
                                <th data-title="@lang('labels.backend.trading.offers.table.id')"></th>
                                @role('administrator')
                                <th data-title="Buyer"></th>
                                @endif  
                                <th data-title="Product Image"></th>
                                <th data-title="Payment Term"></th>
                                <th data-title="Payment Type"></th>
                                <th data-title="Payment Currency"></th>
                                <th data-title="Quantity"></th>
                                <th data-title="Price"></th>
                                <th data-title="Order Status"></th>
                                <th data-title="@lang('labels.backend.trading.offers.table.status')"></th>
                                <th data-title="@lang('labels.backend.trading.offers.table.date')"></th>
                                @role('administrator') <th data-title=""></th> @endif
                            </tr>
                        </tfoot>   
					</table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
<div class=" modal fade" id="ImageModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header" style="padding:15px 10px;">
            <h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="trans_title"></span> </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:15px 10px;">
           <form id="msform2">
                                <div class="stock-gallery">         
                                    <!--Carousel Wrapper-->
                                    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                        <!--Slides-->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100 image" src="" height="250px">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100 homepage_image" src="" height="250px">
                                            </div>
                                          
                                        </div>
                                        <!--/.Slides-->
                                        <!--Controls-->
                                        <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        <!--/.Controls-->
                                        <ol class="carousel-indicators">

                                          
                                        </ol>
                                    </div>
                                    <!--/.Carousel Wrapper-->        
                                </div>
                          
                    <div class="card-footer text-muted">
                        <!--<button type="button" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>-->
                        <div class="card">
                            <div class="col-xs-12 col-sm-12 col-md-12"> 
                                <div class="">
                                    <ul class="sales-card-list">
                                        <li><strong>Product: </strong><span id="product"></span> </li>
                                        <li><strong>Buyer: </strong> <span id="buyer"></span> </li>
                                        <li><strong>Size: </strong><span id="size"></span>  </li>
                                        <li><strong>Price: </strong><span id="price"></span>  </li>
                                       
                                     </ul>
                                    </div>
                                </div>
                            </div>
                    </div>
           </form>
        </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script type="text/javascript">
  $(function () {
    setTimeout(function() {
        $(".alert-danger").hide();
    }, 3000);
    $('#sales_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" style="width:100%" placeholder="" />' );
    } );
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route($route_pre.'.sales.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            @if(auth()->user()->hasRole('administrator'))
            {data: 'buyer_name', name: 'buyer_name'},
            @endif
            {data: 'image', name: 'image', orderable: false, searchable: false, width: "200px"},
            {data: 'payment_terms_name', name: 'payment_terms_name'},
            {data: 'payment_type_name', name: 'payment_type_name'},
            {data: 'currency_name', name: 'currency_name'},
            {data: 'quantity', name: 'quantity'},
            {data: 'price', name: 'price'},
            {data: 'status', name: 'status'},
            {data: 'payment_status', name: 'payment_status'},
            {data: 'created_at', name: 'created_at'},
            @if(auth()->user()->hasRole('administrator'))
            {data: 'action', name: 'action', orderable: false, searchable: false},
            @endif
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

    $('body').on('click', '.image', function (e) {
        $('.image').attr("src", $(this).find('img').attr('src'));
        $('.homepage_image').attr("src", $(this).find('img').data('homepage_image'));
        $('#product').text($(this).find('img').attr('name'));
        $('#buyer').text($(this).find('img').data('buyer'));
        $('#size').text($(this).find('img').data('size'));
        $('#price').text($(this).find('img').data('price'));
        $("#ImageModal").modal();
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
          text: 'You will not be able to recover this sale!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/trading/sales') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Sale has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Sale not deleted', 'error');
                }
            });
          }
        });
    });
	
	$('#saltotrans').on('click', function(event) {
			//alert('asa');
			event.preventDefault();
 
			$.ajax({
				url: "{{ route('admin.sales.saletotran')}}",
				method: 'GET',
				contentType: false,							
				cache: false,
				processData: false,
				dataType: "json",
				beforeSend: function(){
				},
				success: function(data)
				{
					if (data.status == 'success') {
                    $('.loading').addClass('loading_hide');
                    Swal.fire('Success!', data.message, 'success');
                    setTimeout(function() {
                        window.location.reload;
                    }, 500);
                }
				}
			});
		});	

    var viewinvoiceUrl;
    $('body').on('click','.viewInvoice',function(e){
        e.preventDefault();
        viewinvoiceUrl = $(this).data("viewurl");
        window.open(viewinvoiceUrl, '_blank');
    })
  });
  </script>
  @endpush
