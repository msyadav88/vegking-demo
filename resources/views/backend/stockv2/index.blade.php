<?php //$res = chanel_confirmation('email-confirmed'); 
//echo $res; exit('kokoko'); ?>
@extends('backend.layouts.app')

@section('title', __('menus.backend.trading.offers.all') . ' :: ' .app_name())
@push('after-styles')
@endpush
@if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
@php $route_pre = 'admin'; @endphp
@else
@php $route_pre = 'seller'; @endphp
@endif
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="card-title mb-0">

                    {{ __('menus.backend.trading.offers.all') }} <small class="text-muted"></small>
                    @if(chanel_confirmation('email-confirmed') == 1) 
                        @can('add stock')  
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#createModals" class="btn btn-success btn-md ml-1" title="Add a New Stock" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> Add New Stock</a>
                        @endcan
                    @else
                        <a href="javascript:void(0);" id = "check-verified" class="btn btn-success btn-md ml-1" title="Add a New Stock" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> Add New Stock</a>
                    @endif
                    <a href="{{ route($route_pre.'.stockcardview') }}" class="btn btn-info btn-md ml-1" title="Card View" data-toggle="tooltip" ><i class="fas fa-th"></i></a>
                </h4>
            </div><!--col-->
            <div class="col-sm-4">
                <div class="form-group row">
                    <div class="col-md-10">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="btn-toolbar float-right" role="toolbar" >
                    @role('seller')
                    @else
                        @can('export stocks')
                            <a href="{{ route('admin.stock.stocksexports') }}" class="btn btn-warning ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download">Download</i></a>
                        @endcan
                    @endif
                </div>
                
                 @include('backend.includes.edit-modal2')
                 
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
               
                </div><!--btn-toolbar-->
              <div class="btn-toolbar float-right">
                @role('seller')
                @else
                <form action="{{ route('admin.stock.stockimport') }}" method="POST" enctype="multipart/form-data" id="upload_stock">
                    {{ csrf_field() }}
                    <span class="fileupload-exists btn btn-primary ml-1"><i class="fa fa-upload">Upload</i></span>    
                    <input type="file" name="stock_file" class="btn btn-info ml-1" onchange="$('#upload_stock').submit();" >
                </form>
                @endif
            </div>
            </div><!--col-->
        </div><!--row-->
        
        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
            @include('backend.includes.stock-modal2',['productimage' => '$productsimage', 'sellers' => $seller])
        @else
            @include('backend.includes.stock-modal2',['productimage' => '$productsimage'])
        @endif

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                <table border="0" cellspacing="5" cellpadding="5">
                        <tbody><tr>
                            <td>Product:</td>
                            <td>
                                <select id="filter-product" class="form-control">
                                    <option value="">Choose</option>
                                    @foreach($products as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            <td>Variety:</td>
                            <td>
                                <select id="variety" class="form-control">
                                    <option value="">Choose</option>
                                </select>
                            </td>    
                            <td>Quality:</td>
                            <td><input type="text" class="form-control" id="quality" name="quality"/></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" class="button_class" style="border-radius: 50%;border: 1px solid;background: #0275d8;color:white;margin-top: 5%;" data-toggle="collapse" data-target="#demo" >+</button>
                    <br>
                    <div class="col-sm-12 collapse" id="demo">
                        <div data-title="Id">Id<div>
                            <input type="text" column="0" class="search_input"></div></div>
                            <div data-title="stock_id"></div>
                        <div data-title="Product_name">Product Name<div>
                            <input type="text" column="1" class="search_input"></div></div>
                        
                        <div data-title="price">
                            Price<div>
                                <input type="text" column="3" class="search_input"></div>
                        </div>
                        <div data-title="Field1">
                            Variety<div>
                                <input type="text" column="4" class="search_input"></div>
                        </div>
                        <div data-title="Field3" class="number">
                            Quality<div>
                                <input type="text" column="5" class="search_input"></div>
                        </div>
                        <div data-title="Field2"   class="number">
                            Packing<div>
                                <input type="text" column="6" class="search_input"></div>
                        </div>
                        <div data-title="Size">
                            Size<div>
                                <input type="text" column="6" class="search_input"></div>
                        </div>
                        <div data-title="Stock_status">
                            Status<div>
                                <input type="text" column="6" class="search_input"></div>
                        </div>
                        <div data-title="Earned" class="number">
                            Earned<div>
                                <input type="text" column="6" class="search_input"></div>
                        </div>
                        <div data-title="Action"></div>
                    </div>
                    <table id="stock_table" class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Stock Id</th>
                                <th>Product</th>
                                <th>Product Image</th>
                                <th>Price</th>
                                <th>Variety</th>
                                <th>Quality</th>
                                <th>Packing</th>
                                <th>Size</th>
                                <th>Status</th>
                                <th>Earned</th>
                                <th>Action</th>
                            </tr>
                            <tfoot>
                                <tr id="filter" class="stock-filter">
                                    <th data-title="Id"></th>
                                    <th data-title="Stock_id"></th>
                                    <th data-title="Product_name"></th>
                                    <th data-title="Product_image"></th>
                                    <th data-title="price"></th>
                                    <th data-title="Field1"></th>
                                    <th data-title="Field3" class="number"></th>
                                    <th data-title="Field2" class="number"></th>
                                    <th data-title="Size"></th>
                                    <th data-title="Stock_status"></th>
                                    <th data-title="Earned" class="number"></th>
                                    <th data-title="Action"></th>
                                </tr>
                              </tfoot>
                        </thead>
                        <tbody>
                        </tbody>
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
                                    <ul class="stock-card-list">
                                        <li><strong>Product: </strong><span id="product"></span> </li>
                                        <li><strong>Variety: </strong> <span id="variety"></span> </li>
                                        <li><strong>Packing:</strong><span id="packing"></span>  </li>
                                        <li><strong>Quality: </strong><span id="quality"></span>  </li>
                                        <li><strong>Size : </strong><span id="size"></span>  </li>
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
@if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
    @php 
        $route_pre = 'admin';
        $redirecturl =  route($route_pre.'.stockv2.index');
    @endphp
@else
    @php 
        $route_pre = 'seller';
        $redirecturl =  route($route_pre.'.stockv2.index');
    @endphp
@endif
@push('after-scripts')
<script type="text/javascript">

$('body').on('click', '#check-verified', function (e) {
        Swal.fire('Warning!', 'You email is not verified' , 'error');
});


    var save_stock_url = '{{route($route_pre.'.stockv2.store')}}';
    var redirecturl = '{{ $redirecturl }}';
    var table;
    var products = JSON.parse('@json($products)');
    var selectOpt = '<option value="" selected="selected">Choose Product</option>';
    $.each(products,function(key,value){
        selectOpt += '<option value="'+key+'">'+value+'</option>'
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#msform').on('submit', function(event) {
        event.preventDefault();
        /*var formData = new FormData($(this)[0]);
        $.each(formData,function(k,d){
            formData.append(d.name, d.value);
        });
        
        $.ajax({
            url: save_stock_url,
            method: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(){
                $('.loading').removeClass('loading_hide');
            },   
            success: function(data)
            {
                $('.loading').addClass('loading_hide');
                Swal.fire('Sent!','Stock is successfully added.', 'success');
                setTimeout(function(){
                    window.location.href = redirecturl;
                }, 2000);
            },
            error :function( data ) {
                if( data.status === 422 ) {
                    $('.loading').addClass('loading_hide');
                    Swal.fire('Error!', data.responseJSON.message, 'error');
                    $('.btn-success').removeAttr('disabled');
                    var errors = [];
                    errors = data.responseJSON.errors
                    $.each(errors, function (key, value) {
                        var n = key.search(".");
                        var res = key.split(".");
                        if(res.length > 1){
                            key = res[0];
                            for(i=1;i<res.length;i++){
                                key += "["+res[i]+"]";
                            }
                        }
                        if(key == 'product_id'){
                            $("fieldset").hide();
                            $("#ss-step1").show();
                            $('#error_product').html('Choose Any one product').css({"color": "#f11212"});
                            $('li').addClass('active');
                        }
                        
                        if(key == 'price'){
                            $("fieldset").hide();
                            $("#ss-step4").show();
                            $('li').addClass('active');
                        }
                        
                        $("#createModals").find("#"+key).parent().addClass('has-danger');
                        $("#createModals").find('#'+key).parent('.has-danger').find('.invalid-feedback').html(value);
                        $("#createModals").find("#"+key).addClass('is-invalid');
                        $("#createModals").find('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
                    })
                }
            }
        });
        return false;*/
    });

    $(document).on('change','.product',function(){
        var productid = $(this).val();
        var ths = $(this);
        $.ajax({
            url: "{{ route($route_pre.'.trading.getproductforstock') }}",
            method: 'POST',
            data: {'productid':productid},
            success: function(data)
            {
                var selectvariety = '';
                var selectpacking = '';
                var selectquality = ''; 
                var selectdefects = '';

                $.each(data.Variety,function(key,value){
                    selectvariety += '<option value="'+key+'">'+value+'</option>'
                });

                if(data.Variety_id != null){
                    $(".field1").html(selectvariety);
                    $(".field1").attr('name',"fields["+data.Variety_id+"]");
                    $(".field1").attr('data-id',data.Variety_id);
                } else { 
                    $(".field1").html('');
                    $(".field1").attr('name',"");
                    $(".field1").attr('data-id',"");
                }

                $.each(data.Packing,function(key,value){
                    inp = '';
                    if(data.spec_array_packing['Packing'][key] == 1){
                        inp = "<input type='text' style='display:none;' class='vk_hide form-control col-md-3 ml-3' name='ecs["+data.Packing_id+"]["+key+"]'/>"
                    }

                    selectpacking +='<div class="checkbox-inline"><label style=" float: left;display: inline-block;"><input class="packing-change" type="checkbox" name="fields['+data.Packing_id+'][]" value="'+key+'"/>'+value+'</label>'+inp+'</div>';
                })
                $(".packing_options").html(selectpacking);
                if(selectpacking != ''){
                    $(".packing_group").removeClass('vk_hide');
                } else {
                    $(".packing_group").addClass('vk_hide');
                }

                $.each(data.Quality,function(key,value){
                    selectquality +='<option value="'+key+'">'+value+'</option>'
                })
                
                if(data.Quality_id != null){
                    $(".field3").html(selectquality);
                    $(".field3").attr('name',"fields["+data.Quality_id+"][]");
                    $(".field3").attr('data-id',data.Quality_id);
                } else { 
                    $(".field3").html('');
                    $(".field3").attr('name',"");
                    $(".field3").attr('data-id',"");
                }

                $.each(data.Defects,function(key,value){
                    selectdefects +='<option value="'+key+'">'+value+'</option>'
                })
                
                if(data.Defects_id != null){
                    $(".field4").html(selectdefects);
                    $(".field4").attr('name',"fields["+data.Defects_id+"][]");
                    $(".field4").attr('data-id',data.Defects_id);
                } else { 
                    $(".field4").html('');
                    $(".field4").attr('name',"");
                    $(".field4").attr('data-id',"");
                }
            },
            error :function( data ) {
                
            }
        });
    });

    var editMode = '<div class="row mt-3 ml-2 mr-2"><label class="col-md-1">Product</label><div class="col-md-2"><select name="product_id" class="edit_product edit_product_id form-control" required>'+selectOpt+'</select></div><label class="col-md-2">Status</label><div class="col-md-4"><select name="stock_status" class="status form-control" ><option value>Choose Stock Status</option><option value="unavailable">Unavailable</option><option value="available">Available</option><option value="upcoming_stock">Upcoming Stock</option></select></div></div><div class="row mt-3 ml-2 mr-2"><label class="col-md-2">Size</label><div class="col-md-2"><input name="size_from" type="text" class="form-control sizefrom" /></div><div class="col-md-2"><input type="text" name="size_to" class="sizeto form-control" /></div><label class="col-md-2">Price</label><div class="col-md-4"><input name="price" type="text" class="price form-control" /></div></div>';

    var append_data = {"msg":"appened_row","data":{"expand":"","product_name":'<select class="product product_id form-control" required>'+selectOpt+'</select>',
        "stock_status":"<select class='status form-control' ><option value>Choose Stock Status</option><option value='unavailable'>Unavailable</option><option value='available'>Available</option><option value='upcoming_stock'>Upcoming Stock</option></select>",
        "field1":"<select class='field1 form-control' ><option value=''>Select</option></select>",
        "field2":"<select class='field2 form-control' ><option value=''>Select</option></select>",
        "field3":"<select class='field3 form-control' ><option value=''>Select</option></select>",
        "size":"<input style='width:50px;'  type='text' class='form-control sizefrom' /><input style='width:50px;' type='text' class='sizeto form-control' />",
        "price":"<input style='width:50px;'  type='text' class='price form-control' />",
        "action":"<input class='btn btn-primary savestock' style='margin-right:5px;' value='Save' type='button'/><input class='btn btn-danger cancelstock' value='Cancel' type='button'/>"}};

    $('#stock_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
    $(document).ready(function(){
        $('body').on('click', '.image', function (e) {
        $('.image').attr("src", $(this).find('img').attr('src'));
        $('.homepage_image').attr("src", $(this).find('img').data('homepage_image'));
        $('#product').text($(this).find('img').attr('name'));
        $('#variety').text($(this).find('img').data('variety'));
        $('#packing').text($(this).find('img').data('packing'));
        $('#quality').text($(this).find('img').data('quality'));
        $('#size').text($(this).find('img').data('size'));
        $('#price').text($(this).find('img').data('price'));
        $("#ImageModal").modal();
     });
        var table = $('.data-table').DataTable({
            "initComplete": function(settings, json) {
                @if(@$_GET['add'] == 1)
                $('#addstocks').trigger('click');
                @endif
            },
            paging: true,
            searching: true,
            processing: true,
            pagingType: "full",
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route($route_pre.'.stockv2.index') }}"+'?@if(isset($_GET['product_id']))product_id={{$_GET['product_id']}}@endif',
            columns: [
                {
                   "orderable":      false,
                    "data":           "id"
                },
                {data: 'stock_id',name: 'stock_id' , orderable: false, searchable: false},
                {data: 'product_name',name: 'product_name'},
                {data: 'image', name: 'image', orderable: false, searchable: false, width: "200px"},
                {data: 'price',name: 'product_name'},
                {data: 'field1',name: 'field1'},
                {data: 'field3',name: 'field3'},
                {data: 'field2',name: 'field2'},
                {data: 'size',name: 'size'},
                {data: 'stock_status',name: 'stock_status'},
                {
                    "orderable":      false,
                    "data":           "earned",
                    "defaultContent": " "
                },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        table.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    that
                        .search( this.value )
                        .draw();
            } );
            $('.search_input').keyup(function(){
              var column=$(this).attr('column');
              that.columns(column).search($(this).val()).draw();
        });
          
        } );

      
        $('#variety').change( function() {
            fv = $("#variety").val();
            fq = $("#quality").val();
            fp = $("#filter-product").val();
            table.settings()[0].jqXHR.abort();
            table.ajax.url("{{ route($route_pre.'.stockv2.index') }}?variety="+fv+"&quality="+fq+"&filter_product="+fp).load();
        });
        $('#filter-product').change( function() {
            fv = $("#variety").val();
            fq = $("#quality").val();
            fp = $("#filter-product").val();
            table.settings()[0].jqXHR.abort();
            table.ajax.url("{{ route($route_pre.'.stockv2.index') }}?variety=&quality="+fq+"&filter_product="+fp).load();
            $.ajax({
                url: "{{ route($route_pre.'.trading.getproductforstock') }}",
                method: 'POST',
                data: {'productid':fp},
                success: function(data)
                {
                    var sv = '<option value="">Choose</option>';
                    $.each(data.Variety,function(k,v){
                        sv += '<option value="'+v+'">'+v+'</option>'
                    });
                    if(data.Variety_id != null){
                        $('#variety').html(sv);
                    } else { 
                        $('#variety').html('<option value="">Choose</option>');
                    }
                }
            });
        });
        $('#quality').keyup( function() {
            fv = $("#variety").val();
            fq = $("#quality").val();
            fp = $("#filter-product").val();
            table.settings()[0].jqXHR.abort();
            table.ajax.url("{{ route($route_pre.'.stockv2.index') }}?variety="+fv+"&quality="+fq+"&filter_product="+fp).load();
        });

        $('tbody').on('change', '.edit_product', function () {
            pid = $(this).val();
            parent_tr = $(this).parents('tr');
            $.ajax({
                type: "POST",
                url: "{{ route($route_pre.'.trading.getproduct') }}",
                data: {pid:pid},
                success: function (data) {
                parent_tr.find('.edit_nets').html(data);
                }
            });
        });
        $('tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            if(tr.hasClass('details') == false){
                var row = table.row( tr );
                row_data = row.data();
                tr.after('<tr></tr>');
                tr3 = tr.next();
                var th = this;
                $.ajax({
                    type: "POST",
                    url: "{{ route($route_pre.'.trading.getproductforstock') }}",
                    data: {stock_id:row.data().id},
                    success: function (data) {
                        $tdHtml =  '<td colspan="10"><form class="newItem" enctype="multipart/form-data"><div class="row mt-2 ml-2 mr-2"><label class="col-md-1 col-sm-2 mt-2">Product</label><div class="col-md-2 col-sm-4 mt-2"><select class="product edit_product_id form-control" name="product_id" required>'+selectOpt+'</select></div>    <label class="col-md-1 col-sm-2 mt-2">Variety</label><div class="col-md-2 col-sm-4 mt-2"><select class="field1 form-control"><option value="">Choose Variety</option></select></div>    <label class="col-md-1 col-sm-2 mt-2">Quality</label><div class="col-md-2 col-sm-4 mt-2"><select class="field3 form-control select2" multiple><option value="">Choose Quality</option></select></div>  <label class="col-md-1 col-sm-2 mt-2">Defects</label><div class="col-md-2 col-sm-4 mt-2"><select class="field4 form-control select2" multiple><option value="">Select</option></select></div></div>    <div class="row mt-2 ml-2 mr-2"><label class="col-md-1 col-sm-2 mt-2">Price</label><div class="col-md-2 col-sm-4 mt-2"><input name="price" type="text" class="price form-control"></div><label class="col-md-1 col-sm-2 mt-2">Size</label><div class="col-md-1 col-sm-2 mt-2"><input name="size_from" type="text" class="form-control sizefrom"></div><div class="col-md-1 col-sm-2 mt-2"><input type="text" name="size_to" class="sizeto form-control"></div>  <label class="col-md-1 col-sm-2 mt-2">Status</label><div class="col-md-2 col-sm-4 mt-2"><select name="stock_status" class="status form-control"><option value="unavailable">Unavailable</option><option selected value="available">Available</option><option value="upcoming_stock">Upcoming Stock</option></select></div><label class="col-md-1 col-sm-2 mt-2">Pics</label><div class="col-md-2 col-sm-4 mt-2"><input name="img" type="file"/></div></div>    <div class="form-group row  ml-2 mr-2 packing_group vk_hide"><label class="col-md-1 col-sm-2 mt-2">Packing</label><div class="col-md-10 col-sm-10 mt-2 packing_options"></div> </div>    <div class="form-group row mt-3 ml-2 mr-2"><div class="col-md-6"> <input type="submit" class="btn btn-primary update_stock" value="Save">  <input type="button" class="btn btn-secondary cancel_stock" value="Cancel"><input type="hidden" name="stock_id" value="'+row_data.id+'"/> </div> </div></form></td>';
                        tr3.html($tdHtml);
                        var selectvariety = '<option value="">Choose</option>';
                        var selectpacking = '';
                        var selectquality = '';
                        var selectdefects = '';
                    
                        $.each(data.Variety,function(key,value){
                            selectvariety += '<option value="'+key+'">'+value+'</option>'
                        });
                        
                        tr3.find(".field1").html(selectvariety);
                        tr3.find(".field1").attr('name',"fields["+data.Variety_id+"]");
                        tr3.find(".field1").attr('data-id',data.Variety_id);
                        
                        $.each(data.Packing,function(key,value){
                            selectpacking +='<label><input type="checkbox" name="fields['+data.Packing_id+'][]" value="'+key+'"/>'+value+'</label>';
                        })
                        tr3.find(".packing_options").html(selectpacking);
                        if(selectpacking != ''){
                            tr3.find(".packing_group").removeClass('vk_hide');
                        } else {
                            tr3.find(".packing_group").addClass('vk_hide');
                        }
                        $.each(data.Quality,function(key,value){
                            selectquality +='<option value="'+key+'">'+value+'</option>'
                        })
                        tr3.find(".field3").html(selectquality);
                        tr3.find(".field3").attr('name',"fields["+data.Quality_id+"][]");
                        tr3.find(".field3").attr('data-id',data.Quality_id);
                        
                        $.each(data.Defects,function(key,value){
                            selectdefects +='<option value="'+key+'">'+value+'</option>'
                        })
                        tr3.find(".field4").html(selectdefects);
                        tr3.find(".field4").attr('name',"fields["+data.Defects_id+"][]");
                        tr3.find(".field4").attr('data-id',data.Defects_id);
                        
                        if(data.Defects_id != 'null'){
                            tr3.find(".field4").val(data.productPrefsMapping[data.Defects_id]);
                        }
                        if(data.Quality_id != 'null'){
                            tr3.find(".field3").val(data.productPrefsMapping[data.Quality_id]);
                        }
                        if(data.Variety_id != 'null'){
                            tr3.find(".field1").val(data.productPrefsMapping[data.Variety_id]);
                        }
                        $(".field3").select2();
                        $(".field4").select2();
                        tr3.find('.edit_product_id').val(row_data.product_id);
                        tr3.find('.sizefrom').val(row_data.size_from);
                        tr3.find('.sizeto').val(row_data.size_to);
                        tr3.find('.price ').val(row_data.raw_price);
                        tr3.find('.status').val(row_data.raw_stock_status);
                        tr.addClass("details");
                    }
                });
            } else {
            tr.next().remove();
            tr.removeClass('details');
            }
        });

        $('body').on('click', '.update_stock', function () {
            pr = $(this).parents('tr');
            var pid = pr.find('.edit_product_id').val();
            var form = $(this).parents('form');
            var stock_id = pr.find('input[name="stock_id"]').val();
            var formData = new FormData($(this).parents('form')[0]);
            formData.append('_method', 'PUT');
            $.ajax({
                url: "{{ route($route_pre.'.stockv2.index') }}/"+stock_id,
                method: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function(){
                    $('.loading').removeClass('loading_hide');
                },
                success: function(data)
                {
                    if(data.status == 'success'){
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Sent!', data.message, 'success');
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                    }
                    if(data.status == 'error'){
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Error!', data.message, 'error');
                        $('.btn-success').removeAttr('disabled');
                    }
                }
            });
            return false;
        });
        $('body').on('click', '.editItem', function () {
            var item_url = $(this).data("url");
            //window.location.href = item_url;
        });

        $('body').on('click', '.viewItem', function () {
            var item_url = $(this).data("url");
            window.location.href = item_url;
        });

        $('body').on('click', '.deleteItem', function () {
            var product_id = $(this).data("id");
            Swal.fire({
            title: 'Are You sure want to delete?',
            text: 'You will not be able to recover this offer!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url($route_pre.'/trading/stock') }}"+'/'+product_id,
                    success: function (data) {
                        Swal.fire('Deleted!', 'Offer has been deleted.', 'success');
                        table.draw();
                    },
                    error: function (data) {
                    Swal.fire('Error!', 'Offer not deleted', 'error');
                    }
                });
            }
            });
        });

    });
    function fetch_select(id){
        var rt = '{{ route($route_pre.'.stockv2.index') }}';
        window.location.href=rt+'?product_id='+id;
    }
    $(document).on("click","#addstocks",function(){
        $("#stock_table").prepend('<tr><td colspan="8"><form class="" enctype="multipart/form-data"><div class="row ml-2 mr-2"><label class="col-md-1 col-sm-2 mt-2">Product</label><div class="col-md-2 col-sm-4 mt-2"><select class="product product_id form-control" name="product_id" required>'+selectOpt+'</select></div>    <label class="col-md-1 col-sm-2 mt-2">Variety</label><div class="col-md-2 col-sm-4 mt-2"><select class="field1 form-control"><option value="">Choose Variety</option></select></div>    <label class="mt-2 col-md-1 col-sm-2">Quality</label><div class="mt-2 col-md-2 col-sm-4"><select class="field3 form-control select2" multiple><option value="">Choose Quality</option></select></div>  <label class="mt-2 col-md-1 col-sm-2">Defects</label><div class="mt-2 col-md-2 col-sm-4"><select class="field4 form-control select2" multiple><option value="">Select</option></select></div></div>    <div class="row  ml-2 mr-2"><label class="col-md-1 mt-2 col-sm-2">Price</label><div class="col-md-2  mt-2 col-sm-4"><input name="price" type="text" class="price form-control"></div><label class="col-md-1 mt-2 col-sm-2">Size</label><div class="col-md-1  mt-2 col-sm-2"><input name="size_from" type="text" class="form-control sizefrom"></div><div class="col-md-1  mt-2 col-sm-2"><input type="text" name="size_to" class="sizeto form-control"></div>  <label class="col-md-1  mt-2 col-sm-2">Status</label><div class="col-md-2  mt-2 col-sm-4"><select name="stock_status" class="status form-control"><option value="unavailable">Unavailable</option><option selected value="available">Available</option><option value="upcoming_stock">Upcoming Stock</option></select></div><label class="col-md-1  mt-2 col-sm-2">Pics</label><div class="col-md-2  mt-2 col-sm-4"><input name="img" type="file"/></div></div>    <div class="form-group row ml-2 mr-2 packing_group vk_hide"><label class="col-md-1 mt-2 col-sm-2">Packing</label><div class="col-md-10  mt-2 col-sm-10 packing_options"></div> </div>    <div class="form-group row mt-3 ml-2 mr-2"><div class="col-md-6"> <input type="button" class="btn btn-primary savestock" value="Save">  <input type="button" class="btn btn-secondary cancel_stock" value="Cancel"> </div> </div></form></td></tr>');
        $(".field3").select2();
        $(".field4").select2();
    });

  
    $(document).on('click','.cancel_stock',function(){
        $(this).parents('tr').remove();
    });

    $(document).on('change','.product',function(){
    var productid = $(this).val();
    var ths = $(this);
    $.ajax({
            url: "{{ route($route_pre.'.trading.getproductforstock') }}",
            method: 'POST',
            data: {'productid':productid},
            success: function(data)
            {
                var selectvariety = '';
                var selectpacking = '';
                var selectquality = '';
                var selectdefects = '';
            
                $.each(data.Variety,function(key,value){
                    selectvariety += '<option value="'+key+'">'+value+'</option>'
                });
            
                if(data.Variety_id != null){
                    ths.parents('tr').find(".field1").html(selectvariety);
                    ths.parents('tr').find(".field1").attr('name',"fields["+data.Variety_id+"]");
                    ths.parents('tr').find(".field1").attr('data-id',data.Variety_id);
                } else { 
                    ths.parents('tr').find(".field1").html('');
                    ths.parents('tr').find(".field1").attr('name',"");
                    ths.parents('tr').find(".field1").attr('data-id',"");
                }
                
                $.each(data.Packing,function(key,value){
                    selectpacking +='<div class="checkbox-inline"><label><input type="checkbox" name="fields['+data.Packing_id+'][]" value="'+key+'"/>'+value+'</label></div>';
                })
                ths.parents('tr').find(".packing_options").html(selectpacking);
                if(selectpacking != ''){
                    ths.parents('tr').find(".packing_group").removeClass('vk_hide');
                } else {
                    ths.parents('tr').find(".packing_group").addClass('vk_hide');
                }
                
                $.each(data.Quality,function(key,value){
                    selectquality +='<option value="'+key+'">'+value+'</option>'
                })
                
                if(data.Quality_id != null){
                    ths.parents('tr').find(".field3").html(selectquality);
                    ths.parents('tr').find(".field3").attr('name',"fields["+data.Quality_id+"][]");
                    ths.parents('tr').find(".field3").attr('data-id',data.Quality_id);
                } else { 
                    ths.parents('tr').find(".field3").html('');
                    ths.parents('tr').find(".field3").attr('name',"");
                    ths.parents('tr').find(".field3").attr('data-id',"");
                }
                
                $.each(data.Defects,function(key,value){
                    selectdefects +='<option value="'+key+'">'+value+'</option>'
                })
                
                if(data.Defects_id != null){
                    ths.parents('tr').find(".field4").html(selectdefects);
                    ths.parents('tr').find(".field4").attr('name',"fields["+data.Defects_id+"][]");
                    ths.parents('tr').find(".field4").attr('data-id',data.Defects_id);
                } else { 
                    ths.parents('tr').find(".field4").html('');
                    ths.parents('tr').find(".field4").attr('name',"");
                    ths.parents('tr').find(".field4").attr('data-id',"");
                }
            },
            error :function( data ) {
                
            }
        });
    });

    $(document).on('click', '.savestock', function(){
        var formData = new FormData();
        var ths = $(this);
        var row = ths.parents('tr');
        row_data = row.data();
        var product          =  row.find(".product option:selected").val();
        var product_text     =  row.find(".product option:selected").text();
        var status           =  row.find(".status option:selected").val();
        var status_text      =  row.find(".status option:selected").text();
        var sizefrom         =  row.find(".sizefrom").val();
        var sizeto           =  row.find(".sizeto").val();
        var price            =  row.find(".price").val();
        var quality          =  row.find(".quality option:selected").val();
        var field1id         =  row.find(".field1").attr('data-id');
        var field1val        =  row.find(".field1").val();
        if(field1val != ''){
            var field1_text      =  row.find(".field1 option:selected").text();
        } else {
            var field1_text     = '-';
        }
        var field2id         =  row.find(".field2").attr('data-id');
        var field2val        =  row.find(".field2").val();
        if(field2val != ''){
            var field2_text      =  row.find(".field2 option:selected").text();
        } else {
            var field2_text     = '-';
        }
        var field3id         =  row.find(".field3").attr('data-id');
        var field3val        =  row.find(".field3").val();
        if(field3val != ''){
            var field3_text_arr      =  [];
            row.find(".field3 option:selected").each(function(){ field3_text_arr.push($(this).text()); });
            field3_text = field3_text_arr.join();
        } else {
            var field3_text     = '-';
        }
        
        var field4id         =  row.find(".field4").attr('data-id');
        var field4val        =  row.find(".field4").val();
        if(field4val != ''){
            var field4_text_arr      =  [];
            row.find(".field4 option:selected").each(function(){ field4_text_arr.push($(this).text()); });
            field4_text = field4_text_arr.join();
        } else {
            var field4_text     = '-';
        }
        
        formDataArr = row.find("form").serializeArray();
        
        $.each(formDataArr,function(k,d){
            formData.append(d.name, d.value);
        });
        
        var file = $("input[name='img']")[0].files[0];
        var imageType = /image.*/;
        if(typeof file != 'undefined'){
            if (!file.type.match(imageType)) return;
            formData.append('image', file);
        }
    
        $.ajax({
            url: "{{route($route_pre.'.stockv2.store')}}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data)
            {
                row.remove();
                var append_data = {"msg":"appened_row","data":{"expand":"","product_name":product_text,
                                "stock_status":status_text,
                                "field1":field1_text,
                                "field2":field2_text,
                                "field3":field3_text,
                                "size":sizefrom+"-"+sizeto,
                                "price":price,
                                "action":'<div class="btn-group btn-group-sm"><button data-toggle="tooltip" data-id="93" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button></div>'}};
        
                table.row.add( append_data.data ).draw( false );
            
                ths.hide();
                ths.parents('tr').find('td:last-child').append('<div class="btn-group btn-group-sm"><button data-toggle="tooltip" data-id="93" data-original-title="Delete" type="button" class="btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button></div>');
            },
            error :function( data ) {
                if( data.status === 422 ) {
                    $('.loading').addClass('loading_hide');
                Swal.fire('Error!', data.responseJSON.message, 'error');
                    $('.btn-success').removeAttr('disabled');
                    var errors = [];
                    errors = data.responseJSON.errors
                    $.each(errors, function (key, value) {
                        var n = key.search(".");
                        var res = key.split(".");
                        if(res.length > 1){
                            key = res[0];
                            for(i=1;i<res.length;i++){
                                key += "["+res[i]+"]";
                            }
                        }
                        row.find("."+key).parent().addClass('has-danger');
                        row.find("."+key).addClass('is-invalid');
                        row.find('.'+key).next().children().children().css({"border": "1px solid #f86c6b"});
                    })
                }
            }
        });
        return false;
    });
    $(document).on('click', '.cancelstock', function(){
        table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
        return false;
    });
 
</script>
@endpush