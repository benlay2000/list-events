<script setup>
import Editor from '@/Layouts/Editor.vue';
import { inject } from 'vue';

const props = defineProps({
    index: Number,
});

const contents = inject('contents');
const content = contents[props.index];
</script>

<template>
    <Editor>
        <template #preview>
            <section class="flex flex-col gap-6 p-5">
                <header class="text-center">
                    <h1 class="text-lg font-bold">{{ content.heading }}</h1>
                    <p>{{ content.text }}</p>
                </header>

                <ul class="flex gap-6">
                    <li v-for="card in content.cardList" class="flex flex-col gap-3 h-full w-1/3">
                        <section class="image h-48 bg-gray-500 bg-cover" :style="{ backgroundImage: `url(${card.image})` }">
                        </section>

                        <section class="text mt-auto">
                            <h1 class="font-bold">{{ card.title }}</h1>
                            <p>{{ card.text }}</p>
                        </section>
                    </li>
                </ul>
            </section>
        </template>

        <template #editor>
            <div>
                <label :set="(id = `cards-heading-${index}`)" :for="id">見出し</label>
                <input :id="id" type="text" v-model="content.heading" class="w-full" />
            </div>

            <div>
                <label :set="(id = `cards-text-${index}`)" :for="id">テキスト</label>
                <textarea :id="id" type="text" v-model="content.text" class="w-full"></textarea>
            </div>
            <section class="cards w-full flex justify-between gap-6">
                <div v-for="(card, cardIndex) in content.cardList" class="flex flex-col gap-4">
                    <section>
                        <label :set="(subId = `card-${index}-${cardIndex}`)" :for="subId">タイトル</label>
                        <input type="text" :id="subId" v-model="card.title" class="w-full" />
                    </section>

                    <section>
                        <label :set="(subId = `card-text-${index}-${cardIndex}`)" :for="subId">テキスト</label>
                        <textarea type="text" :id="subId" v-model="card.text" class="w-full"></textarea>
                    </section>

                    <section>
                        <label :set="(subId = `card-image-${index}-${cardIndex}`)" :for="subId">画像</label>
                        <input type="text" :id="subId" v-model="card.image" class="w-full" />
                    </section>
                </div>
            </section>

        </template>
    </Editor>
</template>
