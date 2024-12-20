<script setup lang="ts">
import RightSidebarElement from "@/Calendar/RightSidebarElement.vue";

defineProps<{
    weeksData: any;
}>();
</script>

<template>
    <div class="flex flex-col border-l-2 border-gray-200">
        <div v-for="week in weeksData" class="h-52 flex flex-col">
            <RightSidebarElement
                v-for="group in week.groups"
                :group-data="group"
                class="h-full"
            />
        </div>
    </div>
</template>
