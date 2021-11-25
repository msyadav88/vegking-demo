@extends('backend.layouts.app') 
@section('title', 'List :: ' . ' #'.$transportlist->id.' :: ' . app_name()) 

@section('content') @stack('before-styles') {{ style('css/bootstrap-datetimepicker.css') }} {{ style('css/bootstrap-clockpicker.min.css') }} @stack('after-styles')
   
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                    Edit Load<small class="text-muted"></small>
                </h4>
                </div>
                <!--col-->

            </div>
            <!--row-->
            <div class="row mt-2 transport_maindiv">
                <div class="col">
					
					<form class="form-horizontal " method="POST" id="formsubmit">
						
						<div class="table-offers" style="">
							
							<div class="tab tab_button">
								<?php $index = 1;  foreach($transportArr as $transvalue) { ?>
							  <button class="tablinks tabs_view <?php echo $index==1? 'active': '';?> " data-name="tab_<?php echo $index;?>" type="button">Load <?php echo $index;?></button>
							<?php $index++; } ?>
							</div>
						
							<div class="addmore_main">
							<?php $index = 1;  foreach($transportArr as $transvalue) { ?>
							<div id="tab_<?php echo $index;?>" class="tabcontent <?php echo $index==1? 'active': '';?>" style="<?php echo $index==1? 'display:block;': 'display:none;';?>">
								<div class="" style="display: inline-block;">
									<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">
										<div class="form-group">
											<label style="margin-bottom:0px;font-size: 13px;">Reference</label>
											<input type="text" name="editr[<?php echo $index; ?>][reference]" value="<?php echo $transvalue['id'];?>" placeholder="Reference" class="form-control" readonly style="">
										</div>
									</div>
									<div class="col-md-2" style="padding-right: 5px;padding-left: 5px;float: left;display: inline-block;">
										<div class="form-group">
											<label style="margin-bottom:0px;font-size: 13px;">Status</label>
											<select class="form-control select2" name="editr[<?php echo $index; ?>][status]">
												<option value="Rozładowany">Rozładowany</option>
												<option value="Problem">Problem</option>	
												<option value="Załadowany">Załadowany</option>	
												<option value="Zaplanowany">Zaplanowany</option>	
											</select>
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
														<label style="margin-bottom:0px;font-size: 13px;">Shipper</label>
														<select class="form-control select2 select2-hidden-accessible shipper" name="editr[<?php echo $index; ?>][0][shipper]">
															<option value="Polon" selected="" data-select2-id="6">Polon</option>
															<option value="AKP" data-select2-id="40">AKP</option>
															<option value="Greenvale" data-select2-id="41">Greenvale</option>
															<option value="Farmers" data-select2-id="42">Farmers</option>
															<option value="Jar-Pol" data-select2-id="43">Jar-Pol</option>
															<option value="Silver-Trans" data-select2-id="44">Silver-Trans</option>
															<option value="TH Clements &amp; Son Ltd" data-select2-id="45">TH Clements &amp; Son Ltd</option>
															<option value="3 Shires" data-select2-id="46">3 Shires</option>
															<option value="Momot + Polon" data-select2-id="47">Momot + Polon</option>
															<option value="APK" data-select2-id="48">APK</option>
														</select>
													</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Shipping address</label>
														
														<select class="form-control select2 select2-hidden-accessible shipping_address" name="editr[<?php echo $index; ?>][0][shipping_address]" >
															<option value="PE22 0EJ Boston" selected="" >PE22 0EJ Boston</option>
															<option value="YO25 5UY Driffield">YO25 5UY Driffield</option>
															<option value="PE33 9AZ Wereham">PE33 9AZ Wereham</option>
															<option value="32-125 Rudno Górne">32-125 Rudno Górne</option>
															<option value="32-104 Koniusza">32-104 Koniusza</option>
															<option value="62-610 Sompolno">62-610 Sompolno</option>
															<option value="PE33 9JR Eastgate Farm">PE33 9JR Eastgate Farm</option>
															<option value="PE22 0EJ Boston ">PE22 0EJ Boston </option>
															<option value="99-122 Nowy Gaj">99-122 Nowy Gaj</option>
															<option value="WA16 0JG">WA16 0JG</option>
															<option value="PE33 9JR Eastgate Farm">PE33 9JR Eastgate Farm</option>
															<option value="86-260 Unisław + 99-122 Nowy Gaj">86-260 Unisław + 99-122 Nowy Gaj</option>
															<option value="CO7 8RS Colchester ">CO7 8RS Colchester </option>
															<option value="PR4 6LD Preston">PR4 6LD Preston</option>
															<option value="C07 8HE Colchester">C07 8HE Colchester</option>
															<option value="YO25 3PT Driffield">YO25 3PT Driffield</option>
															<option value="DN20 0SQ">DN20 0SQ</option>
															<option value="WA16 0JG Cheshire">WA16 0JG Cheshire</option>
														</select>
													</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Shipper`s reference</label>
														<input type="text" name="editr[<?php echo $index; ?>][0][shippers_reference]" value="" placeholder="Shipper`s reference" class="form-control shippers_reference">
													</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Shipping date</label>
														<input type="date" name="editr[<?php echo $index; ?>][0][shipping_date]" value="" placeholder="Shipping date" class="form-control shipping_date" style="height: auto;padding: 0.28rem 0.75rem;">
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
														<label style="margin-bottom:0px;font-size: 13px;">Consignee</label>
														
														<select class="form-control consignee select2 select2-hidden-accessible" name="editr[<?php echo $index; ?>][0][consignee]">
															<option value="TH Clements &amp; Son Ltd" selected="" data-select2-id="15">TH Clements &amp; Son Ltd</option>
															<option value="Roman Sobczak" data-select2-id="84">Roman Sobczak</option>
															<option value="Amplus" data-select2-id="85">Amplus</option>
															<option value="Agromar" data-select2-id="86">Agromar</option>
															<option value="Freshtime" data-select2-id="87">Freshtime</option>
															<option value="Riviera Produce" data-select2-id="88">Riviera Produce</option>
															<option value="Agrogram" data-select2-id="89">Agrogram</option>
															<option value="Marcin Pałka" data-select2-id="90">Marcin Pałka</option>
															<option value="Net-Profit" data-select2-id="91">Net-Profit</option>
															<option value="Agrosad" data-select2-id="92">Agrosad</option>
															<option value="Grupa Producentów Warzyw" data-select2-id="93">Grupa Producentów Warzyw</option>
														</select>
													</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Consignee address</label>
														
														<select class="form-control consignee_address select2 select2-hidden-accessible" name="editr[<?php echo $index; ?>][0][consignee_address]" >
															<option value="PE22 0EJ Boston" selected="" data-select2-id="12">PE22 0EJ Boston</option>
															<option value="05-860 Płochocin" data-select2-id="38">05-860 Płochocin</option>
															<option value="32-104 Koniusza" data-select2-id="39">32-104 Koniusza</option>
															<option value="PE22 0EJ Boston " data-select2-id="40">PE22 0EJ Boston </option>
															<option value="28-400 Nowa Zagość" data-select2-id="41">28-400 Nowa Zagość</option>
															<option value="PE27 PY" data-select2-id="42">PE27 PY</option>
															<option value="TR27 5JQ Hayle" data-select2-id="43">TR27 5JQ Hayle</option>
															<option value="32-340 Wolbrom" data-select2-id="44">32-340 Wolbrom</option>
															<option value="32-125 Wawrzeńczyce" data-select2-id="45">32-125 Wawrzeńczyce</option>
															<option value="98-235 Równa" data-select2-id="46">98-235 Równa</option>
															<option value="63-460 Nowe Skalmierzyce " data-select2-id="47">63-460 Nowe Skalmierzyce </option>
														</select>
													</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Consignee`s reference</label>
														<input type="text" name="editr[<?php echo $index; ?>][0][consignee_reference]" value="" placeholder="Consignee`s reference" class="form-control consignee_reference">
													</div>
												</div>
												<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">
													<div class="form-group">
														<label style="margin-bottom:0px;font-size: 13px;">Delivery date</label>
														<input type="date" name="editr[<?php echo $index; ?>][0][delivery_date]" value="" placeholder="Delivery date" class="form-control delivery_date">
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
												<input type="text" name="editr[<?php echo $index; ?>][goods]" value="<?php echo $transvalue['goods'];?>" placeholder="Goods" class="form-control t_date" readonly>
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Variety</label>
												<input type="text" name="editr[<?php echo $index; ?>][variety]" value="<?php echo $transvalue['variety'];?>" placeholder="Variety" class="form-control" readonly>
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Size</label>
												<input type="text" name="editr[<?php echo $index; ?>][size]" value="<?php echo $transvalue['size'];?>" placeholder="Size" class="form-control t_date" readonly>
											</div>
										</div>
										
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Loaded weight</label>
												<input type="text" name="editr[<?php echo $index; ?>][loaded_weight]" value="<?php echo $transvalue['loaded_weight'];?>" placeholder="Loaded weight" class="form-control ">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Unloaded weight</label>
												<input type="text" name="editr[<?php echo $index; ?>][unloaded_weight]" value="<?php echo $transvalue['unloaded_weight'];?>" placeholder="Unloaded weight" class="form-control ">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Difference</label>
												<input type="text" name="editr[<?php echo $index; ?>][difference]" value="<?php echo $transvalue['difference'];?>" placeholder="Difference" class="form-control ">
											</div>
										</div>
										
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Packaging type</label>
												<input type="text" name="editr[<?php echo $index; ?>][packaging_type]" value="" placeholder="Packaging type" class="form-control ">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Number of packing units</label>
												<input type="text" name="editr[<?php echo $index; ?>][number_of_packing_units]" value="<?php echo $transvalue['number_of_packing_units'];?>" placeholder="Number of packing units" class="form-control ">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Requirements</label>
												<input type="text" name="editr[<?php echo $index; ?>][requirements]" value="<?php echo $transvalue['requirements'];?>" placeholder="Requirements" class="form-control ">
											</div>
										</div>
										<hr class="hr_line">
									</div>

									<div class=" col-md-12 pull-left"></div>
								   
									<div class="col-md-6 transport_left">
										
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Freight cost</label>
												<input type="text" name="editr[<?php echo $index; ?>][freight_cost]" value="<?php echo $transvalue['freight_cost'];?>" placeholder="Freight cost" class="form-control ">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Payment term</label>
												<input type="text" name="editr[<?php echo $index; ?>][payment_term]" value="<?php echo $transvalue['payment_term'];?>" placeholder="Payment term" class="form-control ">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Payment type</label>
												<input type="text" name="editr[<?php echo $index; ?>][payment_type]" value="<?php echo $transvalue['payment_type'];?>" placeholder="Payment type" class="form-control ">
											</div>
										</div>
										<hr class="hr_line">
									</div>

									<div class="col-md-6 transport_right">
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Transport invoice number</label>
												<input type="text" name="editr[<?php echo $index; ?>][transport_invoice_number]" value="" placeholder="Transport invoice number" class="form-control ">
											</div>
										</div>

										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Transport invoice due date</label>
												<input type="date" name="editr[<?php echo $index; ?>][transport_invoice_due_date]" value="" placeholder="Transport invoice due date" class="form-control ">
											</div>
										</div>
										
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Payment status</label>
												<input type="text" name="editr[<?php echo $index; ?>][payment_status]" value="<?php echo $transvalue['payment_status'];?>" placeholder="Payment status" class="form-control ">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Notes from accounting</label>
												<input type="text" name="editr[<?php echo $index; ?>][notes_from_accounting]" value="" placeholder="Notes from accounting" class="form-control ">
											</div>
										</div>
										<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
											<div class="form-group">
												<label style="margin-bottom:0px;font-size: 13px;">Documents</label><br/>
												<a href="javascript:void(0)" class="btn btn-info all-doc">Documents</a>

											</div>
										</div>
									</div>
									
									</div>
									</div>
									<div class="col-md-12"></div>
									<div class="col-md-4 transport_left" style="padding-left: 5px;border-right:none;">
										<div class="form-group">
											<label style="margin-bottom:0px;font-size: 13px;">Notes</label>
											<textarea name="editr[<?php echo $index; ?>][notes]" value="" class="form-control "></textarea>
										</div>
									</div>
								</div>
							</div>
							<?php $index++; } ?>
							</div>
							
						<div class="col-md-12"><br/></div>	
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Carrier</label>
								<input type="text" name="editr[<?php echo $index; ?>][carrier]" value="" placeholder="Carrier" class="form-control ">
							</div>
						</div>

						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Trailer type</label>
								<input type="text" name="editr[<?php echo $index; ?>][trailer_type]" value="" placeholder="Trailer type" class="form-control ">
							</div>
						</div>
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Temperature</label>
								<input type="text" name="editr[<?php echo $index; ?>][temperature]" value="" placeholder="Temperature" class="form-control ">
							</div>
						</div>
						
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Plate numbers</label>
								<input type="text" name="editr[<?php echo $index; ?>][plate_numbers]" value="" placeholder="Plate numbers" class="form-control ">
							</div>
						</div>
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Driver`s name</label>
								<input type="text" name="editr[<?php echo $index; ?>][drivers_name]" value="" placeholder="Driver`s name" class="form-control ">
							</div>
						</div>
						<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">
							<div class="form-group">
								<label style="margin-bottom:0px;font-size: 13px;">Driver`s phone number</label>
								<input type="text" name="editr[<?php echo $index; ?>][drivers_phone_number]" value="" placeholder="Driver`s phone number" class="form-control ">
							</div>
						</div>
						
							<div class="col text-right" style="margin-top: 10px;padding: 0;float: right;">
								<button class="btn btn-success btn-md pull-right" type="submit" >Create</button>
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

<!-- The Modal -->
<div id="linkModal" class="modal fade" role="dialog" style="opacity:1;">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Document List</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body" id="link_details">
		<div class="col-md-3 pull-left">
			<label style="margin-bottom:0px;font-size: 13px;">CMR</label><br/>
			<a href="javascript:void(0)" data-name="editr[34]" class="uploader btn btn-primary">Attach</a>
		</div>
		<div class="col-md-3 pull-left">
			<label style="margin-bottom:0px;font-size: 13px;">Invoice</label><br/>
			<a href="javascript:void(0)" data-name="editr[34]" class="uploader btn btn-primary">Attach</a>
		</div>
		<div class="col-md-3 pull-left">
			<label style="margin-bottom:0px;font-size: 13px;">Weightbridge</label><br/>
			<a href="javascript:void(0)" data-name="editr[34]" class="uploader btn btn-primary">Attach</a>
		</div>
		<div class="col-md-3 pull-left">
			<label style="margin-bottom:0px;font-size: 13px;">Other</label><br/>
			<a href="javascript:void(0)" data-name="editr[34]" class="uploader btn btn-primary">Attach</a>
		</div>
		<div class="col-md-12 pull-left"><br/></div>
		<div class="col-md-12 pull-left">
			<label style="margin-bottom:0px;font-size: 13px;">Download File</label><br/>
			<a href="#" class="">Files</a>
		</div>
		<div class="col-md-12 pull-left">
			<label style="margin-bottom:0px;font-size: 13px;">Download All</label><br/>
			<a href="#" class="">All files</a>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
		
        $(function() {
			var tab_count = 2;
			var name_arrc = 0;
			repeater_field();
			//var shipper_count1 = 0;
			var shipper_count2 = 1;
			//var consignee_count1 = 0;
			var consignee_count2 = 1;
			function repeater_field()
			{
			$(' .shipper_addmore').on("click", function(e) {
				$('#'+$('.tablinks.active').attr('data-name')+' .shipper_add').append('<div class="shipper_copy" data-number="'+shipper_count2+'">'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="col-md-1 pull-left" style="padding-right: 5px;padding-left: 1px;">'+
			'<a style="bottom: 0px; float: right; font-size: 33px; font-weight: bold;" type="" class="shipper_remove getshipper_0">-</a>'+
		'</div>'+
		'<div class="col-md-11 pull-left form-group" style="padding: 0;">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Shipper</label>'+
			'<select class="form-control select2 select2-hidden-accessible shipper" name="editr['+name_arrc+']['+shipper_count2+'][shipper]" >'+
				'<option value="Polon" selected="" data-select2-id="6">Polon</option>'+
				'<option value="AKP" data-select2-id="40">AKP</option>'+
				'<option value="Greenvale" data-select2-id="41">Greenvale</option>'+
				'<option value="Farmers" data-select2-id="42">Farmers</option>'+
				'<option value="Jar-Pol" data-select2-id="43">Jar-Pol</option>'+
				'<option value="Silver-Trans" data-select2-id="44">Silver-Trans</option>'+
				'<option value="TH Clements &amp; Son Ltd" data-select2-id="45">TH Clements &amp; Son Ltd</option>'+
				'<option value="3 Shires" data-select2-id="46">3 Shires</option>'+
				'<option value="Momot + Polon" data-select2-id="47">Momot + Polon</option>'+
				'<option value="APK" data-select2-id="48">APK</option>'+
			'</select>'+
		'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Shipping address</label>'+
			
			'<select class="form-control select2 select2-hidden-accessible shipping_address" name="editr['+name_arrc+']['+shipper_count2+'][shipping_address]">'+
				'<option value="PE22 0EJ Boston" selected="" >PE22 0EJ Boston</option>'+
				'<option value="YO25 5UY Driffield">YO25 5UY Driffield</option>'+
				'<option value="PE33 9AZ Wereham">PE33 9AZ Wereham</option>'+
				'<option value="32-125 Rudno Górne">32-125 Rudno Górne</option>'+
				'<option value="32-104 Koniusza">32-104 Koniusza</option>'+
				'<option value="62-610 Sompolno">62-610 Sompolno</option>'+
				'<option value="PE33 9JR Eastgate Farm">PE33 9JR Eastgate Farm</option>'+
				'<option value="PE22 0EJ Boston ">PE22 0EJ Boston </option>'+
				'<option value="99-122 Nowy Gaj">99-122 Nowy Gaj</option>'+
				'<option value="WA16 0JG">WA16 0JG</option>'+
				'<option value="PE33 9JR Eastgate Farm">PE33 9JR Eastgate Farm</option>'+
				'<option value="86-260 Unisław + 99-122 Nowy Gaj">86-260 Unisław + 99-122 Nowy Gaj</option>'+
				'<option value="CO7 8RS Colchester ">CO7 8RS Colchester </option>'+
				'<option value="PR4 6LD Preston">PR4 6LD Preston</option>'+
				'<option value="C07 8HE Colchester">C07 8HE Colchester</option>'+
				'<option value="YO25 3PT Driffield">YO25 3PT Driffield</option>'+
				'<option value="DN20 0SQ">DN20 0SQ</option>'+
				'<option value="WA16 0JG Cheshire">WA16 0JG Cheshire</option>'+
			'</select>'+
		'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Shipper`s reference</label>'+
			'<input type="text" name="editr['+name_arrc+']['+shipper_count2+'][shippers_reference]" value="" placeholder="Shipper`s reference" class="form-control shippers_reference">'+
		'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Shipping date</label>'+
			'<input type="date" name="editr['+name_arrc+']['+shipper_count2+'][shipping_date]" value="" placeholder="Shipping date" class="form-control shipping_date" style="height: auto;padding: 0.28rem 0.75rem;">'+
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
			
			'<select class="form-control consignee select2 select2-hidden-accessible" name="editr['+name_arrc+']['+consignee_count2+'][consignee]" tabindex="-1" aria-hidden="true">'+
				'<option value="TH Clements &amp; Son Ltd" selected="" data-select2-id="15">TH Clements &amp; Son Ltd</option>'+
				'<option value="Roman Sobczak" data-select2-id="84">Roman Sobczak</option>'+
				'<option value="Amplus" data-select2-id="85">Amplus</option>'+
				'<option value="Agromar" data-select2-id="86">Agromar</option>'+
				'<option value="Freshtime" data-select2-id="87">Freshtime</option>'+
				'<option value="Riviera Produce" data-select2-id="88">Riviera Produce</option>'+
				'<option value="Agrogram" data-select2-id="89">Agrogram</option>'+
				'<option value="Marcin Pałka" data-select2-id="90">Marcin Pałka</option>'+
				'<option value="Net-Profit" data-select2-id="91">Net-Profit</option>'+
				'<option value="Agrosad" data-select2-id="92">Agrosad</option>'+
				'<option value="Grupa Producentów Warzyw" data-select2-id="93">Grupa Producentów Warzyw</option>'+
			'</select>'+
		'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Consignee address</label>'+
			
			'<select class="form-control consignee_address select2 select2-hidden-accessible" name="editr['+name_arrc+']['+consignee_count2+'][consignee_address]" aria-hidden="true" >'+
				'<option value="PE22 0EJ Boston" selected="" data-select2-id="12">PE22 0EJ Boston</option>'+
				'<option value="05-860 Płochocin" data-select2-id="38">05-860 Płochocin</option>'+
				'<option value="32-104 Koniusza" data-select2-id="39">32-104 Koniusza</option>'+
				'<option value="PE22 0EJ Boston " data-select2-id="40">PE22 0EJ Boston </option>'+
				'<option value="28-400 Nowa Zagość" data-select2-id="41">28-400 Nowa Zagość</option>'+
				'<option value="PE27 PY" data-select2-id="42">PE27 PY</option>'+
				'<option value="TR27 5JQ Hayle" data-select2-id="43">TR27 5JQ Hayle</option>'+
				'<option value="32-340 Wolbrom" data-select2-id="44">32-340 Wolbrom</option>'+
				'<option value="32-125 Wawrzeńczyce" data-select2-id="45">32-125 Wawrzeńczyce</option>'+
				'<option value="98-235 Równa" data-select2-id="46">98-235 Równa</option>'+
				'<option value="63-460 Nowe Skalmierzyce " data-select2-id="47">63-460 Nowe Skalmierzyce </option>'+
			'</select>'+
		'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Consignee`s reference</label>'+
			'<input type="text" name="editr['+name_arrc+']['+consignee_count2+'][consignee_reference]" value="" placeholder="Consignee`s reference" class="form-control consignee_reference">'+
		'</div>'+
	'</div>'+
	'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
		'<div class="form-group">'+
			'<label style="margin-bottom:0px;font-size: 13px;">Delivery date</label>'+
			'<input type="date" name="editr['+name_arrc+']['+consignee_count2+'][delivery_date]" value="" placeholder="Delivery date" class="form-control delivery_date">'+
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
			
			addmore();
			function addmore()
			{
			$('.addmore').on("click", function(e) {
				name_arrc++;
				temp_counter = 1;
				$('#getsalesid').modal({
					backdrop: 'static',
					keyboard: false
				})
				.on('click', '#getsales', function(e) {
					
					$.ajax({
						type: "POST",
						url: "{{ route('admin.list.getsales') }}",
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						data: {saleid:$('#salesid').val()},
						success: function (data) {	
							
							if(temp_counter==1)
							{
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
					'<option value="Rozładowany">Rozładowany</option>'+
					'<option value="Problem">Problem</option>'+
					'<option value="Załadowany">Załadowany</option>'+	
					'<option value="Zaplanowany">Zaplanowany</option>'+	
				'</select>'+
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
							
							'<select class="form-control select2 select2-hidden-accessible shipper" name="editr['+name_arrc+'][0][shipper]" aria-hidden="true">'+
								'<option value="Polon" selected="" data-select2-id="6">Polon</option>'+
								'<option value="AKP" data-select2-id="40">AKP</option>'+
								'<option value="Greenvale" data-select2-id="41">Greenvale</option>'+
								'<option value="Farmers" data-select2-id="42">Farmers</option>'+
								'<option value="Jar-Pol" data-select2-id="43">Jar-Pol</option>'+
								'<option value="Silver-Trans" data-select2-id="44">Silver-Trans</option>'+
								'<option value="TH Clements &amp; Son Ltd" data-select2-id="45">TH Clements &amp; Son Ltd</option>'+
								'<option value="3 Shires" data-select2-id="46">3 Shires</option>'+
								'<option value="Momot + Polon" data-select2-id="47">Momot + Polon</option>'+
								'<option value="APK" data-select2-id="48">APK</option>'+
							'</select>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
						'<div class="form-group">'+
							'<label style="margin-bottom:0px;font-size: 13px;">Shipping address</label>'+
							
							'<select class="form-control select2 select2-hidden-accessible shipping_address" name="editr['+name_arrc+'][0][shipping_address]">'+
								'<option value="PE22 0EJ Boston" selected="" >PE22 0EJ Boston</option>'+
								'<option value="YO25 5UY Driffield">YO25 5UY Driffield</option>'+
								'<option value="PE33 9AZ Wereham">PE33 9AZ Wereham</option>'+
								'<option value="32-125 Rudno Górne">32-125 Rudno Górne</option>'+
								'<option value="32-104 Koniusza">32-104 Koniusza</option>'+
								'<option value="62-610 Sompolno">62-610 Sompolno</option>'+
								'<option value="PE33 9JR Eastgate Farm">PE33 9JR Eastgate Farm</option>'+
								'<option value="PE22 0EJ Boston ">PE22 0EJ Boston </option>'+
								'<option value="99-122 Nowy Gaj">99-122 Nowy Gaj</option>'+
								'<option value="WA16 0JG">WA16 0JG</option>'+
								'<option value="PE33 9JR Eastgate Farm">PE33 9JR Eastgate Farm</option>'+
								'<option value="86-260 Unisław + 99-122 Nowy Gaj">86-260 Unisław + 99-122 Nowy Gaj</option>'+
								'<option value="CO7 8RS Colchester ">CO7 8RS Colchester </option>'+
								'<option value="PR4 6LD Preston">PR4 6LD Preston</option>'+
								'<option value="C07 8HE Colchester">C07 8HE Colchester</option>'+
								'<option value="YO25 3PT Driffield">YO25 3PT Driffield</option>'+
								'<option value="DN20 0SQ">DN20 0SQ</option>'+
								'<option value="WA16 0JG Cheshire">WA16 0JG Cheshire</option>'+
							'</select>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
						'<div class="form-group">'+
							'<label style="margin-bottom:0px;font-size: 13px;">Shipper`s reference</label>'+
							'<input type="text" name="editr['+name_arrc+'][0][shippers_reference]" value="" placeholder="Shipper`s reference" class="form-control shippers_reference">'+

						'</div>'+
					'</div>'+
					'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
						'<div class="form-group">'+
							'<label style="margin-bottom:0px;font-size: 13px;">Shipping date</label>'+
							'<input type="date" name="editr['+name_arrc+'][0][shipping_date]" value="" placeholder="Shipping date" class="form-control shipping_date" style="height: auto;padding: 0.28rem 0.75rem;">'+
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
							'<label style="margin-bottom:0px;font-size: 13px;">Consignee</label>'+
							
							'<select class="form-control select2 select2-hidden-accessible consignee" name="editr['+name_arrc+'][0][consignee]" >'+
								'<option value="TH Clements &amp; Son Ltd" selected="" data-select2-id="15">TH Clements &amp; Son Ltd</option>'+
								'<option value="Roman Sobczak" data-select2-id="91">Roman Sobczak</option>'+
								'<option value="Amplus" data-select2-id="92">Amplus</option>'+
								'<option value="Agromar" data-select2-id="93">Agromar</option>'+
								'<option value="Freshtime" data-select2-id="94">Freshtime</option>'+
								'<option value="Riviera Produce" data-select2-id="95">Riviera Produce</option>'+
								'<option value="Agrogram" data-select2-id="96">Agrogram</option>'+
								'<option value="Marcin Pałka" data-select2-id="97">Marcin Pałka</option>'+
								'<option value="Net-Profit" data-select2-id="98">Net-Profit</option>'+
								'<option value="Agrosad" data-select2-id="99">Agrosad</option>'+
								'<option value="Grupa Producentów Warzyw" data-select2-id="100">Grupa Producentów Warzyw</option>'+
							'</select>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
						'<div class="form-group">'+
							'<label style="margin-bottom:0px;font-size: 13px;">Consignee address</label>'+
							'<select class="form-control select2 select2-hidden-accessible consignee_address" name="editr['+name_arrc+'][0][consignee_address]" >'+
								'<option value="PE22 0EJ Boston" selected="" data-select2-id="12">PE22 0EJ Boston</option>'+
								'<option value="05-860 Płochocin" data-select2-id="38">05-860 Płochocin</option>'+
								'<option value="32-104 Koniusza" data-select2-id="39">32-104 Koniusza</option>'+
								'<option value="PE22 0EJ Boston " data-select2-id="40">PE22 0EJ Boston </option>'+
								'<option value="28-400 Nowa Zagość" data-select2-id="41">28-400 Nowa Zagość</option>'+
								'<option value="PE27 PY" data-select2-id="42">PE27 PY</option>'+
								'<option value="TR27 5JQ Hayle" data-select2-id="43">TR27 5JQ Hayle</option>'+
								'<option value="32-340 Wolbrom" data-select2-id="44">32-340 Wolbrom</option>'+
								'<option value="32-125 Wawrzeńczyce" data-select2-id="45">32-125 Wawrzeńczyce</option>'+
								'<option value="98-235 Równa" data-select2-id="46">98-235 Równa</option>'+
								'<option value="63-460 Nowe Skalmierzyce " data-select2-id="47">63-460 Nowe Skalmierzyce </option>'+
							'</select>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
						'<div class="form-group">'+
							'<label style="margin-bottom:0px;font-size: 13px;">Consignee`s reference</label>'+
							'<input type="text" name="editr['+name_arrc+'][0][consignee_reference]" value="" placeholder="Consignee`s reference" class="form-control consignee_reference">'+
						'</div>'+
					'</div>'+
					'<div class="col-md-3 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
						'<div class="form-group">'+
							'<label style="margin-bottom:0px;font-size: 13px;">Delivery date</label>'+
							'<input type="date" name="editr['+name_arrc+'][0][delivery_date]" value="" placeholder="Delivery date" class="form-control delivery_date">'+
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
					'<input type="text" name="editr['+name_arrc+'][goods]" value="" placeholder="Goods" class="form-control t_date" readonly>'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Variety</label>'+
					'<input type="text" name="editr['+name_arrc+'][variety]" value="" placeholder="Variety" class="form-control t_dropdown" readonly>'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Size</label>'+
					'<input type="text" name="editr['+name_arrc+'][size]" value="" placeholder="Size" class="form-control t_date" readonly>'+
				'</div>'+
			'</div>'+
			
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Loaded weight</label>'+
					'<input type="text" name="editr['+name_arrc+'][loaded_weight]" value="'+$('[name="editr['+get_prev_val+'][loaded_weight]"]').val()+'" placeholder="Loaded weight" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Unloaded weight</label>'+
					'<input type="text" name="editr['+name_arrc+'][unloaded_weight]" value="'+$('[name="editr['+get_prev_val+'][unloaded_weight]"]').val()+'" placeholder="Unloaded weight" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Difference</label>'+
					'<input type="text" name="editr['+name_arrc+'][difference]" value="'+$('[name="editr['+get_prev_val+'][difference]"]').val()+'" placeholder="Difference" class="form-control ">'+
				'</div>'+
			'</div>'+
			
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Packaging type</label>'+
					'<input type="text" name="editr['+name_arrc+'][packaging_type]" value="'+$('[name="editr['+get_prev_val+'][packaging_type]"]').val()+'" placeholder="Packaging type" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Number of packing units</label>'+
					'<input type="text" name="editr['+name_arrc+'][number_of_packing_units]" value="'+$('[name="editr['+get_prev_val+'][number_of_packing_units]"]').val()+'" placeholder="Number of packing units" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Requirements</label>'+
					'<input type="text" name="editr['+name_arrc+'][requirements]" value="'+$('[name="editr['+get_prev_val+'][requirements]"]').val()+'" placeholder="Requirements" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<hr class="hr_line">'+
		'</div>'+

		'<div class="col-md-12 pull-left"></div>'+
	   
		'<div class="col-md-6 transport_left">'+
			
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Freight cost</label>'+
					'<input type="text" name="editr['+name_arrc+'][freight_cost]" value="'+$('[name="editr['+get_prev_val+'][freight_cost]"]').val()+'" placeholder="Freight cost" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Payment term</label>'+
					'<input type="text" name="editr['+name_arrc+'][payment_term]" value="'+$('[name="editr['+get_prev_val+'][payment_term]"]').val()+'" placeholder="Payment term" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Payment type</label>'+
					'<input type="text" name="editr['+name_arrc+'][payment_type]" value="'+$('[name="editr['+get_prev_val+'][payment_type]"]').val()+'" placeholder="Payment type" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<hr class="hr_line">'+
		'</div>'+

		'<div class="col-md-6 transport_right">'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Transport invoice number</label>'+
					'<input type="text" name="editr['+name_arrc+'][transport_invoice_number]" value="'+$('[name="editr['+get_prev_val+'][transport_invoice_number]"]').val()+'" placeholder="Transport invoice number" class="form-control ">'+
				'</div>'+
			'</div>'+

			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Transport invoice due date</label>'+
					'<input type="date" name="editr['+name_arrc+'][transport_invoice_due_date]" value="'+$('[name="editr['+get_prev_val+'][transport_invoice_due_date]"]').val()+'" placeholder="Transport invoice due date" class="form-control ">'+
				'</div>'+
			'</div>'+
			
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Payment status</label>'+
					'<input type="text" name="editr['+name_arrc+'][payment_status]" value="'+$('[name="editr['+get_prev_val+'][payment_status]"]').val()+'" placeholder="Payment status" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Notes from accounting</label>'+
					'<input type="text" name="editr['+name_arrc+'][notes_from_accounting]" value="'+$('[name="editr['+get_prev_val+'][notes_from_accounting]"]').val()+'" placeholder="Notes from accounting" class="form-control ">'+
				'</div>'+
			'</div>'+
			'<div class="col-md-4 pull-left" style="padding-right: 5px;padding-left: 5px;">'+
				'<div class="form-group">'+
					'<label style="margin-bottom:0px;font-size: 13px;">Documents</label><br/>'+
					'<a href="javascript:void(0)" class="btn btn-info all-doc">Documents</a>'+
				'</div>'+
			'</div>'+
		'</div>'+
		
		'</div>'+
		'</div>'+
		'<div class="col-md-12"></div>'+
		'<div class="col-md-4 transport_left" style="padding-left: 5px;border-right:none;">'+
			'<div class="form-group">'+
				'<label style="margin-bottom:0px;font-size: 13px;">Notes</label>'+
				'<textarea name="editr['+name_arrc+'][notes]" value="'+$('[name="editr['+get_prev_val+'][notes]"]').val()+'" class="form-control "></textarea>'+
			'</div>'+
		'</div>'+
	'</div>'+
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
					
					$('[name="editr['+name_arrc+'][goods]"]').val(data.goods);
					$('[name="editr['+name_arrc+'][variety]"]').val(data.variety);
					$('[name="editr['+name_arrc+'][size]"]').val(data.size);
					
					var shipper_arr_fill= [];
					$("#"+active_tab+" select.shipper option:selected").each(function (index, value) {
						shipper_arr_fill.push($(this).val());
					});
					
					$("#"+active_tab+" .shipper").each(function (index, value) {
						if(index>=1)
							$("#tab_"+tab_count+" .shipper_addmore").trigger('click');
						$('[name="editr['+(tab_count-1)+']['+index+'][shipper]"]').val(shipper_arr_fill[index]).trigger('change');
					});
					
					var shipper_address_arr_fill= [];
					$("#"+active_tab+" select.shipping_address option:selected").each(function (index, value) {
						shipper_address_arr_fill.push($(this).val());
					});
					$("#"+active_tab+" .shipping_address").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+']['+index+'][shipping_address]"]').val(shipper_address_arr_fill[index]).trigger('change');
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
					$("#"+active_tab+" select.consignee option:selected").each(function (index, value) {
						consignee_arr_fill.push($(this).val());
					});
					
					$("#"+active_tab+" .consignee").each(function (index, value) {
						if(index>=1)
							$("#tab_"+tab_count+" .consignee_addmore").trigger('click');
						$('[name="editr['+(tab_count-1)+']['+index+'][consignee]"]').val(consignee_arr_fill[index]).trigger('change');
					});
					
					var consignee_address_arr_fill= [];
					$("#"+active_tab+" select.consignee_address option:selected").each(function (index, value) {
						consignee_address_arr_fill.push($(this).val());
					});
					$("#"+active_tab+" .consignee_address").each(function (index, value) {
						$('[name="editr['+(tab_count-1)+']['+index+'][consignee_address]"]').val(consignee_address_arr_fill[index]).trigger('change');
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
					
					}
				}
			});
				
				});
			
			});
			
			
			
			
			}
			
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
			
			$(".all-doc").on("click",function(){
				$("#linkModal").modal("show");
			});
			
			$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
			});
			$('#formsubmit').on('submit', function(event) {
				event.preventDefault();

				$('.has-danger').next().children().children().css({"border": ""});
				$('.is-invalid').removeClass("is-invalid");
				$('.invalid-feedback').html("");
				$('.has-danger').removeClass("has-danger");
				
				var formData = new FormData(this);
				formData.append('_method', 'PUT');
				
				$.ajax({
					url: "{{ route('admin.transportlist.update',$transportlist->id)}}",
					method: 'POST',
					data: formData,
					contentType: false,							
					cache: false,
					processData: false,
					dataType: "json",
					beforeSend: function(){
					},
					success: function(data)
					{
						if(data.status == 'success'){
							setTimeout(function(){
								Swal.fire('Sent!', data.message, 'success');
								//window.location.href = "{{ route('admin.sales.index') }}"; 
							}, 5000);
						}
						if(data.status == 'error'){
							setTimeout(function(){
								Swal.fire('Error!', data.message, 'error');
							}, 5000);
						}
					},
					error :function( data ) {
						if( data.status === 422 ) {
							Swal.fire('Error!', data.responseJSON.message, 'error');
							$('.btn-success').removeAttr('disabled');
							var errors = [];
							errors = data.responseJSON.errors
							$.each(errors, function (key, value) {
								$('#'+key).parent().addClass('has-danger');
								$('#'+key).addClass('is-invalid');
								$('#'+key).parent('.has-danger').find('.invalid-feedback').html(value);
								$('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
							})
						}
					}
				});
			});	
            
            
        });
    </script>
    @endpush