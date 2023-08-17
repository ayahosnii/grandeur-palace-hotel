<template>

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
                            <room-filters @filters-applied="fetchFilteredRooms"></room-filters>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">

                        <div v-for="room in rooms" :key="room.id" class="col-lg-6 col-md-6">
                            <div class="room-item">
                                <img :src="`${asset}/${room.image}`" alt="">
                                <div class="ri-text">
                                    <h4></h4>
                                    <h3>{{room.price_per_night}}<span>/Pernight</span></h3>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>{{room.size}}</td>
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
<!--                        <div class="col-lg-6 col-md-6">-->
<!--                        <div class="room-item">-->
<!--                            <img src="" alt="">-->
<!--                            <div class="ri-text">-->
<!--                                <h4>Deluxe Room</h4>-->
<!--                                <h3>159$<span>/Pernight</span></h3>-->
<!--                                <table>-->
<!--                                    <tbody>-->
<!--                                    <tr>-->
<!--                                        <td class="r-o">Size:</td>-->
<!--                                        <td>30 ft</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td class="r-o">Capacity:</td>-->
<!--                                        <td>Max persion 5</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td class="r-o">Bed:</td>-->
<!--                                        <td>King Beds</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td class="r-o">Services:</td>-->
<!--                                        <td>Wifi, Television, Bathroom,...</td>-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                                <a href="#" class="primary-btn">More Details</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                        <div class="col-lg-6 col-md-6">-->
<!--                            <div class="room-item">-->
<!--                                <img src="img/room/room-3.jpg" alt="">-->
<!--                                <div class="ri-text">-->
<!--                                    <h4>Double Room</h4>-->
<!--                                    <h3>159$<span>/Pernight</span></h3>-->
<!--                                    <table>-->
<!--                                        <tbody>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Size:</td>-->
<!--                                            <td>30 ft</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Capacity:</td>-->
<!--                                            <td>Max persion 2</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Bed:</td>-->
<!--                                            <td>King Beds</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Services:</td>-->
<!--                                            <td>Wifi, Television, Bathroom,...</td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                    <a href="#" class="primary-btn">More Details</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-lg-6 col-md-6">-->
<!--                            <div class="room-item">-->
<!--                                <img src="img/room/room-4.jpg" alt="">-->
<!--                                <div class="ri-text">-->
<!--                                    <h4>Luxury Room</h4>-->
<!--                                    <h3>159$<span>/Pernight</span></h3>-->
<!--                                    <table>-->
<!--                                        <tbody>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Size:</td>-->
<!--                                            <td>30 ft</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Capacity:</td>-->
<!--                                            <td>Max persion 1</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Bed:</td>-->
<!--                                            <td>King Beds</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Services:</td>-->
<!--                                            <td>Wifi, Television, Bathroom,...</td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                    <a href="#" class="primary-btn">More Details</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-lg-6 col-md-6">-->
<!--                            <div class="room-item">-->
<!--                                <img src="img/room/room-5.jpg" alt="">-->
<!--                                <div class="ri-text">-->
<!--                                    <h4>Room With View</h4>-->
<!--                                    <h3>159$<span>/Pernight</span></h3>-->
<!--                                    <table>-->
<!--                                        <tbody>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Size:</td>-->
<!--                                            <td>30 ft</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Capacity:</td>-->
<!--                                            <td>Max persion 1</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Bed:</td>-->
<!--                                            <td>King Beds</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Services:</td>-->
<!--                                            <td>Wifi, Television, Bathroom,...</td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                    <a href="#" class="primary-btn">More Details</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-lg-6 col-md-6">-->
<!--                            <div class="room-item">-->
<!--                                <img src="img/room/room-6.jpg" alt="">-->
<!--                                <div class="ri-text">-->
<!--                                    <h4>Small View</h4>-->
<!--                                    <h3>159$<span>/Pernight</span></h3>-->
<!--                                    <table>-->
<!--                                        <tbody>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Size:</td>-->
<!--                                            <td>30 ft</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Capacity:</td>-->
<!--                                            <td>Max persion 2</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Bed:</td>-->
<!--                                            <td>King Beds</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="r-o">Services:</td>-->
<!--                                            <td>Wifi, Television, Bathroom,...</td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                    <a href="#" class="primary-btn">More Details</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
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

</template>

<script>
import axios from 'axios';

    export default {
        data() {
            return {
                rooms: [],
                asset: 'assets/img/room/'
            };
        },
        mounted() {
            console.log('Component mounted.')
            this.fetchFilteredRooms()
        },
        methods: {
           async fetchFilteredRooms(filters) {
               await axios.get('/api/rooms', { params: filters })
                    .then(response => {
                        this.rooms = response.data;
                        console.log(this.rooms)
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
        },

    }
</script>
