<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\WayPlanSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\FromArray;
class WayPlanQueryExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($from,$to,$date,$status) {
        $this->from = $from;
        $this->to = $to;
        $this->date = $date;
        $this->status = $status;
        }
    public function collection()
    {
        
        if($this->status = 1)
        {
             $way = WayPlanSchedule::where('receive_point',$this->from)->where('dropoff_point',$this->to)->where('receive_date',$this->date)->where('way_status',1)->get();    
             foreach($way as $wayy)
             {
                 
              $arr_way[] = array(
                'token'  => $wayy->token,
                
               );
             }
             return collect($arr_way);
        }
        // elseif($this->status = 2)
        // {
        //     return WayPlanSchedule::where('receive_point',$this->from)->where('dropoff_point',$this->to)->where('receive_date',$this->date)->where('way_status','<>',1)->get();
        // }
        // elseif($this->status = 3)
        // {
        //     return WayPlanSchedule::where('receive_point',$this->from)->where('dropoff_point',$this->to)->where('receive_date',$this->date)->where('reject_status',1)->get();
        // }
        
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
