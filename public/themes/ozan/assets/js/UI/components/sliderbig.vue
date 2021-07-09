<template>

    <slick
        ref="slick"
        :options="slickOptions">
<!--        @afterChange="handleAfterChange"-->
<!--        @beforeChange="handleBeforeChange"-->
<!--        @breakpoint="handleBreakpoint"-->
<!--        @destroy="handleDestroy"-->
<!--        @edge="handleEdge"-->
<!--        @init="handleInit"-->
<!--        @reInit="handleReInit"-->
<!--        @setPosition="handleSetPosition"-->
<!--        @swipe="handleSwipe"-->
<!--        @lazyLoaded="handleLazyLoaded"-->
<!--        @lazyLoadError="handleLazeLoadError"-->



                <picture v-for="(image, index) in slides" :key="index">
                    <img :src="public_path+image" alt="">
                </picture>

    </slick>

</template>

<script>
import Slick from "vue-slick";

export default {
    name: "sliderbig",
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
                //     slidesToShow: 1,
//     slidesToScroll: 1,
            dots: false,
            speed: 1000,
            autoplay: true,
            arrows: true,
            autoplaySpeed: 4000,
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
        }
    }
}
</script>

<style scoped>

</style>