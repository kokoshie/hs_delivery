<?php

namespace App\Exports;

use App\WayPlanSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
class WayPlanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       $way = WayPlanSchedule::where('reject_status',0)->get();
       foreach($way as $wayy)
             {
        $arr_way[] = array(
                
            'customer_name' => $wayy->customer_name,
            'parcel_quantity' => $wayy->parcel_quantity,
            'tracking_no' => $wayy->tracking_no,
            'receive_date' => $wayy->receive_date,
            'receive_status' => $wayy->receive_status,
            'myawady_date' => $wayy->myawady_date,
            'myawady_status' => $wayy->myawady_status,
            'dropoff_date' => $wayy->dropoff_date,
            'dropoff_status' => $wayy->dropoff_status,
            'dropoff_remark' => $wayy->dropoff_remark,
            'customer_date' => $wayy->customer_date,
            'customer_status' => $wayy->customer_status,
            'customer_remark' => $wayy->customer_remark,
            'token'  => $wayy->token,
            'total_weight' => $wayy->total_weight,
            'cargo_charges' => $wayy->total_charges,
            'customer_phone' => $wayy->customer_phone,
            'reject_date' => $wayy->reject_date,
            'reject_remark' => $wayy->reject_remark,
            'point' => $wayy->receivelocation->name."-".$wayy->dropofflocation->name,
            'location' => $wayy->customer_address,
            
           );
        }
         return collect($arr_way);
    }
    public function headings(): array
    {

        return [    
            'customer_name',
            'qty',
            'tracking_number',
            'bkk_arrived_date',
            'receive_status',
            'myawady_arrived_date',
            'myawady_status',
            'dropoff_arrived_date',
            'dropoff_status',
            'dropoff_remark',
            'customer_arrived_date',
            'customer_status',
            'customer_remark',
            'token',
            'weight',
            'cargo_charges',
            'phone_no',
            'reject_date',
            'reject_remark',
            'point',
            'location',
            'type',
        ];
    }
}
