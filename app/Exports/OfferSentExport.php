<?php

namespace App\Exports;


use App\Stock;
use App\Order;
use App\Seller;
use App\Buyer;
use App\Match;
use App\OfferSent;
use App\Product;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OfferSentExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = OfferSent::with('stock', 'match', 'buyer', 'stock.seller', 'stock.product', 'stock.offerProperty')
        ->join('stocks', function ($join) {
            $join->on('stocks.id', '=', 'offersent.stock_id');
        })->orderBy('stocks.id', 'DESC')
        ->select('offersent.*', 'stocks.*')
        ->get();
            $product = Product::all()->where('status', '1')->first();
            $ProdSpecArr = ProductSpecification::where('product_id', @$product->id)->where('parent_id', NULL)->orderBy('order')->limit(3)->pluck('display_name', 'id')->toArray();
            $ProdSpecArrKeys = array_keys($ProdSpecArr);
        $field1 = current($ProdSpecArrKeys);
        if(count($ProdSpecArrKeys) > 1){
            $field2 = next($ProdSpecArrKeys);
        } else {
            $field2 = '';
        }
        if(count($ProdSpecArrKeys) >2){
            $field3 = end($ProdSpecArrKeys);
        } else {
            $field3 = '';
        }
        $offersent_array[] = array();
        foreach ($data as $offersent) {
            $arrFields  = array();
            foreach($offersent->stock->offerProperty as $prop){
                $arrFields[$prop->product_spec_id][] = isset($prop->productSpecValue->value)?$prop->productSpecValue->value:'';
            }
            if(is_array($arrFields)&& !empty($arrFields[@$field1])){
                $field1data = implode(', ',@$arrFields[@$field1]);
            } else {
                $field1data = '-';
            }
            if(is_array($arrFields)&& !empty($arrFields[@$field2])){
                $field2data = implode(', ',@$arrFields[@$field2]);
            } else {
                $field2data = '-';
            }
            if(is_array($arrFields)&& !empty($arrFields[@$field3])){
                $field3data = implode(', ',@$arrFields[@$field3]);
            } else {
                $field3data = '-';
            }
            $offersent_array[] = array(
                isset($offersent->id) ? $offersent->id : '',
                isset($offersent->buyer->name) ? $offersent->buyer->name : '',
                isset($offersent->buyer->company) ? $offersent->buyer->company : '',
                isset($offersent->stock->product->name) ? $offersent->stock->product->name : '',
                isset($field1data) ? $field1data : '',
                isset($field2data) ? $field2data : '',
                isset($field3data) ? $field3data : '',
                isset($offersent->stock->size_from) ? $offersent->stock->size_from : '',
                isset($offersent->stock->size_to) ? $offersent->stock->size_to : '',
                isset($offersent->stock->quantity) ? $offersent->stock->quantity : '',
                isset($offersent->stock->price) ? $offersent->stock->price : ''
            );
        }
        return collect($offersent_array);
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
            'Buyer',
            'Company',
            'Product Name',
            $arrayVal[0],
            $arrayVal[1],
            $arrayVal[2],
            'Size From',
            'Size To',
            'Quantity',
            'Price',
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
