@extends('backend.layouts.app')
@section('title', 'Transport List :: ' . app_name())
@role('seller')
@php $route_pre = 'seller'; @endphp
@else
@php $route_pre = 'admin'; @endphp
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
            <div class="col-md-5">
                <h4 class="card-title mb-0">
                    Transport List <small class="text-muted"></small>
                </h4>
            </div><!--col-->
			@role('administrator')
            <div class="col-md-7">
		 
                <div class="btn-toolbar float-right" role="toolbar" >
                 <!--  <a href="javascript:void(0)" data-toggle="modal" data-target="#uploadExcel" class="btn btn-primary ml-1"  title="Upload Excel">Upload Excel <i class="fa fa-upload"></i></a> -->
                  <a href="{{ route('admin.sellers.transportexports') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export Excel">Export Excel <i class="fa fa-download"></i></a>
                  <a href="{{ route('admin.sellers.downloadpdf') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export PDF">Export PDF <i class="fa fa-file-pdf"></i></a>
				  <a href="{{ route('admin.sellers.downloaddoc') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="Export PDF">Export Doc <i class="fa fa-file"></i></a>
				</div>
                
              <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                  <a href="{{ route('admin.transportlist.addtransport') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="Create New"><i class="fas fa-plus-circle"></i></a>
              </div><!--btn-toolbar-->
            </div>
			@endif
           
        </div><!--row-->

        <!--- START UPLOAD EXCEL MODAL--->
        <div class="modal" id="uploadExcel">
        	<form id="uploadTransportList" method="POST" enctype="multipart/form-data">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
						<h4 class="modal-title">Upload Excel</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							@csrf
							<input type="file" name="excelFile"  id="excelFile" required />
						</div>
						<!-- Modal footer -->
						<div class="modal-footer">
							<button type="submit" class="btn btn-success" >Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
        <!--- END UPLOAD EXCEL MODAL--->
		<div class="row mt-2" style="padding:0px">
            <div class="col" style="">
                <div id="tag_container" class="table-offers" style="padding:0px">
                    
          <table id="trans_table" class="table table-bordered data-table">
                        <thead>
                        <tr>
                             
                            <th>Ref</th>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Variety</th>
                            <th>Size</th>
                            <th>Loaded Weight</th>
                            <th>Unloaded Weight</th>
                            <th>Difference</th>
                            <th>Freight Cost</th>
                            <th>Status</th>
                            <th>Load Date</th>
                            <th>Unload Date</th>
                            <th>Load Loc</th>
                            <th>Unload Loc</th>
                            <th>Truck Plates</th>
                            <th>Carrier</th>
							@role('administrator')
                            <th>Buyer</th>
                            <th>Seller</th>
                            <th>@lang('labels.general.actions')</th>
							@endif
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
							 
                                <th data-title="@lang('labels.backend.trading.offers.table.id')"></th>
                                <th data-title="Product"></th>
                                <th data-title="Customer"></th>
                                <th data-title="Variety"></th>
                                <th data-title="Size"></th>
                                <th data-title="Loaded Weight"></th>
                                <th data-title="Unloaded weight"></th>
                                <th data-title="Difference"></th>
                                <th data-title="Freight Cost"></th>
                                <th data-title="Status"></th>
                                <th data-title="Load Date"></th>
                                <th data-title="Unload Date"></th>
                                <th data-title="Load Loc"></th>
                                <th data-title="Unload Loc"></th>
                                <th data-title="Truck Plates"></th>
                                <th data-title="Carrier"></th>
								@role('administrator')
                                <th data-title="Buyer"></th>
                                <th data-title="Seller"></th>
                                <th data-title="@lang('labels.backend.trading.offers.table.date')"></th>
								@endif
                            </tr>
							<!--<tr class="child" style="display:none;">
			<td class="child" colspan="19">
				<div class="row mt-2 transport_maindiv">
                <div class="col">
					<div class="transload"></div>
					
                </div>
                 
            </div></td></tr>-->
                        </tfoot>   
					</table>      
                
				<div id="transload"></div>	
				
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
 

@endsection

@push('after-scripts')
<script >
	$( document ).ready(function() {
		$("#uploadTransportList").submit(function(){
			let form = new FormData($("#uploadTransportList")[0]);
			$('.loading').removeClass('loading_hide');
			$.ajax({
				url:"{{ route('admin.transportlist.uploadExcel')}}",
				data:form,
				type:"POST",
				processData: false,  // Important!
		        contentType: false,
		        cache: false,
		        success:function(response){
		        	let data = JSON.parse(JSON.stringify(response));		        	
		        	$('.loading').addClass('loading_hide');
		        	$("#uploadExcel").modal("hide");
		        	alert(data.message);
		        	//window.location.reload();
		        },
		        error:function(error){
		        	console.log(error);
		        	$('.loading').addClass('loading_hide');
		        }
			});		
			return false;
		});		
	});	
$(function () {
	var ip = '';
	$.ajax({
		url: "https://jsonip.com",
		type: 'get',
		cache: false,
		success: function(res){ 
			$("#ip").val(res.ip);
			var ip = $("#ip").val();
		}
	});

	setTimeout(function() {
        $(".alert-danger").hide();
    }, 3000);
	var consignee_count2 = 1;
	var shipper_count2 = 1;	
	var name_arrc = 0;	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
		
    $('#trans_table #filter th').each( function () {
        var title = $(this).attr('data-title');
        if(title != '')
            $(this).html( '<input type="text" style="width:100%" placeholder="" />' );
    } );
    var table = $('.data-table').DataTable({
		processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
		ajax: "{{ route($route_pre.'.transportlist.index') }}",
	    columns: [
            {data: 'id', name: 'id'},
            {data: 'product', name: 'product'},
            {data: 'customername', name: 'customername'},
            {data: 'variety', name: 'variety'},
            {data: 'size_from', name: 'size'},
            {data: 'loaded_weight', name: 'loaded_weight'},
            {data: 'unloaded_weight', name: 'unloaded_weight'},
            {data: 'difference', name: 'difference'},
            {data: 'freight_cost', name: 'freight_cost'},
            {data: 'payment_status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'unloaddate', name: 'unloaddate'},
            {data: 'loadloc', name: 'loadloc'},
            {data: 'unloadloc', name: 'unloadloc'},
            {data: 'plateno', name: 'plateno'},
            {data: 'carrier', name: 'carrier'},
			@if(auth()->user()->hasRole('administrator'))
            {data: 'buyer', name: 'buyer'},
            {data: 'seller', name: 'seller'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
			@endif
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
	
    
		
	$('body').on('click', '.editItem', function (event) {
		event.preventDefault();
		savetrack();
			$('.expand_view').remove();
			var current_edit = $(this);
			consignee_count2 = 1;
			shipper_count2 = 1;	
			name_arrc = 1;
			$('.minus').hide();
			$('.plus').show();
			$('tr').next('.child').hide();
			//$(this).hide();	
			//$(this).next('.minus').show();
			//$(this).parents('tr').next('.child').show();
			var currentobj = $(this);
			 
			$.ajax({
				type: "POST",
				url: "{{ route('admin.transportlist.gettransportloads') }}",
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {transport_id:$(this).data("id")},
				beforeSend: function(){
					$('.loading').removeClass('loading_hide');
				},
				success: function (data) {
					$('.loading').addClass('loading_hide');
					 
					var shipperdataArry = data.shipperdata;
					var consigneedataArry = data.consigneedata; 		
					//console.log(shipperdataArry);
					$.each(data.transdata, function (index, value) {
					  //$('#results').append('<p>'+value+'</p>');
						var loads_temp = create_loads(value,currentobj,shipperdataArry,consigneedataArry);
						 
							current_edit.parents('tr').after('<tr class="expand_view"><td colspan="19">'+loads_temp+'</td></tr>');
							$('.select2').select2();
							repeater_field();
							ajax_saveloads();
							bs_input_file();
							downloadall();
						savetrack();
					//	console.log(value);
					});
				}
				 
			});
			 
			
	});
	
	function savetrack(){
	
		$("body button, body .btn, a").click(function( event ) {
         var data ={};
         data['button']= $(event.target).text() == undefined ? null : $(event.target).text();
		 data['data']= $(this).val() == undefined ? null : $(this).val();
         data['page']= "{{url()->current()}}";
         data["_token"]="{{ csrf_token() }}";
		 data['ip']=$("#ip").val();
         ga('send', 'event', data.button, data.page, 'Click');
        $.ajax({
            url: "{{ route('frontend.user.tracker') }}",
            method: 'post',
            data: data,
            success: function(response){
             //console.log(response);
        }})

        });
	}
	
	function create_loads(data,currentobj,shipperdata,consigneedata)
	{	
		// console.log(data);
		var shippertab = '';
		var consigneetab = '';
		var consignee = '';
		var setminus = '';
		var setminus2 = '';
		var tempshipper = 1;
		var tempconsignee = 1;
		var tempshippername = 0;
		var consigneename = 0;
		 
		if(shipperdata.length == 0){
		
		shippertab = '<div class="shipper_copy" data-number="0">'+
							'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
									'<a style="bottom:0px;float: right;font-size: 33px;font-weight: bold;" type="" class="shipper_addmore getshipper_0">+</a>'+
								'</div>'+
								'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Shipper</label>'+
									'<input type="text" id="shipperedit0" value="'+data.seller+'" class="form-control shipper" name="editr['+tempshipper+'][0][shipper]">'+
									'</div>'+
							'</div>'+
							'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Shipping add <span style="color:red">*</span></label>'+
									
									'<input type="text" class="form-control shipping_address" name="editr['+tempshipper+'][0][shipping_address]" >'+
									'</div>'+
							'</div>'+
							'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Shipper`s ref <span style="color:red">*</span></label>'+
									'<input type="text" name="editr['+tempshipper+'][0][shippers_reference]" value="" placeholder="Shipper`s ref" class="form-control shippers_reference">'+
								'</div>'+
							'</div>'+
							'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Shipping date</label>'+
									'<input id="loaddt" type="text" value="'+data.loaddate+'"  name="editr['+tempshipper+'][0][shipping_date]" value="" placeholder="Shipping date" class="form-control" style="height: auto;padding: 0.28rem 0.75rem;">'+
								'</div>'+
							'</div>'+
							'<div class="col-md-12 pull-left"></div>'+
						'</div>';

		}else{
			// console.log(shipperdata.length);
		 	$.each(shipperdata, function (index, value) {
			//	var tempshipper = 1 + index;	 
		 if(index > 0){
			setminus = '<a style="bottom: 0px; float: right; font-size: 33px; font-weight: bold;" type="" class="shipper_remove getshipper_0">-</a>';
		 }

			var selected_shipper = value.shipper_name;
			shippertab += '<div class="shipper_copy" data-number="0">'+
							'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
									'<a style="bottom:0px;float: right;font-size: 33px;font-weight: bold;" type="" class="shipper_addmore getshipper_0">+</a>'+setminus+
								'</div>'+
								'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Shipper</label>'+
									'<input type="text" id="shipperedit'+index+'" value="'+value.shipper_name+'" class="form-control shipper" name="editr['+tempshipper+']['+tempshippername+'][shipper]" readonly>'+
										'</div>'+
							'</div>'+
							'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Shipping add <span style="color:red">*</span></label>'+
									
									'<input type="text" class="form-control shipping_address" name="editr['+tempshipper+']['+tempshippername+'][shipping_address]" value="'+value.shipper_address+'">'+
									'</div>'+
							'</div>'+
							'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Shipper`s ref <span style="color:red">*</span></label>'+
									'<input type="text" name="editr['+tempshipper+']['+tempshippername+'][shippers_reference]" value="'+value.shipper_reference+'" placeholder="Shipper`s reference" class="form-control shippers_reference">'+
								'</div>'+
							'</div>'+
							'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Shipping date</label>'+
									'<input id="loaddt" type="text" value="'+data.loaddate+'" name="editr['+tempshipper+']['+tempshippername+'][shipping_date]" value="'+value.shipper_date+'" placeholder="Shipping date" class="form-control" style="height: auto;padding: 0.28rem 0.75rem;" readonly>'+
								'</div>'+
							'</div>'+
							'<div class="col-md-12 pull-left"></div>'+
						'</div>';
						//tempshipper++;
						$('.select2').select2();
						 
						tempshippername++;
						
						shipper_count2 = tempshippername;
		 	});
			shipper_remove();
		}

		if(consigneedata.length == 0){

			consigneetab = '<div class="consignee_copy" data-number="0">'+
												'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
													'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
														'<a style="bottom:0px;float: right;font-size: 33px;font-weight: bold;" type="" class="consignee_addmore getconsignee_0">+</a>'+
													'</div>'+
													
													'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
														'<label style="margin-bottom:0px;font-size: 13px;">Consignee</label>'+
														
														'<input type="text" id="condiedit0" class="form-control consignee" value="'+data.buyer+'" name="editr['+tempconsignee+'][0][consignee]" readonly>'+
														'</div>'+
												'</div>'+
												'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
													'<div class="form-group">'+
														'<label style="margin-bottom:0px;font-size: 13px;">Consignee add <span style="color:red">*</span></label>'+
														
														'<input type="text" class="form-control consignee_address" name="editr['+tempconsignee+'][0][consignee_address]" >'+
														'</div>'+
												'</div>'+
												'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
													'<div class="form-group">'+
														'<label style="margin-bottom:0px;font-size: 13px;">Consignee`s ref <span style="color:red">*</span></label>'+
														'<input type="text" name="editr['+tempconsignee+'][0][consignee_reference]" value="" placeholder="Consignee`s reference" class="form-control consignee_reference">'+
													'</div>'+
												'</div>'+
												'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
													'<div class="form-group">'+
														'<label style="margin-bottom:0px;font-size: 13px;">Delivery date</label>'+
														'<input id="unloaddt" type="text" value="'+data.unloaddate+'" name="editr['+tempconsignee+'][0][delivery_date]" value="" placeholder="Delivery date" class="form-control" readonly>'+
													'</div>'+
												'</div>'+
											'</div>';

		}
		else
		{
			$.each(consigneedata, function (index, value) {
				if(index > 0){
					setminus2 = '<a style="bottom: 0px; float: right; font-size: 33px; font-weight: bold;" type="" class="consignee_remove getconsignee_0">-</a>';
				}
				consigneetab += '<div class="consignee_copy" data-number="0">'+
									'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
										'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
											'<a style="bottom:0px;float: right;font-size: 33px;font-weight: bold;" type="" class="consignee_addmore getconsignee_0">+</a>'+setminus2+
										'</div>'+
										
										'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
											'<label style="margin-bottom:0px;font-size: 13px;">Consignee</label>'+
											
											'<input id="condiedit0" type="text" class="form-control consignee" name="editr['+tempconsignee+']['+consigneename+'][consignee]" readonly>'+
											'</div>'+
									'</div>'+
									'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
										'<div class="form-group">'+
											'<label style="margin-bottom:0px;font-size: 13px;">Consignee add <span style="color:red">*</span></label>'+
											
											'<input type="text" class="form-control consignee_address" value="'+value.consignee_address+'" name="editr['+tempconsignee+']['+consigneename+'][consignee_address]" >'+
											'</div>'+
									'</div>'+
									'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
										'<div class="form-group">'+
											'<label style="margin-bottom:0px;font-size: 13px;">Consignee`s ref <span style="color:red">*</span></label>'+
											'<input type="text" name="editr['+tempconsignee+']['+consigneename+'][consignee_reference]" value="'+value.consignee_reference+'" placeholder="Consignee`s reference" class="form-control consignee_reference">'+
										'</div>'+
									'</div>'+
									'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
										'<div class="form-group">'+
											'<label style="margin-bottom:0px;font-size: 13px;">Delivery date</label>'+
											'<input id="unloaddt" type="text" value="'+data.unloaddate+'" name="editr['+tempconsignee+']['+consigneename+'][delivery_date]" value="'+value.consignee_date+'" placeholder="Delivery date" class="form-control" readonly>'+
										'</div>'+
									'</div>'+
								'</div>';

				consigneename++;
				consignee_count2 = consigneename;
			});
			consignee_remove();
		}

		var loads= '<form class="form-horizontal formsubmit" method="POST" name="formsubmit" enctype="multipart/form-data" >'+
						'<div class="table-offers" style="">'+
							'<div class="tab tab_button">'+
							  '<button class="tablinks tabs_view active" data-name="tab_1" type="button">Load 1</button>'+
							'</div>'+
							'<div class="addmore_main">';
							var counter = files_count = 1;  
							
							loads +='<div id="tab_'+counter+'" class="tabcontent active" style="display:block">'+
								'<div class="" style="display: inline-block;">'+
									'<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">'+
										'<div class="form-group">'+
											'<label style="margin-bottom:0px;font-size: 13px;">Reference</label>'+
											'<input type="text" name="editr['+counter+'][reference]" value="'+data.id+'" placeholder="Reference" class="form-control" readonly style="">'+
											'<input type="hidden" name="loadid" class="loadid" value="'+data.id+'" readonly style="">'+
										'</div>'+
									'</div>'+
									'<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">'+
										'<div class="form-group">'+
											'<label style="margin-bottom:0px;font-size: 13px;">Status</label>'+
											'<select class="form-control select2" name="editr['+counter+'][status]">';
											if(data.salestatus == 'planned'){
											loads += '<option value="planned" selected>Planned</option>';	
											}
											else{
											loads += '<option value="planned">Planned</option>';		
											}
											if(data.salestatus == 'unplanned'){
											loads += '<option value="unplanned" selected>Unplanned</option>';	
											}
											else{
											loads += '<option value="unplanned">Unplanned</option>';		
											}
											if(data.salestatus == 'loaded'){
											loads += '<option value="loaded" selected>Loaded</option>';	
											}
											else{
											loads += '<option value="loaded">Loaded</option>';		
											}
											if(data.salestatus == 'delivered'){
											loads += '<option value="delivered" selected>Delivered</option>';	
											}
											else{
											loads += '<option value="delivered">Delivered</option>';		
											}
											if(data.salestatus == 'rejected'){
											loads += '<option value="rejected" selected>Rejected</option>';	
											}
											else{
											loads += '<option value="rejected">Rejected</option>';		
											}
											if(data.salestatus == 'ordered'){
											loads += '<option value="ordered" selected>ordered</option>';	
											}
											else{
											loads += '<option value="ordered">ordered</option>';		
											}
											loads +='</select>'+
										'</div>'+
									'</div>'+
									'<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">'+
										'<div class="form-group">'+
											'<label style="margin-bottom:0px;font-size: 13px;">Customer Name</label>'+
											'<input type="text" name="editr['+counter+'][customername]" value="'+data.customername+'" placeholder="Customer Name" class="form-control" style="">'+
											 '</div>'+
									'</div>'+
									'<div class="clearfix"></div>'+
									'<div class="row"><div id="shipper_repeater" class="col-md-12">'+
									'<div class="shipper_repeater_add">'+
									'<div class="col-md-6 transport_left" >'+
										'<div class="shipper_add">'+shippertab+
										'</div>'+
										'<div class="col-md-12 pull-left"></div>'+
										
										'<div class="consignee_add">'+consigneetab+											
										'</div>'+
										'<hr class="hr_line">'+
										
										'<div class="">'+
											'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
												'<div class="form-group">'+
													'<label style="margin-bottom:0px;font-size: 13px;">Freight cost <span style="color:red">*</span></label>'+
													'<input type="text" name="editr['+counter+'][freight_cost]" value="'+data.freight_cost+'" placeholder="Freight cost" class="form-control ">'+
												'</div>'+
											'</div>'+
											'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
												'<div class="form-group">'+
													'<label style="margin-bottom:0px;font-size: 13px;">Payment term <span style="color:red">*</span></label>'+
													'<input type="text" name="editr['+counter+'][payment_term]" value="'+data.payment_term+'" placeholder="Payment term" class="form-control ">'+
												'</div>'+
											'</div>'+
											'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
												'<div class="form-group">'+
													'<label style="margin-bottom:0px;font-size: 13px;">Payment type <span style="color:red">*</span></label>'+
													'<input type="text" name="editr['+counter+'][payment_type]" value="'+data.payment_type+'" placeholder="Payment type" class="form-control ">'+
												'</div>'+
											'</div>'+
										'</div>'+
										'<hr class="hr_line">'+
										'<div class="col-md-12 transport_left" style="padding-left: 5px;border-right:none;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Notes <span style="color:red">*</span></label>'+
												'<textarea name="editr['+counter+'][notes]" value="" class="form-control notes">'+data.notes+'</textarea>'+
											'</div>'+
										'</div>'+
									'</div>'+

									'<div class="col-md-6 transport_right">'+
										'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Goods</label>'+
												'<input type="text" name="editr['+counter+'][goods]" value="'+data.goods+'" placeholder="Goods" class="form-control t_date" readonly>'+
											'</div>'+
										'</div>'+
										'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Variety</label>'+
												'<input type="text" name="editr['+counter+'][variety]" value="'+data.variety+'" placeholder="Variety" class="form-control" readonly>'+
											'</div>'+
										'</div>'+
										'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Size</label>'+
												'<input type="text" name="editr['+counter+'][size]" value="'+data.size+'" placeholder="Size" class="form-control t_date" readonly>'+
											'</div>'+
										'</div>'+
										
										'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Loaded weight <span style="color:red">*</span></label>'+
												'<input type="text" name="editr['+counter+'][loaded_weight]" value="'+data.loaded_weight+'" placeholder="Loaded weight" class="form-control loaded_weight">'+
											'</div>'+
										'</div>'+
										'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Unloaded weight <span style="color:red">*</span></label>'+
												'<input type="text" name="editr['+counter+'][unloaded_weight]" value="'+data.unloaded_weight+'" placeholder="Unloaded weight" class="form-control unloaded_weight">'+
											'</div>'+
										'</div>'+
										'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Difference <span style="color:red">*</span></label>'+
												'<input type="text" name="editr['+counter+'][difference]" value="'+data.difference+'" placeholder="Difference" class="form-control difference">'+
											'</div>'+
										'</div>'+
										
										'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Packaging type <span style="color:red">*</span></label>'+
												'<input type="text" name="editr['+counter+'][packaging_type]" value="'+data.packaging_type+'" placeholder="Packaging type" class="form-control packaging_type">'+
											'</div>'+
										'</div>'+
										'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Number of packing units <span style="color:red">*</span></label>'+
												'<input type="text" name="editr['+counter+'][number_of_packing_units]" value="'+data.number_of_packing_units+'" placeholder="Number of packing units" class="form-control number_of_packing_units">'+
											'</div>'+
										'</div>'+
										'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Requirements<span style="color:red">*</span></label>'+
												'<input type="text" name="editr['+counter+'][requirements]" value="'+data.requirements+'" placeholder="Requirements" class="form-control requirements">'+
											'</div>'+
										'</div>'+
										'<hr class="hr_line">'+
									
										'<div class="">'+
											'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
												'<div class="form-group">'+
													'<label style="margin-bottom:0px;font-size: 13px;">Transport invoice number <span style="color:red">*</span></label>'+
													'<input type="text" name="editr['+counter+'][transport_invoice_number]" value="'+data.invoice_no+'" placeholder="Transport invoice number" class="form-control transport_invoice_number">'+
												'</div>'+
											'</div>'+

											'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
												'<div class="form-group">'+
													'<label style="margin-bottom:0px;font-size: 13px;">Transport invoice due date <span style="color:red">*</span></label>'+
													'<input type="text" name="editr['+counter+'][transport_invoice_due_date]" value="'+data.due_date+'" placeholder="Transport invoice due date" class="form-control transport_invoice_due_date datepickr">'+
												'</div>'+
											'</div>'+
											'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
												'<div class="form-group">'+
													'<label style="margin-bottom:0px;font-size: 13px;">Payment status <span style="color:red">*</span></label>'+
													'<input type="text" name="editr['+counter+'][payment_status]" value="'+data.payment_status+'" placeholder="Payment status" class="form-control payment_status">'+
												'</div>'+
											'</div>'+
											'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
												'<div class="form-group">'+
													'<label style="margin-bottom:0px;font-size: 13px;">Notes from accounting <span style="color:red">*</span></label>'+
													'<input type="text" name="editr['+counter+'][notes_from_accounting]" value="'+data.account_note+'" placeholder="Notes from accounting" class="form-control notes_from_accounting">'+
												'</div>'+
											'</div>'+
											'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
												'<div class="form-group">'+
													'<label style="margin-bottom:0px;font-size: 13px;">Documents</label>'+
													'<a href="javascript:void(0)" data-toggle="modal" data-target="#linkModal'+data.id+'"  class="btn btn-info all-doc">Documents</a>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
									'<div id="linkModal'+data.id+'" class="modal fade" role="dialog" style="opacity:1;">'+
									
									'<div class="modal-dialog modal-dialog-large modal-dialog-centered" role="document">'+
									'<div class="modal-content">'+
									'<div class="modal-header">'+
									'<h4 class="modal-title">Document List</h4>'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+        
									'</div>'+
									'<div class="modal-body" id="link_details">'+
									'<div class="col-md-12 pull-left">'+
									'<div class="col-md-6 pull-left">'+
									'<label style="margin-bottom:0px;font-size: 13px;">CMR</label>'+
									
									
									'<div class="input-group input-file" name="editr[cmr]">'+
										'<span class="input-group-prepend">'+
											'<button class="btn btn-info btn-choose" type="button">Choose</button>'+
										'</span>'+
										'<input type="text" class="form-control" placeholder="Choose a file..." />'+
										'<span class="input-group-append">'+
											'<button class="btn btn-danger btn-reset" type="button">Reset</button>'+
										'</span>'+
									'</div>'+
									
									
									'</div>'+
									'<div class="col-md-6 pull-left">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Invoice</label>'+
									
									'<div class="input-group input-file" name="editr[invoice]">'+
										'<span class="input-group-prepend">'+
											'<button class="btn btn-info btn-choose" type="button">Choose</button>'+
										'</span>'+
										'<input type="text" class="form-control" placeholder="Choose a file..." />'+
										'<span class="input-group-append">'+
											'<button class="btn btn-danger btn-reset" type="button">Reset</button>'+
										'</span>'+
									'</div>'+
									'</div>'+
									'<div class="col-md-6 pull-left">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Weightbridge</label>'+
									
									'<div class="input-group input-file" name="editr[weightbridge]">'+
										'<span class="input-group-prepend">'+
											'<button class="btn btn-info btn-choose" type="button">Choose</button>'+
										'</span>'+
										'<input type="text" class="form-control" placeholder="Choose a file..." />'+
										'<span class="input-group-append">'+
											'<button class="btn btn-danger btn-reset" type="button">Reset</button>'+
										'</span>'+
									'</div>'+
									'</div>'+
									'<div class="col-md-6 pull-left">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Other</label>'+
									
									'<div class="input-group input-file" name="editr[other]">'+
										'<span class="input-group-prepend">'+
											'<button class="btn btn-info btn-choose" type="button">Choose</button>'+
										'</span>'+
										'<input type="text" class="form-control" placeholder="Choose a file..." />'+
										'<span class="input-group-append">'+
											'<button class="btn btn-danger btn-reset" type="button">Reset</button>'+
										'</span>'+
									'</div>'+
									'</div>'+
									'<div class="col-md-12 pull-left"><br/></div>'+
									'<div class="col-md-12 pull-left">';
									if(data.cmr1!='' || data.invoice1!='' || data.weightfile1!='' || data.other1!=''){
									loads += '<label style="margin-bottom:0px;font-size: 13px;">Download File</label>';	
									}
									
									if(data.cmr1!=''){
										loads += '<div class="download_file_name">CMR: <a href="/images/transportlist/'+data.cmr1+'" download><img class="trasport_documents" src="/images/transportlist/'+data.cmr1+'"><br/>'+data.cmr1+'</img></a></div>';
										files_count++;
									}
									if(data.invoice1!='')
									{
										loads += '<div class="download_file_name">Invoice: <a href="/images/transportlist/'+data.invoice1+'" download><img  class="trasport_documents" src="/images/transportlist/'+data.invoice1+'"><br/>'+data.invoice1+'</img></a></div>';
										files_count++;
									}
									if(data.weightfile1!='')
									{
										loads += '<div class="download_file_name">Weight: <a href="/images/transportlist/'+data.weightfile1+'" download><img  class="trasport_documents" src="/images/transportlist/'+data.weightfile1+'"><br/>'+data.weightfile1+'</img></a></div>';
										files_count++;
									}
									if(data.other1!='')
									{
										loads +='<div class="download_file_name">Other: <a href="/images/transportlist/'+data.other1+'" download><img class="trasport_documents" src="/images/transportlist/'+data.other1+'"><br/>'+data.other1+'</img></a></div>';
										files_count++;
									}
									loads +='</div>';
									loads +='<div class="col-md-12 pull-left">';
									if(files_count>1)
									{
										loads +='<label style="margin-bottom:0px;font-size: 13px;">Download All</label>'+
									'<a href="#" class="downloadall" data-id="'+data.id+'">All files</a>';
									}
									loads +='</div></div>'+
									'<div class="modal-footer">';
									
									
									loads +='<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
									'</div></div></div></div>'+
									
									'</div>'+
									'</div></div>'+
									'<div class="col-md-12"></div>'+
									
								'</div>'+
							'</div>';
							counter++;
							var carrierlist = JSON.parse('@json($carrieroptions)');
							//console.log(loadstatus);
							 var selectOpt = '';
							$.each(carrierlist,function(key,value){
								if(data.carrier == value.id){
								selectOpt += '<option value="'+value.id+'" selected>'+value.name+'</option>'
								}
								else{
								selectOpt += '<option value="'+value.id+'">'+value.name+'</option>'	
								}
							});
							loads +='</div></div></div>'+
							
							'<div class="col-md-12"><br/></div>'+
							'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group" style="margin:0;">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Carrier</label>'+
									'<select name="editr[carrier]" value="'+data.carrier+'" class="form-control select2">'+selectOpt+
								'</select></div>'+
							'</div>'+

							'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Trailer type <span style="color:red">*</span></label>'+
									'<input type="text" name="editr[trailer_type]" value="'+data.trailer_type+'" placeholder="Trailer type" class="form-control trailer_type">'+
								'</div>'+
							'</div>'+
							'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Temperature <span style="color:red">*</span></label>'+
									'<input type="text" name="editr[temperature]" value="'+data.temperature+'" placeholder="Temperature" class="form-control temperature">'+
								'</div>'+
							'</div>'+
							
							'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Plate numbers <span style="color:red">*</span></label>'+
									'<input type="text" name="editr[plate_numbers]" value="'+data.plate_numbers+'" placeholder="Plate numbers" class="form-control plate_numbers">'+
								'</div>'+
							'</div>'+
							'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Driver`s name <span style="color:red">*</span></label>'+
									'<input type="text" name="editr[drivers_name]" value="'+data.drivers_name+'" placeholder="Driver`s name" class="form-control drivers_name">'+
								'</div>'+
							'</div>'+
							'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Driver`s phone number <span style="color:red">*</span></label>'+
									'<input type="text" name="editr[drivers_phone_number]" value="'+data.drivers_phone_number+'" placeholder="Driver`s phone number" class="form-control drivers_phone_number">'+
								'</div>'+
							'</div>'+
							
							'<div class="col text-right" style="margin-top: 10px;padding: 0;float: right;">'+
								'<button data-id="'+data.id+'" class="btn btn-success btn-md pull-right sendItem" type="submit" >Save & Send</button>  '+
								'<button data-id="2" class="btn btn-success btn-md pull-right" type="submit" >Save</button>  '+
								'<a href="/admin/transport/previewload/'+data.id+'" target="_blank" class="btn btn-success btn-md pull-right">Preview</a>  '+
								'<button class="btn btn-danger btn-md pull-right formcancel" type="button" >Cancel</button>'+
							'</div>'+
						'</div>'+
					'</form>';	
					 
		return loads;
		$(".datepickr").datepicker({
				format: "mm/dd/yyyy",
				weekStart: 0,
				calendarWeeks: true,
				autoclose: true,
			});	
		
	}
	
	
	function ajax_saveloads()
	{
		$(".datepickr").datepicker({
				format: "mm/dd/yyyy",
				weekStart: 0,
				calendarWeeks: true,
				autoclose: true,
			});
		$('.formsubmit').on('submit', function(event) {
			event.preventDefault();
			if($('.loaded_weight').val() == ''){
				$('.loaded_weight').parent().addClass('has-danger');
				$('.loaded_weight').addClass('is-invalid');
			}else{
			$('.loaded_weight').removeClass('is-invalid');	
			}
			if($('.unloaded_weight').val() == ''){
				$('.unloaded_weight').parent().addClass('has-danger');
				$('.unloaded_weight').addClass('is-invalid');
			}else{
			$('.unloaded_weight').removeClass('is-invalid');	
			}
			if($('.difference').val() == ''){
				$('.difference').parent().addClass('has-danger');
				$('.difference').addClass('is-invalid');
			}else{
			$('.difference').removeClass('is-invalid');	
			}
			if($('.packaging_type').val() == ''){
				$('.packaging_type').parent().addClass('has-danger');
				$('.packaging_type').addClass('is-invalid');
			}else{
			$('.packaging_type').removeClass('is-invalid');	
			}
			if($('.number_of_packing_units').val() == ''){
				$('.number_of_packing_units').parent().addClass('has-danger');
				$('.number_of_packing_units').addClass('is-invalid');
			}else{
			$('.number_of_packing_units').removeClass('is-invalid');	
			}
			if($('.freight_cost').val() == ''){
				$('.freight_cost').parent().addClass('has-danger');
				$('.freight_cost').addClass('is-invalid');
			}else{
			$('.freight_cost').removeClass('is-invalid');	
			}
			if($('.payment_term').val() == ''){
				$('.payment_term').parent().addClass('has-danger');
				$('.payment_term').addClass('is-invalid');
			}else{
			$('.payment_term').removeClass('is-invalid');	
			}
			if($('.payment_type').val() == ''){
				$('.payment_type').parent().addClass('has-danger');
				$('.payment_type').addClass('is-invalid');
			}else{
			$('.payment_type').removeClass('is-invalid');	
			}
			if($('.transport_invoice_number').val() == ''){
				$('.transport_invoice_number').parent().addClass('has-danger');
				$('.transport_invoice_number').addClass('is-invalid');
			}else{
			$('.transport_invoice_number').removeClass('is-invalid');	
			}
			if($('.transport_invoice_due_date').val() == ''){
				$('.transport_invoice_due_date').parent().addClass('has-danger');
				$('.transport_invoice_due_date').addClass('is-invalid');
			}else{
			$('.transport_invoice_due_date').removeClass('is-invalid');	
			}
			if($('.payment_status').val() == ''){
				$('.payment_status').parent().addClass('has-danger');
				$('.payment_status').addClass('is-invalid');
			}else{
			$('.payment_status').removeClass('is-invalid');	
			}
			if($('.notes').val() == ''){
				$('.notes').parent().addClass('has-danger');
				$('.notes').addClass('is-invalid');
			}else{
			$('.notes').removeClass('is-invalid');	
			}
			
			if($('.shippers_reference').val() == ''){
				$('.shippers_reference').parent().addClass('has-danger');
				$('.shippers_reference').addClass('is-invalid');
			}else{
			$('.shippers_reference').removeClass('is-invalid');	
			}
			 
			 
			if($('.consignee_address').val() == ''){
				$('.consignee_address').parent().addClass('has-danger');
				$('.consignee_address').addClass('is-invalid');
			}else{
			$('.consignee_address').removeClass('is-invalid');	
			}
			if($('.consignee_reference').val() == ''){
				$('.consignee_reference').parent().addClass('has-danger');
				$('.consignee_reference').addClass('is-invalid');
			}else{
			$('.consignee_reference').removeClass('is-invalid');	
			}
			 
			if($('.trailer_type').val() == ''){
				$('.trailer_type').parent().addClass('has-danger');
				$('.trailer_type').addClass('is-invalid');
			}else{
			$('.trailer_type').removeClass('is-invalid');	
			}
			if($('.temperature').val() == ''){
				$('.temperature').parent().addClass('has-danger');
				$('.temperature').addClass('is-invalid');
			}else{
			$('.temperature').removeClass('is-invalid');	
			}
			if($('.plate_numbers').val() == ''){
				$('.plate_numbers').parent().addClass('has-danger');
				$('.plate_numbers').addClass('is-invalid');
			}else{
			$('.plate_numbers').removeClass('is-invalid');	
			}
			if($('.drivers_name').val() == ''){
				$('.drivers_name').parent().addClass('has-danger');
				$('.drivers_name').addClass('is-invalid');
			}else{
			$('.drivers_name').removeClass('is-invalid');	
			}
			if($('.drivers_phone_number').val() == ''){
				$('.drivers_phone_number').parent().addClass('has-danger');
				$('.drivers_phone_number').addClass('is-invalid');
			}else{
			$('.drivers_phone_number').removeClass('is-invalid');	
			}
			if($('.requirements').val() == ''){
				$('.requirements').parent().addClass('has-danger');
				$('.requirements').addClass('is-invalid');
			}else{
			$('.requirements').removeClass('is-invalid');	
			}
			if($('.notes_from_accounting').val() == ''){
				$('.notes_from_accounting').parent().addClass('has-danger');
				$('.notes_from_accounting').addClass('is-invalid');
			}else{
			$('.notes_from_accounting').removeClass('is-invalid');	
			}
		if($('.loaded_weight').val() == '' || $('.unloaded_weight').val() == '' || $('.difference').val() == '' || $('.packaging_type').val() == '' || $('.packaging_type').val() == '' || $('.number_of_packing_units').val() == '' || $('.freight_cost').val() == '' || $('.payment_term').val() == '' || $('.payment_type').val() == '' || $('.transport_invoice_number').val() == '' || $('.transport_invoice_due_date').val() == '' || $('.payment_status').val() == '' || $('.notes').val() == '' || $('.shipper_address').val() == '' || $('.shippers_reference').val() == '' || $('.consignee_address').val() == '' || $('.consignee_reference').val() == '' || $('.trailer_type').val() == '' || $('.temperature').val() == '' || $('.plate_numbers').val() == '' || $('.drivers_name').val() == '' || $('.drivers_phone_number').val() == '' || $('.requirements').val() == '' || $('.notes_from_accounting').val() == ''){
			Swal.fire('Error!', 'Fill required (*) fields.', 'error');return false;
		}
			var remove_form = $(this);
			$('.has-danger').next().children().children().css({"border": ""});
			$('.is-invalid').removeClass("is-invalid");
			$('.invalid-feedback').html("");
			$('.has-danger').removeClass("has-danger");
			var loadid = $(this).find('.loadid').val();
			var formData = new FormData(this);
			formData.append('_method', 'POST');
			//console.log($(this).find('.loadid').val());
			$.ajax({
				url: "{{ route('admin.transportlist.updatetransportloadsajax')}}",
				method: 'POST',
				data: formData,
				contentType: false,							
				cache: false,
				processData: false,
				dataType: "json",
				beforeSend: function(){
					$('.loading').removeClass('loading_hide');
				},
				success: function(data)
				{
					$('.loading').addClass('loading_hide');
					if (data.status == 'success') {
                    $('.loading').addClass('loading_hide');
                    Swal.fire('Success!', data.message, 'success');
					remove_form.parents('tr').remove();
                    setTimeout(function() {
                        window.location.reload;
                    }, 500);
                }
				if(data.status == 'error'){
					Swal.fire('Error!', data.message, 'error');
					$('.btn-success').removeAttr('disabled');
				}
				},
			error :function( data ) {
				$('.loading').addClass('loading_hide');
				if( data.status === 422 ) {
					Swal.fire('Error!', 'Fill required (*) fields.', 'error');
					$('.btn-success').removeAttr('disabled');
					var errors = [];
					errors = data.responseJSON.errors
					console.log(errors);
					$.each(errors, function (key, value) {
						$('.'+key).parent().addClass('has-danger');
						$('.'+key).addClass('is-invalid');
						$('.'+key).parent('.has-danger').find('.invalid-feedback').html(value);
						$('.'+key).next().children().children().css({"border": "1px solid #f86c6b"});
					})
				}
			}
			});
		});	
		
		$('body').on('click', '.sendItem', function (event) {
			$.ajax({
				type: "POST",
				url: "{{ route('admin.transportlist.sendloadpdf') }}",
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {id:$(this).data("id")},
				beforeSend: function(){
					$('.loading').removeClass('loading_hide');
				},
				success: function (data) {
					$('.loading').addClass('loading_hide');
					
					var shipperdataArry = data.shipperdata;
					var consigneedataArry = data.consigneedata; 		
					//console.log(shipperdataArry);
					$.each(data.transdata, function (index, value) {
					  //$('#results').append('<p>'+value+'</p>');
						create_loads(value,currentobj,shipperdataArry,consigneedataArry);
					//	console.log(value);
					});
				}
				 
			});
			
			
	});
		$('.formcancel').on('click', function(event) {
			 event.preventDefault();
			 //window.location.reload();
			 $(this).parents('tr').remove();
		});
	}
	
	
	function repeater_field()
	{
		var shippername = $('#shipperedit0').val();	
		var consiname = $('#condiedit0').val();	
		var loddate = $('#loaddt').val();	
		var unloddate = $('#unloaddt').val();	
		$('.shipper_addmore').on("click", function(e) {
				$('#'+$('.tablinks.active').attr('data-name')+' .shipper_add').append('<div class="shipper_copy" data-number="'+shipper_count2+'">'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
			'<a style="bottom: 0px; float: right; font-size: 33px; font-weight: bold;" type="" class="shipper_remove getshipper_0">-</a>'+
		'</div>'+
		'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Shipper</label>'+
			'<input type="text" value="'+shippername+'" class="form-control shipper" name="editr['+name_arrc+']['+shipper_count2+'][shipper]" readonly>'+
			'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Shipping add <span style="color:red">*</span></label>'+
			
			'<input type="text" class="form-control shipping_address" name="editr['+name_arrc+']['+shipper_count2+'][shipping_address]">'+
			'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Shipper`s ref <span style="color:red">*</span></label>'+
			'<input type="text" name="editr['+name_arrc+']['+shipper_count2+'][shippers_reference]" value="" placeholder="Shipper`s reference" class="form-control shippers_reference">'+
		'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Shipping date</label>'+
			'<input type="text" value="'+loddate+'" name="editr['+name_arrc+']['+shipper_count2+'][shipping_date]" value="" placeholder="Shipping date" class="form-control" style="height: auto;padding: 0.28rem 0.75rem;" readonly>'+
		'</div>'+
	'</div>'+
	'<div class="col-md-12 pull-left"></div>'+
'</div>');
			$('.select2').select2();
			shipper_count2++;
			shipper_remove()
		});
			
			
		$('.consignee_addmore').on("click", function(e) {
				$('#'+$('.tablinks.active').attr('data-name')+' .consignee_add').append('<div class="consignee_copy">'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
			'<a style="bottom: 0px; float: right; font-size: 33px; font-weight: bold;" type="" class="consignee_remove getconsignee_0">-</a>'+
		'</div>'+
		
		'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Consignee</label>'+
			
			'<input type="text" value="'+consiname+'" class="form-control consignee" name="editr['+name_arrc+']['+consignee_count2+'][consignee]" tabindex="-1" aria-hidden="true" readonly>'+
			'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Consignee add <span style="color:red">*</span></label>'+
			
			'<input type="text" class="form-control consignee_address" name="editr['+name_arrc+']['+consignee_count2+'][consignee_address]" aria-hidden="true" >'+
			'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Consignee`s ref <span style="color:red">*</span></label>'+
			'<input type="text" name="editr['+name_arrc+']['+consignee_count2+'][consignee_reference]" value="" placeholder="Consignee`s reference" class="form-control consignee_reference">'+
		'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Delivery date</label>'+
			'<input type="text" value="'+unloddate+'" name="editr['+name_arrc+']['+consignee_count2+'][delivery_date]" value="" placeholder="Delivery date" class="form-control" readonly>'+
		'</div>'+
	'</div>'+
'</div>');
			$('.select2').select2();
			consignee_count2++;
			consignee_remove();
		});
	}
			
	function shipper_remove()
	{
		$('.shipper_remove').on("click", function(e) {
			$(this).parents('.shipper_copy').remove();
		});
	}
	function consignee_remove()
	{
		$('.consignee_remove').on("click", function(e) {
			$(this).parents('.consignee_copy').remove();
		});
	}
	 
});
</script>

<script>
function bs_input_file() {
	$(".input-file").before(
		function() {
			if ( ! $(this).prev().hasClass('input-ghost') ) {
				var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0;position: absolute;'>");
				element.attr("name",$(this).attr("name"));
				element.change(function(){
					element.next(element).find('input').val((element.val()).split('\\').pop());
				});
				$(this).find("button.btn-choose").click(function(){
					element.click();
				});
				$(this).find("button.btn-reset").click(function(){
					element.val(null);
					$(this).parents(".input-file").find('input').val('');
				});
				$(this).find('input').css("cursor","pointer");
				$(this).find('input').mousedown(function() {
					$(this).parents('.input-file').prev().click();
					return false;
				});
				return element;
			}
		}
	);
}  
$(function() {
	bs_input_file();
});

function downloadall(){
	$('.downloadall').on("click", function(e) {
		e.preventDefault();
		var download_id = $(this).attr('data-id');
		$.ajax({
			type: "POST",
			url: "{{ route('admin.transportlist.downloadzip') }}",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: {transport_id:download_id},
			//responseType:'blob',
			xhrFields: {
				responseType: 'blob'
			},
			success: function (data) {
			  //window.location = data;
				var a = document.createElement('a');
            var url = window.URL.createObjectURL(data);
            a.href = url;
            //a.download = 'abc.zip';
            document.body.append(a);
            a.click();
            a.remove();
			
            window.URL.revokeObjectURL(url);
			}	 
		});
	});
}
</script>

@endpush
