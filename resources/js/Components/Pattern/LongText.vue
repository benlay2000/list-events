<script setup>
import Editor from '@/Layouts/Editor.vue';
import { defineProps, inject } from 'vue';

const props = defineProps({
    index: Number,
});

const contents = inject('contents');
const content = contents[props.index];
</script>

<template>
    <Editor>
        <template #preview>
            <div class="long-text text-center w-full p-8">
                <h1 class="font-bold text-lg">{{ content.heading }}</h1>
                <p>{{ content.text }}</p>
            </div>
        </template>

        <template #editor>
            <div>
                <label :set="id = `long-text-heading-${index}`" :for="id">見出し</label>
                <input :id="id" type="text" v-model="content.heading" class="w-full">
            </div>

            <div>
                <label :set="id = `long-text-${index}`" :for="id">テキスト</label>
                <textarea :id="id" type="text" v-model="content.text" class="w-full"></textarea>
            </div>

        </template>
    </Editor>
</template>
