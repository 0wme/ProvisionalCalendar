<template>
  <AdminLayout>
    <div class="config-page-container">
      <div class="config-page grid grid-cols-2 gap-8 p-8">
        <div class="config-section">
          <h2 class="text-xl font-bold mb-4">Page Enseignants/Enseignements</h2>
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span>Enseignants</span>
              <input type="text" v-model="texts.teachers" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Enseignements</span>
              <input type="text" v-model="texts.teachings" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Mode Enseignants</span>
              <input type="text" v-model="texts.teachersMode" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Mode Enseignements</span>
              <input type="text" v-model="texts.teachingsMode" class="border p-2 rounded" />
            </div>
          </div>
        </div>
        <div class="config-section">
          <h2 class="text-xl font-bold mb-4">Général</h2>
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span>Calendrier Prévisionnel</span>
              <input type="text" v-model="texts.provisionalCalendar" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Enseignants/Enseignements</span>
              <input type="text" v-model="texts.teachersTeachings" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Mode Édition</span>
              <input type="text" v-model="texts.editMode" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Panneau de configuration</span>
              <input type="text" v-model="texts.configPanel" class="border p-2 rounded" />
            </div>
          </div>
        </div>
        <div class="config-section">
          <h2 class="text-xl font-bold mb-4">Page Mode Édition</h2>
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span>S</span>
              <input type="text" v-model="texts.s" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>CM</span>
              <input type="text" v-model="texts.cm" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>TD</span>
              <input type="text" v-model="texts.td" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>TP</span>
              <input type="text" v-model="texts.tp" class="border p-2 rounded" />
            </div>
          </div>
        </div>
        <div class="config-section">
          <h2 class="text-xl font-bold mb-4">Page Panneau de configuration</h2>
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span>Paramétrage des groupes</span>
              <input type="text" v-model="texts.groupSettings" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Paramétrage des textes</span>
              <input type="text" v-model="texts.textSettings" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Historique des alertes</span>
              <input type="text" v-model="texts.alertHistory" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Enseignants/Enseignements</span>
              <input type="text" v-model="texts.teachersTeachings" class="border p-2 rounded" />
            </div>
          </div>
        </div>
        <div class="config-section">
          <h2 class="text-xl font-bold mb-4">Pop up Enseignements</h2>
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span>M3C</span>
              <input type="text" v-model="texts.m3c" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Initiale</span>
              <input type="text" v-model="texts.initial" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Continue</span>
              <input type="text" v-model="texts.continuous" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Enseignants/Enseignements</span>
              <input type="text" v-model="texts.teachersTeachings" class="border p-2 rounded" />
            </div>
          </div>
        </div>
        <div class="config-section">
          <h2 class="text-xl font-bold mb-4">Page Paramétrage des groupes</h2>
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center">
              <span>Promo</span>
              <input type="text" v-model="texts.promo" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Groupe</span>
              <input type="text" v-model="texts.group" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Demi-groupe</span>
              <input type="text" v-model="texts.subgroup" class="border p-2 rounded" />
            </div>
            <div class="flex justify-between items-center">
              <span>Enseignants/Enseignements</span>
              <input type="text" v-model="texts.teachersTeachings" class="border p-2 rounded" />
            </div>
          </div>
        </div>
      </div>
      <div class="validate-button-container">
        <button class="validate-button">Valider</button>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const texts = ref({
  teachers: 'Enseignants',
  teachings: 'Enseignements',
  teachersMode: 'Mode Enseignants',
  teachingsMode: 'Mode Enseignements',
  provisionalCalendar: 'Calendrier Prévisionnel',
  teachersTeachings: 'Enseignants/Enseignements',
  editMode: 'Mode Édition',
  configPanel: 'Panneau de configuration',
  s: 'S',
  cm: 'CM',
  td: 'TD',
  tp: 'TP',
  groupSettings: 'Paramétrage des groupes',
  textSettings: 'Paramétrage des textes',
  alertHistory: 'Historique des alertes',
  m3c: 'M3C',
  initial: 'Initiale',
  continuous: 'Continue',
  promo: 'Promo',
  group: 'Groupe',
  subgroup: 'Demi-groupe',
});
</script>

<style scoped>
.config-page-container {
  display: flex;
  flex-direction: column;
  height: 100%;
  max-height: calc(100vh - 2rem);
}

.config-page {
  flex: 1;
  overflow-y: auto;
  min-height: 0;
}

.validate-button-container {
  padding: 1rem;
  display: flex;
  justify-content: flex-end;
}

.validate-button {
  background-color: #4CAF50;
  color: white;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 0.25rem;
  cursor: pointer;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.validate-button:hover {
  background-color: #45a049;
}

.config-section {
  background-color: #ffffff;
  padding: 2rem;
  border-radius: 0.5rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}
</style>