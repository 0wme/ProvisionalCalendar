<script setup lang="ts">
import RightSidebarElement from "@/Calendar/RightSidebarElement.vue";

defineProps<{
    weeksData: any;
}>();
</script>

<template>
    <div class="flex flex-col">
        <RightSidebarElement v-for="week in weeksData" :week="week" />
    </div>
</template>
