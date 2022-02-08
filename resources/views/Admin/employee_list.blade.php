@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 style="color:rgb(34, 190, 241)">Employee List</h3>
    </div>

    <div class="col-md-7 col-4 align-self-center">

        <div class="d-flex m-t-8 justify-content-end">
             <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#create_item" onclick="manager()">
                <i class="fas fa-plus"></i>
                Add Employee
            </a>
        </div>

        <div class="modal fade" id="create_employee" role="dialog" aria-hidden="true" class="hhh">
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
                                        <div class="form-group" id="select_role">
                                            {{-- <label class="control-label">Employee Role</label>
                                            <input type="text" name="" id="opt" value="{{$ro_us}}">
                                            <input type="text" name="" id="mng" value="{{$ro_us4}}">
                                            <select class="form-control select2" style="margin-top:9px" name="role" style="width: 100%" onchange="manager()">
                                                <option value="">Select</option>
                                                <option value="4" class="manage">Manager</option>
                                                <option value="5" class="operate">Operator</option> --}}
                                                {{-- @foreach ($roles as $rol)
                                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                                                @endforeach --}}


                                            {{-- </select> --}}
                                        </div>
                                    </div>
                                    <input type="hidden" name="" id="opt" value="{{$ro_us}}">
                                     <input type="hidden" name="" id="mng" value="{{$ro_us4}}">
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

@section('js')
<script>
function manager(){
  var mng = $('#mng').val();
  var opt = $('#opt').val();
//   alert(mng);
//   alert(opt);
var htmlmo = "";
if(mng == 2 && opt == 3){
    $("#create_employee").modal('hide');
htmlmo += `
         <label class="control-label">Employee Role</label>
                 <select class="form-control select2" style="margin-top:9px" name="role" style="width: 100%">
                    <option value="">Select</option>
                    <option value="4" class="manage" disabled>Manager</option>
                    <option value="5" class="operate" disabled>Operator</option>

               </select>
          `;

          swal({
                    title: "Error Message",
                    text: "No more Create Employee!!!",
                    icon: "error",

                });

}
else if(mng >= 2){
    $("#create_employee").modal('show');
htmlmo += `
         <label class="control-label">Employee Role</label>
                 <select class="form-control select2" style="margin-top:9px" name="role" style="width: 100%">
                    <option value="">Select</option>
                    <option value="4" class="manage" disabled>Manager</option>
                    <option value="5" class="operate">Operator</option>

               </select>
          `;
          swal({
                    title: "Error Message",
                    text: "No more Create Manager!!!But You can create Operator.",
                    icon: "error",

                });
}
else if(opt >= 3){
    $("#create_employee").modal('show');
htmlmo += `
         <label class="control-label">Employee Role</label>
                 <select class="form-control select2" style="margin-top:9px" name="role" style="width: 100%">
                    <option value="">Select</option>
                    <option value="4" class="manage">Manager</option>
                    <option value="5" class="operate" disabled>Operator</option>

               </select>
          `;
          swal({
                    title: "Error Message",
                    text: "No more Create Operator!!!But You can create Manager.",
                    icon: "error",

                });
}

else{
    $("#create_employee").modal('show');
    htmlmo += `
         <label class="control-label">Employee Role</label>
                 <select class="form-control select2" style="margin-top:9px" name="role" style="width: 100%">
                    <option value="">Select</option>
                    <option value="4" class="manage">Manager</option>
                    <option value="5" class="operate">Operator</option>

               </select>
          `;
}

   $('#select_role').html(htmlmo);
}

</script>
@endsection
