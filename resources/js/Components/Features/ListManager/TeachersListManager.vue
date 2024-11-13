<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { Teacher } from '@/types/models';
import { defineProps, defineEmits } from 'vue';

defineProps<{
  title: string;
  teachers: Teacher[];
}>();

const emit = defineEmits(['select']);

const handleSelect = (teacher: Teacher) => {
    emit('select', teacher);
}
</script>

<template>
    <ListManager
        title="Enseignants"
        hasAdd
        :items="teachers"
        @select="handleSelect"
    />
</template>
