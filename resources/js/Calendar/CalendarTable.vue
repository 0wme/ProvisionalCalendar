<template>
  <div class="calendar-table">
    <table class="table-fixed w-full border-collapse border border-gray-300 rounded-lg">
      <thead>
        <tr>
          <th class="border border-gray-300 p-2 bg-gray-200 w-1/12 rounded-tl-lg">Semaines</th>
          <th class="border border-gray-300 p-2 bg-gray-200">CM</th>
          <th class="border border-gray-300 p-2 bg-gray-200">TD</th>
          <th class="border border-gray-300 p-2 bg-gray-200 rounded-tr-lg">TP</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="week in weeks" :key="week">
          <td class="border border-gray-300 p-2 bg-gray-50 week-cell">S{{ week }}</td>
          <td class="border border-gray-300 p-2 bg-gray-50">
            <Cell size="full" :height="12"></Cell>
          </td>
          <td class="border border-gray-300 p-2 bg-gray-50">
            <div class="flex flex-col w-full h-full">
              <Cell
                v-for="i in 2"
                :key="`td-${week}-${i}`"
                size="third"
                :height="6"
                class="cell-with-border"
              >
                <div class="empty-cell"></div>
              </Cell>
            </div>
          </td>
          <td class="border border-gray-300 p-2 bg-gray-50">
            <div class="flex flex-col w-full h-full">
              <Cell
                v-for="i in 6"
                :key="`tp-${week}-${i}`"
                size="sixth"
                :height="2"
                class="cell-with-border"
              >
                <div class="empty-cell"></div>
              </Cell>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import Cell from './Cell.vue';

const weeks = Array.from({ length: 30 }, (_, i) => i + 1);
</script>

<style scoped>
.table-fixed {
  table-layout: fixed;
  border-radius: 10px;
  overflow: hidden;
}

th {
  background-color: #E8DEF8; 
}

.cell-with-border:not(:last-child) {
  border-bottom: 1px solid #ff0f0f;
}

.flex-col {
  display: flex;
  flex-direction: column;
}

.empty-cell {
  flex-grow: 1;
}

.week-cell {
  border-radius: 25px 0 0 25px;
  background-color: #FFE5DA;
}
</style>