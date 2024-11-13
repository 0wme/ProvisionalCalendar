<template>
  <div class="page-content">
    <div class="main-content">
      <!-- Contenu de la page Enseignants/Enseignements -->
      <button 
          class="mode-button" 
          :style="{ backgroundColor: buttonClicked ? '#FF9898' : '#9A98FF' }" 
          @click="toggleButton">
          {{ buttonClicked ? 'Mode Enseignements' : 'Mode Enseignants' }}
      </button>
      <div class="teachers-teachings-content">
        <TeachersListManager
            v-if="!buttonClicked"
            title="Liste des Enseignants"
            :teachers
            class="teachers-list-manager"
          />
          <TeachingsListManager
            v-if="buttonClicked"
            title="Liste des Enseignements"
            :teachings
            :periods
            class="teachings-list-manager"
          />
          <TeachingsListManager
            v-if="!buttonClicked"
            title="Liste des Enseignements"
            :teachings
            :periods
            class="teachings-list-manager"
          />
          <TeachersListManager
            v-if="buttonClicked"
            title="Liste des Enseignants"
            :teachers
            class="teachers-list-manager"
          />
      </div>
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

const periods = ref<Period[]>([
  { id: 0, name: 'Semestre 1' },
  { id: 1, name: 'Semestre 2' },
  { id: 2, name: 'Semestre 3' },
  { id: 3, name: 'Semestre 4' },
  { id: 4, name: 'Semestre 5' },
  { id: 5, name: 'Semestre 6' },
]);

const teachings = ref<Teaching[]>([
  { id: 1, name: 'Math', code: 'T001', period:periods.value[0]},
  { id: 2, name: 'Science', code: 'T002', period:periods.value[1]},
  // ... autres enseignements
]);

const buttonClicked = ref(false);

const toggleButton = () => {
  buttonClicked.value = !buttonClicked.value;
};
</script>

<style scoped>

.main-content {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  width: 100%;
}

.teachers-teachings-content {
  display: flex;
  flex-grow: 1;
  padding: 20px;
  gap: 30px;
  width: 100%;
  height: 100vh;
}

.teachers-list-manager {
  width: 80%;
}

.teachings-list-manager {
  width: 120%;
}

.mode-button {
  background-color: #8a9eff;
  color: white;
  border: none;
  border-radius: 15px;
  padding: 10px 20px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 20px;
  margin-right: 20px;
  width: max-content;
}
</style>