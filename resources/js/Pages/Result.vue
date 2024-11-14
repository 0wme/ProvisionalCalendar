<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps<{
    message: string;
}>();
</script>

<template>
    <Head title="Résultat" />
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-2xl font-bold text-gray-800">
            {{ message }}
        </div>
    </div>
</template>
