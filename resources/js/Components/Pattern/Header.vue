<script setup>
import { inject } from "vue";
const settings = inject('settings');
</script>

<template>
    <header class="py-1">
        <div class="flex justify-between shrink-0">
            <h1>
                <img :src="settings.logo" alt="" v-if="settings.logo" class="h-12">
                <span v-if="!settings.title">{{ settings.title }}</span>
            </h1>
        </div>

        <div>
            <nav>
                <ul class="flex gap-2 justify-end shrink-0">
                    <!-- <li v-for="item in nav"><a :href="item.link">{{ item.label }}</a></li> -->
                </ul>
            </nav>
        </div>
    </header>
</template>
