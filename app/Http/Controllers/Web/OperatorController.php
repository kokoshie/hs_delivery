<?php

namespace App\Http\Controllers\Web;

use App\Day;
use App\Town;
use App\User;
use DateTime;
use App\Admin;
use App\State;
use App\Doctor;
use App\Location;
use App\Booking;
use App\Patient;
use App\Voucher;
use App\Employee;
use Carbon\Carbon;
use App\Department;
use App\DoctorInfo;
use App\DoctorTime;
use App\Appointment;
use App\Announcement;
use App\Advertisement;
use App\Traits\ZoomJWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Package;
use App\PackageKg_Price;
use App\WayPlanSchedule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
{
	public function __construct()
	{

		$this->routeList = [
			"U Zaw Win",
			"Daw Zin Win Oo",
			"Daw Zin Zin Win",
			"Daw Win Win Zaw",
			"U Sai Kaung Chit",
			"Daw Khin Myat Min",
			"U Sein Aung Lwin",
			"Daw Khin Myit Sein",
			"Daw Yamone Oo",
			"Daw Yamone Phoo",
			"Daw Zun Phoo Phoo",
			"Daw Aye Nyein Thu",
			"Daw Aye Nyein May",
			"Daw Thet Htar Swe",
			"U Pyae Phyo Win",
			"U Win Pyae Phyo",
			"U Wunna Kyaw",
			"U Aung Htoo Kyaw",
			"U Kyaw Lin Aung",
			"U Aung Lin Kyaw",
		];
	}

	use ZoomJWT;

	const MEETING_TYPE_INSTANT = 1;
	const MEETING_TYPE_SCHEDULE = 2;
	const MEETING_TYPE_RECURRING = 3;
	const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

	protected function AdminDashboard(Request $request)
	{

		$now = new DateTime('Asia/Yangon');

		$toady_date = $now->format('Y-m-d');

		$department_lists = Department::all();

		$user = $request->session()->get('user');
		if(session()->get('user')->isOwner(1) || session()->get('user')->hasRole('EmployeeC')){
			$bookings = Appointment::where('date', $toady_date)->get();
		}
		elseif(session()->get('user')->isOwner(0) && session()->get('user')->hasRole('DoctorC')){
			$doctor = Doctor::where('user_id',$user->id)->first();
			$bookings = Appointment::where('date', $toady_date)->where('doctor_id',$doctor->id)->get();
		}

		$announcements = Announcement::all();

		$advertisements = Advertisement::all();

		$count_booking = count($bookings);

		$doctors = Doctor::all();

		$patients = Patient::all();

		$count_doc = count($doctors);

		$count_patient = count($patients);

		$count_dept = count($department_lists);

		if(session()->get('user')->hasRole('EmployeeC') || session()->get('user')->hasRole('DoctorC')){
            $voucher_lists =Voucher::where('type', 1)->where('clinicvoucher_status',1)->orderBy('id','desc')->get();

        }
        else{
            $voucher_lists =Voucher::where('type', 1)->orderBy('id','desc')->get();

        }

		$total_sales  = 0;

        foreach ($voucher_lists as $voucher_list){

            $total_sales += $voucher_list->total_price;

        }
        $date = new DateTime('Asia/Yangon');

        $current_date = strtotime($date->format('Y-m-d'));

        $weekly = date('Y-m-d', strtotime('-1week', $current_date));
        // $to = date('Y-m-d', strtotime('+1day', $current_date));
        $to = $date->format('Y-m-d');


        if(session()->get('user')->hasRole('EmployeeC') || session()->get('user')->hasRole('DoctorC')){

            $weekly_data = Voucher::where('type', 1)->where('clinicvoucher_status',1)->whereBetween('voucher_date',[$weekly,$to])->get();

        }
        else{
            $weekly_data = Voucher::where('type', 1)->whereBetween('voucher_date', [$weekly,$to])->get();

        }
        $weekly_sales = 0;

        foreach($weekly_data as $weekly){

            $weekly_sales += $weekly->total_price;
        }

        $current_month = $date->format('m');
        $current_month_year = $date->format('Y');
        $today_date = $date->format('Y-m-d');
        if(session()->get('user')->hasRole('EmployeeC') || session()->get('user')->hasRole('DoctorC')){
            $daily = Voucher::where('type', 1)->where('clinicvoucher_status',1)->whereDate('created_at', $today_date)->get();
        }
        else{
            $daily = Voucher::where('type', 1)->where('created_at', $today_date)->get();

        }

        $daily_sales = 0;

        foreach($daily as $day){

            $daily_sales += $day->total_price;
        }
        if(session()->get('user')->hasRole('EmployeeC') || session()->get('user')->hasRole('DoctorC')){

            $monthly = Voucher::where('type', 1)->where('clinicvoucher_status',1)->whereMonth('created_at',$current_month)->whereYear('created_at',$current_month_year)->get();

        }
        else{
            $monthly = Voucher::where('type', 1)->whereMonth('created_at',$current_month)->get();

        }
        $monthly_sales = 0;

        foreach ($monthly as $month){

            $monthly_sales += $month->total_price;
        }

		return view('Admin.dashboard', compact('department_lists', 'count_doc', 'count_patient', 'count_dept', 'doctors', 'count_booking', 'announcements', 'advertisements','total_sales','daily_sales','monthly_sales','weekly_sales'));
	}

    protected function township(Request $request){
		$charges_list = Package::all();
        return view('Admin.township',compact('charges_list'));
    }

    protected function schedule(Request $request){
		// $wayplanid = WayPlanSchedule::create([
		// 	'parcel_quantity' => 0
		// ]);
		$location = Location::all();
        return view('Admin.schedule',compact('location'));
    }
	protected function show_updateCharges($id)
	{
		// dd($id);
		$location  = Location::all();
		$package = Package::find($id);
		$charges = PackageKg_Price::where('package_id',$id)->get();
		$last_charges = PackageKg_Price::where('package_id',$id)->orderBy('id', 'desc')->first();
		$last_count = $last_charges->id;
		// dd("hell");
		return view('Admin.show_update_charges',compact('last_count','location','package','charges'));
	}

	protected function store_updateCharges(Request $request)
	{
		// dd($request->all());

			$from = Location::find($request->from_city);
			$to = Location::find($request->to_city);
			$update_package = Package::find($request->package_id);
			$update_package->package_name =$request->name;
			$update_package->from_city_id = $request->from_city;
			$update_package->to_city_id = $request->to_city;
			$update_package->from_city_name = $from->name;
			$update_package->to_city_name = $to->name;
			$update_package->save();

			for($i=0;$i<count($request->min);$i++)
			{
				if($request->currency[$i] == 1)
				{
					$per_kg = "MMK";
				}
				elseif($request->currency[$i] == 2)
				{
					$per_kg = "BAHT";
				}
				elseif($request->currency[$i] == 3)
				{
					$per_kg = "USD";
				}

				$kg_price = PackageKg_Price::where('id',$request->charges_id[$i])->first();
				// dd($kg_price);
				if($kg_price != null)
				{
					// dd("in");
					$kg_price->package_id = $request->package_id;
					$kg_price->min_kg = $request->min[$i];
					$kg_price->max_kg = $request->max[$i];
					$kg_price->per_kg_price = $request->per_kg_charges[$i];
					$kg_price->currency = $per_kg;
					$kg_price->save();
				}
				elseif($kg_price == null)
				{
					// dd("out");
						$package_kg_prices = PackageKg_Price::create([
						'package_id'=> $request->package_id,
						'min_kg'     =>$request->min[$i],
						'max_kg'     =>$request->max[$i],
						'per_kg_price' => $request->per_kg_charges[$i],
						'currency' => $per_kg,
						]);
				}

			}
			alert()->success("Successfully Updated Charges General Information!");
            return back();

	}
	protected function find_point_result(Request $request)
	{
		// dd($request->weight);
		$package = Package::where('from_city_id',$request->receive_point)->where('to_city_id',$request->drop_point)->first();
		// dd($package->id);
		$kg_price = PackageKg_Price::where('package_id',$package->id)->where('min_kg','<=',$request->weight)->where('max_kg','>',$request->weight)->first();
		// dd($kg_price);
		if($kg_price == null)
		{
			return response()->json(1);
		}
		else
		{
			return response()->json($kg_price);
		}
		// dd($kg_price);


	}
	protected function store_wayplan_now(Request $request)
	{
		// dd($request->all());
		$ldate = new DateTime('today');
		$date = $ldate->format('Y-m-d');
		// dd($date);
		$validator = Validator::make($request->all(), [

			"perKg" => "required",
			"chargess" => "required",
			"customer_name" => "required",
			"token" => "required",
			"customer_phone" => "required",
			"cust_addr" => "required",
			"remark" => "required",
			"receive_point" => "required",
			"qty" => "required",
			"receive_date" => "required",
			"weight" => "required",
			"wg_type" => "required",
			"drop_point" => "required",
			"charge" => "required",
			"drop_date" => "required",
			"est_charge" => "required",

		]);
		if ($validator->fails()) {

			alert()->error('Please Fill All Fields!');
			return redirect()->back();
		}
		$store_wayplan = WayPlanSchedule::find($request->wayid);
		// dd($store_wayplan);
		$store_wayplan->customer_name =$request->customer_name;
		$store_wayplan->customer_phone =$request->customer_phone;
		$store_wayplan->receive_point =$request->receive_point;
		$store_wayplan->receive_date = $request->receive_date;
		$store_wayplan->dropoff_point =$request->drop_point;
		$store_wayplan->dropoff_date = $request->drop_date;
		$store_wayplan->remark =$request->remark;
		$store_wayplan->parcel_quantity =$request->qty;
		$store_wayplan->total_weight =$request->weight;
		$store_wayplan->per_kg_charges =$request->perKg;
		$store_wayplan->package_id = $request->packageID;
		$store_wayplan->total_charges = $request->chargess;
		$store_wayplan->customer_address = $request->cust_addr;
		$store_wayplan->myawady_date = $date;
		$store_wayplan->customer_date = $date;
		$store_wayplan->token =  $request->token;
		$store_wayplan->save();
		// dd($request->all());
		alert()->success("Successfully Stored WayPlan Schedule!");
		return back();

	}
	protected function show_wayplan_list()
	{
		$wayplan = WayPlanSchedule::all();
		$location = Location::all();
		return view('Admin.wayplan_list',compact('wayplan','location'));
	}
	protected function generate_token(Request $request)
	{
		// dd($request->wayplan_id);
		$wayplanid = WayPlanSchedule::create([
			'parcel_quantity' => 0
		]);
		$date = Carbon::now();

        $monthName = $date->format('F');
		$three_str = substr($monthName,0,3);
		$token = "T".$three_str.sprintf('%04s',$wayplanid->id);
		return response()->json([
			'wayplan_id' => $wayplanid->id,
			'token' => $token]);
		// dd($token);

	}
	protected function change_way_status($id)
	{
		// dd($id);
		$wayplan = WayPlanSchedule::find($id);
		$re_point = Location::find($wayplan->receive_point);
		$drop_point = Location::find($wayplan->dropoff_point);
		return view('Admin.change_status',compact('wayplan','re_point','drop_point'));
	}
	protected function store_change_status(Request $request)
	{
		// dd($request->all());
		if($request->custh_status == 2)
		{
			$way_status = 1;
		}
		else
		{
			$way_status = 0;
		}
		$store_way_status = WayPlanSchedule::find($request->wayplan_id);
		$store_way_status->receive_status = $request->receiveh_status;
		$store_way_status->receive_date = $request->receiveh_date;
		$store_way_status->dropoff_status = $request->dropoffh_status;
		$store_way_status->dropoff_date = $request->dropoffh_date;
		$store_way_status->myawady_date = $request->myah_date;
		$store_way_status->myawady_status = $request->myah_status;
		$store_way_status->customer_date = $request->custh_date;
		$store_way_status->customer_status = $request->custh_status;
		$store_way_status->way_status = $way_status;
		$store_way_status->save();
		alert()->success("Successfully changes All Status !!");
		return back();
	}
	protected function search_phoneno_ajax(Request $request)
	{
		if($request->phone == null)
		{
			$phone_data = null;
		}
		else
		{
		$phone_data = WayPlanSchedule::where('customer_phone', 'LIKE','%'.$request->phone)->get();
		}
		// dd($phone_data);
		return response()->json($phone_data);
	}
	protected function searching_ajax_result(Request $request)
	{
		// dd($request->all());
			if($request->type == 1)
			{
				$search_data = WayPlanSchedule::where('customer_phone',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
				// dd($search_data);
			}
			else if($request->type == 2)
			{
				$search_data = WayPlanSchedule::where('token',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
			}
			else if($request->type == 3)
			{
				if($request->date_type == 1)
				{
					$search_data = WayPlanSchedule::where('receive_date',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
				}
				elseif($request->date_type == 2)
				{

				}
				elseif($request->date_type == 3)
				{
					$search_data = WayPlanSchedule::where('myawady_date',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
				}
				elseif($request->date_type == 4)
				{
					$search_data = WayPlanSchedule::where('dropoff_date',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
				}
			}
			// dd($search_data);
			return response()->json($search_data);
	}
	protected function changes_reject_way(Request $request)
	{
		// dd($request->all());
		// $reject_way = WayPlanSchedule::find();
		// $reject_way->reject_status = 1;
        $validator = Validator::make($request->all(), [
            "reject_date" => "required",
            "reject_remark" => "required",

        ]);

        if ($validator->fails()) {

            alert()->error('Please Fill All Fields!');
            return redirect()->back();
        }
        $change_reject  = WayPlanSchedule::find($request->wayID);
        $change_reject->reject_status = 1;
        $change_reject->reject_date = $request->reject_date;
        $change_reject->reject_remark = $request->reject_remark;
        $change_reject->save();
        return back();

	}
    protected function show_reject_way(Request $request)
	{
		// dd($request->all());
		// $reject_way = WayPlanSchedule::find();
		// $reject_way->reject_status = 1;
        $location = Location::all();
        $reject_way = WayPlanSchedule::where('reject_status',1)->with('receivelocation')->with('dropofflocation')->get();
        return view('Admin.reject_way_list',compact('reject_way','location'));

	}
    protected function store_package(Request $request){
        // dd($request->all());
		$from = Location::find($request->from_city);
		$to = Location::find($request->to_city);

         $packages =   Package::create([
            'package_name' => $request->name,
            'from_city_id' => $request->from_city,
            'to_city_id' => $request->to_city,
            'from_city_name' => $from->name,
            'to_city_name' => $to->name,
        ]);
		for($i=0;$i<count($request->min);$i++)
		{
			if($request->currency[$i] == 1)
			{
				$per_kg = "MMK";
			}
			elseif($request->currency[$i] == 2)
			{
				$per_kg = "BAHT";
			}
			elseif($request->currency[$i] == 3)
			{
				$per_kg = "USD";
			}
			$package_kg_prices = PackageKg_Price::create([
            'package_id'=> $packages->id,
            'min_kg'     =>$request->min[$i],
            'max_kg'     =>$request->max[$i],
            'per_kg_price' => $request->per_kg_charges[$i],
            'currency' => $per_kg,
        	]);
		}

		// dd("no");
    alert()->success('Successfully Stored Charges Information!');

    return redirect()->route('township');
    }

    protected function charges(Request $request){
        $location = Location::all();
        return view('Admin.charges',compact('location'));
    }

	protected function getBookingListUi()
	{

		$doctors = Doctor::all();

		$departments = Department::all();

		$now = new DateTime;

		$today = $now->format('Y-m-d');

		$booking_lists = Booking::where('booking_date', $today)->with('doctor')->get();

		$booking_count = count($booking_lists);

		return view('Admin.booking_list', compact('doctors', 'departments','booking_lists','booking_count'));
	}

	protected function ajaxDoctorBookingList(Request $request)
	{

		$request_date = $request->check_date;

		$status = $request->status;

		$doctor = Doctor::where('id', $request->doctor_id)->with('department')->first();


		if ($status == 6) {

			$booking_lists = Booking::where('booking_date', $request_date)->where("doctor_id", $request->doctor_id)->get();
		} else {

			$booking_lists = Booking::where('booking_date', $request_date)->where("doctor_id", $request->doctor_id)->where("status", $status)->get();
		}

		$booking_count = count($booking_lists);

		return response()->json([
			'doctor' => $doctor,
			'booking_lists' => $booking_lists,
			'booking_count' => $booking_count,
			'status' => $status,
		]);
	}

	protected function AjaxTokenCheckIn(Request $request)
	{

		$token_number = $request->token_number;

		$booking = Booking::where('token_number', $token_number)->first();

		$booking_list = Booking::where('doctor_id', $booking->doctor_id)->where('booking_date', $booking->booking_date)->get();

		return response()->json([
			'booking' => $booking,
			'booking_lists' => $booking_list,
		]);
	}

	protected function AdminProfile(Request $request)
	{

		$user_id = getUserId($request);

		$user = $request->session()->get('user');

		$user_email = $user->email;

		$admin = Admin::where('user_id', $user_id)->first();

		return view('Admin.profile', compact('admin', 'user_email'));
	}
	protected function counterProfile(Request $request,$counter_id)
	{

		$admin = Employee::with('user')->findOrfail($counter_id);
		$user_email= $admin->user->email;
		return view('Admin.profile', compact('admin','user_email'));
	}
	protected function counterProfileEdit(Request $request,$counter_id)
	{

		$admin = Employee::with('user')->findOrfail($counter_id);
		$user_email= $admin->user->email;
		return view('Admin.editprofile', compact('admin','user_email'));
	}
	protected function counterProfileEditSave(Request $request)
	{
		$validator = Validator::make($request->all(), [
			"employee_id" => "required",
			"name" => "required",
			"code" => "required",
			"phone" => "required",
			"dob" => "required",
			"email" => "required",
		]);
		if($request->password){
			$validator = Validator::make($request->all(), [
				"employee_id" => "required",
				"name" => "required",
				"code" => "required",
				"phone" => "required",
				"dob" => "required",
				"email" => "required",
				"password"=> "required|min:6"
			]);
		}

		if ($validator->fails()) {

			alert()->error('Please Fill All Fields!');
			return redirect()->back();
		}
		$employee = Employee::findOrfail($request->employee_id);

		$employeeupdate=$employee->update([
			"name" => $request->name,
			"employee_code" => $request->code,
			"phone" => $request->phone,
			"dob" => $request->dob
		]);
		$employee->user->update([
			'email'=> $request->email
		]);
		if($request->password){
			$employee->user->update([
				'password'=> Hash::make($request->password)
			]);
		}
		alert()->success('Successfully Changed!');

		return back();
	}

	public function createCounter(Request $request)
	{
		return view('Admin.createcounter');
	}
	public function createCounterSave(Request $request)
	{
			$validator = Validator::make($request->all(), [
				"name" => "required",
				"phone" => "required",
				"dob" => "required",
				"email" => "required",
				"password"=> "required|min:6"
			]);

		if ($validator->fails()) {

			alert()->error('Please Fill All Fields!');
			return redirect()->back();
		}
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'password' => Hash::make($request->password)
		]);
		$user->assignRole(4);

        if ($request->hasfile('image')) {

			$image = $request->file('image');

			$name = $image->getClientOriginalName();

			$photo_path =  time()."-".$name;

			$image->move(public_path() . '/image/admin/', $photo_path);

			$path = '/image/admin/'. $photo_path;

		}
		else{
			$path = '/image/admin/user.jpg';

		}
		$employee_code =  "EMP_" . sprintf("%03s", $user->id);


		$employee=Employee::create([
			"name" => $request->name,
			"employee_code" => $request->code,
			"phone" => $request->phone,
			"dob" => $request->dob,
			"user_id"=> $user->id,
			"photo" => $path,
			"position_id" =>1,
			"employee_code" => $employee_code
		]);

		alert()->success('Successfully Added!');

		return redirect()->route('doctor_list');
	}
	protected function AdminChangePassUI(Request $request)
	{

		return view('Admin.change_pw');
	}

	protected function AdminChangePass(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'current_pw' => 'required',
			'new_pw' => 'required|confirmed|min:6'
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong!');
			return redirect()->back();
		}

		$user = $request->session()->get('user');

		$current_pw = $request->current_pw;

		if (!\Hash::check($current_pw, $user->password)) {

			alert()->info("Wrong Current Password!");

			return redirect()->back();
		}

		$has_new_pw = \Hash::make($request->new_pw);

		$user->password = $has_new_pw;

		$user->save();

		alert()->success('Successfully Changed!');

		return redirect()->route('admin_dashboard');
	}

	protected function DepartmentList()
	{

		$department_lists = Department::all();

		return view('Admin/Department/department_list', compact('department_lists'));
	}



	//To update with Modal Box
	protected function CreateDepartment()
	{

		return view('Admin/Department/create_department');
	}

	protected function StoreDepartment(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'description' => 'required',
			'image' => 'required|file'
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong');

			return redirect()->back();
		}

		if ($request->hasfile('image')) {

			$image = $request->file('image');
			$name = $image->getClientOriginalName();
			$image->move(public_path() . '/image/Department_Image/', $name);
			$image = $name;
		}
		$department = Department::create([
			'name' => $request->name,
			'description' => $request->description,
			'photo_path' => $image,
			'status' => $request->status,
		]);

		$department_id = $department->id;

		$department_code = "DEPT" . sprintf("%04s", $department_id);

		$department->department_code = $department_code;

		$department->save();

		alert()->success('Successfully Added!');

		return redirect()->route('department_list');
	}

	protected function EditDepartment($department, Request $request)
	{

		$department = Department::where('id', $department)->first();

		return view('Admin/Department/edit_department', compact('department'));
	}

	protected function UpdateDepartment($department, Request $request)
	{

		$department = Department::where('id', $department)->first();

		if ($request->dept_status == "on") {

			$department->status = 1;
		} else {

			$department->status = 2;
		}

		$department->name = $request->name;

		$department->description = $request->description;

		$department->save();

		alert()->success('ပြင်ဆင်တာ​အောင်မြင်ပါသည်');

		return redirect()->route('department_list');
	}

	//For Phone Booking From Reception
	protected function GetToken()
	{

		$doctors = Doctor::all();

		return view('Admin.get_token', compact('doctors'));
	}

	//For Phone Booking from Reception
	protected function SearchDoctors(Request $request)
	{

		$now = new DateTime;

		$today = $now->format('Y-m-d');

		$validator = Validator::make($request->all(), [
			'doctor_id' => 'required',
		]);

		if ($validator->fails()) {

			return response()->json(array("errors" => $validator->getMessageBag()), 422);
		}

		$doctor = Doctor::find(request('doctor_id'));

		$days = $doctor->day;

		$doc_range = explode("-", $doctor->doc_info->booking_range);

		$range = 7 *  $doc_range[0];

		$today_string = strtotime($today);

		$available_date = array();

		$final_date = array();

		$start_time_array = array();

		$end_time_array = array();

		for ($i = 0; $i <= $range; $i++) {

			array_push($available_date, date('d-m-Y,l', strtotime("+$i day", $today_string)));
		}

		foreach ($available_date as $ava_date) {

			foreach ($days as $day) {

				if ($day->name == date('l', strtotime($ava_date))) {

					$start_time = date('h:i A', strtotime($day->pivot->start_time));

					$end_time = date('h:i A', strtotime($day->pivot->end_time));

					$object = collect([$ava_date, $start_time, $end_time]);

					array_push($final_date, $object);
				}
			}
		}

		return response()->json($final_date);
	}

	protected function StoreBookingToken(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'booking_date' => 'required',
			'name' => 'required',
			'age' => 'required',
			'phone' => 'required',
			'address' => 'required',
			'bookings' => 'required',
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong');

			return redirect()->back();
		}
		$person_list = $this->routeList;

		$date = explode(',', $request->booking_date);

		$check_date = date('Y-m-d', strtotime($date[0]));

		$date_save = date('md', strtotime($date[0]));

		$doctor = Doctor::find(request('doctor'));

		$reserved_token = $doctor->doc_info->reserved_token;

		$check_booking = Booking::where('doctor_id', request('doctor'))
			->whereDate('booking_date', $check_date)
			->get();



			if($request->bookings== "manualBooking"){
				$zoom_id= null;
				$zoom_psw= null;
				$start_url= null;
				$join_url= null;
				$booking_status=0;
			}
			else {

				$path = 'users/me/meetings';
				$response = $this->zoomPost($path, [
					'topic' => "online",
					'type' => self::MEETING_TYPE_SCHEDULE,
					'start_time' => $this->toZoomTimeFormat($check_date),
					'duration' => 30,
					'agenda' => "Data",
					'settings' => [
						'host_video' => false,
						'participant_video' => false,
						'waiting_room' => true,
					]
				]);

				$zoom = json_decode($response->body(), true);
				Log::channel('custom')->info($zoom);
				$zoom_id= $zoom['id'];
				$zoom_psw= $zoom['password'];
				$start_url= $zoom['start_url'];
				$join_url= $zoom['join_url'];
				$booking_status=1;

			}

		if (count($check_booking) == 0) {

			for ($i = 1; $i <= $reserved_token; $i++) {

				$random = array_rand($person_list);

				$name = $person_list[$random];

				$book_token = Booking::create([
					'name' => $name,
					'age' => 33,
					'phone' => " 09250206903",
					'address' => "Tarmwe Yangon",
					'booking_date' => $check_date,
					'status' => 1,
					'submit_by' => 0,
					'user_id' => 1,
					'doctor_id' => request('doctor'),
					'floor_id' => 1,
					'booking_status' => 2, //manual booking-0 online-1 reserved-2
				]);

				$token_number = "TKN-" . sprintf("%03s", $i);

				$book_token->token_number = $token_number;

				$book_token->save();
			}

			$check_booking_real = Booking::where('doctor_id', request('doctor'))->whereDate('booking_date', $check_date)->get();

			$booking_array = $check_booking_real->toArray();

			$last_token_booking_arry = array_column($booking_array, 'token_number');

			$last_token = end($last_token_booking_arry);

			$last_token_number = explode('-', $last_token);

			$token = $last_token_number[1] + 1;

			$real_token_number = "TKN-" . sprintf("%03s", $token);

			$real_book_token = Booking::create([
				'token_number' =>  $real_token_number,
				'name' => $request->name,
				'age' => $request->age,
				'phone' => $request->phone,
				'address' => $request->address,
				'booking_date' => $check_date,
				'status' => 1,
				'submit_by' => 0,
				'user_id' => 1,
				'doctor_id' => request('doctor'),
				'floor_id' => 1,
				'booking_status' => $booking_status,
				'zoom_id' => $zoom_id,
				'zoom_psw' => $zoom_psw,
				'start_url' => $start_url,
				'join_url' => $join_url,
			]);

			// alert()->success('Token Number', $real_token_number)->persistent('Close');

			// return redirect()->back();
		} else {

			$booking_array = $check_booking->toArray();

			$last_token_booking_arry = array_column($booking_array, 'token_number');

			$last_token = end($last_token_booking_arry);

			$last_token_number = explode('-', $last_token);

			$token = $last_token_number[1] + 1;

			$real_token_number = "TKN-" . sprintf("%03s", $token);

			$real_book_token = Booking::create([
				'token_number' =>  $real_token_number,
				'name' => $request->name,
				'age' => $request->age,
				'phone' => $request->phone,
				'address' => $request->address,
				'booking_date' => $check_date,
				'status' => 1,
				'user_id' => 1,
				'doctor_id' => request('doctor'),
				'floor_id' => 1,
				'booking_status' => $booking_status,
				'zoom_id' => $zoom_id,
				'zoom_psw' => $zoom_psw,
				'start_url' => $start_url,
				'join_url' => $join_url,
			]);

		}
		$doctor= Doctor::findOrfail(request('doctor'));
		$doctorService= $doctor->services->sum('charges');
		$amount1  =$doctor->online_early_payment/1700; //1.76
		$amount2=round($amount1, 2);

		$amount3 = $amount2* 100;
		$amount =sprintf("%012s", $amount3);
			// dd($doctorService->sum('charges'));
			// alert()->success('Token Number', $real_token_number)->persistent('Close');
		return view('payments.payment4',compact('doctorService','real_book_token','doctor','amount'));

	}

	protected function editBookingRecord(Request $request)
	{

		try {

			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);
		}

		$booking->name = $request->name;

		$booking->age = $request->age;

		$booking->phone = $request->phone;

		$withdateOrnodate= $request->withdateOrnodate;

		if ($booking->save()) {

			return response()->json([$booking->save(),$withdateOrnodate]);;
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}

	protected function adminconfirmbooking(Request $request)
	{

		try {

			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}

		$booking->status = 1;

		if ($booking->save()) {

			return response()->json($booking->save());;
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}

	protected function admincheckinbooking(Request $request)
	{

		try {

			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}

		$booking->status = 4;

		if ($booking->save()) {

			return response()->json($booking->save());;
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}
	protected function admincanclebooking(Request $request)
	{

		try {

			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}

		$booking->status = 2;

		if ($booking->save()) {

			return response()->json($booking->save());;
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}


	protected function admindonebooking(Request $request)
	{

		try {
			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}
		if ($booking->description ==null || $booking->diagnosis == null || $booking->remark_booking_date==null) {

			return response()->json([
				$booking->doctor->services,
				0,
			]);
		}
		$booking->status = 5;
		if ($booking->save()) {

			return response()->json([
				$booking->doctor->services,
				1,
			]);
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}

	protected function checkedallconfirm(Request $request)
	{

		try {

			$checked_ids = $request->checked_id;
		} catch (\Exception $e) {

			alert()->error("Something worng!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}
		$checked_id_objs = (object) $checked_ids;

		foreach ($checked_id_objs as $checked_id_obj) {

			$bookingcomfirm = Booking::findOrFail($checked_id_obj);
			$bookingcomfirm->status = 1;
			$bookingcomfirm->save();
		}
		return response()->json(1);
		// $booking->status = 1;

		// if($booking->save()){

		// 	return response()->json($booking->save());;

		// }else{

		//     alert()->error("Database Error!")->persistent("Close!");

		//      return redirect()->back();
		// }
	}

	//For mobile app
	protected function announcementStore(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'description' => 'required',
			'short_description' => 'required',
			'photo' => 'required',
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong');

			return redirect()->back();
		}

		$booking_range = request('range');

		$weekormonth = request('weekormonth');

		if ($request->hasfile('photo')) {

			$image = $request->file('photo');

			$name = $image->getClientOriginalName();

			$image_name =  time() . "-" . $name;

			$image->move(public_path() . '/image/ann/', $image_name);

			$image = $image_name;
		}

		$now = new DateTime('Asia/Yangon');

		$today = $now->format('Y-m-d');

		$today_string = strtotime($today);

		if ($weekormonth == "month") {

			$expire_date = strtotime("+$booking_range months", $today_string);
		} else {

			$expire_date = strtotime("+$booking_range week", $today_string);
		}

		$announcement = Announcement::create([
			'title' => request('title'),
			'description' => request('description'),
			'short_description' => request('short_description'),
			'photo_path' => $image_name,
			'slide_status' => 0,
			'expired_at' => date('Y-m-d', $expire_date),
		]);

		alert()->success('Successfully Added!')->autoclose(2000);

		return redirect()->back();
	}

	protected function advertiesmentStore(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'short_description' => 'required',
			'description' => 'required',
			'short_description' => 'required',
			'photo' => 'required',
			'start_date' => 'required'
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong');

			return redirect()->back();
		}

		$booking_range = request('range');

		$weekormonth = request('weekormonth');

		if ($request->hasfile('photo')) {

			$image = $request->file('photo');

			$name = $image->getClientOriginalName();

			$image_name =  time() . "-" . $name;

			$image->move(public_path() . '/image/adv/', $image_name);

			$image = $image_name;
		}

		$today = Carbon::parse($request->start_date);
		// $now = $request->start_date;
		// dd($now);
		// $today = $now->format('Y-m-d');
		$req_date = $today->format('Y-m-d');
		$today_string = strtotime($today);

		if ($weekormonth == "month") {

			$expire_date = strtotime("+$booking_range months", $today_string);
		} else {

			$expire_date = strtotime("+$booking_range week", $today_string);
		}

		$advertisement = Advertisement::create([
			'title' => request('title'),
			'description' => request('description'),
			'short_description' => request('short_description'),
			'photo_path' => $image_name,
			'expired_at' => date('Y-m-d', $expire_date),
			'start_date' =>  $req_date
		]);

		alert()->success('Successfully Added!')->autoclose(2000);

		return redirect()->back();
	}

	public function advertiesmentIndex()
	{
		$advertisements = Advertisement::all();
		return view('Admin.Advertisment.advertisment', compact('advertisements'));
	}
	public function announcementIndex()
	{
		$announcements = Announcement::all();
		return view('Admin.Advertisment.announcement', compact('announcements'));
	}

	protected function getStateList()
	{

		$state_lists = State::all();

		return view('Admin.state_list', compact('state_lists'));
	}

	protected function storeTown(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'code' => 'required',
			'name' => 'required',
			'state_id' => 'required',
			'allowdelivery'=> 'required',
		]);
		if($request->allowdelivery == 1){
			$validator = Validator::make($request->all(), [
				'code' => 'required',
				'name' => 'required',
				'state_id' => 'required',
				'allowdelivery'=> 'required',
				'charges' => 'required'
			]);
		}
		if ($validator->fails()) {

			alert()->error('Something Wrong!');

			return redirect()->back();
		}

		try {

			$town = Town::create([
				'town_code' => $request->code,
				'town_name' => $request->name,
				'state_id' => $request->state_id,
				'status' => $request->allowdelivery,
				'delivery_charges'=> $request->charges,
			]);

		} catch (\Exception $e) {

			alert()->error('Something Wrong!');

			return redirect()->back();
		}

		alert()->success('Successfully Added');

		return redirect()->back();
	}

	protected function ajaxSearchTown(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'state_id' => 'required',
		]);

		if ($validator->fails()) {

			return response()->json(array("errors" => $validator->getMessageBag()), 422);
		}

		$town_lists = Town::where('state_id', $request->state_id)->get();

		return response()->json($town_lists);
	}

	protected function editTown(Request $request)
	{

		try {

			$town = Town::findOrFail($request->town_id);
		} catch (\Exception $e) {

			alert()->error("Town Not Found!")->persistent("Close!");

			return redirect()->back();
		}


		$town->town_code = $request->code;
		$town->town_name = $request->name;
		$town->status = $request->allowdelivery;
		$town->delivery_charges = $request->editcharges;

		$town->save();

		alert()->success('Successfully Updated!');

		return redirect()->back();
	}
}
