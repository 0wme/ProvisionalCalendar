<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { defineProps, defineEmits } from 'vue';
import { Group } from '@/types/models';

defineProps<{
  groups: Group[];
  selectedGroupId?: number;
}>();

const emit = defineEmits(['select', 'edit']);

const handleSelect = (item: Group) => {
    emit('select', item);
}

const handleEdit = (item: Group) => {
    emit('edit', item);
}
</script>

<template>
    <ListManager
        title="Groupes"
        class="w-full h-full"
        hasAdd
        :items="groups"
        :selectedItemsId="selectedGroupId ? [selectedGroupId] : undefined"
        @select="handleSelect"
        @edit="handleEdit"
    />
</template>