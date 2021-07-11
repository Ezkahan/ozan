<template>
    <slick
        ref="slick"
        :options="slickOptions">

        <a  v-for="(slide, index) in slides" :key="index" :class="item_class" :href="slide.slider_path">
           <img :src="public_path +'/'+ slide.path" />
        </a>
    </slick>
</template>

<script>
import Slick from 'vue-slick';

export default {
    name: "slider",
    props: {
        slides: {
            type: Array | Object,
            required: true,
            default: () => [],
        },

        public_path: {
            type: String,
            required: true,
        },
        item_class: {
            type: String,
            required: false,
        },
        time:{
            type:Number,
            required:false
        }
    },
    components: { Slick },

    data() {
        return {
            slickOptions: {
                slidesToShow: 1,
                dots: false,
                speed: 1000,
                autoplay: false,
                arrows: true,
                autoplaySpeed: this.time,
                // nextArrow: ".next_s",
                // prevArrow: ".prev_s",
                adaptiveHeight: fasle,
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

    }
}
</script>

<style scoped>

</style>