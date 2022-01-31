@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 style="color:rgb(34, 190, 241)">Employee List</h3>
    </div>

    <div class="col-md-7 col-4 align-self-center">

        <div class="d-flex m-t-8 justify-content-end">
             <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#create_item">
                <i class="fas fa-plus"></i>
                Add Employee
            </a>
        </div>

        <div class="modal fade" id="create_item" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Employee Create Form</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="{{route('store_employee')}}" enctype='multipart/form-data'>
                            @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="form-group">
                                            <label class="control-label">Employee Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" style="margin-top:9px" name="email" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" style="margin-top:9px"  name="password" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Employee Phone</label>
                                            <input type="text" name="phone" class="form-control" required>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Employee Role</label>
                                            <select class="form-control select2" style="margin-top:9px" name="role" style="width: 100%" >
                                                <option value="">Select</option>

                                                @foreach ($roles as $rol)
                                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>


                                </div>


                                    <div class="row">
                                        <div class=" col-md-9">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<table class="table table-striped mt-4">
    <thead>
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Phone Number</th>
    <th class="text-center">Action</th>
    </thead>
    <tbody>
        <?php
         $i=1;
        ?>
        @foreach ($users as $user)
            @foreach ($user->roles as $ruse )
            <tr>
                <td>{{$i++}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$ruse->name}}</td>
                <td>{{$user->phone}}</td>
                <td class="text-center">
                    <a href="{{route('update_employee',$user->id)}}" class="btn btn-sm btn-warning">Update</a>
                    <a href="{{route('delete_employee',$user->id)}}" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>


@endsection
