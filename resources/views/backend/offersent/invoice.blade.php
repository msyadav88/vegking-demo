
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
        <style>
            .center{text-align:center}
            table{width:100%;margin-top:10px;}
            table th{text-align:left;background-color:lightgray}
            .additional_info{margin-top:10px;}
            header{border:1px solid black; padding:20px;}
            address{text-align:right}
        </style>
	</head>
	<body>
		<header>
            <address>
                <p><b>Commercial offer for the company <b></p>
                <p>{{ $matchestemp->buyer->company ? $matchestemp->buyer->company  : ''}}</p>
            </address>

           <p class="center"> Dear {{$matchestemp->buyer->name ? $matchestemp->buyer->name : 'Sir or Madam'}},</p>
            <p>We appreciate your interest in our assortment. The Company Veg King Europe Sp. z o.o.  is pleased to present our commercial offer for the sale of products.</p>

            <div class="center">
                <p>Commercial offer number <b>5060{{ $matchestemp->id ? $matchestemp->id : ''}} </b></p>
                <p>from <?php $time = strtotime($matchestemp->created_at);
                        $newformat = date('M d, Y',$time);
                        echo $newformat ?></p>
            </div>
           
           <table class="article">
                <tbody>  
                    <tr>
                        <th>Product</th>
                        <th>Variety</th>
                        <th>Size</th>
                        <th>Color</th>
                        <!-- <th>Dry matter</th> -->
                        <th>Packing</th>
                        <th>Price</th>
                    </tr>
                    @if($matchestemp->product)
                    <tr>
                        <td>{{$matchestemp->product->name ? $matchestemp->product->name : ''}}</td>
                        <td>{{$matchestemp->product->variety ? $matchestemp->product->variety : ''}}</td>
                        <td>{{$matchestemp->product->size_from ? $matchestemp->product->size_from : ''}} - {{$matchestemp->product->size_to ? $matchestemp->product->size_to : ''}}</td>
                        <td>{{$matchestemp->product->flesh_color ? $matchestemp->product->flesh_color : ''}}</td>
                        <!-- <td>{{$matchestemp->product->name ? $matchestemp->product->name : ''}}</td> -->
                        <td>{{$matchestemp->product->packing ? $matchestemp->product->packing : ''}}</td>
                        <td>{{$matchestemp->product->price ? $matchestemp->product->price : ''}}</td>
                    </tr>
                    @endIf
                </tbody>
           </table>

           <div class="additional_info">
                <p>*the price is valid for a minimum quantity of 24t</p>
                <img src="https://www.gravatar.com/avatar/165121baa7671833d4caa98b1d45a149.jpg?s=80&d=mm&r=g" onerror="this.onerror=null; this.src='https://www.gravatar.com/avatar/165121baa7671833d4caa98b1d45a149.jpg?s=80&d=mm&r=g'" alt=""/>

                <p>The offer is valid until :  <?php 
                        $date = strtotime($matchestemp->created_at);
                        $date = strtotime("+7 day", $date);
                        echo date('M d, Y', $date);?> </p>
                <p>We invite you to visit our website <a href="https://www.vegking.eu" target="_blank">www.vegking.eu</a></p>
                <p>You can get additional information about our products from our consultant: </p>
                <p>{{$user->name ? $user->name :''}}</p>
                <p>(icon) tel. kom.: {{$user->phone ? $user->phone :''}}, </p>
                <p>(icon) e-mail.:{{$user->email ? $user->email :''}}</p>
            </div>
            <footer>
                <p>Veg King Europe Sp. Z o.o., u. Grzybowska 80/82, Polska  00-884, Warszawa, NIP:5272869217</p>
            </footer>
        </header>
	</body>
</html>