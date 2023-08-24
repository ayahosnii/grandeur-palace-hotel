<template>
    <h1>Booked Rooms</h1>
    <FullCalendar ref="fullCalendar" :options="calendarOptions">
        <template v-slot:eventContent="arg">
            <b>{{ arg.timeText }}</b>
            <i>{{ arg.event.title }}</i>
        </template>
    </FullCalendar>
</template>

<script>
import axios from 'axios';
import { defineComponent } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import { createEventId } from './event-utils'

export default defineComponent({
    components: {
        FullCalendar,
    },
    data() {
        return {
            calendarOptions: {
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                weekends: true,
                selectMirror: true,
                dayMaxEvents: true,
                events: [],
            },
            currentEvents: [],
            bookings: []
        }
    },
    mounted() {
        this.fetchBookings()
    },
    methods: {
        fetchBookings() {
            axios
                .get('/api/all-bookings')
                .then((response) => {
                    this.bookings = response.data;
                    this.addBookingsToCalendar();
                    console.log(response.data);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        addBookingsToCalendar() {
            const calendarApi = this.$refs.fullCalendar.getApi();

            this.bookings.forEach((booking) => {
                calendarApi.addEvent({
                    title: `Room ${booking.room_id}`,
                    start: booking.check_in,
                    end: booking.check_out,
                });
            });
        },
        handleWeekendsToggle() {
            this.calendarOptions.weekends = !this.calendarOptions.weekends;
        },
    }
})
</script>

<style scoped>
</style>
