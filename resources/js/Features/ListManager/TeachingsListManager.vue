<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { Teaching, Period } from '@/types/models';
import { defineProps } from 'vue';

defineProps<{
    title: string;
    periods: Period[];
    teachings: Teaching[];
}>();
</script>

<template>
    <ListManager
        title="Enseignements"
        hasAdd
        :periods
        :items="teachings"
        style="width: 600px; height: 50vh;"
    />
</template>
