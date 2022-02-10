@extends('master')
@section('title', 'Dashboard')
@section('content')
<<<<<<< HEAD
<style>

</style>
=======
>>>>>>> bd4a254fa9a43aa935c360ee960d6d2868552fc8
<div class="content">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg2">
                    <i class="fa fa-calendar mt-2"></i>
                </span>
                <div class="dash-widget-info text-right">
<<<<<<< HEAD
                    <h3>100</h3>
                    <span class="widget-title3">Toady Way Total <i class="fa fa-check" aria-hidden="true"></i></span>
=======
                    <h3>{{$count_booking}}</h3>
                    <span class="widget-title3">Toady Booking Total <i class="fa fa-check" aria-hidden="true"></i></span>
>>>>>>> bd4a254fa9a43aa935c360ee960d6d2868552fc8
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
				<span class="dash-widget-bg1">
                    <i class="fa fa-user-md mt-2" aria-hidden="true"></i>
                </span>
				<div class="dash-widget-info text-right">
<<<<<<< HEAD
					<h3>7</h3>
					<span class="widget-title1">Total Branch<i class="fa fa-check" aria-hidden="true"></i></span>
=======
					<h3>{{$count_doc}}</h3>
					<span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
>>>>>>> bd4a254fa9a43aa935c360ee960d6d2868552fc8
				</div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg2">
                    <i class="fa fa-user-injured mt-2"></i>
                </span>
                <div class="dash-widget-info text-right">
<<<<<<< HEAD
                    <h3>200</h3>
                    <span class="widget-title2">Total Pickup Way<i class="fa fa-check" aria-hidden="true"></i></span>
=======
                    <h3>{{$count_patient}}</h3>
                    <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
>>>>>>> bd4a254fa9a43aa935c360ee960d6d2868552fc8
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg2">
                    <i class="fa fa-hospital-o mt-2"></i>
                </span>
                <div class="dash-widget-info text-right">
<<<<<<< HEAD
                    <h3>10</h3>
                    <span class="widget-title4">Total Client Count<i class="fa fa-check" aria-hidden="true"></i></span>
=======
                    <h3>{{$count_dept}}</h3>
                    <span class="widget-title4">Clinics <i class="fa fa-check" aria-hidden="true"></i></span>
>>>>>>> bd4a254fa9a43aa935c360ee960d6d2868552fc8
                </div>
            </div>
        </div>

    </div>

    <div class="row">
<<<<<<< HEAD
		<div class="col-md-4">
            <div class="card" style="background-color:#7CB9E8;">
                <div class="card-body font-weight-bold">
                    <h5>Today Status</h5>
                    <div class="row" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Way Income
                        </div>
                        <div class="col-md-4">
                            150000 ks
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Pickup
                        </div>
                        <div class="col-md-4">
                            600000 ks
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Delivery Income
                        </div>
                        <div class="col-md-4">
                            8000 ks
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Client Income
                        </div>
                        <div class="col-md-4" id="testcolor">
                            90000 ks
                        </div>
                    </div>
                </div>
            </div>
		</div>
        

        <div class="col-md-8">
            <div class="card" width="100px">
                <div class="main">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

	</div>

    <div class="row mt-4">
    </div>

                
=======
		<div class="col-12 col-md-6 col-lg-6 col-xl-8">
			<div class="card" id="slimtest1">
				<div class="card-header">
					<h4 class="card-title d-inline-block">Departments List</h4>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table mb-0">
                            <thead class="d-none">
                                <tr>
                                    <th>Department Photo</th>
                                    <th>Department Name</th>
                                    <th class="text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($department_lists as $dept)
                                <tr>
                                    <td>
                                       <img src="{{'/image/Department_Image/'.$dept->photo_path}}" alt="" class="w-40 rounded-circle">
                                    </td>
                                    <td>
                                        <span class="custom-badge  status-blue">{{$dept->name}}</span>
                                    </td>
                                    <td class="text-right">
                                        <button onclick="docList({{$dept->id}})" class="btn bbluecolor text-white btn-rounded">
                                            Check Doctor on this Dept
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
		</div>
        @if (session()->get('user')->isOwner(1) || session()->get('user')->hasRole('Employee') || session()->get('user')->hasRole('EmployeeC'))

        <div class="col-12 col-md-6 col-lg-4 col-xl-4">
            <div class="card member-panel" id="slimtest2">
				<div class="card-header">
					<h4 class="card-title mb-0">Sale</h4>
				</div>

                <div class="card-body">
                   <div class="col-12">
                       <div class="row">
                       <div class="col-5 bluecolor ml-3" style="font-size:15px">
                           Today Sale
                       </div>
                       <div class="col-6 pinkcolor" style="font-size:15px">
                        {{$daily_sales}}
                        </div>
                        <div class="col-5 bluecolor ml-3 mt-3" style="font-size:15px">
                            Weekly Sale
                        </div>
                        <div class="col-6 pinkcolor mt-3" style="font-size:15px">
                         {{$weekly_sales}}
                         </div>
                        <div class="col-5 bluecolor ml-3 my-3" style="font-size:15px">
                            Monthly Sale
                        </div>
                        <div class="col-6 pinkcolor my-3" style="font-size:15px">
                         {{$monthly_sales}}
                         </div>
                         <div class="col-5 bluecolor ml-3" style="font-size:15px">
                            Total Sale
                        </div>
                        <div class="col-6 pinkcolor" style="font-size:15px">
                         {{$total_sales}}
                         </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>
        @endif

	</div>

    <div class="row mt-4">
        <div classisOwnerisOwner="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card" >
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Announcement Lists</h4>

                    <a href="" class="btn bpinkcolor text-white btn-rounded float-right" data-target="#add_annou" data-toggle="modal">
                        <i class="fa fa-plus"></i> Add Announcement
                    </a>

                    <div id="add_annou" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <h3>Add Announcement!</h3>
                                    <form action="{{route('announcement_store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label>Announcement Title</label>
                                                <input class="form-control" type="text"  name="title">
                                            </div>

                                            <div class="form-group">
                                                <label>Announcement Description</label>
                                                <input class="form-control" type="text"  name="description">
                                            </div>

                                            <div class="form-group">
                                                <label>Announcement Photo</label>
                                                <input class="form-control" type="file"  name="photo">
                                            </div>


                                            <div class="form-group">
                                                <label class="gen-label">Announcement Range:</label>
                                                <input class="form-control" type="number" name="range">

                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="weekormonth" value="week" class="form-check-input">Week
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="weekormonth" value="month" class="form-check-input">Month
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-t-20">
                                                <a href="#" class="btn btn-danger ml-3" data-dismiss="modal">Close</a>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Announcement Title</th>
                                    <th>Expire Date</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($announcements as $ann)
                                <tr>
                                    <td>{{$ann->title}}</td>
                                    <td>{{date('Y-m-d', strtotime($ann->expired_at))}}</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#edit_item{{$ann->id}}">
                                        Check Details</a>
                                    </td>

                                    <div id="edit_item{{$ann->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h3 class="text-center">Announcement Details!</h3>

                                                    <hr>

                                                    <h4>Announcement Title - <span class="font-weight-bold"> {{$ann->title}} </span></h4>

                                                    <h4>Announcement Description - <span class="font-weight-bold"> {{$ann->description}}</span></h4>

                                                    <img src="">

                                                    <div class="m-t-20">
                                                        <a href="#" class="btn btn-danger ml-3" data-dismiss="modal">Close</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card" >
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Advertisement List</h4>

                    <a href="" class="btn bpinkcolor text-white btn-rounded float-right" data-target="#add_adv" data-toggle="modal">
                        <i class="fa fa-plus"></i> Add Advertisement
                    </a>

                    <div id="add_adv" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <h3>Add Advertisement!</h3>

                                    <form action="{{route('advertisement_store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label>Advertisement Title</label>
                                            <input class="form-control" type="text"  name="title">
                                        </div>

                                        <div class="form-group">
                                            <label>Advertisement Description</label>
                                            <input class="form-control" type="text"  name="description">
                                        </div>

                                        <div class="form-group">
                                            <label>Advertisement Photo</label>
                                            <input class="form-control" type="file"  name="photo">
                                        </div>

                                        <div class="form-group">
                                            <label class="gen-label">Advertisement Range:</label>
                                            <input class="form-control" type="number" name="range">

                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="weekormonth" value="week" class="form-check-input">Week
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="weekormonth" value="month" class="form-check-input">Month
                                                </label>
                                            </div>
                                        </div>
                                        <div class="m-t-20">
                                            <a href="#" class="btn btn-danger ml-3" data-dismiss="modal">Close</a>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="d-none">
                                <tr>
                                    <th>Advertisement Title</th>
                                    <th>Expire Date</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($advertisements as $ann)
                                <tr>
                                    <td>{{$ann->title}}</td>
                                    <td>{{date('Y-m-d', strtotime($ann->expired_at))}}</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#edit_adv{{$ann->id}}">
                                        Check Details</a>
                                    </td>

                                    <div id="edit_adv{{$ann->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h3 class="text-center">Advertisements Details!</h3>

                                                    <hr>

                                                    <h4>Announcement Title - <span class="font-weight-bold"> {{$ann->title}} </span></h4>

                                                    <h4>Announcement Description - <span class="font-weight-bold"> {{$ann->description}}</span></h4>

                                                    <img src="">

                                                    <div class="m-t-20">
                                                        <a href="#" class="btn btn-danger ml-3" data-dismiss="modal">Close</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

>>>>>>> bd4a254fa9a43aa935c360ee960d6d2868552fc8

</div>



@endsection

@section('js')

<script>

    $('#slimtest1').slimScroll({
        height: '400px'
    });

    $('#slimtest2').slimScroll({
        height: '400px'
    });

    function docList(id) {


        var dept_id = id;

        var html ="";

        $('#doc_list').empty();

         $.ajax({
           type:'POST',
           url:'/AjaxDeptDocList',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "dept_id":dept_id,
            },

           success:function(data){

            $.each(data, function(i, value) {

                var name = value.name;

                var postion = value.position;

                var photo = value.photo;

                var doc_id = value.id;

                var url = 'CheckDoctorProfile/'+doc_id;

                html += `<li>
                        <div class="contact-cont">
                            <div class="float-left user-img m-r-10">
                                <a href="${url}">
                                    <img src="/image/DoctorProfile/${photo}" alt="" class="w-40 rounded-circle">

                                </a>
                            </div>
                            <div class="contact-info">
                                <span class="contact-name text-ellipsis">${name}</span>
                                <span class="contact-date">${postion}</span>
                            </div>
                        </div>
                    </li>`


            });

            $('#doc_list').html(html);
           }

        });
    }
<<<<<<< HEAD

    var canvas = document.getElementById("barChart");
var ctx = canvas.getContext("2d");

// Global Options:
Chart.defaults.global.defaultFontColor = "#2097e1";
Chart.defaults.global.defaultFontSize = 11;

// Data with datasets options
var data = {
    labels: [
        "Wed\n01/07",
        "Thu\n02/07",
        "Fri\n03/07",
        "Sat\n04/07",
        "Sun\n05/07",
        "Mon\n06/07",
        "Tue\n07/07"
    ],
    datasets: [
        {
            label: "Worksheets done by you",
            fill: true,
            backgroundColor: [
                "#2097e1",
                "#2097e1",
                "#2097e1",
                "#2097e1",
                "#2097e1",
                "#2097e1",
                "#2097e1"
            ],
            data: [2, 6, 3, 7, 5, 9, 4]
        },
        {
            label: "Community avg.",
            fill: true,
            backgroundColor: [
                "#bdd9e6",
                "#bdd9e6",
                "#bdd9e6",
                "#bdd9e6",
                "#bdd9e6",
                "#bdd9e6",
                "#bdd9e6"
            ],
            data: [4, 3, 5, 4, 4, 7, 20]
        }
    ]
};

// Notice how nested the beginAtZero is
var options = {
    title: {
        display: true,
        text: "Worksheets completed this week",
        position: "bottom"
    },
    scales: {
        xAxes: [
            {
                gridLines: {
                    display: true,
                    drawBorder: true,
                    drawOnChartArea: false
                }
            }
        ],
        yAxes: [
            {
                ticks: {
                    beginAtZero: true
                }
            }
        ]
    }
};

// added custom plugin to wrap label to new line when \n escape sequence appear
var labelWrap = [
    {
        beforeInit: function (chart) {
            chart.data.labels.forEach(function (e, i, a) {
                if (/\n/.test(e)) {
                    a[i] = e.split(/\n/);
                }
            });
        }
    }
];

// Chart declaration:
var myBarChart = new Chart(ctx, {
    type: "bar",
    data: data,
    options: options,
    plugins: labelWrap
});

=======
>>>>>>> bd4a254fa9a43aa935c360ee960d6d2868552fc8
</script>

@endsection
