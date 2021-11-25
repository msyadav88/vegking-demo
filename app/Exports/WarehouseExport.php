<?php

namespace App\Exports;

use App\Warehouse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class WarehouseExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Warehouse::with('stock','sale')->get();
        $warehouse_array[] = array();
        foreach($data as $warehouse)
        {
            $warehouse_array[] = array(
                $warehouse->id,
                isset($warehouse->stock->flesh_color_detail->name) ? $warehouse->stock->flesh_color_detail->name : ' - ',
                isset($warehouse->stock->purposes) ? (is_array(json_decode(@$warehouse->stock->purposes,true)) ? implode(',',@json_decode(@$warehouse->stock->purposes,true)) : '') : ' - ',
                isset($warehouse->stock->defect) ? (is_array(json_decode(@$warehouse->stock->defect,true)) ? implode(',',@json_decode(@$warehouse->stock->defect,true)) : '') : ' - ',
                isset($warehouse->stock->soil) ? (is_array(json_decode(@$warehouse->stock->soil,true)) ? implode(',',@json_decode(@$warehouse->stock->soil,true)) : '') : ' - ',
                isset($warehouse->stock->variety_detail->name) ? $warehouse->stock->variety_detail->name : ' - ',
                isset($warehouse->country) ?  $warehouse->country : '-',
                isset($warehouse->city) ? $warehouse->city : '-',
                isset($warehouse->postcode) ? $warehouse->postcode : '-',
                isset($warehouse->tons) ? $warehouse->tons : '-',
                isset($warehouse->product) ? $warehouse->product : '-',
                isset($warehouse->dateStored) ? $warehouse->dateStored : '-',
                isset($warehouse->notes) ? $warehouse->notes : '-',
            );
        }
        return collect($warehouse_array);
    }
    public function headings(): array
    {
        return [
            'Id',
            'Flesh Color',
            'Purposes',
            'Defect',
            'Soil',
            'Variety Detail', 
            'Country',
            'City',
            'Postcode', 
            'Tons',
            'Product',
            'Date Stored', 
            'Notes', 
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
