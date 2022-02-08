<?php

namespace App\Http\Controllers\Web;


use App\WayPlanSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FrontendController extends Controller
{
    public function index(Request $request)
    {


        return view('frontend.home1');
    }
    public function index1(Request $request)
    {
        return view('frontend.home');
    }
    public function search_track()
    {
        $details = WayPlanSchedule::all();
        // dd($details);
        return view('frontend.home2');
        // return view('frontend.home2');
    }

    public function tk_search(Request $request){

        if ($request->tk_ph == 1)
            {
                $orders = WayPlanSchedule::where('token',$request->tk)->get();
                // dd($orders);
                $type = 1;
                
            }
            else
            {
                $orders = WayPlanSchedule::where('customer_phone',$request->tk)->get();
                $type = 2;
            }

            return response()->json([
                     'orders' => $orders,
                     'type' => $type

            ]);

    }

    public function detail_info(Request $request){
        // dd($request->tok);
        $details = WayPlanSchedule::where('token',$request->tok)->first();
        // dd($details);
        return response()->json($details);
    }

}


// orWhere('customer_phone','LIKE','%'.$request->t.'%')->

