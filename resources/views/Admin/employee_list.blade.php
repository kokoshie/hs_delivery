@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">        
        <h2 class="font-weight-bold">Employee List</h2>
    </div>

    <div class="col-md-7 col-4 align-self-center">

        <div class="d-flex m-t-10 justify-content-end">
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
                        <form class="form-material" method="post" action="" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-body">
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
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" class="form-control" required>
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
                                            <select class="form-control select2" name="role" style="width: 100%" >
                                                <option value="">Select</option>
                                                <option value="Sale_Person">Manager</option>
                                                <option value="Counter">Operator</option>                          
                                            </select>
                                        </div>
                                    </div> 


                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class=" col-md-9">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>           
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
