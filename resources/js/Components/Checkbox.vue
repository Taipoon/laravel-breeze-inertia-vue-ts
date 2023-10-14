<script lang="ts" setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps<{
    checked: boolean;
    value?: any;
}>();

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    }
});
</script>

<template>
    <input v-model="proxyChecked" :value="value" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" type="checkbox" />
</template>
