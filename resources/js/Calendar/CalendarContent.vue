<script setup lang="ts">
import CalendarCell from "@/Calendar/CalendarCell.vue";

defineProps<{
    weeksData: any;
    biggestCM: number;
    biggestTD: number;
    biggestTP: number;
}>();
</script>

<template>
    <div
        class="overflow-x-scroll scrollbar-visible"
        style="max-width: calc(100% - 3rem)"
    >
        <div v-for="week in weeksData" class="flex flex-col h-52">
            <div class="flex flex-col h-full">
                <CalendarCell
                    class="h-52"
                    v-for="group in week.groups"
                    :group-data="group"
                    :biggestCM="biggestCM"
                    :biggestTD="biggestTD"
                    :biggestTP="biggestTP"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
.scrollbar-visible {
    scrollbar-gutter: stable;
}

.scrollbar-visible::-webkit-scrollbar {
    height: 10px;
    display: block;
}

.scrollbar-visible::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.scrollbar-visible::-webkit-scrollbar-thumb {
    background: #9ca3af;
    border-radius: 5px;
}

.scrollbar-visible::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
