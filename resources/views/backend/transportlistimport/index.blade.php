@extends('backend.layouts.app')
@section('title', 'Transport List :: ' . app_name())
@php $route_pre = 'admin'; @endphp
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
                    Transport Import  List <small class="text-muted"></small>
                </h4>
            </div><!--col-->
			@role('administrator')
            <div class="col-md-7">		 
                <div class="btn-toolbar float-right" role="toolbar" >
                  <a href="javascript:void(0)" data-toggle="modal" data-target="#uploadExcel" class="btn btn-primary ml-1"  title="Upload Excel">Upload Excel <i class="fa fa-upload"></i></a>                
				</div>
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
                             
                             	<th>Id</th>
                                <th>Reference</th>
                                <th>Status</th>
                                <th>Loading Date</th>
                                <th>Unloading Date</th>
                                <th>Consignor Loader Customer</th>
                                <th>Loading Point</th>
                                <th>Unloading Point</th>
                                <th>Customer</th>
                                <th>Gross Weight</th>
                                <th>Net Weight</th>
                                <th>Unloaded Weight</th>
                                <th>Payweight</th>
                                <th>Diff</th>
                                <th>No Pack</th>
                                <th>Temp</th>
                                <th>Kind Of Trailer</th>
                                <th>Truck Plates</th>
                                <th>Container No</th>
                                <th>Load ETA</th>
                                <th>Del ETA</th>
                                <th>Driver Phone Number</th>
                                <th>Carrier</th>
                                <th>Variety</th>
                                <th>Kind Of Cargo</th>
                                <th>Payment For Transport</th>
                                <th>Transport Cost</th>
                                <th>Pln Transport</th>
                                <th>Notices</th>
                                <th>CMR</th>
                                <th>Transport Invoice</th>
                                <th>Transport Invoice UK</th>
                                <th>Sales Invoice</th>
                                <th>Sales Price</th>
                                <th>Payment Period</th>
                                <th>Purchase Invoice</th>
                                <th>Paid</th>
                                <th>Purchase Rate</th>
                                <th>Date Purchase Invoice</th>
                                <th>Transport Payment Term</th>
                                <th>Carrier Documents</th>
                                <th>Order</th>
							
                        </tr>
                        </thead>
                        <tfoot>
                            <tr id="filter">
							 
                                <th data-title="Id"></th>
                                <th data-title="Reference"></th>
                                <th data-title="Status"></th>
                                <th data-title="Loading Date"></th>
                                <th data-title="Unloading Date"></th>
                                <th data-title="Consignor Loader Customer"></th>
                                <th data-title="Loading Point"></th>
                                <th data-title="Unloading Point"></th>
                                <th data-title="Customer"></th>
                                <th data-title="Gross Weight"></th>
                                <th data-title="Net Weight"></th>
                                <th data-title="Unloaded Weight"></th>
                                <th data-title="Payweight"></th>
                                <th data-title="Diff"></th>
                                <th data-title="No Pack"></th>
                                <th data-title="Temp"></th>
                                <th data-title="Kind Of Trailer"></th>
                                <th data-title="Truck Plates"></th>
                                <th data-title="Container No"></th>
                                <th data-title="Load ETA"></th>
                                <th data-title="Del ETA"></th>
                                <th data-title="Driver Phone Number"></th>
                                <th data-title="Carrier"></th>
                                <th data-title="Variety"></th>
                                <th data-title="Kind Of Cargo"></th>
                                <th data-title="Kind Of Payment For Transport"></th>
                                <th data-title="Transport Cost"></th>
                                <th data-title="Pln Transport"></th>
                                <th data-title="Notices"></th>
                                <th data-title="CMR"></th>
                                <th data-title="Transport Invoice"></th>
                                <th data-title="Transport Invoice UK"></th>
                                <th data-title="Sales Invoice"></th>
                                <th data-title="Sales Price"></th>
                                <th data-title="Payment Period"></th>
                                <th data-title="Purchase Invoice"></th>
                                <th data-title="Paid"></th>
                                <th data-title="Purchase Rate"></th>
                                <th data-title="Date Purchase Invoice"></th>
                                <th data-title="Transport Payment Term"></th>
                                <th data-title="Carrier Documents"></th>
                                <th data-title="Order"></th>
 
            
         
							
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
				url:"{{ route('admin.uploadExcelFile')}}",
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
		        	window.location.reload();
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
    setTimeout(()=>{
       
    var table = $('.data-table').DataTable({
		processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        ajax: {
            url: "{{ route($route_pre.'.getTransportList') }}",
            type: "POST"
        },
		//ajax: "{{ route($route_pre.'.transportlistimport.index') }}",
	    columns: [
            {data: 'id', name: 'id'},
            {data: 'reference', name: 'reference'},
            {data: 'status', name: 'status'},
            {data: 'loading_date', name: 'loading_date'},
            {data: 'unloading_date', name: 'unloading_date'},
            {data: 'consignorloadercustomer', name: 'consignorloadercustomer'},
            {data: 'loading_point', name: 'loading_point'},
            {data: 'unloading_point', name: 'unloading_point'},
            {data: 'customer', name: 'customer'},
            {data: 'gross_weight', name: 'gross_weight'},
            {data: 'nett_weight', name: 'nett_weight'},
            {data: 'unloaded_weight', name: 'unloaded_weight'},
            {data: 'payweight', name: 'payweight'},
            {data: 'diff', name: 'diff'},
            {data: 'no_pack', name: 'no_pack'},
            {data: 'temp', name: 'temp'},
            {data: 'kind_of_trailer', name: 'kind_of_trailer'},
            {data: 'truck_plates', name: 'truck_plates'},
            {data: 'container_no', name: 'container_no'},
            {data: 'load_eta', name: 'load_eta'},
            {data: 'del_eta', name: 'del_eta'},
            {data: 'driver_phone_number', name: 'driver_phone_number'},
            {data: 'carrier', name: 'carrier'},
            {data: 'variety', name: 'variety'},
            {data: 'kind_of_cargo', name: 'kind_of_cargo'},
            {data: 'kind_of_payment_for_transport', name: 'kind_of_payment_for_transport'},
            {data: 'transport_cost', name: 'transport_cost'},
            {data: 'pln_transport', name: 'pln_transport'},
            {data: 'notices', name: 'notices'},
            {data: 'cmr', name: 'cmr'},
            {data: 'transport_invoice', name: 'transport_invoice'},
            {data: 'transport_invoice_uk', name: 'transport_invoice_uk'},
            {data: 'sales_invoice', name: 'sales_invoice'},
            {data: 'sales_price', name: 'sales_price'},
            {data: 'payment_period', name: 'payment_period'},
            {data: 'purchase_invoice', name: 'purchase_invoice'},
            {data: 'paid', name: 'paid'},
            {data: 'purchase_rate', name: 'purchase_rate'},
            {data: 'date_od_purchase_invoice', name: 'date_od_purchase_invoice'},
            {data: 'transport_payment_term', name: 'transport_payment_term'},
            {data: 'carrier_documents', name: 'carrier_documents'},
            {data: 'order', name: 'order'}			
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
      $('.data-table').on( 'page.dt', function () {
    var info = table.page.info();
    	console.log("info",info);
	} );
	
	},3000);
  
    
		
	
	
	
	
	
			
	
	 
});
</script>



@endpush
