
{<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        .logo {
            text-align: center;
        }

        .right {
            text-align: right;
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
            margin-top: 5px
        }

        .footer-logo {
            margin-top: 50px
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img class="navbar-brand-full" src="img/{{ Settings()->site_logo }}" width="170" height="30" alt="" />
        </div>
        <div class="left" style="margin-top:20px">
            <span>Warsaw, <?php $time = strtotime(date("Y-m-d"));
                        $newformat = date('M d, Y', $time);
                        echo $newformat ?></span>
        </div>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr><td style="height:30px;"></td></tr>
          <tr>
            <td valign="top"><p><b>Commercial offer for:<b></p></td>
            <td valign="top" align="right"><div class="right" style="line-height: 0.4;">
                    <p>Company Name: {{ $matches->buyerPref->buyer->company ? $matches->buyerPref->buyer->company  : ''}}</p>
                    <p>Address: {{ $matches->buyerPref->buyer->address ? $matches->buyerPref->buyer->address  : ''}}</p>
                    @if(isset($matches->buyerPref->buyer->postalcode))<p>{{ $matches->buyerPref->buyer->postalcode ? $matches->buyerPref->buyer->postalcode : ''}} @if(isset($matches->buyerPref->buyer->city)), {{ $matches->buyerPref->buyer->city ? $matches->buyerPref->buyer->city : ''}}@endIf @if(isset($matches->buyerPref->buyer->country)), {{ $matches->buyerPref->buyer->country ? $matches->buyerPref->buyer->country : ''}}@endIf</p>@endIf
                </div></td>
          </tr>
        </table>



        <div class="center" style="margin-top:5px">
            <p>Dear {{isset($matches->buyerPref->buyer->name) ? $matches->buyerPref->buyer->name : 'Sir or Madam'}},</p>
            <p>We appreciate your interest in our assortment. The Company Veg King Europe Sp. z o.o. is pleased to present our commercial offer for the sale of <strong>{{isset($matches->stock->product->name) ? $matches->stock->product->name : ''}}</strong>.</p>
        </div>
        <div class="center">
            <p>Commercial offer number <b>5060{{ $matches->id ? $matches->id : ''}}/<?php echo date('Y'); ?> </b>from <?php $time = strtotime(date("Y-m-d"));
                                                                                                                        $newformat = date('M d, Y', $time);
                                                                                                           echo $newformat ?></p>
        </div>
        <table class="article">
            <tbody>
                <tr class="products">
                    <th class="products1">Product</th>
                    @foreach($matches->offerproperty as $spec)
                    <th class="products1">{{ $spec->productspec->display_name }}</th>
                    @endforeach
                    <th class="products1">Size</th>
                    <th class="products1">Price</th>
                </tr>
                @if(isset($matches->stock->product))
                <tr>
                    <td class="products2">{{isset($matches->stock->product->name) ? $matches->stock->product->name : ''}}</td>
                    @foreach($matches->offerproperty as $spec)
                    <td class="products2">{{ isset($spec->productspecvalue->value)? $spec->productspecvalue->value:'' }}</td>
                    @endforeach
                    <td class="products2">{{isset($matches->stock->size_from) ? $matches->stock->size_from : ''}} - {{isset($matches->stock->size_to) ? $matches->stock->size_to : ''}}</td>
                    <td class="products2">{{isset($matches->stock->price) ? number_format($matches->stock->price/1000,2).' PLN/kg*' : ''}}</td>
                </tr>
                @endIf
            </tbody>
        </table>
        <p style="color:red;margin-top:-1px;font-size:12;">*the price is valid for a minimum quantity of 24t</p>
        @if(isset($notes))
        <div><b>Addition Information:</b> {{isset($notes) ? $notes : ''}} </div>
        @endif
        
        @if($matches->stock->image != 'null' && !empty($matches->stock->image))
        <div class="center" style="margin:15px 0">
        @foreach(json_decode($matches->stock->image, true) as $stock_img)  
            @if(file_exists(public_path().'/images/stock/'.$stock_img))
            <img  src="images/stock/{{$stock_img}}" width="100" />
            @else
            <img  src="images/products/no_img.png" width="100" />
            @endif
        @endforeach
        </div>
        @endif  

        <div class="additional_info">
            <p><b>The offer is valid until : <?php
                $date = strtotime(date("Y-m-d"));
                $date = strtotime("+7 day", $date);
                echo date('M d, Y', $date); ?> </b></p>
            <p>We invite you to visit our website <a href="https://www.vegking.eu" target="_blank">www.vegking.eu</a></p>
            <p>You can get additional information about our products from our consultant: </p>

            <table border="0" collspacing="0" collpadding="0" width="200">
                <tr>
                    <td border="0" colspan="2">
                        <p><b> {{$user->name ? $user->name :''}}</b></p>
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
        <div class="center footer-logo" style="margin-top:50px;">
            <img class="navbar-brand-full" src="http://dev.vegking.eu/img/vegking-logo-icon-1568902551.png" width="30" height="30" alt="" /><br>
            <img class="navbar-brand-full" src="img/{{ Settings()->site_logo }}" width="100" height="20" alt="" />
            <p class="center">Veg King Europe Sp. Z o.o., u. Grzybowska 80/82, Polska 00-884, Warszawa, NIP:5272869217</p>
        </div>
    </header>
</body>

</html>}
