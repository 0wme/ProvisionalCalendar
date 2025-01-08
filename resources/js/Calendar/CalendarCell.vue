<script setup lang="ts">
import CalendarSlot from "@/Calendar/CalendarSlot.vue";
import { computed, ref } from "vue";
import { SlotType } from "@/types/models";

const props = defineProps<{
    groupData: any;
    biggestCM: number;
    biggestTD: number;
    biggestTP: number;
}>();

const isDragOver = ref<boolean>(false);

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

console.log(isDragOver);
</script>

<template>
    <div class="flex w-max h-full">
        <div
            :class="[
                'relative min-w-96 flex items-center justify-start border-r-2 bg-white border-b-2 border-gray-200 after:absolute after:top-0 after:bottom-0 after:right-0 after:left-0',
                { 'after:bg-blue-500 after:opacity-20': isDragOver },
            ]"
            :style="{ width: `${cellWidth}px` }"
            dropzone="move"
            @dragover.prevent="isDragOver = true"
            @dragleave="isDragOver = false"
            @drop="
                (e) => {
                    console.log(e);
                    isDragOver = false;
                }
            "
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
