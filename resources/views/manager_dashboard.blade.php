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
                    <div class="row mt-5" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Way Income
                        </div>
                        <div class="col-md-4">
                            150000 ks
                        </div>
                    </div>
                    <div class="row mt-5" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Pickup
                        </div>  
                        <div class="col-md-4">
                            600000 ks
                        </div>
                    </div>
                    <div class="row mt-5" style="margin-top:20px">
                        <div class="col-md-8">
                            Total Delivery Income
                        </div>
                        <div class="col-md-4">
                            8000 ks
                        </div>
                    </div>
                    <div class="row mt-5" style="margin-top:20px">
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
        <div class="card">
            <div class="row ml-1">
                <div class="col-md-4 mt-2">
                    <label style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2 font-weight-bold  ">Choose Option Filter</label>
                    <select class="form-control rounded border border-primary" id="" onchange="choose_filter(this.value)">
                    <option>Choose Filter</option>
                        <option value="1">Way Status Qty</option>
                        <option value="2">Total Revenue</option>
                    </select>
                </div>
                <div class="col-md-4 mt-2 st_week">
                    <label style="color:rgb(34, 190, 241)" class="pl-4 ml-2 pt-2 font-weight-bold  ">Status Weekly Filter</label>
                    <input type="week" name="receive_week" id="receive_week" class="border border-outline border-primary pl-3 pr-3 pt-2 pb-2 ml-1" style="border-radius: 7px;" onchange="getweek(this.value)">
                </div>
                <div class="col-md-4 mt-2 d-none re_month">
                    <label style="color:rgb(34, 190, 241)" class="pl-4 ml-2 pt-2 font-weight-bold  ">Revenue Weekly Filter</label>
                    <input type="week" name="reve_week" id="reve_week" class="border border-outline border-primary pl-3 pr-3 pt-2 pb-2 ml-1" style="border-radius: 7px;" onchange="">
                </div>
                <div class="col-md-4 mt-2 st_month">
                    <label style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2 font-weight-bold  ">Status Month Filter</label>
                    <input type="month" name="receive_month" id="receive_month" class="border border-outline border-primary pl-3 pr-3 pt-2 pb-2" style="border-radius: 7px;" onchange="getmonth(this.value)">
                </div>
                <div class="col-md-4 mt-2 d-none re_month">
                    <label style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2 font-weight-bold  ">Revenue Month Filter</label>
                    <input type="month" name="reve_month" id="reve_month" class="border border-outline border-primary pl-3 pr-3 pt-2 pb-2" style="border-radius: 7px;">
                </div>
            </div>
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
    function getweek(week)
    {
        alert(week);
        $.ajax({
           type:'POST',
           url:'/get_week',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "receive_week":week,
                
            },

           success:function(data){
           }

        });
    }
    function getmonth(month)
    {
        $.ajax({
           type:'POST',
           url:'/get_month',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "receive_month":month,
                
            },

           success:function(data){
            //    alert(data.f_done);
            //    begin chart
              var fd = data.f_done;
              var fp = data.f_pend;
              var fr = data.f_reject;
              var sd = data.sec_done;
              var sp = data.sec_pend;
              var sr = data.sec_reject;
              var td = data.th_done;
              var tp = data.th_pend;
              var tr = data.th_reject;
              var ld = data.last_done;
              var lp = data.last_pend;
              var lr = data.last_reject;
            var canvas = document.getElementById("barChart");
            var ctx = canvas.getContext("2d");

// Global Options:
                Chart.defaults.global.defaultFontColor = "#2097e1";
                Chart.defaults.global.defaultFontSize = 11;

                // Data with datasets options
                var data = {
                    labels: [
                        "First Week",
                        "Second Week",
                        "Third Week",
                        "Last Week",
                        
                    ],
                    datasets: [
                        {
                            label: "Done Status Qty",
                            fill: true,
                            backgroundColor: [
                                "#2097e1",
                                "#FF0000",
                                "#2097e1",
                                "#2097e1",
                                "#2097e1",
                                "#2097e1",
                                "#2097e1"
                            ],
                            data: [fd, sd, td, ld,]
                        },
                        {
                            label: "Pending Status Qty",
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
                            data: [fp, sp, tp, lp,]
                        },
                        {
                            label: "Reject Status Qty",
                            fill: true,
                            backgroundColor: [
                                "#e4181e",
                                "#e4181e",
                                "#e4181e",
                                "#e4181e",
                                "#e4181e",
                                "#e4181e",
                                "#e4181e"
                            ],
                            data: [fr, sr, tr, lr,]
                        }

                    ]
                };

                // Notice how nested the beginAtZero is
                var options = {
                    title: {
                        display: true,
                        text: "WayPlan's done , pending , reject Quantity",
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
                                    precision: 0
                                    // beginAtZero: true
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

            // end chart
           }
        });
    }

$(document).ready(function(){
    var way = @json($waylist);
    // $( "#re_month" ).addClass( 'd-none' );
    // $( "#re_week" ).addClass( 'd-none' );
    var canvas = document.getElementById("barChart");
var ctx = canvas.getContext("2d");

// Global Options:
Chart.defaults.global.defaultFontColor = "#2097e1";
Chart.defaults.global.defaultFontSize = 11;

// Data with datasets options
var data = {
    labels: [
        "First Week",
        "Second Week",
        "Third Week",
        "Last Week",
        
    ],
    datasets: [
        {
            label: "Done Status Qty",
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
            data: [2, 3, 1, 4,]
        },
        {
            label: "Pending Status Qty",
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
            data: [3, 5, 7, 1,]
        },
        {
            label: "Reject Status Qty",
            fill: true,
            backgroundColor: [
                "#e4181e",
                "#e4181e",
                "#e4181e",
                "#e4181e",
                "#e4181e",
                "#e4181e",
                "#e4181e"
            ],
            data: [2, 4, 8, 10,]
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
                    // precision: 0
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
})
function choose_filter(value)
{
    // alert(value);
    if(value == 1)
    {
        // alert("one");
        $( ".st_month" ).show();
        $( ".st_week" ).show();
        $( ".re_month" ).hide();
        $( ".re_week" ).hide();
    }
    else if(value ==2)
    { 
        // alert("two");
        $( ".st_month" ).hide();
        $( ".st_week" ).hide();
        $( '.re_month' ).show();
        $('.re_month').show();
        $( '.re_week' ).removeClass("d-none");
        $('.re_month').removeClass("d-none");
    }
    
}


</script>

@endsection

