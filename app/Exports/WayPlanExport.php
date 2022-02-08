<?php

namespace App\Exports;

use App\WayPlanSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class WayPlanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return WayPlanSchedule::where('reject_status',0)->get();
    }
    public function headings(): array
    {
        return [
            'id',
            'token',
            'customer_name',
            'customer_phone',
            'receive_point',
            'receive_date',
        ];
    }
}
