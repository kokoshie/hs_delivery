<?php

namespace App\Imports;

use App\Package;
use App\WayPlanSchedule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WayPlanImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function transformDate($value, $format = 'Y-m-d')
        {
            try {
                return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            } catch (\ErrorException $e) {
                return \Carbon\Carbon::createFromFormat($format, $value);
            }
        }
    public function model(array $row)
    {

        $receive_date = $this->transformDate($row['bkk_arrived_date']);
        $receiveD = date('Y-m-d', strtotime($receive_date));

        $mya_date = $this->transformDate($row['myawady_arrived_date']);
        $myaD = date('Y-m-d', strtotime($mya_date));

        $drop_date = $this->transformDate($row['dropoff_arrived_date']);
        $dropD = date('Y-m-d', strtotime($drop_date));

        $cust_date = $this->transformDate($row['customer_arrived_date']);
        $custD = date('Y-m-d', strtotime($cust_date));

        $reject_date = $this->transformDate($row['reject_date']);
        $rejectD = date('Y-m-d', strtotime($reject_date));

        $str_point = JSON_encode($row['point']);
        $start_point_str = substr($row['point'],0,3);
        // dd($start_point_str);
        $end_point_str = substr($row['point'],4,3);
        if($start_point_str == "BKK")
        {
            $receive_point = 1;
            // $end_point = 1;
        }
        else if($start_point_str == "YGN" )
        {
            $receive_point = 2;
            // $end_point = 2;
        }
        else if($start_point_str == "MDY" )
        {
            $receive_point = 3;
            // $end_point = 3;
        }
        else if($start_point_str == "MAESOT")
        {
            $receive_point = 4;
            // $end_point = 4;
        }
        if($end_point_str == "BKK")
        {
            $end_point = 1;
        }
        else if($end_point_str == "YGN")
        {
            $end_point = 2;
        }
        else if($end_point_str == "MDY")
        {
            $end_point = 3;
        }
        else if($end_point_str == "MAESOT")
        {
            $end_point = 4;
        }
        if($row['customer_status'] == 2)
            {
                $waystatus = 1;
            }
            else
            {
                $waystatus = 0;
            }

        $hasway = WayPlanSchedule::where('token',$row['token'])->first();
        $package = Package::where('from_city_id',$receive_point)->where('to_city_id',$end_point)->first();
        if($hasway == null && $row['type'] == "new")
        {


        $waylist = new WayPlanSchedule([
        'customer_name' => $row['customer_name'],
        'customer_phone' => (int)$row['phone_no'],
        'receive_point' => $receive_point,
        'receive_date' => $receiveD,
        'dropoff_point' => $end_point,
        'dropoff_date' => $dropD,
        'parcel_quantity' => (int)$row['qty'],
        'total_weight' => $row['weight'],
        'package_id' => $package->id,
        'total_charges' => (int)$row['cargo_charges'],
        'receive_status' => (int)$row['receive_status'],
        'dropoff_status' => (int)$row['dropoff_status'],
        'customer_status' =>(int)$row['customer_status'],
        'myawady_status' => (int)$row['myawady_status'],
        'myawady_date' => $myaD,
        'customer_date' => $custD,
        'token' => $row['token'],
        'way_status' => $waystatus,
        'customer_address' => $row['location'],

        ]);
        // dd($waylist);
        $waylist->save();
        return $waylist;
        }
        else if($hasway != null && $row['type'] == "update")
        {
            // dd($receive_point);

            // dd($receive_point);
            $hasway->customer_name = $row['customer_name'];
            $hasway->customer_phone = (int)$row['phone_no'];
            $hasway->receive_point = $receive_point;
            $hasway->receive_date = $receiveD;
            $hasway->dropoff_point = $end_point;
            $hasway->dropoff_date = $dropD;
            $hasway->parcel_quantity = (int)$row['qty'];
            $hasway->total_weight = $row['weight'];
            $hasway->package_id = $package->id;
            $hasway->total_charges = (int)$row['cargo_charges'];
            $hasway->receive_status = (int)$row['receive_status'];
            $hasway->dropoff_status = (int)$row['dropoff_status'];
            $hasway->customer_status =(int)$row['customer_status'];
            $hasway->myawady_status = (int)$row['myawady_status'];
            $hasway->myawady_date = $myaD;
            $hasway->customer_date = $custD;
            $hasway->token = $row['token'];
            $hasway->way_status = $waystatus;
            $hasway->customer_address = $row['location'];
            $hasway->save();
            return $hasway;
        }
        else if($hasway == null && $row['type'] == "reject")
        {
            // dd("new reject");
            $rejectnewwaylist = new WayPlanSchedule([
                'customer_name' => $row['customer_name'],
                'customer_phone' => (int)$row['phone_no'],
                'receive_point' => $receive_point,
                'receive_date' => $receiveD,
                'dropoff_point' => $end_point,
                'dropoff_date' => $dropD,
                'parcel_quantity' => (int)$row['qty'],
                'total_weight' => $row['weight'],
                'package_id' => $package->id,
                'total_charges' => (int)$row['cargo_charges'],
                'receive_status' => (int)$row['receive_status'],
                'dropoff_status' => (int)$row['dropoff_status'],
                'customer_status' =>(int)$row['customer_status'],
                'myawady_status' => (int)$row['myawady_status'],
                'myawady_date' => $myaD,
                'customer_date' => $custD,
                'token' => $row['token'],
                'way_status' => $waystatus,
                'customer_address' => $row['location'],
                'reject_date' => $rejectD,
                'reject_remark' => $row['reject_remark'],
                'reject_status' => 1,
                ]);
                // dd($waylist);
                $rejectnewwaylist->save();
                return $rejectnewwaylist;
        }
        else if($hasway != null && $row['type'] == "reject")
        {
            $hasway->customer_name = $row['customer_name'];
            $hasway->customer_phone = (int)$row['phone_no'];
            $hasway->receive_point = $receive_point;
            $hasway->receive_date = $receiveD;
            $hasway->dropoff_point = $end_point;
            $hasway->dropoff_date = $dropD;
            $hasway->parcel_quantity = (int)$row['qty'];
            $hasway->total_weight = $row['weight'];
            $hasway->package_id = $package->id;
            $hasway->total_charges = (int)$row['cargo_charges'];
            $hasway->receive_status = (int)$row['receive_status'];
            $hasway->dropoff_status = (int)$row['dropoff_status'];
            $hasway->customer_status =(int)$row['customer_status'];
            $hasway->myawady_status = (int)$row['myawady_status'];
            $hasway->myawady_date = $myaD;
            $hasway->customer_date = $custD;
            $hasway->token = $row['token'];
            $hasway->way_status = $waystatus;
            $hasway->customer_address = $row['location'];
            $hasway->reject_date = $rejectD;
            $hasway->reject_remark = $row['reject_remark'];
            $hasway->reject_status = 1;
            $hasway->save();
            return $hasway;
        }

    }
}
