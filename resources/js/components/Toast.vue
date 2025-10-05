<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { CheckCircle, XCircle, AlertCircle, X } from 'lucide-vue-next';

interface ToastProps {
    message: string;
    type?: 'success' | 'error' | 'warning' | 'info';
    duration?: number;
    show: boolean;
}

const props = withDefaults(defineProps<ToastProps>(), {
    type: 'success',
    duration: 5000
});

const emit = defineEmits<{
    close: [];
}>();

const isVisible = ref(false);

onMounted(() => {
    if (props.show) {
        isVisible.value = true;
        if (props.duration > 0) {
            setTimeout(() => {
                closeToast();
            }, props.duration);
        }
    }
});

const closeToast = () => {
    isVisible.value = false;
    setTimeout(() => {
        emit('close');
    }, 300);
};

const getIcon = () => {
    switch (props.type) {
        case 'success':
            return CheckCircle;
        case 'error':
            return XCircle;
        case 'warning':
            return AlertCircle;
        default:
            return CheckCircle;
    }
};

const getColors = () => {
    switch (props.type) {
        case 'success':
            return {
                bg: 'bg-green-50',
                border: 'border-green-200',
                text: 'text-green-800',
                icon: 'text-green-500'
            };
        case 'error':
            return {
                bg: 'bg-red-50',
                border: 'border-red-200',
                text: 'text-red-800',
                icon: 'text-red-500'
            };
        case 'warning':
            return {
                bg: 'bg-yellow-50',
                border: 'border-yellow-200',
                text: 'text-yellow-800',
                icon: 'text-yellow-500'
            };
        default:
            return {
                bg: 'bg-blue-50',
                border: 'border-blue-200',
                text: 'text-blue-800',
                icon: 'text-blue-500'
            };
    }
};

const colors = getColors();
const IconComponent = getIcon();
</script>

<template>
    <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="transform translate-y-2 opacity-0"
        enter-to-class="transform translate-y-0 opacity-100"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="transform translate-y-0 opacity-100"
        leave-to-class="transform translate-y-2 opacity-0"
    >
        <div
            v-if="isVisible"
            class="fixed top-4 right-4 z-50 max-w-sm w-full"
        >
            <div
                :class="[
                    colors.bg,
                    colors.border,
                    'border rounded-lg shadow-lg p-4 flex items-start space-x-3'
                ]"
            >
                <IconComponent
                    :class="[colors.icon, 'w-5 h-5 mt-0.5 flex-shrink-0']"
                />
                <div class="flex-1">
                    <p :class="[colors.text, 'text-sm font-medium']">
                        {{ message }}
                    </p>
                </div>
                <button
                    @click="closeToast"
                    class="text-gray-400 hover:text-gray-600 transition-colors"
                >
                    <X class="w-4 h-4" />
                </button>
            </div>
        </div>
    </Transition>
</template>
