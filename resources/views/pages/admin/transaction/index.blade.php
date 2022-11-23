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
            <h4 style="font-weight: bold" class="mt-1"> Transaction</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->
                     {{-- <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Request Material
                     </button> --}}

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                       <div class="modal-dialog modal-lg " role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollableTitle">Transaction Information</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form action="/user/transaction" method="POST" enctype="multipart/form-data">
                               @csrf

                              <div class="container">
                               <div class="row">
                                  <div class="col-sm">
                                    <label for="type">Type</label>
                                    <select class="form-select" aria-label="Default select example" name="type" id="type" >
                                                <option class="opt1" value="" disabled selected hidden>Select Item</option>
                                                <option value="book">Book</option>
                                                <option value="magazine">Magazine</option>
                                                <option value="newspaper">Newspaper</option>

                                    </select>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm">
                                    <label for="Title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>

                                  </div>
                                  <div class="col-sm">
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control" name="author" id="author" placeholder="Author" required>

                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>

                                  </div>

                                </div>
                              </div>

                              </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Add Transaction</button>
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
                <table style=" font-size:14px;" id="table_id" class="table table-head-fixed text-nowrap table-striped table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th>ID No.</th>
                      <th>Title</th>

                      <th>Status</th>
                      <th>Date Available</th>
                      <th style="text-align: center">Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                      <td class="align-middle" >{{$transaction ->id}}</td>
                      <td class="align-middle">{{$transaction ->title }}</td>
                      <td class="align-middle">
                        @if ($transaction->status == 0)
                            Pending
                        @elseif($transaction->status == 1)
                            Approved
                        @elseif($transaction->status == 2)
                            Declined
                        @elseif($transaction->status == 3)
                            Issued
                        @elseif($transaction->status == 4)
                            Returned
                        @endif
                      </td>
                      <td class="align-middle">{{$transaction ->date_available }}</td>

                      <td class="align-middle" style="text-align: center">
                           @if ($transaction->status == 0)
                               <button type="button" data-id="{{ $transaction->u_mobile }}" class="btn  btn-success approveBtn" style="display:inline;">Approved</button>
                               <form action="/transaction/{{$transaction ->id}}" method="POST" enctype="multipart/form-data" id="formid" style="display: inline;">
                                  @csrf
                                  @method('PUT')
                                  <input style="display: none;" type="text" class="form-control" value="2" name="status" id="status" placeholder="Status">
                                  <input style="display: none;" type="text" class="form-control" value="0" name="statustext" id="statustext" placeholder="Status Text">
                                  <input style="display: none;" type="text" class="form-control" value="Declined" name="action" id="action" >
                                  <input style="display: none;" type="text" class="form-control" value="{{ $transaction->u_mobile }}" name="mobile" id="mobile" >
                                  <button type="submit" class="btn  btn-danger">Declined</button>
                               </form>
                            @elseif($transaction->status == 1)
                               <form action="/transaction/{{$transaction ->id}}" method="POST" enctype="multipart/form-data" id="formid" style="display: inline;">
                                  @csrf
                                  @method('PUT')
                                  <input style="display: none;" type="text" class="form-control" value="3" name="status" id="status" placeholder="Status">
                                  <input style="display: none;" type="text" class="form-control" value="1" name="statustext" id="statustext" placeholder="Status Text">
                                  <input style="display: none;" type="text" class="form-control" value="Issued" name="action" id="action" placeholder="Action">
                                  <input style="display: none;" type="text" class="form-control" value="{{ $transaction->u_mobile }}" name="mobile" id="mobile" >
                                  <button type="submit" class="btn  btn-info">Issued</button>
                               </form>
                            @elseif($transaction->status == 2)
                              <button type="submit" class="btn  btn-danger" disabled>Declined</button>
                            @elseif($transaction->status == 3)
                              <form action="/transaction/{{$transaction ->id}}" method="POST" enctype="multipart/form-data" id="formid" style="display: inline;">
                                  @csrf
                                  @method('PUT')
                                  <input style="display: none;" type="text" class="form-control" value="4" name="status" id="status" placeholder="Status">
                                  <input style="display: none;" type="text" class="form-control" value="3" name="statustext" id="statustext" placeholder="Status Text">
                                  <input style="display: none;" type="text" class="form-control" value="Returned" name="action" id="action" placeholder="Action">
                                  <input style="display: none;" type="text" class="form-control" value="{{ $transaction->u_mobile }}" name="mobile" id="mobile" >

                                  <button type="submit" class="btn  btn-info">Returned</button>
                               </form>
                            @elseif($transaction->status == 4)
                                  <button type="submit" class="btn  btn-success" disabled>Returned</button>
                            @endif

                            {{--approve--}}
                            <div class="modal fade" id="approveModal" role="dialog" aria-labelledby="approveModal"
                                aria-bs-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="approveModal"> Approved Request</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-bs-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <div class="modal-body">
                                              <form action="" method="POST" enctype="multipart/form-data" id="approveroute">
                                              @csrf
                                              @method('PUT')

                                              <div class="container">
                                              <div class="row">
                                                  <div class="col-sm-12">
                                                      <label for="date_available" >Available Date to Issue</label>
                                                      <input type="date" class="form-control" name="date_available" id="date_available" placeholder="Release Date" required>
                                                      <input style="visibility: hidden;" type="text" class="form-control" value="1" name="status" id="status" placeholder="Status">
                                                      <input style="visibility: hidden;" type="text" class="form-control" value="0" name="statustext" id="statustext" placeholder="Status Text">
                                                      <input style="display: none;" type="text" class="form-control" value="" name="mobile2" id="mobile2" >
                                                      <input style="display: none;" type="text" class="form-control" value="Approved" name="action" id="action" placeholder="Action">

                                                    </div>
                                                  </div>
                                              </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="" class="btn btn-primary">Approved</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            {{-- approve modal --}}
                        </td>


                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="mt-2">
              {{$transactions->links()}}
            </div>
          </div>
        </div>
</div>



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

      $('.editbtn').on('click', function () {

          $('#editmodal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function () {
              return $(this).text();
          }).get();

          console.log(data);

          let updateroute = "/customer/"+data[0].toString();
          $("#formid").attr("action", updateroute);

          $('#first_name2').val(data[1]);
          $('#last_name2').val(data[2]);
          $('#email2').val(data[3]);
          $('#phone2').val(data[4]);
          $('#address2').val(data[5]);
          $('#city2').val(data[7]);
          $('#state2').val(data[8]);
          $('#zip2').val(data[9]);
          $('#country2').val(data[10]);
          $('#currency2').val(data[11]);




        //   let valcategory_type2 = data[7].toString();
        //   $('#category_type2 option[value="' + valcategory_type2 +'"]').prop("selected", true);

        //   let valStatus = data[8].toString();
        //   $('#status2 option[value="' + valStatus +'"]').prop("selected", true);

        //   let prof_img_val = "uploads/category/"+data[9].toString();
        //   $('#download_prof_image').prop("href", prof_img_val);





      });

       $('.approveBtn').on('click', function () {
        var mobile = $(this).data('id');
          $('#approveModal').modal('show');

          $('#mobile2').val(mobile);


          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function () {
              return $(this).text();
          }).get();

          let approveroutes = "/transaction/"+data[0].toString();
          $("#approveroute").attr("action", approveroutes);
       });
       $('.editbtn').on('click', function () {
          $('#editmodal').modal('show');
       });
       $('.editbtn').on('click', function () {
          $('#editmodal').modal('show');
       });
       $('.editbtn').on('click', function () {
          $('#editmodal').modal('show');
       });
       $('.editbtn').on('click', function () {
          $('#editmodal').modal('show');
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

