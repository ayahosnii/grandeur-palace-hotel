<template>
    <div class="col-md-6 bg-dark d-flex align-items-center">
        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
            <h1 class="text-white mb-4">Book A Table Online</h1>

            <div class="form-check my-4">
                <input class="form-check-input" type="radio" id="bookTable" v-model="selectedOption" value="bookTable">
                <label class="form-check-label" for="bookTable">Book a Table</label>

                <input class="form-check-input" type="radio" id="writeReview" v-model="selectedOption" value="writeReview">
                <label class="form-check-label" for="writeReview">Write a Review</label>

                <input class="form-check-input" type="radio" id="contactRestaurant" v-model="selectedOption" value="contactRestaurant">
                <label class="form-check-label" for="contactRestaurant">Contact Restaurant</label>
            </div>

            <!-- Add the form fields here based on the selectedOption -->
            <form @submit.prevent="submitForm">
                <div class="row g-3">
                    <div class="col-md-6" v-if="selectedOption !== 'writeReview'">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" v-model="name" placeholder="Your Name">
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="col-md-6" v-if="selectedOption !== 'writeReview'">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" v-model="email" placeholder="Your Email">
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <div class="col-md-6" v-if="selectedOption === 'writeReview'">
                        <input v-model="bookingCode" type="text" class="form-control" placeholder="Booking Code*">
                    </div>
                    <div class="col-md-6" v-if="selectedOption === 'writeReview'">
                        <div class="form-floating date" id="date3" data-target-input="nearest">
                            <!-- Show the StarRating component when isReview is true -->
                            <star-rating v-if="isReview" @update:rating="setRating" :star-size="25" />
                        </div>
                    </div>
                    <div class="col-md-6" v-if="selectedOption === 'bookTable'">
                        <div class="form-floating date" id="date3" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" id="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" v-model="selectedDateTime">
                            <label for="datetime">Date</label>
                        </div>
                    </div>
                    <div class="col-md-6" v-if="selectedOption === 'bookTable'">
                        <div class="form-floating">
                            <select class="form-select" id="select1" v-model="numberOfPeople">
                                <option value="1">People 1</option>
                                <option value="2">People 2</option>
                                <option value="3">People 3</option>
                                <option value="4">People 4</option>
                                <option value="5">People 5</option>
                                <option value="6">People 6</option>
                            </select>
                            <label for="select1">No Of People</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" v-model="message" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                            <label for="message">Special Request</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import StarRating from 'vue-star-rating';
import { useToast } from 'vue-toast-notification';

const $toast = useToast();

export default {
    props: {
        singleSelectedDate: String,
    },
    data() {
        return {
            name: '',
            email: '',
            selectedOption: 'bookTable',
            message: '',
            isReview: true, // Change 'true' to true
            bookingCode: '',
            rating: 0,
            selectedDateTime: '',
            numberOfPeople: 1,
        };
    },

    components: { StarRating },

    methods: {
        setRating(rating) {
            this.rating = rating;
        },

        fetchTables() {
            axios
                .get('/api/tables')
                .then((response) => {
                    console.log('API Response:', response.data);
                    this.tables = response.data[0];
                })
                .catch((error) => {
                    console.error(error);
                });
        },


        submitForm() {
            if (this.selectedOption === 'writeReview') {
                // Handle the review submission
                if (!this.bookingCode || !this.rating || !this.message) {
                    $toast.warning('Please fill in all review fields');
                    return;
                }

                axios
                    .post('/api/storeReviews', {
                        bookingCode: this.bookingCode,
                        rating: this.rating,
                        message: this.message,
                        rating_type: 3
                    })
                    .then((response) => {
                        console.log('Review submitted successfully');
                        $toast.success('Review submitted successfully');
                        console.log(response);
                        this.bookingCode = '';
                        this.ratingValue = 0;
                        this.message = '';
                    })
                    .catch((error) => {
                        console.error('Error submitting review:', error);
                        $toast.error('Error submitting review:', error);
                        console.error(error.response.data.message);
                    });
            } else if (this.selectedOption === 'contactRestaurant') {
                // Handle the contact form submission
                if (!this.name || !this.email || !this.message) {
                    $toast.warning('Please fill in all contact fields');
                    return;
                }

                axios
                    .post('/api/contact', {
                        name: this.name,
                        email: this.email,
                        message: this.message,
                    })
                    .then((response) => {
                        console.log(response);
                        $toast.success('Contact message sent successfully');
                        // Reset form fields
                        this.name = '';
                        this.email = '';
                        this.message = '';
                    })
                    .catch((error) => {
                        console.error('Error sending contact message:', error);
                        $toast.error('Error sending contact message:', error);
                    });
            } else if (this.selectedOption === 'bookTable') {
                // Handle the "Book a Table" option
                if (!this.selectedDateTime || !this.numberOfPeople) {
                    $toast.warning('Please fill in all table booking fields');
                    return;
                }

                axios
                    .post('/api/bookTable', {
                        name: this.name,
                        email: this.email,
                        selectedDateTime: this.selectedDateTime,
                        numberOfPeople: this.numberOfPeople,
                        message: this.message,
                    })
                    .then((response) => {
                        console.log('Table booked successfully');
                        $toast.success('Table booked successfully');
                        console.log(response);
                        this.selectedDateTime = '';
                        this.numberOfPeople = 1;
                        this.message = '';
                    })
                    .catch((error) => {
                        console.error('Error booking table:', error);
                        $toast.error('Error booking table:', error);
                        console.error(error.response.data.message);
                    });
            }
        },
    },
};
</script>

<style scoped>
/* Add your component-specific styles here if needed */
</style>
