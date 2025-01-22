<script setup lang="ts">
import Sidebar from "@/Components/Navigation/Sidebar.vue";
import { sidebarMenuItems } from "@/config/navigation";
import { Head } from "@inertiajs/vue3";
import { useLabelsStore } from "@/stores/labelsStore";
import { onMounted } from "vue";

const labelsStore = useLabelsStore();

onMounted(async () => {
    await labelsStore.fetchLabels();
});
</script>

<template>
    <Head title="Calendrier prévisionnel" />
    <div class="fixed left-0 top-0 right-0 bottom-0 bg-gray-100 flex">
        <Sidebar :items="sidebarMenuItems" />
        <div class="m-10 w-[calc(100%-80px)] h-[calc(100%-80px)]">
            <slot />
        </div>
    </div>
</template>
