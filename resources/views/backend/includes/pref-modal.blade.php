@if(auth()->user()->hasRole('administrator') && Request::segment(1) == 'admin')
    @php $route_pre = 'admin'; @endphp
@else
    @php $route_pre = 'buyer'; @endphp
@endif
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

.previous.btn{ position:absolute;top: -10px; left: 6px; }
.next.btn, #create_stock2{ position: absolute; top: -10px;right: 8px; }

</style>
<div class="stockmodal modal fade" id="createBuyerModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:15px 10px;">
            <h4 style="text-align: center; width: 100%;" id="popup_title">SELECT PRODUCT </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:15px 10px;position:unset;">
           <form id="msform2">
            <!-- progressbar -->
            <div class="connecting-line"></div>
            <ul id="progressbar">
                <li data-step="1" class="active firstclass" data-id="ss-step1"><span class="prog-heading classstep">Product</span> <span class="steps-details step1-detail"></li>
                <li data-step="2" class="" data-id="ss-step15"><span class="prog-heading classstep">Variety</span> <span class="steps-details step2-detail"></li>
                <li data-step="3" class="" data-id="ss-step2"><span class="prog-heading classstep">Purpose</span> <span class="steps-details step25-detail"></span></li>
                <li data-step="4" class="" data-id="ss-step3"><span class="prog-heading classstep">Condition</span> <span class="steps-details step3-detail"></span></li>
                <li data-step="5" class="" style="display:none;" data-id="ss-step35" id="ss-step35-block"><span class="prog-heading classstep">Quality</span> <span class="steps-details step35-detail"></span></li>
                <li data-step="6" class="" data-id="ss-step4"><span class="prog-heading classstep">Last Step</span> <span class="steps-details step4-detail"></span></li>
            </ul>

            <fieldset class="selectproduct" id="ss-step1" >
                
                @if(auth()->user()->hasRole('administrator'))
                    <div class="model-row row mb-2" style="padding-top: 10px">
                        <div class="col-md-2">
                            <label class="align-fix">Select Buyer</label>
                        </div>
                        <div class="col-md-10">
                        <select id="buyer_id" name="buyer_id" class="model-row form-control">
                            <option value="">Choose Buyer</option>
                        </select>
                        </div>
                    </div>
                @endif
                <h2 class="fs-title">Select Product</h2>
                <div id="error_product"></div>
                @foreach ( $productsimage as $product )
                    <img src="{{asset('/images/products/'.@$product->image)}}" width="100px" height="100px" data-name="{{@$product->name}}" data-id="{{@$product->id}}" class="product p-images">
                @endforeach

                <div class="nextback" style="opacity:0;">     
                    <input type="button" name="next" class="next btn btn-primary step1-n-btn action-button" value="Next" />
                </div>
            </fieldset>

            

            <fieldset class="selectproduct" id="ss-step15" style="display: none;">
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-primary action-button" value="Previous" />
                    <input type="button" name="next" disabled class="next btn btn-secondary action-button step2-n-btn" value="Next" />
                </div>

                <h2 class="fs-title">Select Variety</h2>
                <div class="productvariety">
                     <select class="model-variety-field model-row form-control">
                        <option value="">Choose Variety</option>
                     </select>
                </div>
            </fieldset>
            

         

            <fieldset class="selectproduct" id="ss-step2" style="display: none;">

                <div class="nextback"> 
					<input type="button" name="previous" class="previous btn btn-primary action-button" value="Previous" />				
                    <input type="button" name="next" disabled class="next btn btn-secondary step25-n-btn action-button" value="Next" />
                </div>
                <h2 class="fs-title">Select Market</h2>
                 <div class="market-btn-block">
                     
                </div>   
            </fieldset>
            
             <fieldset class="selectproduct" id="ss-step3" style="display: none;">
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-primary action-button" value="Previous" />
                    <input type="button" style="" name="next" disabled class="next btn btn-secondary action-button step3-n-btn" value="Next" />
                </div>
                <h2 class="fs-title">Select Purpose</h2>
                <div class="qualityimage">
                    <div class="PurposeMarket">
                    </div>
                    <div class="PurposeProcessing">
                    </div>
                </div>
            </fieldset>

             <fieldset class="selectproduct" id="ss-step35" style="display: none;">
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-primary action-button" value="Previous" />
                    <input type="button" style="" name="next" disabled class="next btn btn-secondary action-button step35-n-btn" value="Next" />
                </div>
                <h2 class="fs-title"></h2>
                <div class="purposeimage"></div>
                <div class="model-row row mb-2 vk_hide purpose-quality-main-block">
                    <div class="col-md-12 purpose_qualityimage">
                    </div>
                </div>
            </fieldset>
            <fieldset class="selectproduct" id="ss-step4" style="display: none;">

            <div class="nextback">
                <input type="button" name="previous" class="step4-p-btn previous btn btn-primary action-button" value="Previous"/>
                <input type="hidden" class="model-product-id" name="product_id"/>
                <input type="hidden" class="model-pref-id" id="prefid" name="pref_id"/>
                <input type="hidden" class="model-buyer-purpose-id" name=""/>
                <input type="hidden" class="model-purpose-id" name=""/>
                <input type="hidden" class="model-quality-id" name=""/>
                
                <input type="hidden" id="model-mp" name="model-mp"/>
                <input type="hidden" id="model-mp-id" name="model-mp-id"/>
                <input type="hidden" id="model-mp-child" name="model-mp-child"/>
                <input type="button" id="create-pref" class="btn btn-primary" value="Submit" />
            </div>

            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                     <label class="align-fix">Defects </label>
                </div>
                <div class="col-md-10 defect-block">
                   
                </div>
            </div>

            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label class="align-fix"> Size </label>
                </div>
                <div class="col-md-10 rules-section-block productsize">
                    <div class="rule-inner-block row justify-content-center mb-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="size[0][from]"  placeholder="Size From" >
                        </div>
                        <div class="col-md-1">
                            -
                        </div>
                        <div class="col-md-4"> 
                           <input type="text" class="form-control" name="size[0][to]"  placeholder="Size To">
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div> 
                </div>
            </div>
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label class="align-fix"> Country </label>
                </div>
                <div class="col-md-10 rules-section-block productsize">
                    <div class="rule-inner-block row justify-content-center mb-2">
                        <div class="col-md-4">
                           <select class="select2 form-control select2-hidden-accessible" name="country" id "country" maxlength="191" placeholder="Select Tag" tabindex="-1" aria-hidden="true">
                                   @php 
                                   echo $countries = get_country_short_code_dropdown();
                                    @endphp   
                            </select> 
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-3"></div>
                    </div> 
                </div>
            </div>
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label class="align-fix"> Postal Code </label>
                </div>
                <div class="col-md-10 rules-section-block productsize">
                    <div class="rule-inner-block row justify-content-center mb-2">
                        <div class="col-md-4">
                             <input name="postalcode" id ="postalcode" type="text" class="form-control" />
                         <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-3"></div>
                    </div> 
                </div>
            </div>
            
            
            <div class="model-row row mb-2">
                <div class="col-md-2">
                    <label class="align-fix"> Packing </label>
                </div>
                <div class="col-md-10 productpaking">
                    
                </div>
            </div>
            
            <div class="model-row row mb-2 vk_hide colorful-main-block">
                <div class="col-md-2">
                    <label class="align-fix">  Colorful </label>
                </div>
                <div class="col-md-10">
                      <input id="colorful" type="range"/ >
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
            
            <div class="model-row row mb-2 extra-services-main-block vk_hide">
                 <div class="col-md-2">
                 <label class="align-fix">Extra Services</label>
                 </div>
                <div class="col-md-8 model-row cleaning_options">
                </div>
            </div>
            
            <div class="model-row row mb-2 total-price-block vk_hide">
                <div class="col-md-2">
                    <label class="align-fix">  Total Price: </label>
                </div>
                <div class="col-md-10 total_price2">
                   
                </div>
            </div>

            


            </fieldset>
            </form>
        </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script src="{{asset('/js/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>

var update_buyerpref_url = '{{route($route_pre.'.buyerpref.updateajax')}}';
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    @php   $productConfiguration  =   get_product_configuration();
           $qualityGlobalArray    =   get_quality_global_array();
           //$productBasicDetail    =  @json($productBasicDetail);
@endphp

var productConfiguration = @json($productConfiguration);
var qualityGlobalArray = @json($qualityGlobalArray);
var model2_pid, model2_purposeid, model2_qualityid;
var increment = 1;
var sizehtml = ' ';
let defects2 = [];
let price2 = 0;
let productDetail;
let productSpecData;
let currentProductId;

function getBuyerConfig()
{
    var htmlvariety=' ';
    var qulaityimage = ' ';
    var htmlproductpackaing='';
   
    $.ajax({
    url: "{{ url('buyer/get-product-stock-ajax') }}",
    method: 'POST',
    dataType: "json",
    success: function(data)
    {
        //console.log(data);
        productSpecData = data;
        firstData = productSpecData[1];
        
        currentProductId = 1;
        /*
            selectvariety = '';
            $.each(firstData.Variety,function(key,value){
                selectvariety += '<option value="'+key+'">'+value+'</option>'
            });
            */
        if(firstData.Variety_id != null){
            $(".model-variety-field").html('');
            $(".model-variety-field").attr('name',"fields["+firstData.Variety_id+"]");
            $(".model-variety-field").attr('data-id',firstData.Variety_id);
        } else {
            //$(".model-variety-field").html('');
            $(".model-variety-field").attr('name',"");
            $(".model-variety-field").attr('data-id',"");
        }
        
         $("#buyer_id").select2({
                ajax: {
                    url: '{{route($route_pre.'.buyers.search')}}',
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
                          product_id: currentProductId,
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
    }
});
}

setTimeout(function(){
   getBuyerConfig();
},500);

var saveResult2 = function (data) {
    $("#colorful_from").val(data.from_pretty);
    $("#colorful_to").val(data.to_pretty);
};

$("#colorful").ionRangeSlider({
    type: "double",
    min: 0,
    max: 100,
    from: 30,
    to: 45,
    grid: true,
    onChange: saveResult2
});


var saveResult = function (data) {
    $("#sugar_content_from").val(data.from_pretty);
    $("#sugar_content_to").val(data.to_pretty);
};

$("#sugar_content").ionRangeSlider({
    type: "double",
    min: 0,
    max: 100,
    from: 10,
    to: 20,
    grid: true,
    onChange: saveResult
});

$(document).on("click",".del-size-btnRemove",function(){
    $(this).parents('.rule-inner-block').remove();
});
$("#addsize").click(function(){
    sizehtml ='<div class="rule-inner-block row justify-content-center mb-2"><div class="col-md-4">'+'<input type="text" class="form-control" name="size['+increment+'][from]"  placeholder="Size From"></div><div class="col-md-4"><input type="text" class="form-control" name="size['+increment+'][to]"  placeholder="Size To"></div><div class="col-md-4"><button type="button" class="del-size-btnRemove btn btn-danger btn-md" style=""><i class="fas fa-trash-alt"></i></button></div></div>';
    $('.productsize').append(sizehtml);
    increment++;
})
/***Step1****/
$("body").on("click",".p-images",function(){
    
    if($(this).hasClass('active')){
        $('.step1-n-btn').trigger('click');
        return false;
    }
    
   $("#progressbar li:first-child").removeClass('firstclass');
   $('.p-images').removeClass('active');
   $(this).addClass('active');
   model2_pid = $(this).data('id');
   model2_pid_name = $(this).data('name');
   prefPopup.changeTitle(2);
   
   
    var productid = $(this).data('id');
    var productName = $(this).data('name');
   
    if(productName)
    {
       $('.step1-detail').html(productName);
    }
    if(productSpecData[productid] != undefined)
    {
        if($(this).hasClass('edit-mode')){
            $('.step1-n-btn').trigger('click');
        } else {
            data = productSpecData[productid];
            $('.step1-n-btn').trigger('click').promise().done(function() {
                setupProduct(data,productid);
            });
        }
        
      
       
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

        var htmlvariety=' ';
        var qulaityimage = ' ';
        var htmlproductpackaing='';
        $.ajax({
            url: "{{ url('buyer/get-product-stock-ajax') }}",
            method: 'POST',
            data: {productid:productid},
            dataType: "json",
            success: function(data)
            {
                setupProduct(data,productid);
                $('.step1-n-btn').trigger('click');    

            }
        });

    }
    currentProductId = productid;
    $(".model-product-id").val($(this).data('id'));   
    
  /*
   if(productBasicDetail[model2_pid_name] != undefined){
            qualityData2 = productBasicDetail[model2_pid_name]['values'];
           
            qulaity_selectionData2 = '';
            $.each(qualityData2,function(k,v){
                qulaity_selectionData2 +='<div class="p-quality-block"><p>'+v.name+'</p><img class="purpose-images" data-id="'+k+'" src="{{ asset('/images/product_type_images') }}/'+v.image+'"></div>';
            })
            $('.purposeimage').html(qulaity_selectionData2);
        } else {
            $('.purposeimage').html('');
        }
      */  
   
   
});





/***Step1****/

$("body").on("click",".purpose-images",function(){
    model2_qualityid = $(this).data('id');
    $('.purpose-images').removeClass('active');
    $(this).addClass('active'); 
    $(".model-buyer-purpose-id").val($(this).data('id'));
	$('.step15-n-btn').trigger('click');  
});

/***Step5****/
$("body").on("click",".p-q-images2",function(){
    $('.p-q-images2').removeClass('active');
    $(this).addClass('active');
    if($(this).parents('form').attr('id') == 'edit-msform2'){
        dataId = $(this).data('id');
        $('#model-mp-child').val(dataId);
    } else {
        dataId = $(this).data('id');
        $('#model-mp-child').val(dataId);
    }
    prefPopup.changeTitle(6);
});

$("body").on("click",".p-q-images",function(){
    qulaityHtml1 = $(this).parent().find('p').text();
    $('.step35-detail').html(qulaityHtml1);
    $('.step35-n-btn').trigger('click');
    model2_qualityid = $(this).data('id');
    $('.p-q-images').removeClass('active');
    $(this).addClass('active'); 
    $(".model-quality-id").val($(this).data('id'));
    
    $('.step35-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
    prefPopup.changeTitle(6);
});
/***Step5****/

/***Step4****/
$("body").on("click",".q-images",function(){
    model2_purposeid = $(this).data('id');
    $('.step3-n-btn').trigger('click');  
    setupQualityOrUW(model2_pid, model2_purposeid);
    $('.q-images').removeClass('active');
    $(this).addClass('active');
    if($(this).parents('form').attr('id') == 'edit-msform'){
        $(".edit-model-purpose-id").val($(this).data('id'));
    } else {
        $(".model-purpose-id").val($(this).data('id'));
    }
    
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
    $('.step3-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
   // $('.step3-n-btn').trigger('click');   
});
/***Step4****/

function setupQualityOrUW(model2_pid, model2_purposeid){
    quality_purpose = '';
    if(productSpecData[model2_pid]['PurposeChilds'][model2_purposeid] != undefined){
      
        $.each(productSpecData[model2_pid]['PurposeChilds'][model2_purposeid],function(k,v){
            quality_purpose +='<div class="p-quality-block"><p>'+v.title+'</p><img style="width:200px;height:200px;"class="p-q-images2" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'" data-purposename="'+v.title+'"></div>';
        });
        $('.purposeimage').html(quality_purpose);
        $('.purpose_qualityimage').html('');
        $('#ss-step35-block .classstep').html('SOIL');
        prefPopup.changeTitle(5.1);
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
                $('#ss-step35-block .classstep').html('QUALITY');
                prefPopup.changeTitle(5.2);
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
            $('#ss-step35-block .classstep').html('QUALITY');
            prefPopup.changeTitle(5.2);
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
    $('.total_price2').text("€"+price);
});



$(document).on('click','#create-pref',function(){
    var formData = new FormData();
    formDataArr = $("#msform2").serializeArray();
    $.each(formDataArr,function(k,d){
        formData.append(d.name, d.value);
    });
    
    if($(this).hasClass('edit-mode')){
        
        save_buyerpref_url = update_buyerpref_url;
        $.ajax({
        url: save_buyerpref_url,
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
            Swal.fire('Sent!', data.message, 'success');
            setTimeout(function(){
                window.location.reload();
            }, 3000);
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
                    console.log(key);
                    $("#createModals").find("#"+key).parent().addClass('has-danger');
                    $("#createModals").find("#"+key).addClass('is-invalid');
                    $("#createModals").find('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
                })
            }
        }
    });
    }else{
   
     $.ajax({
        url: save_buyerpref_url,
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
            Swal.fire('Sent!', data.message, 'success');
            setTimeout(function(){
                var url=window.location.href;
                if (url.indexOf('dashboard') > -1) {
                    window.location.href = "{{ route('buyer.buyerpref.cardview') }}";
                } else {
                    window.location.reload();
                }
            }, 3000);
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
                    console.log(key);
                    $("#createModals").find("#"+key).parent().addClass('has-danger');
                    $("#createModals").find("#"+key).addClass('is-invalid');
                    $("#createModals").find('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
                })
            }
        }
    });
    }
    return false;
});


window.prefPopup = {
    changeTitle : function(step){
        switch(step) {
            case 1:
                $("#popup_title").html('SELECT PRODUCT');
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


$(document).on('change','.model-packing-change',function(){
   //$(this).parents('div.packing-block').find('input[type="number"]').toggleClass('vk_hide'); 
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
    
    let indexN = $("fieldset").index(next_fs) + 1;
    if(indexN == 5){
        if($('.step3-detail').text() == 'Unwashed/Washable'){
            indexN = 5.2;
        } else {
            indexN = 5.1;
        }
    }
    prefPopup.changeTitle(indexN);
    //activate next step on progressbar using the index of next_fs
    if($('.market-btn.active').val() == 'Processing' && $("fieldset").index(next_fs) == 3){
        $("#createBuyerModal #progressbar li").eq($("fieldset").index(current_fs)).removeClass("nextsteps");
        $("#createBuyerModal #progressbar li").removeClass('nextsteps2');
        $("#createBuyerModal #progressbar li").eq($("fieldset").index(next_fs)  + 1).addClass("active nextsteps");
    } else if($('.market-btn.active').val() == 'Processing' && $("fieldset").index(next_fs) == 4){
        $("#createBuyerModal #progressbar li").eq($("fieldset").index(current_fs)).removeClass("nextsteps");
        $("#createBuyerModal #progressbar li").removeClass('nextsteps2');
        $("#createBuyerModal #progressbar li").eq($("fieldset").index(next_fs)  + 1).addClass("active nextsteps");
    } else {
        step = $("#createBuyerModal #progressbar .nextsteps").attr('data-step');
        $("#createBuyerModal #progressbar li").removeClass('nextsteps2');
        if(step == "6"){
            $("#createBuyerModal #progressbar li").eq($("fieldset").index(next_fs)).addClass("nextsteps2");
        } else {
            $("#createBuyerModal #progressbar li").removeClass('nextsteps');
            $("#createBuyerModal #progressbar li").eq($("fieldset").index(next_fs)).addClass("active nextsteps");
        }
    }
    
    
        next_fs.show();
        current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
        scale = 1 - (1 - now) * 0.2;
        left = (now * 50)+"%";
        opacity = 1 - now;
        current_fs.css({'transform': 'scale('+scale+')'});
        next_fs.css({'left': left, 'opacity': opacity});
        },
        duration: 800,
        complete: function(){
        current_fs.hide();
        animating = false;
        },
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
    });
    });

    $(".previous").click(function(){
    if(animating) return false;
    animating = true;

    current_fs = $(this).parents('fieldset');
    previous_fs = $(this).parents('fieldset').prev();

    //de-activate current step on progressbar
    
    prefPopup.changeTitle($("fieldset").index(current_fs));
    if($('.market-btn.active').val() == 'Processing' && $("fieldset").index(previous_fs) == 4){
        $("#createBuyerModal #progressbar li").removeClass('nextsteps2');
        $("#createBuyerModal #progressbar li").eq($("fieldset").index(previous_fs) - 1).addClass("nextsteps2");
    } else {
        $("#createBuyerModal #progressbar li").removeClass('nextsteps2');
        $("#createBuyerModal #progressbar li").eq($("fieldset").index(previous_fs)).addClass("nextsteps2");
    }
    
        previous_fs.show();
        current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
        scale = 0.8 + (1 - now) * 0.2;
        left = ((1-now) * 50)+"%";

        opacity = 1 - now;
        //current_fs.css({'left': left});
       // previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
        },
        duration: 800,
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
        
        prefPopup.changeTitle(step);
    })
});
$(document).on('click','.step2-n-btn',function(){  
    let varityClickHtml = $(".model-variety-field option:selected").text();
    $('.step2-detail').html(varityClickHtml);
})

$(document).on('change','.model-variety-field',function(){
    $('.step2-detail').html($(".model-variety-field option:selected").text());
    $('.step2-n-btn').trigger('click');
    $('.step2-n-btn').removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
    prefPopup.changeTitle(3);
})

function setupProduct(data,product_id)
{
        var PurposeMarket = ' ';
        var PurposeProcessing = ' ';
        var selectvariety = '<option value="Others">Others</option>';
        var selectpacking = '';
        var qulaityimage = '';
        var selectquality = ''; 
        var selectdefects = '';
        var selectcleaning = '';
        var selectcolor = '';
        productDetail = data;
       
        if(currentProductId != product_id){
             /***Variety Block****/
            $.each(data.Variety,function(key,value){
                selectvariety += '<option value="'+key+'">'+value+'</option>'
            });

            if(data.Variety_id != null){
                //$(".model-variety-field").html(selectvariety);
                $(".model-variety-field").attr('name',"fields["+data.Variety_id+"]");
                $(".model-variety-field").attr('data-id',data.Variety_id);
            } else {
               // $(".model-variety-field").html('');
                $(".model-variety-field").attr('name',"");
                $(".model-variety-field").attr('data-id',"");
            }
            $("#buyer_id").select2('destroy');
            $("#buyer_id").select2({
                ajax: {
                    url: '{{route($route_pre.'.buyers.search')}}',
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
            
            $(".model-variety-field").select2('destroy');
            $(".model-variety-field").select2({
                ajax: {
                        url: '{{route($route_pre.'.product.getVarity')}}',
                        dataType: 'json',
                        data: function (params) {
                            return {
                              product_id: product_id,
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
            /***Variety Block****/
            
           
            
        }
       
        
        $.each(data.Defects,function(key,value){
            selectdefects +='<div class="image-block"><input type="checkbox" name="fields['+data.Defects_id+'][]" class="defect-group" id="def'+key+'" value="'+key+'"><p>'+value.title+'</p><label for="def'+key+'"><img class="" data-id="'+key+'" src="{{ asset('/images/productspec') }}/'+value.image+'"></label></div>'
        })
        $('.defect-block').html(selectdefects);
        
       

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
        $(".model-color-field").select2();
        /***Color Block****/

        

        
        if(data.Purpose_id != null){
           $(".model-purpose-id").attr('name',"fields["+data.Purpose_id+"][]");
        } else {
            $(".model-purpose-id").attr('name',"");
        }
        
        /*=====*/
        marketprocessing = '';
        $.each(data.MarketProcessing,function(k,v){
            marketprocessing += '<input type="button" class="market-btn btn btn-primary" value="'+v+'" data-id="'+k+'">';
        })
        $('.market-btn-block').html(marketprocessing);
         
        //console.log(data);
        
        
        if( data.MarketProcessing != null && data.MarketProcessing != null ){
            $.each(data.PurposeMarket,function(k,v){
               
                  PurposeMarket+='<div class="quality-block"><input type="radio" style="display:none;" class="purpose-group market" name="purposemarketing" data-marketname="'+v.title+'" id="market'+k+'" value="'+k+'"><p>'+v.title+'</p><label for="market'+k+'"><img class="q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></label></div>';
            })
            $.each(data.PurposeProcessing,function(k,v){
               
                PurposeProcessing+='<div class="quality-block"><input type="radio" class="purpose-group processing" name="purposeprocessing[]" data-purposename="'+v.title+'" id="processing'+k+'" value="'+k+'"><p>'+v.title+'</p><label for="processing'+k+'"><img class="q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"/></label></div>';
            })
           
            $(".PurposeMarket").html(PurposeMarket);
            $(".PurposeProcessing").html(PurposeProcessing);
        }
       
       /*=======*/
        
        /*$.each(data.QualityImg,function(k,v){
            qulaityimage+='<div class="quality-block"><p>'+v.title+'</p><img class="q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
        })
        */
       // $(".qualityimage").html(qulaityimage);
       // $(".qualityimage").html(qulaityimage);
        if(data.Quality_id != null){
           $(".model-quality-id").attr('name',"fields["+data.Quality_id+"][]");
        } else {
            $(".model-quality-id").attr('name',"");
        }  
        $.each(data.Packing,function(k,v){
            inp = "<input type='number' class='vk_hide price-field2 form-control col-md-4 ml-3' name='ecs["+data.Packing_id+"]["+k+"]'/> "
            selectpacking += '<div class="packing-block"><div class=""><input type="checkbox" id="pack_'+k+'" name="fields['+data.Packing_id+'][]" class="model-packing-change" value="'+k+'"><label for="pack_'+k+'">'+v+'</label></div>'+inp+'</div>';
        })
        $(".productpaking").html(selectpacking);
        
    }

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
    if(purposeValue == 'Packing')
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
    
})
$(document).on('click', '.step25-n-btn', function() {
    purposeValue = $('.market-btn.active').val();
    mode = '';
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
});

$("body").on("click",".p-q-images2",function(){
    qulaityHtml = $(this).parent().find('p').text();
    $('.step35-detail').html(qulaityHtml);
    $('.step35-n-btn').trigger('click');
})

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

</script>
@endpush