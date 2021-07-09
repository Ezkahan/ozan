<template>
    <div class="hero__sidebar-inner faq" id="accordion">
    
        <vsa-list :tags="my_options.tags">
  
            <vsa-item v-for="(category, index) in categories" :key="index" class="card" style="cursor: pointer;border-radius: 0;">
                
                <vsa-heading v-if="!category.children.length">
                    <a :href="category.url_path">
                        <i :class="category.icon">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span><span class="path18"></span><span class="path19"></span>
                        </i>
                        <span class="faq-title"> {{ category.name }}</span>
                    </a>
                </vsa-heading>
                
                <vsa-heading v-else>
                    <i :class="category.icon">
                        <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span><span class="path18"></span><span class="path19"></span>
                    </i>
                    <span class="faq-title"> {{ category.name }}</span>
                </vsa-heading>
                

                <vsa-content v-if="category.children.length > 0">
                    <div class="card-body" style="padding: 10px;">
                        
                        <a v-for="(child, index) in category.children" :key="index" :href="child.url_path" class="hero__sidebar-inner-link ">
                            <i :class="'icon-' + child.icon"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span><span class="path18"></span><span class="path19"></span></i>
                            <span>{{child.name}}</span>
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
    components: {
        VsaList,
        VsaItem,
        VsaHeading,
        VsaContent,
        VsaIcon
    },
    props: {
        categories: {
            type: Array,
            required: true,
            default: () => [],
        },
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