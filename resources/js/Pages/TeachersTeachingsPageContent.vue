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
  { id: 3, name: 'Jean-Pierre Dupont', firstname: 'Jean-Pierre', lastname: 'Dupont', code: 'T003' },
  { id: 4, name: 'Marie Martin', firstname: 'Marie', lastname: 'Martin', code: 'T004' },
  { id: 5, name: 'Pierre Dupont', firstname: 'Pierre', lastname: 'Dupont', code: 'T005' },
  { id: 6, name: 'François Durand', firstname: 'François', lastname: 'Durand', code: 'T006' },
  { id: 7, name: 'Sophie Garnier', firstname: 'Sophie', lastname: 'Garnier', code: 'T007' },
  { id: 8, name: 'Laurent Bernard', firstname: 'Laurent', lastname: 'Bernard', code: 'T008' },
  { id: 9, name: 'Catherine Lefebvre', firstname: 'Catherine', lastname: 'Lefebvre', code: 'T009' },
  { id: 10, name: 'Nicolas Moreau', firstname: 'Nicolas', lastname: 'Moreau', code: 'T010' },
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
  { id: 3, name: 'Physique', code: 'T003', period:periods.value[0]},
  { id: 2, name: 'SVT', code: 'T004', period:periods.value[0]},
  { id: 2, name: 'Algorithme', code: 'T005', period:periods.value[0]},
  { id: 2, name: 'EPS', code: 'T006', period:periods.value[0]},
  { id: 2, name: 'Technologie', code: 'T007', period:periods.value[0]},
  { id: 2, name: 'Développement Web', code: 'T008', period:periods.value[0]},
  { id: 2, name: 'Base de données', code: 'T009', period:periods.value[0]},
  { id: 2, name: 'Francais', code: 'T0010', period:periods.value[0]},
  { id: 2, name: 'Art Plastique', code: 'T011', period:periods.value[0]},
  { id: 2, name: 'Communication', code: 'T012', period:periods.value[0]},
  { id: 2, name: 'Virtualisation', code: 'T013', period:periods.value[0]},

]);

const buttonClicked = ref(false);

const toggleButton = () => {
  buttonClicked.value = !buttonClicked.value;
};
</script>

<template>
    <div class="flex flex-col gap-8 items-end w-full h-full">
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