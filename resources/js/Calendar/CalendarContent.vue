<script setup lang="ts">
import CalendarCell from "@/Components/CalendarCell.vue";

defineProps<{
    weeksData: any;
}>();
</script>

<template>
    <div
        class="absolute left-12 overflow-x-auto"
        style="max-width: calc(100% - 3rem)"
    >
        <div v-for="week in weeksData" class="flex flex-col h-52">
            <div class="flex flex-col h-full">
                <CalendarCell
                    class="h-52"
                    v-for="group in week.groups"
                    :group-data="group"
                />
            </div>
        </div>
    </div>
</template>
