@extends('layouts.master')

@section('nav')

{{-- @if ($errors->any())

@endif --}}
<nav class="main-header  navbar-expand navbar-white navbar-light " style="padding: 5px !important;z-index: 1">
  <!-- Left navbar links -->
     <div class="row mx-0">
          <div class="col-sm-1">
            <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: gray"></i></a>
          </div>

          <div class="col-sm-5">
            <h4 style="font-weight: bold" class="mt-1">Categories</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Add New Category
                     </button>

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollableTitle">Category Information</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form action="/category" method="POST" enctype="multipart/form-data">
                               @csrf

                               <div class="container">
                                <div class="row">
                                      <div class="col-12">
                                      <label for="name">Category Name</label>
                                      <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" required>
                                      </div>
                                  </div>
                                  <br>
                                 <div class="row">
                                      <div class="col-sm-12">
                                          <label for="description">Description</label>
                                          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                      </div>
                                  </div>
                                  <br>


                             </div>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Add Category</button>
                               </div>
                               </form>
                           </div>
                         </div>
                       </div>
                     </div>
            {{-- modal --}}
        </div>
     </div>




    <!-- <li class="nav-item d-none d-sm-inline-block">
      <a href="../../index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li> -->


  <!-- Right navbar links -->

</nav>
@endsection

@section('content')
<style>
    .pac-container {
    background-color: #FFF;
    z-index: 99999;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 99999;
}
.modal-backdrop{
    z-index: 10;
}
.text {
 /**Major Properties**/
 overflow:hidden;
line-height: 1.6rem;
max-height: 8rem;
-webkit-box-orient: vertical;
display: block;
display: -webkit-box;
overflow: hidden !important;
text-overflow: ellipsis;
-webkit-line-clamp: 5;
}
  </style>
<div class="container-fluid">
  @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
  @endif
<div class="row">
          <div class="col-12">

              <div class="tablesizes card-body table-responsive p-0" style="z-index: -99999">
                <table id="table_id" class="table table-head-fixed text-nowrap table-striped table-hover" style=" font-size:14px;">
                  <thead class="thead-light">
                    <tr>
                     <th>ID</th>
                      <th>Category Name</th>
                      <th>Description</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                    <tr>

                      <td class="align-middle">{{$category ->id }}</td>
                      <td class="align-middle text-wrap" >{{$category ->name}}</td>
                      <td class="align-middle">{{$category ->description}}</td>
                      <td class="align-middle">
                          {{-- update modal --}}
                          <button type="button" data-id="{{ $category->id }}" class="btn editbtn" style="background: none;
                          color: inherit;
                          border: none;
                          padding: 0;
                          font: inherit;
                          cursor: pointer;
                          outline: inherit;
                          margin-top:-5px;
                          "> <i class="fas fa-edit"></i>Edit </button>

                          <div class="modal fade" id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Update Category Information </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-bs-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                      <div class="modal-body">
                                        <form action="" method="POST" enctype="multipart/form-data" id="formid">
                                        @csrf
                                        @method('PUT')

                                        <div class="container">
                                            <div class="row">
                                                  <div class="col-12">
                                                  <label for="name">Category Name</label>
                                                  <input type="text" class="form-control" name="name2" id="name2" placeholder="Category Name" required>
                                                  </div>
                                              </div>
                                              <br>
                                             <div class="row">
                                                  <div class="col-sm-12">
                                                      <label for="description">Description</label>
                                                      <textarea class="form-control" id="description2" name="description2" rows="3"></textarea>
                                                  </div>
                                              </div>
                                              <br>


                                         </div>

                                    </div>

                                           <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary">Update Category</button>
                                           </div>
                                           </form>

                              </div>
                          </div>
                     </div>

                          {{-- update modal --}}

                      </td>


                      {{-- here --}}
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="mt-2">
              {{$categories->links()}}
            </div>
          </div>
        </div>
</div>
{{--  --}}



  </body>
  </html>


  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKOU_JfykYBj4kDS8ryXPSd0kxsygDcGU&libraries=places"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  <script>
    // function myFunction() {
    //   $('#exampleModalScrollable').modal('show');
    // }
    </script>


<script>

$(document).ready(function () {



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on('click', '.editbtn', function () {
  var user_id = $(this).data('id');
  $('#editmodal').modal('show');


     let updateroutes = "/category/"+user_id;
      $("#formid").attr("action", updateroutes);


  $.get('/category/'+user_id+'/edit', function (data) {
    console.log(data.name);
    $('#name2').val(data.name);
       $('#description2').val(data.description);
   });

});
});
</script>
<script>
  $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>

{{--  --}}
@endsection

