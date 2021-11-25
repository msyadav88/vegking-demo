<?php

namespace App\Exports;

use App\Stock;
use App\Product;
use App\ProductSpecification;
use App\ProductSpecificationValue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StocksExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Stock::with('product', 'seller', 'offerProperty', 'offerProperty.productSpec', 'offerProperty.productSpecValue')->get();
        if (auth()->user()->hasRole('seller')) {
            $seller_id = get_buyer_by_user_id()->id;
            $data = Stock::with('product', 'seller', 'variety_detail', 'packing_detail', 'flesh_color_detail', 'pallets_available')->where('seller_id', $seller_id)->get();
        }
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
        $stocks_array[] = array();
        foreach ($data as $stock) {
            $arrFields  = array();
            foreach ($stock->offerProperty as $prop) {
                if ($prop->productSpec->field_type == 'dropdown_switchboxes') {
                    $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                } else {
                    $arrFields[$prop->product_spec_id][] = @$prop->value;
                }
            }
            if (is_array($arrFields) && !empty($arrFields[@$field1])) {
                $field1data = implode(', ', @$arrFields[@$field1]);
            } else {
                $field1data = '-';
            }
            if (is_array($arrFields) && !empty($arrFields[@$field2])) {
                $field2data = implode(', ', @$arrFields[@$field2]);
            } else {
                $field2data = '-';
            }
            if ($field3 == '') {
                $field3data = '';
            } else {
                $arrFields  = array();
                foreach ($stock->offerProperty as $prop) {
                    if ($prop->productSpec->field_type == 'dropdown_switchboxes') {
                        $arrFields[$prop->product_spec_id][] = @$prop->productSpecValue->value;
                    } else {
                        $arrFields[$prop->product_spec_id][] = @$prop->value;
                    }
                }
                if (is_array($arrFields) && !empty($arrFields[@$field3])) {
                    $field3data = implode(', ', @$arrFields[@$field3]);
                } else {
                    $field3data = '-';
                };
            }
            if ($stock->pallets_available == 1) {
                $pallet = 'Yes';
            } else {
                $pallet = 'No';
            }
            $stocks_array[] = array(
                isset($stock->id) ? $stock->id : '',
                isset($stock->seller->username) ? $stock->seller->username : '',
                isset($stock->product->name) ? $stock->product->name : '',
                isset($field1data) ? $field1data : '',
                isset($field2data) ? $field2data : '',
                isset($field3data) ? $field3data : '',
                isset($stock->size_from) && $stock->size_to ? $stock->size_from . '-' . $stock->size_to : '',
                isset($stock->seller->country) ? $stock->seller->country : '',
                isset($stock->price) ? $stock->price : '',
                isset($pallet) ? $pallet : '',
                isset($stock->status) ? $stock->status : '',
            );
        }
        return collect($stocks_array);
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
            'Seller',
            'Product',
            (isset($arrayVal[0])) ? $arrayVal[0] : '',
            (isset($arrayVal[1])) ? $arrayVal[1] : '',
            (isset($arrayVal[2])) ? $arrayVal[2] : '',
            'Size From-To',
            'Country',
            'Price',
            'Pallets',
            'Status',
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
