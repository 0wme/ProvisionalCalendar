<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { defineProps, defineEmits } from 'vue';
import { Group } from '@/types/models';

defineProps<{
  groups: Group[];
  selectedGroupId?: number;
}>();

const emit = defineEmits(['select', 'edit', 'add']);

const handleSelect = (item: Group) => {
    emit('select', item);
}

const handleEdit = (item: Group) => {
    emit('edit', item);
}

const handleAdd = () => {
    emit('add');
}
</script>

<template>
    <ListManager
        title="Groupes"
        hasAdd
        :items="groups"
        :selectedItemsId="selectedGroupId ? [selectedGroupId] : undefined"
        @select="handleSelect"
        @edit="handleEdit"
        @add="handleAdd"
    />
</template>