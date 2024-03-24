<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { provide } from 'vue';
import { settings, contents } from '@/Stores/app.js';
import Control from '@/Components/Control.vue';
import Header from '@/Components/Pattern/Header.vue';
import Cover from '@/Components/Pattern/Cover.vue';
import LongText from '@/Components/Pattern/LongText.vue';
import Cards from '@/Components/Pattern/Cards.vue';
import Hero from '@/Components/Pattern/Hero.vue';
import List from '@/Components/Pattern/List.vue';
import Table from '@/Components/Pattern/Table.vue';
import Footer from '@/Components/Pattern/Footer.vue';
import Layout from '@/lib/Layout';

const layout = new Layout();

const contentList = contents.value;
provide('settings', settings.value);
provide('contents', contentList);

function updateLayout(object, target) {
    target.push(object);
}
</script>

<template #header>
    <Head title="ページの管理" />

    <AuthenticatedLayout>
        <div class="container flex gap-8 my-8 py-8 justify-between bg-white max-w-5xl">
            <section id="layout" class="w-64 shrink-0 grow-0 ">
                <header>
                    <h1 class="font-bold">パーツを追加する</h1>
                </header>

                <section>
                    <ul class="layout-list flex flex-col gap-4">
                        <li>
                            <button @click="updateLayout(layout.cover(), contentList)">
                                <img src="../../images/layout/Hero.png" alt="" srcset="">
                            </button>
                        </li>

                        <li>
                            <button @click="updateLayout(layout.longText(), contentList)">
                                <img src="../../images/layout/Lead.png" alt="" srcset="">
                            </button>
                        </li>

                        <li>
                            <button @click="updateLayout(layout.cards(), contentList)">
                                <img src="../../images/layout/Cards.png" alt="" srcset="">
                            </button>
                        </li>

                        <li>
                            <button @click="updateLayout(layout.hero(), contentList)">
                                <img src="../../images/layout/CTA.png" alt="" srcset="">
                            </button>
                        </li>

                        <li>
                            <button @click="updateLayout(layout.list(), contentList)">
                                <img src="../../images/layout/List.png" alt="" srcset="">
                            </button>
                        </li>

                        <li>
                            <button @click="updateLayout(layout.table(), contentList)">
                                <img src="../../images/layout/Table.png" alt="" srcset="">
                            </button>
                        </li>
                    </ul>
                </section>
            </section>

            <section id="builder" class="grow flex flex-col gap-6">
                <section class="builder">
                    <Header :siteTitle="settings.title" :siteLogo="settings.logo" />

                    <main role="main" class="main-contents flex flex-col gap-16">
                        <div v-for="content, index in contents"
                            class="content flex flex-col items-stretch relative border border-gray-200" :id="`content-${index}`">
                            <Cover :index="index" v-if="content.type === 'cover'" />

                            <LongText :index="index" v-if="content.type === 'long-text'" />

                            <Cards :index="index" v-if="content.type === 'cards'" />

                            <Hero :index="index" v-if="content.type === 'hero'" />

                            <List :index="index" v-if="content.type === 'list'" />

                            <Table :index="index" v-if="content.type === 'table'" />

                            <Control :index="index" />
                        </div>
                        <Footer />
                    </main>
                </section>
            </section>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.content {
    position: relative;
}

.content>div:last-child {
    position: relative;
    width: 100%;
}

.editor {
    width: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    padding: 1rem;
    color: aliceblue;
    z-index: 100;
    display: none;
}

.editor input,
.editor textarea {
    color: black;
}
</style>
