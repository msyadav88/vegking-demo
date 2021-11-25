<?php

namespace App\Exports;


use App\Sale;
use App\TransLoad;
use App\Carrier;
use App\Transportlist;
use App\Transshipper;
use App\Transconsignee;
use App\Product;
use App\Loadstatus;
use App\SaleTruck;
use App\Buyer;
use App\Stock;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $transportlist1 = TransLoad::get();
		$carrieroptions = Carrier::get();
		$transportArr[] = array();
		foreach($transportlist1 as $transvalue) {
			$sales = Sale::where('id',$transvalue->salesid)->first();
			$product = Product::where('id', $transvalue['goods'])->first();
			$productname = @$product->name;
			$payment_terms = \App\AppHead::where('type', 'payment_terms')->where('id',$transvalue['payment_term'])->first();
			$payment_type = \App\AppHead::where('type', 'payment_type')->where('id',$transvalue['payment_type'])->first();
			$checktranslist = Transportlist::where('id',$transvalue->transport_id)->first();
			$saletruck = SaleTruck::where('sale_id',$transvalue->salesid)->first();
			$buyer = Buyer::where('id',@$sales->buyer_id)->first();
			$offer = Stock::with('seller')->where('id', @$sales->stock_id)->first();
			$seller_username = '';
			if(!empty($offer)){
				$seller_username = @$offer->seller->username;
			}
			else{
				$seller_username = '-';
			}
			$offer_country = '';
			if(!empty($buyer)){
				$username = $buyer->username;
			}
			else{
				$username = '-';
			}
		 	if(!empty($checktranslist)){
				$carrier = $checktranslist['carrier'];
				$plateno = $checktranslist['plate_numbers'];
			}
			else{
				$carrier = '-';
				$plateno = '-';
			} 
			if(!empty($offer->country)){
				$offer_country = $offer->country;
			}
			$trans_id = $trans_variety = $trans_size = $trans_loaded_weight = $trans_unloaded_weight = $trans_difference = $trans_number_of_packing_units = $trans_requirements = $trans_freight_cost = $trans_payment_status = $trans_created_at = '';
			
			if(!empty($transvalue['id']))
				$trans_id = $transvalue['id'];
			if(!empty($transvalue['variety']))
				$trans_variety = $transvalue['variety'];
			if((!empty($transvalue['size_from'])) && (!empty($transvalue['size_to'])))
				$trans_size = $transvalue['size_from'].'-'.$transvalue['size_to'];
			if(!empty($transvalue['loaded_weight']))
				$trans_loaded_weight = $transvalue['loaded_weight'];
			if(!empty($transvalue['unloaded_weight']))
				$trans_unloaded_weight = $transvalue['unloaded_weight'];
			if(!empty($transvalue['difference']))
				$trans_difference = $transvalue['difference'];
			if(!empty($transvalue['number_of_packing_units']))
				$trans_number_of_packing_units = $transvalue['number_of_packing_units'];
			if(!empty($transvalue['requirements']))
				$trans_requirements = $transvalue['requirements'];
			if(!empty($transvalue['freight_cost']))
				$trans_freight_cost = $transvalue['freight_cost'];
			if(!empty($transvalue['payment_status']))
				$trans_payment_status = $transvalue['payment_status'];
			if(!empty($transvalue['created_at']))
				$trans_created_at = $transvalue['created_at'];
			
            $transportArr []=[ 
				"id"=>$trans_id,
				"goods"=>$productname,
				"variety"=>$trans_variety,
				"size"=>$trans_size,
				"loaded_weight"=>$trans_loaded_weight,
				"unloaded_weight"=>$trans_unloaded_weight,
				"difference"=>$trans_difference,
				"freight_cost"=>$trans_freight_cost,
				"payment_status"=>$trans_payment_status,
				"loaddate"=> $trans_created_at,
				"unloaddate"=> $saletruck['delivery_date'],
				"loadloc"=> $offer_country,
				"unloadloc"=> $saletruck['delivery_location'],
				"plateno"=> $plateno,
				"carrier"=> $carrier,
				"buyer"=> $username,
				"seller"=> $seller_username,
				
			];
        }
        return collect($transportArr);
    }

    public function headings(): array
    {
        $product = Product::all()->where('status', '1')->first();
        $ProdSpecArr = ProductSpecification::where('product_id', @$product->id)->where('parent_id', NULL)->orderBy('order')->limit(3)->pluck('display_name', 'id')->toArray();
        foreach ($ProdSpecArr as $value) {
            $arrayVal[] = $value;
        }
        return [
            'Id',
            'Product',
            'Variety',
            'Size',
            'Loaded Weight',
            'Unloaded Weight',
            'Difference',
            'Freight Cost',
            'Status',
            'Load Date',
            'Unload Date',
            'Load Location',
            'Unload Location',
            'Truck Plates',
            'Carrier',
            'Buyer',
            'Seller',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:W1')->applyFromArray([
                    'font' => [
                        'name' => 'Arial',
                        'size' => 12,
                        'bold' => true
                    ]
                ]);
            },
        ];
    }
}
