 
                          <table id="trans-table" class="table table-striped table-bordered table-hover dt-responsive display nowrap dataTable no-footer dtr-inline collapsed" cellspacing="0"
                   width="100%" style="font-size:10px;">
       
		<thead>
			<tr>
				<th class="all sorting_asc" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 43px;">Action</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Ref</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Product</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Variety</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Size</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 27px;white-space:pre-wrap;">Loaded Weight</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 27px;white-space:pre-wrap;">Unloaded Weight</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Difference</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Freight cost</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Status</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Load Date</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Unload Date</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Load Loc</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Unload Loc</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Truck Plates</th>
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Carrier</th>
				
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Buyer</th>
				
				
				<th class="all sorting" tabindex="0" aria-controls="trans-table" rowspan="1" colspan="1" style="width: 47px;">Seller</th>
				
			</tr>
		</thead>
<tbody>
<?php  $index = 1;
	foreach($transportArr as $t)
	{?>
		<tr role="row" class="parent">
			<td>
				<a href="#" class="trans_details plus" data-id="<?php echo $t['id'];?>">+</a>
				<a href="#" class="trans_details minus" style="display:none;">-</a>
				<a href="<?php echo route('admin.transportlist.edit', $t['id']); ?>">Edit</a>
				 
			</td>
			<td><?php echo $t['id']; ?></td>
			<td><?php echo $t['goods']; ?></td>
			<td><?php echo $t['variety']; ?></td>
			<td><?php echo $t['size']; ?></td>
			<td><?php echo $t['loaded_weight']; ?></td>
			<td><?php echo $t['unloaded_weight']; ?></td>
			<td><?php echo $t['difference']; ?></td>
			<td><?php echo $t['freight_cost']; ?></td>
			<td><?php echo $t['payment_status']; ?></td>
			<td><?php echo date('Y-m-d',strtotime($t['loaddate'])); ?></td>
			<td><?php echo $t['unloaddate']; ?></td>
			<td><?php echo $t['loadloc']; ?></td>
			<td><?php echo $t['unloadloc']; ?></td>
			<td><?php echo $t['plateno']; ?></td>
			<td><?php echo $t['carrier']; ?></td>
			<td><?php echo $t['buyer']; ?></td>
			<td><?php echo $t['seller']; ?></td>
			 
			
		</tr>
		<tr class="child" style="display:none;">
			<td class="child" colspan="19">
				<div class="row mt-2 transport_maindiv">
                <div class="col">
					<div class="transload"></div>
					
                </div>
                <!--col-->
            </div>
				<?php /*
				<ul class="dtr-details">
					<?php $index = 1;foreach($TransLoad as $k){ 
						if($k['transport_id']==$t['id']) {?>
						<li style="width:100%">Load <?php echo $index++;?></li>	
						<li ><span class="dtr-title">Transport id</span><span class="dtr-data"><?php echo $k['transport_id']; ?></span></li>
						<li><span class="dtr-title">goods</span><span class="dtr-data"><?php echo $k['goods']; ?></span></li>
						<li><span class="dtr-title">goods</span><span class="dtr-data"><?php echo $k['variety']; ?></span></li>
						<li><span class="dtr-title">goods</span><span class="dtr-data"><?php echo $k['size_from'].'-'.$k['size_to']; ?></span></li>
						<li><span class="dtr-title">loaded weight</span><span class="dtr-data"><?php echo $k['loaded_weight']; ?></span></li>
						<li><span class="dtr-title">unloaded weight</span><span class="dtr-data"><?php echo $k['unloaded_weight']; ?></span></li>
						<li><span class="dtr-title">difference</span><span class="dtr-data"><?php echo $k['difference']; ?></span></li>
						<li><span class="dtr-title">packaging type</span><span class="dtr-data"><?php echo $k['packaging_type']; ?></span></li>
						<li><span class="dtr-title">number of packing units</span><?php echo $k['number_of_packing_units']; ?></span></li>
						<li><span class="dtr-title">freight cost</span><span class="dtr-data"><?php echo $k['freight_cost']; ?></span></li>
						<li><span class="dtr-title">payment term</span><span class="dtr-data"><?php echo $k['payment_term']; ?></span></li>
						<li><span class="dtr-title">payment type</span><span class="dtr-data"><?php echo $k['payment_type']; ?></span></li>
						<li><span class="dtr-title">transport invoice no</span><span class="dtr-data"><?php echo $k['transport_invoice_no']; ?></span></li>
						<li><span class="dtr-title">transport invoice due date</span><span class="dtr-data"><?php echo $k['transport_invoice_due_date']; ?></span></li>
						<li><span class="dtr-title">payment status</span><span class="dtr-data"><?php echo $k['payment_status']; ?></span></li>
						<li><span class="dtr-title">notes from accounting</span><span class="dtr-data"><?php echo $k['notes_from_accounting']; ?></span></li>
						<li><span class="dtr-title">notes</span><span class="dtr-data"><?php echo $k['notes']; ?></span></li>
					<?php }
						} ?>
				</ul> */ ?>
			</td>
		
		</tr>
	<?php }
	
	
	/*echo "".$k['salesid']."<br/>";
		foreach($TransLoad as $t){ 
			if($t['transport_id']==$k['id'])
			echo "Loads: ".$t['salesid']."<br/>";
		}
		echo "----<br/>";*/
?>



</tbody>
</table>

{!! $transportlist1->render() !!}
 