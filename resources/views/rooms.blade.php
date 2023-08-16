@extends('layouts.front-layout')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Our Rooms</h2>
                        <div class="bt-option">
                            <a href="./home.html">Home</a>
                            <span>Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="booking-form2">
                        <h3>Booking Details</h3>
                        <form action="#">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="check-date">
                                       <label for="date-in">Check In:</label>
                                       <input type="text" class="date-input" id="date-in">
                                       <i class="icon_calendar"></i>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="check-date">
                                       <label for="date-out">Check Out:</label>
                                       <input type="text" class="date-input" id="date-out">
                                       <i class="icon_calendar"></i>
                                   </div>
                               </div>
                           </div>
                            <div class="select-option">

                                <div class="slider-box">
                                    <label for="priceRange">Price Range:</label>
                                    <div id="price-range" class="slider"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="price-input" id="priceRangeMin" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="price-input" id="priceRangeMax" readonly>
                                        </div>
                                    </div>

                                </div>

                                <label for="guest">Guests:</label>
                                <select id="guest">
                                    <option value="">2 Adults</option>
                                    <option value="">3 Adults</option>
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="room">Room:</label>
                                <select id="room">
                                    <option value="">1 Room</option>
                                    <option value="">2 Room</option>
                                </select>
                            </div>
                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>
               <div class="col-md-8">
                   <div class="row">
                       @foreach($rooms as $room)
                           <div class="col-lg-6 col-md-6">
                               <div class="room-item">
                                   <img src="{{asset($room->image_url)}}" alt="">
                                   <div class="ri-text">
                                       <h4>{{$room->room_type}}</h4>
                                       <h3>{{$room->price_per_night}}<span>/Pernight</span></h3>
                                       <table>
                                           <tbody>
                                           <tr>
                                               <td class="r-o">Size:</td>
                                               <td>{{$room->size}}</td>
                                           </tr>
                                           <tr>
                                               <td class="r-o">Capacity:</td>
                                               <td>Max persion 3</td>
                                           </tr>
                                           <tr>
                                               <td class="r-o">Bed:</td>
                                               <td>King Beds</td>
                                           </tr>
                                           <tr>
                                               <td class="r-o">Services:</td>
                                               <td>Wifi, Television, Bathroom,...</td>
                                           </tr>
                                           </tbody>
                                       </table>
                                       <a href="#" class="primary-btn">More Details</a>
                                   </div>
                               </div>
                           </div>
                       @endforeach
                     {{--  <div class="col-lg-6 col-md-6">
                           <div class="room-item">
                               <img src="{{asset('assets/img/room/room-8.jpeg')}}" alt="">
                               <div class="ri-text">
                                   <h4>Deluxe Room</h4>
                                   <h3>159$<span>/Pernight</span></h3>
                                   <table>
                                       <tbody>
                                       <tr>
                                           <td class="r-o">Size:</td>
                                           <td>30 ft</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Capacity:</td>
                                           <td>Max persion 5</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Bed:</td>
                                           <td>King Beds</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Services:</td>
                                           <td>Wifi, Television, Bathroom,...</td>
                                       </tr>
                                       </tbody>
                                   </table>
                                   <a href="#" class="primary-btn">More Details</a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                           <div class="room-item">
                               <img src="img/room/room-3.jpg" alt="">
                               <div class="ri-text">
                                   <h4>Double Room</h4>
                                   <h3>159$<span>/Pernight</span></h3>
                                   <table>
                                       <tbody>
                                       <tr>
                                           <td class="r-o">Size:</td>
                                           <td>30 ft</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Capacity:</td>
                                           <td>Max persion 2</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Bed:</td>
                                           <td>King Beds</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Services:</td>
                                           <td>Wifi, Television, Bathroom,...</td>
                                       </tr>
                                       </tbody>
                                   </table>
                                   <a href="#" class="primary-btn">More Details</a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                           <div class="room-item">
                               <img src="img/room/room-4.jpg" alt="">
                               <div class="ri-text">
                                   <h4>Luxury Room</h4>
                                   <h3>159$<span>/Pernight</span></h3>
                                   <table>
                                       <tbody>
                                       <tr>
                                           <td class="r-o">Size:</td>
                                           <td>30 ft</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Capacity:</td>
                                           <td>Max persion 1</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Bed:</td>
                                           <td>King Beds</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Services:</td>
                                           <td>Wifi, Television, Bathroom,...</td>
                                       </tr>
                                       </tbody>
                                   </table>
                                   <a href="#" class="primary-btn">More Details</a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                           <div class="room-item">
                               <img src="img/room/room-5.jpg" alt="">
                               <div class="ri-text">
                                   <h4>Room With View</h4>
                                   <h3>159$<span>/Pernight</span></h3>
                                   <table>
                                       <tbody>
                                       <tr>
                                           <td class="r-o">Size:</td>
                                           <td>30 ft</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Capacity:</td>
                                           <td>Max persion 1</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Bed:</td>
                                           <td>King Beds</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Services:</td>
                                           <td>Wifi, Television, Bathroom,...</td>
                                       </tr>
                                       </tbody>
                                   </table>
                                   <a href="#" class="primary-btn">More Details</a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                           <div class="room-item">
                               <img src="img/room/room-6.jpg" alt="">
                               <div class="ri-text">
                                   <h4>Small View</h4>
                                   <h3>159$<span>/Pernight</span></h3>
                                   <table>
                                       <tbody>
                                       <tr>
                                           <td class="r-o">Size:</td>
                                           <td>30 ft</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Capacity:</td>
                                           <td>Max persion 2</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Bed:</td>
                                           <td>King Beds</td>
                                       </tr>
                                       <tr>
                                           <td class="r-o">Services:</td>
                                           <td>Wifi, Television, Bathroom,...</td>
                                       </tr>
                                       </tbody>
                                   </table>
                                   <a href="#" class="primary-btn">More Details</a>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-12">
                           <div class="room-pagination">
                               <a href="#">1</a>
                               <a href="#">2</a>
                               <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
                           </div>
                       </div>--}}
                   </div>
               </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

@endsection
@push('scripts')
    <script>
        $(function() {
            $("#price-range").slider({
                step: 500,
                range: true,
                min: 0,
                max: 20000,
                values: [0, 20000],
                slide: function(event, ui)
                {$("#priceRangeMin").val(ui.values[0]);
                    $("#priceRangeMax").val(ui.values[1]);}
            });
            $("#priceRange").val($("#price-range").slider("values", 0) + " - " + $("#price-range").slider("values", 1));

        });
    </script>
@endpush
