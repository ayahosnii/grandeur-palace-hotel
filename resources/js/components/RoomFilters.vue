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
            <div id="price-range" class="slider"></div>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="price-input" id="priceRangeMin"
                           v-model="selectedPriceMin" @change="handleMinChange" readonly>
                </div>
                <div class="col-md-6">
                    <input type="text" class="price-input" id="priceRangeMax"
                           v-model="selectedPriceMax" @change="handleMinChange" readonly>
                </div>
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
        <vue-number-input v-model="selectedadults" :min="1" :max="10" inline controls></vue-number-input>


    </div>
    <div class="select-option">
        <label> Services:</label>
        <Multiselect
            v-model="selectedServices"
            mode="tags"
            placeholder="Select options"
            :close-on-select="false"
            :searchable="true"
            :object="true"
            :resolve-on-load="false"
            :delay="0"
            :min-chars="1"
            :options="serviceNames"
            label="name"
            track-by="name"
        />
        <div class="selected-services">
            <p style="color:#d6b770">Selected Services:</p>
            <ul  style="color:#fff">
                <li v-for="service in selectedServices" :key="service.name">{{ service.name }}</li>
            </ul>
        </div>
    </div>
    <button class="brown-btn" @click.prevent="applyFilters">Check Availability</button>

</template>


<script>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import Multiselect from '@vueform/multiselect';
import { fetchRooms, fetchServices } from '../utils/api';

export default {
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
            selectedPriceMin: 0,
            selectedPriceMax: 500,
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

        selectedPriceMin: {
            immediate: true,
            handler() {
                console.log("selectedPriceMin changed:", this.selectedPriceMin);
                this.updateComputedRooms();
            }
        },
        selectedPriceMax: {
            immediate: true,
            handler() {
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

        handleDateChange(newDate) {
            this.date = newDate;
        },

        updateComputedRooms() {
            const filtered = this.computedRooms;
            this.filteredRooms = filtered;
            this.$emit('filtered-rooms', filtered);
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
    },
    computed: {
        computedRooms() {
            if (!this.selectedRoomType &&!this.selectedadults && this.selectedServices.length === 0) {
                return this.rooms;
            }



            return this.rooms.filter((room) => {
                let matches = true;

                if (this.selectedRoomType && room.room_type !== this.selectedRoomType) {
                    matches = false;
                }

                 if (this.selectedadults && room.adults !== this.selectedadults) {
                    matches = false;
                }

                if (this.selectedPriceMin && room.price_per_night < parseFloat(this.selectedPriceMin)) {
                    console.log(this.selectedPriceMin)
                        matches = false;
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
