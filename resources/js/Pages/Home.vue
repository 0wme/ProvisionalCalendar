<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import SearchBar from '@/Components/SearchBar.vue';
</script>

<template>
    <Head title="Calendrier prévisionnel" />
    <div class="flex justify-center items-center h-screen">
        <SearchBar placeholder="test" hasAdd hasImport small />
    </div>
</template>
