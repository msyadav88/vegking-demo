<style>

.fs-title {
font-size: 15px;
text-transform: uppercase;
color: #2C3E50;
margin-bottom: 10px;
}
.fs-subtitle {
font-weight: normal;
font-size: 13px;
color: #666;
margin-bottom: 20px;
}

#progressbar {
margin-bottom: 30px;
overflow: hidden;
/*CSS counters to number the steps*/
counter-reset: step;
}
.stockmodal #progressbar li {
    list-style-type: none;
    text-transform: uppercase;
    position: relative;
    text-align: center;
    margin: 5px 8px;
        width: 75px;
}
.stockmodal ul#progressbar,.qualityimage, .packing-block {
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    justify-content: center;
    -webkit-justify-content: center;
    flex-wrap: wrap;
    -webkit-flex-wrap: wrap;
}
.stockmodal #progressbar li:before {
    content: counter(step);
    counter-increment: step;
    width: 40px;
    line-height: 20px;
    display: block;
    font-size: 16px;
    color: #fff;
    background: #b59842;
    border-radius: 20px;
    margin: 0 auto 6px;
    text-align: center;
    height: 40px;
    line-height: 40px;
}
/*progressbar connectors*/
#progressbar li:after {
content: '';
width: 100%;
height: 2px;
background: white;
position: absolute;
left: -50%;
top: 9px;
z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
/*connector not needed before the first step*/
content: none;
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before, #progressbar li.active:after {
background: #27AE60;
color: white;
}
.stockmodal .modal-dialog {
    max-width: 850px;
}
.selectproduct h2 {
    font-size: 18px;
    font-weight: 600;
}
.selectproduct img {
    object-fit: cover;
    margin: 5px 5px;
    border: 2px solid #ddd;
    width: 150px;
    height: 150px;
    cursor: pointer;
}
.selectproduct img:hover, .selectproduct img.active {
   border: 2px solid #4dbd74; 
}
.stockmodal .btn-primary {
    color: #fff;
    background-color: #4dbd74;
    border-color: #4dbd74;
    }
.stockmodal .btn-primary,.stockmodal .btn.btn-secondary {;
    padding: 6px 22px;
    font-size: 16px;
    margin-top: 25px;
}
.nextback {
    text-align: center;
}
.selectproduct {
    text-align: center;
    background-color: #fff;
    box-shadow: 0 0 4px 0 rgba(0,0,0,0.2);
    padding: 25px;
}
.productvariety {
    max-width: 370px;
    margin: 0 auto;
}
.quality-block  {
    margin: 10px 0;
}
.quality-block p {
    margin-bottom: 5px;
}
.productpaking input {
    vertical-align: middle;
    display: inline-block;
    margin: 0 0 0px 15px;
}
.productpaking span {
    display: inline-block;
    vertical-align: middle;
    padding-left: 5px;
}
.bigbags {
    width: 25%;
    text-align: left;
}
.packing-block {
    padding:  5px 0;
}
.packing-block input.price-field {
    width: 70px;
    max-width: 70px;
}
.stockmodal .rule-add.btn-primary {
    margin-top: 0;
}
.productpaking input[type="checkbox"]{
    height: 18px;
    width: 20px;
}
</style>
<div class="stockmodal modal fade" id="createModals" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header" style="padding:15px 50px;">
            <h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="trans_title"></span> </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:15px 50px;">
           <form id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" data-id="ss-step1">Step1</li>
                <li class="" data-id="ss-step2">Step2</li>
                <li class="" data-id="ss-step3">Step3</li>
                <li class="" data-id="ss-step4">Step4</li>
               <!--  <li class="" data-id="ss-step5">Size</li>
                <li class="" data-id="ss-step6">Price</li>
                <li class="" data-id="ss-step7">Packing</li>
                <li class="" data-id="ss-step8">Status</li> --->
            </ul>

            <fieldset class="selectproduct" id="ss-step1">
                <h2 class="fs-title">Select Product</h2>
                @foreach ( $productsimage as $image )
                    <img src="{{asset('/images/products/'.$image->image)}}" width="100px" height="100px" data-id="{{$image->id}}" class="product p-images">
                @endforeach   
                <div class="nextback" style="opacity:0;">     
                    <input type="button" name="next" class="next btn btn-primary step1-n-btn action-button" value="Next" />
                </div>
            </fieldset>

            <fieldset class="selectproduct" id="ss-step2" style="display: none;">
                <h2 class="fs-title">Select Variety</h2>
                <div class="productvariety">
                     <select class="model-variety-field model-row form-control">
                        <option value="">Choose Variety</option>
                     </select>
                </div>
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous" />
                    <input type="button" name="next" class="next btn btn-primary action-button" value="Next" />
                </div>
            </fieldset>

            <fieldset class="selectproduct" id="ss-step3" style="display: none;">
                <h2 class="fs-title">Select Purpose</h2>
                <div class="qualityimage">
                    
                </div>
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous" />
                    <input type="button" name="next" class="next btn btn-primary action-button" value="Next" />
                </div>
            </fieldset>

            <fieldset class="selectproduct" id="ss-step4" style="display: none;">
                <h2 class="fs-title">Select Defects</h2>
                <div class="defect-block">
                    <select class="model-defect-field model-row form-control select2" multiple>
                        <option value="">Choose Defects</option>
                    </select>
                </div>
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
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous" />
                    <input type="button" name="next" class="next btn btn-primary action-button" value="Next" />
                </div>
            </fieldset>
            
            <fieldset class="selectproduct" id="ss-step5" style="display: none;">
                <h2 class="fs-title">Size</h2>
                <div class="form-group rules-section-block productsize mb-2">
                    <div class="rule-inner-block row justify-content-center">
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="size[0][from]"  placeholder="Size From" >
                    </div>
                    <div class="col-md-2"> 
                       <input type="text" class="form-control" name="size[0][to]"  placeholder="Size To">
                    </div>
                    <div class="col-md-2">
                        <input type="button" class="rule-add btn btn-primary" value="Add+" id="addsize"/>
                    </div>
                     </div> 
                </div>
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous" />
                    <input type="button" name="next" class="next btn btn-primary action-button" value="Next" />
                </div>
            </fieldset>
            
            <fieldset class="selectproduct" style="display:none ;">
                <h2 class="fs-title">Price</h2>
                <div class=" row justify-content-center">
                    <div class="col-md-4">
                         <input name="price" id="price" type="text" class="price-field model-row price form-control">
                    </div>
                </div>
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous" />
                    <input type="button" name="next" class="next btn btn-primary action-button" value="Next" />
                </div>
            </fieldset>
           
            <fieldset class="selectproduct" id="ss-step7" style="display: none;">
                <h2 class="fs-title">Packing</h2>
                <div class="productpaking"></div>
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous" />
                    <input type="button" name="next" class="next btn btn-primary action-button" value="Next" />
                </div>
            </fieldset>
            
            <fieldset class="selectproduct" style="display: none;">
                <h2 class="fs-title">Select Status</h2>
                <div class=" row justify-content-center">
                    <div class="col-md-4">
                        <select name="stock_status" class="status form-control">
                            <option value="unavailable">Unavailable</option>
                            <option selected value="available">Available</option>
                            <option value="upcoming_stock">Upcoming Stock</option>
                        </select>
                    </div>
                </div>
                <div class="nextback">
                    <input type="button" name="previous" class="previous btn btn-secondary action-button" value="Previous" />
                    <input type="hidden" class="model-product-id" name="product_id"/>
                    <input type="hidden" class="model-quality-id" name=""/>
                    <input type="button" name="next" id="create_stock2" class="next btn btn-primary action-button" value="Submit" />
                </div>
            </fieldset>
            
            </form>
        </div>
        </div>
    </div>
</div> 
@push('after-scripts')
<script src="{{asset('/js/jquery.easing.min.js')}}"></script>
<script>
var increment = 1;
var sizehtml = ' ';
let defects2 = [];
let price2 = 0;
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
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
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
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        previous_fs.show(); 
        current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
        scale = 0.8 + (1 - now) * 0.2;
        left = ((1-now) * 50)+"%";

        opacity = 1 - now;
        current_fs.css({'left': left});
        previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
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

    $('li').click(function(){

        var id = $(this).data('id');
        $("fieldset").hide();
        $("#"+id).show();
       
        $(this).addClass('active');
        //$('li').removeClass('active');

    })
});



$("#addsize").click(function(){
    
    sizehtml ='<div class="rule-inner-block row justify-content-center mb-2"><div class="col-md-2">'+'<input type="text" class="form-control" name="size['+increment+'][size]"  placeholder="Size From"></div><div class="col-md-2"><input type="text" class="form-control" name="size['+increment+'][size]"  placeholder="Size To"></div><div class="col-md-2"></div></div>';
    
    $('.productsize').append(sizehtml);
    increment++;
})

$("body").on("click",".p-images",function(){
   $('.p-images').removeClass('active');
   $(this).addClass('active');
   $(".model-product-id").val($(this).data('id'));   
});

$("body").on("click",".q-images",function(){
   $('.p-images').removeClass('active');
   $(this).addClass('active');
   $(".model-quality-id").val($(this).data('id'));  
});

$(document).on('click','#create_stock2',function(){
    var formData = new FormData();
    formDataArr = $("#msform").serializeArray();
    $.each(formDataArr,function(k,d){
        formData.append(d.name, d.value);
    });
     $.ajax({
        url: save_stock_url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data)
        {
            Swal.fire('Sent!','Stock is successfully added.', 'success');
            setTimeout(function(){
                //window.location.href = redirecturl;
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
                    $("#create_create_stock").find("#"+key).parent().addClass('has-danger');
                    $("#create_create_stock").find("#"+key).addClass('is-invalid');
                    $("#create_create_stock").find('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
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



$(".product").click(function(){
var productid = $(this).data('id');
var htmlvariety=' ';
var qulaityimage = ' ';
var htmlproductpackaing='';
$.ajax({
    url: "{{ url('seller/get-product-stock-ajax') }}",
    method: 'POST',
    data: {productid:productid},
    dataType: "json",
    success: function(data)
    {
        var selectvariety = '';
        var selectpacking = '';
        var selectquality = ''; 
        var selectdefects = '';
        var selectcleaning = '';
        
        $.each(data.Defects,function(key,value){
            selectdefects +='<option value="'+key+'">'+value+'</option>'
        })
        
        if(data.Defects_id != null){
            $(".model-defect-field").html(selectdefects);
            $(".model-defect-field").attr('name',"fields["+data.Defects_id+"][]");
            $(".model-defect-field").attr('data-id',data.Defects_id);
        } else { 
            $(".model-defect-field").html('');
            $(".model-defect-field").attr('name',"");
            $(".model-defect-field").attr('data-id',"");
        }
        
        $.each(data.Variety,function(key,value){
            selectvariety += '<option value="'+key+'">'+value+'</option>'
        });
       
        if(data.Variety_id != null){
            $(".model-variety-field").html(selectvariety);
            $(".model-variety-field").attr('name',"fields["+data.Variety_id+"]");
            $(".model-variety-field").attr('data-id',data.Variety_id);
        } else {
            $(".model-variety-field").html('');
            $(".model-variety-field").attr('name',"");
            $(".model-variety-field").attr('data-id',"");
        }
            
            
        $.each(data.QualityImg,function(k,v){
            qulaityimage+='<div class="quality-block"><p>'+v.title+'</p><img class="q-images" data-id="'+k+'" src="{{ asset('/images/productspec') }}/'+v.image+'"></div>';
        })

        $(".qualityimage").html(qulaityimage);
        if(data.Quality_id != null){
           $(".model-quality-id").attr('name',"fields["+data.Quality_id+"][]");
        } else { 
            $(".model-quality-id").attr('name',"");
        }  
        
        $.each(data.Packing,function(k,v){
            selectpacking += '<div class="packing-block"><div class="bigbags"><input type="checkbox" class="model-packing-change" value="'+v+'"><span>'+v+'</span></div><input type="number" style="" class="vk_hide price-field form-control col-md-4 ml-3" name="ecs[3][12]"></div>';
        })
        $(".productpaking").append(selectpacking);
        $('.step1-n-btn').trigger('click');    

    }
});

$(document).on('change','.model-packing-change',function(){
   $(this).parents('div.packing-block').find('input[type="number"]').toggle(); 
});

})
</script>
@endpush