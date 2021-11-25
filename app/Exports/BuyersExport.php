<?php

namespace App\Exports;

use App\Buyer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BuyersExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Buyer::where('status', '1')->with('product_detail')->get();
        $buyer_array[] = array();
        foreach($data as $buyer)
        {
            $balance = 0;
            if($buyer->balanceitems){
				$credit_limit = $buyer->credit_limit;
				$unpaid = $buyer->balanceitems->sum('price');
				$balance = $credit_limit - $unpaid;
            }

            $buyer_array[] = array(
                $buyer->id,
                isset($buyer->username) ? $buyer->username : ' - ',
                isset($buyer->email) ? $buyer->email : ' - ',
                isset($buyer->phone) ? $buyer->phone : ' - ',
                isset($buyer->company) ? $buyer->company : ' - ',
                isset($buyer->purposes) ? implode(', ', array_keys(json_decode($buyer->purposes, true))) : '-',
                isset($buyer->flesh_color) ? implode(', ', array_keys(json_decode($buyer->flesh_color, true))) : '-',
                isset($buyer->postalcode) ? $buyer->postalcode : '-',
                isset($buyer->transportation) ? $buyer->transportation : '-',
                isset($buyer->truck_quantity) ? $buyer->truck_quantity : '-',
                isset($balance) ? $balance : '0',
                isset($buyer->status) ? 'Active' : 'Deactive',
                isset($buyer->created_at) ? $buyer->created_at : '-'
            );
        }
        return collect($buyer_array);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Username',
            'Email',
            'Phone',
            'Company',
            'Purpose', 
            'Flesh Color', 
            'Post Code',
            'Extra transport cost per ton',
            'Number of Trucks Loads Desired Per Week',
            'Balance',
            'Status',
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
