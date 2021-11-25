@extends('backend.layouts.app')

@section('title', __('menus.backend.trading.buyerpref.all') . ' :: ' . app_name())
@if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
@php $route_pre = 'admin'; @endphp
@else
@php $route_pre = 'buyer'; @endphp
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
                    {{ __('menus.backend.trading.buyerpref.all') }} <small class="text-muted"></small>
                    @if(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
                    <a href="{{ route($route_pre.'.buyerpref.cardview') }}" class="btn btn-info btn-md ml-1" title="Card View" data-toggle="tooltip" ><i class="fas fa-th"></i></a>
                    @elseif(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
                    <a href="{{ route($route_pre.'.buyerpref.cardview') }}" class="btn btn-info btn-md ml-1" title="Card View" data-toggle="tooltip" ><i class="fas fa-th"></i></a>
                    @endif
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" >
                    <a href="{{ route($route_pre.'.buyerpref.buyerprefexports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel"><i class="fa fa-download"></i></a>
                </div>
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#createBuyerModal" class="btn btn-primary ml-1" title="Add Buyer Prefs" data-toggle="tooltip" ><i class="fas fa-plus-circle"></i>  </a>
                    @if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
                        @include('backend.includes.pref-modal',['productimage' => '$productsimage', 'buyers' => $buyers])
                    @else
                        @include('backend.includes.pref-modal',['productimage' => '$productsimage'])
                    @endif
                </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="order_table" class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Buyer</th>
                            <th>Product</th>
                            <th>Product image</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
                                <th data-title="Id"></th>
                                <th data-title="Buyer"></th>
                                <th data-title="Product"></th>
                                <th data-title="Product Image"></th>
                                <th data-title="Date"></th>
                                <th data-title=""></th>
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
                                    <ul class="buyerpref-card-list">
                                        <li><strong>Product: </strong><span id="product"></span> </li>
                                        <li><strong>Soil: </strong> <span id="soil"></span> </li>
                                        <li><strong>Flesh Color: </strong><span id="flesh_color"></span>  </li>
                                        <li><strong>Potato Variety: </strong><span id="potato_variety"></span>  </li>
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
  var save_buyerpref_url = '{{route($route_pre.'.buyerpref.storeajax')}}';
    
  $(function () {
    setTimeout(function() {
        $(".alert-danger").hide();
    }, 3000);
    $('#order_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );  
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: "{{ route($route_pre.'.buyerpref.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'buyer_name', name: 'buyer_name'},
            {data: 'product_name', name: 'product_name'},
            {data: 'image', name: 'image', orderable: false, searchable: false, width: "200px"},
            {data: 'created_at', name: 'created_at'},
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
    
    $('body').on('click', '.image', function (e) {
         $('.image').attr("src", $(this).find('img').attr('src'));
         $('.homepage_image').attr("src", $(this).find('img').data('homepage_image'));
         $('#product').text($(this).find('img').attr('name'));
         $('#soil').text($(this).find('img').data('soil'));
         $('#flesh_color').text($(this).find('img').data('fleshcolor'));
         $('#potato_variety').text($(this).find('img').data('potato_variety'));
         $("#ImageModal").modal();
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
                console.log(data);
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
                // $('.model-variety-field').select2().trigger('change');
                  
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

    $('body').on('click', '.viewItem', function () {
        var item_url = $(this).data("url");
        window.location.href = item_url;
    });

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

  });
</script>
<script>
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
</script>
@endpush
