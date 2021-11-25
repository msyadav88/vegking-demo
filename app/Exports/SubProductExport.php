<?php

namespace App\Exports;

use App\SubProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SubProductExport implements FromCollection,WithHeadings,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
        $data = SubProduct::where('status', '1')->get();
       
        $subproduct_array[] = array();
        foreach($data as $subproduct)
        {
            $subproduct_array[] = array(
                $subproduct->id,
                isset($subproduct->sub_pro_name_en) ? $subproduct->sub_pro_name_en : ' - ',
                isset($subproduct->sub_pro_name_pl) ? $subproduct->sub_pro_name_pl : ' - ',
                isset($subproduct->sub_pro_name_de) ? $subproduct->sub_pro_name_de : ' - ',
                isset($subproduct->sub_pro_type) ? $subproduct->sub_pro_type : ' - ',
                isset($subproduct->status) ? $subproduct->status : ' - ',
                isset($subproduct->created_at) ? $subproduct->created_at : ' - ',
            );
        }
        return collect($subproduct_array);
    }
    public function headings(): array
    {
        return [
            'Id',
            'sub_pro_name_en',
            'sub_pro_name_pl',
            'sub_pro_name_de',
            'sub_pro_type',
            'status',
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
