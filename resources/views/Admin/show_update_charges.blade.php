@extends('master')
@section('title', 'Dashboard')
@section('content')

<h4 class="text-center" style="color:rgb(34, 190, 241)">update Charges Information</h4>

<div class="card mr-5">
    <div class="card-body">
    <div class="container mt-2">
        <form action="{{route('store_update_charges')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$package->id}}" name="package_id">
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Package Name</h5>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="name" class="border border-outline border-primary" style="border-radius: 7px;" value="{{$package->package_name}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">From City</h5>
                        </div>
                        <div class="col-md-7">
                        <select name="from_city"  id="wgtmsr" style="border-radius: 7px;color:rgb(41, 87, 236)" class="border border-outline border-primary from">
                         @foreach ($location as $loc)
                            <option value="{{$loc->id}}" >{{$loc->name}}</option>
                         @endforeach
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">To City</h5>
                        </div>
                        <div class="col-md-7">
                        <select name="to_city"  id="wgtmsr" style="border-radius: 7px;color:rgb(41, 87, 236)" class="border border-outline border-primary to">
                         @foreach ($location as $loc)
                            <option value="{{$loc->id}}">{{$loc->name}}</option>
                         @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                   
                </div>
                <div class="col-md-2 float-left">
                   
                </div>
            </div>
            <div class="row offset-md-5">
                <div class="col-md-6">
                    <h4><span class="font-weight-bold">Range:</span><span style="margin-left:30px"><button type="button" class="btn btn-warning"  onclick="add_new()"><i class="fas fa-plus"></i></button></span></h4>
                </div>
            </div>
            <!-- Begin Range -->
            <div class="row" id="new_info">
                @foreach($charges as $char)
            <input type="hidden" id="check{{$char->id}}" value="{{$char->id}}">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Min</h5>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="charges_id[]" value="{{$char->id}}">
                                    <input type="text" name="min[]" id="min{{$char->id}}" class="border border-outline border-primary" style="border-radius: 7px;" onfocusout="check_min('{{$char->id}}')" value="{{$char->min_kg}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Max</h5>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="max[]" id="max{{$char->id}}" class="border border-outline border-primary" style="border-radius: 7px;" onfocusout="check_max('{{$char->id}}')" value="{{$char->max_kg}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                <div class="row">
                        <div class="col-md-6">
                            <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Per KG Charges</h5>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="per_kg_charges[]" class="border border-outline border-primary" style="border-radius: 7px;" value="{{$char->per_kg_price}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                <select  name="currency[]"  id="curr{{$char->id}}" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;" class="border border-outline border-primary">
                @if($char->currency == "MMK")
                        <option value="1" selected>MMK</option>
                        <option value="2">BAHT</option>
                        <option value="3">USD</option>
                @elseif($char->currency == "BAHT")
                        <option value="1">MMK</option>
                        <option value="2" selected>BAHT</option>
                        <option value="3">USD</option>
                @elseif($char->currency == "USD")  
                        <option value="1">MMK</option>    
                        <option value="2">BAHT</option> 
                        <option value="3" selected>USD</option>
                @endif
                    </select>
                </div>
                <!-- <div class="col-md-1">
                    <button type="button" class="btn btn-warning" style="margin-top:20px" onclick="add_new()"><i class="fas fa-plus"></i></button>
                </div> -->
                @endforeach
            </div>
            <!-- End Range -->
            <div class="row offset-5 mt-3">
                 <button type="submit" class="btn btn-lg btn-primary">Yes</button></a>
                 <button class="btn btn-lg btn-danger ml-3">No</button>
            </div>
        </form>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        var charges = @json($charges);
        var package = @json($package);
        if(package.from_city_id == 1)
        {
            // alert("1");
            $('.from option[value=1]').attr('selected','selected');
        }
        else if(package.from_city_id == 2)
        {
            // alert('2');
            $('.from option[value=2]').attr('selected','selected');
        }
        else if(package.from_city_id == 3)
        {
            $('.from option[value=3]').attr('selected','selected');
        }
        else if(package.from_city_id == 4)
        {
            $('.from option[value=4]').attr('selected','selected');
        }

        if(package.to_city_id == 1)
        {
            // alert("1");
            $('.to option[value=1]').attr('selected','selected');
        }
        else if(package.to_city_id == 2)
        {
            // alert('2');
            $('.to option[value=2]').attr('selected','selected');
        }
        else if(package.to_city_id == 3)
        {
            $('.to option[value=3]').attr('selected','selected');
        }
        else if(package.to_city_id == 4)
        {
            $('.to option[value=4]').attr('selected','selected');
        }   
        $.each(charges,function(i,v){
           
        })
        
    });
    var ccheck = 1;
    var count = 1;
    function add_new()
    {
        // alert("ok");
        var charges = @json($charges);
        var last_count = @json($last_count);
        ccheck +=1;
        if(ccheck == 2)
        {
            // alert("new");
            count += last_count;
        }
        else
        {
            // alert("new new");
            count +=1 ;
        }
        var htmlnew = "";
        htmlnew +=`
        <input type="hidden" id="check${count}" value="${count}">
        <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Min</h5>
                                </div>
                                <div class="col-md-6">
                                <input type="hidden" name="charges_id[]" value="${count}">
                                    <input type="text" name="min[]" id="min${count}" class="border border-outline border-primary" style="border-radius: 7px;" onfocusout="check_min('${count}')">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Max</h5>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="max[]" id="max${count}" class="border border-outline border-primary" style="border-radius: 7px;" onfocusout="check_max('${count}')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                <div class="row">
                        <div class="col-md-6">
                            <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Per KG Charges</h5>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="per_kg_charges[]" class="border border-outline border-primary" style="border-radius: 7px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                <select name="currency[]"  id="" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;" class="border border-outline border-primary">
                        <option value="1" selected>MMK</option>
                        <option value="2">BAHT</option>
                        <option value="3">USD</option>
                    </select>
                </div>
                
        `;
        $('#new_info').append(htmlnew);
    }
    function check_min(count)
    {
       var charges = @json($charges);

       var pre = count -1;
        var count = $('#check'+count).val();
        var min = $('#min'+count).val();
        
        var premax = $('#max'+pre).val();
        var max  = $('#min'+max).val();
        // alert(max+"-=-="+min);
        if(premax > min && min != "")
        {
            swal({
                    title: "Error Message",
                    text: "Min Rage is not less than Previous Max Range ="+premax,
                    icon: "error",
                    
                });
                $('#min'+count).val("");
        }
        else if(max < min)
        {
            
            swal({
                    title: "Error Message",
                    text: "Min Rage is not less than Previous Max Range ="+premax,
                    icon: "error",
                    
                });
                $('#max'+count).val("");
        }
    }
    function check_max(count)
    {
        // alert("hello");
        var count = $('#check'+count).val();
        var max = $('#max'+count).val();
        var min = $('#min'+count).val();
        // alert(max+"---"+min);
        // if(min > max)
        // {
        //     // alert(max+"---"+min);
        //     swal({
        //             title: "Error Message",
        //             text: "Min Rage is not less than Previous Max Range ="+max,
        //             icon: "error",
                    
        //         });
        //         $('#max'+count).val("");
        // }
        // alert(max);`
    }
</script>
@endsection
