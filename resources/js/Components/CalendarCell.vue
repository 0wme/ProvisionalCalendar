<script setup lang="ts">
defineProps<{
    groupData: any;
}>();
</script>

<template>
    <div class="flex w-max h-full">
        <div
            class="min-w-96 flex items-center justify-start bg-white border-r-2 border-b-2 border-gray-200"
        >
            <div
                class="text-gray-500 text-center text-sm font-semibold h-full items-center flex justify-center border-r-2 border-gray-200"
                v-for="content in groupData.contents"
                :class="{
                    'bg-yellow-200': content.type === 'CM',
                    'bg-red-200': content.type === 'TD',
                    'bg-blue-200': content.type === 'TP',
                }"
                :style="{ width: `${content.hours * 96}px` }"
            >
                {{ content.teacherName }}
            </div>
        </div>
        <div class="flex flex-col">
            <CalendarCell
                v-for="group in groupData.groups"
                :groupData="group"
            />
        </div>
    </div>
</template>
