<template>
  <div class="calendar-table">
    <div class="table-container">
      <!-- <div class="thead">
        <TestComponent title="Semaines">
          <div class="header">Semaines</div>
          <div class="header">CM</div>
          <div class="header">TD</div>
          <div class="header">TP</div>
        </TestComponent>
      </div> -->

      <div class="tbody flex flex-col">
        <div v-for="week in testData" :key="'week-' + week.week" class="flex">
          <div class="week-cell">S{{ week.week }}</div>
            <TestComponent :title="`${cm.hours}h - ${cm.teacherName}`" v-for="cm in week.promotion" :key="'cm-' + cm.teacherName">
                <TestComponent :title="`TD${td}`" v-for="td in 3" :key="'td-' + week + '-' + td">
                    <TestComponent :title="`TP${tp}`" v-for="tp in 2" :key="'tp-' + week + '-' + tp" />
                </TestComponent>
            </TestComponent>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import TestComponent from '@/Components/TestComponent.vue';

const weeks = Array.from({ length: 15 }, (_, i) => i + 1);

const testData=ref([
  {
    week: 1,
    promotion: {
      cm : [
        {
          hours: 1,
          teacherName: 'John Doe',
        },
        {
          hours: 2,
          teacherName: 'Jane Doe',
        },
      ]},
      groups : [
        {
          td: [
            {
              hours: 1,
              teacherName: 'John Doe',
            },
            {
              hours: 2,
              teacherName: 'Jane',
            },
          ],
          subgroups: [
            {
              tp: [
                {
                  hours: 1,
                  teacherName: 'John Doe',
                },
                {
                  hours: 1,
                  teacherName: 'Jane',
                },
              ],
            },
          ],
        },
        {
          td: [
            {
              hours: 3,
              teacherName: 'Jack Doe',
            },
            {
              hours: 2,
              teacherName: 'Jane',
            },
          ],
          subgroups: [
            {
              tp: [
                {
                  hours: 1,
                  teacherName: 'John Doe',
                },
                {
                  hours: 1,
                  teacherName: 'Jane',
                },
              ],
            },
            {
              tp: [
                {
                  hours: 1,
                  teacherName: 'John Doe',
                },
                {
                  hours: 1,
                  teacherName: 'Jane',
                },
              ],
            },
          ],
        },
      ],
  }
])
</script>

<style scoped>
.table-container {
  display: grid;
  grid-template-columns: 1fr 2fr 3fr 3fr;
  width: 100%;
  border: 1px solid #ccc;
  border-collapse: collapse;
}

.thead {
  display: contents;
}

.tbody {
  display: contents;
}

.header {
  text-align: center;
  padding: 10px;
  background-color: #e0e7ff;
  font-weight: bold;
  border: 1px solid #ccc;
}

.week-cell {
  text-align: center;
  padding: 10px;
  background-color: #f3f4f6;
  border: 1px solid #ccc;
}

.cell {
  text-align: center;
  padding: 10px;
  border: 1px solid #ccc;
  background-color: #fff;
  height: 100%;
}

.group-cell {
  display: grid;
  grid-template-rows: repeat(3, 1fr);
  height: 100%;
  border: 1px solid #ccc;
  background-color: #f9f9f9;
}

.group-cell:nth-child(4) {
  grid-template-rows: repeat(6, 1fr); 
}

.sub-cell {
  text-align: center;
  padding: 10px;
  border: 1px solid #ccc;
  background-color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>