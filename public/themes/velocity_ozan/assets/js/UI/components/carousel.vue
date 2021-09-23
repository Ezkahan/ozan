<template>
    <carousel
        :rtl="localeDirection == 'rtl'"
        :dir="localeDirection"
        :id="id"
        :navigationEnabled="true"
        :paginationEnabled="true"
        :perPage="parseInt(slidesPerPage)"
        :loop="loop == 'true' ? true : false"
        :autoplay="autoplay == 'true' ? true : false"
        :autoplayTimeout="timeout ? parseInt(timeout) : 2000"
        :autoplayDirection="'forward'"
        :perPageCustom="perPageCustom"
        :class="[
            localeDirection,
            (navigationEnabled == 'hide') ? 'navigation-hide' : '',
            (paginationEnabled == 'hide') ? 'pagination-hide' : '',
            addClass
        ]">

        <slot
            v-for="index in parseInt(slidesCount)"
            :name="`slide-${parseInt(index) - 1}`">
        </slot>
    </carousel>
</template>

<script type="text/javascript">
    export default {
        props: [
            'id',
            'loop',
            'timeout',
            'autoplay',
            'addClass',
            'direction',
            'slidesCount',
            'slidesPerPage',
            'localeDirection',
            'navigationEnabled',
            'paginationEnabled',
            'perPageCustom'
        ],

        data: function () {
            return {}
        },

        mounted() {
            console.log(this.loop+this.slidesPerPage);

        },

        methods: {
            slideClicked: function () {
                debugger
            }
        }
    }
</script>