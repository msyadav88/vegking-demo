@push('after-styles')
<style>
#progressbar{margin: 5px 0;overflow:hidden;color:#d3d3d3;padding:0;text-align:center;position:relative;z-index:2;display:flex;counter-reset: line-number;}
#progressbar .active{color:#0e533f;}
#progressbar li{list-style-type:none;font-size:12px;flex:1;position:relative;font-weight:400;counter-increment: line-number;}
#progressbar li:before{content:counter(line-number);width:32px;height:32px;line-height:28px;display:block;font-size:16px;color:#fff;background:#d3d3d3;border-radius:50%;margin:0 auto 10px;padding:2px}
#progressbar li:after{content:'';width:100%;height:2px;background:#d3d3d3;position:absolute;left:0;top:14px;z-index:-1}
#progressbar li.active:after,#progressbar li.active:before{background:#0e533f}
.progress{height:20px;margin:5px 0 10px 0;}
.progress-bar{background-color:#0e533f}
.product-name{font-weight: 700;color:#000; text-transform: uppercase;}
.modal-header .previous_btn{position: absolute;left: 0;top: 0;line-height: 45px;font-size: 22px;}
.modal-header .previous_btn.disabled{opacity:0.3!important}
#createModal fieldset{padding: 15px;border: 1px solid #ced4da; margin-bottom: 15px}
#createModal fieldset legend{font-size: 16px;font-weight:600; display: inline-block;width: auto;padding: 0 5px; text-transform:uppercase}
.modal-header #step_previous_btn{position: absolute;left: 0;top: 0;line-height: 45px;font-size: 22px;}
.modal-header #step_previous_btn.disabled{opacity:0.3!important}

.image-checkbox .fa,.image-checkbox-checked.img-thumbnail{background-color:#10553f}
.nopad{padding-left:0!important;padding-right:0!important}
.image-checkbox{cursor:pointer;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border:4px solid transparent;margin:5px;outline:0}
.img-thumbnail .product-name{color:#000;font-weight:600;padding-top:5px;display:block}
.image-checkbox img{max-width:100%}
.image-checkbox input[type=checkbox]{display:none}
.image-checkbox-checked.img-thumbnail .product-name{color:#fff}
.image-checkbox .fa{position:absolute;color:#fff;padding:5px;top:7px;right:7px}
.image-checkbox-checked .fa{display:block!important}
.hidden{display:none!important}
</style>
@endpush

<div class="modal fade" id="createModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="trans_title">Add a New Stock</span> </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <a href="javascript:;" id="step_previous_btn" class="btn disabled" data-step="1"><i class="fas fa-arrow-circle-left"></i></a>
        </div>

        <div class="modal-body">

            <ul id="progressbar">
                <li class="active" id="progress_step_1" data-step="1"><strong>Product</strong></li>
                <li id="progress_step_2" data-step="2"><strong>QUALITY</strong></li>
                <li id="progress_step_3" data-step="3"><strong>VARIETY</strong></li>                
                <li id="progress_step_4" data-step="4"><strong>SIZE</strong></li>
                <li id="progress_step_5" data-step="5"><strong>DEFECTS</strong></li>
                <li id="progress_step_6" data-step="6"><strong>PACKING</strong></li>
                <li id="progress_step_7" data-step="7"><strong>STATUS</strong></li>
                <li id="progress_step_8" data-step="8"><strong>PRICE/TON</strong></li>
            </ul>

            <div class="progress">
                <div id="stock_progress_bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%">0% Completed</div>
            </div>

          <form role="form" class="form-create_stock" id="create_create_stock">
            
            {{-- Step 1 --}}
            <fieldset id="fieldset_1">
                <legend>Product</legend>
                <div class="row" style="margin-left:-5px;margin-right:-5px">
                @if(isset($products))
                    @foreach(@$products as $product)
                        <div class="col-md-4 nopad">
                            <label class="image-checkbox img-thumbnail">
                                <img src="{{ asset('images/products/') }}/{{@$product->homepage_image}}" style="width:100%;" class="mb-0" />
                                <input type="checkbox" name="product_id" value="{{@$product->id}}" />
                                <i class="fa fa-check hidden"></i>
                                <span class="text-center d-block product-name">{{@$product['name']}}</span>
                            </label>        
                        </div>        
                    @endforeach
                    @endif
                </div>
            </fieldset>

            {{-- Step 2 --}}
            <fieldset id="fieldset_2" style="display:none">
                <legend>QUALITY</legend>    
                
                <div class="model-row row mb-2">
                    <div class="col-md-4"> <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Quality</label>
                    </div>
                    <div class="col-md-8">
                    <select class="field3 model-row form-control select2" multiple>
                        <option value="">Choose Variety</option>
                    </select>
                    </div>
                    <div class="invalid-feedback"></div>
                </div>
            </fieldset>

            {{-- Step 3 --}}
            <fieldset id="fieldset_3" style="display:none">
                <legend>VARIETY</legend>   
                
                <div class="model-row row mb-2">
                    <div class="col-md-4"> <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Variety</label>
                    </div>
                    <div class="col-md-8">
                   <select id="field1" class="field1 model-row form-control">
                     <option value="">Choose Variety</option>
                  </select>
                  </div>
                   <div class="invalid-feedback"></div>
                 </div>
            </fieldset>

            {{-- Step 4 --}}
            <fieldset id="fieldset_4" style="display:none">
                <legend>SIZE</legend>    
                
                <div class="model-row row mb-2">
                    <div class="col-md-4"> 
                    <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Size</label>
                    </div>
                    <div class="col-md-8 model-row" style="display: flex;">
                    <input name="size_from" id="size_from" type="text" class="form-control col-md-4 sizefrom">
                    <input type="text" name="size_to" id="size_to" class="sizeto col-md-4 form-control">
                    </div>
                    <div class="invalid-feedback"></div>
                </div>
            </fieldset>

            {{-- Step 5 --}}
            <fieldset id="fieldset_5" style="display:none">
                <legend>DEFECTS</legend>  
                
                <div class="model-row row mb-2">
                    <div class="col-md-4"> 
                    <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Defects</label>
                    </div>
                    <div class="col-md-8">
                    <select class="field4 model-row form-control select2" multiple>
                        <option value="">Choose Defects</option>
                    </select>
                    </div>
                    <div class="invalid-feedback"></div>
                </div>
            </fieldset>

            {{-- Step 6 --}}
            <fieldset id="fieldset_6" style="display:none">
                <legend>PACKING</legend>      
                
                <div class="model-row row mb-2 packing_group vk_hide">
                    <div class="col-md-4"> 
                    <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Packing</label>
                    </div>
                   <div class="col-md-8 model-row packing_options">
                   
                   </div>
                   <div class="invalid-feedback"></div>
               </div>
            </fieldset>

            {{-- Step 7 --}}
            <fieldset id="fieldset_7" style="display:none">
                <legend>STATUS</legend>   
                
                <div class="model-row row mb-2">
                    <div class="col-md-4"> 
                    <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Status</label>
                    </div>
                   <div class="col-md-8 model-row">
                   <select name="stock_status" class="status form-control">
                       <option value="unavailable">Unavailable</option>
                       <option selected value="available">Available</option>
                       <option value="upcoming_stock">Upcoming Stock</option>
                   </select>
                   </div>
                   <div class="invalid-feedback"></div>
               </div>
            </fieldset>

            {{-- Step 8 --}}
            <fieldset id="fieldset_8" style="display:none">
                <legend>PRICE/TON</legend>   
                
                <div class="model-row row mb-2">
                    <div class="col-md-4"> 
                       <label for="key" class=""><span class="glyphicon glyphicon-eye-open"></span> Price</label>
                       </div>
                       <div class="col-md-8">
                       <input name="price" id="price" type="text" class="model-row price form-control">
                       </div>
                       <div class="invalid-feedback"></div>
                   </div>
            </fieldset>

            {{-- SUCCESS --}}
            <fieldset id="success_msg" style="display:none">
                <legend>Stock Created Successfully</legend>                   
                <h3 class="text-center">Your Stock has been created Successfully.</h3>
            </fieldset>


            <button id="next_step" data-step="1" type="button" class="btn btn-success float-right">Next</button>
            <button id="create_stock" type="button" class="btn btn-success float-right" style="display:none">Create Stock</button>
          	
            {{-- <div class="model-row row mb-2">
                <div class="col-md-4">
                    <label for="product_id" class=""><span class="glyphicon glyphicon-user"></span> Product </label>
                </div>
                <div class="col-md-8">
                    <select class="product model-row edit_product_id form-control" name="product_id" id="product_id" required>
                        <option value="">Choose</option>
                        @if(isset($products))
                        @foreach($products as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="invalid-feedback"></div>
			</div> --}}

            
            
            
            
            
            
            
            
            
            
            
            
           
            
        </div>
        </div>
    </div>
</div>

@push('after-scripts')
<script>
// init the state from the input
$(".image-checkbox").each(function () {
  if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
    $(this).addClass('image-checkbox-checked');
  }else {
    $(this).removeClass('image-checkbox-checked');
  }
});

// sync the state to the input
$(".image-checkbox").on("click", function (e) {  
    $('.image-checkbox.image-checkbox-checked').removeClass('image-checkbox-checked');
    var $checkbox = $('.image-checkbox').find('input[type="checkbox"]').prop("checked", false);
    $checkbox.prop("checked", false);
    $(this).toggleClass('image-checkbox-checked');
    var $checkbox = $(this).find('input[type="checkbox"]');
    $checkbox.prop("checked",!$checkbox.prop("checked"));    
    $("#next_step").trigger('click');
    //alert($checkbox.val());
    var pid = $checkbox.val();
    productChange(pid);
    e.preventDefault();


});

$("#next_step").on("click", function (e) { 
    var step = $(this).data('step');
    var next_step = step+1;
    var total_steps = $('ul#progressbar li:last-child').data('step');
    var step_percent = (100/total_steps)*step;
    
    $("#stock_progress_bar").width(step_percent+'%');
    $("#stock_progress_bar").text(step_percent+'% Completed');
    $("#fieldset_"+step).hide();
    $("#fieldset_"+next_step).show();
    $('ul#progressbar li#progress_step_'+next_step).addClass('active');
    $("#next_step").data( "step", next_step );
    $("#step_previous_btn").data( "step", step);
    if(next_step > 1){
        $("#step_previous_btn").removeClass("disabled");
    }  
    if(next_step == total_steps){
        $("#next_step").hide();
        $("#create_stock").show();
    }  
});

$("#step_previous_btn").on("click", function (e) {       
    $("#next_step").show();
    $("#create_stock").hide();
    var step = $(this).data('step');
    if(step < 1){
        $("#step_previous_btn").addClass("disabled");
        $("#next_step").data( "step", 1 );
        $("#step_previous_btn").data( "step", 1);
        return false;
    }
    var next_step = step+1;
    var total_steps = $('ul#progressbar li:last-child').data('step');
    var step_percent = (100/total_steps)*step;
    $("#stock_progress_bar").width(step_percent+'%');
    $("#stock_progress_bar").text(step_percent+'% Completed');
    $("#fieldset_"+next_step).hide();
    $("#fieldset_"+step).show();
    $('ul#progressbar li#progress_step_'+next_step).removeClass('active');
    $("#next_step").data( "step", step );
    $("#step_previous_btn").data( "step", step-1);
    
});



function productChange(id){
   
   var productid = id;
   var ths = $(this);
   $.ajax({
        url: "{{ route($route_pre.'.trading.getproductforstock') }}",
        method: 'POST',
        data: {'productid':productid},
        success: function(data)
        {
            console.log(data);
            var selectvariety = '';
            var selectpacking = '';
            var selectquality = ''; 
            var selectdefects = '';
           
            $.each(data.Variety,function(key,value){
                selectvariety += '<option value="'+key+'">'+value+'</option>'
            });
           
            if(data.Variety_id != null){
                $("#field1").html(selectvariety);
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
}
</script>
@endpush