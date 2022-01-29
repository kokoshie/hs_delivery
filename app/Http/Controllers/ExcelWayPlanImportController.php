<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\WayPlanImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelWayPlanImportController extends Controller
{
    //
    public function store_wayexcel_import()
    {
        // dd("excel");
        Excel::import(new WayPlanImport,request()->file('file'));

        return redirect()->back();
    }
}
