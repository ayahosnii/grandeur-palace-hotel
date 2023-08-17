<template>
    <div class="row">
        <div class="col-md-6">
            <div class="check-date">
                <label for="date-in">Check In:</label>
                <input type="text" class="date-input" id="date-in">
                <i class="icon_calendar"></i>
            </div>
        </div>
        <div class="col-md-6">
            <div class="check-date">
                <label for="date-out">Check Out:</label>
                <input type="text" class="date-input" id="date-out">
                <i class="icon_calendar"></i>
            </div>
        </div>

    </div>
    <div class="select-option">

        <div class="slider-box">
            <label for="priceRange">Price Range:</label>
            <div id="price-range" class="slider"></div>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="price-input" id="priceRangeMin" readonly>
                </div>
                <div class="col-md-6">
                    <input type="text" class="price-input" id="priceRangeMax" readonly>
                </div>
            </div>

        </div>

        <label for="guest">Guests:</label>
        <select id="guest">
            <option value="">2 Adults</option>
            <option value="">3 Adults</option>
        </select>
    </div>
    <div class="select-option">
        <label for="room">Room:</label>
        <select id="room">
            <option value="">1 Room</option>
            <option value="">2 Room</option>
        </select>
    </div>
    <button type="submit">Check Availability</button>
    <div>
        <h2>Filters</h2>
        <label>
            Room Type:
            <select v-model="selectedRoomType">
                <option value="">All</option>
                <option v-for="room in rooms" :key="room.id">{{ room.room_type }}</option>
            </select>
        </label>
        <label>
            Bed Type:
            <select v-model="selectedBedType">
                <option value="">All</option>
                <option v-for="type in bedTypes" :key="type">{{ type }}</option>
            </select>
        </label>
        <label>
            Services:
            <input v-model="selectedServices" placeholder="e.g. TV, Wifi">
        </label>
        <button @click="applyFilters">Apply Filters</button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    emits: ['filters-applied'], // Declare the custom event here

    data() {
        return {
            selectedRoomType: '',
            selectedBedType: '',
            selectedServices: '',
            roomTypes: [],
            bedTypes: [],
            rooms: [],
        };
    },
    mounted() {
        this.fetchFilteredRooms()
    },
    methods: {
        applyFilters() {
            this.$emit('filters-applied', {
                room_type: this.selectedRoomType,
                bed_type: this.selectedBedType,
                services: this.selectedServices,
            });
        },
        async fetchFilteredRooms(filters) {
            await axios.get('/api/rooms', { params: filters })
                .then(response => {
                    this.rooms = response.data;
                    console.log(this.rooms)
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};
</script>
