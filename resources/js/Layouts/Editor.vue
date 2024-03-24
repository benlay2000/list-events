<script setup>
</script>

<template>
    <section class="preview w-full">
        <slot name="preview" />
    </section>

    <section class="editor flex-col gap-4 w-full">
        <slot name="editor" />
    </section>
</template>
