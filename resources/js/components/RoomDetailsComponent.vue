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
                                    <div class="rating" >
                                        <StarRating :rating="4" :read-only="true" :increment="0.5" star-size="25" />
                                    </div>
                                    <button type="button" @click="showModal = true">Booking Now</button>
                                    <Modal v-model="showModal" title="Book Your Room Now">
                                        <form @submit.prevent="bookRoom">
                                            <div class="form-group">
                                                <VDatePicker
                                                    v-model.range="selectedDate"
                                                    @change="handleDateChange"
                                                    mode="dateTime"
                                                    :rules="rules"
                                                />
                                            </div>
                                            <div class="form-group">
                                                <input v-model="firstName" type="text" class="form-control" placeholder="First Name">
                                                <input v-model="lastName" type="text" class="form-control" placeholder="Last Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Email</label>
                                                <input v-model="email" id="inputEmail" type="email" class="form-control" placeholder="Email">
                                                <input v-model="phone" type="number" class="form-control" placeholder="Phone No.">
                                                <input v-bind:value="room.id" type="hidden">
                                            </div>
                                            <div class="row modal-footer">
                                                <div class="col-sm-12">
                                                    <div class="float-left">
                                                        <button type="submit" class="btn btn-warning">Book Now!</button>
                                                        <button type="button" @click="closeAndResetModal" class="btn btn-secondary">Close</button>
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
                        <div class="review-item" v-for="client in clients" :key="client.id">
                            <div class="ri-pic">
                                <img :key="client.id" src="http://localhost:8000/assets/img/room/avatar/456322.webp" alt="">
                            </div>
                            <div class="ri-text">
                                <h5>{{ client.firstname }} {{ client.lastname }}</h5>
                                <div v-for="booking in client.bookings" :key="booking.id">
                                    <div v-for="review in booking.reviews" :key="review.id">
                                        <span>{{ review.created_at }}</span> <!-- Move this line here -->
                                        <div class="rating">
                        <span v-for="review in booking.reviews" :key="review.id">
                            <StarRating :rating="review.rating" :read-only="true" :increment="0.5" star-size="25" />
                        </span>
                                        </div>
                                        <p v-for="review in booking.reviews" :key="review.id">{{ review.review_text }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="review-add">
                        <h4>Add Review</h4>
                        <form @submit.prevent="postStoreReviews" class="ra-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" v-model="bookingCode" placeholder="Booking Code*" />
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <h5>You Rating:</h5>
                                        <div class="rating">
                                            <StarRating @update:rating ="setRating" :star-size="25" />

                                        </div>
                                    </div>
                                    <textarea v-model="newComment" placeholder="Your Review"></textarea>
                                    <button type="submit" >Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Check The Room Availability</h3>
                        <form action="#">
                            <div class="check-date">
                                <VDatePicker
                                    expanded
                                    v-model.range="selectedDate"
                                    @change="handleDateChange"
                                    mode="dateTime"
                                     />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import StarRating from 'vue-star-rating'

import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
const $toast = useToast();


import {Splide, SplideSlide} from "@splidejs/vue-splide";
import Loading from "vue-loading-overlay";

export default {
    props: {
        singleSelectedDate: String,
        roomId: Number,
        customersWithReviews: Array, // The array of customers with reviews
        averageRatingForAll: Number, // The average rating for all reviews
    },
    data() {
        return {
            showModal: false,
            firstName: '',
            lastName: '',
            email: '',
            phone: '',
            room: {},
            rating: 0,
            clients: [],
            averageRating: [],
            newComment: '',
            bookingCode: '',
            selectedDate: [
                new Date(),
                new Date(new Date().getTime() + 9 * 24 * 60 * 60 * 1000)],
        }
    },
    mounted() {
        this.setRating()
    },

    created() {
        this.fetchRooms();
        this.fetchReviews();
        console.log('Data in clients:', this.clients);
    },
    components: { Splide, SplideSlide, StarRating},

    watch: {
        selectedDate(newDate) {
            console.log('selectedDate changed:', newDate);

            this.fetchAvailableRooms();
        },
        rating(newRating) {
            console.log('Rating changed to:', newRating);
        },
    },
    methods: {
        bookRoom() {
            axios.post('/api/bookings/store', {
                roomId: this.roomId,
                check_in: this.selectedDate.start,
                check_out: this.selectedDate.end,
                customer: {
                    firstname: this.firstName,
                    lastname: this.lastName,
                    email: this.email,
                    phone: this.phone,
                },
            })
                .then(response => {
                    console.log(response.data.message);
                    $toast.success(response.data.message);
                })
                .catch(error => {
                    console.error(error);
                    $toast.info(error.response.data.message);
                });
        },
        setRating(rating){
            this.rating= rating;
            console.log(rating)
        },
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
            axios.get('/api/check-the-room-availability', {
                params: {
                    roomId: this.roomId,
                    check_in: this.selectedDate.start,
                    check_out: this.selectedDate.end,
                }
            })
                .then((response) => {
                    // Code to handle a successful response
                    console.log(this.selectedDate.start);
                    console.log(this.selectedDate.end);
                    this.rooms = response.data.rooms;
                    console.log(response.data);
                    $toast.info(response.data.message);
                })
                .catch((error) => {
                    // Code to handle an error response
                    console.error(error);
                });
        },

        fetchReviews() {
            axios.get('/api/reviews')
                .then((response) => {
                    console.log('Review submitted successfully');
                    console.log(response);
                    this.clients = response.data.customersWithReviews;
                    this.averageRating = response.data.averageRatingForAll;
                    console.log(this.clients)
                })
                .catch((error) => {
                    console.error('Error submitting review:', error);
                    console.error(error.response.data.message);
                });
        },


        handleDateChange(newDate) {
            this.selectedDate = newDate;
            this.checkInDate = this.selectedDate[0];
        },

        checkTheRoomsAvailability() {
            axios
                .get('/api/check-the-room-availability', {
                    params: {
                        roomId: this.roomId,
                        checkInDate: this.checkInDate,
                        checkOutDate: this.checkOutDate,
                    },
                })
                .then((response) => {
                    this.roomAvailable = response.data;
                    console.log(this.roomAvailable)
                })
                .catch((error) => {
                    console.error('Error checking room availability:', error);
                });
        },

        postStoreReviews() {
            console.log(this.rating)
            // Validation: Ensure booking code and review are not empty
            if (!this.bookingCode || !this.newComment) {
                $toast.warning('Please fill in all fields');
                return;
            }


            axios
                .post('http://127.0.0.1:8000/api/storeReviews', {
                    bookingCode: this.bookingCode,
                    rating: this.rating,
                    newComment: this.newComment,
                    roomId: this.roomId,
                })
                .then((response) => {
                    console.log('Review submitted successfully');
                    $toast.success('Review submitted successfully');
                    console.log(response);
                    this.bookingCode = '';
                    this.ratingValue = 0;
                    this.newComment = '';
                })
                .catch((error) => {
                    console.error('Error submitting review:', error);
                    $toast.error('Error submitting review:', error);
                    console.error(error.response.data.message);
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
