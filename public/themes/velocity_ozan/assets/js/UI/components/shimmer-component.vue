<template>
    <div class="shimmer-card-container">
        <carousel-component
            id="shimmer-carousel"
            navigation-enabled="hide"
            pagination-enabled="hide"
            :slides-count="slidesPerPage + 1"
            :slides-per-page="slidesPerPage">

                <slide
                    :key="count"
                    :slot="`slide-${count}`"
                    v-for="count in slidesPerPage">

                    <div class="shimmer-card">
                        <div class="shimmer-wrapper">
                            <div class="shimmer-product-image animate"></div>
                            <div class="comment animate"></div>
                            <div class="comment animate"></div>
                            <div class="comment animate"></div>
                        </div>
                    </div>
                </slide>
        </carousel-component>
    </div>
</template>

<script>
    export default {
        props: {
            'shimmerCount': {
                default: 6,
            },
        },

        data: function () {
            return {
                shimmerCountInt: parseInt(this.shimmerCount),
                windowWidth: window.innerWidth,
                slidesPerPage: 6,
            }
        },


        mounted: function () {
            // this.setWindowWidth();
            this.setSlidesPerPage(this.windowWidth);
        },

        watch: {
            /* checking the window width */
            windowWidth(newWidth, oldWidth) {
                this.setSlidesPerPage(newWidth);
            }
        },

        methods: {
                  /* setting slides on the basis of window width */
            setSlidesPerPage: function (width) {
                if (width >= 1200) {
                    this.slidesPerPage = 6;
                } else if (width < 1200 && width >= 992) {
                    this.slidesPerPage = 5;
                } else if (width < 992 && width >= 822) {
                    this.slidesPerPage = 3;
                } else if (width < 822 && width >= 626) {
                    this.slidesPerPage = 3;
                } else {
                    this.slidesPerPage = 2;
                }
            }
        }
    }
</script>

<style>
    .shimmer-card-container {
        width: 100%;
    }

    .shimmer-card {
        margin: 0px 10px 50px 10px;
        padding: 30px 40px;
        border: 2px solid #fff;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    .shimmer-product-image {
        width: 100%;
        height: 180px;
    }

    .comment {
        height: 10px;
        background: #777;
        margin-top: 20px;
    }

    .shimmer-wrapper {
        width: 0px;
        animation: fullView 0.5s forwards linear;
    }

    @keyframes fullView {
        100% {
            width: 100%;
        }
    }

    .animate {
        animation : shimmer 2s infinite;
        background: linear-gradient(to right, #eff1f3 4%, #e2e2e2 25%, #eff1f3 36%);
        background-size: 1000px 100%;
    }

    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }
</style>
