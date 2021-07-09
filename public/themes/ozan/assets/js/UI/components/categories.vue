<template>
    <div class="hero__sidebar-inner faq" id="accordion">

        <vsa-list :tags="my_options.tags">

            <vsa-item v-for="(category, index) in categories" :key="index" class="card" style="cursor: pointer;border-radius: 0;">
                        <i :class="category.icon">
                        </i>
                        <span class="faq-title"> {{ category.name }}</span>
                    </a>
                </vsa-heading>

                <vsa-heading v-else>
                    <div class="with_child">
                        <i :class="category.icon">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span><span class="path18"></span><span class="path19"></span>
                        </i>
                        <span class="faq-title"> {{ category.name }}</span>
                    </div>
                </vsa-heading>


                <vsa-content v-if="category.children.length > 0">
                    <div class="card-body" style="padding: 10px;">
<<<<<<< HEAD

=======

