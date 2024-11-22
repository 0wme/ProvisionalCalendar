<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { defineProps, defineEmits } from 'vue';
import { Class } from '@/types/models';

defineProps<{
  classes: Class[];
  selectedClassId?: number;
}>();

const emit = defineEmits(['select']);

const handleSelect = (item: Class) => {
    emit('select', item);
}

const handleEdit = (item: Class) => {
    console.log(item);
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
    />
</template>