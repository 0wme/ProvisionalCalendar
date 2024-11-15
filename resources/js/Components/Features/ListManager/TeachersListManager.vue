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

const emit = defineEmits(['select']);

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
    <div class="teachers-list-manager min-h-full w-full">
        <ListManager
            title="Enseignants"
            class="w-full h-full"
            hasAdd
            :items="teachers"
            @select="handleSelect"
            @add="openPopup"
            @edit="handleEdit"
        />
    
        <TeacherPopup 
            class="z-50"
            v-if="showPopup" 
            :is-editing="false"
            @close="showPopup = false" 
        />

        <TeacherPopup 
            class="z-50"
            v-if="showPopupEdit" 
            :is-editing="true"
            @close="showPopupEdit = false" 
        />
    </div>
</template>
