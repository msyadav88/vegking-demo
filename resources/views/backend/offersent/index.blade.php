@extends('backend.layouts.app')
@section('title', __('menus.backend.trading.offersent.all'). ' :: ' . app_name())
@role('seller')
@php $route_pre = 'seller'; @endphp
@else
@php $route_pre = 'admin'; @endphp
@endif
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">

        <div class="col-sm-5">
                <h4 class="card-title mb-0">
                @role('seller')
                    Offer
                @else
                    {{ __('menus.backend.trading.offersent.all') }} <small class="text-muted"></small>
                @endif
                </h4>
            </div><!--col-->
            <div class="col-sm-7">
            <div class="btn-toolbar float-right" role="toolbar" >
                <a href="{{ route('admin.offersent.offersentexports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                </div>
              <!--btn-toolbar-->
            </div><!--col-->
            <form action="{{ route('admin.offersent.index') }}" name="filter_matches">
                <div class="col-md-12">
                    <div class="btn-toolbar float-right" role="toolbar" >
                    </div>
                </div>
            </form>

        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="order2_table" class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.trading.offers.table.id')</th>
                            @role('administrator')
                            <th>Confirmation</th>
                            <th>Buyer</th>
                            <th>Stock Id</th>
                            @endif
                            <th>Product Name</th>
                            <th>Product Image</th>
                            @foreach($ProdSpecArr as $spec)
                                <th>{{ $spec }}</th>
                            @endforeach
                            <th>Size From</th>
                            <th>Size To</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <!-- <th>@lang('labels.backend.trading.offers.table.date')</th> -->
                            @role('administrator') <th>@lang('labels.general.actions')</th>  @endif
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
                                <th data-title="@lang('labels.backend.trading.offers.table.id')"></th>
                                @role('administrator')
                                <th data-title="confirmation"></th>
                                <th data-title="Buyer"></th>
                                <th data-title="Seller"></th>
                                @endif
                                <th data-title="Product Name"></th>
                                <th data-title="Product Image"></th>
                                @foreach($ProdSpecArr as $spec)
                                    <th data-title="{{ $spec }}"></th>
                                @endforeach
                                <th data-title="Size From"></th>
                                <th data-title="Size To"></th>
                                <th data-title="Quantity"></th>
                                <th data-title="Price"></th>
                                <!-- <th data-title="@lang('labels.backend.trading.offers.table.date')"></th> -->
                                @role('administrator') <th data-title=""></th>  @endif
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
                                    <ul class="offersent-card-list">
                                        <li><strong>Product: </strong><span id="product"></span> </li>
                                        <li><strong>Buyer: </strong> <span id="buyer"></span> </li>
                                        <li><strong>Seller: </strong><span id="seller"></span>  </li>
                                        <li><strong>Price: </strong><span id="price"></span>  </li>
                                        <li><strong>Size: </strong><span id="size"></span>  </li>

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

<div class="modal fade" id="notesmodal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:15px 50px;">
                <h4 style="text-align: center; width: 100%;">Add Addition Information</h4>

            </div>
            <div class="modal-body" style="padding:15px 50px;">
                <form role="form" id="addnotes_form">
                    <input type="hidden" name="offersent_id" id="offersent_id" value="0">
                    <div class="form-group">
                        <label for="group"><span class="glyphicon glyphicon-user"></span>Notes</label>
                        <textarea name="notes" id="notes" class="form-control"  placeholder="Enter here"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <a href="javascript:void(0);" id="add_notes_btn" class="btn btn-success btn-block">Add</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script type="text/javascript">
  $(function () {
    $('#order2_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        $("#stock_filter").select2();
        $("#buyer_filter").select2();
        $("#product_id").select2();

            if(title=='ID')
        {
            $(this).html(`<div><select class="form-control select2" id="stock_filter" name="stock_filter" ><option value="">Select Stock</option>
                        @foreach($stock_list as $stock)
                        <option value="{{$stock->id}}" @if(isset($_GET['stock']) && $_GET['stock'] == $stock->id) selected @endif>
                            #{{ @$stock->id }} {{ @$stock->product->name}} [{{ @$stock->seller->username}}]
                        </option>
                        @endforeach
                        </select>
                    </div>
            `);
        }
        else if(title=='Buyer'){
            $(this).html(`<div> <select class="form-control select2" id="buyer_filter" name="buyer_filter" >
                        <option value="">Select Buyer</option>
                        @foreach($buyers_list as $buyer)
                        <option value="{{$buyer->username}}" @if(isset($_GET['$buyer->username']) && $_GET['$buyer->username'] == $buyer->id) selected @endif>
                            {{ @$buyer->username}}
                        </option>
                        @endforeach
                        </select>
                    </div>
            `);
        }
        else if(title=='Product Name'){
            $(this).html(`<div>
                        <select class="form-control select2" id="product_id" name="product_id">
                        <option value="">Select Product</option>
                        @foreach($products as $key => $product)
                        <option value="{{$product}}">
                            {{ @$product}}
                        </option>
                        @endforeach
                        </select>
                    </div>
            `);
        }
        else{
            $(this).html( '<input type="text" placeholder="Search" />' );
        }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax:
        {
            url:"{{ route($route_pre.'.offersent.index')}}?@if(isset($_GET['product_id']))stock={{@$_GET['stock']}}&buyer={{@$_GET['buyer']}}&seller={{@$_GET['seller']}}&product_id={{@$_GET['product_id']}}&field1={{@$_GET['field1']}}&field2={{@$_GET['field2']}}&packing={{@$_GET['packing']}}&offer_sent_date={{@$_GET['offer_sent_date']}}@endif",
           data: function(d){
           d.stock_filter = $('#stock_filter').val();
           d.buyer_filter = $('#buyer_filter').val();
           d.product_id  = $('#product_id').val();
         }
       },
        columns: [
            {data: 'id', name: 'id'},
            @if(auth()->user()->hasRole('administrator'))
            {data: 'confirmation', name: 'confirmation'},
            {data: 'buyer_name', name: 'buyer_name'},
            {data: 'seller_name', name: 'seller_name'},
            @endif
            {data: 'product_name', name: 'product_name'},
            {data: 'image', name: 'image', orderable: false, searchable: false, width: "200px"},
             @if(isset($ProdSpecArrNames['field1']) && $ProdSpecArrNames['field1'] != '')
            {data: 'field1', name: 'field1'},
            @endif
            @if(isset($ProdSpecArrNames['field2']) && $ProdSpecArrNames['field2'] != '')
            {data: 'field2', name: 'field2'},
            @endif
            @if(isset($ProdSpecArrNames['field3']) && $ProdSpecArrNames['field3'] != '')
            {data: 'field3', name: 'field3'},
            @endif
            {data: 'size_from', name: 'size_from'},
            {data: 'size_to', name: 'size_to'},
            {data: 'quantity', name: 'quantity'},
            {data: 'offerprice', name: 'offerprice'},
            // {data: 'created_at', name: 'created_at'},
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
        $( 'select', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        });
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
        $('#seller').text($(this).find('img').data('seller'));
        $('#price').text($(this).find('img').data('price'));
        $('#size').text($(this).find('img').data('size'));
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
          text: 'You will not be able to recover this order2!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/trading/order2') }}"+'/'+item_id,
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

    var viewinvoiceUrl,sendInvoiceUrl;
    $('body').on('click','.sendInvoice',function(e){
        e.preventDefault();
         viewinvoiceUrl = $(this).data("viewurl");
         sendInvoiceUrl = $(this).data("url-send");
         $("#offersent_id").val($(this).data("id"));
        Swal.fire({
            title: "Are you sure?",
            html: '<div><button class="btn btn-primary" value="send" id="sendPdf">Send</button> <button class="btn btn-success" id="viewPdf">View PDF</button> <button class="btn btn-primary" value="addnotes" id="addnotes">Add notes</button><button class="btn btn-secondary" id="cancel">Cancel</button></div>',
            type: "warning",
            showConfirmButton: false,
            showCancelButton: false
        });
    })

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

    $('body').on('click','#addnotes',function(e){
        e.preventDefault();
       var id=$('#offersent_id').val();
        $.ajax( {
                url: "{{ route('admin.get_offersentnotes') }}",
                method: 'POST',
                data: {id:id},
                success: function(json_data)
                {
                       $('#notes').val(json_data.notes);
                },
         });
            Swal.close();
            $("#notesmodal").modal('toggle');
    });

    $("#add_notes_btn").click(function() {
            form_values = $("#addnotes_form").serialize();
            $.ajax( {
                url: "{{ route('admin.matchestemp.add_offersentnotes') }}",
                method: 'POST',
                data: form_values,
                success: function(json_data)
                {
                        Swal.fire('Sent!', json_data.message, 'success');
                        $('#notesmodal').modal('toggle');
                        window.location.href = " {{ route('admin.offersent.index') }}";
                },
                error: function(data)
                {
                }
            });
        });


    $('body').on('click','#cancel',function(e){
        e.preventDefault();
        Swal.close();
    });
     $(".offer_sent").datepicker({
		format: "mm/dd/yyyy",
		weekStart: 0,
		calendarWeeks: true,
		autoclose: true,
	});
  });
  </script>
  @endpush
