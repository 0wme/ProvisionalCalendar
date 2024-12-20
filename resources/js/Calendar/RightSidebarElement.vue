<script setup lang="ts">
import { computed, defineProps } from "vue";

const props = defineProps<{
    groupData: any;
}>();

const groupHoursSum = computed(() => {
    if (!props.groupData?.contents) return 0;
    return props.groupData.contents
        .map((content: any) => content.hours)
        .reduce((sum: number, hours: number) => sum + hours, 0);
});
</script>

<template>
    <div class="flex w-max h-full">
        <div
            class="w-12 flex items-center justify-start bg-white border-r-2 border-b-2 border-gray-200"
        >
            <p>{{ groupHoursSum }}</p>
        </div>
        <div class="flex flex-col h-full">
            <RightSidebarElement
                v-for="group in groupData.groups"
                :group-data="group"
                class="h-full"
            />
        </div>
    </div>
</template>
