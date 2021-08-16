
<template>
    <div>
        <vsa-list :tags="my_options.tags">

            <vsa-item v-for="(category, index) in categories" :key="index" class="sidebar__body">

                <vsa-heading v-if="!category.children.length">
                    <a :href="'/' + category.url_path" class="sidebar__btn tab__btn">
                        <img v-if="category.category_icon_path" :src="public_path + '/' + category.category_icon_path"
                             class="logo-img" height="20px" width="20px"
                             style="
                            -webkit-mask: url({public_path + '/' + category.category_icon_path}) no-repeat center;
                            mask: url({public_path + '/' + category.category_icon_path}) no-repeat center;" :alt="category.name"
                        >
                        <span> {{ category.name }}</span>
                    </a>
                </vsa-heading>

                <vsa-heading v-else>
                    <div class="sidebar__btn tab__btn">
                        <img v-if="category.category_icon_path" :src="public_path + '/' + category.category_icon_path" class="logo-img"
                            style="
                            -webkit-mask: url({public_path + '/' + category.category_icon_path}) no-repeat center;
                            mask: url({public_path + '/' + category.category_icon_path}) no-repeat center;" height="20px" width="20px" :alt="category.name"
                        >
                        <span> {{ category.name }}</span>
                    </div>
                </vsa-heading>


                <vsa-content v-if="category.children.length > 0" class="sidebar__content event">

                    <a v-for="(child, index) in category.children" :key="index" :href="'/' + child.url_path" class="sidebar__content-link">
                        <img v-if="child.category_icon_path" :src="public_path + '/' + child.category_icon_path" alt="Logo" class="logo-img"
                            style="
                            -webkit-mask: url({public_path + '/' + child.category_icon_path}) no-repeat center;
                            mask: url({public_path + '/' + child.category_icon_path}) no-repeat center;" height="20px" width="20px" :alt="child.name"
                        >
                        {{ child.name }}
                    </a>

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