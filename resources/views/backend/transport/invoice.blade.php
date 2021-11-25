{<html>

<head>
  
    <meta charset="utf-8">
    <title>Transport data</title>
    <style>
	@page {
            
			 border: 4px dotted blue;
        }
		p{margin:5px 0;}
		.col-md-4{
			width:33.33%;
			float: left;
			background:transparent;
		}
        .address-main{
            display: flex;
        }
        .wrapper {
            width: 50%;
            float: left;
        }
        .box { 
            border-radius: 5px;
            padding: 20px;
        }
        .logo {
            text-align: center;
			 
			padding:20px 0;
        }
		.shiprdiv{
			border-bottom:1px solid #000;
			margin-right:10px;
			margin-bottom:10px;
			padding-bottom:10px;
		}
		
        .right {
            text-align: right;
        }
        .left {
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .article {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse
        }

        .article .products .products1 {
            text-align: left;
            height: 30px
        }
	.articles{width:100%;margin-top: 20px;}
        .article,
        .articles,
        .products1,
        .products2 {
            border: 1px solid black;
        }
	.bordr{border: 1px solid black;}
.articles tr{margin-bottom:15px;}
        .additional_info {
            margin-top: 15px
        }

        .footer-logo {
            margin-top: 50px
        }
		.shpr{
			width:120px !important;
		}
		.articles .limit{width:200px;}
		.column {
		  float: left;
		  width: 50%;
		  background:transparent;
		}
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}
        @page {
		border:2px solid #000;	
		}
    </style>
</head>

<body>
    <header style="border:1px solid #000;padding:10px;">
      <!--  <div class="logo">
            <img class="navbar-brand-full" src="img/logokcharles.png" width="170" height="30" alt="" />
        </div>-->
         
         
        
                @if(count($transportArr2) > 0)
					<div class="row">
						<div class="col-md-4">
							<h4>Booking Confirmation</h4>
							<p><b>Ref : </b>{{$transportArr2[0]['id']}}</p>
							<p><b>Carrier : </b>{{isset($transportArr2[0]['carrier']) ? $transportArr2[0]['carrier'] : '-'}} </p>  
						</div>
						<div class="col-md-4">
							<div class="logo" style="width:100%;text-align: center;">
								<img style="background:#000;padding:20px 0;" class="navbar-brand-full" src="img/logokcharles.png" width="200" height="50" alt="" />
							</div>
						</div>
						<div class="col-md-4 right">
							<p style="margin-bottom: 0px;">K Charles Haulage LTD.,<br> 1000 Great West Rd.<br>
							 Brentford TW8 9HH, UK,<br>	VAT: GB313177820</p>
							<p style="margin-top: 5px;margin-bottom: 5px;">+44 203 290 2939</p>
							<p style="margin-top: 0;"><a href="mailto:transport@kcharles.co.uk">transport@kcharles.co.uk</a></p>
						</div>
					</div>
              <div class="row">
  <div class="column shiprmain">
     
    @if(count($transportArr2[0]['shipperall']) > 0)
				 	@foreach($transportArr2[0]['shipperall'] as $shipper)
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
	@if(count($transportArr2[0]['consigneeall']) > 0)
				 	@foreach($transportArr2[0]['consigneeall'] as $consignee)
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
				 <td colspan="2" class="left">{{isset($transportArr2[0]['goods']) ? $transportArr2[0]['goods'] : '-'}}</td>
                    <td colspan="2" class="left">{{isset($transportArr2[0]['variety']) ? $transportArr2[0]['variety'] : '-'}}</td>
                    <td colspan="2" class="left">{{isset($transportArr2[0]['size']) ? $transportArr2[0]['size'] : '-'}}</td>
                    <td colspan="2" class="left">{{isset($transportArr2[0]['packaging_type']) ? $transportArr2[0]['packaging_type'] : '-'}}</td>
                    <td colspan="2" class="left">{{isset($transportArr2[0]['temperature']) ? $transportArr2[0]['temperature'] : '-'}}</td>
                     
				 </tr>
		  	  
	 </tbody>
	 </table>
   
   <p style="margin-top:10px;"><b>Trailer Type : </b>{{isset($transportArr2[0]['trailer']) ? $transportArr2[0]['trailer'] : '-'}}</p>
  
  <table style="width:100%;margin:0;border-bottom:1px solid #000;">
  <tbody>
  <tr>
				 <th colspan="3" class="left">Truck Plates</th>
				 <th colspan="3" class="left">Driver's Name</th>
				 <th colspan="3" class="left">Driver's Phone Number</th>
				 
				 </tr>
				  <tr>
				    <td colspan="3" class="left">{{isset($transportArr2[0]['truckplate']) ? $transportArr2[0]['truckplate'] : '-'}}</td>
                    <td colspan="3" class="left">{{isset($transportArr2[0]['drivername']) ? $transportArr2[0]['drivername'] : '-'}}</td>
                    <td colspan="3" class="left">{{isset($transportArr2[0]['driverphone']) ? $transportArr2[0]['driverphone']: '-'}}</td>
                    
				 </tr>
				 
				 
  </tbody>
  </table>
  
   <p><b>Freight Cost : </b>{{isset($transportArr2[0]['freight_cost']) ? $transportArr2[0]['freight_cost'] : '-'}}</p>
   <p><b>Payment Terms (days) : </b>{{isset($transportArr2[0]['payment_term']) ? $transportArr2[0]['payment_term'] : '-'}}</p>
   <p><b>Payment Type : </b>{{isset($transportArr2[0]['payment_type']) ? $transportArr2[0]['payment_type'] : '-'}}</p>
   <p><b>Notes : </b>{{isset($transportArr2[0]['notes']) ? $transportArr2[0]['notes'] : '-'}}</p>
	<br>		 
	<br>		 
	<p><b>Terms & Conditions : </b></p>			
                 
                @endif
            
        <?php
                // $date = strtotime($sales->trucksone->delivery_date);
                // $date = strtotime("-4 day", $date);
                // echo date('M d, Y', $date); ?>
        
        
       <!-- <div class="center footer-logo" style="margin-top:120px;">
            <img class="navbar-brand-full" src="http://dev.vegking.eu/img/vegking-logo-icon-1568902551.png" width="30" height="30" alt="" /><br>
            <img class="navbar-brand-full" src="http://dev.vegking.eu/img/vegking-logo-1568902551.png" width="100" height="20" alt="" />
            <p class="center">Veg King Europe Sp. Z o.o., u. Grzybowska 80/82, Polska 00-884, Warszawa, NIP:5272869217</p>
        </div>-->
    </header>
</body>

</html>}