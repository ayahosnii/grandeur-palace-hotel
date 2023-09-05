<template>
    <Splide :options="{ rewind: true }" aria-label="Vue Splide Example">
        <SplideSlide v-for="(group, index) in groupedRooms" :key="index">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonials</span>
                        <h2>What Customers Say?</h2>
                    </div>
                    <div class="col-lg-8 offset-lg-2">
                        <div class="testimonial-slider">
                            <div class="ts-item">
                                <p>After a construction project took longer than expected, my husband, my daughter and I
                                    needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                                    city, neighborhood and the types of housing options available and absolutely love our
                                    vacation at Sona Hotel.</p>
                                <div class="ti-author">
                                    <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i>
                                    </div>
                                    <h5> - Alexander Vasquez</h5>
                                </div>
                                <img src="{{asset('assets/img/testimonial-logo.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        <div class="ts-item">
                            <p>After a construction project took longer than expected, my husband, my daughter and I
                                needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                                city, neighborhood and the types of housing options available and absolutely love our
                                vacation at Sona Hotel.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Alexander Vasquez</h5>
                            </div>
                            <img src="{{asset('assets/img/testimonial-logo.png')}}" alt="">
                        </div>
                        <div class="ts-item">
                            <p>After a construction project took longer than expected, my husband, my daughter and I
                                needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
                                city, neighborhood and the types of housing options available and absolutely love our
                                vacation at Sona Hotel.</p>
                            <div class="ti-author">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <h5> - Alexander Vasquez</h5>
                            </div>
                            <img src="{{asset('assets/img/testimonial-logo.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
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
