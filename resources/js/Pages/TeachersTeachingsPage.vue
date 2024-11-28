<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TeachersListManager from '../Features/ListManager/TeachersListManager.vue';
import TeachingsListManager from '../Features/ListManager/TeachingsListManager.vue';
import TeachingPopup from '../Features/Popup/Teachings/TeachingPopup.vue';
import { Teacher, Teaching, Period } from '@/types/models';

const teachers = ref<Teacher[]>([]);
const teachings = ref<Teaching[]>([]);

const showPopup = ref(false);
const showPopupEdit = ref(false);

onMounted(async () => {
  try {
    // Récupère les enseignants
    const teachersResponse = await axios.get('/api/enseignants/1');
    teachers.value = teachersResponse.data.map((teacher: any) => ({
      id: teacher.id,
      name: `${teacher.first_name} ${teacher.last_name}`,
      firstname: teacher.first_name,
      lastname: teacher.last_name,
      code: teacher.acronym,
    }));

    // Récupère les enseignements
    const teachingsResponse = await axios.get('/api/enseignements/1');
    teachings.value = teachingsResponse.data.map((teaching: any) => {
      let period = null;
      if (teaching.semester) {
        period = { id: teaching.semester, name: `Semestre ${teaching.semester}` };
      } else if (teaching.trimester) {
        period = { id: teaching.trimester, name: `Trimestre ${teaching.trimester}` };
      }

      return {
        id: teaching.id,
        name: teaching.title,
        code: teaching.apogee_code,
        period, 
      };
    });
  } catch (error) {
    console.error('Erreur lors de la récupération des données:', error);
  }
});

const periods = ref<Period[]>([
  { id: 0, name: 'Semestre 1' },
  { id: 1, name: 'Semestre 2' },
  { id: 2, name: 'Semestre 3' },
  { id: 3, name: 'Semestre 4' },
  { id: 4, name: 'Semestre 5' },
  { id: 5, name: 'Semestre 6' },
]);

const selectedPeriod = ref<number>(0); 
const filteredTeachings = computed(() => {
  if (selectedPeriod.value === 0) {
    return teachings.value; 
  }
  return teachings.value.filter((teaching) => teaching.period?.id === selectedPeriod.value);
});

const buttonClicked = ref(false);
const toggleButton = () => {
  buttonClicked.value = !buttonClicked.value;
};
</script>

<template>
  <AdminLayout>
    <div class="flex flex-col h-full gap-8">
      <button
        :class="['mode-button text-white border-none rounded-xl py-2.5 px-5 cursor-pointer text-base w-max',
        buttonClicked ? 'bg-[#FF9898]' : 'bg-[#9A98FF]']"
        @click="toggleButton">
        {{ buttonClicked ? 'Mode Enseignements' : 'Mode Enseignants' }}
      </button>

      <div :class="['flex gap-8 flex-1 min-h-0', {'flex-row-reverse': buttonClicked}]">
        <TeachersListManager
          class="flex-1 h-full w-1/3"
          :teachers="teachers"
        />
        <TeachingsListManager
          title="Liste des Enseignements"
          class="flex-1 h-full w-full"
          :teachings="filteredTeachings"
          :periods="periods"
        />
      </div>
    </div>
  </AdminLayout>
  <TeachingPopup
        :show="true"
        title="Ajouter un enseignement"
  />
</template>

<style scoped>
.mode-button {
  transition: background-color 0.3s ease;
}
</style>
