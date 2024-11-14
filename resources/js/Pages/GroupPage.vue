<script setup lang="ts">

import { defineProps } from 'vue';
import Sidebar from '../Components/Navigation/Sidebar.vue';
import HeaderMenu from '../Components/Navigation/HeaderMenu.vue';

interface AcademicPromotion {
  id: number;
  name: string;
}

interface AcademicGroup {
  id: number;
  name: string;
  academic_promotion?: AcademicPromotion;
}

interface Subgroup {
  id: number;
  name: string;
  academic_group?: AcademicGroup;
}

interface Props {
  subgroups: Subgroup[];
}

const props = defineProps<Props>();

</script>

<template>
  <div class="page-content">
    <HeaderMenu />
    <Sidebar />
    <div class="main-content">
      <h1>Groupes</h1>
      <div v-for="subgroup in subgroups" :key="subgroup.id">
        {{ subgroup.name }} - 
        {{ subgroup.academic_group?.name || 'Pas de groupe' }} -
        {{ subgroup.academic_group?.academic_promotion?.name || 'Pas de promotion' }}
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>