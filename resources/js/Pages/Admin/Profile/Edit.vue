<script lang="ts" setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>
    <AdminAuthenticatedLayout title="Profile">
        <div class="card">
            <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
        </div>
        <div class="card">
            <UpdatePasswordForm class="max-w-xl" />
        </div>
        <div class="card">
            <DeleteUserForm class="max-w-xl" />
        </div>
    </AdminAuthenticatedLayout>
</template>
