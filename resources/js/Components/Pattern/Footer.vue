<template>
    <footer class="bg-gray-200 py-8">
        <section class="copyright text-center">
            &copy; <input type="text" v-model="settings.copyright" class="bg-transparent w-2/3">
        </section>
    </footer>
</template>

<script setup>
import { inject } from "vue"
const settings = inject('settings');
</script>
