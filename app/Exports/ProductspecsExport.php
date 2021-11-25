<?php

namespace App\Exports;

use App\ProductSpecification;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductspecsExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
        $data = ProductSpecification::with('product','parent_spec')->get();
        $productspec_array[] = array();
        foreach($data as $productspec)
        {
            $productspec_array[] = array(
                $productspec->id,
                isset($productspec->product->name) ? $productspec->product->name : ' - ',
                (@$productspec->parent_spec->display_name?@$productspec->parent_spec->display_name.":":'').(@$productspec->display_name?@$productspec->display_name:'-'),
                isset($productspec->importance) ? $productspec->importance : ' - ',
                isset($productspec->order) ? $productspec->order : ' - ',
                isset($productspec->buyer_hasmany) ?  $productspec->buyer_hasmany : '-',
                isset($productspec->stock_hasmany) ?  $productspec->stock_hasmany : '-',
                isset($productspec->required) ? $productspec->required : '-',
                isset($productspec->default_val) ? $productspec->default_val : '-',
            );
        }
        return collect($productspec_array);
    }
    public function headings(): array
    {
        return [
            'Id',
            'Product',
            'Display Name',
            'Importance',
            'Order', 
            'Buyer Hasmany', 
            'Stock Hasmany', 
            'Required',
            'Default Value'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
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
