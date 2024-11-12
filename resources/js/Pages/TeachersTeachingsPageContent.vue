<template>
  <div class="page-content">
    <HeaderMenu />
    <Sidebar />
    <div class="main-content">
      <!-- Contenu de la page Enseignants/Enseignements -->
      <TeachersListManager 
        title="Liste des Enseignants" 
        :teachers="teachers" 
        @select="handleTeacherSelect" 
      />
    </div>
  </div>
</template>

<script setup lang="ts">
import Sidebar from '../Components/Navigation/Sidebar.vue';
import HeaderMenu from '../Components/Navigation/HeaderMenu.vue';
import TeachersListManager from '../Components/Features/ListManager/TeachersListManager.vue';
import { ref } from 'vue';
import { Teacher } from '../types/models';

// Exemple de liste d'enseignants
const teachers = ref<Teacher[]>([
  { id: 1, firstname: 'John', lastname: 'Doe', code: 'T001' },
  { id: 2, firstname: 'Jane', lastname: 'Smith', code: 'T002' },
  // ... autres enseignants
]);

// Fonction pour gérer la sélection d'un enseignant
const handleTeacherSelect = (teacher: Teacher) => {
    console.log('Enseignant sélectionné:', teacher);
}
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