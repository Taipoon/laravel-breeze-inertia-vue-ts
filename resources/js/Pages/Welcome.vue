<script lang="ts" setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps<{
    userCanLogin?: boolean;
    userCanRegister?: boolean;
    adminCanLogin?: boolean;
    adminCanRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

const auth = computed(() => usePage().props.auth);
</script>

<template>
    <Head title="Welcome" />

    <div class="h-screen w-full md:w-1/2 mx-auto flex flex-col items-center justify-center">
        <p class="bg-gray-800 text-white font-semibold p-4 w-full mx-auto mb-16">
            <code>
                <pre>props = {{ props }}</pre>
            </code>
            <code>
                <pre>usePage().props.auth = {{ auth }}</pre>
            </code>
        </p>

        <template v-if="auth.user">
            <div class="mb-8">
                <template v-if="auth.guard === 'user'">
                    <Link :href="route('user.dashboard')">
                        <PrimaryButton>User Dashboard</PrimaryButton>
                    </Link>
                </template>
                <template v-if="auth.guard === 'admin'">
                    <Link :href="route('admin.dashboard')">
                        <PrimaryButton>Admin Dashboard</PrimaryButton>
                    </Link>
                </template>
            </div>
        </template>
        <template v-else>
            <div class="space-y-8">
                <div class="w-full flex justify-around space-x-8">
                    <div>
                        <Link v-if="userCanLogin" :href="route('user.login')">
                            <SecondaryButton>Log in for User</SecondaryButton>
                        </Link>
                    </div>
                    <div>
                        <Link v-if="userCanRegister" :href="route('user.register')">
                            <SecondaryButton>Register for User</SecondaryButton>
                        </Link>
                    </div>
                </div>

                <div class="w-full flex justify-around space-x-8">
                    <div>
                        <Link v-if="adminCanLogin" :href="route('admin.login')">
                            <SecondaryButton>Log in for Admin</SecondaryButton>
                        </Link>
                    </div>
                    <div>
                        <Link v-if="adminCanRegister" :href="route('admin.register')">
                            <SecondaryButton>Register for Admin</SecondaryButton>
                        </Link>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>
