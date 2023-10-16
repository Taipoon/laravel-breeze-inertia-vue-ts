<script lang="ts" setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const logout = () => {
    router.post(route('admin.logout'));
};

const model = ref([
    {
        label: 'Administrator Menu',
        items: [{ label: 'Top', icon: 'pi pi-fw pi-home', to: '/' }]
    },
    {
        label: 'Navigations',
        items: [
            { label: 'Dashboard', icon: 'pi pi-fw pi-id-card', to: route('admin.dashboard') },
            { label: 'Profile', icon: 'pi pi-fw pi-id-card', to: route('admin.profile.edit') }
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
