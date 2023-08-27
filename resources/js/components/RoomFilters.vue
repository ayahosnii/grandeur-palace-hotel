<template>
    <div class="row">
        <div class="col-md-12">
            <div class="check-date">
                <label for="date-out">Check in-Out:</label>
                <VueDatePicker v-model="date" range @change="handleDateChange"/>

            </div>
        </div>
    </div>
    <div class="select-option">
        <div class="slider-box">
            <label for="priceRange">Price Range:</label>
            <div class="track-container">
                <span class="range-value min">{{ minValue}} </span> <span class="range-value max">{{ maxValue }}</span>
                <div class="track" ref="_vpcTrack"></div>
                <div class="track-highlight" ref="trackHighlight"></div>
                <button class="track-btn track1" ref="track1"></button>
                <button class="track-btn track2" ref="track2"></button>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="price-input" id="priceRangeMin"
                       v-model="minValue" @change="handleMinChange" readonly>
            </div>
            <div class="col-md-6">
                <input type="text" class="price-input" id="priceRangeMax"
                       v-model="maxValue" @change="handleMinChange" readonly>
            </div>
        </div>

    </div>
    <div class="select-option">
            <label>
                Room Type:
            </label>
                <select class="selections" v-model="selectedRoomType">
                    <option value="">All</option>
                    <option v-for="room in rooms" :key="room.id">{{ room.room_type }}</option>
                </select>
        </div>
    <div class="select-option">
            <label>
                Adults:
            </label>
        <vue-number-input v-model="selectedadults" :min="0" :max="10" inline controls></vue-number-input>


    </div>
    <button class="brown-btn" @click.prevent="applyFilters">Check Availability</button>

</template>


<script>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import Multiselect from '@vueform/multiselect';
import { fetchRooms, fetchServices } from '../utils/api';
import VuePriceRangeMixin from '../utils/priceRange.js';

export default {
    mixins: [VuePriceRangeMixin],
    props: {
        startDate: {
            type: [Date, String],
            default: null,
        },
    },

    emits: ['filtered-rooms'],

    data() {
        const currentDate = new Date();
        const minDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 2);
        const maxDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 29);

        return {
            selectedRoomType: '',
            selectedadults: '',
            selectedServices: [],
            options: [],
            selectedCheck: '',
            roomTypes: [],
            bedTypes: [],
            rooms: [],
            filteredRooms: [],
            date: [minDate, maxDate],
            minDate: minDate,
            maxDate: maxDate,
        };
    },
    components: { VueDatePicker, Multiselect },
    mounted() {
        this.fetchAllRooms();
        this.fetchServices();
        this.$emit('filtered-rooms', this.filteredRooms);
    },
    watch: {
        date(newDate){
            console.log('selectedDate changed:', newDate);
            this.fetchAvailableRooms();
        },
        computedRooms: {
            immediate: true,
            handler(newValue) {
                this.filteredRooms = newValue;
                this.$emit('filtered-rooms', this.filteredRooms);
            },
        },
        selectedRoomType: {
            immediate: true,
            handler() {
                this.updateComputedRooms();
            }
        },
        selectedadults: {
            immediate: true,
            handler() {
                this.updateComputedRooms();
            }
        },

        minValue: {
            immediate: true,
            handler() {
                console.log("minValue changed:", this.minValue);
                this.updateComputedRooms();
            }
        },
        maxValue: {
            immediate: true,
            handler() {
                console.log("minValue changed:", this.maxValue);
                this.updateComputedRooms();
            }
        },

        selectedServices: {
            immediate: true,
            handler() {
                this.updateComputedRooms();
            }
        },
    },
    methods: {
        fetchAvailableRooms() {
            axios.get('/api/check-rooms-availability', {
                params: {
                    check_in: this.date[0],
                    check_out: this.date[1],
                }
            })
                .then((response) => {
                    // Code to handle a successful response
                    console.log(this.date[0]);
                    console.log(this.date[1]);
                    this.rooms = response.data.rooms;
                    console.log(response.data.rooms);
                })
                .catch((error) => {
                    // Code to handle an error response
                    console.error(error);
                });
        },
        async fetchAllRooms() {
            try {
                const allRooms = await fetchRooms();
                this.rooms = allRooms;
                console.log(allRooms)
            } catch (error) {
                console.error(error);
            }
        },
        async fetchServices() {
            try {
                const services = await fetchServices();
                this.options = services;
            } catch (error) {
                console.error(error);
            }
        },

        handleDateChange(newDate) {
            this.date = newDate;
        },

        updateComputedRooms() {
            const filtered = this.computedRooms;
            this.filteredRooms = filtered;
            this.$emit('filtered-rooms', filtered);
        },


    },
    computed: {
        computedRooms() {
            console.log("computedRooms function is called");
            console.log("minValue:", this.minValue);
            console.log("maxValue:", this.maxValue);

            return this.rooms.filter((room) => {
                let matches = true;

                if (this.selectedRoomType && room.room_type !== this.selectedRoomType) {
                    matches = false;
                }

                 if (this.selectedadults && room.adults !== this.selectedadults) {
                    matches = false;
                }

                if (this.minValue && room.price_per_night < parseFloat(this.minValue)) {
                    matches = false;
                    console.log(`Filtered out room with price ${room.price_per_night} due to minValue ${this.minValue}`);
                }

                if (this.maxValue && room.price_per_night > parseFloat(this.maxValue)) {
                    matches = false;
                    console.log(`Filtered out room with price ${room.price_per_night} due to maxValue ${this.maxValue}`);
                }


/*
                if (this.selectedServices && this.selectedServices.length > 0) {
                    const serviceNames = room.services.map((service) => service.name);
                    const hasSelectedServices = this.selectedServices.every((serviceName) =>
                        serviceNames.includes(serviceName)
                    );

                    if (!hasSelectedServices) {
                        matches = false;
                    }
                }
*/

                return matches;
            });
        },
        serviceNames() {
            const allServiceNames = new Set();

            this.rooms.forEach((room) => {
                room.services.forEach((service) => {
                    allServiceNames.add(service.name);
                });
            });

            return Array.from(allServiceNames);
        },
        serviceOptions() {
            return this.options.map((service) => ({ name: service.name }));
        },
    },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
<style>
.range-value{
    position: absolute;
    top: -2rem;
}
.range-value.min{
    left: 0;
}

.range-value.max{
    right: 0;
}
.track-container{
    width: 100%;
    position: relative;
    cursor: pointer;
    height: 0.5rem;
}

.track,
.track-highlight {
    display: block;
    position: absolute;
    width: 100%;
    height: 0.5rem;
}

.track{
    background-color: #ddd;
}

.track-highlight{
    background-color: black;
    z-index: 2;
}

.track-btn{
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: none;
    cursor: pointer;
    display: block;
    position: absolute;
    z-index: 2;
    width: 1.5rem;
    height: 1.5rem;
    top: calc(-50% - 0.25rem);
    margin-left: -1rem;
    border: none;
    background-color: black;
    -ms-touch-action: pan-x;
    touch-action: pan-x;
    transition: box-shadow .3s ease-out,background-color .3s ease,-webkit-transform .3s ease-out;
    transition: transform .3s ease-out,box-shadow .3s ease-out,background-color .3s ease;
    transition: transform .3s ease-out,box-shadow .3s ease-out,background-color .3s ease,-webkit-transform .3s ease-out;
}
</style>
