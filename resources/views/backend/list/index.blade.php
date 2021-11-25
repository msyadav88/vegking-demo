@extends('backend.layouts.app')
@section('title', 'List :: ' . app_name())
@section('content')
<style>
table.dataTable>tbody>tr.child span.dtr-title {
    display: block;
    min-width: 75px;
    font-weight: 700;
    overflow: hidden;
}
table.dataTable>tbody>tr.child ul.dtr-details>li {
    border-bottom: 1px solid #efefef;
    padding: .5em 0;
    float: left;
    width: 200px;
    height: 50px;
}

</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Transport List <small class="text-muted"></small>
                </h4>
            </div><!--col-->
            
            <div class="col-sm-12">
            <div class="row">
            <?php 

            ?>
<?php foreach($files as $f){ 
    if(trim($f)!=""){
    ?>

	<div class="form-group">
		<a href="?comp=<?=$f?>" class="btn btn-primary" style="margin-right:10px;"><?=$f?></a>


</div>
<?php } } ?>

</div>
            </div><!--col-->
        </div><!--row-->
        <div class="row mt-2" style="padding:0px">
            <div class="col" style="padding:0px">
                <div class="table-offers" style="padding:0px">
                    <?php if(count($data)>0){ ?>
                    <div class="col-sm-12">
              <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                  <a href="{{ route('admin.list.addtransport') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="Create New"><i class="fas fa-plus-circle"></i></a>
              </div><!--btn-toolbar-->
            </div>
                    <?php }if(count($data)>0){ ?>
                      <table id="trans-table" class="table table-striped table-bordered table-hover dt-responsive display nowrap" cellspacing="0"
                   width="100%" style="font-size:10px;">
       
	<thead>
<?php 
if(count($data)>0){
$keys=array();
$keys=array_keys($data[0]);
$count=0;
?>
<tr>
<th class="all">Action</th>
	<?php foreach($keys as $k){
		$count++;
$class="none";
if($count<=14){
	$class="all";
}
	 ?>
	<th class="<?=$class?>"><?=$k?></th>
<?php } ?>
</tr>
<?php } ?>
</thead>
<tbody>
<?php 
$count=0;

foreach($data as $d){ 
  $count++;
    if($d[$keys[1]]!=""){
        
    ?>
<tr>
<td>
<a href="?file=<?=$fname?>&edit=<?=$count-1?>">Edit</a>
<a href="?cfile=<?=$fname?>&copy=<?=$count-1?>">Copy</a>
</td>
<?php foreach($keys as $k){ ?>

<td><?=$d[$k]?></td>
<?php } ?>

</tr>

<?php }} ?>

</tbody>
</table>
<?php } ?>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
<script>
    $(document).ready(function () {
        $('#trans-table')
                .dataTable({
                	"responsive":true,
                    
		    columnDefs: [ {
		        className: 'control',
		        orderable: true,
		        targets: 0,
               
		    } ],
            "columnDefs": [
      { "width": "7.14%", "targets": 0 },
      { "width": "7.14%", "targets": 1 },
      { "width": "7.14%", "targets": 2 },
      { "width": "7.14%", "targets": 3 },
      { "width": "7.14%", "targets": 4 },
      { "width": "7.14%", "targets": 5 },
      { "width": "7.14%", "targets": 6 },
      { "width": "7.14%", "targets": 7 },
      { "width": "7.14%", "targets": 8 },
      { "width": "7.14%", "targets": 9 },
      { "width": "7.14%", "targets": 10 },
      { "width": "7.14%", "targets": 11 },
      { "width": "7.14%", "targets": 12 },
      { "width": "7.14%", "targets": 13 },
    ],

                });
    });
</script>
@endpush
