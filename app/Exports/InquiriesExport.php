<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InquiriesExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Order::with('product', 'buyer', 'variety_detail', 'packing_detail', 'flesh_color_detail')->get();
        $inquiry_array[] = array();
        foreach($data as $inquiry)
        {
            $inquiry_array[] = array(
                isset($inquiry->id) ? $inquiry->id : '',
                isset($inquiry->buyer->id) ? $inquiry->buyer->id :'',
                isset($inquiry->buyer->username) ? $inquiry->buyer->username : '',
                isset($inquiry->packing_detail->name) ? $inquiry->packing_detail->name : '',
                isset($inquiry->flesh_color_detail->name) ? $inquiry->flesh_color_detail->name: '',
                isset($inquiry->product->name) ? $inquiry->product->name : '',
                isset($inquiry->created_at) ? $inquiry->created_at : '',
            );
        }
        return collect($inquiry_array);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Buyer Id',
            'Buyer Name',
            'Packing Detail Name',
            'Flesh Color Detail Name', 
            'Product Name',
            'Created Date',
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
