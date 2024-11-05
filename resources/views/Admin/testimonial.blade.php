@extends('layouts.admin_layout')

@section('style')
<style>
  .container{
    width: 990px; 
  }
  .pagination{
    margin-top: 2rem;
    margin-left: 20.7rem;
  }
  #table_info{
    margin-top: 2rem;
  }

  .fancy-flash {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
        padding: 15px 20px;
        border-radius: 8px;
        background-color: #4caf50;
        color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: translateY(-20px);
        animation: slideIn 0.5s forwards;
        }
        
        .fancy-flash .close {
        color: white;
        opacity: 0.8;
        font-size: 1.2rem;
        border: none;
        background: none;
        cursor: pointer;
        }
        
        .fancy-flash .close:hover {
        opacity: 1;
        }
        
        @keyframes slideIn {
        to {
        opacity: 1;
        transform: translateY(0);
        }
        }
        
        @keyframes fadeOut {
        to {
        opacity: 0;
        transform: translateY(-20px);
        }
        }

</style>
@endsection

@section('content')

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show fancy-flash" id="flash-message">
        {{session('success') }}
        </div>

@endif

<div class="container mt-4" style="text-align: center;">
<h2>Testimonial Information</h2> <!-- Table heading -->
<div class="ml-5">
<table style="margin: 0 auto; border-collapse: collapse;" id="table" class="table">
        <!-- Button trigger modal -->
        <i class="fas fa-plus text-warning" data-toggle="modal" data-target="#add" style="margin-right: 56rem"></i>
        
        <!-- Modal -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">    
                <h5 class="modal-title" id="exampleModalLabel">Add Testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('testimonial.add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Client Name</label>
                        <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror">
                        <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="new_client_img">Upload Image</label><br>
                        <input name="new_client_img" type="file" required>
                    </div>
                    <div class="form-group">
                        <label for="editor2">Review</label>
                        <textarea name="review"  cols="30" rows="10" class="form-control editor2">
                            
                        </textarea>
                    </div>
              </div>
              <div class="modal-footer">
                <input type="submit" name="update" name="update" class="btn btn-warning">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
            </div>
          </div>
        </div>
    <thead>
    <tr>
        <th style="padding: 10px; border: 1px solid #ddd;">S.No</th>
        <th style="padding: 10px; border: 1px solid #ddd;">Name</th>
        <th style="padding: 10px; border: 1px solid #ddd;">Image</th>
        <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($testimonials as $key=>$testimonial)     
    <tr id="row-{{$testimonial->id}}">
        <td style="padding: 10px; border: 1px solid #ddd;">{{++$key}}</td>
        <td style="padding: 10px; border: 1px solid #ddd;">{{$testimonial->name}}</td>
        <td style="padding: 10px; border: 1px solid #ddd;"><img src="{{asset('img/'.$testimonial->client_img)}}" alt="{{$testimonial->client_img}}"></td>
        <td style="padding: 10px; border: 1px solid #ddd;">
    <!-- Button trigger modal -->
    <i class="fas fa-eye text-success mr-2" data-toggle="modal" data-target="#view-{{$testimonial->id}}"></i>
 
    <!-- Modal -->
    <div class="modal fade" id="view-{{$testimonial->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Review Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{$testimonial->review}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Button trigger modal -->
    <i class="fas fa-edit text-info mr-2" data-toggle="modal" data-target="#edit-{{$testimonial->id}}"></i>
 
    <!-- Modal -->
    <div class="modal fade" id="edit-{{$testimonial->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Testimonial</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('testimonial.edit',$testimonial->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Client Name</label>
                    <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$testimonial->name}}">
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="client_img">Client Image</label><br>
                    <img src="{{asset('img/'.$testimonial->client_img)}}" alt="{{$testimonial->client_img}}"><br>
                    <label for="new_client_img">Update Image</label><br>
                    <input name="new_client_img" type="file">
                </div>
                <div class="form-group">
                    <label for="editor2">Review</label>
                    <textarea name="review" id="editor2" cols="30" rows="10" class="form-control editor2">
                        {{$testimonial->review}}
                    </textarea>
                </div>
          </div>
          <div class="modal-footer">
            <input type="submit" name="update" name="update" class="btn btn-warning">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <!-- Button trigger modal -->
    <i class="fas fa-trash text-danger mr-2" data-toggle="modal" data-target="#del-{{$testimonial->id}}" onclick="removeInq({{$testimonial->id}})"></i>
    </td>
    </tr>
    @endforeach

</tbody>
</table>
</div>
</div>

@endsection

@section('script')
<script>
  function removeInq(id){
    Swal.fire({
title: "Are you sure?",
text: "You won't be able to revert this!",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#3085d6",
cancelButtonColor: "#d33",
confirmButtonText: "Yes, delete it!"
}).then((result) => {
if (result.isConfirmed) {

  var table = $('#table').DataTable(); // Initialize DataTable
  $.ajax({
    url : `removeTestimonial/${id}`,
    type : 'GET',
    success : function(response){
      Swal.fire({
  title: "Deleted!",
  text: response.message,
  icon: "success"
 
});
table.row('#row-' + id).remove().draw(false); // Remove and redraw without resetting pagination
    },
    
    error : function(xhr,status,error){
      Swal.fire({
icon: "error",
title: "Oops...",
text: "Something went wrong!",
});
    }
  });

}

});
  }
</script>

<script>
$(function () {
$('#table').DataTable({
  "paging": true,
  "lengthChange": false,
  "searching": false,
  "ordering": true,
  "info": true,
  "autoWidth": false,
});
});

setTimeout(function() {
    var flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
    flashMessage.style.animation = 'fadeOut 0.5s forwards';
    setTimeout(function() {
    flashMessage.style.display = 'none';
    }, 400);
    }
    }, 4000);

</script>

@endsection