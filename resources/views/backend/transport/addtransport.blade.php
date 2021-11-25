@extends('backend.layouts.app') 
@section('title', 'Add transport :: ' . app_name()) 
@section('content') @stack('before-styles') {{ style('css/bootstrap-datetimepicker.css') }} {{ style('css/bootstrap-clockpicker.min.css') }} @stack('after-styles')
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                    Create Load<small class="text-muted"></small>
                </h4>
                </div>
                <!--col-->

            </div>
            <!--row-->
            <div class="row mt-2 transport_maindiv">
                <div class="col">
					<form class="form-horizontal" name="add_transport" id="add_transport" method="POST" action="#" enctype="multipart/form-data">
						@csrf
						<div class="table-offers" style="">
							
							<button style=" bottom:0px; left:15px;" type="button" class="addmore btn btn-success btn-md">+</button>
							<div class="tab tab_button">
							  <button class="tablinks tabs_view active" data-name="tab_1" type="button">Load 1</button>
							</div>
		
							<div class="addmore_main">
							<div id="tab_1" class="tabcontent active" style="display:block;">
								<div class="" style="display: inline-block;">
									<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">
										<div class="form-group">
											<label style="margin-bottom:0px;font-size: 13px;">Reference</label>
											<input type="text" name="editr[0][reference]" value="1" placeholder="Reference" class="form-control" readonly style="">
										</div>
									</div>
									<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">
										<div class="form-group">
											<label style="margin-bottom:0px;font-size: 13px;">Status</label>
											<select class="form-control select2" name="editr[0][status]">
												<option value="planned">Planned</option>
												<option value="unplanned">Unplanned</option>	
												<option value="loaded">Loaded</option>	
												<option value="delivered">Delivered</option>	
												<option value="rejected">Rejected</option>	
												<option value="ordered">ordered</option>
											</select>
										</div>
									</div>
									<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">
										<div class="form-group">
											<label style="margin-bottom:0px;font-size: 13px;">Customer Name</label>
											<input type="text" name="editr[0][customername]" value="Veg King" placeholder="Customer Name" class="form-control customername">
										</div>
									</div>
									<div class="col-md-12"></div>
									<div id="shipper_repeater">
									<div class="shipper_repeater_add">
									<div class="col-md-6 transport_left" >
										<div class="shipper_add">
											<div class="shipper_copy" data-number="0">
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">
														<a style="bottom:0px;float: right;font-size: 33px;font-weight: bold;" type="" class="shipper_addmore getshipper_0">+</a>
													</div>
													<div class="col-md-11 pull-left form-group" style="padding: 0;">
														<label style="margin-bottom:0px;font-size: 13px;">Shipper <span style="color:red">*</span></label>
														<input type="text" placeholder="Shipper Name address" class="form-control shipper" name="editr[0][0][shipper]">
														</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Shipping add <span style="color:red">*</span></label>
														
														<input type="text" placeholder="Shipper address" class="form-control shipping_address" name="editr[0][0][shipping_address]" >
														</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Shipper`s ref <span style="color:red">*</span></label>
														<input type="text" name="editr[0][0][shippers_reference]" value="" placeholder="Shipper`s reference" class="form-control shippers_reference">
													</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Shipping date <span style="color:red">*</span></label>
														<input type="text" name="editr[0][0][shipping_date]" value="" placeholder="Shipping date" class="form-control shipping_date datepickr" style="height: auto;padding: 0.28rem 0.75rem;">
													</div>
												</div>
												<div class="col-md-12 pull-left"></div>
											</div>
										</div>
										<div class="col-md-12 pull-left"></div>
										
										<div class="consignee_add">
											<div class="consignee_copy" data-number="0">
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">
														<a style="bottom:0px;float: right;font-size: 33px;font-weight: bold;" type="" class="consignee_addmore getconsignee_0">+</a>
													</div>
													
													<div class="col-md-11 pull-left form-group" style="padding: 0;">
														<label style="margin-bottom:0px;font-size: 13px;">Consignee <span style="color:red">*</span></label>
														
														<input type="text" placeholder="Consignee Name" class="form-control consignee" name="editr[0][0][consignee]">
														</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Consignee add <span style="color:red">*</span></label>
														
														<input type="text" placeholder="Consignee address" class="form-control consignee_address" name="editr[0][0][consignee_address]" >
														</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Consignee`s ref <span style="color:red">*</span></label>
														<input type="text" name="editr[0][0][consignee_reference]" value="" placeholder="Consignee`s reference" class="form-control consignee_reference">
													</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Delivery date <span style="color:red">*</span></label>
														<input type="text" name="editr[0][0][delivery_date]" value="" placeholder="Delivery date" class="form-control delivery_date datepickr">
													</div>
												</div>
											</div>
										</div>
										
										
										
										<hr class="hr_line">
										
									</div>

									<div class="col-md-6 transport_right">
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Goods</label>
												<select name="editr[0][goods]" value="" placeholder="Goods" class="form-control t_date">
												@foreach($products as $product)
												<option value="{{$product->id}}">{{$product->name}}</option>
												@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Variety <span style="color:red">*</span></label>
												<input type="text" name="editr[0][variety]" value="" placeholder="Variety" class="form-control variety">
												<div class="invalid-feedback"></div>
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Size <span style="color:red">*</span></label>
												<input type="text" name="editr[0][size]" value="" placeholder="Size" class="form-control size">
											</div>
										</div>
										
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Loaded weight <span style="color:red">*</span></label>
												<input type="text" name="editr[0][loaded_weight]" value="" placeholder="Loaded weight" class="form-control loaded_weight">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Unloaded weight <span style="color:red">*</span></label>
												<input type="text" name="editr[0][unloaded_weight]" value="" placeholder="Unloaded weight" class="form-control unloaded_weight">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Difference <span style="color:red">*</span></label>
												<input type="text" name="editr[0][difference]" value="" placeholder="Difference" class="form-control difference">
											</div>
										</div>
										
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Packaging type <span style="color:red">*</span></label>
												<input type="text" name="editr[0][packaging_type]" value="" placeholder="Packaging type" class="form-control packaging_type">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Number of packing units <span style="color:red">*</span></label>
												<input type="text" name="editr[0][number_of_packing_units]" value="" placeholder="Number of packing units" class="form-control number_of_packing_units">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Requirements <span style="color:red">*</span></label>
												<input type="text" name="editr[0][requirements]" value="" placeholder="Requirements" class="form-control requirements">
											</div>
										</div>
										<hr class="hr_line">
									</div>

									<div class=" col-md-12 pull-left"></div>
								   
									<div class="col-md-6 transport_left">
										
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Freight cost <span style="color:red">*</span></label>
												<input type="text" name="editr[0][freight_cost]" value="" placeholder="Freight cost" class="form-control freight_cost">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Payment term <span style="color:red">*</span></label>
												<input type="text" name="editr[0][payment_term]" value="" placeholder="Payment term" class="form-control payment_term">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Payment type <span style="color:red">*</span></label>
												<input type="text" name="editr[0][payment_type]" value="" placeholder="Payment type" class="form-control payment_type">
											</div>
										</div>
										<hr class="hr_line">
									</div>

									<div class="col-md-6 transport_right">
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Transport invoice number <span style="color:red">*</span></label>
												<input type="text" name="editr[0][transport_invoice_number]" value="" placeholder="Transport invoice number" class="form-control transport_invoice_number">
											</div>
										</div>

										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Transport invoice due date <span style="color:red">*</span></label>
												<input type="text" name="editr[0][transport_invoice_due_date]" value="" placeholder="Transport invoice due date" class="form-control transport_invoice_due_date datepickr">
											</div>
										</div>
										
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Payment status <span style="color:red">*</span></label>
												<input type="text" name="editr[0][payment_status]" value="" placeholder="Payment status" class="form-control payment_status">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Notes from accounting <span style="color:red">*</span></label>
												<input type="text" name="editr[0][notes_from_accounting]" value="" placeholder="Notes from accounting" class="form-control notes_from_accounting">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Documents</label>
												<a href="javascript:void(0)" class="btn btn-info all-doc" data-toggle="modal" data-target="#linkModal0">Documents</a>

											</div>
										</div>
									</div>
									
									</div>
									</div>
									<div class="col-md-12"></div>
									<div class="col-md-4 transport_left" style="padding-left: 5px;border-right:none;">
										<div class="form-group">
											<label style="margin-bottom:0px;font-size: 13px;">Notes <span style="color:red">*</span></label>
											<textarea name="editr[0][notes]" value="" class="form-control notes"></textarea>
										</div>
									</div>
								</div>
							</div>
							</div>
							
						<div class="col-md-12"><br/></div>	
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group" style="margin:0;">
								<label style="margin-bottom:0px;font-size: 13px;">Carrier <span style="color:red">*</span></label>
								<select name="editr[0][carrier]" value="" placeholder="Carrier" class="form-control select2 carrier">
								<option value="">Select Carrier</option>
								@foreach($carrieroptions as $carrier)
								<option value="{{$carrier->id}}">{{$carrier->name}}</option>
								@endforeach
								</select>
							</div>
						</div>

						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Trailer type <span style="color:red">*</span></label>
								<input type="text" name="editr[0][trailer_type]" value="" placeholder="Trailer type" class="form-control trailer_type">
							</div>
						</div>
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Temperature <span style="color:red">*</span></label>
								<input type="text" name="editr[0][temperature]" value="" placeholder="Temperature" class="form-control temperature">
							</div>
						</div>
						
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Plate numbers <span style="color:red">*</span></label>
								<input type="text" name="editr[0][plate_numbers]" value="" placeholder="Plate numbers" class="form-control plate_numbers">
							</div>
						</div>
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Driver`s name <span style="color:red">*</span></label>
								<input type="text" name="editr[0][drivers_name]" value="" placeholder="Driver`s name" class="form-control drivers_name">
							</div>
						</div>
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Driver`s phone number <span style="color:red">*</span></label>
								<input type="text" name="editr[0][drivers_phone_number]" value="" placeholder="Driver`s phone number" class="form-control drivers_phone_number">
							</div>
						</div>
						
							<div class="col text-right" style="margin-top: 10px;padding: 0;float: right;">
								<input class="btn btn-success btn-md pull-right createld" type="submit" value="Create"> 
							</div>
						</div>
						
						<!-- The Modal -->
						<div id="linkModal0" class="modal fade" role="dialog" style="opacity:1;">
						  <div class="modal-dialog modal-dialog-large modal-dialog-centered" role="document">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
							  <h4 class="modal-title">Document List</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								
							  </div>
							  <div class="modal-body" id="link_details">
								<div class="col-md-6 pull-left">
									<label style="margin-bottom:0px;font-size: 13px;">CMR</label><br/>
									<div class="input-group input-file" name="editr[0][cmr]">
										<span class="input-group-prepend">
											<button class="btn btn-info btn-choose" type="button">Choose</button>
										</span>
										<input type="text" class="form-control" placeholder="Choose a file..." />
										<span class="input-group-append">
											<button class="btn btn-danger btn-reset" type="button">Reset</button>
										</span>
									</div>
								</div>
								<div class="col-md-6 pull-left">
									<label style="margin-bottom:0px;font-size: 13px;">Invoice</label><br/>
									<div class="input-group input-file" name="editr[0][invoice]">
										<span class="input-group-prepend">
											<button class="btn btn-info btn-choose" type="button">Choose</button>
										</span>
										<input type="text" class="form-control" placeholder="Choose a file..." />
										<span class="input-group-append">
											<button class="btn btn-danger btn-reset" type="button">Reset</button>
										</span>
									</div>
								</div>
								<div class="col-md-6 pull-left">
									<label style="margin-bottom:0px;font-size: 13px;">Weightbridge</label><br/>
									<div class="input-group input-file" name="editr[0][weightbridge]">
										<span class="input-group-prepend">
											<button class="btn btn-info btn-choose" type="button">Choose</button>
										</span>
										<input type="text" class="form-control" placeholder="Choose a file..." />
										<span class="input-group-append">
											<button class="btn btn-danger btn-reset" type="button">Reset</button>
										</span>
									</div>
								</div>
								<div class="col-md-6 pull-left">
									<label style="margin-bottom:0px;font-size: 13px;">Other</label><br/>
									<div class="input-group input-file" name="editr[0][other]">
										<span class="input-group-prepend">
											<button class="btn btn-info btn-choose" type="button">Choose</button>
										</span>
										<input type="text" class="form-control" placeholder="Choose a file..." />
										<span class="input-group-append">
											<button class="btn btn-danger btn-reset" type="button">Reset</button>
										</span>
									</div>
								</div>
								
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>

						  </div>
						</div>
					</form>
                </div>
                <!--col-->
            </div>
            <!--row-->
        </div>
        <!--card-body-->
    </div>




<div id="confirm" class="modal hide fade" role="dialog" style="opacity:1;">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Are you sure want to delete?</h4>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
				<button type="button" data-dismiss="modal" class="btn">Cancel</button>
			</div>
		</div>
	</div>
</div>



    @endsection @push('after-scripts')

   
    
    <script type="text/javascript">
		
		
        $(function() 
		{
			var tab_count = 2;
			var name_arrc = 0;
			repeater_field();
			//var shipper_count1 = 0;
			var shipper_count2 = 1;
			//var consignee_count1 = 0;
			var consignee_count2 = 1;
			var productlist = JSON.parse('@json($products)');
							//console.log(loadstatus);
							 var selectpOpt = '';
							$.each(productlist,function(key,value){
							selectpOpt += '<option value="'+value.id+'">'+value.name+'</option>'	
								 
							});
			function repeater_field()
			{
				$('.shipper_addmore').on("click", function(e) {
					$('#'+$('.tablinks.active').attr('data-name')+' .shipper_add').append('<div class="shipper_copy" data-number="'+shipper_count2+'">'+
						'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
							'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
								'<a style="bottom: 0px; float: right; font-size: 33px; font-weight: bold;" type="" class="shipper_remove getshipper_0">-</a>'+
							'</div>'+
							'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
								'<label style="margin-bottom:0px;font-size: 13px;">Shipper <span style="color:red">*</span></label>'+
								'<input type="text" placeholder="Shipper name" class="form-control shipper" name="editr['+name_arrc+']['+shipper_count2+'][shipper]" >'+
								'</div>'+
						'</div>'+
						'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
							'<div class="form-group">'+
								'<label style="margin-bottom:0px;font-size: 13px;">Shipping add <span style="color:red">*</span></label>'+
								
								'<input type="text" placeholder="Shipper address" class="form-control shipping_address" name="editr['+name_arrc+']['+shipper_count2+'][shipping_address]">'+
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
								'<label style="margin-bottom:0px;font-size: 13px;">Shipping date <span style="color:red">*</span></label>'+
								'<input type="text" name="editr['+name_arrc+']['+shipper_count2+'][shipping_date]" value="" placeholder="Shipping date" class="form-control shipping_date datepickr" style="height: auto;padding: 0.28rem 0.75rem;">'+
							'</div>'+
						'</div>'+
						'<div class="col-md-12 pull-left"></div>'+
					'</div>');
					$('.select2').select2();
					shipper_count2++;
					shipper_remove();
					$(".datepickr").datepicker({
				format: "mm/dd/yyyy",
				weekStart: 0,
				calendarWeeks: true,
				autoclose: true,
			});
				});
			
			
				$('.consignee_addmore').on("click", function(e) {
					$('#'+$('.tablinks.active').attr('data-name')+' .consignee_add').append('<div class="consignee_copy">'+
						'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
							'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
								'<a style="bottom: 0px; float: right; font-size: 33px; font-weight: bold;" type="" class="consignee_remove getconsignee_0">-</a>'+
							'</div>'+
							
							'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
								'<label style="margin-bottom:0px;font-size: 13px;">Consignee <span style="color:red">*</span></label>'+
								
								'<input type="text" placeholder="Consignee name" class="form-control consignee" name="editr['+name_arrc+']['+consignee_count2+'][consignee]" tabindex="-1" aria-hidden="true">'+
								'</div>'+
						'</div>'+
						'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
							'<div class="form-group">'+
								'<label style="margin-bottom:0px;font-size: 13px;">Consignee add <span style="color:red">*</span></label>'+
								
								'<input type="text" placeholder="Consignee address" class="form-control consignee_address" name="editr['+name_arrc+']['+consignee_count2+'][consignee_address]" aria-hidden="true" >'+
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
								'<label style="margin-bottom:0px;font-size: 13px;">Delivery date <span style="color:red">*</span></label>'+
								'<input type="text" name="editr['+name_arrc+']['+consignee_count2+'][delivery_date]" value="" placeholder="Delivery date" class="form-control delivery_date datepickr">'+
							'</div>'+
						'</div>'+
					'</div>');
					$('.select2').select2();
					consignee_count2++;
					consignee_remove();
					$(".datepickr").datepicker({
				format: "mm/dd/yyyy",
				weekStart: 0,
				calendarWeeks: true,
				autoclose: true,
			});
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
			
			addmore();
			function addmore()
			{
				$('.addmore').on("click", function(e) 
				{
					name_arrc++;
					temp_counter = 1;
					
					//var get_prev_val = $('div.tab_button button:last-child').attr('data-name').replace ( /[^\d.]/g, '' )-1;
					var get_prev_val = $('.tablinks.active').attr('data-name').replace ( /[^\d.]/g, '' )-1;
					var active_tab = $('.tablinks.active').attr('data-name');

					$('.tab').append('<button class="tablinks tabs_view" data-name="tab_'+tab_count+'" type="button">Load '+tab_count+' <a href="#" class="tabremove"><i class="fas fa-times" ></i></a></button>');
					$('.tabcontent').hide();
					//$('.addmore_main').append('<div id="tab_'+tab_count+'" class="tabcontent">'+$('#tab_1').html()+'</div>');
					var add_div = '<div id="tab_'+tab_count+'" class="tabcontent">'+
						'<div class="" style="display: inline-block;">'+
							'<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Reference</label>'+
									'<input type="text" name="editr['+name_arrc+'][reference]" value="'+tab_count+'" placeholder="Reference" class="form-control" readonly style="">'+
								'</div>'+
							'</div>'+
							'<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Status</label>'+
									
									'<select class="form-control select2" name="editr['+name_arrc+'][status]">'+
												'<option value="planned">Planned</option>'+
												'<option value="unplanned">Unplanned</option>'+	
												'<option value="loaded">Loaded</option>'+	
												'<option value="delivered">Delivered</option>'+	
												'<option value="rejected">Rejected</option>'+
												'<option value="rejected">ordered</option>'+
									'</select>'+
								'</div>'+
							'</div>'+
							'<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Customer Name</label>'+
									'<input type="text" name="editr['+name_arrc+'][customername]" value="" placeholder="Customer Name" class="form-control customername">'+
								'</div>'+
							'</div>'+
							'<div class="col-md-12"></div>'+
							'<div id="shipper_repeater">'+
							'<div class="shipper_repeater_add">'+
							'<div class="col-md-6 transport_left" >'+
								'<div class="shipper_add">'+
									'<div class="shipper_copy">'+
										'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
												'<a style="bottom:0px;float: right;font-size: 33px;font-weight: bold;" type="" class="shipper_addmore getshipper_0">+</a>'+
											'</div>'+
											
											'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Shipper</label>'+
												
												'<input type="text" placeholder="shipper name" class="form-control shipper" name="editr['+name_arrc+'][0][shipper]" aria-hidden="true">'+
												'</div>'+
										'</div>'+
										'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Shipping add</label>'+
												
												'<input type="text" placeholder="shipper address" class="form-control shipping_address" name="editr['+name_arrc+'][0][shipping_address]">'+
												'</div>'+
										'</div>'+
										'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Shipper`s ref</label>'+
												'<input type="text" name="editr['+name_arrc+'][0][shippers_reference]" value="" placeholder="Shipper`s reference" class="form-control shippers_reference">'+

											'</div>'+
										'</div>'+
										'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Shipping date</label>'+
												'<input type="text" name="editr['+name_arrc+'][0][shipping_date]" value="" placeholder="Shipping date" class="form-control shipping_date datepickr" style="height: auto;padding: 0.28rem 0.75rem;">'+
											'</div>'+
										'</div>'+
										'<div class="col-md-12 pull-left"></div>'+
									'</div>'+
								'</div>'+	
								
								'<div class="col-md-12 pull-left"></div>'+
								'<div class="consignee_add">'+
									'<div class="consignee_copy">'+	
										'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
												'<a style="bottom:0px;float: right;font-size: 33px;font-weight: bold;" type="" class="consignee_addmore getconsignee_0">+</a>'+
											'</div>'+
											
											'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Consignee <span style="color:red">*</span></label>'+
												
												'<input type="text" placeholder="consignee name" class="form-control consignee" name="editr['+name_arrc+'][0][consignee]" >'+
												 '</div>'+
										'</div>'+
										'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Consignee add <span style="color:red">*</span></label>'+
												'<input type="text" placeholder="consignee address" class="form-control consignee_address" name="editr['+name_arrc+'][0][consignee_address]" >'+
												'</div>'+
										'</div>'+
										'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Consignee`s ref <span style="color:red">*</span></label>'+
												'<input type="text" name="editr['+name_arrc+'][0][consignee_reference]" value="" placeholder="Consignee`s reference" class="form-control consignee_reference">'+
											'</div>'+
										'</div>'+
										'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
											'<div class="form-group">'+
												'<label style="margin-bottom:0px;font-size: 13px;">Delivery date <span style="color:red">*</span></label>'+
												'<input type="text" name="editr['+name_arrc+'][0][delivery_date]" value="" placeholder="Delivery date" class="form-control delivery_date datepickr">'+
											'</div>'+
										'</div>'+
								'</div>'+
								'</div>'+
								
								'<hr class="hr_line">'+
								
							'</div>'+

							'<div class="col-md-6 transport_right">'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Goods</label>'+
										'<select name="editr['+name_arrc+'][goods]" value="" placeholder="Goods" class="form-control t_date">'+selectpOpt+
										'</select>'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Variety <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][variety]" value="'+$('[name="editr['+get_prev_val+'][variety]"]').val()+'" placeholder="Variety" class="form-control t_dropdown" >'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Size <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][size]" value="'+$('[name="editr['+get_prev_val+'][size]"]').val()+'" placeholder="Size" class="form-control t_date">'+
									'</div>'+
								'</div>'+
								
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Loaded weight <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][loaded_weight]" value="'+$('[name="editr['+get_prev_val+'][loaded_weight]"]').val()+'" placeholder="Loaded weight" class="form-control loaded_weight">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Unloaded weight <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][unloaded_weight]" value="'+$('[name="editr['+get_prev_val+'][unloaded_weight]"]').val()+'" placeholder="Unloaded weight" class="form-control unloaded_weight">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Difference <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][difference]" value="'+$('[name="editr['+get_prev_val+'][difference]"]').val()+'" placeholder="Difference" class="form-control difference">'+
									'</div>'+
								'</div>'+
								
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Packaging type <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][packaging_type]" value="'+$('[name="editr['+get_prev_val+'][packaging_type]"]').val()+'" placeholder="Packaging type" class="form-control packaging_type">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Number of packing units <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][number_of_packing_units]" value="'+$('[name="editr['+get_prev_val+'][number_of_packing_units]"]').val()+'" placeholder="Number of packing units" class="form-control number_of_packing_units">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Requirements <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][requirements]" value="'+$('[name="editr['+get_prev_val+'][requirements]"]').val()+'" placeholder="Requirements" class="form-control requirements">'+
									'</div>'+
								'</div>'+
								'<hr class="hr_line">'+
							'</div>'+

							'<div class="col-md-12 pull-left"></div>'+
						   
							'<div class="col-md-6 transport_left">'+
								
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Freight cost <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][freight_cost]" value="'+$('[name="editr['+get_prev_val+'][freight_cost]"]').val()+'" placeholder="Freight cost" class="form-control freight_cost">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Payment term <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][payment_term]" value="'+$('[name="editr['+get_prev_val+'][payment_term]"]').val()+'" placeholder="Payment term" class="form-control payment_term">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Payment type <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][payment_type]" value="'+$('[name="editr['+get_prev_val+'][payment_type]"]').val()+'" placeholder="Payment type" class="form-control payment_type">'+
									'</div>'+
								'</div>'+
								'<hr class="hr_line">'+
							'</div>'+

							'<div class="col-md-6 transport_right">'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Transport invoice number <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][transport_invoice_number]" value="'+$('[name="editr['+get_prev_val+'][transport_invoice_number]"]').val()+'" placeholder="Transport invoice number" class="form-control transport_invoice_number">'+
									'</div>'+
								'</div>'+

								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Transport invoice due date <span style="color:red">*</span></label>'+
										'<input type="date" name="editr['+name_arrc+'][transport_invoice_due_date]" value="'+$('[name="editr['+get_prev_val+'][transport_invoice_due_date]"]').val()+'" placeholder="Transport invoice due date" class="form-control transport_invoice_due_date">'+
									'</div>'+
								'</div>'+
								
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Payment status <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][payment_status]" value="'+$('[name="editr['+get_prev_val+'][payment_status]"]').val()+'" placeholder="Payment status" class="form-control payment_status">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Notes from accounting <span style="color:red">*</span></label>'+
										'<input type="text" name="editr['+name_arrc+'][notes_from_accounting]" value="'+$('[name="editr['+get_prev_val+'][notes_from_accounting]"]').val()+'" placeholder="Notes from accounting" class="form-control notes_from_accounting">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
									'<div class="form-group">'+
										'<label style="margin-bottom:0px;font-size: 13px;">Documents</label>'+
										'<a href="javascript:void(0)" class="btn btn-info all-doc" data-toggle="modal" data-target="#linkModal'+name_arrc+'">Documents</a>'+
									'</div>'+
								'</div>'+
							'</div>'+
							
							'</div>'+
							'</div>'+
							'<div class="col-md-12"></div>'+
							'<div class="col-md-4 transport_left" style="padding-left: 5px;border-right:none;">'+
								'<div class="form-group">'+
									'<label style="margin-bottom:0px;font-size: 13px;">Notes <span style="color:red">*</span></label>'+
									'<textarea name="editr['+name_arrc+'][notes]" value="'+$('[name="editr['+get_prev_val+'][notes]"]').val()+'" class="form-control notes"></textarea>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
					
					add_div += '<div id="linkModal'+name_arrc+'" class="modal fade" role="dialog" style="opacity:1;">'+
									'<div class="modal-dialog modal-dialog-large modal-dialog-centered" role="document">'+
									'<div class="modal-content">'+
									'<div class="modal-header">'+
									'<h4 class="modal-title">Document List</h4>'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+        
									'</div>'+
									'<div class="modal-body" id="link_details">'+
									'<div class=" pull-left">'+
									'<div class="col-md-6 pull-left">'+
									'<label style="margin-bottom:0px;font-size: 13px;">CMR</label>'+
									
									
									'<div class="input-group input-file" name="editr['+name_arrc+'][cmr]">'+
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
									
									'<div class="input-group input-file" name="editr['+name_arrc+'][invoice]">'+
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
									
									'<div class="input-group input-file" name="editr['+name_arrc+'][weightbridge]">'+
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
									
									'<div class="input-group input-file" name="editr['+name_arrc+'][other]">'+
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
									'</div>'+
									'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
									'</div></div></div></div>'+
								'</div>';
					
					
					$('.addmore_main').append(add_div);
					repeater_field();
					shipper_count2 = 1;
					consignee_count2 = 1;
					
					$('.select2').select2();
					$('[name="editr['+name_arrc+'][status]"]').val($('[name="editr['+get_prev_val+'][status]"]').val()).trigger('change');
					
					
					tab_view_fun();
					tab_remove_fun();
					$('.tabs_view').click();
					
					dropdown_fun();
					temp_counter++;
						
						
						
					/*var shipper_arr_fill= [];
					$("#"+active_tab+" select.shipper option:selected").each(function (index, value) {
						shipper_arr_fill.push($(this).val());
					});
					
					$("#"+active_tab+" .shipper").each(function (index, value) {
						if(index>=1)
							$("#tab_"+tab_count+" .shipper_addmore").trigger('click');
						$('[name="editr['+(tab_count-1)+']['+index+'][shipper]"]').val(shipper_arr_fill[index]).trigger('change');
					});*/
					
					var customername= [];
					$("#"+active_tab+" .customername").each(function (index, value) {
						customername.push($(this).val());
					});
					$("#"+active_tab+" .customername").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+'][customername]"]').val(customername[index]);
					});
					
					var shipper_arr_fill= [];
					$("#"+active_tab+" .shipper").each(function (index, value) {
						shipper_arr_fill.push($(this).val());
					});
					
					$("#"+active_tab+" .shipper").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+']['+index+'][shipper]"]').val(shipper_arr_fill[index]);
					});
					
					var shipper_address_arr_fill= [];
					$("#"+active_tab+" .shipping_address").each(function (index, value) {
						shipper_address_arr_fill.push($(this).val());
					});
					$("#"+active_tab+" .shipping_address").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+']['+index+'][shipping_address]"]').val(shipper_address_arr_fill[index]);
					});
					
					var shippers_reference_arr_fill= [];
					$("#"+active_tab+" .shippers_reference").each(function (index, value) {
						shippers_reference_arr_fill.push($(this).val());
					});
				
					$("#"+active_tab+" .shippers_reference").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+']['+index+'][shippers_reference]"]').val(shippers_reference_arr_fill[index]);
					});
					
					var shipping_date_arr_fill= [];
					$("#"+active_tab+" .shipping_date").each(function (index, value) {
						shipping_date_arr_fill.push($(this).val());
					});
					$("#"+active_tab+" .shipping_date").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+']['+index+'][shipping_date]"]').val(shipping_date_arr_fill[index]);
					});
					
					
					var consignee_arr_fill= [];
					$("#"+active_tab+" .consignee").each(function (index, value) {
						consignee_arr_fill.push($(this).val());
					});
					
					$("#"+active_tab+" .consignee").each(function (index, value) {
						if(index>=1)
							$("#tab_"+tab_count+" .consignee_addmore").trigger('click');
						$('[name="editr['+(tab_count-1)+']['+index+'][consignee]"]').val(consignee_arr_fill[index]);
					});
					
					var consignee_address_arr_fill= [];
					$("#"+active_tab+" .consignee_address").each(function (index, value) {
						consignee_address_arr_fill.push($(this).val());
					});
					$("#"+active_tab+" .consignee_address").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+']['+index+'][consignee_address]"]').val(consignee_address_arr_fill[index]);
					});
					
					var consignee_reference_arr_fill= [];
					$("#"+active_tab+" .consignee_reference").each(function (index, value) {
						consignee_reference_arr_fill.push($(this).val());
					});

					$("#"+active_tab+" .consignee_reference").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+']['+index+'][consignee_reference]"]').val(consignee_reference_arr_fill[index]);
					});
					
					var delivery_date_arr_fill= [];
					$("#"+active_tab+" .delivery_date").each(function (index, value) {
						delivery_date_arr_fill.push($(this).val());
					});
					$("#"+active_tab+" .delivery_date").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+']['+index+'][delivery_date]"]').val(delivery_date_arr_fill[index]);
					});
					tab_count++;
					
					$(".datepickr").datepicker({
				format: "mm/dd/yyyy",
				weekStart: 0,
				calendarWeeks: true,
				autoclose: true,
			});
					
				});
			}
		});
			
			tab_view_fun();
			function tab_view_fun()
			{
				$('.tabs_view').on("click", function(e) {
					$('.tabcontent').hide();
					$('.tabcontent').removeClass('active');
					$('.tabs_view').removeClass('active');
					$($(this)).addClass('active');
					$('#'+$(this).data("name")).addClass('active');
					$('#'+$(this).data("name")).show();
				});
			}
			
			function tab_remove_fun()
			{
				$('.tabremove').on("click", function(e) {
					e.preventDefault();
					//$("#confirm").modal("show");
					var current_this = $(this);
					$('#confirm').modal({
						backdrop: 'static',
						keyboard: false
					})
					.on('click', '#delete', function(e) {
						$($(current_this).parent()).remove();
						$('#'+$(current_this).data("name")).remove();
					});
					
					/*$($(this).parent()).remove();
					$('#'+$(this).data("name")).remove();*/
				});
			}
			
			
			dropdown_fun();
            function dropdown_fun()
			{
				$(window).on("click", function(e) {
					if (!$(e.target).hasClass('t_dropdown')) {
						$(".toable_drop").hide();

					}

				});
				
				$(".t_dropdown").on("click",function(){
					$(".toable_drop").hide();
					
					$(this).parent().find(".toable_drop").show();

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
			}
			
			
			
			$('#add_transport').on('submit', function(event) {
				event.preventDefault();
				 
				$('.has-danger').next().children().children().css({"border": ""});
				$('.is-invalid').removeClass("is-invalid");
				$('.invalid-feedback').html("");
				$('.has-danger').removeClass("has-danger");
				var loadid = $(this).find('.loadid').val();
				var formData = new FormData(this);
				formData.append('_method', 'POST');
				//console.log($(this).find('.loadid').val());
				$.ajax({
					url: "{{ route('admin.transportlist.savetransportload')}}",
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
						window.location.href = "{{ route('admin.transportlist.index') }}";
						/*setTimeout(function() {
							window.location.reload;
						}, 500);*/
					}
					if(data.status == 'error'){
					Swal.fire('Error!', data.message, 'error');
					$('.createld').removeAttr('disabled');
				}
					},
			error :function( data ) {
				$('.loading').addClass('loading_hide');
				if( data.status === 422 ) {
					if($('.variety').val() == ''){
				$('.variety').parent().addClass('has-danger');
				$('.variety').addClass('is-invalid');
				 
			}else{
			$('.variety').removeClass('is-invalid');	
			}
			if($('.size').val() == ''){
				$('.size').parent().addClass('has-danger');
				$('.size').addClass('is-invalid');
				 
			}else{
			$('.loaded_weight').removeClass('is-invalid');	
			}
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
			if($('.carrier').val() == ''){
				$('.carrier').parent().addClass('has-danger');
				$('.carrier').addClass('is-invalid');
			}else{
			$('.carrier').removeClass('is-invalid');	
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
			if($('.shipper').val() == ''){
				$('.shipper').parent().addClass('has-danger');
				$('.shipper').addClass('is-invalid');
			}else{
			$('.shipper').removeClass('is-invalid');	
			}
			
			
			if($('.shipping_address').val() == ''){
				$('.shipping_address').parent().addClass('has-danger');
				$('.shipping_address').addClass('is-invalid');
			}else{
			$('.shipping_address').removeClass('is-invalid');	
			}
			if($('.shippers_reference').val() == ''){
				$('.shippers_reference').parent().addClass('has-danger');
				$('.shippers_reference').addClass('is-invalid');
			}else{
			$('.shippers_reference').removeClass('is-invalid');	
			}
			if($('.shipping_date').val() == ''){
				$('.shipping_date').parent().addClass('has-danger');
				$('.shipping_date').addClass('is-invalid');
			}else{
			$('.shipping_date').removeClass('is-invalid');	
			}
			if($('.consignee').val() == ''){
				$('.consignee').parent().addClass('has-danger');
				$('.consignee').addClass('is-invalid');
			}else{
			$('.consignee').removeClass('is-invalid');	
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
			if($('.delivery_date').val() == ''){
				$('.delivery_date').parent().addClass('has-danger');
				$('.delivery_date').addClass('is-invalid');
			}else{
			$('.delivery_date').removeClass('is-invalid');	
			}
					
					
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
			
            $(".datepickr").datepicker({
				format: "mm/dd/yyyy",
				weekStart: 0,
				calendarWeeks: true,
				autoclose: true,
			});
            
       
    </script>
    @endpush