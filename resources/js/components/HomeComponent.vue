<template>
    <div class="booking-form">
        <h3>Search..</h3>
        <form action="#" @submit="redirectToLaravelRoute">
            <div class="check-date">
                <label for="date-in">Check In:</label>
                <VDatePicker
                    expanded
                    v-model.range="selectedDate"
                    @change="handleDateChange"
                    mode="dateTime"
                />
            </div>
            <button class="submit-form" type="submit">Check Availability</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selectedDate: [
                new Date(),
                new Date(new Date().getTime() + 9 * 24 * 60 * 60 * 1000)
            ],
            numValue: 0,
        };
    },

    mounted() {
        // You may or may not want to redirect on mount
    },
    watch: {
        selectedDate(newDate) {
            console.log('selectedDate changed:', newDate);
        },
    },

    methods: {
        handleDateChange(newDate) {
            this.selectedDate = newDate;
        },

        redirectToLaravelRoute() {
            console.log(this.selectedDate)
            // Construct the URL based on your selected data
            const checkIn = this.selectedDate.start.toISOString();

            const checkOut = this.selectedDate.end.toISOString();


            // Construct the URL as needed
            const url = `/rooms-search?check_in=${checkIn}&check_out=${checkOut}`;

            // Open a new window or tab with the constructed URL
            window.open(url, '_blank');
        },
    },
};
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
