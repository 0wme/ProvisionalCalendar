<script setup lang="ts">
import { ref } from "vue";
import CalendarCell from "@/Components/CalendarCell.vue";
import Data from "./data.json";

const weeksData = Data;

console.log(weeksData);
</script>

<template>
    <div class="thead flex">
        <div class="thead flex flex-col">
            <div
                v-for="week in weeksData"
                class="border-2 border-r-gray-200 border-b-gray-200 rounded-l-xl flex items-center justify-center p-4 h-52"
            >
                S {{ week.week }}
            </div>
        </div>
        <div class="tbody flex flex-col h-full">
            <div v-for="week in weeksData" class="flex h-full">
                <div class="flex h-full">
                    <CalendarCell
                        class="h-52"
                        v-for="group in week.groups"
                        :group-data="group"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
