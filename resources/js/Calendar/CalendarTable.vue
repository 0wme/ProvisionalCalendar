<template>
  <div class="calendar-table">
    <table class="table-fixed w-full border-collapse border border-gray-300">
      <thead>
        <tr>
          <th class="border border-gray-300 p-2 bg-gray-200 w-1/12">Semaines</th>
          <th class="border border-gray-300 p-2 bg-gray-200">CM</th>
          <th class="border border-gray-300 p-2 bg-gray-200">TD</th>
          <th class="border border-gray-300 p-2 bg-gray-200">TP</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="week in weeks" :key="week">
          <td class="border border-gray-300 p-2 bg-gray-50">S{{ week }}</td>

          <td class="border border-gray-300 p-2 bg-gray-50">
            <Cell size="full" :height="20"></Cell>
          </td>

          <td class="border border-gray-300 p-2 bg-gray-50">
            <div class="flex flex-col w-full">
              <Cell
                v-for="i in 2"
                :key="`td-${week}-${i}`"
                size="third"
                :height="10"
                class="cell-with-border"
              >
                <div class="empty-cell"></div>
              </Cell>
            </div>
          </td>

          <td class="border border-gray-300 p-2 bg-gray-50">
            <div class="flex flex-col w-full">
              <Cell
                v-for="i in 6"
                :key="`tp-${week}-${i}`"
                size="sixth"
                :height="10"
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

const weeks = Array.from({ length: 30 }, (_, i) => i + 1);
</script>

<style scoped>
.table-fixed {
  table-layout: fixed;
}

.flex {
  display: flex;
}

.flex-col {
  flex-direction: column;
}

.cell-with-border:not(:last-child) {
  border-bottom: 1px solid #ff0000;

}

.empty-cell {
  height: 30px;
}

</style>