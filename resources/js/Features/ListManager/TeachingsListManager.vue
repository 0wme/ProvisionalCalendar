<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { Teaching, Period } from '@/types/models';
import { defineProps, defineEmits } from 'vue';

defineProps<{
    periods: Period[];
    teachings: Teaching[];
    selectedTeachingId?: number[];
}>();

const emit = defineEmits(['add', 'edit', 'select']);

const handleSelect = (teaching: Teaching) => {
    emit('select', teaching);
}

const handleEdit = (teaching: Teaching) => {
    emit('edit', teaching);
}

const handleAdd = () => {
    emit('add');
}
</script>

<template>
    <ListManager
        title="Enseignements"
        hasAdd
        hasImport
        :periods
        :items="teachings"
        :selectedItemsId="selectedTeachingId"
        @add="handleAdd"
        @edit="handleEdit"
        @select="handleSelect"
    />
</template>
