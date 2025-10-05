<script setup lang="ts">
import NavBar from '@/components/NavBar.vue';
import ChatBot from '@/components/ChatBot.vue';
</script>

<template>
    <div class="min-h-screen bg-black">
        <!-- Navigation Bar -->
        <NavBar logoSrc="/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png" textColor="white" backgroundColor="black" />

        <!-- Main Content -->
        <main>
            <slot />
        </main>

        <!-- Chat Bot -->
        <ChatBot />
    </div>
</template>
