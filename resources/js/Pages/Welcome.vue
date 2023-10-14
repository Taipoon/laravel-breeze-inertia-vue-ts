<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();
</script>

<template>
    <Head title="Welcome" />
    <div class="flex flex-col justify-center items-center h-screen">
        <p class="text-center font-semibold text-2xl">Laravel + Inertia + Vue + PrimeVue Starter Kit</p>
        <p v-if="$page.props.auth.user">
            <Link :href="route('dashboard')"> Dashboard</Link>
        </p>
        <p v-if="canLogin">
            <Link :href="route('login')">Login</Link>
        </p>
        <p v-if="canRegister">
            <Link :href="route('register')">Register</Link>
        </p>
    </div>
</template>
