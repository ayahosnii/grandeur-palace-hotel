<template>
    <Splide :options="{ rewind: true }" aria-label="Vue Splide Example">
        <SplideSlide v-for="(group, index) in groupedRooms" :key="index">
            <section class="hp-room-section">
                <div class="container-fluid">
                    <div class="hp-room-items">
                        <div class="row">
                            <div class="col-lg-3 col-md-6" v-for="room in group" :key="room.id">
                                <div class="hp-room-item set-bg" :data-setbg="`${asset}/${room.image}`"  :style="'background-image: url(' + asset + '/' + room.image + ')'">
                                    <div class="hr-text">
                                        <h3>{{ room.room_type }}</h3>
                                        <h2>{{ room.price_per_night }}$<span>/Per night</span></h2>
                                        <a :href="'/rooms/' + room.id" class="primary-btn">More Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </SplideSlide>
    </Splide>
</template>

<script>
import { fetchRooms } from '../utils/api';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';


export default {
    props: {
        singleSelectedDate: String,
    },
    data() {
        return {
            asset: 'assets/admin/images/room_images',
            rooms: [],
        };
    },
    mounted() {
        this.fetchAllRooms();
    },
    components: { Splide, SplideSlide},
    methods: {
        async fetchAllRooms() {
            const allRooms = await fetchRooms();
            this.rooms =  allRooms;
        },

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


<style scoped>

</style>
