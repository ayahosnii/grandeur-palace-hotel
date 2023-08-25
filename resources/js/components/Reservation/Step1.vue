<template>
    <section>
        <form class="form" method="post" action="#" @submit.prevent="nextStep">
            <div class="form-group">
                <!-- Step 1 content here -->
                <h2 style="text-align: center; color: #ffffff">Choose the Check-in and Out</h2>
                <VDatePicker
                    :columns="columns"
                    expanded
                    v-model.range="selectedDate"
                    @change="handleDateChange"
                    mode="dateTime"
                    :rules="rules"
                />
                <p v-if="dateValidationError" class="error-message">{{ dateValidationError }}</p>
            </div>

            <div class="form-group">
                <div class="cta" data-style="see-through" data-alignment="right" data-text-color="custom">
                    <p class="cta-color">
            <span class="link_wrap">
              <input type="submit" value="Next" class="link_text"  />
              <span class="arrow-next"></span>
            </span>
                    </p>
                </div>
            </div>
        </form>
    </section>
</template>

<script>
import { fetchAvailableRooms } from '../../utils/api';

export default {
    props: {
        singleSelectedDate: String,
    },
    data() {
        return {
            calendarData: {},

            selectedDate: [
                new Date(),
                new Date(new Date().getTime() + 9 * 24 * 60 * 60 * 1000)],

            columns: [], // Define your columns data
            rules: [], // Define your validation rules
            dateValidationError: '', // Optional: to store the date validation error message
        };
    },
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
        handleDateChange(newDate) {
            this.selectedDate = newDate;

            // Optionally, perform validation or other actions based on the selected date
            if (newDate[0] > newDate[1]) {
                // Example validation: Check if the start date is greater than the end date
                this.dateValidationError = 'Start date cannot be greater than end date';
            } else {
                this.dateValidationError = ''; // Clear any previous validation error
            }
        },
        nextStep() {
            // Handle form submission for Step 1
            // Optionally, perform any necessary validation or data manipulation
            if (this.dateValidationError) {
                // If there's a validation error, prevent moving to the next step
                return;
            }

            // Emit an event to notify the parent component to move to the next step
            this.$emit('next');
        },
    },
};
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
