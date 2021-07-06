<template>
    <slick
        ref="slick"
        :options="slickOptions"
        @afterChange="handleAfterChange"
        @beforeChange="handleBeforeChange"
        @breakpoint="handleBreakpoint"
        @destroy="handleDestroy"
        @edge="handleEdge"
        @init="handleInit"
        @reInit="handleReInit"
        @setPosition="handleSetPosition"
        @swipe="handleSwipe"
        @lazyLoaded="handleLazyLoaded"
        @lazyLoadError="handleLazeLoadError">



        <div v-for="(image, index) in slides" :key="index" class="hero__slider-item">
           <img :src="public_path + '/storage/' + image.path" alt="">
        </div>
    </slick>
</template>

<script>
import Slick from 'vue-slick';

export default {
    name: "slider",
    props: {
        slides: {
            type: Array,
            required: true,
            default: () => [],
        },

        public_path: {
            type: String,
            required: true,
        }
    },
    components: { Slick },

    data() {
        return {
            slickOptions: {
                slidesToShow: 1,
                dots: false,
                speed: 1000,
                autoplay: true,
                arrows: true,
                autoplaySpeed: 2000,
                // nextArrow: ".next_s",
                // prevArrow: ".prev_s",
                adaptiveHeight: true,
                // Any other options that can be got from plugin documentation
            },
        };
    },

    // All slick methods can be used too, example here
    methods: {

        next() {
            this.$refs.slick.next();
        },

        prev() {
            this.$refs.slick.prev();
        },

        reInit() {
            // Helpful if you have to deal with v-for to update dynamic lists
            this.$nextTick(() => {
                this.$refs.slick.reSlick();
            });
        },

        // Events listeners
        handleAfterChange(event, slick, currentSlide) {
            console.log('handleAfterChange', event, slick, currentSlide);
        },
        handleBeforeChange(event, slick, currentSlide, nextSlide) {
            console.log('handleBeforeChange', event, slick, currentSlide, nextSlide);
        },
        handleBreakpoint(event, slick, breakpoint) {
            console.log('handleBreakpoint', event, slick, breakpoint);
        },
        handleDestroy(event, slick) {
            console.log('handleDestroy', event, slick);
        },
        handleEdge(event, slick, direction) {
            console.log('handleEdge', event, slick, direction);
        },
        handleInit(event, slick) {
            console.log('handleInit', event, slick);
        },
        handleReInit(event, slick) {
            console.log('handleReInit', event, slick);
        },
        handleSetPosition(event, slick) {
            console.log('handleSetPosition', event, slick);
        },
        handleSwipe(event, slick, direction) {
            console.log('handleSwipe', event, slick, direction);
        },
        handleLazyLoaded(event, slick, image, imageSource) {
            console.log('handleLazyLoaded', event, slick, image, imageSource);
        },
        handleLazeLoadError(event, slick, image, imageSource) {
            console.log('handleLazeLoadError', event, slick, image, imageSource);
        },
    }
}
</script>

<style scoped>

</style>