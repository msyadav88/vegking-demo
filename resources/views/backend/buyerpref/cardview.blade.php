<?php 
// echo "<pre>"; print_r($all_buyers); exit('hehhehe');  
?>
@extends('backend.layouts.app')
@section('title', 'Buyer Pref Card View :: '.app_name())
@push('after-styles')
<style>       
    .carousel-indicators{
        position: relative;
        margin-right: 0%;
        margin-left: 0%;
        margin-bottom: 0;
        border: 1px solid #bbb;
    }
    .carousel-indicators li{
        width: 60px;
        height: auto;
        border-top: 3px solid transparent;
        border-bottom: 3px solid transparent;
    }
    .card-body{
        margin-bottom: 0
    }
    .stock-card-list{
        padding: 0;margin:10px 0;
    }
    .w-100{
       height: 40px;
       object-fit: cover;
    }
    .stock-card-list li{
        line-height: 35px;position: relative; padding-left: 15px;font-size: 17px;
    }
    .stock-card-list li:before{
        content: "\F0DA";position: absolute; left: 0; top: 0px;font-family: "Font Awesome 5 Free";font-weight: 900;font-size: 16px
    }
    .stock-gallery .carousel-item {
        background: #ffffff;
        border: 1px solid #e9e9e9;
    }

    .stock-gallery .carousel-item img.d-block.w-100.no_img {
        width: auto !important;
        height: 235px !important;
        margin: 0 auto;
    }
    .carousel-indicators li
    {
        height: 40px;
    }
    .main .container-fluid {
        padding: 0 30px;
    }
</style>
@endpush
@if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
    @php $route_pre = 'buyer'; @endphp
@else
    @php $route_pre = 'admin'; @endphp
@endif  
@section('content')

<div class="row">
        <div class="col-sm-12 col-md-2" style="padding-right:0px;">
            <div class="mb-4">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trading.buyerpref.all') }} <small class="text-muted"></small>
                    <a href="{{ route($route_pre.'.buyerpref.index') }}" class="btn btn-info btn-md ml-1" title="List View" data-toggle="tooltip" ><i class="fas fa-list"></i></a>
                </h4>
            </div><!--col-->
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <label class="col-sm-3">Product</label>
                        <div class="col-sm-6 col-md-9">
                            <select id="filter-product" class="filters form-control select2">
                                <option value="">Choose</option>
                                @foreach($products as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <label class="col-sm-3">Variety</label>
                        <div class="col-sm-6 col-md-9">
                            <select id="variety" class="form-control select2">
                                <option value="">Choose</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <label class="col-sm-3">Quality</label>
                        <div class="col-sm-6 col-md-9">
                            <input type="text" class="form-control filters" id="quality" name="quality"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <label class="col-sm-3">Sort By</label>
                        <div class="col-sm-6 col-md-9">
                            <select id="sort-by-filter" class="filters form-control select2">
                                <option value="">Choose</option>
                                <option value="1">Id</option>
                                <option value="2">Buyer</option>
                                <option value="3">Date</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-2 col-sm-12">
            <div class="btn-toolbar float-right" role="toolbar" >
                <a href="javascript:void(0);" data-toggle="modal" data-target="#createBuyerModal" class="btn btn-primary ml-1" title="Add Buyer Prefs" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i>Add Pref</a>
            </div>
        </div>
    </div>

    @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
        @include('backend.includes.pref-modal',['productimage' => '$productsimage', 'buyers' => $buyers])
    @else
        @include('backend.includes.pref-modal',['productimage' => '$productsimage'])
    @endif
        <div class="clear-both"></div>
        <div class="row" id="viewcards">
        @if(isset($buyerprefWithproductPrefs))
            @foreach($buyerprefWithproductPrefs as $prefs)
            <div class="col-xs-12 col-sm-6 col-md-4 removeable">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="stock-gallery">         
                                    <!--Carousel Wrapper-->
                                    <div id="carousel-thumb-{{$prefs->id}}" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                        <!--Slides-->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100 no_img" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$prefs->product->homepage_image)}}">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100 no_img" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$prefs->product->image)}}">
                                            </div>
                                            @if(@$prefs->image != null)
                                                @foreach(json_decode(@$prefs->image, true) as $stock_img)
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{asset('images/stock/'.$stock_img)}}">
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <!--/.Slides-->
                                        <!--Controls-->
                                        <a class="carousel-control-prev" href="#carousel-thumb-{{$prefs->id}}" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-thumb-{{$prefs->id}}" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        <!--/.Controls-->
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-thumb-{{$prefs->id}}" data-slide-to="0" class="active"> <img class="d-block w-100 " onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$prefs->product->homepage_image)}}" class="img-fluid"></li>
                                            <li data-target="#carousel-thumb-{{$prefs->id}}" data-slide-to="1"><img class="d-block w-100 " onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$prefs->product->image)}}" class="img-fluid"></li>
                                            @php $i=2; @endphp
                                            @if(@$prefs->image != null)
                                                @foreach(json_decode($prefs->image, true) as $stock_img)
                                                    <li data-target="#carousel-thumb-{{$prefs->id}}" data-slide-to="{{$i}}"><img class="d-block w-100" src="{{asset('images/stock/'.$stock_img)}}" class="img-fluid"></li>
                                                    @php $i++; @endphp
                                                @endforeach
                                            @endif
                                        </ol>
                                    </div>
                                    <!--/.Carousel Wrapper-->        
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <ul class="stock-card-list">
                                    <li><strong>ID: </strong>
                                        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
                                            <a href="{{@$prefs->id}}">{{@$prefs->id}}</a>
                                        @else
                                            {{@$prefs->id}}
                                        @endif
                                    </li>
                                    @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
                                        <li><strong>Buyer: </strong><a href="{{url('admin/auth/user').'/'.@$prefs->buyername->user_id}}">{{@$prefs->buyername->username}}</a></li>
                                    @endif
                                    <li><strong>Product: </strong> {{@$prefs->product->name}} </li>
                                    @if($prefs->productPrefs)
                                        @php $nets = array(); @endphp
                                        @foreach(@$prefs->productPrefs as $pref)
                                            

                                            @if($pref->productSpec->display_name  == 'Size')
                                                @php $nets[@$pref->productSpec->display_name][] = @$pref->value; @endphp
                                            @else
                                                @php $nets[@$pref->productSpec->display_name][] = @$pref->productSpecValue->value; @endphp
                                            @endif
                                        @endforeach
                                        @foreach(@$nets as $display_name=>$net)
                                            <li><strong>{{@$display_name}}: </strong> {{ implode(', ',$net) }} </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <button type="button" class="btn btn-edit editItem" data-id="{{$prefs->id}}" data-url="{{route($route_pre.'.buyerpref.edit',$prefs->id)}}"><i class="fas fa-edit"></i></button>
                        <button data-toggle="tooltip" data-id="{{$prefs->id}}" data-original-title="Delete" type="button" class="pull-right btn btn-danger deleteItem"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
            <?php //echo $prefs->product_id; exit; ?>
            @php @$last_id = $prefs->id; @endphp
        @endforeach
    @endif
    </div>
 <div class="row">
        <input type="hidden" name="last_id " id = "last_id" value = "{{ @$last_id }}" >
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="text-center mt-3">
                <span id ="loadmsg"></span>
            </div>    
        </div>
    </div>
@endsection
@push('after-scripts')
<script>
    var save_buyerpref_url = '{{route($route_pre.'.buyerpref.storeajax')}}';
    var no=1;

    $('body').on('click', '.deleteItem', function () {
        var item_id = $(this).data("id");
        Swal.fire({
          title: 'Are You sure want to delete?',
          text: 'You will not be able to recover this request!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type: "DELETE",
                url: "{{ url($route_pre.'/trading/buyerpref') }}"+'/'+item_id,
                success: function (data) {
                    Swal.fire('Deleted!', 'Request has been deleted.', 'success');
                    table.draw();
                },
                error: function (data) {
                  Swal.fire('Error!', 'Request not deleted', 'error');
                }
            });
          }
        });
    });

    $('body').on('click', '.editItem', function () {
        var buyerPrefId = $(this).data('id');
        $.ajax({
            url: "{{ url('buyer/get_pref') }}",
            method: 'POST',
            data: {buyerPrefId:buyerPrefId},
            dataType: "json",
            success: function(data)
            {
                if(data['productPrefsMapping']['Size'] != undefined){
                    var size = data['productPrefsMapping']['Size'];
                    var sizeToFrom = size.split('-');
                    $('input[name="size[0][from]"]').val(sizeToFrom[0]);
                    $('input[name="size[0][to]"]').val(sizeToFrom[1]);
                }
               // $('select[name="price_currency"]').val(currentStock['price_currency']);
                pid = data['buyerpref']['product_id'];
                
                productSpecDataObj = productSpecData[pid];
                setupProduct(productSpecDataObj,pid);
                currentStock = data['productPrefsMapping'];
                
                if(data['productPrefsMapping']['Purpose'] != undefined){
                    currentStockPurposeId = data['productPrefsMapping']['Purpose'];
                } else { currentStockPurposeId = 0; }
                setupQualityOrUW(pid, currentStockPurposeId);
                
                $('input[name="product_id"]').val(pid);
                $('input[name="pref_id"]').val(buyerPrefId);
                $('#prefid').val(buyerPrefId);
                $('.model-variety-field').val(currentStock['Variety']);
                //$('.model-variety-field').select2().trigger('change');
                  
                if (currentStock['Defects'] != undefined) {
                    vals = [];
                    $.each(currentStock['Defects'], function(k2, v2) {
                        vals.push(v2);
                        $("#def"+v2).prop('checked',true);
                    });
                }
                if (currentStock['Packing'] != undefined) {
                    $.each(currentStock['Packing'], function(k2, v2) {
                        p = '';
                        console.log(currentStock['Packing_ecs']);
                        if (currentStock['Packing_ecs'] != undefined) {
                            if (currentStock['Packing_ecs'][v2] != undefined) {
                                p = currentStock['Packing_ecs'][v2];
                            }
                        }
                        
                        $("#pack_"+v2).prop('checked',true);
                        $("#pack_"+v2).parents('tr').find('.price-field2-packing').val(p).removeClass('vk_hide');
                    });
                }
               
                $('.market-btn[data-id="'+currentStock.MarketProcessing+'"]').addClass('active');
                
                if (currentStock['Quality'] != undefined) {
                    Qualityid = currentStock['Quality'];
                    $('.p-q-images[data-id="'+Qualityid+'"]').addClass('active');
                    $('.model-quality-id').val(Qualityid);
                }
                
                if (currentStock['Purpose'] != undefined) {
                    $('.purpose-group[value="'+currentStock['Purpose']+'"]').attr('checked',true);
                    purpid = currentStock['Purpose'];
                    $('.q-images[data-id="'+purpid+'"]').addClass('active');
                }
                
                if (currentStock['Soil'] != undefined) {
                    SoilId = currentStock['Soil'];
                    $('.p-q-images2[data-id="'+SoilId+'"]').addClass('active');
                    $('.model-mp-child').val(currentStock['Soil']);
                }
                if(currentStock['Variety'] != undefined){
                    if(productDetail['Variety'][currentStock['Variety']] != undefined){
                        $('.edit-step2-detail').html(productDetail['Variety'][currentStock['Variety']]);
                    }
                }
                if(currentStock['MarketProcessing'] != undefined){
                    if(productDetail['MarketProcessing'][currentStock['MarketProcessing']] != undefined){
                        $('.edit-step25-detail').html(productDetail['MarketProcessing'][currentStock['MarketProcessing']]);
                    }
                    $('#model-mp-id').val(currentStock['MarketProcessing']);
                    $('#model-mp').val(productDetail['MarketProcessing'][currentStock['MarketProcessing']]);
                }
                
                if(currentStock['Purpose'] != undefined){
                    if(productDetail['Purpose'][currentStock['Purpose']] != undefined){
                        $('.edit-step3-detail').html(productDetail['Purpose'][currentStock['Purpose']]);
                    }
                    $('.model-buyer-purpose-id').val(currentStock['Purpose']);
                }
                
                $('.product[data-id="'+pid+'"]').addClass('active').addClass('edit-mode');
                $('#create-pref').addClass('edit-mode');
                $("#createBuyerModal").modal("show");
            } 
        });
    });

    $(window).scroll(function () {
        fv = $("#variety").val();
        fq = $("#quality").val();
        fp = $("#filter-product").val();
        var last_id = $('#last_id').val();
        if(last_id !== ''){
            if ($(window).height() + $(window).scrollTop() == $(document).height()) {
            
                var last_id = $('#last_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                $.ajax({
                    type: "POST",
                    url: "{{ route($route_pre.'.buyerpref.morecardview') }}",
                    data: { 'last_id' : last_id, 'product_id': fp, 'variety':fv , 'quality':fq},
                    success : function(data){
                        var result = JSON.parse(data);
                        if(result.status == 'success')
                        {
                            $('#viewcards').append(result.data);
                            $('#last_id').val(result.id);
                        }
                        else
                        {
                            $('#loadmsg').html(result.msg);
                        }
                    }            
                });
            }
        }
    });


    $(document).ready(function() {
        var bigimage = $("#big");
        var thumbs = $("#thumbs");
        //var totalslides = 10;
        var syncedSecondary = true;

        bigimage
            .owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: true,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [
                    '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                    '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
                ]
            })
            .on("changed.owl.carousel", syncPosition);

        thumbs
            .on("initialized.owl.carousel", function() {
                thumbs
                    .find(".owl-item")
                    .eq(0)
                    .addClass("current");
            })
            .owlCarousel({
                items: 4,
                dots: false,
                nav: false,
                navText: [
                    '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                    '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
                ],
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: 4,
                responsiveRefreshRate: 100
            })
            .on("changed.owl.carousel", syncPosition2);

        function syncPosition(el) {
            //if loop is set to false, then you have to uncomment the next line
            //var current = el.item.index;

            //to disable loop, comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            //to this
            thumbs
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = thumbs.find(".owl-item.active").length - 1;
            var start = thumbs
                .find(".owl-item.active")
                .first()
                .index();
            var end = thumbs
                .find(".owl-item.active")
                .last()
                .index();

            if (current > end) {
                thumbs.data("owl.carousel").to(current, 100, true);
            }
            if (current < start) {
                thumbs.data("owl.carousel").to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                bigimage.data("owl.carousel").to(number, 100, true);
            }
        }

        thumbs.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            bigimage.data("owl.carousel").to(number, 300, true);
        });
    });

       
         $('.filters').change( function() {
            
            sortby = $("#sort-by-filter").val();
            fv = $("#variety").val();
            fq = $("#quality").val();
            fp = $("#filter-product").val();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                url: "{{ route($route_pre.'.trading.getproductforstock') }}",
                method: 'POST',
                data: {'productid':fp},
                success: function(data)
                {
                    var sv = '<option value="">Choose</option>';
                    $.each(data.Variety,function(k,v){
                        sv += '<option value="'+k+'">'+v+'</option>'
                    });
                    if(data.Variety_id != null){
                        $('#variety').html(sv);
                    } else { 
                        $('#variety').html('<option value="">Choose</option>');
                    }
                }
            });

            $.ajax({
                url: "{{ route($route_pre.'.trading.byyerprefcardviewbyAjax') }}",
                method: 'POST',
                data: {'productid':fp, 'variety':fv, 'quality':fq, 'sortby': sortby},
                success: function(data)
                {
                    var result = JSON.parse(data);
                        if(result.status == 'success')
                        {   $('.removeable').remove();
                            $('#loadmsg').html(' ');
                            $('#viewcards').append(result.data);
                            $('#last_id').val(result.id);
                        }
                        else
                        {
                            $('#loadmsg').html(result.msg);
                             $('.removeable').remove();

                        }
                }
            });
        });       

        $('#variety').change( function() {
            fv = $("#variety").val();
            fq = $("#quality").val();
            fp = $("#filter-product").val();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                method: 'POST',
                url: "{{ route($route_pre.'.trading.byyerprefcardviewbyAjax') }}",
                data: {  'productid':fp , 'variety':fv , 'quality': fq},
                success: function(data)
                {
                    var result = JSON.parse(data);
                        if(result.status == 'success')
                        {   $('.removeable').remove();
                            $('#loadmsg').html(' ');
                            $('#viewcards').append(result.data);
                            $('#last_id').val(result.id);
                        }
                        else
                        {
                            $('#loadmsg').html(result.msg);
                             $('.removeable').remove();

                        }
                }
            });
        });
        
         $('#quality').keyup( function() {
            fv = $("#variety").val();
            fq = $("#quality").val();
            fp = $("#filter-product").val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                type: "POST",
                url: "{{ route($route_pre.'.trading.byyerprefcardviewbyAjax') }}",
                data: { 'productid':fp , 'variety':fv , 'quality': fq},
                success : function(data){
                    var result = JSON.parse(data);
                    if(result.status == 'success')
                    {
                        $('#viewcards').append(result.data);
                        $('#last_id').val(result.id);
                    }
                    else
                    {
                        $('#loadmsg').html(result.msg);

                    }
                }            
            });
        });


</script>
@endpush