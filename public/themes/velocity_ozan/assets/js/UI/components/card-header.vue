<template>

    <div :class="`row mb15 col-12 ${rowClass}`">
        <div class="col-4 f-w no-padding" v-if="tabs || viewAll || scrollable">
            <h2 class="fs20 fw6">{{ headerHeading }}</h2>
        </div>

        <div class="col-12 no-padding" v-else >
            <h2 class="fs20 fw6">{{ headerHeading }}</h2>
        </div>

        <div class="col-8 d-rel no-padding" v-if="tabs || viewAll || scrollable">
            <div class="row justify-content-end text-right">

                <template v-if="tabs">
                    <div
                        :title="tab"
                        :key="index"
                        @click="switchTab"
                        class="col-lg-2 no-padding"
                        v-for="(tab, index) in tabs.slice(0, 3)">

                        <h2 class="fs16 fw6 cursor-pointer tab" :class="index == 0 ? 'active' : ''">{{ tab }}</h2>
                    </div>
                </template>

                <template v-if="scrollable && !(scrollable == '')">
                    <div class="col-lg-2 no-padding switch-buttons">
                        <div class="row justify-content-center">
                            <h2
                                class="col-lg-1 no-padding v-mr-20 fw6 cursor-pointer"
                                title="previous"
                                v-html="'&lt;'"
                                @click="navigation('prev')"
                            ></h2>

                            <h2
                                class="col-lg-1 no-padding fw6 cursor-pointer"
                                title="next"
                                @click="navigation('next')"
                            >></h2>
                        </div>
                    </div>
                </template>

                <template v-if="(! (viewAll == 'false' || viewAll == '')) && viewAll">
                    <div>
                        <a :href="viewAll" :title="`View all ${headerHeading} products`" class="remove-decoration link-color">
                            <h2 class="fs16 fw6 cursor-pointer tab">{{ __('home.view-all') }}</h2>
                        </a>
                    </div>
                </template>

            </div>
        </div>
    </div>

</template>

<script type="text/javascript">
    export default {
        props: [
            'showTabs',
            'rowClass',
            'heading',
            'viewAll',
            'scrollable'
        ],

        data: function () {
            var tabs = null;

            if (this.showTabs) {
                tabs = [
                    'Fashion',
                    'Accessories',
                    'Electronis',
                    'Electronis1',
                    'Electronis2',
                ];
            }

            return {
                tabs: tabs,
                headerHeading: this.heading ? this.heading : this.__('products.text'),
            }
        },

        methods: {
            'switchTab': function ({target}) {
                let clickedTab = target.closest('h2.tab');

                if (clickedTab) {
                    let tabsCollection = this.$el.querySelectorAll('.tab');

                    Array.from(tabsCollection).forEach(tab => {
                        tab.classList.remove('active');
                    });

                    clickedTab.classList.add('active');
                }
            },

            navigation: function (navigateTo) {
                let navigation = $(`#${this.scrollable} .VueCarousel-navigation .VueCarousel-navigation-${navigateTo}`);

                if (navigation && (navigation = navigation[0])) {
                    navigation.click();
                }
            }
        },
    }
</script>