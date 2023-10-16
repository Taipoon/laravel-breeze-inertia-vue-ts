<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    userCanLogin?: boolean;
    userCanRegister?: boolean;
    adminCanLogin?: boolean;
    adminCanRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();
</script>

<template>
    <Head title="Welcome" />
    <div class="flex flex-col justify-center items-center h-screen">
        <p class="text-center font-semibold text-2xl">Laravel + Inertia + Vue + PrimeVue Starter Kit</p>
        <p v-if="$page.props.auth.user">
            <Link v-if="$page.props.auth.guard === 'user'" :href="route('user.dashboard')">User Dashboard</Link>
            <Link v-if="$page.props.auth.guard === 'admin'" :href="route('admin.dashboard')">Admin Dashboard</Link>
        </p>
        <template v-else>
            <p v-if="userCanLogin">
                <Link :href="route('user.login')">User Login</Link>
            </p>
            <p v-if="adminCanLogin">
                <Link :href="route('admin.login')">Admin Login</Link>
            </p>

            <p v-if="userCanRegister">
                <Link :href="route('user.register')">User Register</Link>
            </p>
            <p v-if="adminCanRegister">
                <Link :href="route('admin.register')">Admin Register</Link>
            </p>
        </template>
    </div>
</template>
