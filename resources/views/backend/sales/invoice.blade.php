<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
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

        .article,
        .products1,
        .products2 {
            border: 1px solid black;
        }

        .additional_info {
            margin-top: 15px
        }

        .footer-logo {
            margin-top: 50px
        }
        
    </style>
</head>

<body>
    <header>
        <div class="logo">
        <img class="navbar-brand-full" src="http://dev.vegking.eu/img/vegking-logo-icon-1568902551.png" width="30" height="30" alt="" /><br>
        <img class="navbar-brand-full" src="http://dev.vegking.eu/img/vegking-logo-1568902551.png" width="100" height="20" alt="" />
        </div>
        <div class="address-main">
            <div class="wrapper">
                <div class="box a">
                    <div class="left" >
                        <p><b>{{isset($sales->buyer->username)?$sales->buyer->username:''}}<b></p>
                        @if(isset($sales->buyer->company))<p>{{ $sales->buyer->company ? $sales->buyer->company  : ''}}</p>@endIf
                        @if(isset($sales->buyer->address))<p>{{ $sales->buyer->address ? $sales->buyer->address  : ''}}</p>@endIf
                        @if(isset($sales->buyer->city))<p>{{ $sales->buyer->city ? $sales->buyer->city : ''}} @if(isset($sales->buyer->postalcode)), {{ $sales->buyer->postalcode ? $sales->buyer->postalcode : ''}}@endIf</p>@endIf
                        <!-- <p>Warsaw, <?php $time = strtotime(date("Y-m-d"));
                                    $newformat = date('M d, Y', $time);
                                    // echo $newformat ?></p> -->
                        @if(isset($sales->buyer->phone))<p>{{ $sales->buyer->phone ? $sales->buyer->phone  : ''}}</p>@endIf
                    </div>
                </div>
            </div>
            </br>
            <div class="wrapper">
                <div class="box a">
                    <div class="right" >
                        @if(isset($sales->stock->seller->username))<p><b>{{ $sales->stock->seller->username ? $sales->stock->seller->username  : ''}}</p></b>@endIf
                        @if(isset($sales->stock->seller->company))<p>{{ $sales->stock->seller->company ? $sales->stock->seller->company  : ''}}</p>@endIf
                        @if(isset($sales->stock->seller->address))<p>{{ $sales->stock->seller->address ? $sales->stock->seller->address  : ''}}</p>@endIf
                        @if(isset($sales->stock->seller->city))<p>{{ $sales->stock->seller->city ? $sales->stock->seller->city : ''}} @if(isset($sales->stock->seller->postalcode)), {{ $sales->stock->seller->postalcode ? $sales->stock->seller->postalcode : ''}}@endIf</p>@endIf
                        <!-- <p>Warsaw, <?php $time = strtotime(date("Y-m-d"));
                                    $newformat = date('M d, Y', $time);
                                    // echo $newformat ?></p> -->
                        @if(isset($sales->stock->seller->phone))<p>{{ $sales->stock->seller->phone ? $sales->stock->seller->phone  : ''}}</p>@endIf
                    </div>
                </div>
            </div>
        </div>
        
       
        <div class="center" style="margin-top:20px">
            <p>Commercial offer number <b>{{isset($PurchaseOrder)?$PurchaseOrder->id:''}}/<?php echo date('Y'); ?> </b>from <?php $time = strtotime(date("Y-m-d"));
                                                                                                                        $newformat = date('M d, Y', $time);
                                                                                                                        echo $newformat ?></p>
        
        </div>
        <table class="article">
            <tbody>
                <tr class="products">
                    <th class="products1" style="width:70px;text-align:center">SaleID</th>
                    <th class="products1" style="width:70px;text-align:center">Price</th>
                    <th class="products1" style="width:70px;text-align:center">Sale Date</th>
                    <th class="products1" style="width:70px;text-align:center">Pickup Date</th>
                    <th class="products1" style="width:70px;text-align:center">Delivery Date</th>
                    <th class="products1" style="width:70px;text-align:center">Delivery Location</th>
                    <th class="products1" style="width:70px;text-align:center">Truck Loads</th>
                    <th class="products1" style="width:70px;text-align:center">Load Status</th>
                </tr>
                @if(isset($sales->trucksone))
                @foreach($sales->trucksone as $key => $value)
                <tr>
                    <td class="products2 center">{{isset($value['sale_id']) ? $value['sale_id'] : ''}}</td>
                    <td class="products2 center">{{isset($value['price']) ? number_format($value['price'], 2, '.', '') : ''}}</td>
                    <td class="products2 center">{{isset($value['sale_date']) ? date('M d, Y', strtotime($value['sale_date'])): ''}}</td>
                    <td class="products2 center">{{isset($value['delivery_date']) ? date('M d, Y', strtotime("-4 day", strtotime($value['delivery_date']))): ''}}</td>
                    <td class="products2 center">{{isset($value['delivery_date']) ? date('M d, Y', strtotime($value['delivery_date'])): ''}}</td>
                    <td class="products2 center">{{isset($value['delivery_location']) ? $value['delivery_location'] : ''}}</td>
                    <td class="products2 center">{{isset($value['truck_loads']) ? $value['truck_loads'] : ''}}</td>
                    <td class="products2 center">{{isset($loads_status) ? $loads_status : ''}}</td>
                </tr>
                @endforeach
                @endIf
            </tbody>
        </table>
        <?php
                // $date = strtotime($sales->trucksone->delivery_date);
                // $date = strtotime("-4 day", $date);
                // echo date('M d, Y', $date); ?>
        
        <!-- <p style="color:red;margin-top:-1px;font-size:12;">*the price is valid for a minimum quantity of 24t</p> -->
        <div class="additional_info">
            <p><b>The offer is valid until : <?php
                $date = strtotime(date("Y-m-d"));
                $date = strtotime("+7 day", $date);
                echo date('M d, Y', $date); ?> </b></p>
            <p>Track status of this invoice at <a href="https://www.vegking.eu" target="_blank">www.vegking.eu</a></p>
            <p>You can get additional information about our products from our consultant: </p>

            <table border="0" collspacing="0" collpadding="0" width="200" style="margin-top:50px;">
                <tr>
                    <td border="0" colspan="2">
                        <p><b> {{$user->first_name ? $user->first_name :''}}</b></p>
                    </td>
                </tr>
                <tr>
                    <td border="0" width="40" height="40" style="border-radius:20%;"><img src="https://img.icons8.com/wired/2x/phone.png" style="border-radius:20%;width:30px;height:30px;" /></td>
                    <td border="0">
                        <p> {{$user->phone ? $user->phone :''}}</p>
                    </td>
                </tr>
                <tr>
                    <td border="0" width="40" height="40" style="border-radius:20%;"><img src="https://img.icons8.com/material-outlined/2x/important-mail.png" style="border-radius:30%;width:30px;height:30px;" /></td>
                    <td border="0">
                        <p> {{$user->email ? $user->email :''}}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="center footer-logo" style="margin-top:120px;">
            <img class="navbar-brand-full" src="http://dev.vegking.eu/img/vegking-logo-icon-1568902551.png" width="30" height="30" alt="" /><br>
            <img class="navbar-brand-full" src="http://dev.vegking.eu/img/vegking-logo-1568902551.png" width="100" height="20" alt="" />
            <p class="center">Veg King Europe Sp. Z o.o., u. Grzybowska 80/82, Polska 00-884, Warszawa, NIP:5272869217</p>
        </div>
    </header>
</body>

</html>