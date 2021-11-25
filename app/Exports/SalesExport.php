<?php

namespace App\Exports;

use App\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Sale::with('buyer', 'paymentType', 'paymentTerms', 'currencyId')->get();
       
        $sales_array[] = array();
        foreach($data as $sale)
        {
            $sales_array[] = array(
                isset($sale->id) ? $sale->id : '',
                isset($sale->price) ? $sale->price : '',
                isset($sale->buyer->username) ? $sale->buyer->username :'',
                isset($sale->paymentTerms->name) ? $sale->paymentTerms->name : '',
                isset($sale->paymentType->name) ? $sale->paymentType->name : '',
                isset($sale->currencyId->name) ? $sale->currencyId->name : '-',
                isset($sale->created_at) ? $sale->created_at : '',
            );
        }
        return collect($sales_array);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Price',
            'Buyer Username',
            'Payment Terms Name',
            'Payment Type Name', 
            'Currency Name', 
            'Date',
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
