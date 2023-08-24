<template>
    <div class="col-md-12 my-3">
        <h3 style="color: #c2a569">Click to Show Booked Days</h3>
        <VueDatePicker
            :columns="columns"
            expanded
            v-model.range="date"
            :markers="bookingMarkers"
            mode="dateTime"
        >
            <template #marker="{ marker, day, date }">
                <span class="custom-marker"></span>
            </template>
        </VueDatePicker>
    </div>
    <div class="col-md-12">
        <h3 style="color: #c2a569">Booking Details</h3>
        <table v-for="booking in booking" :key="booking.id"
               class="table display nowrap table-striped table-bordered scroll-horizontal">

            <thead>
            <tr>
                <th>Check-in</th>
                <th>Check-out</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ booking.check_in }}</td>
                <td>{{ booking.check_out }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';

import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import { ref, computed } from 'vue';
import addDays from 'date-fns/addDays';

export default {
    props: {
        singleSelectedDate: String,
        roomId: Number,
    },
    data() {
        return {
            isLoading: true,
            fullPage: true,
            calendarData: {},
            booking: [],
            asset: 'assets/admin/images/room_images',
            selectedDate: [
                new Date(),
                new Date(new Date().getTime() + 9 * 24 * 60 * 60 * 1000),
            ],
        };
    },
    created() {
        this.fetchBookings();
    },

    components: { Splide, SplideSlide, Loading },

    methods: {
        fetchBookings() {
            axios
                .get('/api/bookings', {
                    params: {
                        roomId: this.roomId,
                    },
                })
                .then((response) => {
                    this.booking = response.data;
                    console.log(response.data);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
    computed: {
        bookingMarkers() {
            // Generate markers based on the booking data
            return this.booking.flatMap((booking) => {
                const checkInDate = new Date(booking.check_in);
                const checkOutDate = new Date(booking.check_out);

                // Create an array of date markers for each day between check-in and check-out
                const markers = [];
                let currentDate = checkInDate;

                while (currentDate <= checkOutDate) {
                    markers.push({
                        date: new Date(currentDate),
                        type: 'dot',
                        color: 'green', // Customize the marker color
                        tooltip: [{ text: 'Booking ID: ' + booking.id, color: 'green' }],
                    });

                    // Move to the next day
                    currentDate = addDays(currentDate, 1);
                }

                return markers;
            });
        },
    },
};
</script>

<script setup>
import { useScreens } from 'vue-screen-utils';
import axios from 'axios';

const { mapCurrent } = useScreens({
    xs: '0px',
    sm: '900px',
    md: '1000px',
    lg: '1354px',
});
const columns = mapCurrent({ lg: 2 }, 2);
const expanded = mapCurrent({ lg: false }, true);

const date = ref(new Date());
</script>

<style>
.custom-marker {
    position: absolute;
    top: 0;
    right: 0;
    height: 8px;
    width: 8px;
    border-radius: 100%;
    background-color: rgba(161, 127, 58, 0.66);
}
</style>
