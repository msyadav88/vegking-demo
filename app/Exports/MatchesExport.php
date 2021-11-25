<?php

namespace App\Exports;

use App\Match;
use App\Product;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MatchesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $product = Product::all()->where('status', '1')->first();
        $ProdSpecArr = ProductSpecification::where('product_id', @$product->id)->where('parent_id', NULL)->orderBy('order')->limit(3)->pluck('display_name', 'id')->toArray();
        $ProdSpecArrKeys = array_keys($ProdSpecArr);
        $field1 = current($ProdSpecArrKeys);
        if (count($ProdSpecArrKeys) > 1) {
            $field2 = next($ProdSpecArrKeys);
        } else {
            $field2 = '';
        }

        if (count($ProdSpecArrKeys) > 2) {
            $field3 = end($ProdSpecArrKeys);
        } else {
            $field3 = '';
        }
        $matches_array[] = array();
        foreach ($this->data as $match) {
            foreach($match->stock->offerProperty as $prop){
                $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
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
            };
            
            $matches_array[] = array(
                isset($match->id) ? $match->id : '',
                isset($match->stock_id) ? $match->stock_id : '',
                isset($match->buyerPref->buyer->username) ? $match->buyerPref->buyer->username : '',
                isset($match->stock->seller->username) ? $match->stock->seller->username : '',
                isset($match->stock->product->name) ? $match->stock->product->name : '',
                isset($field1data) ? $field1data : '',
                isset($field2data) ? $field2data : '',
                isset($field3data) ? $field3data : '',
                isset($match->profit_per_ton) ? $match->profit_per_ton : ''
            );
        }
        return collect($matches_array);
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
            'Stock ID',
            'Buyer',
            'Seller',
            'Product',
            $arrayVal[0],
            $arrayVal[1],
            $arrayVal[2],
            'P/Ton'
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
