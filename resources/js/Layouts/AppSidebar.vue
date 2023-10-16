<script lang="ts" setup>
import AppMenu from '@/Layouts/AppMenu.vue';

defineProps({
    menuModel: {
        type: Array,
        default: []
    }
});
</script>

<template>
    <AppMenu :menu-model="menuModel" />
</template>

<style lang="scss" scoped></style>
