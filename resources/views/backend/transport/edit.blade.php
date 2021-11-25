@extends('backend.layouts.app')
@section('title', 'List :: ' . app_name())

@section('content')
@stack('before-styles')

{{ style('css/bootstrap-datetimepicker.css') }}
{{ style('css/bootstrap-clockpicker.min.css') }}
@stack('after-styles')
<style>
.toable_drop{
    position: absolute;
    max-height: 200px;
    width: 86%;
    z-index: 99;
    background: #eae9e9;
    overflow: auto;
}
.toable_drop li{
    padding: 5px;
    border-bottom: 1px solid #928e8e7a;
    cursor:pointer;
}
</style>
<?php
$cuurencies=array("£","$","€");
$fields=array();
$fields=array();

    $fields[0]=array("type"=>"text","tclass"=>"");
    $fields[1]=array("type"=>"drop","tclass"=>"t_dropdown");
    $fields[2]=array("type"=>"date","tclass"=>"t_date");
    $fields[3]=array("type"=>"date","tclass"=>"t_date");
    $fields[4]=array("type"=>"drop","tclass"=>"t_dropdown");
    $fields[5]=array("type"=>"drop","tclass"=>"t_dropdown");
    $fields[6]=array("type"=>"drop","tclass"=>"t_dropdown");
    $fields[7]=array("type"=>"drop","tclass"=>"t_dropdown");
    $fields[8]=array("type"=>"text","tclass"=>"");
    $fields[9]=array("type"=>"text","tclass"=>"");
    $fields[10]=array("type"=>"text","tclass"=>"");
    $fields[11]=array("type"=>"text","tclass"=>"");
    $fields[12]=array("type"=>"time","tclass"=>"t_time");
    $fields[13]=array("type"=>"time","tclass"=>"t_time");
    $fields[14]=array("type"=>"text","tclass"=>"");
    $fields[15]=array("type"=>"text","tclass"=>"t_price");
    $fields[16]=array("type"=>"text","tclass"=>"");
    $fields[17]=array("type"=>"text","tclass"=>"");
    $fields[18]=array("type"=>"text","tclass"=>"");
    $fields[19]=array("type"=>"text","tclass"=>"");
    $fields[20]=array("type"=>"text","tclass"=>"");
    $fields[21]=array("type"=>"text","tclass"=>"");
    $fields[22]=array("type"=>"drop","tclass"=>"t_dropdown");
    $fields[23]=array("type"=>"text","tclass"=>"");
    $fields[24]=array("type"=>"text","tclass"=>"");
    $fields[25]=array("type"=>"text","tclass"=>"");
    $fields[26]=array("type"=>"text","tclass"=>"");
    $fields[27]=array("type"=>"text","tclass"=>"");
    $fields[28]=array("type"=>"text","tclass"=>"");
    $fields[29]=array("type"=>"text","tclass"=>"");
    $fields[30]=array("type"=>"text","tclass"=>"");
    $fields[31]=array("type"=>"date","tclass"=>"t_date");
    $fields[32]=array("type"=>"radio","tclass"=>"t_toggle");
    $fields[33]=array("type"=>"text","tclass"=>"");
    $fields[34]=array("type"=>"text","tclass"=>"t_attach");
    $fields[35]=array("type"=>"text","tclass"=>"t_attach");
    $fields[36]=array("type"=>"text","tclass"=>"t_attach");
    $fields[37]=array("type"=>"text","tclass"=>"t_attach");
    $fields[38]=array("type"=>"text","tclass"=>"t_attach");
    $fields[39]=array("type"=>"text","tclass"=>"t_attach");

?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Edit Load<small class="text-muted"></small>
                </h4>
                @if (\Session::has('success'))
    <div class="alert alert-success">
       
            {!! \Session::get('success') !!}
        
    </div>
@endif
            </div><!--col-->

            
        </div><!--row-->
        <div class="row mt-2" >
            <div class="col" >
                <div class="table-offers" style="padding-left:15px;padding-right:15px;">
                {{ html()->form('POST')->class('form-horizontal')->open() }}
                <div class="row">
                <?php 
                $dropdowns=array();
               foreach($data as $dpr){
                   foreach($dpr as $k=>$d){
                   $dropdowns[$k][]=$d;
                   }
               }
              
if(count($data)>0){
$keys=array();
$keys=array_keys($data[0]);
}
$count=0;
?>
                <?php foreach($keys as $k){
	 ?>
     <div class="col-md-2" style="padding-right: 5px;
    padding-left: 5px;">
     <div class="form-group">
     <label style="margin-bottom:0px;font-size: 13px;"><?=$k?></label>
     <?php 
     
if($fields[$count]["type"]=="text" || $fields[$count]["type"]=="date"){
   if($fields[$count]["tclass"]=="t_attach"){
?>
<input type="hidden" name="editr[<?=$count?>]" value="<?=$data[$rowindex][$k]?>" />
<br>
<ul class="files" data-name="<?=$k?>">
<?php
$flist=explode("_",$data[$rowindex][$k]);
foreach($flist as $fl){
if($fl!=""){
    ?>
    <li><?=$fl?></li>
    <?php
}}
?>
</ul>
<a href="javascript:void(0)" data-name="editr[<?=$count?>]" class="uploader btn btn-primary">Attach</a>

<?php
   }
   else if($fields[$count]["tclass"]=="t_price"){
$cur="";
$crv=$data[$rowindex][$k];
    foreach($cuurencies as $c){
        $crv1=str_replace($c,"",trim($crv));
        if($crv!=$crv1){
            $cur=$c;
            $crv=$crv1;

        }
    }
    
       ?>
<input type="text" name="editr[<?=$count?>]" style="width:70%;float:left;" value="<?=$crv?>" class="form-control <?=$fields[$count]["tclass"]?>" />
<select name="curreny" class="form-control" style="width:30%">
<?php foreach($cuurencies as $c){ ?>
<option value="<?=$c?>" <?php if($c==$cur){ echo "selected";} ?>><?=$c?></option>
<?php } ?>
</select>
       <?php

   }
   else{
?>
<input type="text" name="editr[<?=$count?>]" value="<?=$data[$rowindex][$k]?>" class="form-control <?=$fields[$count]["tclass"]?>" />
   <?php } ?>

<?php if($fields[$count]["tclass"]=="t_dropdown"){ 
    $itrs=array_unique($dropdowns[$k]);
    ?>
    <div class="toable_drop" style="display:none">
    <ul style="list-style: none;
    padding-left: 9px;">
    <?php
    foreach($itrs as $it){
        if($it!=""){
?>
<li> <?=$it?></li>
<?php
        }
    }
    ?>
    </ul>
    </div>

<?php } ?>
<?php
}
if($fields[$count]["type"]=="drop"){
    $itrs=array_unique($dropdowns[$k]);
  ?>

  <select class="form-control select2" name="editr[<?=$count?>]">
  <?php foreach($itrs as $it){
        if($it!=""){
            ?>
  <option value="<?=$it?>" <?php if($it==$data[$rowindex][$k]){ echo "selected";} ?>><?=$it?></option>
        <?php }} ?>
  </select>
    <?php
}
if($fields[$count]["type"]=="time"){
    ?>
<input type="time" name="editr[<?=$count?>]" class="form-control"  value="<?=$data[$rowindex][$k]?>" >
    <?php
}
if($fields[$count]["type"]=="radio"){
    ?>
    <div class="checkbox d-flex align-items-center">
<label class="switch switch-label switch-pill switch-primary mr-2" >
<?php $rd=$data[$rowindex][$k];
if($rd==""){
$rd="No";
}
?>
<input class="switch-input" type="checkbox" name="editr[<?=$count?>]" <?php if($rd=="Yes"){ echo "checked";} ?> value="<?=$rd?>">
<span class="switch-slider" data-checked="Yes" data-unchecked="No"></span></label>
                                                               
                                                            </div>
    <?php
}
     ?>
     
     </div>
     </div>
	
<?php 
$count++;
} ?>
<div class="col-md-12" style="text-align:center;">
<a href="javascript:void(0)" class="btn btn-info all-doc">Documents</a>
</div>
<div class="col-md-12" style="text-align:center;">
<input type="hidden" name="file" value="<?=$fname?>" />
<input type="hidden" name="type" value="edit" />
<input type="hidden" name="uploadid" id="uploadid" value="" />
<input type="hidden" name="rowindex" value="<?=$rowindex?>" />
<input type="file" class="iamuploader" style="display:none;" data-url="/upload"   />
<div id="files_list"></div>
    <p id="loading"></p>
    <input type="hidden" name="file_ids" id="file_ids" value="" /> 
<input type="submit" class="btn btn-primary"  value="Update" />
</div>
</div>
{{ html()->form()->close() }}
                     
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
<div id="linkModal" class="modal fade" role="dialog" style="opacity:1;">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Attachment List</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body" id="link_details">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection

@push('after-scripts')

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
{{ script('js/bootstrap-datetimepicker.js') }}
{{ script('js/bootstrap-clockpicker.min.js') }}
<script type="text/javascript">
            $(function () {
                $(".switch-input").on("change",function(){
                    if($(this).val()=="No"){
                        $(this).val("Yes");
                    }else{
                        $(this).val("No");
                    }

                });
                $(window).on("click",function(e){
                    if(!$(e.target).hasClass('t_dropdown')){
                        $(".toable_drop").hide();

                    }

                });
                $(".all-doc").on("click",function(){
                    $("#linkModal").modal("show");
                    var links=$("ul.files").get();
                    var html = "";
                    $('ul.files').each(function(i){
                        html += "<p><b>"+$(this).attr("data-name")+"</b></p><ul>";
                        $(this).find("li").each(function(j){
                            html += "<li><a href='/admin/download?file=app/"+$(this).text()+"'>"+$(this).text()+"</a></li>";

                        });
                        html += "</ul>";
                         });
                   
                    $("#link_details").html(html);

                });
                $('.iamuploader').on("change",function(){
                 
                var fd = new FormData(); 
                var files = $('.iamuploader')[0].files[0]; 
                fd.append('file', files); 
                fd.append( "_token", $('meta[name="csrf-token"]').attr('content'));
       
                $.ajax({ 
                    url: '/admin/upload', 
                    type: 'post', 
                    data: fd, 
                    contentType: false, 
                    processData: false, 
                    success: function(response){ 
                        if(response != 0){ 
                            $("input[name='"+$("#uploadid").val()+"']").val( $("input[name='"+$("#uploadid").val()+"']").val()+"_"+response);
                            
                           alert('file uploaded'); 
                        } 
                        else{ 
                            alert('file not uploaded'); 
                        } 
                    }, 
              
});
                });

                $(".uploader").on("click",function(){
                   
                    var field=$(this).attr("data-name");
                    console.log(field);
                    $("#uploadid").val(field);
                    $(".iamuploader").click();
                });

                $('.t_date').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                
                $('.t_time').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
});
                $(".t_dropdown").on("click",function(){
                    $(".toable_drop").hide();
                    
                    $(this).parent().find(".toable_drop").show();

                });
                $("input[name='editr[17]']").on("keyup",function(){
                    var loaded=$(this).val();
                    var unloaded=$("input[name='editr[18]']").val();
                    $("input[name='editr[19]']").val(loaded-unloaded);
                });
                $("input[name='editr[18]']").on("keyup",function(){
                    var unloaded=$(this).val();
                    var loaded=$("input[name='editr[17]']").val();
                    $("input[name='editr[19]']").val(loaded-unloaded);
                });
                $(".toable_drop ul li").on("click",function(){
                   
                    $(this).parent().parent().parent().find("input").val($(this).text());
                    $(this).parent().parent().hide();

                });
                $(".t_dropdown").on("keyup",function(){
                    
                    var input, filter, ul, li, a, i, txtValue;
  input = $(this);
  filter = $(this).val().toUpperCase();
  ul = $(this).parent().find("ul");
  li = $(this).parent().find("li");

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }

                });
            });
        </script>
@endpush
