@extends('master')
@section('title', 'Dashboard')
@section('content')

<div class="row page-titles">

    <div class="col-md-5 col-8 align-self-center">
        <h3 style="color:rgb(34, 190, 241)">News List</h3>

    </div>

    <div class="col-md-7 col-4 align-self-center">


        <div class="d-flex m-t-8 justify-content-end">
             <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#create_news">
                <i class="fas fa-plus"></i>

                Add News
            </a>
        </div>

        <div class="modal  fade" id="create_news" role="dialog" aria-hidden="true" class="hhh">

            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="color:rgb(165, 25, 153)">News Create Form</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>

                    <div class="modal-body">

                        <form method="POST" action="{{route('store_news')}}" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                                <label for="" style="color:rgb(34, 190, 241)">Title</label>
                                <input type="text" name="title" class="form-control border border-outline border-primary" placeholder="Enter Title">
                                <label for="" style="color:rgb(34, 190, 241)">Image</label>
                                <input type="file" name="img" class="form-control border border-outline border-primary" placeholder="Choose Image">
                                <label for="" style="color:rgb(34, 190, 241)" class="mt-3">Description</label>
                                <textarea name="des" id="" cols="30" rows="5" class="form-control border border-outline border-primary"></textarea>
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
    <thead class="bg-info">
    <th>#</th>
    <th>Title</th>
    <th>Image</th>
    <th>Description</th>
    <th class="text-center">Action</th>
    </thead>
    <?php $i=1 ?>
    <tbody>
        @foreach ($news as $n)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$n->title}}</td>
                <td><img src="public/images/{{$n->image}}" alt="" width="150" height="100"></td>
                <td>{{$n->description}}</td>

                <td class="text-center">
                    <a href="{{route('delete_news',$n->id)}}" class="btn btn-sm btn-danger">Delete</a>
                    <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#updateModal" onclick="update_form_data('{{$n->id}}')">Update</a>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>

<div class="modal  fade" id="updateModal" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:rgb(165, 25, 153)">News Create Form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>

            <div class="modal-body">

                <form method="POST" action="{{route('store_update_news')}}" enctype='multipart/form-data'>
                    @csrf
                    <input type="hidden" value="" id="i" name="news_id">
                    <div class="form-group">
                        <label for="" style="color:rgb(34, 190, 241)">Title</label>
                        <input type="text" name="title" id="t" class="form-control border border-outline border-primary" >
                        <label for="" style="color:rgb(34, 190, 241)">Image</label><br>
                        <span id="update_img"></span>
                        <input type="file" name="img" id="i" class="form-control border border-outline border-primary" >
                        <label for="" style="color:rgb(34, 190, 241)" class="mt-3">Description</label>
                        <textarea name="des" id="d" cols="30" rows="5" class="form-control border border-outline border-primary"></textarea>
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

@endsection

@section('js')
<script>
 function update_form_data(value)
 {   
    //  alert(value);
    $.ajax({
            type:'POST',
            url:'/find_news_update',
            dataType:'json',
            data:{
                    "_token": "{{ csrf_token() }}",
                    "old_id": value,
                },

            success:function(data){
                htmlimg = "";
                htmlimg += `
                            <img src="public/images/${data.image}" alt="" width="100" height="50">   
                            `;
                //  alert(data.image);
                $('#i').val(data.id);
                $('#t').val(data.title);
                $('#update_img').html(htmlimg);
                $('#d').val(data.description);
            }
    });
 }
</script>
@endsection