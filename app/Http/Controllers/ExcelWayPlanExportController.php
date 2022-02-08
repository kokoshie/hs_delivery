<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\WayPlanExport;
use App\Exports\WayPlanQueryExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelWayPlanExportController extends Controller
{
    //
    public function wayexcel_export(Request $request) 
    {
        // dd($request->all());
        return Excel::download(new WayPlanExport, 'wayplan_export.xlsx');
    } 
    public function wayexcel_export_query(Request $request)
    {
        // dd($request->all());
        return Excel::download(new WayPlanQueryExport($request->way_route_from,$request->way_route_to,$request->way_date,$request->way_status), 'wayplan_export.xlsx');

    }
   
}
