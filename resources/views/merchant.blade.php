{{-- @extends('layouts.master')

@section('content') --}}
<style>
    .pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 20;   
}
.modal-backdrop{
    z-index: 10;        
}
  </style>
<div class="container-fluid">
  
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

                <div class="container">
                  <div class="row">
                    <div class="col-sm-6">
                      <h4 style="font-weight: bold" class="mt-2"> Merchant List</h4>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group input-group-sm" >
                        <input type="text" name="table_search" class="form-control shadow-none mt-2" placeholder="Search" style="height: 34px;">
                 
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default shadow-none">
                            <i class="fas fa-search mt-2 " style=""></i>
                          </button>
                        </div>
                      </div>
                    </div>
                

                    <div class="col-sm-3">
                         {{-- modal --}}
                            <!-- Button trigger modal -->
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                                    Add New Employee
                                  </button>

                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="/merchant" method="POST">
                                            @csrf
                                            <div class="form-row">
                                              <div class="form-group col-md-4 mt-3">
                                                <label for="fname">First Name</label>
                                                <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required>
                                              </div>
                                              <div class="form-group col-md-4 mt-3">
                                                <label for="lname">Last Name</label>
                                                <input type="text" class="form-control"  name="lname" id="lname" placeholder="Last Name" required>
                                              </div>
                                              <div class="form-group col-md-4 mt-3">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" class="form-control"  name="mobile" id="mobile" placeholder="Mobile" required>
                                              </div>
                                            </div>
                                            <div class="form-row">
                                              <div class="form-group col-md-4">
                                                <label for="email">Email Address</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                                              </div>
                                        
                                              <div class="form-group col-md-4">
                                                  <label for="gender">Gender</label>
                                                  <select class="form-select" aria-label="Default select example" name="gender" id="gender" required>
                                                    <option class="opt1" value="" disabled selected hidden>Select Gender</option>
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                                  </select>
                                              </div>
                                          
                                              <div class="form-group col-md-4">
                                                  <label for="birthdate">Birth Date(Day/Month/Year)</label>
                                                  <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="Birth Date" required>   
                                              </div>
                                              </div>
                                        
                                            <div class="form-row">
                                              <div class="form-group col-md-12">
                                                <div class="form-group">
                                                  <label for="address">Address</label>
                                                    <input type="text" class="form-control mb-3" id="location2"  value="" name="address2" placeholder="Address" required>
                                                    <input type="hidden" name="location_lat2" id="location_lat2">
                                                    <input type="hidden" name="location_lang2" id="location_lang2">
                                                    <input type="hidden" name="city2" id="city2">
                                                    <input type="hidden" name="state2" id="state2">
                                                    <input type="hidden" name="region2" id="region2">
                                                    <input type="hidden" name="logs2" id="logs2">
                                                    <div id="map_canvas2" style="width: 100%;height: 200px;"></div>
                                                  </div>
                                              </div>
                                            </div>
                                        
                                        
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                         {{-- modal --}}
                     </div>
            </div>
        </div>
  

               

  
            

                
              </div>

 
          </div>
              <!-- /.card-header -->
              <div class="tablesizes card-body table-responsive p-0" style="z-index: 1">
                <table class="table table-head-fixed text-nowrap table-striped table-hover">
                  <thead>
                    <tr>
                      <th>ID No.</th> 
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Approval</th>
                      <th>Status</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($merchants as $merchant)
                    <tr>
                      <td>{{$merchant ->id}}</td>
                      <td>{{$merchant ->first_name}}</td>
                      <td>{{$merchant ->last_name }}</td>
                      <td>{{$merchant ->mobile}}</td>
                      <td>j{{$merchant ->email}}</td>
                      <td>
                        @if($merchant->gender == 0)         
                              Male        
                        @else
                              Female  
                        @endif

                      </td>
                      <td>Approved</td>
                      <td>Active</td>
                      <td>
                          {{-- update modal --}}
                          <button type="button" class="btn btn-success editbtn"> EDIT </button>

                          
              <div class="modal fade" id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                           <div class="modal-body">
                                          <form action="merchant/{{$merchant->id}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-row">
                                              <div class="form-group col-md-4 mt-3">
                                                <label for="fname2">First Name</label>
                                                <input type="text" class="form-control" name="fname2" id="fname2" placeholder="First Name">
                                              </div>
                                              <div class="form-group col-md-4 mt-3">
                                                <label for="lname2">Last Name</label>
                                                <input type="text" class="form-control"  name="lname2" id="lname2" placeholder="Last Name">
                                              </div>
                                              <div class="form-group col-md-4 mt-3">
                                                <label for="mobile2">Mobile</label>
                                                <input type="text" class="form-control"  name="mobile2" id="mobile2" placeholder="Mobile">
                                              </div>
                                            </div>
                                            <div class="form-row">
                                              <div class="form-group col-md-4">
                                                <label for="email2">Email Address</label>
                                                <input type="email" class="form-control" name="email2" id="email2" placeholder="Email Address">
                                              </div>
                                        
                                              <div class="form-group col-md-4">
                                                  <label for="gender">Gender</label>
                                                  <select class="form-select" aria-label="Default select example" name="gender2" id="gender2" >
                                                    <option class="opt1" value="" disabled selected hidden>Select Gender</option>
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                                  </select>
                                              </div>
                                          
                                              <div class="form-group col-md-4">
                                                  <label for="birthdate">Birth Date(Day/Month/Year)</label>
                                                  <input type="date" class="form-control" name="birthdate2" id="birthdate2" placeholder="Birth Date">   
                                              </div>
                                              </div>
                                        
                                            <div class="form-row">
                                              <div class="form-group col-md-12">
                                                <div class="form-group">
                                                  <label for="address">Address</label>
                                                    <input type="text" class="form-control mb-3" id="location" name="address" placeholder="Address">
                                                    <input type="hidden" name="location_lat2" id="location_lat2" value="">
                                                    <input type="hidden" name="location_lang2" id="location_lang2" value="">
                                                    <input type="hidden" name="city" id="city">
                                                    <input type="hidden" name="state" id="state">
                                                    <input type="hidden" name="region" id="region">
                                                    <input type="hidden" name="logs" id="logs">
                                                    <div id="map_canvas" style="width: 100%;height: 200px;"></div>
                                                  </div>
                                              </div>
                                            </div>
                                        
                                   
                                   
                                       
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                          </div>
                      </form>
                    </div>
                  </div>
              </div>
          </div>
                    
                          {{-- update modal --}}
                      
                      </td>
                      <td style="display:none;">{{$merchant ->gender}}</td>
                      <td style="display:none;">{{$merchant ->birthdate}}</td>
                      <td style="display:none;">{{$merchant ->address}}</td>
                      <td style="display:none;">{{$merchant ->lat}}</td>
                      <td style="display:none;">{{$merchant ->lng}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      
            <div class="mt-2">
              {{$merchants->render()}}
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
  
  
  
  
  
  <script type="text/javascript">
  
      var options = {
          map: "#canvass",
          country: 'ph',
          mapOptions: {
              streetViewControl: false
              //mapTypeId : google.maps.MapTypeId.HYBRID
          },
          markerOptions: {
              draggable: true
          }
      };
      $("#locations").geocomplete(options).bind("geocode:result", function(event, result){
          $('.pac-container').css('z-index', '9999');
          $('#defaults').hide();
          $('#canvass').show();
          $('#logss').html(result.formatted_address);
          $('#logss').val(result.formatted_address);
          $('.location-search').html(result.formatted_address)
          setCookie('posLat',result.geometry.location.lat(),'1');
          setCookie('posLan',result.geometry.location.lng(),'1');
          setCookie('address',result.formatted_address,'1');
          var map = $("#locations").geocomplete("map");
          map.setZoom(18);
          map.setCenter(result.geometry.location);
  
      });
      $("#locations").bind("geocode:dragged", function(event, latLng){
          $('.pac-container').css('z-index', '9999');
          console.log('Dragged Lat: '+latLng.lat());
          console.log('Dragged Lng: '+latLng.lng());
          var map = $("#locations").geocomplete("map");
          map.panTo(latLng);
          var geocoder = new google.maps.Geocoder();
          geocoder.geocode({'latLng': latLng }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  if (results[0]) {
                      console.log(results[0].formatted_address);
                      setCookie('posLat',latLng.lat(),'1');
                      setCookie('posLan',latLng.lng(),'1');
                      setCookie('address',results[0].formatted_address,'1');
                      $('#location_lats').val(latLng.lat());
                      $('#location_langs').val(latLng.lng());
                      var road = results[0].address_components[1].long_name;
                      var town = results[0].address_components[2].long_name;
                      var county = results[0].address_components[3].long_name;
                      var country = results[0].address_components[4].long_name;
                      $('#locations').val(results[0].formatted_address);
                      $('.location-search').val(results[0].formatted_address);
                      $('.location-search').html(results[0].formatted_address);
                  }
              }
          });
      });
      $("#pincode-suggestionss").geocomplete({
          details: ".geo-details",
          detailsAttribute: "data-geo"
  
      }).bind("geocode:result", function (event, result) {
          $("#latss").val(result.geometry.location.lat());
          $("#lngss").val(result.geometry.location.lng());
          var parsedResult=$(result.adr_address);
          var stateVal=parsedResult.filter('.region').text();
          var CityVal=parsedResult.filter('.locality').text();
          var Cn=parsedResult.filter('.country-name').text();
          var postal_code=parsedResult.filter('.postal-code').text();
          //alert(result.adr_address);
          //$('#pincode').text('Deliver To '+postal_code);
          $('#postal_codes').val(postal_code);
          $('#setting_countrys').val(Cn);
          $('#setting_states').val(stateVal);
  
          if(CityVal!=""){
              $("#setting_citys").val(CityVal);
          }
      });
  </script>
  
  <script type="text/javascript">
      // ** UPDATES FOR AUTOCOMPLETE <!-- FOR GET LOCATION -->//
      @php

       
          if (empty($product_data->lat)  && empty($product_data->lng) ) {
              $latitude = 14.6091;
              $longtitude = 121.0223;
          }else{
              $latitude = $product_data->lat;
              $longtitude = $product_data->lng;
          }
          
  
  
          @endphp
  
      function initialize() {
            var mapOptions = {
              center: new google.maps.LatLng(@php echo $latitude; @endphp, @php echo $longtitude; @endphp),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById('map_canvas'),
            mapOptions);
            var options = {  componentRestrictions: {country: "ph"} };
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input,options);
  
            autocomplete.bindTo('bounds', map);
  
  
            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                draggable: true,
            });
            google.maps.event.addListener(marker, 'dragend', function(evt) {
                  document.getElementById('location_lat').value = this.getPosition().lat();
                  document.getElementById('location_lang').value = this.getPosition().lng();
              });
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                infowindow.close();
                var place = autocomplete.getPlace();
  
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17); // Why 17? Because it looks good.
                }
  
                var image = new google.maps.MarkerImage(
                place.icon,
                new google.maps.Size(71, 71),
                new google.maps.Point(0, 0),
                new google.maps.Point(17, 34),
                new google.maps.Size(35, 35));
                marker.setIcon(image);
                marker.setPosition(place.geometry.location);
  
                var address = '';
                if (place.address_components) {
                    address = [(place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')].join(' ');
                }
  
                updateTextFields(place.geometry.location.lat(),place.geometry.location.lng());
  
                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address + "<br>" + place.geometry.location);
                infowindow.open(map, marker);
            });
  
            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            function setupClickListener(id, types) {
                var radioButton = document.getElementById(id);
                google.maps.event.addDomListener(radioButton, 'click', function () {
                    autocomplete.setTypes(types);
                });
            }
  
            setupClickListener('changetype-all', []);
            setupClickListener('changetype-establishment', ['establishment']);
            setupClickListener('changetype-geocode', ['geocode']);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
  
        function updateTextFields(lat, lng) {
            $('#location_lat').val(lat);
            $('#location_lang').val(lng);
        }
  </script>



<script type="text/javascript">
  
  var options = {
      map: "#canvass",
      country: 'ph',
      mapOptions: {
          streetViewControl: false
          //mapTypeId : google.maps.MapTypeId.HYBRID
      },
      markerOptions: {
          draggable: true
      }
  };
  $("#locations").geocomplete(options).bind("geocode:result", function(event, result){
      $('.pac-container').css('z-index', '9999');
      $('#defaults').hide();
      $('#canvass').show();
      $('#logss').html(result.formatted_address);
      $('#logss').val(result.formatted_address);
      $('.location-search').html(result.formatted_address)
      setCookie('posLat',result.geometry.location.lat(),'1');
      setCookie('posLan',result.geometry.location.lng(),'1');
      setCookie('address',result.formatted_address,'1');
      var map = $("#locations").geocomplete("map");
      map.setZoom(18);
      map.setCenter(result.geometry.location);

  });
  $("#locations").bind("geocode:dragged", function(event, latLng){
      $('.pac-container').css('z-index', '9999');
      console.log('Dragged Lat: '+latLng.lat());
      console.log('Dragged Lng: '+latLng.lng());
      var map = $("#locations").geocomplete("map");
      map.panTo(latLng);
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({'latLng': latLng }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                  console.log(results[0].formatted_address);
                  setCookie('posLat',latLng.lat(),'1');
                  setCookie('posLan',latLng.lng(),'1');
                  setCookie('address',results[0].formatted_address,'1');
                  $('#location_lats').val(latLng.lat());
                  $('#location_langs').val(latLng.lng());
                  var road = results[0].address_components[1].long_name;
                  var town = results[0].address_components[2].long_name;
                  var county = results[0].address_components[3].long_name;
                  var country = results[0].address_components[4].long_name;
                  $('#locations').val(results[0].formatted_address);
                  $('.location-search').val(results[0].formatted_address);
                  $('.location-search').html(results[0].formatted_address);
              }
          }
      });
  });
  $("#pincode-suggestionss").geocomplete({
      details: ".geo-details",
      detailsAttribute: "data-geo"

  }).bind("geocode:result", function (event, result) {
      $("#latss").val(result.geometry.location.lat());
      $("#lngss").val(result.geometry.location.lng());
      var parsedResult=$(result.adr_address);
      var stateVal=parsedResult.filter('.region').text();
      var CityVal=parsedResult.filter('.locality').text();
      var Cn=parsedResult.filter('.country-name').text();
      var postal_code=parsedResult.filter('.postal-code').text();
      //alert(result.adr_address);
      //$('#pincode').text('Deliver To '+postal_code);
      $('#postal_codes').val(postal_code);
      $('#setting_countrys').val(Cn);
      $('#setting_states').val(stateVal);

      if(CityVal!=""){
          $("#setting_citys").val(CityVal);
      }
  });
</script>

<script type="text/javascript">
  // ** UPDATES FOR AUTOCOMPLETE <!-- FOR GET LOCATION -->//
  @php

      if (empty($product_data->lat)  && empty($product_data->lng) ) {
          $latitude = 14.6091;
          $longtitude = 121.0223;
      }else{
          $latitude = $product_data->lat;
          $longtitude = $product_data->lng;
      }


      @endphp

  function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(@php echo $latitude; @endphp, @php echo $longtitude; @endphp),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas2'),
        mapOptions);
        var options = {  componentRestrictions: {country: "ph"} };
        var input = document.getElementById('location2');
        var autocomplete = new google.maps.places.Autocomplete(input,options);

        autocomplete.bindTo('bounds', map);


        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            draggable: true,
        });
        google.maps.event.addListener(marker, 'dragend', function(evt) {
              document.getElementById('location_lat2').value = this.getPosition().lat();
              document.getElementById('location_lang2').value = this.getPosition().lng();
          });
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            infowindow.close();
            var place = autocomplete.getPlace();

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17); // Why 17? Because it looks good.
            }

            var image = new google.maps.MarkerImage(
            place.icon,
            new google.maps.Size(71, 71),
            new google.maps.Point(0, 0),
            new google.maps.Point(17, 34),
            new google.maps.Size(35, 35));
            marker.setIcon(image);
            marker.setPosition(place.geometry.location);

            var address = '';
            if (place.address_components) {
                address = [(place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')].join(' ');
            }

            updateTextFields(place.geometry.location.lat(),place.geometry.location.lng());

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address + "<br>" + place.geometry.location);
            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            google.maps.event.addDomListener(radioButton, 'click', function () {
                autocomplete.setTypes(types);
            });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
    }
    google.maps.event.addDomListener(window, 'load', initialize);

    function updateTextFields(lat, lng) {
        $('#location_lat2').val(lat);
        $('#location_lang2').val(lng);
    }
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

          $('#fname2').val(data[1]);
          $('#lname2').val(data[2]);
          $('#mobile2').val(data[3]);
          $('#email2').val(data[4]);
          // $('#gender2').val(data[8]);
          // $('#gouv option[value="' + data[9].val +'"]').prop("selected", true);
          let ident = data[9].toString();
          // document.write(ident);
          $('#gender2 option[value="' + ident +'"]').prop("selected", true);
          $('#birthdate2').val(data[10]);
          $('#location').val(data[11]);
          $('#location_lat2').val(data[12]);
          $('#location_lang2').val(data[13]);


         
      });
  });
</script>

{{--  --}}
@endsection

