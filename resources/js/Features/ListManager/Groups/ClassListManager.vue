<script setup lang="ts">
import ListManager from "@/Components/ListManager/ListManager.vue";
import { defineProps } from "vue";
import { Class } from "@/types/models";

defineProps<{
    classes: Class[];
    selectedClassId?: number;
}>();
</script>

<template>
    <ListManager
        title="Promotions"
        hasAdd
        :items="classes"
        :selectedItemsId="selectedClassId ? [selectedClassId] : undefined"
    />
</template>
