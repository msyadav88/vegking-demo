@extends('backend.layouts.app')
@section('title', 'Stock Card View :: '.app_name())
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
@if(auth()->user()->hasRole('seller') && Request::segment(1) == 'seller')
    @php $route_pre = 'seller'; @endphp
@else
    @php $route_pre = 'admin'; @endphp
@endif
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-2">
            <div class="mb-4">
                <h4 class="card-title mb-0">
                    {{ __('menus.backend.trading.offers.all') }} <small class="text-muted"></small>
                    <a href="{{ route($route_pre.'.stockv2.index') }}" class="btn btn-info btn-md ml-1" title="List View" data-toggle="tooltip" ><i class="fas fa-list"></i></a>
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
                                <option value="4">Seller</option>
                                <option value="3">Date</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-md-2 col-sm-12">
            <div class="btn-toolbar float-right" role="toolbar" >
                @can('add stock')  
                <a href="javascript:void(0);" data-toggle="modal" data-target="#createModals" class="btn btn-primary btn-md ml-1" title="Add a New Stock" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i> Add stock</a>
                @endcan
            </div> 
        </div>
    </div>
        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
            @include('backend.includes.stock-modal2',['productimage' => '$productsimage', 'sellers' => $seller])
        @else
            @include('backend.includes.stock-modal2',['productimage' => '$productsimage'])
        @endif  
        <div class="row" id="viewcards">
        @if(isset($stocks))
            @foreach($stocks as $stock)
                <div class="col-xs-12 col-sm-6 col-md-4 removeable">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="stock-gallery">         
                                        <!--Carousel Wrapper-->
                                        <div id="carousel-thumb-{{$stock->id}}" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                            <!--Slides-->
                                            <div class="carousel-inner" role="listbox">
                                                @if($stock->image != 'null' &&  !empty($stock->image))
                                                    @php $imageN = 1; @endphp
                                                    @if($stock->image !== '[]')
                                                        @foreach(json_decode($stock->image, true) as $stock_img)
                                                            <div class="carousel-item  @php echo (($imageN == 1)?'active':'') @endphp">
                                                                <img class="d-block w-100 no_img" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/stock/'.$stock_img)}}">
                                                            </div>
                                                            @php $imageN++; @endphp
                                                        @endforeach
                                                        
                                                        <div class="carousel-item ">
                                                            <img class="d-block w-100 no_img"  onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->homepage_image)}}">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img class="d-block w-100 no_img" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->image)}}">
                                                        </div>
                                                    @else
                                                        <div class="carousel-item active">
                                                            <img class="d-block w-100 no_img"  onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->homepage_image)}}">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img class="d-block w-100 no_img" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->image)}}">
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100 no_img"  onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->homepage_image)}}">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100 no_img" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->image)}}">
                                                    </div>
                                                @endif
                                            </div>
                                            <!--/.Slides-->
                                            <!--Controls-->
                                            <a class="carousel-control-prev" href="#carousel-thumb-{{$stock->id}}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carousel-thumb-{{$stock->id}}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                            <!--/.Controls-->
                                            <ol class="carousel-indicators">
                                                @if(@$stock->image != 'null' &&  !empty($stock->image))
                                                    @if($stock->image !== '[]')
                                                        @php $imageN = 0; @endphp
                                                        @foreach(json_decode($stock->image, true) as $stock_img)
                                                            <li data-target="#carousel-thumb-{{$stock->id}}" data-slide-to="@php echo $imageN; @endphp" class=" @php echo (($imageN == 0)?'active':'') @endphp">
                                                            <img class="d-block w-100 h-100" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/stock/'.@$stock_img)}}" class="img-fluid"></li>
                                                            @php $imageN++; @endphp
                                                        @endforeach
                                                    
                                                        <li data-target="#carousel-thumb-{{$stock->id}}" data-slide-to="@php echo $imageN; @endphp" class=""><img class="d-block w-100  h-100" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->homepage_image)}}" class="img-fluid"></li>
                                                        @php $imageN++; @endphp
                                                        <li data-target="#carousel-thumb-{{$stock->id}}" data-slide-to="@php echo $imageN; @endphp"><img class="d-block w-100  h-100" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->image)}}" class="img-fluid"></li>
                                                    @else
                                                        <li data-target="#carousel-thumb-{{$stock->id}}" data-slide-to="0" class="active"><img class="d-block w-100  h-100" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->homepage_image)}}" class="img-fluid"></li>
                                                        <li data-target="#carousel-thumb-{{$stock->id}}" data-slide-to="1"><img class="d-block w-100  h-100" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->image)}}" class="img-fluid"></li>                                           
                                                    @endif
                                                @else
                                                    <li data-target="#carousel-thumb-{{$stock->id}}" data-slide-to="0" class="active"><img class="d-block w-100  h-100" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->homepage_image)}}" class="img-fluid"></li>
                                                    <li data-target="#carousel-thumb-{{$stock->id}}" data-slide-to="1"><img class="d-block w-100  h-100" onerror=this.src="{{asset('images/products/no_img.png')}}" src="{{asset('images/products/'.@$stock->product->image)}}" class="img-fluid"></li>                                           
                                                @endif
                                            </ol>
                                        </div>
                                        <!--/.Carousel Wrapper-->        
                                    </div>
                                </div>
                                @php  
                                $currencies = ['euro'=>'&euro;', 'dollar'=>'$', 'pound'=>'&pound;'];
                               
                                $Size = $variety = $mp = $quality =  ''; $packing = []; $purpose = ''; $soil = 'N/A'; $defects = []; @endphp
                                @if($stock->offerPropertyRel)             
                                @foreach(@$stock->offerPropertyRel as $rel)
                                        @if($rel->productSpecRel->type_name== "Variety")
                                            @php $variety = @$rel->productSpecValueRel->value; @endphp
                                        @elseif($rel->productSpecRel->type_name == "Packing")
                                            @php $packing[] = @$rel->productSpecValueRel->value; @endphp
                                        @elseif($rel->productSpecRel->type_name == "Quality")
                                            @php $quality = @$rel->productSpecValueRel->value; @endphp
                                        @elseif($rel->productSpecRel->type_name == "Flesh Color" || $rel->productSpecRel->type_name == "Color")
                                            @php $flesh_color = @$rel->productSpecValueRel->value; @endphp
                                        @elseif($rel->productSpecRel->type_name == "Defects")
                                            @php $defects[] = @$rel->productSpecValueRel->value; @endphp
                                        @elseif($rel->productSpecRel->type_name == "Size")
                                            @php  $Size = @$rel->value; @endphp
                                        @elseif($rel->productSpecRel->type_name == "Purpose")
                                            @php  $purpose = @$rel->productSpecValueRel->value; @endphp
                                        @elseif($rel->productSpecRel->type_name == "Soil")
                                            @php  $soil = @$rel->productSpecValueRel->value; @endphp
                                        @elseif($rel->productSpecRel->type_name == "MarketProcessing")
                                            @php  $mp = @$rel->productSpecValueRel->value; @endphp
                                        @endif
                                    @endforeach
                                @endif
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <ul class="stock-card-list">
                                        <li><strong>ID: </strong>
                                        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
                                            <a href="{{@$stock->id}}">{{@$stock->id}}</a>
                                        @else
                                            {{@$stock->id}}
                                        @endif
                                        </li>
                                        @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
                                            <li><strong>Seller: </strong><a href="{{url('admin/auth/user').'/'.@$stock->sellername->user_id}}">{{@$stock->sellername->username}}</a></li>
                                        @endif
                                        <li><strong>Product: </strong> {{@$stock->productname->name}} </li>
                                        <li><strong>Variety: </strong> {{@$variety ?? 'N/A'}} </li>
                                        <li><strong>Flesh Color: </strong> {{@$flesh_color ?? 'N/A'}} </li>
                                        <li><strong>MarketProcessing: </strong> {{$mp ?? 'N/A'}}</li>
                                        <li><strong>Quality Type: </strong> {{$purpose ?? 'N/A'}}</li>
                                        <li><strong>Quality: </strong> {{@$quality ?? 'N/A'}}</li>
                                        <li><strong>Soil: </strong> {{$soil ?? 'N/A'}}</li>
                                        <li><strong>Size: </strong> {{@$Size}} </li>
                                        <li><strong>Price: </strong> {!! $currencies[@$stock->price_currency] !!}{{ $stock->price }}</li>
                                        <li><strong>Defects: </strong>{{@implode(', ', $defects) ?? 'N/A'}}</li>
                                        <li><strong>Packing: </strong>{{@implode(', ', $packing) ?? 'N/A'}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-muted">
                            <button type="button" class="btn btn-edit stock-edit-btn" data-id="{{$stock->id}}"><i class="fas fa-edit" ></i></button>

                            <button type="button" data-toggle="tooltip" class="pull-right btn btn-danger deleteItem" data-id="{{$stock->id}}" data-original-title="Delete"><i class="fas fa-trash-alt" ></i></button>
                        </div>
                    </div>
                </div>
               @php  $last_id = $stock->id @endphp
            @endforeach
        @endif
         </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="text-center mt-3">
                <input type="hidden" name="last_id " id = "last_id" value = "{{ @$last_id }}" >
                <span id ="loadmsg"></span>
            </div>    
        </div>
    </div>
   
    @include('backend.includes.edit-modal2')
@endsection

@push('after-scripts')
<script>
var save_stock_url = '{{route($route_pre.'.stockv2.store')}}';

var no=1;

// $(window).scroll(function () {
// // $('#load_more').click(function(){
//     fv = $("#variety").val();
//     fq = $("#quality").val();
//     fp = $("#filter-product").val();
//     var last_id = $('#last_id').val();
//     if(last_id !== ''){
//         if ($(window).height() + $(window).scrollTop() == $(document).height()) {
        
                
//                 $.ajaxSetup({
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                         }
//                     });
//                 $.ajax({
//                     type: "POST",
//                     url: "{{ route($route_pre.'.stockv2.stockmorecardview') }}",
//                     data: { 'last_id' : last_id, 'productid': fp}, 
//                     success : function(data){
//                         var result = JSON.parse(data);
//                         if(result.status == 'success')
//                         {
//                             $('#viewcards').append(result.data);
//                             $('#last_id').val(result.id);
//                         }
//                         else
//                         {
//                             $('#loadmsg').html(result.msg);

//                         }
//                     }            
//                 });
//             }
//         }    
//     });

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
                    url: "{{ route($route_pre.'.stockv2.stockmorecardview') }}",
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
                    location.reload();
                },
                error: function (data) {
                Swal.fire('Error!', 'Offer not deleted', 'error');
                }
            });
        }
        });
    });


    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var bigimage = $("#big");
        var thumbs = $("#thumbs");
        //var totalslides = 10;
        var syncedSecondary = true;
        /*
        bigimage.owlCarousel({
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
*/
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
                url: "{{ route($route_pre.'.trading.stockcardviewbyAjax') }}",
                method: 'POST',
                data: {'productid':fp, 'variety':fv, 'quatity':fq, 'sortby':sortby },
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
                url: "{{ route($route_pre.'.trading.stockcardviewbyAjax') }}",
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
                url: "{{ route($route_pre.'.trading.stockcardviewbyAjax') }}",
                data: { 'productid':fp , 'variety':fv , 'quality': fq},
                success : function(data){
                    var result = JSON.parse(data);
                    if(result.status == 'success')
                    {
                        $('.removeable').remove();
                        $('#loadmsg').html(' ');
                        $('#viewcards').append(result.data);
                        $('#last_id').val(result.id);
                    }
                    else
                    {
                        $('.removeable').remove();
                        $('#loadmsg').html(result.msg);

                    }
                }            
            });
        });

</script>
@endpush