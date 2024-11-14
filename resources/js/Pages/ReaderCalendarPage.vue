<script setup lang="ts">
import Sidebar from '../Components/Navigation/Sidebar.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    message?: string;
    role?: string;
}>();

console.log(props.role);
console.log(props.message);
</script>

<template>
    <Head title="Calendrier Prévisionnel Lecteur" />
    <div class="page-content">
        <Sidebar />
        <div class="main-content">
            <div v-if="message" class="welcome-message">
                {{ message }}
            </div>
        </div>
    </div>
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

.page-content {
    display: flex;
}

.main-content {
    flex-grow: 1;
    padding: 20px;
}
</style>