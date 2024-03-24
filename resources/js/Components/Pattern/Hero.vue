<script setup>
import { inject, ref } from "vue";
import Editor from "@/Layouts/Editor.vue";

const props = defineProps({
    index: Number,
});

const contents = inject("contents");
const content = contents[props.index];

const styleObject = ref({
    backgroundImage: `url(${content.image})`,
});
</script>

<template>
    <Editor>
        <template #preview>
            <section class="flex items-stretch w-full">
                <div class="image w-1/2 shrink-0 grow-0 bg-cover bg-center" :style="styleObject"></div>
                <div class="w-1/2 shrink-0 grow-0 px-6 py-24 flex flex-col gap-8">
                    <section class="text">
                        <h1 class="text-2xl font-bold">{{ content.heading }}</h1>
                        <p>{{ content.text }}</p>
                    </section>

                    <section v-if="content.buttonText" class="w-full">
                        <a :href="content.link" class="btn bg-primary">{{ content.buttonText }}</a>
                    </section>
                </div>

            </section>
        </template>

        <template #editor>
            <div>
                <label :set="(id = `hero-heading-${index}`)" :for="id">タイトル</label>
                <input :id="id" type="text" v-model="content.heading" class="w-full" />
            </div>

            <div>
                <label :set="(id = `hero-text-${index}`)" :for="id">説明文</label>
                <textarea :id="id" type="text" v-model="content.text" class="w-full"></textarea>
            </div>

            <div>
                <label :set="(id = `hero-button-text-${index}`)" :for="id">ボタンのテキスト</label>
                <input :id="id" type="text" v-model="content.buttonText" class="w-full" />
            </div>

            <div>
                <label :set="(id = `hero-link-${index}`)" :for="id">ボタンのリンク</label>
                <input :id="id" type="text" v-model="content.link" class="w-full" />
            </div>

            <div>
                <label :set="(id = `hero-background-${index}`)" :for="id">画像</label>
                <input :id="id" type="text" v-model="content.image" class="w-full" />
            </div>
        </template>
    </Editor>
</template>
