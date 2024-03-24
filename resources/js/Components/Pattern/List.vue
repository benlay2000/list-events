<script setup>
import { inject } from 'vue';
import Editor from '@/Layouts/Editor.vue';
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
            <section class="p-4">
                <header class="text-center">
                    <h1 class="font-bold text-xl">{{ content.heading }}</h1>
                    <p>{{ content.text }}</p>
                </header>
                <ul class="flex flex-col gap-4">
                    <li v-for="item in content.list">
                        <div class="flex gap-4">
                            <div class="image w-1/6 aspect-[4/3] bg-cover bg-gray-400 bg-center"
                                :style="{ backgroundImage: `url(${item.image})` }"></div>
                            <div class="p-4 w-5/6">
                                <h1 class="font-bold">{{ item.title }}</h1>
                                <p>{{ item.text }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
        </template>

        <template #editor>
            <div>
                <label :set="id = `cards-heading-${index}`" :for="id">見出し</label>
                <input :id="id" type="text" v-model="content.heading" class="w-full">
            </div>

            <div>
                <label :set="id = `cards-text-${index}`" :for="id">テキスト</label>
                <textarea :id="id" type="text" v-model="content.text" class="w-full"></textarea>
            </div>
            <section class="cards w-full flex justify-between gap-6">
                <div v-for="card, cardIndex in content.list" class="flex flex-col gap-4">
                    <section>
                        <label :set="subId = `card-${index}-${cardIndex}`" :for="subId">タイトル</label>
                        <input type="text" :id="subId" :value="card.title" class="w-full">
                    </section>

                    <section>
                        <label :set="subId = `card-text-${index}-${cardIndex}`" :for="subId">テキスト</label>
                        <textarea type="text" :id="subId" :value="card.text" class="w-full"></textarea>
                    </section>

                    <section>
                        <label :set="subId = `card-image-${index}-${cardIndex}`" :for="subId">画像</label>
                        <input type="text" :id="subId" :value="card.image" class="w-full">
                    </section>
                </div>


            </section>
            <div class="bg-white bg-opacity-90 flex justify-center">
                <ClickableIcon @click="content.list.push({ title: '', text: '', image: '' })" icon-name="add" />
            </div>
        </template>
    </Editor>
</template>
