<?php

namespace App\Http\Controllers\Web;


use App\Package;
use App\PackageKg_Price;
use App\WayPlanSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
         $packages = Package::all();
         $packageKg = PackageKg_Price::all();
        //   dd($packages->packageKg_prices);

        // $ans = DB::table('packages')
        //     ->join('package_kg__prices', 'packages.id', '=', 'package_kg__prices.package_id')
        //     ->select('packages.id', 'packages.from_city_name', 'packages.to_city_name','package_kg__prices.min_kg','package_kg__prices.max_kg','package_kg__prices.per_kg_price','package_kg__prices.currency')
        //     ->get();
        // dd($ans);

        return view('frontend.home1',compact('packages','packageKg'));
    }
    public function index1(Request $request)
    {
        $packages = Package::all();
        $packageKg = PackageKg_Price::all();
        return view('frontend.home',compact('packages','packageKg'));
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
                $orders = WayPlanSchedule::where('token', 'Like', '%' .$request->tk . '%')->get();
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

