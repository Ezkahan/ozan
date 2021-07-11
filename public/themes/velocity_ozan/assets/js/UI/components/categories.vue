
<template>
    <div>
        <vsa-list :tags="my_options.tags">

            <vsa-item v-for="(category, index) in categories" :key="index" class="card" style="cursor: pointer;border-radius: 0;">

                <vsa-heading v-if="!category.children.length">
                    <a :href="category.url_path">
                        <div class="hero__sidebar-inner-link">
                            <div class="category_icon">
                                <img :src="public_path + '/' + category.category_icon_path" alt="Logo" class="logo-img"
                                    style="
                                    -webkit-mask: url({public_path + '/' + category.category_icon_path}) no-repeat center;
                                    mask: url({public_path + '/' + category.category_icon_path}) no-repeat center;"
                                >
                            </div>
                            <span class="faq-title"> {{ category.name }}</span>
                        </div>
                    </a>
                </vsa-heading>

                <vsa-heading v-else>
                    <div class="hero__sidebar-inner-link">
                        <div class="category_icon">
                            <img :src="public_path + '/' + category.category_icon_path" alt="Logo" class="logo-img"
                                style="
                                -webkit-mask: url({public_path + '/' + category.category_icon_path}) no-repeat center;
                                mask: url({public_path + '/' + category.category_icon_path}) no-repeat center;"
                            >
                        </div>
                        <span class="faq-title"> {{ category.name }}</span>
                    </div>
                </vsa-heading>


                <vsa-content v-if="category.children.length > 0">
                    <div class="card-body" style="padding: 10px;">

                        <a v-for="(child, index) in category.children" :key="index" :href="child.url_path" class="hero__sidebar-inner-link ">
                        <div class="category_icon">
                                <img :src="public_path + '/' + child.category_icon_path" alt="Logo" class="logo-img"
                                    style="
                                    -webkit-mask: url({public_path + '/' + child.category_icon_path}) no-repeat center;
                                    mask: url({public_path + '/' + child.category_icon_path}) no-repeat center;"
                                >
                            </div>
                            <span class="faq-title"> {{ child.name }}</span>
                        </a>

                    </div>
                </vsa-content>
            </vsa-item>

        </vsa-list>
    </div>
</template>

<script>
import {
    VsaList,
    VsaItem,
    VsaHeading,
    VsaContent,
    VsaIcon
} from 'vue-simple-accordion';
// import 'vue-simple-accordion/dist/vue-simple-accordion.css';
export default {
    name: "categories",
    mounted: function () {
        console.log(this.categories);
    },
    components: {
        VsaList,
        VsaItem,
        VsaHeading,
        VsaContent,
        VsaIcon
    },
    props: {
        categories: {
            type: Array | Object,
            required: true,
            default: () => [],
        },
        public_path: {
            type: String,
            required: true,
        }
    },
    data () {
        return {
            my_options: {
                tags: {
                    list: "div",
                    list__item: "div",
                    item__heading: "div",
                    heading__content: "div",
                    heading__icon: "span",
                    item__content: "div"
                },
                roles: {
                    presentation: false,
                    heading: false,
                    region: true
                },
                transition: "vsa-collapse",
                initActive: false,
                forceActive: undefined,
                autoCollapse: true,
                onHeadingClick: () => {},
                navigation: true
            }
        }
    }
}
</script>

<style scoped>
a:hover .logo-img {
    filter: invert(1);
    background: transparent;
}
</style>