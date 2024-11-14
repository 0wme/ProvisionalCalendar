<script setup lang="ts">
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps<{
    message?: string;
    role?: string;
}>();

console.log(props.role);
console.log(props.message);
</script>

<template>
    <MainLayout>
        <div v-if="message" class="welcome-message">
            {{ message }}
        </div>
        <h1>Calendrier Prévisionnel Lecteur</h1>
    </MainLayout>
</template>

<style scoped>
.welcome-message {
    background-color: #f3f4f6;
    padding: 1rem;
    margin: 1rem;
    border-radius: 0.5rem;
    text-align: center;
    font-size: 1.1rem;
    color: #374151;
}
</style>