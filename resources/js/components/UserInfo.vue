<script setup lang="ts">
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useInitials } from '@/composables/useInitials';
import type { User } from '@/types';
import { computed } from 'vue';

interface Props {
    user: User | null;
    showEmail?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    showEmail: false,
});

const { getInitials } = useInitials();

// Compute whether we should show the avatar image
const showAvatar = computed(() => props.user?.avatar && props.user.avatar !== '');
</script>

<template>
    <div v-if="user" class="flex items-center gap-2">
        <Avatar class="size-8">
            <AvatarImage v-if="user.avatar" :src="user.avatar" :alt="user.name" />
            <AvatarFallback class="rounded-lg text-black">
                {{ user.name.charAt(0) }}
            </AvatarFallback>
        </Avatar>
        <div class="grid flex-1 text-left text-sm leading-tight">
            <span class="truncate font-semibold">{{ user.name }}</span>
            <span v-if="showEmail" class="truncate text-xs opacity-90">{{ user.email }}</span>
        </div>
    </div>
    <div v-else class="flex items-center gap-2">
        <Avatar class="size-8">
            <AvatarFallback class="rounded-lg text-black">
                ?
            </AvatarFallback>
        </Avatar>
        <div class="grid flex-1 text-left text-sm leading-tight">
            <span class="truncate font-semibold">Guest User</span>
            <span class="truncate text-xs opacity-90">Not logged in</span>
        </div>
    </div>
</template>
