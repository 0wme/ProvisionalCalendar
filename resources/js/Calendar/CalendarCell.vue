<script setup lang="ts">
import CalendarSlot from "@/Calendar/CalendarSlot.vue";
import { computed } from "vue";
import { SlotType } from "@/types/models";

const props = defineProps<{
    groupData: any;
    biggestCM: number;
    biggestTD: number;
    biggestTP: number;
}>();

const getGroupType = (): SlotType => {
    return props.groupData.contents[0]?.type as SlotType;
};

const cellWidth = computed(() => {
    const type = getGroupType();
    switch (type) {
        case SlotType.CM:
            return props.biggestCM * 96;
        case SlotType.TD:
            return props.biggestTD * 96;
        case SlotType.TP:
            return props.biggestTP * 96;
        default:
            return 96;
    }
});
</script>

<template>
    <div class="flex w-max h-full">
        <div
            class="min-w-96 flex items-center justify-start bg-white border-r-2 border-b-2 border-gray-200"
            :style="{ width: `${cellWidth}px` }"
        >
            <CalendarSlot
                v-for="content in groupData.contents"
                :content="content"
                :contentType="getGroupType()"
            />
        </div>
        <div class="flex flex-col">
            <CalendarCell
                v-for="group in groupData.groups"
                :groupData="group"
                :biggestCM
                :biggestTD
                :biggestTP
            />
        </div>
    </div>
</template>
