<style>
@media (max-width: 991.98px){
  .selectproduct img {
    width: 280px !important;
  }
}
.classstep
{
    top: -30px;
    position: absolute;
    left: 30px;
}
#progressbar
{
    padding-top: 50px;
}
.stockmodal #progressbar li.firstclass::before, .stockmodal #progressbar li.nextsteps::before{
    background: #115641 !important;
}

.stockmodal #progressbar li.nextsteps2::before{
    background: #32CD32 !important;
}
.image_btn{width: 18%;position: relative;}
.img-box{width: 18%; margin: 0px 2% 0 0;}
.img-box img{ width: 120px; height: 120px; border-radius: 8px; padding: 0px; }

.previous.btn{ position:absolute;top: -10px; left: 6px; }
.next.btn{ position: absolute; top: -10px;right: 8px; }

[draggable] {
  -moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
  user-select: none;
  /* Required to make elements draggable in old WebKit */
  -khtml-user-drag: element;
  -webkit-user-drag: element;
}

</style>
@if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
    @php $route_pre = 'admin'; @endphp
@elseif(auth()->user()->hasRole('seller') && Request::segment(1) == 'seller')
    @php $route_pre = 'seller'; @endphp
@elseif(auth()->user()->hasRole('buyer') && Request::segment(1) == 'buyer')
    @php $route_pre = 'seller'; @endphp    
@endif
<div class="stockmodal modal fade" id="createModals" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header" style="padding:15px 10px;">
           <button type="button"name="previous" class="previous btn btn-primary action-button vk_hide" id="popup_prev_btn" value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
            <h4 style="text-align: center; width: 100%;" id="popup_title">SELECT PRODUCT </h4>
            <button type="button" class="close vk_hide" data-dismiss="modal">&times;</button>
            <input type="button" name="next" class="next btn btn-secondary action-button vk_hide" id="popup_next_btn" value="Next" />
        </div>
        <div class="modal-body" style="padding:15px 10px;position:unset;">
           <form method="post" id="msform" enctype="multipart/form-data">
            <!-- progressbar -->
            <div class="connecting-line"></div>
            <ul id="progressbar">
                <li data-step="1" class="active firstclass" data-id="ss-step1"> <span class="prog-heading classstep">Product</span> <span class="steps-details step1-detail"></span></li>
                <li data-step="2" class="" data-id="ss-step2"><span class="prog-heading classstep">Variety</span><span class="steps-details step2-detail"></span></li>
                <li data-step="3" class="" data-id="ss-step25"><span class="prog-heading classstep">Purpose</span><span class="steps-details step25-detail"></span></li>
                <li data-step="4" class="" data-id="ss-step3"><span class="prog-heading classstep">Condition</span><span class="steps-details step3-detail"></span></li>
                <li data-step="5" class="" style="display:none;" id="ss-step35-block" data-id="ss-step35"><span class="prog-heading classstep">Quality</span><span class="steps-details step35-detail"></span></li>
                <li data-step="6" class="" data-id="ss-step4"><span class="prog-heading classstep">Last Step</span><span class="steps-details step4-detail"></span></li>
            </ul>

            <fieldset class="selectproduct" id="ss-step1">
                @if(auth()->user()->hasRole('administrator'))
                    <div class="model-row row mb-2" style="padding-top: 10px">
                        <div class="col-md-2">
                            <label class="align-fix">Select Seller</label>
                        </div>
                        <div class="col-md-10">
                        <select id="seller_id" name="seller_id" class="model-row form-control">
                            <option value="">Choose Seller</option>
                        </select>
                        </div>
                    </div>
                @endif
                <div id="error_product"></div>
                @foreach ( $productsimage as $image )
                    <img src="{{asset('/images/products/'.$image->image)}}" width="100px" height="100px" data-name="{{$image->name}}" data-id="{{$image->id}}" class="product p-images">
                @endforeach  
                <div class="nextback" style="opacity:0;">     
                    <button type="button" name="next" class="next btn btn-primary step1-n-btn action-button" value="Next"  >Next <i class="fa fa-angle-right"></i></button>
                </div>
            </fieldset>

            <fieldset class="selectproduct" id="ss-step2" style="display: none;">
                <div class="nextback">
                     <button type="button"name="previous" class="previous btn btn-primary action-button " value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                    <button type="button" name="next" disabled class="next btn btn-secondary action-button step2-n-btn" value="Next" >Next <i class="fa fa-angle-right"></i></button>
                </div>
                <div class="productvariety">
                     <select class="model-variety-field model-row form-control">
                        <option value="">Choose Variety</option>
                     </select>
                </div>
            </fieldset>
            
            <fieldset class="selectproduct" id="ss-step25" style="display: none;">
                <div class="nextback" style="">
                    <button type="button"name="previous" class="previous btn btn-primary action-button " value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                    <button type="button" name="next" disabled class="next btn btn-secondary  action-button step25-n-btn" value="Next">Next <i class="fa fa-angle-right"></i></button>
                </div>
                <div class="market-btn-block">
                     
                </div>
            </fieldset>
            

            <fieldset class="selectproduct" id="ss-step3" style="display: none;">
                <div class="nextback">
                    <button type="button"name="previous" class="previous btn btn-primary action-button " value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                    <button type="button" style="" name="next" disabled class="next btn btn-secondary action-button step3-n-btn" value="Next">Next <i class="fa fa-angle-right"></i></button>
                </div>
                <div class="qualityimage">
                    <div class="PurposeMarket">
                    </div>
                    <div class="PurposeProcessing">
                    </div>
                </div>
            </fieldset>
            <fieldset class="selectproduct" id="ss-step35" style="display: none;">
                <div class="nextback">
                   
                     <button type="button"name="previous" class="previous btn btn-primary action-button " value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                  
                    <button type="button" style="" name="next" disabled class="next btn btn-secondary action-button step35-n-btn" value="Next">Next <i class="fa fa-angle-right"></i></button>
                    
                </div>
                <h2 class="fs-title"></h2>
                <div class="purposeimage"></div>
                <div class="model-row row mb-2 vk_hide purpose-quality-main-block">
                    <div class="col-md-12 purpose_qualityimage">
                    </div>
                </div>
            </fieldset>
            <fieldset class="selectproduct" id="ss-step4" style="display: none;">
            
            <div class="model-row vk_hide color-main-block row mb-2">
                <div class="col-md-2">
                    <label class="align-fix">Color</label>
                </div>
                <div class="col-md-10">
                    <select class="model-color-field model-row form-control">
                        <option value="">Choose Color</option>
                    </select>
                </div>
            </div>
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label class="align-fix"> Size (mm)</label>
                </div>
                <div class="col-md-10 rules-section-block productsize">
                    <div class="rule-inner-block row justify-content-center mb-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="size[0][from]"  placeholder="Size From" />
                        </div>
                        <div class="col-md-1">
                            -
                        </div>
                        <div class="col-md-4"> 
                           <input type="text" class="form-control" name="size[0][to]"  placeholder="Size To"/>
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div> 
                </div>
            </div>
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                     <label class="align-fix">Defects </label>
                </div>
                <div class="col-md-10 defect-block">
                    <!--<select class="model-defect-field model-row form-control select2" multiple>
                    </select>-->
                    
                </div>
            </div>
            
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                     <label class="align-fix" style="margin-bottom:0px;">Upload Images </label>
                     <span><b>(<span class='images-count'>0</span>/10)</b></span>
                </div>
                <div class="col-md-10">
                        <div class="image_btn">
                            <button type="button" class="btn btn-primary btn-sm" style="width: 130px; margin-top: 0px;">
                               Upload <i class="fa fa-upload"></i>
                            </button>
                            <input type="file"  name="stock_images[]" accept="image/x-png,image/gif,image/jpeg" multiple id="imgInp" style="position: absolute;opacity: 0;width: 100%;height: 120px;left: 0;top: 0;" />
                        </div>
                    <div class="uploaded_images  row">
                    </div>
                </div>
            </div>
            <hr>
            
          
            <div class="error invalid-feedback img_error">Please Upload atleast one image.</div>
            
            
            <!---
            <div class="model-row add-nets-row justify-content-center vk_hide row mb-2">
                <div class="col-md-2"> 
                    <label class=""><span class="glyphicon glyphicon-eye-open"></span>Nets</label>
                </div>
                <div class="col-md-4">
                    <input type="text" id="additional-nets2" data-defect-id="" data-defect-name="" class="col-md-12 form-control"/>
                </div>
                <div class="col-md-1">
                    <input type="button" class="rule-add btn btn-primary save_nets2" value="Save"/>
                </div>
                <div class="col-md-2">
                    <button type="button" class="cancel_nets btn btn-danger btn-md"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
            --->   

            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label class="align-fix">  Price per Tonne: </label>
                </div>
                <div class="col-md-10">
                    <div class="row mb-2">
                        <div class="col-md-1">
                            <select name="price_currency" id="price_currency" class="form-control  pull-left" style="float: left;" >
                                <option value="euro" data-val="&euro;">&euro;</option>
                                <option value="dollar" data-val="$">$</option>
                                <option value="pound" data-val="&pound;">&pound;</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <input name="price" id="price" type="text" class="price-field2 seller-price-field form-control" />
                            <div class="invalid-feedback"></div>
                        </div>
                        <!--- <div class="col-md-4">
                            <select id="default_packing" name="default_packing" class="form-control" >
                                
                            </select>
                        </div>
                        --->
                    </div>
                </div>
            </div>
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label class="align-fix">  Country: </label>
                </div>
                <div class="col-md-10">
                    <div class="row mb-2">
                        <div class="col-md-4">
                        <select class="select2 form-control select2-hidden-accessible" id="seller_country" name="country" maxlength="191" placeholder="Select Tag" tabindex="-1" aria-hidden="true">
                                   @php 
                                   echo $countries = get_country_short_code_dropdown();
                                    @endphp   
                        </select>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label class="align-fix">  Postal Code: </label>
                </div>
                <div class="col-md-10">
                    <div class="row mb-2">
                        <div class="col-md-4">
                        <input name="postalcode" id="postalcode" type="text" class="form-control" />
                         <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="model-row row mb-2">
                <div class="col-md-12 productpaking">
                    
                </div>
            </div>
            
            <div class="model-row row mb-2 vk_hide colorful-main-block">
                <div class="col-md-2">
                    <label class="align-fix">  Colorful </label>
                </div>
                <div class="col-md-10">
                      <input id="colorful" type="range" />
                      <input name="colorful[from]" id="colorful_from" type="hidden" />
                      <input name="colorful[to]" id="colorful_to" type="hidden" />
                </div>
            </div>
            
            <div class="model-row vk_hide sugar-main-block row mb-2">
                <div class="col-md-2">
                    <label class="align-fix"> Sugar Content </label>
                </div>
                <div class="col-md-10">
                      <input id="sugar_content" type="range" >
                      <input name="sugar_content[from]" id="sugar_content_from" type="hidden" />
                      <input name="sugar_content[to]" id="sugar_content_to" type="hidden" />
                </div>
            </div>
           
            <!---dont remove, later we will use
            <div class="model-row row mb-2 extra-services-main-block vk_hide">
                 <div class="col-md-2">
                 <label>Extra Services</label>
                 </div>
                <div class="col-md-8 model-row cleaning_options">
                </div>
            </div>
            
            dont remove, later we will use
            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label> Status </label>
                </div>
                <div class="col-md-10">
                    <select name="" class="status form-control">
                        <option value="unavailable">Unavailable</option>
                        <option selected value="available">Available</option>
                        <option value="upcoming_stock">Upcoming Stock</option>
                    </select>
                </div>
            </div>
            --->
            <div class="model-row row mb-2 total-price-block vk_hide">
                <div class="col-md-2">
                    <label>  Total Price: </label>
                </div>
                <div class="col-md-10 total_price2">
                   
                </div>
            </div>
            
           
            <div class="nextback">
                
                 <button type="button"name="previous" class="step4-p-btn previous btn btn-primary action-button" value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                <input type="hidden" class="model-product-id" name="product_id"/>
                <input type="hidden" class="model-purpose-id" name=""/>
                <input type="hidden" class="model-quality-id" name=""/>
                <input type="hidden" id="model-mp" name="model-mp"/>
                <input type="hidden" id="model-mp-id" name="model-mp-id"/>
                <input type="hidden" id="model-mp-child" name="model-mp-child"/>
                <input name="stock_status" value="available" type="hidden"/>
                <input type="submit" id="create_stock2" class="btn btn-primary" value="Submit" style="width:150px; margin-top:0px;"/>
                <!--<input type="button" style="" name="next" class="next btn btn-primary action-button step4-n-btn" value="Next" />-->
            </div>
            </fieldset>
			<!--<fieldset class="selectproduct" id="ss-step5" style="display: none;">
                <h2 class="fs-title">Select Images</h2>
					<input type="file"  name="stock_images[]" multiple id="imgInp" />
					<div class="uploaded_images justify-content-center row">
					</div>
					<div class="nextback">     
                <input type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous" />
                
                <input type="submit" id="create_stock2" class="btn btn-primary" value="Submit" />
                </div>
            </fieldset>-->
			
			</form>
        </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script src="{{asset('/js/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.stockPopup = {
    changeTitle : function(step){
        switch(step) {
            case 1:
                $("#popup_title").html('SELECT Product');
                break;
            case 2:
                $("#popup_title").html('SELECT VARIETY');
                break;
            case 3:
                $("#popup_title").html('SELECT PURPOSE');
                break;
            case 4:
                $("#popup_title").html('SELECT CONDITION');
                break;
            case 5.1:
                $("#popup_title").html('SELECT SOIL');
                break;
            case 5.2:
                $("#popup_title").html('SELECT QUALITY');
                break;
            case 6:
                $("#popup_title").html('LAST STEP');
                break;            
            default:
            // code block
        }
    },
    changeButton : function(step){
        //#popup_prev_btn #popup_next_btn #popup_title
    }
}


var products = @json($productsimage);
var productid;
var productSpecData = {};
let i = 0;
function getConfig(){
    $.ajax({
        url: "{{ url('seller/get-product-stock-ajax') }}",
        method: 'POST',
        dataType: "json",
        success: function(data)
        {
           productSpecData = data;
        } 
    });
}
setTimeout(function(){
   getConfig();
},500);
@php   $productConfiguration  =   get_product_configuration();
       $qualityGlobalArray    =   get_quality_global_array();
@endphp
 var productConfiguration  =   @json($productConfiguration);
 var qualityGlobalArray    =   @json($qualityGlobalArray);
var model2_pid, model2_purposeid, model2_qualityid;
var increment = 1;
var sizehtml = ' ';
let defects2 = [];
let price2 = 0;
let iindex = 0;
let total_images = 0;
let productDetail;
var formData = new FormData();
function readURL(input) {
    if (input.files && input.files[0]) {
        $.each(input.files,function(k,v){
            var reader = new FileReader();
        
            reader.onload = function(e) {
                $img = $('<img/>').attr('src', e.target.result);
                x = $("<div class='img-box'></div>");
                x.append("<i class='delete-image' data-index='"+iindex+"'>X</i>");
                x.append("<input type='hidden' name='image-order[]' value='"+iindex+"'/>");
                x.append($img);
                $('.uploaded_images').append(x);
            }
            
            reader.readAsDataURL(input.files[k]);
        });
    }
}


 
   
        
$(document).on("click",".delete-image",function(){
	index = $(this).data('index');
	$(this).parents('.img-box').remove();
	formData.delete('image['+index+']');
    total_images--;
    $(".images-count").text(total_images);
});
//formData.delete('image[1]');

$("#imgInp").change(function() {
    $('#create_stock2').removeAttr('disabled');
	if(total_images < 9){
        var totalfiles = document.getElementById('imgInp').files.length;
        for (var index = 0; index < totalfiles; index++) {
            iindex++;
            total_images++;
            $(".images-count").text(total_images);
            formData.append("image["+iindex+"]", document.getElementById('imgInp').files[index]);
		}
        readURL(this);
    }
});

var saveResult2 = function (data) {
    $("#colorful_from").val(data.from_pretty);
    $("#colorful_to").val(data.to_pretty);
};

$("#colorful").ionRangeSlider({type: "double", min: 0, max: 100, from: 30, to: 45, grid: true, onChange: saveResult2 });


var saveResult = function (data) {
    $("#sugar_content_from").val(data.from_pretty);
    $("#sugar_content_to").val(data.to_pretty);
};

$("#sugar_content").ionRangeSlider({type: "double",min: 0,max: 100,from: 10,to: 20,grid: true,onChange: saveResult});

$(document).on("click",".del-size-btnRemove",function(){
    $(this).parents('.rule-inner-block').remove();
});
$("#addsize").click(function(){
    sizehtml ='<div class="rule-inner-block row justify-content-center mb-2"><div class="col-md-4">'+'<input type="text" class="form-control" name="size['+increment+'][from]"  placeholder="Size From"></div><div class="col-md-4"><input type="text" class="form-control" name="size['+increment+'][to]"  placeholder="Size To"></div><div class="col-md-4"><button type="button" class="del-size-btnRemove btn btn-danger btn-md" style=""><i class="fas fa-trash-alt"></i></button></div></div>';
    $('.productsize').append(sizehtml);
    increment++;
})

$(document).on("click","li.active",function(){
});
/****Step1****/
$("body").on("click",".p-images",function(){
    
    if($(this).hasClass('active')){
        $('.step1-n-btn').trigger('click');
        return false;
    }
    
    $('.steps-details').html('');
    $('li').removeClass('nextsteps');
    $('li').removeClass('nextsteps2');
    //$('.step2-detail').html('');
    //$('.step35-detail').html('');
    //$('.step3-detail').html('');
    //$('.step3-detail').html('');
    
    $("#createModals #progressbar li:first-child").removeClass('firstclass');
    $("#edit-stock-modal #progressbar li:first-child").addClass('active');
    $('.p-images').removeClass('active');
    $(this).addClass('active');
    var productName = $(this).data('name');
    if(productName)
    {
       $('.step1-detail').html(productName);
    }
    model2_pid = $(this).data('id');
    $(".model-product-id").val($(this).data('id'));
    
    stockPopup.changeTitle(2);

    productid = $(this).data('id');
    if(productSpecData[productid] != undefined)
    {
       data = productSpecData[productid];
       setupProduct(data)
    } else {
        
        $(".colorful-main-block").addClass('vk_hide');
        $(".color-main-block").addClass('vk_hide');
        $(".sugar-main-block").addClass('vk_hide');
        $(".extra-services-main-block").addClass('vk_hide');
        if(productConfiguration[productid] != undefined){
            if(productConfiguration[productid]['Colorful'] != undefined){
                $(".colorful-main-block").removeClass('vk_hide');
            }

            if(productConfiguration[productid]['Color'] != undefined){
                $(".color-main-block").removeClass('vk_hide');
            }

            if(productConfiguration[productid]['Extra Services'] != undefined){
                $(".extra-services-main-block").removeClass('vk_hide');
            }

            if(productConfiguration[productid]['Sugar Content'] != undefined){
                $(".sugar-main-block").removeClass('vk_hide');
            }
        }

        $.ajax({
            url: "{{ url('seller/get-product-stock-ajax') }}",
            method: 'POST',
            data: {productid:productid},
            dataType: "json",
            success: function(data)
            {
                setupProduct(data);
            }
        });
   }
});

/***Step2****/
$(document).on('change','.model-variety-field',function(){       
    $('.step2-detail').html($('option:selected', this).text());
    $('.step2-n-btn').trigger('click');
    $('.step2-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
    stockPopup.changeTitle(3);
})
 
$(document).on('click','.step2-n-btn',function(){  
    let varityClickHtml = $(".model-variety-field option:selected").text();
    $('.step2-detail').html(varityClickHtml);
})

/***Step3****/

$(document).on('click','.market-btn',function(){
    if($(this).hasClass('active')){
        $('.step25-n-btn').trigger('click');
        return false;
    }
    
    var purposeValue = $(this).val();
    $('.step25-detail').html(purposeValue);
    $('.market-btn').removeClass('active');
    $(this).addClass('active');
    $('#model-mp').val(purposeValue);
    $('#model-mp-id').val($(this).attr('data-id'));
    if(purposeValue == 'Market' || purposeValue == 'Packing')
    {
        $('.PurposeMarket').show();
        $('.PurposeProcessing').hide();
        $("#ss-step35-block").show();
        $('.step3-detail').html('');
        $('.step35-detail').html('');
    }
    else if(purposeValue == 'Processing')
    {
        $('.PurposeProcessing').show();
        $('.PurposeMarket').hide();
        $("#ss-step35-block").hide();
        
        $('.step3-detail').html('');
        $('.step35-detail').html('');
    }
    $('.step25-n-btn').trigger('click');
    $('.step25-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
    
    $('.step3-n-btn').addClass('btn-secondary').removeClass('btn-primary').attr('disabled',true);
    $('.q-images').removeClass('active');
    
    stockPopup.changeTitle(4);
})
    
$(document).on('change', '.market', function() {
    if ($(this).is(":checked")) {
        $('.step3-detail').html($('input:radio:checked').data('marketname'));
    }
});
$(document).on('change', '.processing', function() {
    let checkedProcessing = [];
    $('.processing').each(function(){
        if ($(this).prop("checked")) {
           checkedProcessing.push( $(this).data('purposename'));
        }
    });
    $('.step3-detail').html(checkedProcessing.join(', '));
    //$('.edit-step3-detail').html(checkedProcessing.join(', '));
});

$(document).on('click', '.step3-n-btn', function() {
    if($('.market-btn.active').val() == 'Processing'){
        $("fieldset").hide();
        $("#ss-step4").show();
        $("#ss-step4").removeProp("opacity");
        $("#ss-step4").removeAttr("style");
    } else {
        //$("#ss-step35-block").show();
    }
})

$(document).on('click', '.step4-p-btn', function() {
    if($('.market-btn.active').val() == 'Processing'){
        $("fieldset").hide();
        $("#ss-step3").show();
        $("#ss-step3").removeProp("opacity");
        $("#ss-step3").removeAttr("style");
    }
})
    
   
$(document).on('click', '.model-variety-field model', function() {
    $('.step3-n-btn').trigger('click');
 })
     
     
/***Step4****/
$("body").on("click",".q-images",function(){
    model2_purposeid = $(this).data('id');
    setupQualityOrUW(model2_pid, model2_purposeid);
    $('.q-images').removeClass('active');
    $(this).addClass('active');
    if($(this).parents('form').attr('id') == 'edit-msform'){
        $(".edit-model-purpose-id").val($(this).data('id'));
        
        if($('.edit-market-btn.active').val() == 'Processing'){
            $("fieldset").hide();
            $("#edit-ss-step4").show();
            $("#edit-ss-step4").removeProp("opacity");
            $("#edit-ss-step4").removeAttr("style");
        } else {
            $("fieldset").hide();
            $("#edit-ss-step35").show();
            $("#edit-ss-step35").removeProp("opacity");
            $("#edit-ss-step35").removeAttr("style");
        }
        $('.edit-step3-n-btn').trigger('click');
        $('.edit-step3-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
    } else {
        $(".model-purpose-id").val($(this).data('id'));
        if($('.market-btn.active').val() == 'Processing'){
            $("fieldset").hide();
            $("#ss-step4").show();
            $("#ss-step4").removeProp("opacity");
            $("#ss-step4").removeAttr("style");
        } else {
            $("fieldset").hide();
            $("#ss-step35").show();
            $("#ss-step35").removeProp("opacity");
            $("#ss-step35").removeAttr("style");
        } 
        $('.step3-n-btn').trigger('click');
        $('.step3-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
    }
});



/***Step5****/
let qulaityHtml1 ='';
let qulaityHtml ='';
$("body").on("click",".p-q-images",function(){
    $('.step35-n-btn').trigger('click');
    $('.edit-step35-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
    qulaityHtml1 = $(this).parent().find('p').text();
    $('.step35-detail').html(qulaityHtml1);
    model2_qualityid = $(this).data('id');
    $('.p-q-images').removeClass('active');
    $(this).addClass('active');
    if($(this).parents('form').attr('id') == 'edit-msform'){
        $(".edit-model-quality-id").val($(this).data('id'));
    } else {
        $(".model-quality-id").val($(this).data('id'));
    }
    stockPopup.changeTitle(6);
    $('.step35-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
});

/***Step5****/
$("body").on("click",".p-q-images2",function(){
    qulaityHtml = $(this).parent().find('p').text();
    $('.step35-detail').html(qulaityHtml);
    $('.step35-n-btn').trigger('click');
    stockPopup.changeTitle(6);
    $('.step35-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
})
$("body").on("click",".p-q-images2",function(){
    $('.p-q-images2').removeClass('active');
    $(this).addClass('active');
    if($(this).parents('form').attr('id') == 'edit-msform'){
        dataId = $(this).data('id');
        $('#edit-model-mp-child').val(dataId);
    } else {
        dataId = $(this).data('id');
        $('#model-mp-child').val(dataId);
    }   
});




// function handleDragStart(e) {
  // this.style.opacity = '0.4';  // this / e.target is the source node.
// }

// var cols = document.querySelectorAll('#columns .column');
// [].forEach.call(cols, function(col) {
  // col.addEventListener('dragstart', handleDragStart, false);
// });


var  dragSrcEl = null;

function handleDragStart(e) {
  // Target (this) element is the source node.
  //this.style.opacity = '0.4';

  dragSrcEl = this;

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }

  e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

  return false;
}

function handleDragEnter(e) {
  // this / e.target is the current hover target.
  this.classList.add('over');
}

function handleDragLeave(e) {
  this.classList.remove('over');  // this / e.target is previous target element.
}

function handleDrop(e) {
  // this/e.target is current target element.
  if (e.stopPropagation) {
    e.stopPropagation(); // Stops some browsers from redirecting.
  }

  // Don't do anything if dropping the same column we're dragging.
  if (dragSrcEl != this) {
    // Set the source column's HTML to the HTML of the column we dropped on.
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
  }

  return false;
}

function handleDragEnd(e) {
  // this/e.target is the source node.

  [].forEach.call(cols, function (col) {
    col.classList.remove('over');
  });
}


  $(document).on('dragstart', ".img-box",function(e){
         
      // Target (this) element is the source node.
      //this.style.opacity = '0.4';
      dragSrcEl = this;
      e.originalEvent.dataTransfer.effectAllowed = 'move';
      e.originalEvent.dataTransfer.setData('text/html', this.innerHTML);
  });


  $(document).on('dragover', ".img-box",function(e){
             
      if (e.preventDefault) {
        e.preventDefault(); // Necessary. Allows us to drop.
      }
      e.originalEvent.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.
      return false;
  });
  $(document).on('dragenter', ".img-box",function(e){
        // this / e.target is the current hover target.
        this.classList.add('over');
  });
  $(document).on('dragleave', ".img-box",function(e){
        this.classList.remove('over');  // this / e.target is previous target element.
  });
  $(document).on('drop', ".img-box",function(e){
        // this/e.target is current target element.
      if (e.stopPropagation) {
        e.stopPropagation(); // Stops some browsers from redirecting.
      }

      // Don't do anything if dropping the same column we're dragging.
      if (dragSrcEl != this) {
        // Set the source column's HTML to the HTML of the column we dropped on.
        dragSrcEl.innerHTML = this.innerHTML;
        this.innerHTML = e.originalEvent.dataTransfer.getData('text/html');
      }

      return false;
  });
  $(document).on('dragend', ".img-box",function(e){
        // this/e.target is the source node.
      [].forEach.call(cols, function (col) {
        col.classList.remove('over');
      });
  });
  
  $(".img-box").each(function(){
  $(this).on('dragstart', handleDragStart, false);
  $(this).on('dragenter', handleDragEnter, false)
  $(this).on('dragover', handleDragOver, false);
  $(this).on('dragleave', handleDragLeave, false);
  $(this).on('drop', handleDrop, false);
  $(this).on('dragend', handleDragEnd, false);
});

function setupQualityOrUW(model2_pid, model2_purposeid){
    quality_purpose = '';
    if(productSpecData[model2_pid]['PurposeChilds'][model2_purposeid] != undefined){
        $.each(productSpecData[model2_pid]['PurposeChilds'][model2_purposeid],function(k,v){
            quality_purpose +='<div class="p-quality-block"><p>'+v.title+'</p><img style="width:200px;height:200px;"class="p-q-images2" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'" data-purposename="'+v.title+'"></div>';
        });
        $('.purposeimage').html(quality_purpose);
        $('.purpose_qualityimage').html('');
        $('#ss-step35-block .classstep').html('SOIL');
        stockPopup.changeTitle(5.1);
    } else {
        $('.purposeimage').html('');
        if(productConfiguration[model2_pid] != undefined && productConfiguration[model2_pid]['Quality'] == 'Conditional'){
            if(qualityGlobalArray[model2_pid][model2_purposeid] != undefined){
                $('.purpose-quality-main-block').removeClass('vk_hide');
                qualityData = qualityGlobalArray[model2_pid][model2_purposeid];
               
                qulaity_selectionData1 = '';
                qulaity_selectionData2 = '';
                $.each(qualityData,function(k,v){
                    if(v.class == 'Class1'){
                        qulaity_selectionData1 +='<div style="display: inline-block;" class="p-quality-block"><p>'+v.title+'</p><img class="p-q-images" data-quality="'+v.title+'" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
                    } else if(v.class == 'Class2'){
                        qulaity_selectionData2 +='<div style="display: inline-block;"  class="p-quality-block"><p>'+v.title+'</p><img class="p-q-images" data-quality="'+v.title+'" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
                    }                    
                })
                qulaity_selectionData = "<div class='model-row'> <label class='model-row class-label'>Class1 </label>"+qulaity_selectionData1+"</div>";
                if(qulaity_selectionData2 != ''){
                    qulaity_selectionData += "<div class='model-row'> <label class='model-row class-label'>Class2 </label>"+qulaity_selectionData2+" </div>";
                }
                $('.purpose_qualityimage').html(qulaity_selectionData);
                $('#ss-step35-block .classstep').html('QUALITY');
                stockPopup.changeTitle(5.2);
            } else {
                $('.purpose_qualityimage').html('');
            }
        } else {
            $('.purpose-quality-main-block').removeClass('vk_hide');
            qualityData = qualityGlobalArray[model2_pid];
            qulaity_selectionData = '';
            $.each(qualityData,function(k,v){
                qulaity_selectionData +='<div class="p-quality-block"><p>'+v.title+'</p><img class="p-q-images" data-quality="'+v.title+'" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
            })
            $('.purpose_qualityimage').html(qulaity_selectionData);
            $('#ss-step35-block .classstep').html('QUALITY');
            stockPopup.changeTitle(5.2);
        }
    
    }
    
}

$(document).on('change','.price-field2', function(){
    price2 = 0;
    $(".price-field2").each(function(k){
        if(this.value != ''){
            price = price + parseFloat(this.value);
        }
    });
    curr = $('select[name="price_currency"] option:selected').data('val');
    $('.total_price2').text(Number(price));
});


$('#msform').on('submit', function(event) {
    event.preventDefault();
    //var formData = new FormData($(this)[0]);
    //$.each(formData,function(k,d){
      //  formData.append(d.name, d.value);
    //});
    
    formDataArr = $("#msform").serializeArray();
    $.each(formDataArr,function(k,d){
        formData.append(d.name, d.value);
    });
    if( total_images == 0 ){
        //$(".img_error").show();
        $('#create_stock2').removeAttr('disabled');
        Swal.fire('Error!','Please upload atleast one image.', 'error');
        
        return false;
    }
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
                var url=window.location.href;
                if (url.indexOf('dashboard') > -1) {
                   window.location.href = "{{ route('seller.stockcardview') }}";
                } else {
                   window.location.reload();
                }
            }, 2000);
        },
        error :function( data ) {
            if( data.status === 422 ) {
                $('.loading').addClass('loading_hide');
               Swal.fire('Error!', data.responseJSON.message, 'error');
                $('.btn.btn-primary').removeAttr('disabled');
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
                        $("#ss-step1").removeAttr('style');
                        $('#error_product').html('Choose Any one product').css({"color": "#f11212"});
                        $('li').addClass('active');
                    }
                    
                    if(key == 'price'){
                        $("fieldset").hide();
                        $("#ss-step4").show();
                        $("#ss-step4").removeAttr('style');
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
    return false;
});


$(document).on('click','.save_nets2',function(){
    title = $(this).attr('title');
    additional_nets = $('#additional-nets2').val();
    defects2[title] = additional_nets;
    $(".select2-container").find('li.select2-selection__choice').each(function(){
        if( $(this).attr('title') == title){
            $(this).append(' - '+additional_nets+'%');
        }
    });
    $('.add-nets-row').addClass('vk_hide');    
    $('#additional-nets2').val('');  
});

$(document).on('click','.cancel_nets ',function(){
    $('.add-nets-row').addClass('vk_hide');
});


$('.model-defect-field').on('select2:select', function (e) {
    var data = e.params.data;
    $(".select2-container").find('li.select2-selection__choice').each(function(){
        str = $(this).text();
        var res = str.replace("×", "");
        if(defects2[res] != undefined){
            if(res != data.text){
                $(this).append(' - '+defects2[res]+'%');
            }
        }
    });
    $('.save_nets2').attr('title',data.text);
    $('.add-nets-row').removeClass('vk_hide');
});

$('.model-defect-field').on('select2:unselect', function (e) {
    var data = e.params.data;
    $(".select2-container").find('li.select2-selection__choice').each(function(){
        str = $(this).text();
        var res = str.replace("×", "");
        if(defects2[res] != 'undefined'){
            if(res != data.text){
                $(this).append(' - '+defects2[res]+'%');
            }
        }
    });
    $('.save_nets').attr('title',data.text);
});



$(document).on('change','.model-packing-change',function(){
   $(this).parents('tr').find('input[type="number"]').toggleClass('vk_hide');
   $(this).parents('tr').find('.total_price3').toggleClass('vk_hide');
});

$(document).on('keyup','.seller-price-field',function(){
    price1 = $(this).val();
    var price = 0;
    $('.price-field2-packing').each(function(){
        price2 = $(this).val();
        price = Number(price1) + Number(price2);
        if( price2 > 0 ){
            curr = $('option:selected', 'select[name="price_currency"]').attr('data-val');
            $(this).parents('tr').find('.total_price3_field').text(Number(price));
            $(this).parents('tr').find('.price_curr_label_td').text(curr);
        }
    });
});

$(document).on('keyup','.price-field2-packing',function(){
    price1 = Number($('.seller-price-field').val());
    var price = 0;
    if($(this).val() == ''){
        price2 = 0;
    } else { price2 = Number($(this).val()); }
    price = Number(price1) + Number(price2);
    curr = $('select[name="price_currency"] option:selected').data('val');
    $(this).parents('tr').find('.total_price3_field').text(Number(price));
    $(this).parents('tr').find('.price_curr_label_td').text(curr);
});


    
$(function() {
    
    //jQuery time
    var current_fs, next_fs, previous_fs;
    var left, opacity, scale;
    var animating;

    $(".next").click(function(){
    if(animating) return false;
    animating = true;
    current_fs = $(this).parents('fieldset');
    next_fs = $(this).parents('fieldset').next();

    //activate next step on progressbar using the index of next_fs
    console.log($("fieldset").index(next_fs))
    if($('.market-btn.active').val() == 'Processing' && $("fieldset").index(next_fs) == 3){
        $("#createModals #progressbar li").eq($("fieldset").index(current_fs)).removeClass("nextsteps");
        $("#createModals #progressbar li").removeClass('nextsteps2');
        $("#createModals #progressbar li").eq($("fieldset").index(next_fs)  + 1).addClass("active nextsteps");
    } else if($('.market-btn.active').val() == 'Processing' && $("fieldset").index(next_fs) == 4){
        $("#createModals #progressbar li").eq($("fieldset").index(current_fs)).removeClass("nextsteps");
        $("#createModals #progressbar li").removeClass('nextsteps2');
        $("#createModals #progressbar li").eq($("fieldset").index(next_fs)  + 1).addClass("active nextsteps");
    } else {
        step = $("#createModals #progressbar .nextsteps").attr('data-step');
        $("#createModals #progressbar li").removeClass('nextsteps2');
        if(step == "6"){
            $("#createModals #progressbar li").eq($("fieldset").index(next_fs)).addClass("nextsteps2");
        } else {
            $("#createModals #progressbar li").removeClass('nextsteps');
            $("#createModals #progressbar li").eq($("fieldset").index(next_fs)).addClass("active nextsteps");
        }
    }
    if($('.edit-market-btn.active').val() == 'Processing' && $("#edit-stock-modal fieldset").index(next_fs) == 3){
        $("#edit-stock-modal #progressbar li").eq($("#edit-stock-modal fieldset").index(current_fs)).removeClass("nextsteps");
        $("#edit-stock-modal #progressbar li").removeClass('nextsteps2');
        $("#edit-stock-modal #progressbar li").eq($("#edit-stock-modal fieldset").index(next_fs)  + 1).addClass("active nextsteps");
    } else if($('.edit-market-btn.active').val() == 'Processing' && $("#edit-stock-modal fieldset").index(next_fs) == 4){
        $("#edit-stock-modal #progressbar li").eq($("#edit-stock-modal fieldset").index(current_fs)).removeClass("nextsteps");
        $("#edit-stock-modal #progressbar li").removeClass('nextsteps2');
        $("#edit-stock-modal #progressbar li").eq($("#edit-stock-modal fieldset").index(next_fs)  + 1).addClass("active nextsteps");
    } else {
        step = $("#edit-stock-modal #progressbar .nextsteps").attr('data-step');
        $("#edit-stock-modal #progressbar li").removeClass('nextsteps2');
        if(step == "6"){
            $("#edit-stock-modal #progressbar li").eq($("#edit-stock-modal fieldset").index(next_fs)).addClass("nextsteps2");
        } else {
            $("#edit-stock-modal #progressbar li").removeClass('nextsteps');
            $("#edit-stock-modal #progressbar li").eq($("#edit-stock-modal fieldset").index(next_fs)).addClass("active nextsteps");
        }
    }
    
    
    //$("#edit-stock-modal #progressbar li").eq($("fieldset").index(current_fs)).removeClass("nextsteps");
    //$("#edit-stock-modal #progressbar li").eq($("fieldset").index(next_fs)).addClass("active nextsteps");
        next_fs.show();
        current_fs.animate({opacity: 1}, {
        step: function(now, mx) {
        scale = 1 - (1 - now) * 0.2;
        left = (now * 50)+"%";
        opacity = 1 - now;
       // current_fs.css({'transform': 'scale('+scale+')'});
        //next_fs.css({'left': left, 'opacity': opacity});
        },
        duration: 400,
        complete: function(){
        current_fs.hide();
        animating = false;
        },
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
    });
    });

    $(".previous").click(function(){
        //alert($(this).parents('fieldset'));
    if(animating) return false;
    animating = true;
    current_fs = $(this).parents('fieldset');
    previous_fs = $(this).parents('fieldset').prev();
    //de-activate current step on progressbar
    //$("#createModals #progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    if($('.market-btn.active').val() == 'Processing' && $("fieldset").index(previous_fs) == 4){
        $("#createModals #progressbar li").removeClass('nextsteps2');
        $("#createModals #progressbar li").eq($("fieldset").index(previous_fs) - 1).addClass("nextsteps2");
    } else {
        $("#createModals #progressbar li").removeClass('nextsteps2');
        $("#createModals #progressbar li").eq($("fieldset").index(previous_fs)).addClass("nextsteps2");
    }

    $("#edit-stock-modal #progressbar li").eq($("fieldset").index(current_fs)).removeClass("active nextsteps");
    $("#edit-stock-modal #progressbar li").eq($("fieldset").index(previous_fs)).addClass("nextsteps");
    $("#edit-stock-modal #progressbar li:last-child").removeClass('firstclass');
        previous_fs.show();
        current_fs.animate({opacity: 1}, {
        step: function(now, mx) {
        scale = 0.8 + (1 - now) * 0.2;
        left = ((1-now) * 50)+"%";

        opacity = 1 - now;
       // current_fs.css({'left': left});
        //previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
        },
        duration: 200,
        complete: function(){
        current_fs.hide();
        animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
        });
    });

   $(document).on("click","li.active",function(){ 
        var id = $(this).data('id');
        let step = $(this).data('step');
        $("fieldset").hide();
        $("#"+id).show();
        $("#"+id).removeProp("opacity");
        $("#"+id).removeAttr("style");
        $(this).addClass('active');
        $('li').removeClass('nextsteps2');
        $(this).addClass('nextsteps2');
        
        stockPopup.changeTitle(step);
        
        /*
        if( id == "ss-step2" || id == "ss-step3" || id == "ss-step4")
        {
           if($('.model-product-id').val() == '')
           {
            Swal.fire('Error!',"Can't go to the next step without chooseing product", 'error');
                $("fieldset").hide();
                $("#ss-step1").show();
                $('#error_product').html('Choose Any one product').css({"color": "#f11212"});
           }
           else
           {
                $("fieldset").hide();
                $("#"+id).show();
                $(this).addClass('active');
                //$('li').removeClass('active');
            }
        } */
    })
    
    $(document).on('change','#price_currency',function(){
        curr = $('option:selected', this).attr('data-val');
        $(".price_curr_label").html(curr);
        $(".price_curr_label_td").html(curr);
    });
    
});
 $('#seller_id').on('select2:select', function (e) {
    var data = e.params.data;
    seller_id = data.id;
    $.ajax({
        url: '{{route('admin.seller.getSeller')}}',
        method: 'GET',
        data: {seller_id:seller_id},
        success: function(response)
        {
            $("#postalcode").val(response.postalCode);
            $("#seller_country").val(response.country);
            $('#seller_country').select2().trigger('change');
        } 
    });
});
$("#createModals").on('shown.bs.modal', function(){
    $("#seller_id").select2({
        ajax: {
            url: '{{route($route_pre.'.sellers.search')}}',
            dataType: 'json',
            data: function (params) {
                return {
                  search: params.term // search term
                };
              },
            processResults: function (data) {
                console.log(data.result.length);
              // Transforms the top-level key of the response object from 'items' to 'results'
              return {
                results: data.result
              };
            }
        }
    });
    
    $(".model-variety-field").select2({
        ajax: {
            url: '{{route($route_pre.'.product.getVarity')}}',
            dataType: 'json',
            data: function (params) {
                return {
                  product_id: productid,
                  search: params.term // search term
                };
              },
            processResults: function (data) {
                console.log(data.result.length);
              // Transforms the top-level key of the response object from 'items' to 'results'
              return {
                results: data.result
              };
            }
        }
    });
    
});
function setupProduct(data)
{
        //console.log(data);
        //console.log(data.Defects);
        var htmlvariety = ' ';
        var qulaityimage = ' ';
        var PurposeMarket = ' ';
        var PurposeProcessing = ' ';
        var htmlproductpackaing='';
        productDetail = data;
        var selectvariety = '<option value="Others">Others</option>';
        var selectpacking = '';
        var selectquality = ''; 
        var selectdefects = '';
        var selectcleaning = '';
        var selectcolor = '';
        
       
        $.each(data.Defects,function(key,value){
            selectdefects +='<div class="image-block"><input type="checkbox" name="fields['+data.Defects_id+'][]" class="defect-group" id="def'+key+'" value="'+key+'"><p>'+value.title+'</p><label for="def'+key+'"><img class="" data-id="'+key+'" src="{{ asset('/images/productspec') }}/'+value.image+'"></label></div>'
        })
        $('.defect-block').html(selectdefects);
        
        // if(data.Defects_id != null){
            // $(".model-defect-field").html(selectdefects);
            // $(".model-defect-field").attr('name',"fields["+data.Defects_id+"][]");
            // $(".model-defect-field").attr('data-id',data.Defects_id);
        // } else { 
            // $(".model-defect-field").html('');
            // $(".model-defect-field").attr('name',"");
            // $(".model-defect-field").attr('data-id',"");
        // }
        
        /***Variety Block****/
        $.each(data.Variety,function(key,value){
            selectvariety += '<option value="'+key+'" >'+value+'</option>'
        });

        if(data.Variety_id != null){
            $(".model-variety-field").html('');
            $(".model-variety-field").attr('name',"fields["+data.Variety_id+"]");
            $(".model-variety-field").attr('data-id',data.Variety_id);
            
        } else {
            $(".model-variety-field").html('');
            $(".model-variety-field").attr('name',"");
            $(".model-variety-field").attr('data-id',"");
        }
        //console.log(productid);
       
      
        
                       
        
       
        
        
       
       
        /***Variety Block****/

        /***Color Block****/
        $.each(data.Color,function(key,value){
            selectcolor += '<option value="'+key+'">'+value+'</option>'
        });
        if(data.Color_id != null){
            $(".model-color-field").html(selectcolor);
            $(".model-color-field").attr('name',"fields["+data.Color_id+"]");
            $(".model-color-field").attr('data-id',data.Color_id);
        } else {
            $(".model-color-field").html('');
            $(".model-color-field").attr('name',"");
            $(".model-color-field").attr('data-id',"");
        }
        $(".model-color-field").select2({
            tags: true
        });
        /***Color Block****/

        /***ExtraServices Block****/
        $.each(data.ExtraServices,function(key,value){
            inp = '';
            inp = "<input type='number' class='vk_hide price-field2 form-control col-md-4 ml-3' name='ecs["+data.ExtraServices_id+"]["+key+"]'/>"
            selectcleaning +='<div class="packing-block"><div class=""><label style=" float: left;display: inline-block;"><input class="model-packing-change" type="checkbox" name="fields['+data.ExtraServices_id+'][]" value="'+key+'"/>'+value+'</label></div>'+inp+'</div>';
        })
        $(".cleaning_options").html(selectcleaning);
        if(selectcleaning != ''){
            $(".extra-services-main-block").removeClass('vk_hide');
        } else {
            $(".extra-services-main-block").addClass('vk_hide');
        }
        /***ExtraServices Block****/

        if(data.Colorful_id != null){
           // $("#colorful").attr('name',"fields["+data.Colorful_id+"]");
        } else {
           // $("#colorful").attr('name',"");
        }
        if(data.Sugarcontent_id != null){
            //$("#sugar_content").attr('name',"fields["+data.Sugarcontent_id+"]");
        } else {
            //$("#sugar_content").attr('name',"");
        }
        if(data.Purpose_id != null){
           $(".model-purpose-id").attr('name',"fields["+data.Purpose_id+"][]");
        } else {
            $(".model-purpose-id").attr('name',"");
        }
        
        marketprocessing = '';
        $.each(data.MarketProcessing,function(k,v){
            marketprocessing += '<input type="button" class="market-btn btn btn-primary" data-id="'+k+'" value="'+v+'">';
        })
        $('.market-btn-block').html(marketprocessing);
        
        if( data.MarketProcessing != null && data.MarketProcessing != null ){
          
            $.each(data.PurposeMarket,function(k,v){
                PurposeMarket+='<div class="quality-block"><input type="radio" style="display:none;" class="purpose-group market" name="purposemarketing" data-marketname="'+v.title+'" id="market'+k+'" value="'+k+'"><p>'+v.title+'</p><label for="market'+k+'"><img class="q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></label></div>';
            })
            $.each(data.PurposeProcessing,function(k,v){
                PurposeProcessing+='<div class="quality-block"><input type="radio" class="purpose-group processing" name="purposeprocessing[]" data-purposename="'+v.title+'" id="Processing'+k+'" value="'+k+'"><p>'+v.title+'</p><label for="Processing'+k+'"><img class="q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"/></label></div>';
            })
            $(".PurposeMarket").html(PurposeMarket);
            $(".PurposeProcessing").html(PurposeProcessing);
        }
        
        if(data.Quality_id != null){
           $(".model-quality-id").attr('name',"fields["+data.Quality_id+"][]");
        } else { 
            $(".model-quality-id").attr('name',"");
        }
        selectpacking = '<table class="table" style="border-bottom:1px solid #c8ced3;"><thead><tr><th scope="col"> Packing options    </th><th scope="col">+extra <span class="price_curr_label">&euro;</span>per tonne</th><th scope="col">  total <span class="price_curr_label">&euro;</span>per Tonne</th></tr> </thead><tbody>';
        default_packing = '';
        $.each(data.Packing,function(k,v){
            default_packing +='<option value="'+k+'">'+v+'</option>'
            inp2 = '';
            if(data.spec_array_packing_subs[k] != undefined){
                inp2 += '<select class="form-control" style="width: auto;    margin-left: 10px;">'
                $.each(data.spec_array_packing_subs[k],function(key2,value3){
                    inp2 +='<option value="'+key2+'">'+value3+'</option>'
                })
                inp2 += '</select>';
            }
            inp = "<input type='number' class='vk_hide price-field2 price-field2-packing form-control col-md-4 ml-3' name='ecs["+data.Packing_id+"]["+k+"]'/> "
            selectpacking += ' <tr><td><div class="packing-block" style=""><div class=""><input type="checkbox" id="pack_'+k+'" name="fields['+data.Packing_id+'][]" class="model-packing-change" value="'+k+'"><label for="pack_'+k+'">'+v+'</label></div>'+inp2+'</div></td><td>'+inp+'</td><td><label class="total_price3 vk_hide"><span class="total_price3_field"></span> <span class="price_curr_label_td"></span></label></td></tr>';
        }) 
        selectpacking += '</tbody></table>';
        $(".productpaking").html(selectpacking);
        $('.step1-n-btn').trigger('click');
}
   
</script>
@endpush