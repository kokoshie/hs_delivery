@extends('master')
@section('title', 'Dashboard')
@section('content')
<style>

</style>
<div class="content">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg2">
                    <i class="fa fa-calendar mt-2"></i>
                </span>
                <div class="dash-widget-info text-right">
                    <h3>100</h3>
                    <span class="widget-title3">Toady Way Total <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
				<span class="dash-widget-bg1">
                    <i class="fa fa-user-md mt-2" aria-hidden="true"></i>
                </span>
				<div class="dash-widget-info text-right">
					<h3>7</h3>
					<span class="widget-title1">Total Branch<i class="fa fa-check" aria-hidden="true"></i></span>
				</div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg2">
                    <i class="fa fa-user-injured mt-2"></i>
                </span>
                <div class="dash-widget-info text-right">
                    <h3>200</h3>
                    <span class="widget-title2">Total Pickup Way<i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
                <span class="dash-widget-bg2">
                    <i class="fa fa-hospital-o mt-2"></i>
                </span>
                <div class="dash-widget-info text-right">
                    <h3>10</h3>
                    <span class="widget-title4">Total Client Count<i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
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

</script>

@endsection
