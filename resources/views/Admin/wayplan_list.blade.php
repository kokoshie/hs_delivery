@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="col-md-6">
    <button class="btn btn-dark text-info" data-toggle="modal" data-target="#advance_modal" onclick="advance()"><i class="fas fa-search-plus mr-2"></i>Advance Search<i class="fas fa-arrow-right ml-2"></i></button>
</div>

<div class="row">
  <input type="hidden" id="searchtype">
  <input type="hidden" id="searchdatetype">
  <form action="{{ route('way_import') }}" method="POST" enctype="multipart/form-data" id="excelway">
    @csrf

        <input type="file" id="excelwayfile" name="file" class="form-control input-sm mr-8 bg-info d-none">


    </form>
 


    <div class="col-md-3 mt-3" id="search_type">
        <select class="form-control rounded border border-primary" aria-label=".form-select-lg example" id="rout" onchange="select_type(this.value)">
            <option selected>Choose Search Type</option>
            <!-- <option value="1">Route</option> -->
            <option value="2">Phone Number</option>
            <option value="3">Token</option>
            <!-- <option value="4">Start Date</option> -->
        </select>
    </div>
    <div class="col-md-4" id="type_result" style="margin-top:17px;">

    </div>
    <div class="col-md-5" style="padding-top:17px;padding-right:20px;">
        <div class="row">

            <div class="col-md-2">
                <button class="btn btn-primary" style="margin-top:5px;margin-left:px" onclick="searching()">Search</button>
            </div>
            <div class="col-md-4">
              <div class="row">
                <div class="col-md-6">
                <button type="button" class="btn btn-dark" style="margin-top:5px;" onclick="excel_import()">Import</button>
                </div>
                <form action="{{route('way_export_query')}}" method="post" id="way_query_export">
                  @csrf
                  <input type="hidden" name="way_route_from" id="way_route_from">
                  <input type="hidden" name="way_route_to" id="way_route_to">
                  <input type="hidden" name="way_status" id="way_status">
                  <input type="hidden" name="way_date" id="way_date">
                </form>
                
                <div class="col-md-6" style="margin-top:5px" id="replace_export">
                <a href="{{route('way_export')}}" class="btn btn-success">Export</a>
                <!-- <button class="btn btn-secondary" disabled>Export</button> -->
                </div>
                <!-- Begin Advance Search Modal -->
                <div class="modal fade" id="advance_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLongTitle">WayPlan Advance <span class="text-warning font-weight-bold">Filter</span></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Route Name</label>
                                <select class="form-control rounded border border-primary" aria-label=".form-select-lg example" name="adv_route" id="adv_route">
                                    <option selected hidden>Choose Routes</option>
                                    @foreach($package as $pack)
                                    <option data-from="{{$pack->from_city_id}}" data-to="{{$pack->to_city_id}}">{{$pack->from_city_name}} - {{$pack->to_city_name}} Route</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                              <label>Recieve Date</label>
                              <input type="date" name="advance_date" id="adv_date" class="border border-outline border-primary pl-5 pr-5 pt-2 pb-2" style="border-radius: 7px;" value="">
                            </div>
                            <div class="col-md-4">
                                <label>Way Status</label>
                                <select class="form-control rounded border border-primary" aria-label=".form-select-lg example" name="adv_status" id="adv_status">
                                    <option selected hidden>Choose Way Status</option>
                                    
                                    <option value="1">Done</option>
                                    <option value="2">Pending</option>
                                    <option value="3">Reject</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-4">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="button" class="btn btn-primary btn-block" onclick="search_adv()">Quick Search</button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
                <!-- End Advance Modal -->
                
              </div>
               
                

            
            </div>
        </div>


    {{-- Excel Import Begin --}}


    {{-- End Excel Import --}}
  </div>
</div>


<div id="rou" class="mt-4">

</div>

<div class="mt-5">
<!-- <div class="offset-md-11">
    <button class="btn btn-info" onclick="searching()"><i class=" fas fa-search mr-2" style="color:#fff"></i>Search</button>
  </div> -->
    <table class="table table-striped">
      <thead class="bg-info text-white">
        <tr>
          <th>No</th>
          <th>Customer</th>
          <th>Receive Date</th>
          <th>Status</th>
          <th>Location</th>
          <th>Pak Qty</th>
          <th>Contact Number</th>
          <th>Weight</th>
          <th>Total Charges</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody id="search_result">
        <?php $i=1; ?>
        @foreach($wayplan as $way)
        @if($way->reject_status != 1)
        <tr>
            <td>{{$i++}}.</td>
            <td><i class="far fa-user mr-2" style="size:7px"></i>{{$way->customer_name}}</td>
            <td>{{$way->receive_date}}</td>
            @if($way->way_status == 0)
            <td><span class="badge badge-light border border-danger mt-1  text-danger">Pending</span></td>
            @else
            <td><span class="badge badge-light border border-success mt-1 text-success">Done</span></td>
            @endif



            @if($way->receive_status == 0)
            @foreach($location as $locat)
            @if($locat->id == $way->receive_point)
            <td>{{$locat->name}}</td>
            @endif
            @endforeach
            @elseif($way->receive_status == 1 && $way->myawady_status != 2 && $way->way_status != 1)
            @foreach($location as $locat)
            @if($locat->id == $way->receive_point)
            <td>{{$locat->name}}</td>
            @endif
            @endforeach
            @elseif($way->myawady_status == 2 && $way->dropoff_status != 2 && $way->way_status != 1)
            <td>MyaWady</td>
            @elseif($way->dropoff_status == 2 && $way->customer_status != 2 && $way->way_status != 1)
            @foreach($location as $locat)
            @if($locat->id == $way->dropoff_point)
            <td>{{$locat->name}}</td>
            @endif
            @endforeach
            @elseif($way->way_status == 1)
            <td>{{$way->customer_address}}</td>
            @endif


            <td>&nbsp;&nbsp;&nbsp;{{$way->parcel_quantity}}</td>

            <td class="text-center">{{$way->customer_phone}}</td>
            <td>{{$way->total_weight}}<span class="font-weight-bold">Kg</span></td>
            <td class="text-center">{{$way->total_charges}}</td>
            <!-- <td><button href="{{route('way_change_status',$way->id)}}" type="button" class="btn btn-sm btn-danger"><i class="fas fa-ellipsis-h"></i>hello</button></td> -->
            <td><a href="{{route('way_change_status',$way->id)}}" class="btn btn-sm btn-primary">Change Status</a>
            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject_modal{{$way->id}}">Reject</button>
            
          </td>
          </tr>
          <!-- Reject Modal -->
          <div class="modal fade" id="reject_modal{{$way->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Reject WayPlan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{route('reject_way')}}" method="post">
                  @csrf
                  <input type="hidden" name="wayID" value="{{$way->id}}">
                <div class="modal-body">
                  <div class="row">
                      <div class="col-md-3 mr-2">
                          <h5 style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2">Date</h5>
                      </div>
                      <div class="col-md-6">
                      <input type="date" name="reject_date" id="receive_date" class="border border-outline border-primary pl-5 pr-5 pt-2 pb-2" style="border-radius: 7px;" value="">
                      </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <h5 style="color:rgb(34, 190, 241);margin-top:20px;" class="pl-4 pt-2">Remark</h5>
                        </div>
                        <div class="col-md-6" style="margin-left:8px;">
                        <textarea name="reject_remark" id="" cols="45" rows="3" class="border border-outline border-primary" style="border-radius: 7px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Reject</button>
                </form>
                </div>
              </div>
            </div>
          </div>
          <!-- End Reject Modal -->
          @endif
          @endforeach
      </tbody>
    </table>
  </div>

@endsection

@section('js')

<script>
 $(document).ready(function(){

    //localStorage
    var way = @json($ways);

    $('#way_lists').val(JSON.stringify(way));
    // var item={id:parseInt(id),item_name:itemname,unit_name:unitname,current_qty:currentqty,order_qty:1,selling_price:saleprice,each_sub:eachsub};
    
    
    
    
    
    //end localstorage
    // $('#excelwayfile').hide();
  })
  function excel_import()
  {
      // $( "#excelwayfile" ).addClass( "d-block" );

      $('#excelwayfile').click();
  }
  $('#excelwayfile').change(function(){
    $('#excelway').submit();
  });
function routes(val){
    alert(val);
    html = '';
    if(val == 1){
        html+=`<h5 style="color:black;" class="ml-3">BKK-YGN Route</h5>
               <hr style="width:20%;text-align:left;margin-left:0">
               `;
    }
    else if(val == 2){
        html+=`<h5 style="color:black;" class="ml-3">BKK-MDY Route</h5>
                <hr style="width:20%;text-align:left;margin-left:0">
               `;
    }
    else if(val == 3){
        html+=`<h5 style="color:black;" class="ml-3">MAESOT-YGN Route</h5>
                <hr style="width:20%;text-align:left;margin-left:0">
               `;
    }
    else if(val == 4){
        html+=`<h5 style="color:black;" class="ml-3">MAESOT-MDY Route</h5>
                <hr style="width:20%;text-align:left;margin-left:0">
               `;
    }

    $('#rou').html(html);
    $('#searchtype').val(0);

}
function select_type(value)
{
  var htmltype = "";
  if(value == 1)
  {
     htmltype +=`
     <select class="form-control rounded border border-primary" aria-label=".form-select-lg example" id="rout" onchange="routes(this.value)">

      <option selected>Routes</option>
      <option value="1">BKK-YGN Route</option>
      <option value="2">BKK-MDY Route</option>
      <option value="3">MAESOT-YGN Route</option>
      <option value="4">MAESOT-MDY Route</option>

  </select>
     `;
  }
  else if(value == 2)
  {
    htmltype +=`

      <input type="search" id="search_phone" class="form-control rounded border border-primary" placeholder="Search With Phone No" aria-label="Search" aria-describedby="search-addon" onkeyup="searchwithph()"/>

    `;
  }
  else if(value == 3)
  {
    htmltype +=`
    <input type="search" id="search_token" class="form-control rounded border border-primary" placeholder="Search With Token" aria-label="Search" aria-describedby="search-addon" onkeyup="intoken()"/>
    `;
  }
  else if(value == 4)
  {
    htmltype +=`
    <div class="row">
    <div class="col-md-6">
    <input type="date" id="search_date" class="form-control rounded border border-primary" placeholder="Search With Date" aria-label="Search" aria-describedby="search-addon" onchange="indate()"/>
    </div>
    <div class="col-md-6">
    <select class="form-control rounded border border-primary" aria-label=".form-select-lg example" id="date_type" onchange="dateType(this.value)">

      <option selected>Choose Date Type</option>
      <option value="1">Receive point</option>
      <option value="2">Register</option>
      <option value="3">MyaWady point</option>
      <option value="4">DropOff point</option>

  </select>
  </div>
  </div>
    `;
  }
  $('#type_result').html(htmltype);
}
function dateType(value)
{
  $('#searchdatetype').val(value);
}
function searchwithph()
{
  $('#searchtype').val(1);
  var phno = $('#search_phone').val();
  // console.log(phno);
  $.ajax({
           type:'POST',
           url:'/search_phone_ajax',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "phone":phno,

            },

           success:function(data){
             var htmlphone = "";
              $.each(data,function(i,v){
                  htmlphone +=`

                  ${v.customer_phone}</br>

                  `;
              });
              $('#phone_suggest').html(htmlphone);

           }
          });

}
function intoken()
{
  $('#searchtype').val(2);
}
function indate()
{
  $('#searchtype').val(3);
}
function searching()
{
  var date_type_in = $('#searchdatetype').val();
  var insearch = $('#searchtype').val();
  var phone = $('#search_phone').val();
  var token = $('#search_token').val();
  var date = $('#search_date').val();
  // alert(date);
  if(insearch == 1)
  {
    var key = phone;
    var type = 1;
    var date_type = 0;
  }
  else if(insearch == 2)
  {
    var key = token;
    var type = 2;
    var date_type = 0;
  }
  else if(insearch == 3)
  {
    var key = date;
    var type = 3;
    var date_type = date_type_in;
  }

  alert(key);
  $.ajax({
           type:'POST',
           url:'/searching_ajax',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "search_key":key,
                "type" : type,
                "date_type" : date_type
            },

           success:function(data){

              var htmlresult = "";
              $.each(data,function(i,v){
                var url = "{{url('/way_change_status')}}/"+v.id;
                alert(v.customer_name);
                htmlresult +=`
                <tr>
            <td>${i+1}.</td>
            <td><i class="far fa-user mr-2" style="size:7px"></i>${v.customer_name}</td>
            <td>${v.receive_date}</td>
            `;
            if(v.way_status == 0)
            {
            htmlresult +=`
            <td><span class="badge badge-light border border-danger mt-1 text-danger">Pending</span></td>`;
            }
            else
            {
            htmlresult +=`
            <td><span class="badge badge-light border border-success mt-1 text-success">Done</span></td>`;
            }

            if(v.receive_status == 0)
            {
              htmlresult +=`
              <td>${v.receivelocation.name}</td>
              `;
            }
            else if(v.receive_status == 1 && v.myawady_status != 2 && v.way_status != 1)
            {
            htmlresult +=`
            <td>${v.receivelocation.name}</td>
            `;
            }
            else if(v.myawady_status == 2 && v.dropoff_status != 2 && v.way_status != 1)
            {
              htmlresult +=`
              <td>MyaWady</td>
              `;
            }
            else if(v.dropoff_status == 2 && v.customer_status != 2 && v.way_status != 1)
            {
              htmlresult +=`
              <td>${v.dropofflocation.name}</td>
              `;
            }
            else if(v.way_status == 1)
            {
              htmlresult +=`
              <td>${v.customer_address}</td>
              `;
            }
            htmlresult +=`
            <td>&nbsp;&nbsp;&nbsp;${v.parcel_quantity}</td>
            <td>${v.customer_phone}</td>
            <td>${v.total_weight}</td>
            <td>${v.total_charges}</td>

            <td><a href="${url}" class="btn btn-sm btn-primary">Change Status</a>
            <a href="" class="btn btn-sm btn-danger">Reject</a>
            </td>
            </tr>
            `;

              });
              $('#search_result').html(htmlresult);
           }
          });
}

function advance()
{
  
}
function search_adv()
{
  $('#advance_modal').modal("hide");
  var htmlexp = "";
  htmlexp +=`<button type="" class="btn btn-dark" onclick="advance_export()">Export</button>`;
  $('#replace_export').html(htmlexp);
  // var id  = $('#adv_route').val();
  var from_id = $('#adv_route').find(":selected").data('from');
  var to_id = $('#adv_route').find(":selected").data('to');
  var advance_date = $('#adv_date').val();
  var advance_status = $('#adv_status').val();
  $('#way_route_from').val(from_id);
  $('#way_route_to').val(to_id);
  $('#way_date').val(advance_date);
  $('#way_status').val(advance_status);
  $.ajax({
        type:'POST',
        url:'/advance_search',
        dataType:'json',
        data:{
            "_token": "{{ csrf_token() }}",
            "from":from_id,
            "to":to_id,
            "receive_date" : advance_date,
            "advance_status" : advance_status,

        },

        success:function(data){
            var htmlways="";
            $.each(data,function(i,v){
              var url = "{{url('/way_change_status')}}/"+v.id;
              htmlways +=`
                <tr>
            <td>${i+1}.</td>
            <td><i class="far fa-user mr-2" style="size:7px"></i>${v.customer_name}</td>
            <td>${v.receive_date}</td>
            `;
            if(v.way_status == 0)
            {
            htmlways +=`
            <td><span class="badge badge-light border border-danger mt-1 text-danger">Pending</span></td>`;
            }
            else
            {
            htmlways +=`
            <td><span class="badge badge-light border border-success mt-1 text-success">Done</span></td>`;
            }

            if(v.receive_status == 0)
            {
              htmlways +=`
              <td>${v.receivelocation.name}</td>
              `;
            }
            else if(v.receive_status == 1 && v.myawady_status != 2 && v.way_status != 1)
            {
            htmlways +=`
            <td>${v.receivelocation.name}</td>
            `;
            }
            else if(v.myawady_status == 2 && v.dropoff_status != 2 && v.way_status != 1)
            {
              htmlways +=`
              <td>MyaWady</td>
              `;
            }
            else if(v.dropoff_status == 2 && v.customer_status != 2 && v.way_status != 1)
            {
              htmlways +=`
              <td>${v.dropofflocation.name}</td>
              `;
            }
            else if(v.way_status == 1)
            {
              htmlways +=`
              <td>${v.customer_address}</td>
              `;
            }
            htmlways +=`
            <td>&nbsp;&nbsp;&nbsp;${v.parcel_quantity}</td>
            <td>${v.customer_phone}</td>
            <td>${v.total_weight}</td>
            <td>${v.total_charges}</td>
            
            <td><a href="${url}" class="btn btn-sm btn-primary">Change Status</a>
            <a href="" class="btn btn-sm btn-danger">Reject</a>
            </td>
            </tr>
            `;
                
                
            });
            $('#search_result').html(htmlways);
        }
      });

// alert(from_id+"---"+to_id+"==="+advance_date);
}
function advance_export()
{
  alert("Advance - Export");
  $('#way_query_export').submit();
}


</script>

@endsection
