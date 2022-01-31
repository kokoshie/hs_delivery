@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="row">
<select class="border border-primary" aria-label=".form-select-lg example" id="rout" onchange="routes(this.value)">

    <option selected>Routes</option>
    <option value="1">BKK-YGN Route</option>
    <option value="2">BKK-MDY Route</option>
    <option value="3">MAESOT-YGN Route</option>
    <option value="4">MAESOT-MDY Route</option>

</select>
<div class="col-md-3">
<div class="input-group rounded mt-2 py-2" id="search">
    <input type="search" class="form-control rounded border border-primary" placeholder="Search Here" aria-label="Search" aria-describedby="search-addon" />
    <span class="input-group-text" id="search-addon" style="background-color: rgb(55, 128, 238)">
      <i class=" fas fa-search" style="color:#fff"></i>
    </span>
</div>
</div>
</div>

<div id="rou" class="mt-4"></div>

<div class="container mt-5">

    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>Customer</th>
          <th>Status</th>
          <th>Type</th>
          <th>Package Quantity</th>
          <th>Contact Number</th>
          <th>Total Charges</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="checkbox" id="horns" name="customer" class="mt-2"> </td>
          <td><i class="far fa-user mr-2" style="size:7px"></i>Ko Hla Htun</td>
          <td><span class="badge badge-light border border-success mt-1 text-success">Done</span></td>
          <td>Customer</td>
          <td  class="text-center"><span class="badge badge-light border border-gray px-2 mt-1">2</span></td>
          <td>09773152864</td>
          <td>2000 MMK</td>
          <td><a href="" class="btn btn-sm"></a><i class="fas fa-ellipsis-h"></i></a></td>
        </tr>
        <tr>
          <td><input type="checkbox" id="horns" name="customer" class="mt-2"></td>
          <td><i class="far fa-user mr-2" style="size:7px"></i>Ko Hla Mg</td>
          <td><span class="badge badge-light border border-warning mt-1 text-warning">Pending</span></td>
          <td>Customer</td>
          <td  class="text-center"><span class="badge badge-light border border-gray px-2 mt-1">1</span></td>
          <td>09781563425</td>
          <td>3000 MMK</td>
          <td><a href="" class="btn btn-sm"></a><i class="fas fa-ellipsis-h"></i></a></td>
        </tr>
        <tr>
          <td><input type="checkbox" id="horns" name="customer" class="mt-2"></td>
          <td><i class="far fa-user mr-2" style="size:7px"></i>U Tin Mg</td>
          <td><span class="badge badge-light border border-danger mt-1 text-danger">Reject</span></td>
          <td>Customer</td>
          <td  class="text-center"><span class="badge badge-light border border-gray px-2 mt-1">3</span></td>
          <td>09774568531</td>
          <td>5000 MMK</td>
          <td><a href="" class="btn btn-sm"></a><i class="fas fa-ellipsis-h"></i></a></td>
        </tr>
        <tr>
            <td><input type="checkbox" id="horns" name="customer" class="mt-2"></td>
            <td><i class="far fa-user mr-2" style="size:7px"></i>Ma Hla Hla Htun</td>
            <td><span class="badge badge-light border border-success mt-1 text-success">Done</span></td>
            <td>Customer</td>
            <td  class="text-center"><span class="badge badge-light border border-gray px-2 mt-1">5</span></td>
            <td>09798568531</td>
            <td>5000 MMK</td>
            <td><a href="" class="btn btn-sm"></a><i class="fas fa-ellipsis-h"></i></a></td>
          </tr>
      </tbody>
    </table>
  </div>

@endsection

@section('js')

<script>
function routes(val){
    // alert(val);
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

}
</script>

@endsection
