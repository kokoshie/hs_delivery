@extends('master')
@section('title', 'Dashboard')
@section('content')

<select class="" aria-label=".form-select-lg example" id="way" onchange="way_schedule(this.value)">
    <option value="1" selected>Way Plan Schedule</option>
    <option value="2">Way Plan Assign</option>

</select>
<div class="card mr-5"  id="schedule">
<div class="card-body">
<div class="container mt-2">
    <form action="{{route('store_wayplan')}}" method="POST">
        @csrf
        <input type="hidden" name="wayid" value="" id="wayplanID">
        <input type="hidden" id="packageID" name="packageID">
        <input type="hidden" id="perKg" name="perKg">
        <input type="hidden" id="chargess" name="chargess">
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="row">
               <div class="col-md-5">
                  <h5 style="color:rgb(34, 190, 241)" class="p-4">Customer Name</h5>
               </div>
               <div class="col-md-6">
                   <input type="text" name="customer_name" class="border border-outline border-primary" style="border-radius: 7px;">
               </div>
                </div>
            </div>
            <div class="col-md-6">
               <div class="row">
                <div class="col-md-5">
                    <h5 style="color:rgb(34, 190, 241)" class="p-4 ml-5">Token</h5>
                 </div>
                 <div class="col-md-6">
                     <div class="row">
                         <div class="col-md-9">
                     <input type="text" id="token" name="token" class="border border-outline border-primary" style="border-radius: 7px;" readonly>
                         </div>
                         <div class="col-md-3 mt-2">
                     <button type="button" class="btn btn-outline-warning" onclick="generate_token()">Generate</button>
                         </div>
                     </div>
                 </div>
               </div>
           </div>
       </div>

       <div class="row">
        <div class="col-md-6">
            <div class="row">
           <div class="col-md-5">
              <h5 style="color:rgb(34, 190, 241)" class="p-4">Customer Phone</h5>
           </div>
           <div class="col-md-6">
               <input type="text" name="customer_phone" class="border border-outline border-primary" style="border-radius: 7px;">
           </div>
            </div>
            <div class="row mt-3">
            <div class="col-md-5">
                <h5 style="color:rgb(34, 190, 241)" class="p-4 mt-2 ml-5">Customer Address</h5>
             </div>
             <div class="col-md-6">
                 {{-- <input type="text" class="border border-outline border-primary" style="border-radius: 7px;"> --}}
                 <textarea name="cust_addr" id="" cols="40" rows="5" class="border border-outline border-primary" style="border-radius: 7px;"></textarea>
             </div>
           </div>
        </div>
        <div class="col-md-6">
           <div class="row mt-2">
            <div class="col-md-5">
                <h5 style="color:rgb(34, 190, 241)" class="p-4 mt-2 ml-5">Remark</h5>
             </div>
             <div class="col-md-6">
                 {{-- <input type="text" class="border border-outline border-primary" style="border-radius: 7px;"> --}}
                 <textarea name="remark" id="" cols="40" rows="5" class="border border-outline border-primary" style="border-radius: 7px;"></textarea>
             </div>
           </div>
           <div class="row mt-4">
            <div class="col-md-5">
               <h5 style="color:rgb(34, 190, 241)" class="p-4">Tracking Id</h5>
            </div>
            <div class="col-md-6">
                <input type="text" name="tracking_id" class="border border-outline border-primary" style="border-radius: 7px;">
            </div>
             </div>
       </div>
   </div>

   <div class="row mt-4">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
                <h5 style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-4">Receive Point</h5>
            </div>
            <div class="col-md-6">
                <select name="receive_point" id="receive_point" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;" class="border border-outline border-primary">
                <option selected hidden>Choose Location</option>
                @foreach($location as $locat)
                    <option value="{{$locat->id}}">{{$locat->name}}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6">
       <div class="row">
        <div class="col-md-5">
            <h5 style="color:rgb(34, 190, 241)" class="p-4 ">Enter Quantity</h5>
         </div>
         <div class="col-md-6">
             <input type="text" name="qty" class="border border-outline border-primary" style="border-radius: 7px;">
         </div>
       </div>
   </div>
 </div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
               <h5 style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2">Receive Date</h5>
            </div>
            <div class="col-md-6">
            <input type="date" name="receive_date" class="border border-outline border-primary pl-5 pr-5 pt-2 pb-2" style="border-radius: 7px;">
            </div>
        </div>
    </div>
     
    <div class="col-md-6">
        <div class="row">
       
            <div class="col-md-5" >
                
               <h5 style="color:rgb(34, 190, 241)" class="p-4">Specific Weight</h5>
            </div>
            
            <div class="col-md-4">
                
                <input type="text" name="weight" id="weight" class="border border-outline border-primary" style="border-radius: 7px;" onchange="calculate_kg()">
            </div>
            <div class="col-md-3">
             <select name="wg_type" id="wgtmsr1" style="border-radius: 7px;color:rgb(34, 190, 241);" class="border border-primary">
                 <option  selected>KG</option>
                 <option value="kg">1</option>
                 <option value="gm">2</option>
                 <option value="pound">3</option>
             </select>
            </div>
             </div>
   </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
               <h5 style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-4">Dropoff Point</h5>
            </div>
            <div class="col-md-6">
                <select name="drop_point" id="drop_point" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;" class="border border-outline border-primary">
                <option selected hidden>Choose Location</option>
                    @foreach($location as $locat)
                        <option value="{{$locat->id}}">{{$locat->name}}</option>
                    @endforeach
                    </select>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6">
       <div class="row">
        <div class="col-md-5" style="margin-top:20px">
            <h5 style="color:rgb(34, 190, 241)" class="p-4 ml-5">Charges</h5>
         </div>
         <div class="col-md-6">
         <label class="font-weight-bold">Charges Of <span class="text-danger ml-2 mr-2">1</span>KG = <span id="per_kg" class="ml-2">0</span></label>
             <input type="text" id="result_charge" name="charge" class="border border-outline border-primary" style="border-radius: 7px;">
         </div>
       </div>
   </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
               <h5 style="color:rgb(34, 190, 241)" class="pl-4 ml-3 pt-2">Dropoff Date</h5>
            </div>
            <div class="col-md-6">
            <input type="date" name="drop_date" class="border border-outline border-primary pl-5 pr-5 pt-2 pb-2" style="border-radius: 7px;">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
               <h5 style="color:rgb(34, 190, 241)" class="p-4">Enter Est Charges</h5>
            </div>
            <div class="col-md-6">
                <input type="text" name="est_charge" class="border border-outline border-primary" style="border-radius: 7px;">
            </div>
             </div>
   </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        
    </div>
</div>

<div class="row mt-4">

</div>

<div class="row mt-5">
    <button type="submit"  class="btn btn-m offset-5" style="background-color:rgb(34, 190, 241);color:#fff;border-radius: 7px;"><span class="m-2">Submit</span></button>
</div>
</form>

</div>
</div>
</div>

<div class="card mr-5" id="assign">
<div class="card-body">
<div class="container mt-2" >
    <form action="" method="POST">
        @csrf
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="row">
               <div class="col-md-5">
                  <h5 style="color:rgb(34, 190, 241)" class="p-4">Customer Name</h5>
               </div>
               <div class="col-md-6">
                   <input type="text" class="border border-outline border-primary" style="border-radius: 7px;">
               </div>
                </div>
            </div>
            <div class="col-md-6">
               <div class="row">
                <div class="col-md-5">
                    <h5 style="color:rgb(34, 190, 241)" class="p-4">Contact Name @ Pickup</h5>
                 </div>
                 <div class="col-md-6">
                     <input type="text" class="border border-outline border-primary" style="border-radius: 7px;">
                 </div>
               </div>
           </div>
       </div>
       <div class="row">
        <div class="col-md-6">
            <div class="row">
           <div class="col-md-5">
              <h5 style="color:rgb(34, 190, 241)" class="p-4">Customer Phone</h5>
           </div>
           <div class="col-md-6">
               <input type="text" class="border border-outline border-primary" style="border-radius: 7px;">
           </div>
            </div>
        </div>
        <div class="col-md-6">
           <div class="row">
            <div class="col-md-5">
                <h5 style="color:rgb(34, 190, 241)" class="p-4">Contact Phone @ Pickup</h5>
             </div>
             <div class="col-md-6">
                 <input type="text" class="border border-outline border-primary" style="border-radius: 7px;">
             </div>
           </div>
        </div>
   </div>
   <div class="row">
    <div class="col-md-6">
        <div class="row">
       <div class="col-md-5">
          <h5 style="color:rgb(34, 190, 241)" class="p-4">Pickup Address</h5>
       </div>
       <div class="col-md-6">
           <input type="text" class="border border-outline border-primary" style="border-radius: 7px;">
       </div>
        </div>
    </div>
    <div class="col-md-6">
       <div class="row">
        <div class="col-md-5">
            <h5 style="color:rgb(34, 190, 241)" class="p-4">Distanation Address</h5>
         </div>
         <div class="col-md-6">
             <input type="text" class="border border-outline border-primary" style="border-radius: 7px;">
         </div>
       </div>
    </div>
</div>

<div class="row">
     <div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
               {{-- <h5 style="color:rgb(34, 190, 241)" class="p-4">Dropoff Address</h5> --}}
            </div>
            <div class="col-md-6">
                <select name="wgtmsr" id="wgtmsr" style="border-radius: 7px;color:rgb(41, 87, 236)" class="border border-outline border-primary">
                    <option  selected>Township</option>
                    <option value="kg">1</option>
                    <option value="gm">2</option>
                    <option value="pound">3</option>
                </select>
            </div>
             </div>
     </div>
     <div class="col-md-6">
        <div class="row">
            <div class="col-md-5">
               {{-- <h5 style="color:rgb(34, 190, 241)" class="p-4">Dropoff Address</h5> --}}
            </div>
            <div class="col-md-6">
                <select name="wgtmsr" id="wgtmsr" style="border-radius: 7px;color:rgb(41, 87, 236)" class="border border-outline border-primary">
                    <option  selected>Township</option>
                    <option value="kg">1</option>
                    <option value="gm">2</option>
                    <option value="pound">3</option>
                </select>
            </div>
             </div>
     </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5">
                    <h5 style="color:rgb(34, 190, 241)" class="p-4 ml-4 mt-2">Remark</h5>
                 </div>
                 <div class="col-md-6">
                    {{-- <input type="text" class="border border-outline border-primary" style="border-radius: 7px;"> --}}
                    <textarea name="remark1" id="" cols="28" rows="5" class="border border-outline border-primary" style="border-radius: 7px;"></textarea>
                </div>
             </div>
         </div>


   </div>
</div>

</form>

</div>
</div>
</div>

@endsection

@section('js')
<script type="text/javascript">

    $( document ).ready(function() {
        $('#assign').hide();
    });

 function way_schedule(val){
    if(val == 1){
        $('#assign').hide();
        $('#schedule').show();
    }
    else if(val == 2){
        $('#assign').show();
        $('#schedule').hide();
    }
 }
function calculate_kg()
{
    var rp = $('#receive_point :selected').val();
    var dp = $('#drop_point :selected').val();
   var weight = $('#weight').val();
    $.ajax({
           type:'POST',
           url:'/find_point',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "receive_point":rp,
                "drop_point":dp,
                "weight":weight,
            },

           success:function(data){
               var htmlkg = "";
               if(data == 1)
               {
                    swal({
                    title: "Error Message",
                    text: "This KG Weight is not found in Server!!!",
                    icon: "error",
                    
                });
                $('#result_charge').val("");
                htmlkg += `
                    <label>0</label>
                    `;
                    $('#per_kg').html(htmlkg);
                    $('#weight').val("");
               }
               else
               {
                    var result = weight * data.per_kg_price;

                    htmlkg += `
                    <label>${data.per_kg_price}${data.currency}</label>
                    `;
                    $('#per_kg').html(htmlkg);
                    $('#result_charge').val(result+data.currency);
                    $('#packageID').val(data.package_id);
                    $('#perKg').val(data.per_kg_price);
                    $('#chargess').val(result);
               }
               
           }
        });
}
var gen = 0;
function generate_token()
{

    var wayid = $('#wayplanID').val();
    $.ajax({
           type:'POST',
           url:'/generate_Token',
           dataType:'json',
           data:{
                "_token": "{{ csrf_token() }}",
                "wayplan_id" : wayid,
               
            },

           success:function(data){
                $('#token').val(data.token);
                $('#wayplanID').val(data.wayplan_id);
           }
    });
}
    </script>
@endsection

