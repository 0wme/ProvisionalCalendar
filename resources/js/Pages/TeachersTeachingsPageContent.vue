<template>
  <div class="page-content">
    <HeaderMenu />
    <Sidebar />
    <div class="main-content">
      <!-- Contenu de la page Enseignants/Enseignements -->
      <TeachersListManager />
    </div>
  </div>
</template>

<script setup lang="ts">
import Sidebar from '../Components/Navigation/Sidebar.vue';
import HeaderMenu from '../Components/Navigation/HeaderMenu.vue';
import TeachersListManager from '../Components/Features/ListManager/TeachersListManager.vue';
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