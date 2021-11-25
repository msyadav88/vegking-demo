<html>

<head>
  
    <meta charset="utf-8"/>
  
</head>

<body>
    <header style="">
   
                @if(count($transportArr2) > 0)
                     @foreach($transportArr2 as $key => $value)
                    
				 <div class="breakpag" style="page-break-after:always;border:1px solid #000;padding:10px;margin-bottom:15px;">
					<div class="row">
						<div class="col-md-4">
							<h4>Booking Confirmation</h4>
							<p><b>Ref : </b>{{$value['id']}}</p>
							<p><b>Carrier : </b>{{isset($value['carrier']) ? $value['carrier'] : '-'}} </p>  
						</div>
						 
					</div>
              <div class="row">
  <div class="column shiprmain">
     
    @if(count($value['shipperall']) > 0)
				 	@foreach($value['shipperall'] as $shipper)
					<div class="shiprdiv">
					 
				<p class="left"><b>Shipper : </b> {{$shipper->shipper}}</p>	
				<p class="left"><b>Shipper Address: </b>{{$shipper->shipper_address}}</p>	
				<p class="left"><b>Shipper Reference: </b>{{$shipper->shipper_reference}}</p>	
				<p class="left"><b>Shipper Date: </b>{{date('M d, Y',strtotime($shipper->shipper_date))}}</p>	
					 
					</div>
					@endforeach
				 	@endif
	</div>
<div class="column shiprmain">
	@if(count($value['consigneeall']) > 0)
				 	@foreach($value['consigneeall'] as $consignee)
					<div class="shiprdiv">
					 
				<p class="left"><b>Consignee : </b> {{$consignee->consignee}}</p>	
				<p class="left"><b>Consignee Address: </b>{{$consignee->consignee_address}}</p>	
				<p class="left"><b>Consignee Reference: </b>{{$consignee->consignee_reference}}</p>	
				<p class="left"><b>Consignee Date: </b>{{date('M d, Y',strtotime($consignee->consignee_date))}}</p>	
					 
					</div>
					@endforeach
				 	@endif
</div>	
	 
  </div>
   
     <table style="width:100%;margin:5px 0;border-bottom:1px solid #000;">
	 <tbody>
	  <tr>
				 <th colspan="2" class="left">Product</th>
				 <th colspan="2" class="left">Variety</th>
				 <th colspan="2" class="left">Size</th>
				 <th colspan="2" class="left">Packaging</th>
				 <th colspan="2" class="left">Temperature</th>
				 
				 </tr>
				 <tr>
				 <td colspan="2" class="left">{{isset($value['goods']) ? $value['goods'] : '-'}}</td>
                    <td colspan="2" class="left">{{isset($value['variety']) ? $value['variety'] : '-'}}</td>
                    <td colspan="2" class="left">{{isset($value['size']) ? $value['size'] : '-'}}</td>
                    <td colspan="2" class="left">{{isset($value['packaging_type']) ? $value['packaging_type'] : '-'}}</td>
                    <td colspan="2" class="left">{{isset($value['temperature']) ? $value['temperature'] : '-'}}</td>
                     
				 </tr>
		  	  
	 </tbody>
	 </table>
   
   <p style="margin-top:10px;"><b>Trailer Type : </b>{{isset($value['trailer']) ? $value['trailer'] : '-'}}</p>
  
  <table style="width:100%;margin:0;border-bottom:1px solid #000;">
  <tbody>
  <tr>
				 <th colspan="3" class="left">Truck Plates</th>
				 <th colspan="3" class="left">Driver's Name</th>
				 <th colspan="3" class="left">Driver's Phone Number</th>
				 
				 </tr>
				  <tr>
				    <td colspan="3" class="left">{{isset($value['truckplate']) ? $value['truckplate'] : '-'}}</td>
                    <td colspan="3" class="left">{{isset($value['drivername']) ? $value['drivername'] : '-'}}</td>
                    <td colspan="3" class="left">{{isset($value['driverphone']) ? $value['driverphone']: '-'}}</td>
                    
				 </tr>
				 
				 
  </tbody>
  </table>
  
   <p><b>Freight Cost : </b>{{isset($value['freight_cost']) ? $value['freight_cost'] : '-'}}</p>
   <p><b>Payment Terms (days) : </b>{{isset($value['payment_term']) ? $value['payment_term'] : '-'}}</p>
   <p><b>Payment Type : </b>{{isset($value['payment_type']) ? $value['payment_type'] : '-'}}</p>
   <p><b>Notes : </b>{{isset($value['notes']) ? $value['notes'] : '-'}}</p>
	<br/>		 
	<br/>		 
	 		</div>
			
              @endforeach   
                @endif
            
       
    </header>
</body>

</html>
    