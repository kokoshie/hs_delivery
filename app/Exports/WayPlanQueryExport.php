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
        // dd($this->status);
        if($this->status == 1)
        {
             $way = WayPlanSchedule::where('receive_point',$this->from)->where('dropoff_point',$this->to)->where('receive_date',$this->date)->where('way_status',1)->with('receivelocation')->with('dropofflocation')->get();    
             foreach($way as $wayy)
             {
              if($wayy->way_status == 1)
              {
                $ws = "Done";
              }
              else
              {
                  $ws = "Pending";
              }
              $arr_way[] = array(
                'token'  => $wayy->token,
                'customer_name' => $wayy->customer_name,
                'customer_phone' => $wayy->customer_phone,
                'receive_point' => $wayy->receivelocation->name,
                'receive_date' => $wayy->receive_date,
                // 'dropoff_point' => $wayy->dropofflocation->name,
                'dropoff_date' => $wayy->dropoff_date,
                'tracking_id' => 1,
                'remark' => $wayy->remark,
                'parcel_quantity' => $wayy->parcel_quantity,
                'total_weight' => $wayy->total_weight,
                'per_kg_charges' => $wayy->per_kg_charges,
                'total_charges' => $wayy->total_charges,
                'way_status' => $ws,
               );
             }
             return collect($arr_way);
        }
        elseif($this->status == 2)
        {
            
            $way = WayPlanSchedule::where('receive_point',$this->from)->where('dropoff_point',$this->to)->where('receive_date',$this->date)->where('way_status',0)->with('receivelocation')->with('dropofflocation')->get();   
            // dd($way); 
             foreach($way as $wayy)
             {
              if($wayy->way_status == 1)
              {
                $ws = "Done";
              }
              else
              {
                  $ws = "Pending";
              }
              $arr_way[] = array(
                'token'  => $wayy->token,
                'customer_name' => $wayy->customer_name,
                'customer_phone' => $wayy->customer_phone,
                'receive_point' => $wayy->receivelocation->name."-".$wayy->dropofflocation->name,
                'receive_date' => $wayy->receive_date,
                // 'dropoff_point' => $wayy->dropofflocation->name,
                'dropoff_date' => $wayy->dropoff_date,
                'tracking_id' => 1,
                'remark' => $wayy->remark,
                'parcel_quantity' => $wayy->parcel_quantity,
                'total_weight' => $wayy->total_weight,
                'per_kg_charges' => $wayy->per_kg_charges,
                'total_charges' => $wayy->total_charges,
                'way_status' => $ws,
               );
             }
             return collect($arr_way);
        }
        elseif($this->status == 3)
        {
            
            $way = WayPlanSchedule::where('receive_point',$this->from)->where('dropoff_point',$this->to)->where('receive_date',$this->date)->where('reject_status',1)->with('receivelocation')->with('dropofflocation')->get();    
             foreach($way as $wayy)
             {
              if($wayy->way_status == 1 && $wayy->reject_status != 1)
              {
                $ws = "Done";
              }
              elseif($wayy->way_status == 0 && $wayy->reject_status != 1)
              {
                  $ws = "Pending";
              }
              elseif($wayy->reject_status == 1)
              {
                  $ws = "Reject";
              }
              $arr_way[] = array(
                'token'  => $wayy->token,
                'customer_name' => $wayy->customer_name,
                'customer_phone' => $wayy->customer_phone,
                'receive_point' => $wayy->receivelocation->name,
                'receive_date' => $wayy->receive_date,
                // 'dropoff_point' => $wayy->dropofflocation->name,
                'dropoff_date' => $wayy->dropoff_date,
                'tracking_id' => 1,
                'remark' => $wayy->remark,
                'parcel_quantity' => $wayy->parcel_quantity,
                'total_weight' => $wayy->total_weight,
                'per_kg_charges' => $wayy->per_kg_charges,
                'total_charges' => $wayy->total_charges,
                'way_status' => $ws,
               );
             }
             return collect($arr_way);
        }
        
    }
    
    public function headings(): array
    {
        return [    
            'token',
            'customer_name',
            'customer_phone',
            'point',
            'receive_date',
            'dropoff_date',
            'tracking_id',
            'remark',
            'parcel_quantity',
            'total_weight',
            'per_kg_charges',
            'total_charges',
            'way_status',

        ];
    }
}
