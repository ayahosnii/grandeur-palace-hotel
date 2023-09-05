<template>
    <div class="row">
        <div class="col-lg-6">
            <div class="about-pic">
                <div class="row">
                    <div class="col-md-12">
                        <img style="height: 500px" :src="'assets/img/about/the-hotel2.jpg'" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-text">
                        <div class="section-title">
                            <span>Contact US </span>
                            <h2>Contact <br />Or Review US</h2>
                        </div>
                        <form @submit.prevent="submitForm" class="ra-form">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6 my-3">
                                        <input v-if="isReview === 'false'" v-model="name" type="text" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <input v-if="isReview === 'false'" v-model="email" type="text" class="form-control" placeholder="Email">
                                    </div>

                                    <div class="col-sm-6 my-3">
                                        <input v-if="isReview === 'true'" v-model="bookingCode" type="text" class="form-control" placeholder="Booking Code*">
                                    </div>
                                    <div class="col-sm-6 my-3">
                                        <StarRating v-if="isReview === 'true'" @update:rating="setRating" :star-size="25" />
                                    </div>
                                    <div class="col-md-6 my-3">
                                        <label>Review</label>
                                        <input v-model="isReview" type="radio" value="true">
                                    </div>
                                    <div class="col-md-6 my-3">
                                        <label>Contact</label>
                                        <input v-model="isReview" type="radio" value="false">
                                    </div>
                                    <div class="col-sm-12 my-3">
                                        <textarea v-model="newComment" class="form-control" placeholder="Message" rows="4" cols="50"></textarea>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="room-btn">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import StarRating from "vue-star-rating";
import { useToast } from "vue-toast-notification";

const $toast = useToast();

export default {
    props: {
        singleSelectedDate: String,
    },
    data() {
        return {
            name: "",
            email: "",
            message: "",
            isReview: "true",
            bookingCode: "",
            rating: 0,
        };
    },

    components: { StarRating },

    methods: {
        setRating(rating) {
            this.rating = rating;
        },

        submitForm() {
            if (this.isReview === "true") {
                // Handle the review submission
                if (!this.rating || !this.newComment) {
                    $toast.warning("Please fill in all review fields");
                    return;
                }

                axios
                    .post('/api/storeReviews', {
                        bookingCode: this.bookingCode,
                        rating: this.rating,
                        newComment: this.newComment,
                        rating_type: 1
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
            } else {
                // Handle the contact form submission
                if (!this.name || !this.email || !this.message) {
                    $toast.warning("Please fill in all contact fields");
                    return;
                }

                axios
                    .post("/api/contact", {
                        name: this.name,
                        email: this.email,
                        message: this.message,
                    })
                    .then((response) => {
                        console.log("Contact message sent successfully");
                        $toast.success("Contact message sent successfully");
                        // Reset form fields
                        this.name = "";
                        this.email = "";
                        this.message = "";
                    })
                    .catch((error) => {
                        console.error("Error sending contact message:", error);
                        $toast.error("Error sending contact message:", error);
                    });
            }
        },
    },
};
</script>


<style scoped>

</style>
