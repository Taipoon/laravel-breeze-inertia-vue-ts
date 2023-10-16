<script lang="ts" setup>
import UserAuthenticatedLayout from '@/Layouts/UserAuthenticatedLayout.vue';
</script>

<template>
    <UserAuthenticatedLayout title="Dashboard">
        <div class="card">
            <p class="bg-gray-700 text-white font-semibold p-4 rounded-lg">
                <code>
                    <pre>{{ $page.props.auth }}</pre>
                </code>
            </p>
        </div>
    </UserAuthenticatedLayout>
</template>
