<template>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Our Rooms</h2>
                        <div class="bt-option">
                            <a href="./home.html">Home</a>
                            <span>Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="booking-form2">
                        <h3>Booking Details</h3>
                        <form action="#">
                            <room-filters @filtered-rooms="updateFilteredRooms"></room-filters>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div v-for="room in filteredRooms" :key="room.id" class="col-lg-6 col-md-6">
                            <div class="room-item">
                                <img :src="`${asset}/${room.image}`" alt="">
                                <div class="ri-text">
                                    <h4>{{ room.room_type }}</h4>
                                    <h3>{{ room.price_per_night }}<span>/Pernight</span></h3>
                                    <table>
                                        <!-- Your table content -->
                                    </table>
                                    <a :href="'/rooms/' + room.id">More Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="room-pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

</template>

<script>
import { fetchRooms } from '../utils/api';
import RoomFilterComponent from '../components/RoomFilters.vue';


    export default {
        props: {
            startDate: {
                type: [Date, String],
                default: null
            },
        },
            data() {
                return {
                    rooms: [],
                    asset: 'assets/img/room/',
                    filteredRooms: [],
                };
            },
            mounted() {
                this.fetchAllRooms();
            },
        methods: {
            async fetchAllRooms() {
                const allRooms = await fetchRooms();
                this.rooms = allRooms;
            },
            updateFilteredRooms(filteredRooms) {
                this.filteredRooms  = filteredRooms;
            },
        },

        components:{
            RoomFilterComponent,
        }
        }

</script>
