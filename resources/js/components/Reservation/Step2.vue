<template>
    <section>
        <form class="form" method="post" action="#" @submit.prevent="nextStep">
            <div class="form-group">
                <!-- Step 2 content here -->
                <h2 style="text-align: center; color: #ffffff">Choose the rooms</h2>
                <Splide v-if="rooms.length > 0" :options="{ rewind: true }" aria-label="Vue Splide Example">
                    <SplideSlide v-for="(group, index) in groupedRooms" :key="index">
                        <section class="hp-room-section">
                            <div class="container-fluid">
                                <div class="hp-room-items">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6" v-for="room in group" :key="room.id">
                                            <input type="checkbox" name="room" class="image-radio" />
                                            <div class="hp-room-item set-bg" :data-setbg="`${asset}/${room.image}`" :style="'background-image: url(' + asset + '/' + room.image + ')'">
                                                <div class="hr-text">
                                                    <h3>{{ room.room_type }}</h3>
                                                    <h2>{{ room.price_per_night }}$<span>/Per night</span></h2>
                                                    <a href="#" class="primary-btn">More Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </SplideSlide>
                </Splide>
                <div v-else>
                    <loading v-model:active="isLoading" :can-cancel="true" :on-cancel="onCancel" :is-full-page="fullPage" />
                    <h2 class="register-title">No room is available</h2>
                </div>
            </div>
            <div class="form-group cta-step">
                <div class="cta prev">
                    <p class="cta-color">
            <span class="link_wrap">
              <a class="link_text" href="#" @click.prevent="prevStep"><span class="arrow-prev"></span>Previous</a>
            </span>
                    </p>
                </div>
                <div class="cta">
                    <p class="cta-color">
                        <span class="text"></span>
                        <span class="link_wrap">
              <input type="submit" value="Next" class="link_text" />
              <span class="arrow-next"></span>
            </span>
                    </p>
                </div>
            </div>
        </form>
    </section>
</template>

<script>
import {Splide, SplideSlide} from "@splidejs/vue-splide";

export default {
    props: {
        rooms: Array,
        onCancel: Function,
        fullPage: Boolean,
    },
    data(){
        return{
            isLoading: true,
        }
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
    components: {
        Splide,
        SplideSlide
    },
    methods: {
        doAjax() {
            this.isLoading = true;

            setTimeout(() => {
                this.isLoading = false
            }, 5000)
        },

        nextStep() {
            // Handle form submission for Step 2
            // Optionally, perform any necessary validation or data manipulation
            // Emit an event to notify the parent component to move to the next step
            this.$emit('next');
        },
        prevStep() {
            // Emit an event to notify the parent component to go back to the previous step
            this.$emit('prev');
        },
    },
};
</script>
