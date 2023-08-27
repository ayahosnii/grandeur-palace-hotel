<template>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Our Rooms</h2>
                        <div class="bt-option">
                            <a  href="./home.html">Home</a>
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
                                    <p style="color: #d5d4d4">Services:
                                        <span>
                                            <i style="padding: 0px 5px;" v-for="room in room.services"
                                               :class="room.icon_class"></i>
                                        </span>
                                    </p>

                                    <table>
                                        <!-- Your table content -->
                                    </table>
                                    <a class="room-btn" :href="'/rooms/' + room.id">More Details</a>
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
            avaRoom: Array
        },
            data() {
                return {
                    rooms: [],
                    asset: 'assets\\admin\\images\\room_images',
                    filteredRooms: [],
                };
            },
        watch: {
            avaRoom: {
                handler(newAvaRoom) {
                    // Check if avaRoom has values
                    if (newAvaRoom && newAvaRoom.length > 0) {
                        // Update filteredRooms based on avaRoom
                        this.filteredRooms = this.rooms.filter((room) =>
                            newAvaRoom.includes(room.id)
                        );
                    } else {
                        // If avaRoom is empty, reset filteredRooms
                        this.filteredRooms = this.rooms;
                    }
                },
                immediate: true, // Trigger the handler immediately on component mount
            },
        },
            mounted() {
                this.fetchAllRooms();
                console.log(this.avaRoom)
            },


        methods: {
            async fetchAllRooms() {
                const allRooms = await fetchRooms();
                this.filteredRooms = this.avaRoom ?? allRooms;
            },
            updateFilteredRooms(filteredRooms) {
                this.filteredRooms = filteredRooms;
            }
        },

        components:{
            RoomFilterComponent,
        }
        }

</script>
<style>
.room-btn{
    display: inline-block;
    color: #ffffff;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 700;
    background: #d6b770;
    padding: 14px 28px 13px
}
</style>
