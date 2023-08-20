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

            <transition name="slide-fade">
                <section v-show="step === 1">
                    <form class="form" method="post" action="#" @submit.prevent="next">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center; color: #ffffff">Choose the Check-in and Out</h2>
                                </div>
                                <div class="col-md-12 my-5">
                                    <VDatePicker
                                        :columns="columns"
                                        expanded
                                        v-model.range="selectedDate"
                                        @change="handleDateChange"
                                        mode="dateTime"
                                        :rules="rules" />
                                </div>
                            </div>
                        </div>

                    <div class="form-group">
<!--                        <Datepicker
                            range
                            v-model="selectedDate"
                            show-picker-inital
                            lang="en"
                            @change="handleDateChange" />-->

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
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 style="text-align: center; color: #ffffff">Choose the rooms</h2>
                                </div>
                                <div class="col-md-12 my-5">
                            <Splide v-if="rooms.length > 0" :options="{ rewind: true }" aria-label="Vue Splide Example">
                                <SplideSlide v-for="(group, index) in groupedRooms" :key="index">
                                    <section class="hp-room-section">
                                        <div class="container-fluid">
                                            <div class="hp-room-items">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6" v-for="room in group" :key="room.id">
                                                        <input type="checkbox" name="room" class="image-radio">
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
                        </div>
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
                            <input type="email" v-model="customer.eMail" autocomplete="customer.eMail" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <input type="date" v-model="customer.birthDay" placeholder="Birthday ('day'/'month'/'year')" />
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
                            <input type="submit" value="Créer mon compte" />
                        </div>
                    </form>
                </section>
            </transition>
        </section>
        <section class="congrats register" v-if="hasSeenCongrats">
            <div class="register-icon">
                <img class="register-icon-item" src="https://vuejs.org/images/logo.png" alt="vue logo">

            </div>
            <h2 class="congrats-title">Thank you !</h2>
            <p class="congrats-subtitle">
                You have successfully created your account and joined the<br/>
                <strong>VueJS<br/>multiple steps form</strong>
            </p>
        </section>
</template>
<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import { fetchAvailableRooms } from './utils/api';


export default {
    props: {
        singleSelectedDate: String,
    },
    data() {
        return {
            isLoading: true,
            fullPage: true,
            calendarData: {},
            asset: 'assets/img/room/',
            selectedDate: [
                new Date(),
                new Date(new Date().getTime() + 9 * 24 * 60 * 60 * 1000)],
            steps: {},
            step: 1,
            rooms: [],
            customer: {
                gender: "1",
                firstName: "",
                lastName: "",
                phoneNumber: "",
                search: "",
                zipCode: "",
                city: "",
                birthDay: "",
                termOfService: "",
                pinCode: "",
                eMail: ""
            },
            hasSeenCongrats: false,
            tempCustomer: {
                gender: "",
                firstName: "",
                lastName: "",
                phoneNumber: "",
                search: "",
                zipCode: "",
                city: "",
                birthDay: "",
                termOfService: "",
                pinCode: "",
                eMail: ""
            },
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
                // This should be unnecessary if v-model is working correctly
                // Update the selectedDate with the new value
                this.selectedDate = newDate;
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
</style>
