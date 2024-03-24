<script setup>
import Editor from '@/Layouts/Editor.vue';
import { inject } from 'vue';
import ClickableIcon from '../ClickableIcon.vue';

const props = defineProps({
    index: Number,
});

const contents = inject('contents');
const content = contents[props.index];
</script>

<template>
    <Editor>
        <template #preview>
            <div class="p-4 flex flex-col gap-4">
                <header class="text-center">
                    <h1 class="font-bold">{{ content.title }}</h1>
                    <p>
                        {{ content.text }}
                    </p>
                </header>

                <section class="content flex flex-col gap-2">
                    <div v-for="row in content.table" class="flex border-b last:border-none px-2 py-1">
                        <section class="th w-36 shrink-0 grow-0">{{ row.title }}</section>
                        <section class="table-content grow">{{ row.content }}</section>
                    </div>
                </section>
            </div>
        </template>

        <template #editor>
            <div class="p-4 flex flex-col gap-4">
                <header>
                    <h1>
                        <input type="text" v-model="content.title" class="w-full">
                    </h1>
                    <p>
                        <input type="text" v-model="content.text" class="w-full">
                    </p>
                </header>

                <section class="content flex flex-col gap-2">
                    <div v-for="row in content.table" class="flex py-1">
                        <section class="th w-36 shrink-0 grow-0">
                            <input type="text" v-model="row.title" class="w-full">
                        </section>
                        <section class="table-content grow">
                            <input type="text" v-model="row.content" class="w-full">
                        </section>
                    </div>

                    <div class="bg-white bg-opacity-90 flex justify-center">
                        <ClickableIcon @click="content.table.push({ title: '', content: '' })" icon-name="add" />
                    </div>
                </section>
            </div>
        </template>
    </Editor>
</template>
