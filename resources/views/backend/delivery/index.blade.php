@extends('backend.layouts.app')
@section('title', __('menus.backend.trasport.deliveries.all'). ' :: ' . app_name())

@if(auth()->user()->hasRole('seller') && Request::segment(1) == 'seller')
    @php $route_pre_url = 'seller'; @endphp
@elseif(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
    @php $route_pre_url = 'buyer'; @endphp
@elseif(auth()->user()->hasRole('trader') && Request::segment(1) == 'trader')
    @php $route_pre_url = 'trader'; @endphp
@elseif(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
    @php $route_pre_url = 'admin'; @endphp
@elseif(auth()->user()->hasRole('trader') && Request::segment(1) == 'trader')
    @php $route_pre_url = 'trader'; @endphp
@endif
@if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
    @php $route_pre = 'buyer'; @endphp
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
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trasport.deliveries.all') }} <small class="text-muted"></small>
                    @if(auth()->user()->hasRole('seller') && Request::segment(1) == 'seller')
                        <a href="{{ route($route_pre_url.'.deliveries.sellerdeliveries') }}" class="btn btn-info btn-md ml-1" title="Seller Deliveries Card View" data-toggle="tooltip" ><i class="fas fa-th"></i></a>
                    @elseif(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
                        <a href="{{ route($route_pre_url.'.deliveries.buyerdeliveries') }}" class="btn btn-info btn-md ml-1" title="Buyer Deliveries Card View" data-toggle="tooltip" ><i class="fas fa-th"></i></a>
                    @elseif(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
                        <a href="{{ route($route_pre_url.'.deliveries.admindeliveries') }}" class="btn btn-info btn-md ml-1" title="Admin Deliveries Card View" data-toggle="tooltip" ><i class="fas fa-th"></i></a>
                    @elseif(auth()->user()->hasRole('trader') && Request::segment(1) == 'trader')
                        <a href="{{ route($route_pre_url.'.deliveries.traderdeliveries') }}" class="btn btn-info btn-md ml-1" title="Trader Deliveries Card View" data-toggle="tooltip" ><i class="fas fa-th"></i></a>
                    @endif
                </h4>
            </div><!--col-->
            <div class="col-sm-7">
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
                                        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' || auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
                                            <th>Delivery date</th>
                                        @endif
                                        <th>Product</th>
                                        <th>Product Image</th>
                                        <!-- @if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer'  || auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin'  )
                                            <th>Uploaded Files</th>
                                        @endif -->
                                        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' )
                                            <th>Seller Id </th>
                                            <th>Buyer Id </th>

                                        @endif
                                        @if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer' )
                                            <th>Seller Id </th>
                                        @endif
                                        <th>Variety</th>
                                        @if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer'  || auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin'  )
                                            <th>Uploaded Files</th>
                                        @endif
                                        <th>Loaded weight</th>
                                        <th>Unloaded weight</th>
                                        
                                        <th>Packaging Type</th>
                                        <th>Number Of Packing</th>
                                        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' || auth()->user()->hasRole('seller') && Request::segment(1) == 'seller')
                                            <th>Pickup Date</th>
                                        @endif
                                        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' || auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
                                            <th>Delivery Address </th>
                                        @endif
                                        <th>Truck plates</th>
                                        <th>Container ID </th>
                                        <th>Transport ID</th>
                                        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' )
                                            <th>Action</th>
                                        @endif
                                        <th>Id</th>
                                        
                                    </tr>
                                    </thead>
                                    <tfoot>
                                        <tr id="filter">   
                                            @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' || auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
                                                <th data-title="Delivery Date"></th>
                                            @endif
                                            <th data-title="Product"></th>
                                            <th data-title="Product Image"></th>
                                            @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' )
                                                <th data-title="Seller Id"></th>
                                                <th data-title="Buyer Id"></th>
                                            @endif
                                            @if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer' )
                                                <th data-title="Seller Id"></th>
                                            @endif
                                            <th data-title="Variety"></th>
                                            @if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer'  || auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin'  )
                                                <th data-title="uploadedfiles"></th>
                                                <!-- <th data-title="Product Image"></th> -->
                                                <!-- <th></th> -->
                                            @endif
                                            <th data-title="Loaded Weight "></th>
                                            <th data-title="Unloaded Weight "></th>
                                            <th data-title="Packaging Type"></th>
                                            <th data-title="Number Of Packing"></th>
                                            @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' || auth()->user()->hasRole('seller') && Request::segment(1) == 'seller')
                                                <th data-title="Pickup Date"></th>
                                            @endif
                                            @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' || auth()->user()->hasRole('seller') && Request::segment(1) == 'buyer')
                                                <th data-title="Delivery Address"></th>
                                            @endif
                                            <th data-title="Truck plates"></th>
                                            <th data-title="Container ID "></th>
                                            <th data-title="Transport ID"></th>
                                            @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' )
                                                <th data-title="Action"></th>
                                            @endif
                                            <th data-title="ID"></th>
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
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:15px 50px;">
                <h4 style="text-align: center; width: 100%;">Edit Weight</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:15px 50px;">
                <form role="form" id="edit_weight">
                    <input type="hidden" name="transload_id" id="transload_id" value="0">
                    <div class="form-group">
                        <label for="group"><span class="glyphicon glyphicon-user"></span> Loaded weight</label>
                        <input type="text" class="form-control" name="loaded_weight" id="loaded_weight" placeholder="Enter Loaded weight">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="group"><span class="glyphicon glyphicon-user"></span> Unloaded weight</label>
                        <input type="text" class="form-control" name="unloaded_weight" id="unloaded_weight" placeholder="Enter Unloaded weight">
                        <div class="invalid-feedback"></div>
                    </div>
                    <a href="javascript:void(0);" id="edit_weight_btn" class="btn btn-success btn-block">Update</a>
                </form>
            </div>
        </div>
    </div>
</div>
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
                                    <ul class="delivery-card-list">
                                        <li><strong>Product: </strong><span id="product"></span> </li>
                                        <li><strong>Variety: </strong> <span id="variety"></span> </li>
                                        <li><strong>Buyer: </strong><span id="buyer"></span>  </li>
                                        <li><strong>Seller: </strong><span id="seller"></span>  </li>
                                        <li><strong>Transport ID: </strong><span id="transport_id"></span>  </li>
                                        <li><strong>Delivery Location : </strong><span id="delivery_location"></span>  </li>
                                        <li><strong>Delivery Date: </strong><span id="delivery_date"></span>  </li>
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

<div class="modal fade" id="fileModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:15px 50px;">
                <h4 style="text-align: center; width: 100%;">File Upload</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:15px 50px;" id = "msg">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fullframe" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" style="padding:0px 0px 0px 0px;" id = "full">
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-scripts')
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#data_table #filter th').each( function () {
            var title = $(this).attr('data-title');
            if(title != '')
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route($route_pre_url.'.deliveries.index') }}",
            columns: [
                @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' || auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
                    {data: 'unloaddate', name: 'unloaddate'},
                @endif
                {data: 'product', name: 'product'},
                {data: 'image', name: 'image', orderable: false, searchable: false, width: "200px"},
                @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
                    {data: 'seller_show_url', name: 'seller_show_url'},
                    {data: 'buyer_show_url', name: 'buyer_show_url'},
                    

                @endif
                @if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
                    {data: 'seller_show_url', name: 'seller_show_url'},
                @endif
                {data: 'variety', name: 'variety'},
                
                @if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer' || auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' )
                    {data: 'uploadedfiles', name: 'uploadedfiles', html: true, responsive: true},
                @endif

                {data: 'loaded_weight', name: 'loaded_weight'},
                {data: 'unloaded_weight', name: 'unloaded_weight'},
                {data: 'packaging_type', name: 'packaging_type'},
                {data: 'number_of_packing', name: 'number_of_packing'},
                @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' || auth()->user()->hasRole('seller') && Request::segment(1) == 'seller')
                    {data: 'pickupdate', name: 'pickupdate'},
                @endif
                @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' || auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
                    {data: 'delivery_address', name: 'delivery_address'},
                @endif
                {data: 'plateno', name: 'plateno'},
                {data: 'container_id', name: 'container_id'},
                {data: 'transport_id', name: 'transport_id'},
                @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin' || auth()->user()->hasRole('trader') && Request::segment(1) == 'trader' )
                    {data: 'action', name: 'action'},
                @endif
                {data: 'id', name: 'id'},
            ],
        });
        table.columns().every(function (){
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        });
        $('body').on('click', '.image', function (e) {
            $('.image').attr("src", $(this).find('img').attr('src'));
            $('.homepage_image').attr("src", $(this).find('img').data('homepage_image'));
            $('#product').text($(this).find('img').attr('name'));
            $('#variety').text($(this).find('img').data('variety'));
            $('#buyer').text($(this).find('img').data('buyer'));
            $('#seller').text($(this).find('img').data('seller'));
            $('#transport_id').text($(this).find('img').data('transportid'));
            $('#delivery_loaction').text($(this).find('img').data('delivery_loaction'));
            $('#deivery_date').text($(this).find('img').data('deivery_date'));
            $("#ImageModal").modal();
    });
        $('body').on('click', '.editWeight', function () {
            var edit_id = $(this).data("id");
            $.ajax({
                url: "{{ route($route_pre.'.transport.gettransload') }}",
                method: 'get',
                data: {edit_id:edit_id},
                dataType: "json",
                beforeSend: function(){
                },
                success: function(data)
                {
                    if(data.status == 'success')
                    {
                        transload = data.transload;
                        $("#loaded_weight").val(transload.loaded_weight);
                        $("#unloaded_weight").val(transload.unloaded_weight);
                        $("#transload_id").val(transload.id);
                        $("#editModal").modal('toggle');
                    }
                    else
                    {
                        Swal.fire(data.message, data.message, 'error');	
                    }
                },
                error :function( data ) {
                    if( data.status === 422 ) 
                    {
                        Swal.fire('Error!', data.responseJSON.message, 'error');
                        var errors = [];
                        errors = data.responseJSON.errors;
                    }
                }
            });
        });

        $("#edit_weight_btn").click(function() {
            form_values = $("#edit_weight").serialize();
            $.ajax( {
                url: "{{ route($route_pre.'.transport.Savetransload') }}",
                method: 'POST',
                data: form_values,
                success: function(json_data) 
                {
                    if( json_data.error == 1 )
                    {
                        Swal.fire("Error!", json_data.message, 'error');
                    }
                    else
                    {
                        Swal.fire(json_data.message , json_data.message, 'success');
                        $('#editModal').modal('toggle');
                        window.location.href = " {{ route($route_pre.'.deliveries.index') }}";
                    }
                },
                error: function(data) 
                {
                    if (data.status === 422) 
                    {
                        Swal.fire('Error!', data.responseJSON.message, 'error');
                        $('.btn-success').removeAttr('disabled');
                        var errors = [];
                        errors = data.responseJSON.errors
                        $.each(errors, function(key, value) {
                            $('#' + key).parent().addClass('has-danger');
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).parent('.has-danger').find('.invalid-feedback').html(value);
                            $('#' + key).next().children().children().css({
                                "border": "1px solid #f86c6b"
                            });
                        })
                    }
                }
            });
        });

    $('body').on('click', '.view', function (e) {

        var view_id = e.target.id;
        $('#fullframe').modal('toggle');
        var path = "{{ url('images/uploadedfiles') }}"+'/'+view_id+'_transload.pdf';
        var htmll = '<iframe src="'+path+'" style = "width:500px; height:700px;" class ="fullframe"></iframe>';
             
        $('#full').html(htmll); 

    });

    $('body').on('click', '.edituploadedfiles', function (e) {
        
        var id = e.target.id;
        var form_values = $("#formuploadedfiles_"+ id).serialize();
        var file_data = $('#uploadedfiles_'+id).prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        form_data.append('transload_id_files', id);

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                $.ajax( {
                url: "{{ route($route_pre.'.transport.Saveuploadedfiles') }}",
                method: 'POST',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(json_data) 
                {
                    Swal.fire('Sent!', json_data.message, 'success');
                    table.draw();

                },
                error: function(data) 
                {
                    Swal.fire('Error!', data.responseJSON.message, 'error');
                    table.draw();
                }
            });
    });
//end

    });
</script>
@endpush
