<style>
@media (max-width: 991.98px){
  .selectproduct img {
    width: 280px !important;
  }
}
.previous.btn{ position:absolute;top: -10px; left: 6px; }
.next.btn{ position: absolute; top: -10px;right: 8px; }
 #create_stock2{  }
</style>
@role('seller')
@php $route_pre = 'seller'; @endphp
@else
@php $route_pre = 'admin'; @endphp
@endif
<div class="stockmodal modal fade" id="edit-stock-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header" style="padding:15px 10px;">
            <h4 style="text-align: center; width: 100%;" id="popup_title">SELECT PRODUCT </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:15px 10px; position:unset;">
           <form method="post" id="edit-msform" enctype="multipart/form-data">
            <!-- progressbar -->
            <div class="connecting-line"></div>
            <ul id="progressbar">
                <li data-step="1" class="active" data-id="edit-ss-step1"><span class="prog-heading">Product</span> <span class="steps-details edit-step1-detail"></span></li>
                <li data-step="2" class="active" data-id="edit-ss-step2"><span class="prog-heading">Variety</span> <span class="steps-details edit-step2-detail"></span></li>
                <li data-step="3" class="active" data-id="edit-ss-step25"><span class="prog-heading">Purpose</span> <span class="steps-details edit-step25-detail"></span></li>
                <li data-step="4" class="active" data-id="edit-ss-step3"><span class="prog-heading">Condition</span> <span class="steps-details edit-step3-detail"></span></li>
                <li data-step="5" class="active" data-id="edit-ss-step35"><span class="prog-heading">Quality</span> <span class="steps-details edit-step35-detail"></span></li>
                <li data-step="6" class="active nextsteps" data-id="edit-ss-step4"><span class="prog-heading">Last Step</span> <span class="steps-details edit-step4-detail"></span></li> 
            </ul>
			<fieldset class="selectproduct" id="edit-ss-step1" style="display: none;">
                <h2 class="fs-title">Select Product</h2>
                <div id="error_product"></div>
                @foreach ( $productsimage as $image )
                    <img src="{{asset('/images/products/'.$image->image)}}" width="100px" height="100px" data-name="{{$image->name}}" data-id="{{$image->id}}" class="edit-product p-images">
                @endforeach  
                <div class="nextback">
                    <button type="button" name="next" class="next btn btn-primary edit-step1-n-btn action-button" value="Next">Next <i class="fa fa-angle-right"></i></button>
                </div>
            </fieldset>

            <fieldset class="selectproduct" id="edit-ss-step2" style="display: none;">
                <h2 class="fs-title">Select Variety</h2>
                <div class="productvariety">
                     <select class="edit-model-variety-field model-row form-control">
                        <option value="">Choose Variety</option>
                     </select>
                </div>
                <div class="nextback">
                     <button type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                     <button type="button" name="next" class="next btn btn-primary action-button edit-step2-n-btn" value="Next">Next <i class="fa fa-angle-right"></i></button>
                </div>
            </fieldset>
            <fieldset class="selectproduct" id="edit-ss-step25" style="display: none;">
                <div class="market-btn-block">
                     
                </div>
                <div class="nextback" style="">
                     <button type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                   <button type="button" name="next" class="next btn btn-primary action-button edit-step25-n-btn" value="Next">Next <i class="fa fa-angle-right"></i></button>
                </div>
            </fieldset>
            <fieldset class="selectproduct" id="edit-ss-step3" style="display: none;">
                <h2 class="fs-title">Select Purpose</h2>
                <div class="qualityimage">
                    <div class="edit-PurposeMarket">
                    
                    </div>
                    <div class="edit-PurposeProcessing">
               
                    </div>
                </div>
                <div class="nextback">
                    <button type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                    <button type="button" style="" name="next" class="next btn btn-primary action-button edit-step3-n-btn" value="Next" >Next <i class="fa fa-angle-right"></i></button>
                </div>
            </fieldset>
            
            <fieldset class="selectproduct" id="edit-ss-step35" style="display: none;">
                <h2 class="fs-title"></h2>
                <div class="purposeimage"></div>
                <div class="model-row row mb-2 vk_hide purpose-quality-main-block">
                    <div class="col-md-12 purpose_qualityimage">
                     
                    </div>
                </div>
                <div class="nextback">
                     <button type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                    <button type="button" style="" name="next" class="next btn btn-primary action-button edit-step35-n-btn" value="Next" >Next <i class="fa fa-angle-right"></i></button>
                </div>
            </fieldset>

            <fieldset class="selectproduct" id="edit-ss-step4" >
             
            <div class="model-row vk_hide color-main-block row mb-2">
                <div class="col-md-2">
                    <label>Color</label>
                </div>
                <div class="col-md-10">
                    <select class="edit-model-color-field model-row form-control">
                        <option value="">Choose Color</option>
                    </select>
                </div>
            </div>
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label> Size (mm)</label>
                </div>
                <div class="col-md-10 rules-section-block productsize">
                    <div class="rule-inner-block row justify-content-center mb-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="size[0][from]"  placeholder="Size From" />
                        </div>
                        <div class="col-md-4"> 
                           <input type="text" class="form-control" name="size[0][to]"  placeholder="Size To"/>
                        </div>
                        <div class="col-md-4"> 
                           
                        </div>
                    </div> 
                </div>
            </div>
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                     <label>Defects </label>
                </div>
                <div class="col-md-10 edit-defect-block">
                    <select class="edit-model-defect-field model-row form-control select2" multiple>
                        <option value="">Choose Defects</option>
                    </select>
                </div>
            </div>
            
                <div class="model-row row mb-2">
                <div class="col-md-2">
                     <label class="align-fix" style="margin-bottom:0px;">Upload Images </label>
                       <span><b>(<span class='images-count'>0</span>/10)</b></span>
                </div>
                <div class="col-md-10 edit-uploaded_images">
                        <div class="image_btn">
                            <button type="button" class="btn btn-primary btn-sm" style="width: 130px; margin-top: 0px;">
                               Upload <i class="fa fa-upload"></i>
                            </button>
                            <input type="file"  name="stock_images[]" accept="image/x-png,image/gif,image/jpeg" multiple id="imgInp2" style="position: absolute;opacity: 0;width: 120px;height: 120px;left: 0;top: 0;" />
                        </div>
                    <div class="uploaded_images  row">
                    </div>
                </div>
            </div>
            <hr>
            <!--<h2 class="fs-title">Upload Images</h2>
            
            <div class="edit-uploaded_images justify-content-center row">
                <div class="image_btn">
                    <img src="{{asset('img/add_image.png')}}" style="height: 150px;width: 100%;"/>
                    <input type="file"  name="stock_images[]" multiple accept="image/x-png,image/gif,image/jpeg"  id="imgInp2" style="position: absolute;opacity: 0;width: 100%;height: 100%;left: 0;top: 0;" />
                </div>
                
            </div>-->
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label> Price: </label>
                </div>
                <div class="col-md-10">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <select name="price_currency" id="edit_price_currency" class="form-control pull-left" >
                                <option value="euro" data-val="&euro;" selected>Euro &euro;</option>
                                <option value="dollar" data-val="$">Dollar $</option>
                                <option value="pound" data-val="&pound;">Pound &pound;</option>
                            </select> / Ton
                        </div>
                        
                        <div class="col-md-2">
                            <input name="price" id="edit_price" type="text" class="price-field2 seller-price-field form-control" />
                            <div class="invalid-feedback"></div>
                        </div>
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
                        <select class="select2 form-control select2-hidden-accessible" name="country" id="edit_country" maxlength="191" placeholder="Select Tag" tabindex="-1" aria-hidden="true">
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
                        <input name="postalcode" id="edit_postalcode" type="text" class="form-control" />
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="model-row row mb-2">
                <div class="col-md-12 edit-productpaking">
                    
                </div>
            </div>
            
            <div class="model-row row mb-2 vk_hide colorful-main-block">
                <div class="col-md-2">
                    <label>  Colorful </label>
                </div>
                <div class="col-md-10">
                      <input id="edit-colorful" type="range"/ >
                      <input name="edit_colorful[from]" id="edit_colorful_from" type="hidden" />
                      <input name="edit_colorful[to]" id="edit_colorful_to" type="hidden" />
                </div>
            </div>
            
            <div class="model-row vk_hide sugar-main-block row mb-2">
                <div class="col-md-2">
                    <label> Sugar Content </label>
                </div>
                <div class="col-md-10">
                      <input id="edit_sugar_content" type="range" >
                      <input name="edit_sugar_content[from]" id="edit_sugar_content_from" type="hidden" />
                      <input name="edit_sugar_content[to]" id="edit_sugar_content_to" type="hidden" />
                </div>
            </div>
           
           
            <div class="model-row row mb-2 total-price-block vk_hide">
                <div class="col-md-2">
                    <label>  Total Price: </label>
                </div>
                <div class="col-md-10 total_price2">
                   
                </div>
            </div>
            
            
           
            <div class="nextback">
                
                <button type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous"><i class="fa fa-angle-left"></i> Previous</button>
                <input type="hidden" class="edit-model-product-id" name="product_id"/>
                <input type="hidden" class="edit-model-purpose-id" name=""/>
                <input type="hidden" class="edit-model-quality-id" name=""/>
                <input type="hidden" class="stock-id" value="" id="stock-id" name="stock-id"/>
                <input type="hidden" id="edit-model-mp" name="edit-model-mp"/>
                <input type="hidden" id="edit-model-mp-id" name="edit-model-mp-id"/>
                <input type="hidden" id="edit-model-mp-child" name="edit-model-mp-child"/>
                <input name="stock_status" value="available" type="hidden"/>
                
                
                <input type="button" id="update-stock" class="btn btn-primary" value="Submit" style="width:150px; margin-top:0px;"/>
            </div>
            </fieldset>
			
			
			</form>
        </div>
        </div>
    </div>
</div>
@php 
    $productConfiguration = get_product_configuration();
    $qualityGlobalArray = get_quality_global_array();
@endphp

@push('after-scripts')
<script src="{{asset('/js/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
@role('seller')
@php $route_pre = 'seller';
 
 @endphp
@else
@php $route_pre = 'admin';
 
 @endphp
@endif
var update_stock_url = '{{route($route_pre.'.stockv2.index')}}';
var productConfiguration = @json($productConfiguration);
var qualityGlobalArray = @json($qualityGlobalArray);
var model2_pid, model2_purposeid, model2_qualityid;
var increment = 1;
var sizehtml = ' ';

let editPrice = 0;
let eindex = 0;
let productDetail2;
var formData = new FormData();

function readURL2(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
		$img = $('<img/>').attr('src', e.target.result);
		x = $("<div class='img-box'></div>");
		x.append("<i class='delete-image' data-index='"+eindex+"'>X</i>");
		x.append($img);
		$('.edit-uploaded_images').append(x);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}


$(document).on("click",".delete-image",function(){
	index = $(this).data('index');
	$(this).parents('.img-box').remove();
	formData.delete('image['+index+']');
});
//formData.delete('image[1]');

$("#imgInp2").change(function() {
	eindex++;
	var totalfiles = document.getElementById('imgInp2').files.length;
	for (var index = 0; index < totalfiles; index++) {
		formData.append("image["+eindex+"]", document.getElementById('imgInp2').files[index]);
		
	}
	
  readURL2(this);
});

var saveResult2 = function (data) {
    $("#colorful_from").val(data.from_pretty);
    $("#colorful_to").val(data.to_pretty);
};

$("#colorful").ionRangeSlider({
    type: "double",min: 0,max: 100, from: 30, to: 45, grid: true, onChange: saveResult2
});


var saveResult = function (data) {
    $("#sugar_content_from").val(data.from_pretty);
    $("#sugar_content_to").val(data.to_pretty);
};

$("#sugar_content").ionRangeSlider({
    type: "double", min: 0,max: 100, from: 10, to: 20, grid: true, onChange: saveResult
});

$(document).on("click",".del-size-btnRemove",function(){
    $(this).parents('.rule-inner-block').remove();
});


$("body").on("click",".p-images",function(){
   $('.p-images').removeClass('active');
   $(this).addClass('active');
   model2_pid = $(this).data('id');
   $(".model-product-id").val($(this).data('id'));   
});

$("body").on("click",".edit-q-images",function(){
   
    model2_purposeid = $(this).data('id');
    
    model2_purposeid = $(this).data('id');
    quality_purpose = '';
    console.log(productSpecData[model2_pid]['PurposeChilds'][model2_purposeid]);
    if(productSpecData[model2_pid]['PurposeChilds'][model2_purposeid] != undefined){
        $.each(productSpecData[model2_pid]['PurposeChilds'][model2_purposeid],function(k,v){
            quality_purpose +='<div class="p-quality-block"><p>'+v.title+'</p><img style="width:200px;height:200px;"class="edit-p-q-images2" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'" data-purposename="'+v.title+'"></div>';
        });
        $('.purposeimage').html(quality_purpose);
        $('.purpose_qualityimage').html('');
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
                        qulaity_selectionData1 +='<div style="display: inline-block;" class="p-quality-block"><p>'+v.title+'</p><img class="p-q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
                    } else if(v.class == 'Class2'){
                        qulaity_selectionData2 +='<div style="display: inline-block;"  class="p-quality-block"><p>'+v.title+'</p><img class="p-q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
                    }                    
                })
                qulaity_selectionData = "<div class='model-row'> <label class='model-row class-label'>Class1 </label>"+qulaity_selectionData1+"</div>";
                if(qulaity_selectionData2 != ''){
                    qulaity_selectionData += "<div class='model-row'> <label class='model-row class-label'>Class2 </label>"+qulaity_selectionData2+" </div>";
                }
                $('.purpose_qualityimage').html(qulaity_selectionData);
            } else {
                $('.purpose_qualityimage').html('');
            }
        } else {
            $('.purpose-quality-main-block').removeClass('vk_hide');
            qualityData = qualityGlobalArray[model2_pid];
            qulaity_selectionData = '';
            $.each(qualityData,function(k,v){
                qulaity_selectionData +='<div class="p-quality-block"><p>'+v.title+'</p><img class="p-q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
            })
            $('.purpose_qualityimage').html(qulaity_selectionData);
        }
    
    }
    
    
    if(productConfiguration[model2_pid] != undefined && productConfiguration[model2_pid]['Quality'] == 'Conditional'){
        if(qualityGlobalArray[model2_pid][model2_purposeid] != undefined){
            $('.purpose-quality-main-block').removeClass('vk_hide');
            qualityData = qualityGlobalArray[model2_pid][model2_purposeid];
            qulaity_selectionData = '';
            $.each(qualityData,function(k,v){
                qulaity_selectionData +='<div class="p-quality-block"><p>'+v.title+'</p><img class="p-q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
            })
            $('.purpose_qualityimage').html(qulaity_selectionData);
        } else {
            $('.purpose_qualityimage').html('');
        }
    } else {
        $('.purpose-quality-main-block').removeClass('vk_hide');
        qualityData = qualityGlobalArray[model2_pid];
        qulaity_selectionData = '';
        $.each(qualityData,function(k,v){
            qulaity_selectionData +='<div class="p-quality-block"><p>'+v.title+'</p><img class="p-q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
        })
        $('.purpose_qualityimage').html(qulaity_selectionData);
    }
    $('.q-images').removeClass('active');
    $(this).addClass('active');
    $(".edit-model-purpose-id").val($(this).data('id'));  
    $('.edit-step3-n-btn').trigger('click');
});




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

$("body").on("click",".p-q-images",function(){
    $('.edit-step3-n-btn').trigger('click');
    //model2_qualityid = $(this).data('id');
    //$('.p-q-images').removeClass('active');
    //$(this).addClass('active'); 
    //$(".edit-model-quality-id").val($(this).data('id'));
});

$(document).on('click','#update-stock',function(){
   
    formDataArr = $("#edit-msform").serializeArray();
    $.each(formDataArr,function(k,d){
        formData.append(d.name, d.value);
    });
    formData.append('_method', 'PUT');
	stock_id = $("#stock-id").val();
	$.ajax({
        url: update_stock_url+"/"+stock_id,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(){
            $('.loading').removeClass('loading_hide');
        },   
        success: function(data)
        {

            $('.loading').addClass('loading_hide');
            Swal.fire('Sent!','Stock is successfully Updated.', 'success');
            setTimeout(function(){
                window.location.reload();
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
                    // console.log(key);
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


$(".edit-product").click(function(){
    if($(this).hasClass('edit-mode')){
        $('.edit-step1-n-btn').trigger('click');
    } else {
        var productid = $(this).data('id');
        var name = $(this).data('name');

        stockSetup(productid);
    }

});

$(document).on('change','.edit-model-packing-change',function(){
   $(this).parents('tr').find('input[type="number"]').toggleClass('vk_hide'); 
});

$(document).on('keyup','.seller-price-field',function(){
    price1 = $(this).val();
    //alert(price1);
    var price = 0;
    $('.price-field2-packing').each(function(){
        price2 = $(this).val();
        price = Number(price1) + Number(price2);
        //alert("in"+price)
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
    /*
    $('li').click(function(){
        var id = $(this).data('id');
        if( id == "ss-step2" || id == "ss-step3" || id == "ss-step4" || id == "ss-step5"){
           if($('.model-product-id').val() == ''){
            Swal.fire('Error!',"Can't go to the next step without chooseing product", 'error');
                $("fieldset").hide();
                $("#ss-step1").show();
                $('#error_product').html('Choose Any one product').css({"color": "#f11212"});
           }else{
        
        $("fieldset").hide();
        $("#"+id).show();
        $(this).addClass('active');
        //$('li').removeClass('active');
        }
        }
    }) */
    
    $(document).on('change','#price_currency',function(){
        curr = $('option:selected', this).attr('data-val');
        $(".price_curr_label").html(curr);
        $(".price_curr_label_td").html(curr);
    });
    
    
});


 
$(document).on('click','.stock-edit-btn',function(){
    index = $(this).data('id');
    $("#stock-id").val(index);
    $.ajax({
        url: "{{ url('seller/get-stock') }}",
        method: 'GET',
        data: {stock_id:index},
        dataType: "json",
        success: function(currentStock)
        {
            $(".edit-model-color-field option[value="+currentStock['Color']+"]").prop('selected',true);
            $('input[name="size[0][from]"]').val(currentStock['Size_From']);
            $('input[name="size[0][to]"]').val(currentStock['Size_To']);
            $('input[name="price"]').val(currentStock['price']);
            $('select[name="price_currency"]').val(currentStock['price_currency']);
            pid = currentStock['product_id'];
            $('input[name="product_id"]').val(currentStock['product_id']);
            $('.edit-product.p-images[data-id="'+pid+'"]').addClass('active').addClass('edit-mode');
           
            stockSetup(pid,currentStock);
            
            $("#edit-stock-modal").modal("show");
        }
    });
});
            
            
function stockSetup(productid, currentStock){
   
    $(".colorful-main-block").addClass('vk_hide');
    $(".color-main-block").addClass('vk_hide');
    $(".sugar-main-block").addClass('vk_hide');
    $(".extra-services-main-block").addClass('vk_hide');

    var htmlvariety=' ';
    var qulaityimage = ' ';
    var htmlproductpackaing='';
    $.ajax({
        url: "{{ route($route_pre.'.trading.getproductforstock') }}",
        // url: "{{ url('seller/get-product-stock-ajax') }}",
        method: 'POST',
        data: {productid:productid},
        dataType: "json",
        success: function(data)
        {
            //console.log(data);
            $(".stock-product-name").val(name);
            $(".colorful-main-block").addClass('vk_hide');
            $(".color-main-block").addClass('vk_hide');
            $(".sugar-main-block").addClass('vk_hide');
            $(".extra-services-main-block").addClass('vk_hide');
            if (productConfiguration[productid] != undefined) {
                if (productConfiguration[productid]['Colorful'] != undefined) {
                    $(".colorful-main-block").removeClass('vk_hide');
                }

                if (productConfiguration[productid]['Color'] != undefined) {
                    $(".color-main-block").removeClass('vk_hide');
                }

                if (productConfiguration[productid]['Extra Services'] != undefined) {
                    $(".extra-services-main-block").removeClass('vk_hide');
                }

                if (productConfiguration[productid]['Sugar Content'] != undefined) {
                    $(".sugar-main-block").removeClass('vk_hide');
                }
            }
            var PurposeMarket = ' ';
            var PurposeProcessing = ' ';
            var htmlvariety = ' ';
            var qulaityimage = ' ';
            var htmlproductpackaing = '';
            productDetail = data;
            var selectvariety = '<option value="Others">Others</option>';
            var selectpacking = selectquality = selectdefects = selectcleaning = selectcolor = '';
            
            $.each(data.Defects,function(key,value){
            selectdefects +='<div class="image-block"><input type="checkbox" name="fields['+data.Defects_id+'][]" class="defect-group" id="edit-def'+key+'" value="'+key+'"><p>'+value.title+'</p><label for="edit-def'+key+'"><img class="" data-id="'+key+'" src="{{ asset('/images/productspec') }}/'+value.image+'"></label></div>'
            })
            $('.edit-defect-block').html(selectdefects);
            
            /***Variety Block****/
            $.each(data.Variety,function(key,value){
                selectvariety += '<option value="'+key+'">'+value+'</option>'
            });

            if(data.Variety_id != null){
                $(".edit-model-variety-field").html(selectvariety).attr('name',"fields["+data.Variety_id+"]").attr('data-id',data.Variety_id);
            } else {
                $(".edit-model-variety-field").html('').attr('name',"").attr('data-id',"");
            }
            $(".edit-model-variety-field").select2({
                tags: true
            });



            

            /***Variety Block****/
            
            /***Variety Block****/
           
            
            $(".edit-model-defect-field").select2({
                dropdownParent: $('#edit-stock-modal')
            });
            $(".edit-model-variety-field").select2({
                dropdownParent: $('#edit-stock-modal')
            });
            /***Variety Block****/

            /***Color Block****/
            $.each(data.Color, function(key, value) {
                //console.log(value);
                //console.log(key);
                selectcolor += '<option value="' + key + '">' + value + '</option>'
            });
            //console.log(data.Color_id);
            if (data.Color_id != null) {
                $(".edit-model-color-field").html(selectcolor);
                $(".edit-model-color-field").attr('name', "fields[" + data.Color_id + "]");
                $(".edit-model-color-field").attr('data-id', data.Color_id);
            } else {
                $(".edit-model-color-field").html('');
                $(".edit-model-color-field").attr('name', "");
                $(".edit-model-color-field").attr('data-id', "");
            }
            $(".model-color-field").select2({
                dropdownParent: $('#createModals')
            });
            /***Color Block****/
        marketprocessing = '';
        $.each(data.MarketProcessing,function(k,v){
            marketprocessing += '<input type="button" class="edit-market-btn btn btn-primary" data-id="'+k+'" value="'+v+'">';
        })
        $('.market-btn-block').html(marketprocessing);
            /***ExtraServices Block****/
            $.each(data.ExtraServices, function(key, value) {
                inp = '';
                inp = "<input type='number' class='vk_hide price-field2 form-control col-md-4 ml-3' name='ecs[" + data.ExtraServices_id + "][" + key + "]'/>"
                selectcleaning += '<div class="packing-block"><div class=""><label style=" float: left;display: inline-block;"><input class="edit-model-packing-change" type="checkbox" name="fields[' + data.ExtraServices_id + '][]" value="' + key + '"/>' + value + '</label></div>' + inp + '</div>';
            })
            $(".cleaning_options").html(selectcleaning);
            if (selectcleaning != '') {
                $(".extra-services-main-block").removeClass('vk_hide');
            } else {
                $(".extra-services-main-block").addClass('vk_hide');
            }
            /***ExtraServices Block****/

                
            if (data.Purpose_id != null) {
                $(".edit-model-purpose-id").attr('name', "fields[" + data.Purpose_id + "][]");
            } else {
                $(".edit-model-purpose-id").attr('name', "");
            }
            /*$.each(data.QualityImg,function(k,v){
                qulaityimage+='<div class="quality-block"><p>'+v.title+'</p><img class="edit-q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
            })
            $(".purpose_qualityimage").html(qulaityimage);*/
            
            if( data.MarketProcessing != null && data.MarketProcessing != null ){
                $.each(data.PurposeMarket,function(k,v){
                    PurposeMarket+='<div class="quality-block"><input type="radio" name="purposemarketing" class="purpose-group market" id="edit-market'+k+'" value="'+k+'"><p>'+v.title+'</p><label for="edit-market'+k+'"><img class="q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"/></label></div>';
                })
                $.each(data.PurposeProcessing,function(k,v){
                    PurposeProcessing+='<div class="quality-block"><input type="radio" name="purposeprocessing[]" class="purpose-group processing" id="edit-processing'+k+'" value="'+k+'"><p>'+v.title+'</p><label for="edit-processing'+k+'"><img class="q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"/></label></div>';
                })
                $(".edit-PurposeMarket").html(PurposeMarket);
                $(".edit-PurposeProcessing").html(PurposeProcessing);
            }
            if (data.Quality_id != null) {
                $(".edit-model-quality-id").attr('name', "fields[" + data.Quality_id + "][]");
            } else {
                $(".edit-model-quality-id").attr('name', "");
            }
            
            selectpacking = '<table class="table" style="border-bottom:1px solid #c8ced3;"><thead><tr><th scope="col"> Packing options    </th><th scope="col">+extra [<span class="price_curr_label">&euro;</span>]/ton</th><th scope="col">  total <span class="price_curr_label">&euro;</span> / ton</th></tr> </thead><tbody>';
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
                inp = "<input type='number' class='price-field2 price-field2-packing form-control col-md-4 ml-3' name='ecs["+data.Packing_id+"]["+k+"]'/> "
                selectpacking += '<tr><td><div class="packing-block" style=""><div class=""><input type="checkbox" id="edit_pack_'+k+'" name="fields['+data.Packing_id+'][]" class="edit-model-packing-change" value="'+k+'"><label for="edit_pack_'+k+'">'+v+'</label></div>'+inp2+'</div></td><td>'+inp+'</td><td><label class="total_price3"><span class="total_price3_field"></span> <span class="price_curr_label_td"></span></label></td></tr>';
            }) 
    
            $(".edit-productpaking").html(selectpacking);
        
            $('.edit-model-variety-field').val(currentStock['Variety']);
            $('.edit-model-variety-field').select2().trigger('change');
            if(currentStock['Purpose'] != undefined){
                currentStockPurposeId = currentStock['Purpose'][0];
            } else { currentStockPurposeId = 0; }
            setupQualityOrUW(currentStock['product_id'], currentStockPurposeId);
            model2_pid = currentStock['product_id'];
            if (currentStock['Defects'] != undefined) {
               
                vals = [];
               
                $.each(currentStock['Defects'], function(k2, v2) {
                    
                    vals.push(v2);
                    $("#edit-def"+v2).prop('checked',true);
                });
               
                $('.edit-model-defect-field').val(vals);
                $('.edit-model-defect-field').select2().trigger('change');
                
            }
            if (currentStock['Packing'] != undefined) {
                $.each(currentStock['Packing'], function(k2, v2) {
                    p = '';
                    if (currentStock['Packing_ecs'] != undefined) {
                        if (currentStock['Packing_ecs'][v2] != undefined) {
                            p = currentStock['Packing_ecs'][v2];
                        }
                    }
                    $("#edit_pack_"+v2).prop('checked',true);
                    $("#edit_pack_"+v2).parents('tr').find('.price-field2-packing').val(p).removeClass('vk_hide');
                });
            }
            if (currentStock['Purpose'] != undefined) {
                purpid = currentStock['Purpose'];
                console.log(purpid);
                $('.edit-q-images[data-id="'+purpid+'"]').addClass('active');
            }
            $('.edit-market-btn[data-id="'+currentStock.MarketProcessing+'"]').addClass('active');
            if (currentStock['Purpose'] != undefined) {
                $.each(currentStock['Purpose'], function(k2, v2) {
                    $('.purpose-group[value="'+v2+'"]').attr('checked',true);
                });
            }
            if (currentStock['Quality'] != undefined) {
                Qualityid = currentStock['Quality'];
                $('.p-q-images[data-id="'+Qualityid+'"]').addClass('active');
                $('.edit-step35-detail').html($('.p-q-images[data-id="'+Qualityid+'"]').attr('data-quality'));
            }
            if (currentStock['Soil'] != undefined) {
                SoilId = currentStock['Soil'];
                $('.p-q-images2[data-id="'+SoilId+'"]').addClass('active');
                $('.edit-model-mp-child').val(currentStock['Soil']);
                $('.edit-step35-detail').html($('.p-q-images2[data-id="'+SoilId+'"]').attr('data-purposename'));
                
            }
            if(currentStock['Variety'] != undefined){
                if(productDetail['Variety'][currentStock['Variety']] != undefined){
                    $('.edit-step2-detail').html(productDetail['Variety'][currentStock['Variety']]);
                }
            }
            if(currentStock['MarketProcessing'] != undefined){
                if(productDetail['MarketProcessing'] != undefined && (productDetail['MarketProcessing'][currentStock['MarketProcessing']] == 'Market' || productDetail['MarketProcessing'][currentStock['MarketProcessing']] == 'Packing'))
                {
                    $('.edit-PurposeMarket').show();
                    $('.edit-PurposeProcessing').hide();
                }
                else if(productDetail['MarketProcessing'] != undefined && (productDetail['MarketProcessing'][currentStock['MarketProcessing']] == 'Processing' ))
                {
                    $('.edit-PurposeProcessing').show();
                    $('.edit-PurposeMarket').hide();
                }
                
                
                if(productDetail['MarketProcessing'][currentStock['MarketProcessing']] != undefined){
                    $('.edit-step25-detail').html(productDetail['MarketProcessing'][currentStock['MarketProcessing']]);
                }
                $('#edit-model-mp-id').val(currentStock['MarketProcessing']);
                $('#edit-model-mp').val(productDetail['MarketProcessing'][currentStock['MarketProcessing']]);
            }
            
            if(currentStock['Purpose'] != undefined){
                if(productDetail['Purpose'][currentStock['Purpose']] != undefined){
                    $('.edit-step3-detail').html(productDetail['Purpose'][currentStock['Purpose']]);
                }
                $('.edit-model-purpose-id').val(currentStock['Purpose']);
            }        
            console.log(currentStock['image']);
            $(".edit-uploaded_images .img-box").remove();
            if(currentStock['image'] != undefined){
                let images = '';
                $.each(currentStock['image'],function(k,v){
                    images+=' <div class="img-box"><i class="delete-image" data-index="1">X</i><img src="{{ asset('/images/stock') }}/'+v+'"></div>';
                    total_images++;
                });
               
                $(".images-count").text(total_images);
                $(".edit-uploaded_images").append(images);
            }
            
            var productName = $('.p-images.active').data('name');
            $('.edit-step1-detail').html(productName);
            $('#edit_postalcode').val(currentStock['postalcode']);
            $('#edit_country').val(currentStock['country']);
            $('#edit_country').select2().trigger('change');
            
            //$('.step1-n-btn').trigger('click');
     }
            
});
}
 $(document).on('click','.edit-market-btn',function(){  
    marketBtns($(this),'edit-');
})

$(document).on('click', '.edit-step25-n-btn', function() {
    mode = 'edit-';
    purposeValue = $('.edit-market-btn.active').val();
    if(purposeValue == 'Market' || purposeValue == 'Packing')
    {
        $('.'+mode+'PurposeMarket').show();
        $('.'+mode+'PurposeProcessing').hide();
    }
    else if(purposeValue == 'Processing')
    {
        $('.'+mode+'PurposeProcessing').show();
        $('.'+mode+'PurposeMarket').hide();
    }
    
    $('.edit-step3-detail').html('');
    $('.edit-step35-detail').html('');
  
})

$(document).on('click', '.edit-step3-n-btn', function() {
    purposeAction($(this),'edit-');
})

$("body").on("click",".edit-p-q-images2",function(){
    $('.edit-p-q-images2').removeClass('active');
    $(this).addClass('active');
    qulaityHtml = $(this).parent().find('p').text();
    $('.edit-step35-detail').html(qulaityHtml);
})
    
function purposeAction(ths,mode){
    if($('.'+mode+'market-btn.active').val() == 'Processing'){
        $("fieldset").hide();
        $('#'+mode+'ss-step4').show();
        $('#'+mode+'ss-step4').removeProp("opacity");
        $('#'+mode+'ss-step4').removeAttr("style");
    }
}
function marketBtns(ths,mode){
    var purposeValue = ths.val();
    $('.'+mode+'market-btn').removeClass('active');
    ths.addClass('active');
    $('#'+mode+'model-mp').val(purposeValue);
    $('#'+mode+'model-mp-id').val(ths.attr('data-id'));
    if(purposeValue == 'Market' || purposeValue == 'Packing')
    {
        $('.'+mode+'PurposeMarket').show();
        $('.'+mode+'PurposeProcessing').hide();
    }
    else if(purposeValue == 'Processing')
    {
        $('.'+mode+'PurposeProcessing').show();
        $('.'+mode+'PurposeMarket').hide();
    }
    $('.'+mode+'step25-n-btn').trigger('click');
}
$("body").on("click",".q-images",function(){
    $('.edit-step3-n-btn').trigger('click');
})
$("body").on("click",".p-q-images2",function(){
    $('.edit-step35-n-btn').trigger('click');
})


$("body").on("click",".edit-model-variety-field",function(){
   //$('.edit-step2-n-btn').trigger('click');
})
</script>
@endpush