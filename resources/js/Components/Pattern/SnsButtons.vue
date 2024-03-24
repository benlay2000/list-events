<script setup>
import Editor from '@/Layouts/Editor.vue';
import { defineProps, inject } from 'vue';

const props = defineProps({
    index: Number,
});

const contents = inject('contentList');
const content = contentList[props.index];
</script>

<template>
    <Editor>
        <template #preview>

        </template>

        <template #editor>

        </template>
    </Editor>
</template>
