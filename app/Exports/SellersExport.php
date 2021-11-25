<?php

namespace App\Exports;

use App\Seller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SellersExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Seller::where('status', '1')->get();
        $seller_array[] = array();
        foreach($data as $seller)
        {
            $seller_array[] = array(
                $seller->id,
                isset($seller->username) ? $seller->username : ' - ',
                isset($seller->email) ? $seller->email : ' - ',
                isset($seller->phone) ? $seller->phone : ' - ',
                isset($seller->company) ? $seller->company : ' - ',
                isset($seller->city) ?  $seller->city : '-',
                isset($seller->postalcode) ? $seller->postalcode : '-',
                isset($seller->address) ? $seller->address : '-',
                isset($seller->country) ? $seller->country : '-',
                isset($seller->status) ? 'Active' : 'Deactive',
                isset($seller->created_at) ? $seller->created_at : '-'
            );
        }
        return collect($seller_array);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Username',
            'Email',
            'Phone',
            'Company',
            'City', 
            'Postal Code', 
            'Address',
            'Country',
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
