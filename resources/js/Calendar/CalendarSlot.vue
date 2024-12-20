<script setup lang="ts">
import { SlotType } from "@/types/models";
defineProps<{
    content: any;
    contentType: SlotType;
}>();
</script>

<template>
    <div
        :class="[
            ' h-full px-2 flex items-center justify-center border-r-2 border-r-gray-200',
            {
                'bg-yellow-200': contentType === SlotType.CM,
                'bg-red-200': contentType === SlotType.TD,
                'bg-blue-200': contentType === SlotType.TP,
            },
        ]"
        :style="{ width: `${content.hours * 96}px` }"
    >
        <p
            class="text-gray-500 text-ellipsis overflow-hidden text-nowrap text-sm font-semibold"
        >
            {{ content.teacherName }}
        </p>
    </div>
</template>
