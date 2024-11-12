<template>
  <div class="page-content">
    <HeaderMenu />
    <Sidebar />
    <div class="main-content">
      <!-- Contenu de la page Enseignants/Enseignements -->
      <TeachersListManager
        title="Liste des Enseignants"
        :teachers
      />
      <TeachingsListManager
        title="Liste des Enseignements"
        :teachings
      />
    </div>
  </div>
</template>

<script setup lang="ts">
import Sidebar from '../Components/Navigation/Sidebar.vue';
import HeaderMenu from '../Components/Navigation/HeaderMenu.vue';
import TeachersListManager from '../Components/Features/ListManager/TeachersListManager.vue';
import { ref } from 'vue';
import { Teacher } from '@/types/model';
import TeachingsListManager from '../Components/Features/ListManager/TeachingsListManager.vue';
import { Teaching } from '@/types/model';
const teachers = ref<Teacher[]>([
  { id: 1, name: 'John Doe', firstname: 'John', lastname: 'Doe', code: 'T001' },
  { id: 2, name: 'Jane Smith', firstname: 'Jane', lastname: 'Smith', code: 'T002' },
  // ... autres enseignants
]);
const teachings = ref<Teaching[]>([
  { id: 1, name: 'Math', code: 'T001' },
  { id: 2, name: 'Science', code: 'T002' },
  // ... autres enseignements
]);
</script>

<style scoped>
.page-content {
  display: flex;
}

.main-content {
  flex-grow: 1;
  padding: 20px;
}
</style>