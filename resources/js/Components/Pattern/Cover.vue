<script setup>
import { defineProps, inject } from 'vue';
import Editor from '@/Layouts/Editor.vue';

const props = defineProps({
    index: Number,
});

const contents = inject('contents');
const content = contents[props.index];

const bgStyle = { dark: "bg-[rgba(0,0,0,0.4)] bg-cover bg-center bg-blend-overlay text-white" }["dark"];
</script>

<template>
    <Editor>
        <template #preview>
            <section class="flex flex-col gap-8 justify-center items-center w-full h-64 container" :class="bgStyle"
                :style="{ 'background-image': `url(${content.backgroundImage})` }">
                <section>
                    <h1 class="text-3xl mb-1 text-center">{{ content.heading }}</h1>
                    <p v-if="content.text" v-html="content.text.replace(/\n/, '<br>')"></p>
                </section>
                <section v-if="content.buttonText">
                    <a :href="content.link" class="btn bg-primary">{{ content.buttonText }}</a>
                </section>
            </section>
        </template>

        <template #editor>
            <div>
                <label :set="id = `cover-heading-${index}`" :for="id">タイトル</label>
                <input :id="id" type="text" v-model="content.heading" class="w-full">
            </div>

            <div>
                <label :set="id = `cover-text-${index}`" :for="id">説明文</label>
                <textarea :id="id" type="text" v-model="content.text" class="w-full"></textarea>
            </div>

            <div>
                <label :set="id = `cover-button-text-${index}`" :for="id">ボタンのテキスト</label>
                <input :id="id" type="text" v-model="content.buttonText" class="w-full">
            </div>

            <div>
                <label :set="id = `cover-link-${index}`" :for="id">ボタンのリンク</label>
                <input :id="id" type="text" v-model="content.link" class="w-full">
            </div>

            <div>
                <label :set="id = `cover-background-${index}`" :for="id">画像</label>
                <input :id="id" type="text" v-model="content.backgroundImage" class="w-full">
            </div>
        </template>
    </Editor>
</template>
