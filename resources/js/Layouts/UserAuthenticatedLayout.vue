<script lang="ts" setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const logout = () => {
    router.post(route('user.logout'));
};

const model = ref([
    {
        label: 'User Menu',
        items: [{ label: 'Top', icon: 'pi pi-fw pi-home', to: '/' }]
    },
    {
        label: 'Navigations',
        items: [
            { label: 'Dashboard', icon: 'pi pi-fw pi-id-card', to: route('user.dashboard') },
            { label: 'Profile', icon: 'pi pi-fw pi-id-card', to: route('user.profile.edit') }
        ]
    },
    {
        label: 'Personal',
        items: [{ label: 'Log out', icon: 'pi pi-fw pi-user', command: logout }]
    }
]);

defineProps({
    title: {
        type: String,
        default: ''
    }
});
</script>

<template>
    <AppLayout :menu-model="model" :title="title">
        <slot />
    </AppLayout>
</template>
