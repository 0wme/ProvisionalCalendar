<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { defineProps, defineEmits } from 'vue';
import { Class } from '@/types/models';

defineProps<{
  classes: Class[];
  selectedClassId?: number;
}>();

const emit = defineEmits(['select', 'edit', 'add']);

const handleSelect = (item: Class) => {
    emit('select', item);
}

const handleEdit = (item: Class) => {
    emit('edit', item);
}

const handleAdd = () => {
    emit('add');
}
</script>

<template>
    <ListManager
        title="Promotions"
        hasAdd
        :items="classes"
        :selectedItemsId="selectedClassId ? [selectedClassId] : undefined"
        @select="handleSelect"
        @edit="handleEdit"
        @add="handleAdd"
    />
</template>