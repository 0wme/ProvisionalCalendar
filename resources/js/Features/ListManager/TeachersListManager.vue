<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { Teacher } from '@/types/models';
import AddTeacherPopup from '@/Components/Popup/AddTeacherPopup.vue';
import EditTeacherPopup from '@/Components/Popup/EditTeacherPopup.vue';
import { ref } from 'vue';

const props = defineProps<{
  title?: string;
  teachers: Teacher[];
}>();

const emit = defineEmits(['update', 'delete']);

const showAddPopup = ref(false);
const showEditPopup = ref(false);
const selectedTeacher = ref<Teacher | null>(null);

const openAddPopup = () => {
  showAddPopup.value = true;
};

const handleEdit = (teacher: Teacher) => {
  selectedTeacher.value = teacher;
  showEditPopup.value = true;
};

const handleUpdate = (updatedTeacher: Teacher) => {
  emit('update', updatedTeacher);
  showEditPopup.value = false;
};

const handleDelete = () => {
  if (selectedTeacher.value) {
    emit('delete', selectedTeacher.value);
  }
  showEditPopup.value = false;
};

const handleAdd = (newTeacher: Partial<Teacher>) => {
  emit('add', newTeacher);
  showAddPopup.value = false;
};
</script>

<template>
  <div class="teachers-list-manager h-full w-full">
    <ListManager
      title="Enseignants"
      hasAdd
      :items="teachers"
      @add="openAddPopup"
      @edit="handleEdit"
    />

    <AddTeacherPopup
      v-if="showAddPopup"
      @close="showAddPopup = false"
      @add="handleAdd"
    />

    <EditTeacherPopup
      v-if="showEditPopup && selectedTeacher"
      :initial-values="selectedTeacher"
      @close="showEditPopup = false"
      @update="handleUpdate"
      @delete="handleDelete"
    />
  </div>
</template>
