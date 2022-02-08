@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class='container' width="80%">
    <div class="row mb-3">
        <div class="col-md-6">
            <h4 class="text-info">Charges Lists</h4>
        </div>
        <div class="col-md-6">
            <a href="{{route('charges')}}" class="btn bg-primary text-white float-right"><i class="fas fa-plus mr-2" style="border-radius: 7px;"></i>Add New Charges</a>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <table class="table table-striped text-black">
                <thead class="bg-info text-white">
                  <tr style="font-size: 13px">
                    <th>#</th>
                    <th>Package Name</th>
                    <th>From City</th>
                    <th>To City</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php $i=1; ?>
                @foreach($charges_list as $list)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$list->package_name}}</td>
                    <td>{{$list->from_city_name}}</td>
                    <td>{{$list->to_city_name}}</td>
                    <td class="text-center"><a href="{{route('show_update_charges',$list->id)}}" class="btn btn-warning"><i class="far fa-edit mr-2"></i>Update</a></td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>


@endsection
