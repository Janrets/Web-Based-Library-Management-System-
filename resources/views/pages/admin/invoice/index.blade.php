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
            <h4 style="font-weight: bold" class="mt-1">Invoice</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >
              <form action="/bank-search" method="GET">
                <div class="input-group-append">
                 <input type="text" name="query" class="form-control shadow-none mt-1" placeholder="Search" style="height: 38px;" >

                  <button type="submit" class="btn btn-default shadow-none">
                    <i class="fas fa-search mt-1" style=""></i>
                  </button>
                </div>
              </form>


            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Add New Invoice
                     </button>

                      <!-- Modal -->
                      <div  class="modal fade" id="exampleModalScrollable"  role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalScrollableTitle">Invoice Information</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body" style="background-color: #F4F6F9;" >
                              <form action="/invoice" method="POST" enctype="multipart/form-data">
                                @csrf



                                <div class="container">
                                    <div class="row">
                                      <div class="col-sm-9" style="background-color: white;padding:20px;">
                                        <div class="form-row">

                                            <div class="form-group col-md-2">
                                                <label for="sel_item">Item</label><br>
                                                <select class="form-select" aria-label="Default select example" name="sel_item" id="sel_item" >
                                                <option class="opt1" value="" disabled selected hidden>Select Item</option>
                                                @foreach($services as $service)
                                                  <option value="{{$service->id}}">{{$service->name}}  </option>
                                                @endforeach
                                              </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="sel_qty">Quantity</label>
                                                <input type="number"  class="form-control sel_qty" name="sel_qty" id="sel_qty" >
                                            </div>


                                            <div class="form-group col-md-2">
                                               <label for="sel_price">Price</label>
                                               <input type="number"  class="form-control sel_price" name="sel_price" id="sel_price" >
                                           </div>


                                           <div class="form-group col-md-2">
                                               <label for="sel_total">Total</label>
                                               <input type="number"  class="form-control sel_total" name="sel_total" id="sel_total" >
                                           </div>

                                           <div class="form-group col-md-2">
                                               <label for="sel_tax">Tax</label>
                                               <select class="form-select" aria-label="Default select example" name="sel_tax" id="sel_tax" >
                                                <option class="opt1" value="" disabled selected hidden>Set Tax</option>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                               </select>
                                         </div>

                                            <div class="form-group col-md-2">
                                                <label for="addToCart"> Action</label><br>
                                                <button type="button" class="btn btn-primary addToCart">Add</button>
                                            </div>
                                           </div>

                                           <div class="row">
                                            <div class="col-12">
                                                <h4>Item</h4>
                                                <div class=" card-body table-responsive p-0" style="z-index: -99999">
                                                  <table class="table  text-nowrap  table-hover">
                                                    <thead class="thead-light">
                                                      <tr>

                                                        <th>Item</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>Tax</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody class="OrderTbody">

                                                    </tbody>
                                                  </table>
                                                </div>
                                                <!-- /.card-body -->
                                              </div>


                                              <!-- /.card -->

                                              <div class="mt-2">
                                                {{-- {{$customers->links()}} --}}
                                              </div>
                                            </div>
                                      </div>
                                      <div class="col-sm-3">
                                            {{-- header --}}
                                      <div class="container" style="background-color: white;padding:20px;">
                                            <div class="form-row text-end">
                                                <div class="form-group col">
                                                    <label for="subtotal" style="font-size: 20px;">Sub Total: <span style="text-decoration: underline" id="total_subtotal">0</span> </label>
                                                </div>
                                            </div>
                                            <div class="form-row text-end">
                                                <div class="form-group col">
                                                    <label for="discount" style="font-size: 20px;">Discount: <span style="text-decoration: underline" id="total_discount">0</span> </label>
                                                </div>
                                            </div>
                                            <div class="form-row text-end">
                                                <div class="form-group col">
                                                    <label for="total_tax" style="font-size: 20px;">Tax: <span style="text-decoration: underline" id="total_tax">0</span> </label>
                                                </div>
                                            </div>
                                            <div class="form-row text-end">
                                                <div class="form-group col">
                                                    <label for="total_total" style="font-size: 20px;">Total: <span style="text-decoration: underline" id="total_total">0</span> </label>
                                                </div>
                                            </div>
                                      </div>

                                      <div class="container" style="margin-top:10px;background-color: white;padding:20px;">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label for="customer">Customer</label>
                                                <select class="form-select" aria-label="Default select example" name="customer" id="customer"required  >
                                                <option class="opt1" value="" disabled selected hidden>Select Customer</option>
                                                @foreach($customers as $customer)
                                                  <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}  </option>
                                                @endforeach
                                              </select>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label for="currency">Currency</label>
                                                <select class="form-select" aria-label="Default select example" name="currency" id="currency" required>
                                                        <option class="opt1" value="" disabled selected hidden>Set Currency</option>
                                                        <option value="0">PHP</option>
                                                        <option value="1">USD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" name="address"  required>

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label for="invoice_prefix">Invoice Prefix</label>
                                                <input type="text" class="form-control" id="invoice_prefix" name="invoice_prefix"  required>

                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label for="invoice_no">Invoice No.</label>
                                                <input type="text" class="form-control" id="invoice_no" name="invoice_no"  required>

                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label for="invoice_date">Invoice Date</label>
                                                <input type="date" class="form-control" id="invoice_date" name="invoice_date"  required>

                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label for="payment_terms">Payment Terms</label>
                                                <select class="form-select" aria-label="Default select example" name="payment_terms" id="payment_terms" >
                                                    <option class="opt1" value="" disabled selected hidden>Set Tax</option>
                                                    <option value="0">Due on Receipt</option>
                                                    <option value="1">+3 days</option>
                                                    <option value="2">+5 days</option>
                                                    <option value="3">+7 days</option>
                                                    <option value="4">+10 days</option>
                                                    <option value="5">+15 days</option>
                                                    <option value="6">+30 days</option>
                                                    <option value="7">+45 days</option>
                                                    <option value="8">+60 days</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label for="sales_tax">Sales Tax</label>
                                                 <select class="form-select" aria-label="Default select example" name="sales_tax" id="sales_tax" >
                                                    <option class="opt1" value="" disabled selected hidden>Set Tax</option>
                                                    <option value="0">None</option>
                                                    <option value="1">Sales Tax(1.5 %)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col">
                                               <input type="hidden" class="form-control" id="g_total" name="g_total"  required>

                                            </div>
                                        </div>
                                    </div>



                                        {{-- header --}}
                                      </div>
                                    </div>
                                </div>






                           </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Submit Invoice</button>
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
                <table class="table table-head-fixed text-nowrap table-striped table-hover">
                  <thead class="thead-light">
                    <tr>
                     <th>Invoice No.</th>
                      <th>Account</th>
                      <th>Invoice Date</th>
                      <th>Due Date</th>

                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($invoices as $invoice)
                    <tr>

                      <td class="align-middle">{{$invoice ->i_inv_no }}</td>
                      <td class="align-middle">{{$invoice ->c_first_name}} {{$invoice ->c_last_name}}</td>
                      <td class="align-middle">{{$invoice ->i_inv_date}}</td>
                      <td class="align-middle">
                        @if ($invoice->i_pay_term == 0)
                            {{$invoice ->i_inv_date}}
                        @elseif($invoice->i_pay_term == 1)
                            {{ date('Y-m-d  ', strtotime($invoice->i_inv_date. ' + 3 days')) }}
                        @elseif($invoice->i_pay_term == 2)
                            {{ date('Y-m-d  ', strtotime($invoice->i_inv_date. ' + 5 days')) }}
                        @elseif($invoice->i_pay_term == 3)
                            {{ date('Y-m-d  ', strtotime($invoice->i_inv_date. ' + 7 days')) }}
                        @elseif($invoice->i_pay_term == 4)
                            {{ date('Y-m-d  ', strtotime($invoice->i_inv_date. ' + 10 days')) }}
                        @elseif($invoice->i_pay_term == 5)
                            {{ date('Y-m-d  ', strtotime($invoice->i_inv_date. ' + 15 days')) }}
                        @elseif($invoice->i_pay_term == 6)
                            {{ date('Y-m-d  ', strtotime($invoice->i_inv_date. ' + 30 days')) }}
                        @elseif($invoice->i_pay_term == 7)
                            {{ date('Y-m-d  ', strtotime($invoice->i_inv_date. ' + 45 days')) }}
                        @elseif($invoice->i_pay_term == 8)
                            {{ date('Y-m-d  ', strtotime($invoice->i_inv_date. ' + 60 days')) }}

                        @endif
                      </td>
                      <td class="align-middle">
                          {{-- update modal --}}
                          <button type="button" class="btn editbtn" style="background: none;
                          color: inherit;
                          border: none;
                          padding: 0;
                          font: inherit;
                          cursor: pointer;
                          outline: inherit;
                          margin-top:-5px;
                          "> <i class="fas fa-edit"></i>Update </button>

                          <div  class="modal fade" id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header" >
                                      <h5 class="modal-title" id="exampleModalLabel" > Invoice Information </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-bs-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                      <div class="modal-body" >
                                        <form action="" method="POST" enctype="multipart/form-data" id="formid">
                                        @csrf
                                        @method('PUT')

                                        <div class="container" >
                                            <div class="row">
                                              <div class="col-sm">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text" class="form-control" name="bank_name2" id="bank_name2" placeholder="Bank Name"   >

                                              </div>
                                              <div class="col-sm">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" name="description2" id="description2" placeholder="First Name" >

                                              </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm">
                                                    <label for="balance">Initial Balance</label>
                                                    <input type="text" class="form-control" name="balance2" id="balance2" placeholder="Initial Balance" >

                                                </div>
                                                <div class="col-sm">
                                                    <label for="acc_no">Account No.</label>
                                                    <input type="text" class="form-control" name="acc_no2" id="acc_no2" placeholder="Account No." >

                                                </div>
                                              </div>

                                              <div class="row">
                                                <div class="col-sm">
                                                    <label for="contact_person">Contact Person</label>
                                                    <input type="text" class="form-control" name="contact_person2" id="contact_person2" placeholder="Contact Person" >

                                                </div>
                                                <div class="col-sm">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" class="form-control" name="phone2" id="phone2" placeholder="phone" >

                                                </div>
                                              </div>

                                              <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="url">Internet Banking Url</label>
                                                    <input type="text" class="form-control" name="url2" id="url2" placeholder="Internet Banking Url" >

                                                </div>
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
              {{$invoices->links()}}
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

          let updateroute = "/bank/"+data[0].toString();
          $("#formid").attr("action", updateroute);

          $('#bank_name2').val(data[1]);
          $('#description2').val(data[2]);
          $('#balance2').val(data[3]);
          $('#acc_no2').val(data[4]);
          $('#contact_person2').val(data[5]);
          $('#phone2').val(data[6]);
          $('#url2').val(data[7]);





        //   let valcategory_type2 = data[7].toString();
        //   $('#category_type2 option[value="' + valcategory_type2 +'"]').prop("selected", true);

        //   let valStatus = data[8].toString();
        //   $('#status2 option[value="' + valStatus +'"]').prop("selected", true);

        //   let prof_img_val = "uploads/category/"+data[9].toString();
        //   $('#download_prof_image').prop("href", prof_img_val);





      });
  });
</script>

@php
$user_id = 1;
@endphp

<script>
    $(document).ready(function () {

        function calc_total(){
            var sum = 0;
         var zero = 0;
        var length = $('.total').length;
        if(length != 0){
            $(".total").each(function(){
                sum += parseFloat($(this).text());
                $('#total_subtotal').text(sum);
                $('#total_total').text(sum);
                $('#g_total').val(sum);
            });
        }else{
            $('#total_subtotal').text(zero);
            $('#total_total').text(zero);
            $('#g_total').val(sum);
        }


        }
         fetch();
         calc_total();
        function fetch(){

            $.ajax({
                type: "GET",
                url: "/get-item-list/"+{{$user_id}},
                dataType: "json",
                success: function (response) {

                    if (response.data != null) {
                        // console.log(response);
                        $('.OrderTbody').html("");
                        $.each(response.data, function (key, item) {
                            $('.OrderTbody').append('<tr>'+
                                '<td>' + item.name + '</td>'+
                                '<td>' + item.quantity + '</td>'+
                                '<td>' + item.price + '</td>'+
                                '<td class="total">' + item.total + '</td>'+
                                (item.tax == 0 ? '<td>No</td>' : '<td>Yes</td>') +
                            '<td><button type="button" value="' + item.id + '" class="btn btn-danger deleteListBtn btn-sm">Delete</button></td>'+
                            '</tr>');
                            calc_total();
                            // get_store_id = item.c_store_id;
                        });
                        // getStores(customer_id);


                    }
                    }
            });
        }
        $(document).on('click', '.addToCart', function (e) {
                e.preventDefault();
                var data = {

                'item_name': $('#sel_item :selected').val(),
                'quantity': $('.sel_qty').val(),
                'price': $('.sel_price').val(),
                'total': $('.sel_total').val(),
                'tax': $('#sel_tax :selected').val(),
                'user_id':{{$user_id}},

                }

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });

                $.ajax({
                type: "POST",
                url: "/invoice-item-list",
                data: data,
                dataType: "json",
                success: function (response) {
                        console.log(response);
                    if (response.status == 400) {


                    } else {
                        fetch();
                        $("#sel_item").val("");
                        $("#sel_qty").val("");
                        $("#sel_price").val("");
                        $("#sel_total").val("");
                        $("#sel_tax").val("");


                    }
                }
                });

        });





// ADD

  // DELETE
$(document).on('click', '.deleteListBtn', function (e) {
            e.preventDefault();


            var list_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/delete-invoice-item-list/" + list_id,
                dataType: "json",
                success: function (response) {
                        // console.log(response);
                    if (response.status == 404) {

                    } else {

                        fetch();

                    }
                }
            });




        });
        // DELETE

        $("#sel_price,#sel_qty").on('change keydown paste input', function(){

             total = $("#sel_price").val() * $("#sel_qty").val();
            $("#sel_total").val(total);
        });

        $("#sel_item").on('change', function(){

            itemid = $(this).val();
            $.ajax({
                type: "GET",
                url: "/get-item/"+itemid,
                dataType: "json",
                success: function (response) {

                    if (response.data != null) {
                         console.log(response);
                        $.each(response.data, function (key, item) {
                            $("#sel_price").val(item.sales_price);
                        });



                    }


                    }
            });
            $("#sel_qty").val("");
            $("#sel_total").val("");

        });

    });
</script>

{{--  --}}
@endsection

