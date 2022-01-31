@extends('master')
@section('title', 'Reject Way Plan')
@section('content')

<div class="container">
    <h4 class="font-weight-bold text-info">Reject Way List</h4>
    <table class="table table-striped mt-3">
        <thead class="bg-info text-white">
          <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Location</th>
            <th>Reject Date</th>
            <th>Pak Qty</th>
            <th>Contact Number</th>
            <th>Total Charges</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($reject_way as $reject)
            <tr>
                <td>{{$i++}}.</td>
                <td><i class="far fa-user mr-2" style="size:7px"></i>{{$reject->customer_name}}</td>
                @if($reject->way_status == 0)
                <td><span class="badge badge-light border border-danger mt-1 text-danger">Pending</span></td>
                @else
                <td><span class="badge badge-light border border-success mt-1 text-success">Done</span></td>
                @endif



                @if($reject->receive_status == 0)
                @foreach($location as $locat)
                @if($locat->id == $reject->receive_point)
                <td>{{$locat->name}}</td>
                @endif
                @endforeach
                @elseif($reject->receive_status == 1 && $reject->myawady_status != 2 && $reject->way_status != 1)
                @foreach($location as $locat)
                @if($locat->id == $reject->receive_point)
                <td>{{$locat->name}}</td>
                @endif
                @endforeach
                @elseif($reject->myawady_status == 2 && $reject->dropoff_status != 2 && $reject->way_status != 1)
                <td>MyaWady</td>
                @elseif($reject->dropoff_status == 2 && $reject->customer_status != 2 && $reject->way_status != 1)
                @foreach($location as $locat)
                @if($locat->id == $reject->dropoff_point)
                <td>{{$locat->name}}</td>
                @endif
                @endforeach
                @elseif($reject->way_status == 1 || $reject->customer_status == 2)
                <td>{{$reject->customer_address}}</td>
                @endif

                <td>{{$reject->reject_date}}</td>
                <td>&nbsp;&nbsp;&nbsp;{{$reject->parcel_quantity}}</td>
                <td>{{$reject->customer_phone}}</td>
                <td>{{$reject->total_charges}}</td>
                <td><a href="" class="btn btn-sm btn-danger">Delete Way</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
