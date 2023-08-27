<template>
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Booking</h2>
                        <div class="bt-option">
                            <a href="./home.html">Home</a>
                            <span>Booking</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <section class="register" v-if="!hasSeenCongrats">
            <div class="register-icon">
                <img class="register-icon-item" :src="`assets/admin/images/logo.png`" alt="vue logo">

            </div>

            <h2 class="register-title">Let's Booking</h2>

            <div class="register-stepper">
                <div class="step" :class="{'step-active' : step === 1, 'step-done': step > 1}"><span class="step-number">1</span></div>
                <div class="step" :class="{'step-active' : step === 2, 'step-done': step > 2}"><span class="step-number">2</span></div>
                <div class="step" :class="{'step-active' : step === 3, 'step-done': step > 3}"><span class="step-number">3</span></div>
            </div>

            <form class="form" action="#">

            <transition name="slide-fade" style="width: auto">
                <section v-show="step === 1">
                    <form class="form" method="post" action="#" @submit.prevent="next">
                        <h2 style="text-align: center; color: #ffffff">Choose the Check-in and Out</h2>
                        <div class="responsive-datepicker">
                            <VDatePicker
                                expanded
                                v-model.range="selectedDate"
                                @change="handleDateChange"
                                mode="dateTime"
                                :rules="rules"
                            />
                        </div>

                        <div class="form-group">
                            <div class="cta" data-style="see-through" data-alignment="right" data-text-color="custom">
                                <p class="cta-color">
              <span class="link_wrap">
                <input type="submit" value="Next" class="link_text" />
                <span class="arrow-next"></span>
              </span>
                                </p>
                            </div>
                        </div>
                    </form>
                </section>
            </transition>
            <transition name="slide-fade">
                <section v-show="step === 2">
                    <form class="form" method="post" action="#" @submit.prevent="next">
                        <h2 style="text-align: center; color: #ffffff">Choose the rooms</h2>
                        <Splide v-if="rooms.length > 0" :options="{ rewind: true }" aria-label="Vue Splide Example">
                            <SplideSlide v-for="(group, index) in groupedRooms" :key="index">
                                <section class="hp-room-section">
                                    <div class="container-fluid">
                                        <div class="hp-room-items">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6" v-for="room in group" :key="room.id">
                                                    <input type="checkbox" name="room" class="image-radio" @click="toggleRoomSelection(room.id)">
                                                    <div class="hp-room-item set-bg" :data-setbg="`${asset}/${room.image}`"  :style="'background-image: url(' + asset + '/' + room.image + ')'">
                                                        <div class="hr-text">
                                                            <h3>{{ room.room_type }}</h3>
                                                            <h2>{{ room.price_per_night }}$<span>/Per night</span></h2>
                                                            <a href="#" class="primary-btn">More Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </SplideSlide>
                        </Splide>
                        <div v-else>
                            <loading v-model:active="isLoading"
                                     :can-cancel="true"
                                     :on-cancel="onCancel"
                                     :is-full-page="fullPage"/>

                            <h2 class="register-title">No room is available</h2>

                        </div>

                        <div class="form-group cta-step">
                            <div class="cta prev">
                                <p class="cta-color">
								<span class="link_wrap">
									<a class="link_text" href="#" @click.prevent="prev()"><span class="arrow-prev"></span>Previous
									</a>
								</span>
                                </p>
                            </div>
                            <div class="cta">
                                <p class="cta-color">
                                    <span class="text"></span>
                                    <span class="link_wrap">
									<input type="submit" value="Next" class="link_text" />
									<span class="arrow-next"></span>
								</span>
                                </p>
                            </div>
                        </div>
                    </form>
                </section>
            </transition>
            <transition name="slide-fade">
                <section v-show="step === 3">
                    <form class="form" action="#" @submit.prevent="customerRegister">
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="text" v-model="customer.firstName" autocomplete="customer.firstName" @input="handleFirstNameInput" placeholder="First Name" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" v-model="customer.lastName" autocomplete="customer.lastName" @input="handleLastNameInput" placeholder="Last Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="email" v-model="customer.eMail" autocomplete="customer.eMail" @input="handleEMailInput" placeholder="Email" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" v-model="customer.phoneNumber" autocomplete="customer.phoneNumber" @input="handlePhoneNumberInput" placeholder="Phone Number" />
                            </div>
                        </div>

                        <div class="form-group cta-step">
                            <div class="cta prev">
                                <p class="cta-color">
								<span class="link_wrap">
									<a class="link_text" href="#" @click.prevent="prev()"><span class="arrow-prev"></span>Previous
									</a>
								</span>
                                </p>
                            </div>
                        </div>
                        <div class="register-btn">
                            <input type="submit" value="Book Now!" @click="bookRoom"/>
                        </div>
                    </form>
                </section>
            </transition>
            </form>
        </section>
        <section class="congrats register" v-if="hasSeenCongrats">
            <div class="register-icon">
                <img class="register-icon-item" src="https://vuejs.org/images/logo.png" alt="vue logo">

            </div>
            <h2 class="congrats-title">Thank you !</h2>
            <p class="congrats-subtitle">
                You have successfully booked your room/s<br/>
                <strong>Grandeur Palace<br/>Hotel</strong>
            </p>
        </section>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import { fetchAvailableRooms } from './utils/api';
import {useToast} from "vue-toast-notification";
const $toast = useToast();


export default {
    props: {
        singleSelectedDate: String,
    },
    data() {
        return {
            isLoading: true,
            fullPage: true,
            calendarData: {},
            selectedRooms: [],
            asset: 'assets/admin/images/room_images',
            selectedDate: [
                new Date(),
                new Date(new Date().getTime() + 9 * 24 * 60 * 60 * 1000)],
            steps: {},
            step: 1,
            rooms: [],
            customer: {
                firstName: "",
                lastName: "",
                phoneNumber: "",
                eMail: ""
            },
            hasSeenCongrats: false,
        };
    },
    components: { Splide, SplideSlide, Loading},
    created() {
        this.fetchAvailableRooms();
    },
    mounted() {
        this.fetchAvailableRooms();
    },
    watch: {
        selectedDate(newDate) {
            console.log('selectedDate changed:', newDate);

            this.fetchAvailableRooms();
        }
    },
    methods: {
        toggleRoomSelection(roomId) {
            // Check if roomId is already in the selectedRooms array
            const index = this.selectedRooms.indexOf(roomId);

            if (index === -1) {
                // If not in the array, add it
                this.selectedRooms.push(roomId);
            } else {
                // If already in the array, remove it
                this.selectedRooms.splice(index, 1);
            }

            // Log or use this.selectedRooms as needed
            console.log("Selected Room IDs:", this.selectedRooms);

            // Example: If you want to emit an event to a parent component, you can use this.$emit
            this.$emit("rooms-selected", this.selectedRooms);
        },

        handleFirstNameInput()
        {
            console.log("Selected Room IDs:", this.customer.firstName);
        },

        handleLastNameInput()
        {
            console.log("Selected Room IDs:", this.customer.lastName);
        },

        handleEMailInput()
        {
            console.log("Selected Room IDs:", this.customer.eMail);
        },
        handlePhoneNumberInput()
        {
            console.log("Selected Room IDs:", this.customer.phoneNumber);
        },

        bookRoom() {
            console.log("Selected Rooms:", this.selectedRooms);
            console.log("Check-in Date:", this.selectedDate.start);
            console.log("Check-out Date:", this.selectedDate.end);
            console.log("Customer Data:", this.customer);
            axios.post('/api/bookings/store', {
                roomId: this.selectedRooms,
                check_in: this.checkInDate,
                check_out: this.checkOutDate,
                customer: {
                    firstname: this.customer.firstName,
                    lastname: this.customer.lastName,
                    email: this.customer.eMail,
                    phone: this.customer.phoneNumber,
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

        doAjax() {
            this.isLoading = true;

            setTimeout(() => {
                this.isLoading = false
            }, 5000)
        },
        onCancel() {
            console.log('User cancelled the loader.')
        },
        fetchAvailableRooms() {
            axios.get('/api/check-rooms-availability', {
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
                // This should be unnecessary if v-model is working correctly
                // Update the selectedDate with the new value
                this.selectedDate = newDate;
            },
        checkRoomsAvailability() {
            axios
                .get('/api/check-rooms-availability', {
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

        prev() {
            this.step--;
        },

        next() {
            this.step++;
        },

        customerRegister: function () {
            this.hasSeenCongrats = true;
        }
    },

    computed: {
        groupedRooms() {
            const groupSize = 4;
            const groups = [];

            for (let i = 0; i < this.rooms.length; i += groupSize) {
                groups.push(this.rooms.slice(i, i + groupSize));
            }

            return groups;
        },
    },

}
</script>
<script setup>
import { useScreens } from 'vue-screen-utils';

const { mapCurrent } = useScreens({
    xs: '0px',
    sm: '900px',
    md: '1000px',
    lg: '1354px',
});
const columns = mapCurrent({ lg: 2 }, 2);
const expanded = mapCurrent({ lg: false }, true);
</script>
<style lang="scss">
@import "../css/reservation.scss";

.hp-room-items .hp-room-item{
    width: 400px;
    height: 400px;
}

.hp-room-section input{
    padding: 0;
    height: initial;
    width: initial;
    margin-bottom: 0;
    cursor: pointer;
}

.hp-room-section input:checked + label:after {
    content: '';
    display: block;
    position: absolute;
    top: 2px;
    left: 9px;
    width: 6px;
    height: 14px;
    border: solid rgba(161, 127, 58, 0.89);
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.responsive-datepicker {
    width: 100%; /* Make the date picker take 100% width of its container */
}
</style>
