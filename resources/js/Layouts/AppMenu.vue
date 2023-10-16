<script lang="ts" setup>
import AppMenuItem from '@/Layouts/AppMenuItem.vue';

defineProps({
    menuModel: {
        type: Array,
        default: []
    }
});
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in menuModel" :key="item">
            <AppMenuItem v-if="!item.separator" :index="i" :item="item" />
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
    </ul>
</template>

<style lang="scss" scoped></style>
