<script setup lang="ts">
import { ref } from 'vue';
import Toast from './Toast.vue';

interface ToastMessage {
    id: string;
    message: string;
    type: 'success' | 'error' | 'warning' | 'info';
    duration?: number;
}

const toasts = ref<ToastMessage[]>([]);

const addToast = (message: string, type: 'success' | 'error' | 'warning' | 'info' = 'success', duration: number = 5000) => {
    const id = Date.now().toString();
    toasts.value.push({
        id,
        message,
        type,
        duration
    });
};

const removeToast = (id: string) => {
    const index = toasts.value.findIndex(toast => toast.id === id);
    if (index > -1) {
        toasts.value.splice(index, 1);
    }
};

// Expose methods to parent components
defineExpose({
    addToast
});
</script>

<template>
    <div class="fixed top-4 right-4 z-50 space-y-2">
        <Toast
            v-for="toast in toasts"
            :key="toast.id"
            :message="toast.message"
            :type="toast.type"
            :duration="toast.duration"
            :show="true"
            @close="removeToast(toast.id)"
        />
    </div>
</template>
