<script setup lang="ts">
import NavBar from '@/components/NavBar.vue';
import ChatBot from '@/components/ChatBot.vue';
</script>

<template>
    <div class="min-h-screen bg-black">
        <!-- Navigation Bar -->
        <NavBar logoSrc="/asset/logo-new-white.png" textColor="white" backgroundColor="black" />

        <!-- Main Content -->
        <main>
            <slot />
        </main>

        <!-- Chat Bot -->
        <ChatBot />
    </div>
</template>
