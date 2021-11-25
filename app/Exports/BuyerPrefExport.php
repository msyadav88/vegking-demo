<?php

namespace App\Exports;

use App\BuyerPref;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Buyer;

class BuyerPrefExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = BuyerPref::with('product', 'buyer')->get();
        if(auth()->user()->hasRole('buyer')){
            $buyer = Buyer::select('id')->where('user_id',auth()->user()->id)->first();
            $data = BuyerPref::with('product', 'buyer')->where(['buyer_id' => $buyer->id])->get();
          }
        $buyerpref_array[] = array();
        foreach($data as $buyerpref)
        {
              $buyerpref_array[] = array(
                $buyerpref->id,
                isset($buyerpref->buyer->username) ? $buyerpref->buyer->username : ' - ',
                isset($buyerpref->product->name) ? $buyerpref->product->name : ' - ',
                isset($buyerpref->created_at) ? $buyerpref->created_at : '-'
            );
        }
        return collect($buyerpref_array);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Username',
            'Producy Name',
            'Date'
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

