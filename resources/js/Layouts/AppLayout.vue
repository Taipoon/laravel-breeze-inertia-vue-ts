<script lang="ts" setup>
import { computed, ref, watch } from 'vue';

import { useLayout } from '@/Layouts/composables/layout';
import { Head } from '@inertiajs/vue3';
import AppTopbar from '@/Layouts/AppTopbar.vue';
import AppSidebar from '@/Layouts/AppSidebar.vue';
import AppFooter from '@/Layouts/AppFooter.vue';

const { layoutConfig, layoutState, isSidebarActive } = useLayout();

const outsideClickListener = ref(null);

watch(isSidebarActive, (newVal) => {
    if (newVal) {
        bindOutsideClickListener();
    } else {
        unbindOutsideClickListener();
    }
});

const containerClass = computed(() => {
    return {
        'layout-theme-light': layoutConfig.darkTheme.value === 'light',
        'layout-theme-dark': layoutConfig.darkTheme.value === 'dark',
        'layout-overlay': layoutConfig.menuMode.value === 'overlay',
        'layout-static': layoutConfig.menuMode.value === 'static',
        'layout-static-inactive': layoutState.staticMenuDesktopInactive.value && layoutConfig.menuMode.value === 'static',
        'layout-overlay-active': layoutState.overlayMenuActive.value,
        'layout-mobile-active': layoutState.staticMenuMobileActive.value,
        'p-input-filled': layoutConfig.inputStyle.value === 'filled',
        'p-ripple-disabled': !layoutConfig.ripple.value
    };
});
const bindOutsideClickListener = () => {
    if (!outsideClickListener.value) {
        outsideClickListener.value = (event) => {
            if (isOutsideClicked(event)) {
                layoutState.overlayMenuActive.value = false;
                layoutState.staticMenuMobileActive.value = false;
                layoutState.menuHoverActive.value = false;
            }
        };
        document.addEventListener('click', outsideClickListener.value);
    }
};
const unbindOutsideClickListener = () => {
    if (outsideClickListener.value) {
        document.removeEventListener('click', outsideClickListener);
        outsideClickListener.value = null;
    }
};
const isOutsideClicked = (event) => {
    const sidebarEl = document.querySelector('.layout-sidebar');
    const topbarEl = document.querySelector('.layout-menu-button');

    return !(sidebarEl.isSameNode(event.target) || sidebarEl.contains(event.target) || topbarEl.isSameNode(event.target) || topbarEl.contains(event.target));
};

defineProps({
    title: {
        type: String,
        default: ''
    },
    menuModel: {
        type: Array,
        default: []
    }
});
</script>

<template>
    <Toast />
    <div :class="containerClass" class="layout-wrapper">
        <AppTopbar />
        <div class="layout-sidebar">
            <AppSidebar :menu-model="menuModel" />
        </div>
        <div class="layout-main-container">
            <div class="layout-main">
                <Head :title="title" />
                <slot />
            </div>
            <AppFooter />
        </div>

        <!-- Optional Configurations -->
        <!-- <AppConfig /> -->
        <!-- <div class="layout-mask"></div> -->
    </div>
</template>

<style lang="scss" scoped></style>
