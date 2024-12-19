<script setup lang="ts">
import Data from "./data.json";
import CalendarLeftSidebar from "./CalendarLeftSidebar.vue";
import CalendarContent from "./CalendarContent.vue";

const weeksData = Data;
</script>

<template>
    <div class="relative overflow-y-scroll">
        <CalendarLeftSidebar :weeks-data="weeksData" />
        <CalendarContent :weeks-data="weeksData" />
    </div>
</template>
