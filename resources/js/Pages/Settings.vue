<script setup>
import { onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { settings } from '@/Stores/app.js';

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

onMounted(() => {
    const clickableImages = document.querySelectorAll('.clickable-image');

    for (const image of clickableImages) {
        image.addEventListener('click', (clickEvent) => {
            const targetId = clickEvent.currentTarget.dataset.target;
            const imageInput = document.querySelector(targetId);
            imageInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                const reader = new FileReader();
                reader.onload = (event) => {
                    image.src = event.target.result;
                    clickEvent.currentTarget.src = event.target.result;
                };
                reader.readAsDataURL(file);
            });
            imageInput.click();
        });
    }
})
</script>

<template #header>
    <Head title="ページの管理" />

    <AuthenticatedLayout>
        <div class="container bg-white py-8 my-8 max-w-5xl">
            <form :action="route('settings')" method="post" enctype="multipart/form-data">
                <section class="settings flex flex-col gap-6 w-1/2">
                    <input type="hidden" name="_token" :value="csrf">
                    <section v-for="setting in settings">
                        <template v-if="setting.type === 'text'">
                            <div :class="setting.slug">
                                <label :for="setting.slug">{{ setting.label }}</label>
                            </div>

                            <div v-if="setting.slug !== 'description'">
                                <input type="text" :name="setting.slug" :id="setting.slug"
                                    class="border-0 border-b border-black" v-model="setting.content">
                            </div>

                            <div v-if="setting.slug === 'description'">
                                <textarea type="text" :name="setting.slug" :id="setting.slug"
                                    class="border-0 border-b border-black" v-model="setting.content"></textarea>
                            </div>
                        </template>

                        <template v-if="setting.type === 'image'">
                            <div :class="setting.slug">
                                <label :for="setting.slug">{{ setting.label }}</label>
                                <input type="file" :name="setting.slug" :id="setting.slug" class="hidden"
                                    accept="image/png,image/jpeg">
                            </div>

                            <div :id="setting.slug">
                                <img :src="setting.content" class="clickable-image h-12" :data-target="`#${setting.slug}`">
                            </div>
                        </template>
                    </section>

                    <section>
                        <div>
                            <button type="submit"
                                class="block ml-auto px-3 py-1 bg-blue-700 hover:bg-blue-400 text-white">設定を保存する</button>
                        </div>
                    </section>
                </section>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.settings>section {
    display: flex;
}

.settings>section>div:first-child {
    width: 10rem;
    flex-shrink: 0;
    display: flex;
    align-items: center;
}

.settings>section>div:last-child {
    width: 100%;
    flex-grow: 1;
}

input,
textarea {
    width: 100%;
}
</style>
