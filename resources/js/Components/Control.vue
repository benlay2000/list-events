<script setup>
import { inject } from 'vue';
import ClickableIcon from '@/Components/ClickableIcon.vue';

const props = defineProps({
    index: Number,
});

const contents = inject('contents');

function move(index, direction) {
    const offset = direction === "up" ? -1 : 1;
    [contents[index], contents[index + offset]] = [contents[index + offset], contents[index]];
}

function del(index) {
    contents.splice(index, 1);
}

function toggleEditor(index, editorVisibility) {
    const currentContent = document.querySelector(`.content#content-${index}`);
    const editButton = currentContent.querySelector('.edit-button');
    const saveButton = currentContent.querySelector('.save-button');
    const editor = currentContent.querySelector('.editor');
    editor.style.display = editorVisibility ? 'flex' : 'none';
    editButton.style.display = editorVisibility ? 'none' : 'block';
    saveButton.style.display = editorVisibility ? 'block' : 'none';
}

</script>

<template>
    <div class="flex flex-row justify-between px-3 py-2 bg-gray-50">
        <section class="move-control flex">
            <p v-if="index !== 0">
                <ClickableIcon icon-name="expand_less" @buttonClick="move(index, 'up')" />
            </p>

            <p v-if="index !== (contents.length - 1)">
                <ClickableIcon icon-name="expand_more" @buttonClick="move(index, 'down')" />
            </p>


        </section>

        <section class="edit">
            <p>
                <ClickableIcon icon-name="edit" @buttonClick="toggleEditor(index, true)" class="edit-button" />
                <ClickableIcon icon-name="save" @buttonClick="toggleEditor(index, false)" class="hidden save-button" />
            </p>
        </section>

        <section class="remove">
            <p>
                <ClickableIcon icon-name="delete" @buttonClick="del(index)" />
            </p>
        </section>
    </div>
</template>
