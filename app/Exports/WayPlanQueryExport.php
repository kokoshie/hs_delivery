<?php

namespace App\Exports;
use App\WayPlanSchedule;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;


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
        elseif($this->status == 2)
        {
            
            $way = WayPlanSchedule::where('receive_point',$this->from)->where('dropoff_point',$this->to)->where('receive_date',$this->date)->where('way_status',0)->with('receivelocation')->with('dropofflocation')->get();   
            // dd($way); 
             foreach($way as $wayy)
             {
                //  dd($wayy->dropoff_status);
              if($wayy->way_status == 1)
              {
                $ws = "Done";
              }
              else
              {
                  $ws = "Pending";
              }
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
