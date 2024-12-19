<script setup lang="ts">
import ListManager from "@/Components/ListManager/ListManager.vue";
import { defineProps } from "vue";
import { Group } from "@/types/models";

defineProps<{
    groups: Group[];
    selectedGroupId?: number;
}>();
</script>

<template>
    <ListManager
        title="Groupes"
        hasAdd
        :items="groups"
        :selectedItemsId="selectedGroupId ? [selectedGroupId] : undefined"
    />
</template>
