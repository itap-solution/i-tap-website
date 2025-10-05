<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const emit = defineEmits<{
    openAddProject: [];
}>();

const handleOpenAddProject = () => {
    emit('openAddProject');
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs" @openAddProject="handleOpenAddProject">
        <slot />
    </AppLayout>
</template>
