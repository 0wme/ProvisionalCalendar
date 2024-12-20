<script setup lang="ts">
import { computed } from "vue";

const props = defineProps<{
    groupData: any;
    biggestCM: number;
    biggestTD: number;
    biggestTP: number;
}>();

const getGroupType = () => {
    return props.groupData.contents[0]?.type;
};

const cellWidth = computed(() => {
    const type = props.groupData.contents[0]?.type;
    switch (type) {
        case "CM":
            return props.biggestCM * 96;
        case "TD":
            return props.biggestTD * 96;
        case "TP":
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
            <div
                :class="[
                    'text-gray-500 text-center text-sm font-semibold h-full items-center flex justify-center border-r-2 border-r-gray-200',
                    {
                        'bg-yellow-200': content.type === 'CM',
                        'bg-red-200': content.type === 'TD',
                        'bg-blue-200': content.type === 'TP',
                    },
                ]"
                v-for="content in groupData.contents"
                :style="{ width: `${content.hours * 96}px` }"
            >
                {{ content.teacherName }}
            </div>
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
