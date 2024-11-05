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
    </style>
@endsection

@section('content')
<div class="container mt-4" style="text-align: center;">
    <h2>Inquiry Information</h2> <!-- Table heading -->
    <div class="ml-5">
    <table style="margin: 0 auto; border-collapse: collapse;" id="table" class="table">
        <thead>
        <tr>
            <th style="padding: 10px; border: 1px solid #ddd;">S.No</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Name</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Email</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inqs as $key=>$inq)     
        <tr id="row-{{$inq->id}}">
            <td style="padding: 10px; border: 1px solid #ddd;">{{++$key}}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{$inq->name}}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{$inq->email}}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">
        <!-- Button trigger modal -->
        <i class="fas fa-eye text-success mr-2" data-toggle="modal" data-target="#view-{{$inq->id}}"></i>
     
        <!-- Modal -->
        <div class="modal fade" id="view-{{$inq->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inquiry Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <b>{{'Subject : '}}</b>{{$inq->subject}}<br><br>
                <b>{{'Message : '}}</b>{{$inq->message}}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Button trigger modal -->
        <i class="fas fa-trash text-danger mr-2" data-toggle="modal" data-target="#del-{{$inq->id}}" onclick="removeInq({{$inq->id}})"></i>
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
    $(document).ready(function(){
      var table = $('#table').DataTable(); // Initialize DataTable
      $.ajax({
        url : `/removeInq/${id}`,
        type : 'GET',
        success : function(response){
          Swal.fire({
      title: "Deleted!",
      text: response.success,
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
</script>

@endsection


