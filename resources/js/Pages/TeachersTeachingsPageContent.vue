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

<template>
    <div class="flex flex-col gap-8 items-end w-full h-full">
      <!-- Contenu de la page Enseignants/Enseignements -->
      <button 
          :class="['mode-button text-white border-none rounded-xl py-2.5 px-5 cursor-pointer text-base w-max',buttonClicked ? 'bg-[#FF9898]' : 'bg-[#9A98FF]']"
          @click="toggleButton">
          {{ buttonClicked ? 'Mode Enseignements' : 'Mode Enseignants' }}
      </button>
      <div :class="['teachers-teachings-content w-full h-full flex gap-8', {'flex-row-reverse': buttonClicked}]">
          <TeachersListManager
            title="Liste des Enseignants"
            :teachers
          />
          <TeachingsListManager
            title="Liste des Enseignements"
            :teachings
            :periods
          />
      </div>
    </div>
</template>