<script lang="ts" setup>
import { Head, Link, usePage } from "@inertiajs/vue3";

defineProps<{
    userCanLogin?: boolean;
    userCanRegister?: boolean;
    adminCanLogin?: boolean;
    adminCanRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

const guard = usePage().props.guard ?? "Unauthenticated";
</script>

<template>
    <Head title="Welcome" />

    <div class="h-screen flex flex-col items-center justify-center">
        <div>Current Guard: {{ guard }}</div>
        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
            >Dashboard
        </Link>

        <div v-if="userCanLogin" class="flex flex-col justify-between">
            <Link :href="route('user.login')"> Log in for User</Link>

            <Link v-if="userCanRegister" :href="route('user.register')"
                >Register for User
            </Link>
        </div>

        <div v-if="adminCanLogin" class="flex flex-col justify-between">
            <Link :href="route('admin.login')"> Log in for Admin</Link>
            <Link v-if="adminCanRegister" :href="route('admin.register')"
                >Register for Admin
            </Link>
        </div>
    </div>
</template>
