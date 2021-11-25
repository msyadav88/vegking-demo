<?php

namespace App\Exports;

use App\ProductSpecificationValue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductspecsvaluesExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        $productspecvalues_array[] = array();
        foreach($this->data as $productspecvalues)
        {
            $productspecvalues_array[] = array(
                $productspecvalues->id,
                isset($productspecvalues->product->name) ? $productspecvalues->product->name : ' - ',
                (@$productspecvalues->product_specification->display_name?@$productspecvalues->product_specification->display_name:''),
                isset($productspecvalues->value) ? $productspecvalues->value : ' - ',
            );
        }
        return collect($productspecvalues_array);
    }
    public function headings(): array
    {
        return [
            'Id',
            'Product',
            'Product Specification',
            'Value'
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
