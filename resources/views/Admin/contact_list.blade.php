@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="row page-titles">

    <div class="col-md-5 col-8 align-self-center">
        <h3 style="color:rgb(34, 190, 241)">Contact List</h3>

    </div>

    <div class="col-md-7 col-4 align-self-center">


        <div class="d-flex m-t-8 justify-content-end">
             <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#create_contact">
                <i class="fas fa-plus"></i>

                Add Contact
            </a>
        </div>
        <div class="modal  fade" id="create_contact" role="dialog" aria-hidden="true" class="hhh">

            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="color:rgb(165, 25, 153)">Contact Create Form</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>

                    <div class="modal-body">

                        <form method="POST" action="{{route('store_contact')}}" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                <label for="" style="color:rgb(34, 190, 241)" class="mt-3">Location</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="locat" id="receive_point" style="border-radius: 7px;color:rgb(41, 87, 236);width: 100%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;" class="border border-outline border-primary">
                                            <option selected hidden>Choose Location</option>
                                            @foreach($location as $locat)
                                                <option value="{{$locat->name}}">{{$locat->name}}</option>
                                            @endforeach
                                            <option value="MYAWADY">MYAWADY</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="" style="color:rgb(34, 190, 241)" class="mt-3">Address</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="address" id="" cols="30" rows="3" class="form-control border border-outline border-primary"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                      <div class="col-md-3">
                                        <label for="" style="color:rgb(34, 190, 241)" class="mt-3">Phone Number</label>
                                      </div>
                                      <div class="col-md-9 mt-2">
                                        <input type="text" name="phno" class="form-control border border-outline border-primary" placeholder="Enter Phone No,">
                                      </div>
                                </div>
                               
                            </div>
                            <div class="row offset-3 mt-3">
                                <button type="submit" class="btn btn-lg btn-primary">Save</button></a>
                                <button class="btn btn-lg btn-danger ml-3" data-dismiss="modal">Cancel</button>
                           </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>

    </div>
</div>

<table class="table table-striped mt-4">
    <thead class="bg-info">>
    <th>#</th>
    <th>Location</th>
    <th>Address</th>
    <th>Phone Number</th>
    <th class="text-center">Action</th>
    </thead>
    <?php $i=1 ?>
    <tbody>
        @foreach ($contacts as $c)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$c->location}}</td>
                <td>{{$c->address}}</td>
                <td>{{$c->phone_number}}</td>
                <td class="text-center"><a href="{{route('delete_contact',$c->id)}}" class="btn btn-sm btn-danger">Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection