@extends('backend.layouts.app')
@section('title', 'Add transport :: ' . app_name())
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Transport List Create<small class="text-muted"></small>
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
                <div class="table-offers">
                {{ html()->form('POST')->class('form-horizontal')->open() }}
                <div class="row">
                <?php 
if(count($data)>0){
$keys=array();
$keys=array_keys($data[0]);
}
$count=0;
?>
                <?php foreach($keys as $k){
	 ?>
     <div class="col-md-4">
     <div class="form-group">
     <label><?=$k?></label>
     <input type="text" name="editr[<?=$count?>]" value="<?php if($rowindex!=-1){ echo $data[$rowindex][$k];}?>" class="form-control" />
     </div>
     </div>
	
<?php 
$count++;
} ?>

<div class="col-md-12" style="text-align:center;">
<input type="hidden" name="file" value="<?=$fname?>" />
<input type="hidden" name="type" value="write" />
<input type="hidden" name="rowindex" value="<?=$rowindex?>" />
<input type="submit" class="btn btn-primary"  value="Create" />
</div>
</div>
{{ html()->form()->close() }}
                     
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')

@endpush
