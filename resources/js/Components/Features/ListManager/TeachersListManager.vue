<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { Teacher } from '@/types/models';
import { defineProps, defineEmits } from 'vue';
import TeacherPopup from '@/Components/Popup/TeacherPopup.vue';
import { ref } from 'vue';

defineProps<{
  title: string;
  teachers: Teacher[];
}>();

const emit = defineEmits(['select', 'add', 'edit']);

const handleSelect = (teacher: Teacher) => {
    emit('select', teacher);
}

const handleEdit = (teacher: Teacher) => {
    showPopupEdit.value = true;
}

const showPopup = ref(false);
const showPopupEdit = ref(false);

const openPopup = () => {
    showPopup.value = true;
}
</script>

<template>
    <ListManager
        title="Enseignants"
        class="w-full h-full"
        hasAdd
        :items="teachers"
        @select="handleSelect"
        @add="emit('add')"
        @edit="emit('edit', $event)"
    />
</template>
