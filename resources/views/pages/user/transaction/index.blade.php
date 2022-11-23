@extends('layouts.user_master')

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

                     <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                        Request Material
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalScrollableTitle">Material Information</h5>
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
                                     <label for="book">Material Title</label>
                                     <select class="form-select" aria-label="Default select example" name="material_id" id="material_id" >
                                                 <option class="opt1" value="" disabled selected hidden>Select Item</option>
                                                 @foreach($materials as $material)
                                                   <option value="{{$material->id}}">{{$material->title}}  </option>
                                                 @endforeach
                                     </select>
                                   </div>

                                 </div>
                                 {{-- <div class="row">
                                   <div class="col-sm">
                                     <label for="quantity">Quantity</label>
                                     <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" required>
                                   </div>
                                 </div> --}}
                               </div>
                               </div>
                               <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Request Material</button>
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
                      <th>ID No.</th>
                      <th>Title</th>
                      {{-- <th>Quantity</th> --}}
                      <th>Status</th>
                      <th>Date Available</th>
                      <!-- <th>Action</th> -->

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                      <td class="align-middle">{{$transaction ->id}}</td>
                      <td class="align-middle">{{$transaction ->title }}</td>
                      {{-- <td class="align-middle">{{$transaction ->quantity }}</td> --}}
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
                      <!-- <td class="align-middle">
                          {{-- update modal --}}
                          <button type="button" class="btn editbtn" style="background: none;
                          color: inherit;
                          border: none;
                          padding: 0;
                          font: inherit;
                          cursor: pointer;
                          outline: inherit;
                          margin-top:-5px;
                          "> <i class="fas fa-edit"></i>Edit </button>

                          {{-- <form style="margin: 0;
                          padding: 0;float: right;"  action="customer/{{$customer ->id}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn" style="background: none;
                                color: inherit;
                                border: none;
                                font: inherit;
                                cursor: pointer;
                                outline: inherit;
                                margin-top:-6px;
                                "> <i class="fas fa-edit"></i>Delete
                             </button>
                          </form> --}}



                          <div class="modal fade" id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Edit Customer Information </h5>
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
                                  <div class="col-sm">
                                    <label for="first_name2">First Name</label>
                                    <input type="text" class="form-control" name="first_name2" id="first_name2" placeholder="First Name" required>

                                  </div>
                                  <div class="col-sm">
                                    <label for="last_name2">Last Name</label>
                                    <input type="text" class="form-control" name="last_name2" id="last_name2" placeholder="Last Name" required>

                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm">
                                    <label for="email2">Email</label>
                                    <input type="email" class="form-control" name="email2" id="email2" placeholder="Email" required>

                                  </div>
                                  <div class="col-sm">
                                    <label for="phone2">Phone</label>
                                    <input type="number" class="form-control" name="phone2" id="phone2" placeholder="Phone" required>

                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm">
                                    <label for="address2">Address</label>
                                    <input type="text" class="form-control" name="address2" id="address2" placeholder="Address" required>

                                  </div>
                                  <div class="col-sm">
                                    <label for="city2">City</label>
                                    <input type="text" class="form-control" name="city2" id="city2" placeholder="City" required>

                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm">
                                    <label for="state2">State</label>
                                    <input type="text" class="form-control" name="state2" id="state2" placeholder="State" required>

                                  </div>
                                  <div class="col-sm">
                                    <label for="zip2">Zip</label>
                                    <input type="text" class="form-control" name="zip2" id="zip2" placeholder="Zip" required>

                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm">
                                    <label for="country2">Country</label>
                                    <input type="text" class="form-control" name="country2" id="country2" placeholder="Country" required>

                                  </div>
                                  <div class="col-sm">
                                    <label for="currency2">Currency</label>
                                    <select class="form-select" aria-label="Default select example" name="currency2" id="currency2" required>
                                          <option class="opt1" value="" disabled selected hidden>Set Currency</option>
                                          <option value="0">PHP</option>
                                          <option value="1">USD</option>
                                        </select>
                                  </div>
                                </div>





                                        </div>


                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                                      </div>
                                  </form>

                              </div>
                          </div>
                     </div>

                          {{-- update modal --}}

                      </td> -->


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
              {{$transactions->links()}}
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
  });
</script>

<script>
  $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
{{--  --}}
@endsection

