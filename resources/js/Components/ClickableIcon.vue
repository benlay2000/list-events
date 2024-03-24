<template>
    <button type="button" @click="$emit('buttonClick')" class="flex items-center">
        <span class="material-symbols-outlined text-[30px]" :style="{color: textColor ?? 'black'}">
            {{ iconName }}
        </span>
    </button>
</template>

<script setup>
const props = defineProps({
    iconName: String,
    textColor: String,
})
</script>
