<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
        $data = Product::where('status', '1')->get();
        $product_array[] = array();
        foreach($data as $product)
        {
            $product_array[] = array(
                $product->id,
                isset($product->name) ? $product->name : ' - ',
                isset($product->status) ? $product->status : ' - ',
                isset($product->created_at) ? $product->created_at : ' - ',
            );
        }
        return collect($product_array);
    }
    public function headings(): array
    {
        return [
            'Id',
            'Product',
            'Status',
            'Created Date'
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
