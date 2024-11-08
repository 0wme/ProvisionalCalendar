<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { defineProps, defineEmits } from 'vue';
import { Item } from '@/types/models';

defineProps<{
  title: string;
  groups: Item[];
}>();

const emit = defineEmits(['select']);

const handleSelect = (item: Item) => {
  emit('select', item);
}
</script>

<template>
  <ListManager
    title="Groupes"
    hasAdd
    :items="groups"
    @select="handleSelect"
  />
</template>