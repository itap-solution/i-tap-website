<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>
    <div v-show="message" class="text-sm">
        <p class="text-sm text-red-600">
            {{ message }}
        </p>
    </div>
</template>
