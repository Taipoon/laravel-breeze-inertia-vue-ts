<script lang="ts" setup>
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
</script>

<template>
    <AdminAuthenticatedLayout title="Dashboard">
        <div class="card">
            <p class="bg-gray-700 text-white font-semibold p-4 rounded-lg">
                <code>
                    <pre>{{ $page.props.auth }}</pre>
                </code>
            </p>
        </div>
    </AdminAuthenticatedLayout>
</template>
