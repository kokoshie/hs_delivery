@extends('master')
@section('title', 'Dashboard')
@section('content')

<h4 class="text-center" style="color:rgb(34, 190, 241)">Charges Register</h4>

<div class="card mr-5">
    <div class="card-body">
    <div class="container mt-2">
        <form action="{{route('store_package')}}" method="POST">
            @csrf

            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Package Name</h5>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="name" class="border border-outline border-primary" style="border-radius: 7px;">
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
            <div class="row" id="new_info">
            <input type="hidden" id="check1" value="1">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Min</h5>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="min[]" id="min1" class="border border-outline border-primary" style="border-radius: 7px;" onfocusout="check_min(1)">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Max</h5>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="max[]" id="max1" class="border border-outline border-primary" style="border-radius: 7px;" onfocusout="check_max(1)">
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
                <select name="currency[]"  id="wgtmsr" style="border-radius: 7px;color:rgb(41, 87, 236)" class="border border-outline border-primary">

                        <option value="1" selected>MMK</option>
                        <option value="2">BAHT</option>
                        <option value="3">USD</option>
                    </select>
                </div>

            </div>
            <!-- <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right">Range: Min</h5>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="min" class="border border-outline border-primary" style="border-radius: 7px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">
                            <h5 style="color:rgb(34, 190, 241)" class="p-4 float-right"> Max</h5>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                            <div class="col-md-10">
                            <input type="text" name="max" class="border border-outline border-primary" style="border-radius: 7px;">
                            </div>
                            <div class="col-md-2 mt-3">
                            <button class="btn btn-warning"><i class="whitecolor fas fa-plus" style="border-radius: 7px;"></i></button>
                            </div>
                         </div>
                        </div>
                        {{-- <div class="col-md-1 mt-3">

                        </div> --}}
                    </div>
                    {{-- <div class="col-md-2">
                        <i class="fas fa-plus mr-2" style="border-radius: 7px;"></i>
                    </div> --}}
                </div>

            </div> -->

            <div class="row offset-5 mt-3">
                 <button type="submit" class="btn btn-lg btn-primary">Yes</button></a>
                 <button class="btn btn-lg btn-danger ml-3">No</button>
            </div>
        </form>
@endsection
@section('js')
<script>

    var count = 1;
    function add_new()
    {
        // alert("ok");
        count +=1;
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
                <select name="currency[]"  id="wgtmsr" style="border-radius: 7px;color:rgb(41, 87, 236)" class="border border-outline border-primary">
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
       var pre = count -1;
        var count = $('#check'+count).val();
        var min = $('#min'+count).val();

        var premax = $('#max'+pre).val();
        var max  = $('#min'+max).val();
        // alert(max+"-=-="+min);
        // alert(min);
        // if(min == "")
        // {
        //     alert("djfdkjfdkjd");
        // }
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
            // alert("hello");
            swal({
                    title: "Error Message",
                    text: "Min Rage is not less than Previous Max Range ="+premax,
                    icon: "error",

                });
                $('#max'+count).val("");
        }

        // alert(min);
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
