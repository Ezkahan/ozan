<template>
    <div class="hero__sidebar-inner faq">
        <a v-for="(category, index) in $root.sharedRootCategories" :key="index" :href="category.slug" class="card" style="border-radius: 0;">
            <div class="hero__sidebar-inner-link">
                <div class="category_icon">
                    <svg v-if="category.category_icon_path">
                        <use :href="public_path + '/' + category.category_icon_path"></use>
                    </svg>
                    <!-- <svg id="monitor" xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20">
                        <path id="Path_61" data-name="Path 61" d="M0,241.014a1.181,1.181,0,0,0,1.155,1.179H19.845A1.181,1.181,0,0,0,21,241.014V240H0Zm0,0" transform="translate(0 -227.467)" fill="#2d2d2d" />
                        <path id="Path_62" data-name="Path 62" d="M19.845,0H1.155A1.143,1.143,0,0,0,0,1.136V11.8H21V1.136A1.143,1.143,0,0,0,19.845,0Zm0,0" fill="#2d2d2d" />
                        <path id="Path_63" data-name="Path 63" d="M115.294,299.5h-2.41V296h-5.117v3.5h-2.135a.522.522,0,1,0,0,1.044h9.663a.522.522,0,1,0,0-1.044Zm0,0" transform="translate(-99.831 -280.543)" fill="#2d2d2d" />
                    </svg> -->
                </div>
                <span class="faq-title"> {{ category.name }}</span>
            </div>
        </a>
    </div>
</template>

<script>
export default {
    props: {
        public_path: {
            type: String,
            required: true,
        }
    }
}
</script>