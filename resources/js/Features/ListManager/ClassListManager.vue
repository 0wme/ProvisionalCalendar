<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { defineProps, defineEmits } from 'vue';
import { Item } from '@/types/models';

defineProps<{
  title: string;
  classes: Item[];
}>();

const emit = defineEmits(['select']);

const handleSelect = (item: Item) => {
  emit('select', item);
}
</script>

<template>
  <ListManager
    title="Promotions"
    hasAdd
    :items="classes"
    @select="handleSelect"
  />
</template>