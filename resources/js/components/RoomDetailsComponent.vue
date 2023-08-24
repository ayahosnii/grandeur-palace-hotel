<template>
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

    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <div class="room-details-img" style="margin: 50px">
                            <div class="row">
                                <div class="col-md-6">
                                    <img :src="'http://localhost:8000/assets/admin/images/room_images/' +room.image" alt="">
                                </div>
                                <div class="col-md-6">
                                    <Splide v-if="room.images.length > 0" :options="{ rewind: true }" aria-label="Vue Splide Example">
                                        <SplideSlide v-for="(image, index) in room.images" :key="index">
                                            <img :src="'http://localhost:8000/assets/admin/images/room_images/' + image.image_path" :alt="image.id">
                                        </SplideSlide>
                                    </Splide>
                                </div>
                            </div>
                        </div>


                        <div class="rd-text">
                            <div class="rd-title">
                                <h3>{{ room.room_type }}</h3>
                                <div class="rdt-right">
                                    <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i>
                                    </div>
                                    <button type="button" @click="showModal = true">Booking Now</button>
                                    <Modal v-model="showModal" title="Book Your Room Now">
                                        <form novalidate="">
                                            <div class="form-group">
                                                <VDatePicker
                                                    expanded
                                                    v-model.range="selectedDate"
                                                    @change="handleDateChange"
                                                    mode="dateTime"
                                                    :rules="rules" />
                                            </div>
                                            <div class="form-group">
                                                <input id="inputEmail4" type="email" class="form-control" placeholder="Email" hidden="" v-bind:value="room.id">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input id="inputEmail4" type="text" class="form-control" placeholder="First Name">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="inputEmail4" type="text" class="form-control" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail4">Email</label>
                                                <input id="inputEmail4" type="email" class="form-control" placeholder="Email" hidden="" v-bind:value="room.id">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input id="inputEmail4" type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="inputEmail4" type="number" class="form-control" placeholder="Phone No.">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row modal-footer">
                                            <div class="col-sm-12">
                                                <div class="float-left">
                                                    <button class="btn btn-warning" type="button">Book Now!</button>
                                                </div>
                                                <div class="float-right">
                                                    <button class="btn btn-secondary ml-2" type="button">Cancel</button>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                    </Modal>
                                </div>
                            </div>
                            <h2>{{ room.price_per_night }}$<span>/Pernight</span></h2>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>{{ room.size }}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>Max person {{ room.adults }}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>{{ room.bed_type }}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td  v-for="service in room.services">
                                        {{service.name}}
                                        <i style="padding: 0px 5px;"
                                           :class="service.icon_class"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="f-para">Motorhome or Trailer that is the question for you. Here are some of the
                                advantages and disadvantages of both, so you will be confident when purchasing an RV.
                                When comparing Rvs, a motorhome or a travel trailer, should you buy a motorhome or fifth
                                wheeler? The advantages and disadvantages of both are studied so that you can make your
                                choice wisely when purchasing an RV. Possessing a motorhome or fifth wheel is an
                                achievement of a lifetime. It can be similar to sojourning with your residence as you
                                search the various sites of our great land, America.</p>
                            <p>The two commonly known recreational vehicle classes are the motorized and towable.
                                Towable rvs are the travel trailers and the fifth wheel. The rv travel trailer or fifth
                                wheel has the attraction of getting towed by a pickup or a car, thus giving the
                                adaptability of possessing transportation for you when you are parked at your campsite.
                            </p>
                        </div>
                    </div>
                    <div class="rd-reviews">
                        <h4>Reviews</h4>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-1.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <span>27 Aug 2019</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5>Brandon Kelley</h5>
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-2.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <span>27 Aug 2019</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5>Brandon Kelley</h5>
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="review-add">
                        <h4>Add Review</h4>
                        <form action="#" class="ra-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Booking Code*">
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <h5>You Rating:</h5>
                                        <div class="rating">
                                            <StarRating :star-size="15"/>
                                        </div>
                                    </div>
                                    <textarea placeholder="Your Review"></textarea>
                                    <button type="submit">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Your Reservation</h3>
                        <form action="#">
                            <div class="check-date">
                                <VDatePicker
                                    expanded
                                    v-model.range="selectedDate"
                                    @change="handleDateChange"
                                    mode="dateTime"
                                    :rules="rules" />
                            </div>
                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import StarRating from 'vue-star-rating'


import {Splide, SplideSlide} from "@splidejs/vue-splide";
import Loading from "vue-loading-overlay";

export default {
    props: {
        singleSelectedDate: String,
        roomId: Number,
    },
    data() {
        return {
            room: {},
            selectedDate: [
                new Date(),
                new Date(new Date().getTime() + 9 * 24 * 60 * 60 * 1000)],
        }
    },
    created() {
        this.fetchRooms();
    },
    components: { Splide, SplideSlide, StarRating},

    watch: {
        selectedDate(newDate) {
            console.log('selectedDate changed:', newDate);

            this.fetchAvailableRooms();
        }
    },
    methods: {
        fetchRooms() {
            axios
                .get('/api/rooms-details', {
                    params: {
                        roomId: this.roomId,
                    },
                })
                .then((response) => {
                    console.log('API Response:', response.data); // Log the API response
                    this.room = response.data[0]; // Assuming you expect a single room object
                    console.log('this.room:', this.room); // Log the assignment
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        fetchAvailableRooms() {
            axios.get('/api/check-room-availability', {
                params: {
                    check_in: this.selectedDate.start,
                    check_out: this.selectedDate.end,
                }
            })
                .then((response) => {
                    // Code to handle a successful response
                    console.log(this.selectedDate.start);
                    console.log(this.selectedDate.end);
                    this.rooms = response.data.rooms;
                    console.log(response.data.rooms);
                })
                .catch((error) => {
                    // Code to handle an error response
                    console.error(error);
                });
        },



        handleDateChange(newDate) {
            this.selectedDate = newDate;
            this.checkInDate = this.selectedDate[0];
        },

        checkRoomAvailability() {
            axios
                .get('/api/check-room-availability', {
                    params: {
                        checkInDate: this.checkInDate,
                        checkOutDate: this.checkOutDate,
                    },
                })
                .then((response) => {
                    this.roomAvailable = response.data.available;
                })
                .catch((error) => {
                    console.error('Error checking room availability:', error);
                });
        },
    },
}

</script>
<script setup>
import { useScreens } from 'vue-screen-utils';

const { mapCurrent } = useScreens({
    xs: '0px',
    sm: '700',
    md: '800',
    lg: '900',
});
const columns = mapCurrent({ lg: 2 }, 2);
const expanded = mapCurrent({ lg: false }, true);

import { ref } from 'vue'
// You can skip the import if you've registered the component globally
import { Modal } from '@kouts/vue-modal'

const showModal = ref(false)
</script>

<style scoped>

</style>
