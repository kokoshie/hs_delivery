@extends('master')
@section('title', 'Change WayPlan Schedule Status')
@section('content')
<div class='container' width="80%">
<h4 class="text-info text-center">Change Way Plan Status</h4>
<h5><i>Token</i>&nbsp;&nbsp;&nbsp;:<span class="font-weigth-bold text-info ml-3"><i>{{$wayplan->token}}</i></span></h5></br>
<h5><i>Customer Name</i>&nbsp;&nbsp;&nbsp;:<span class="font-weigth-bold text-info ml-3"><i>{{$wayplan->customer_name}}</i></span></h5></br>
<h5><i>Customer Phone</i>&nbsp;&nbsp;&nbsp;:<span class="font-weigth-bold text-info ml-3"><i>{{$wayplan->customer_phone}}</i></span></h5></br>
<h5><i>Track Number</i>&nbsp;&nbsp;&nbsp;:<span class="font-weigth-bold text-info ml-3"><i>{{$wayplan->tracking_no}}</i></span></h5>
<form action="{{route('store_changes_status')}}" method="post" id="storeform">
    @csrf
    <input type="hidden" name="wayplan_id" value="{{$wayplan->id}}">
    <input type="hidden" name="receiveh_date" id="receiveh_date">
    <input type="hidden" name="receiveh_status" id="receiveh_status">
    <input type="hidden" name="myah_date" id="myah_date">
    <input type="hidden" name="myah_status" id="myah_status">
    <input type="hidden" name="custh_date" id="custh_date">
    <input type="hidden" name="custh_status" id="custh_status">
    <input type="hidden" name="dropoffh_date" id="dropoffh_date">
    <input type="hidden" name="dropoffh_status" id="dropoffh_status">
    <input type="hidden" name="cremark" id="cremark">
    <input type="hidden" name="dremark" id="dremark">
</form>
<div class="row mt-5">
    <div class="col-md-6">
<!-- Receive  -->
<h5 class=""><span class="font-weght-bold" style="font-size:20px;">1.</span>Receive Point</span></h5>
        <span class="custom-badge  status-blue" style="width:540px">
            <h4 class="text-center"><span class="badge badge-info">{{$re_point->name}}</span></h4>
            <div class="col-md-6">
            <div class="row">
                <div class="col-md-5 mr-2">
                    <h5 style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2">Date</h5>
                </div>
                <div class="col-md-6">
                <input type="date" name="receive_date" id="receive_date" class="border border-outline border-primary pl-5 pr-5 pt-2 pb-2" style="border-radius: 7px;" value="{{$wayplan->receive_date}}">
                </div>
            </div>
            </div>
            <div class="col-md-6 mr-2">
            <div class="row">
                <div class="col-md-5 mr-2">
                    <h5 style="color:rgb(34, 190, 241);margin-top:20px;" class="pl-4 ml-3 pt-2">Status</h5>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="receive_status" id="receive_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="receive_change(this.value)">
                            <option value="0" selected>Not Receive</option>
                            <option value="1">Received</option>
                            </select>
                        </div>
                        {{-- <div class="col-md-4">
                        <button type="button" id="reremark" class="btn btn-warning" style="" onclick="re_remark()" disabled>Remark</button>
                        </div> --}}
                    </div>
                </div>
            </div>
            </div>
        </span>
<!-- End Receive -->
    </div>
    <div class="col-md-6">
        <!-- Myawady -->
        <h5 class=""><span class="font-weght-bold" style="font-size:20px;">2.</span>Mya-Wady Point</h5>
        <span class="custom-badge  status-blue" style="width:510px">
            @if($wayplan->receive_status == 1)
            <h4 class="text-center"><span id="on_mya"><span class="badge badge-info">Mya-Wady Point</span></span></h4>
            @else
            <h4 class="text-center"><span id="on_mya"><span class="badge badge-secondary">Mya-Wady Point</span></span></h4>
            @endif
            <div class="col-md-6">
            <div class="row">
                <div class="col-md-5 mr-2">
                    <h5 style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2">Date</h5>
                </div>
                <div class="col-md-6">
                <input type="date" name="mya_date" id="mya_date" class="border border-outline border-primary pl-5 pr-5 pt-2 pb-2" style="border-radius: 7px;" value="{{$wayplan->myawady_date}}">
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="row">
                <div class="col-md-5 mr-2">
                    <h5 style="color:rgb(34, 190, 241);margin-top:20px;" class="pl-4 ml-3 pt-2">Status</h5>
                </div>
                <div class="col-md-6" id="show_mya_status">
                    @if($wayplan->myawady_status == 0)
                <select name="mya_status" id="myaw_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="mya_change(this.value)" disabled>
                <option value="0" selected>Not Start</option>
                <option value="1">On the way</option>
                <option value="2">Arrived</option>
                </select>
                @else
                <select name="mya_status" id="myaw_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="mya_change(this.value)">
                    <option value="0" selected>Not Start</option>
                    <option value="1">On the way</option>
                    <option value="2">Arrived</option>
                    </select>
                @endif
                </div>
            </div>
            </div>
            {{-- <div class="col-md-6" id="myawady_remark">
                <button type="button" id="myaremark" class="btn btn-warning" style="margin-left:180px;" onclick="mya_remark()" disabled>Remark</button>
            </div> --}}
        </span>
        <!-- End Myawady -->
    </div>
</div><!-- All Row -->
</div>
<!-- Next  -->
<div class="row mt-5">
    <div class="col-md-6" style="padding-left:60px;">
<!-- DropOff -->
<h5 class=""><span class="font-weght-bold" style="font-size:20px;">3.</span>DropOff Point</h5>
        <span class="custom-badge  status-blue pl-3">
            @if($wayplan->myawady_status == 2)

            <h4 class="text-center"><span class="badge badge-info">{{$drop_point->name}}</span></h4>
            @else
            <h4 class="text-center" id="on_drop_no"><span class="badge badge-secondary">{{$drop_point->name}}</span></h4>
            <h4 class="text-center" id="on_drop_yes"><span class="badge badge-info">{{$drop_point->name}}</span></h4>
            @endif
            <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h5 style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2">Date</h5>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="date" name="dropoff_date" id="dropoff_date" class="border border-outline border-primary pl-5 pr-5 pt-2 pb-2" style="border-radius: 7px;" value="{{$wayplan->receive_date}}">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-warning p-2" style="margin-left:150;border-radius: 7px;" onclick="drop_remark()">Remark</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h5 style="color:rgb(34, 190, 241);margin-top:20px;" class="pl-4 ml-3 pt-2">Status</h5>
                </div>
                <div class="col-md-6" id="show_dropoff_status">
                @if($wayplan->dropoff_status == 0)
                <select name="dropoff_statuss" id="dropoff_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="cust_change(this.value)" disabled>

                <option value="0" selected>Not Start</option>
                <option value="1">On the way</option>
                <option value="2">Arrived</option>
                </select>
                @else
                <select name="dropoff_statuss" id="dropoff_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="cust_change(this.value)">

                    <option value="0" selected>Not Start</option>
                    <option value="1">On the way</option>
                    <option value="2">Arrived</option>
                    </select>

                @endif
                </div>
            </div>
            </div>
             <div class="col-md-6 d-none" id="dropoff_area">
                <!-- <button type="button" id="dropremark" class="btn btn-warning" style="margin-left:180px;" onclick="drop_remark()" disabled>Remark</button> -->
                <div class="row mb-2">
                    <div class="col-md-5">
                        <h5 style="color:rgb(34, 190, 241);margin-top:20px;" class="pl-4 ml-3 pt-2 mr-3">Remark</h5>
                    </div>
                    <div class="col-md-6">
                    <textarea name="remark" id="dropremark" cols="50" rows="3" class="border border-outline border-primary" style="border-radius: 7px;">{{$wayplan->dropoff_remark}}</textarea>
                    </div>
                </div>
            </div> 
        </span>
<!-- End Receive -->
    </div>
    <div class="col-md-6">
        <!-- Customer -->
        <h5 class=""><span class="font-weght-bold" style="font-size:20px;">4.</span>Customer Point</h5>
        <span class="custom-badge  status-blue" style="width:510px">
            @if($wayplan->dropoff_status == 2)
            <h4 class="text-center"><span id="on_cust"><span class="badge badge-info">Customer Place</span></span></h4>
            @else
            <h4 class="text-center"><span id="on_cust"><span class="badge badge-secondary">Customer Place</span></span></h4>
            @endif
            <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h5 style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2">Date</h5>
                </div>
                <div class="col-md-6">
                    <div class="row">
                            <div class="col-md-8">
                                <input type="date" name="cust_date" id="cust_date" class="border border-outline border-primary pl-5 pr-5 pt-2 pb-2" style="border-radius: 7px;" value="{{$wayplan->customer_date}}" onchange="count_change()">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-sm btn-warning p-2" style="margin-left:150;border-radius: 7px;" onclick="cust_remark()">Remark</button>
                            </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="row">
                <div class="col-md-5" id="show_cust_select">
                    <h5 style="color:rgb(34, 190, 241);margin-top:20px;" class="pl-4 ml-3 pt-2">Status</h5>
                </div>
                <div class="col-md-6" id="show_cust_status">
                    @if($wayplan->customer_status == 0)
                <select name="cust_statuss" id="cust_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="cust_status(this.value)" disabled>

                <option value="0" selected>Not Start</option>
                <option value="1">On the way</option>
                <option value="2">Arrived</option>
                </select>
                @else
                <select name="cust_statuss" id="cust_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="cust_status(this.value)">

                    <option value="0" selected>Not Start</option>
                    <option value="1">On the way</option>
                    <option value="2">Arrived</option>
                    </select>
                @endif

                </div>
            </div>
            </div>
             <div class="col-md-6 d-none" id="customer_remark">
                <!-- <button type="button" id="custremark" class="btn btn-warning" style="margin-left:180px;" onclick="cust_remark()" disabled>Remark</button> -->
                <div class="row mb-2">
                    <div class="col-md-5">
                        <h5 style="color:rgb(34, 190, 241);margin-top:20px;" class="pl-4 ml-3 pt-2 mr-3">Remark</h5>
                    </div>
                    <div class="col-md-6">
                    <textarea name="remark" id="custremark" cols="50" rows="3" class="border border-outline border-primary" style="border-radius: 7px;">{{$wayplan->customer_remark}}</textarea>
                    </div>
                </div>
            </div> 
        </span>

        <!-- End Myawady -->
    </div>
</div><!-- All Row -->
<div class="col-md-12 offset-md-5 mt-5">
<button type="submit" class="btn btn-danger" onclick="test()"><i class="fas fa-dice-d6 mr-2"></i>Changes Status</button>

</div>
</div>




@endsection
@section('js')
<script>
    $(document).ready(function(){
        
        $('#on_drop_yes').hide();
        var pre_status = @json($wayplan);
        if(pre_status.receive_status == 1)
        {
            $('#receive_status option[value=1]').attr('selected','selected');
        }
        if(pre_status.myawady_status == 0)
        {
            $('#myaw_status option[value=0]').attr('selected','selected');
        }
        else if(pre_status.myawady_status == 1)
        {
            $('#myaw_status option[value=1]').attr('selected','selected');
        }
        else
        {
            $('#myaw_status option[value=2]').attr('selected','selected');
        }
        if(pre_status.dropoff_status == 0)
        {
            $('#dropoff_status option[value=0]').attr('selected','selected');
        }
        else if(pre_status.dropoff_status == 1)
        {
            $('#dropoff_status option[value=1]').attr('selected','selected');
        }
        else
        {
            $('#dropoff_status option[value=2]').attr('selected','selected');
        }
        if(pre_status.customer_status == 0)
        {
            $('#cust_status option[value=0]').attr('selected','selected');
        }
        else if(pre_status.customer_status == 1)
        {
            $('#cust_status option[value=1]').attr('selected','selected');
        }
        else
        {
            $('#cust_status option[value=2]').attr('selected','selected');
        }

    })
function receive_change(value)
{
    var htmlmya = "";
    var htmlmya_select = "";
    // alert(value);
    if(value == 1)
    {

        htmlmya+=`<span class="badge badge-info">Mya-Wady Point</span></span>`;
        htmlmya_select +=`
        <select name="mya_status" id="myaw_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="mya_change(this.value)">
                <option value="0">Not Start</option>
                <option value="1" selected>On the way</option>
                <option value="2">Arrived</option>
                </select>
        `;
        $('#on_mya').html(htmlmya);
        $('#show_mya_status').html(htmlmya_select);
        $('#reremark').attr('disabled',false);

    }
    else if(value==0)
    {

        htmlmya+=`<span class="badge badge-secondary">Mya-Wady Point</span></span>`;
        htmlmya_select +=`
        <select name="mya_status" id="myaw_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" disabled>
                <option value="0" selected>Not Start</option>
                <option value="1">On the way</option>
                <option value="2">Arrived</option>
                </select>
        `;
        $('#on_mya').html(htmlmya);
        $('#show_mya_status').html(htmlmya_select);
        $('#reremark').attr('disabled',true);

    }
}
function mya_change(value)
{
    // alert(value);
    var htmldrop_select ="";
    if(value == 2)
    {
        htmldrop_select +=`
        <select name="dropoff_statuss" id="dropoff_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="cust_change(this.value)">

                <option value="0">Not Start</option>
                <option value="1" selected>On the way</option>
                <option value="2">Arrived</option>
                </select>
        `;
        $('#on_drop_yes').show();
        $('#on_drop_no').hide();
        $('#show_dropoff_status').html(htmldrop_select);
        $('#myaremark').attr('disabled',false);
    }
    else
    {

        htmldrop_select +=`
        <select name="dropoff_statuss" id="dropoff_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" disabled>

                <option value="0" selected>Not Start</option>
                <option value="1">On the way</option>
                <option value="2">Arrived</option>
                </select>
        `;
        $('#on_drop_yes').hide();
        $('#on_drop_no').show();
        $('#show_dropoff_status').html(htmldrop_select);
        $('#myaremark').attr('disabled',true);
    }
}
function cust_change(value)
{
    var htmlcust = "";
    var htmlcust_select = "";
    // alert(value);
    if(value == 2)
    {

        htmlcust+=`<span class="badge badge-info">Customer Point</span></span>`;
        htmlcust_select +=`
        <select name="cust_statuss" id="cust_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="cust_status(this.value)">

               <option value="0">Not Start</option>
               <option value="1" selected>On the way</option>
               <option value="2">Arrived</option>
               </select>
        `;
        $('#on_cust').html(htmlcust);
        $('#show_cust_status').html(htmlcust_select);
        $('#dropremark').attr('disabled',false);
    }
    else
    {

        htmlcust+=`<span class="badge badge-secondary">Customer Point</span></span>`;
        htmlcust_select +=`
        <select name="cust_statuss" id="cust_status" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 10px;margin: 20px 0;width:300px;font-size:13px;" class="border border-outline border-primary" onchange="cust_status(this.value)" disabled>

                <option value="0" selected>Not Start</option>
                <option value="1">On the way</option>
                <option value="2">Arrived</option>
                </select>
        `;
        $('#on_cust').html(htmlcust);
        $('#show_cust_status').html(htmlcust_select);
        $('#dropremark').attr('disabled',true);
    }
}
function cust_status(value)
{
    if(value == 2)
    {
        $('#custremark').attr('disabled',false);
    }
    else if(value == 1)
    {
        $('#custremark').attr('disabled',true);
    }
}
function re_remark()
{
    var htmlre = "";
    htmlre +=`
    <div class="row mb-2">
        <div class="col-md-5 mr-2">
            <h5 style="color:rgb(34, 190, 241);margin-top:20px;" class="pl-4 ml-3 pt-2">Remark</h5>
        </div>
        <div class="col-md-6">
        <textarea name="remark" id="" cols="50" rows="3" class="border border-outline border-primary" style="border-radius: 7px;"></textarea>
        </div>
    </div>
    `;
    $('#receive_remark').html(htmlre);
}
function mya_remark()
{
    var htmlre = "";
    htmlre +=`
    <div class="row mb-2">
        <div class="col-md-5 mr-2">
            <h5 style="color:rgb(34, 190, 241);margin-top:20px;" class="pl-4 ml-3 pt-2">Remark</h5>
        </div>
        <div class="col-md-6">
        <textarea name="remark" id="" cols="50" rows="3" class="border border-outline border-primary" style="border-radius: 7px;"></textarea>
        </div>
    </div>
    `;
    $('#myawady_remark').html(htmlre);
}
// $("#dbutton").click(function(){
//   $("#dropoff_area").toggle();
// });
function drop_remark()
{
    
    if($('#dropoff_area').css('display') == 'none')
    {
        // alert("none");
        $("#dropoff_area").removeClass('d-none');
    }
    else
    {
        // alert("not");
        
        $( "#dropoff_area" ).addClass( 'd-none' );
    }

    
}
function cust_remark()
{
    if($('#customer_remark').css('display') == 'none')
    {
        // alert("none");
        $("#customer_remark").removeClass('d-none');
    }
    else
    {
        // alert("not");
        
        $( "#customer_remark" ).addClass( 'd-none' );
    }
}
var count = 0;
function count_change()
{
    count +=1;
}
function test()
{
    alert(count);
    if($('#myaw_status').val() == 2)
    {
        if($('#mya_date').val() == "")
        {
            swal({
                    title: "Error Message",
                    text: "MyaWady Date is Required!!!",
                    icon: "error",

                });
        }
        else
        {
            var mdate = 1;
        }
    }
    if($('#cust_status').val() == 2)
    {
        if(count != 1)
        {
            swal({
                    title: "Error Message",
                    text: "Customer Date is Required!!!",
                    icon: "error",

                });
        }
        else
        {
            var cdate = 1;
        }
    }
    // alert($('#receive_date').val());
    if($('#myaw_status').val() == 2 && $('#cust_status').val() != 2)
    {
        if(mdate == 1)
        {
            $('#receiveh_date').val($('#receive_date').val());
            $('#receiveh_status').val($('#receive_status').val());
            $('#myah_date').val($('#mya_date').val());
            $('#myah_status').val($('#myaw_status').val());
            $('#custh_date').val($('#cust_date').val());
            $('#custh_status').val($('#cust_status').val());
            $('#dropoffh_date').val($('#dropoff_date').val());
            $('#dropoffh_status').val($('#dropoff_status').val());
            $('#dremark').val($('#dropremark').val());
            $('#cremark').val($('#custremark').val());
            $('#storeform').submit();
        }
    }
    else if($('#myaw_status').val() == 2 && $('#cust_status').val() == 2)
    {
        if(mdate == 1 && cdate == 1)
        {
            $('#receiveh_date').val($('#receive_date').val());
            $('#receiveh_status').val($('#receive_status').val());
            $('#myah_date').val($('#mya_date').val());
            $('#myah_status').val($('#myaw_status').val());
            $('#custh_date').val($('#cust_date').val());
            $('#custh_status').val($('#cust_status').val());
            $('#dropoffh_date').val($('#dropoff_date').val());
            $('#dropoffh_status').val($('#dropoff_status').val());
            $('#dremark').val($('#dropremark').val());
            $('#cremark').val($('#custremark').val());
            $('#storeform').submit();
        }
    }
    else
    {
        $('#receiveh_date').val($('#receive_date').val());
            $('#receiveh_status').val($('#receive_status').val());
            $('#myah_date').val($('#mya_date').val());
            $('#myah_status').val($('#myaw_status').val());
            $('#custh_date').val($('#cust_date').val());
            $('#custh_status').val($('#cust_status').val());
            $('#dropoffh_date').val($('#dropoff_date').val());
            $('#dropoffh_status').val($('#dropoff_status').val());
            $('#dremark').val($('#dropremark').val());
            $('#cremark').val($('#custremark').val());
            $('#storeform').submit();
    }

}

</script>
@endsection
