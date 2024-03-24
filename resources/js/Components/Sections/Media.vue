<script setup>
import { ref } from "vue";
import axios from "axios";

const media = ref([]);
const errorFiles = ref([]);
const uploadMaxFilesize = ref('');
let selectedMedia = ref(null);

const csrf = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

function selectMedia(selector) {
    const fileInput = document.querySelector(`input[type="file"]${selector}`);
    fileInput.click();
}

function getPhpSettings() {
    axios.get(route('php-settings'))
        .then((response) => {
            uploadMaxFilesize.value = response.data.uploadMaxFilesize;
        })
        .catch(() => {
            console.log("error");
        });
}

function getMedia() {
    axios.get(route('media'))
        .then((response) => {
            media.value = response.data;
        })
        .catch(() => {
            console.log("error");
        });
}

async function uploadMedia(event) {
    const media = event.target.files;
    event.preventDefault();

    for (const file of media) {
        await axios({
            method: "post",
            url: route("media"),
            data: {
                file: file,
                _token: csrf,
            },
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
            .then((response) => {
                event.target.value = null;
                getMedia();
            })
            .catch((error) => {
                errorFiles.value.push(file.name);
                console.log(error);
            });
    }
}

function deleteMedium(id) {
    selectedMedia.value = null;
    axios.delete(route('media'), {
        data: {
            id: id,
            _token: csrf,
        },
    })
        .then((response) => {
            getMedia();
            console.log(response);
        })
        .catch(() => {
            console.log("error");
        });
}

const toggleSelection = (medium) => {
    media.value.forEach((item) => {
        item.selected = false
    }); // 全ての選択状態を解除
    medium.selected = !medium.selected; // 選択状態をトグル
};

function mediumClicked(medium) {
    toggleSelection(medium);
    selectedMedia.value = medium;
}

function init() {
    getPhpSettings();
    getMedia();
}

init();
</script>

<template>
    <div class="media py-8">
        <div class="media-content flex gap-[1px] w-full bg-gray-200">
            <section class="navigation shrink-0 bg-white py-4 px-8">
                <nav>
                    <ul class="flex flex-col gap-4 w-fit">
                        <li>
                            <button class="btn bg-primary" @click="selectMedia('#upload')">アップロード</button>
                            <input type="file" class="hidden" id="upload" @change="uploadMedia" accept="image/*">
                        </li>
                        <li>
                            <button class="select-media" data-media-type="myfile">自分のファイル</button>
                        </li>
                        <li>
                            <button class="select-media" data-media-type="elvyta">elvyta 画像</button>
                        </li>
                    </ul>
                </nav>
            </section>

            <section class="contents-area flex flex-col gap-[1px] grow-1 w-full">
                <div class="flex gap-[1px]">
                    <div
                        class="media min-h-[800px] bg-white p-6 grow w-full">
                        <div v-for="medium, index in media"
                            class="w-[150px] h-[150px] bg-cover cursor-pointer relative inline-block m-4" @click="mediumClicked(medium)"
                            :data-index="index" :style="[`background-image: url(${medium.url})`]">
                            <div class="checkmark text-gray-700 bg-white w-fit px-1 absolute" v-if="medium.selected">
                                &#x2714;</div>
                        </div>
                    </div>

                    <div class="information w-64 bg-white shrink-0 grow-0 p-10">

                        <div v-if="selectedMedia !== null">
                            <p>
                                <img :src="selectedMedia.url" alt="">
                            </p>
                            <dl>
                                <dt>ファイル名</dt>
                                <dd class="break-words">{{ selectedMedia.file_name }}</dd>

                                <dt>ファイルサイズ</dt>
                                <dd>{{ selectedMedia.file_size }} B</dd>
                            </dl>
                            <button class="btn bg-danger" @click="deleteMedium(selectedMedia.id)">削除</button>
                        </div>

                    </div>

                </div>

                <div class="controls grow-0 bg-white p-4">
                    <section class="buttons flex justify-end">
                        <button class="btn bg-secondary">選択</button>
                    </section>
                </div>
            </section>
        </div>
    </div>
</template>
