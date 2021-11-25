@extends('backend.layouts.app')
@section('title', 'Buyer Deliveries Card View :: '.app_name())
@push('after-styles')
<style>       
    .carousel-indicators{
        position: relative;
        margin-right: 0%;
        margin-left: 0%;
        margin-bottom: 0;
        border: 1px solid #bbb;
    }
    .stock-gallery .carousel-item img.d-block.w-100.no_img {
        width: auto !important;
        height: 235px !important;
        margin: 0 auto;
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
    .stock-card-list li{
        line-height: 35px;position: relative; padding-left: 15px;
    }
    .stock-card-list li:before{
        content: "\F0DA";position: absolute; left: 0; top: 0px;font-family: "Font Awesome 5 Free";font-weight: 900;font-size: 16px
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
        <div class="col-md-2 col-sm-12 mb-4">
            <h4 class="card-title mb-0">
                {{ __('menus.backend.trasport.deliveries.all') }} <small class="text-muted"></small>
                <a href="{{ route($route_pre.'.deliveries.index') }}" class="btn btn-info btn-md ml-1" title="Buyer Deliveries List View" data-toggle="tooltip" ><i class="fas fa-list"></i></a>
            </h4>
        </div><!--col-->
        <div class="col-md-10 ">
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
                <div class="col-md-4 col-sm-12"> </div>
                 <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <label class="col-sm-3">Sort By</label>
                        <div class="col-sm-6 col-md-9">
                            <select id="sort-by-filter" class="filters form-control select2">
                                <option value="">Choose</option>
                                <option value="1">Id</option>
                                <option value="4">Seller</option>
                                <option value="3">Date</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>                     
        <div class="clear-both"></div>
        @if(isset($deliveries))
            @foreach($deliveries as $delivery)
                <div class="col-xs-12 col-sm-6 col-md-4 removeable">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="stock-gallery">         
                                        <!--Carousel Wrapper-->
                                        <div id="carousel-thumb-{{$delivery->id}}" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                        <!--Slides-->
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100 no_img"  onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$delivery->product->homepage_image)}}">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100 no_img" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$delivery->product->image)}}">
                                                </div>
                                            </div>
                                            <!--/.Slides-->
                                            <!--Controls-->
                                            <a class="carousel-control-prev" href="#carousel-thumb-{{$delivery->id}}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carousel-thumb-{{$delivery->id}}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                            <!--/.Controls-->
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-thumb-{{$delivery->id}}" data-slide-to="0" class="active"><img class="d-block w-100" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$delivery->product->homepage_image)}}" class="img-fluid"></li>
                                                <li data-target="#carousel-thumb-{{$delivery->id}}" data-slide-to="1"><img class="d-block w-100" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$delivery->product->image)}}" class="img-fluid"></li>                                            
                                            </ol>
                                        </div>
                                        <!--/.Carousel Wrapper-->        
                                    </div>
                                </div>
                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <ul class="stock-card-list">
                                        <li><strong>Product: </strong> {{ @$delivery->product->name }} </li>
                                        <li><strong>Variety: </strong> {{ @$delivery->productspecvalue->value }} </li>
                                        <li><strong>Buyer: </strong> {{ @$delivery->buyerget->username }} </li>
                                        <li><strong>Transport Id: </strong> {{ @$delivery->transportdata->id }} </li>
                                        <li><strong>Delivery Location: </strong> {{ @$delivery->trucks->delivery_location }} </li>
                                        <li><strong>Delivery Date: </strong> {{ @$delivery->trucks->delivery_date }} </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-muted">
                            <!--<button type="button" class="btn btn-success btn-md text-Captalize"><i class="fas fa-edit"></i> Edit</button>-->
                        </div>
                    </div>
                </div>
                @php $last_id = $delivery->id; @endphp
            @endforeach
            <input type="hidden" name="last_id " id = "last_id" value = "{{ @$last_id }}" >
        @endif
    </div>
@endsection

@push('after-scripts')
<script>
$(window).scroll(function () {
// $('#load_more').click(function(){
    if($('#last_id').val() != ''){
            fv = $("#variety").val();
            fq = $("#quality").val();
            fp = $("#filter-product").val();

        if ($(window).height() + $(window).scrollTop() == $(document).height()) {
        
                var last_id = $('#last_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                $.ajax({
                    type: "POST",
                    url: "{{ route($route_pre.'.deliveries.adminmoredeliveries') }}",
                    data: { 'last_id' : last_id, 'productid':fp , 'variety':fv , 'quality': fq},
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

        function syncPosition(el) 
        {
            //to disable loop, comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

            if (current < 0) 
            {
                current = count;
            }
            if (current > count) 
            {
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

            if (current > end) 
            {
                thumbs.data("owl.carousel").to(current, 100, true);
            }
            if (current < start) 
            {
                thumbs.data("owl.carousel").to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) 
        {
            if (syncedSecondary) 
            {
                var number = el.item.index;
                bigimage.data("owl.carousel").to(number, 100, true);
            }
        }

        thumbs.on("click", ".owl-item", function(e) 
        {
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
                url: "{{ route($route_pre.'.trading.deliveriesbyAjax') }}",
                method: 'POST',
                data: {'productid':fp, 'variety':fv, 'quatity':fq, 'sortby': sortby},
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
                url: "{{ route($route_pre.'.trading.deliverycardviewbyAjax') }}",
                method: 'POST',
                data: {'productid':fp, 'variety':fv, 'quatity':fq},
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

</script>
@endpush