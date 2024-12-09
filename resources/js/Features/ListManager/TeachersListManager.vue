<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { Teacher } from '@/types/models';
import { defineProps, defineEmits } from 'vue';

defineProps<{
    teachers: Teacher[];
    selectedTeacherId?: number[];
}>();

const emit = defineEmits(['select', 'add', 'edit']);

const handleSelect = (teacher: Teacher) => {
    emit('select', teacher);
}

const handleEdit = (teacher: Teacher) => {
    emit('edit', teacher);
}

const handleAdd = () => {
    emit('add');
}
</script>

<template>
    <ListManager
        title="Enseignants"
        hasAdd
        :items="teachers"
        :selectedItemsId="selectedTeacherId"
        @select="handleSelect"
        @add="handleAdd"
        @edit="handleEdit"
    />
</template>