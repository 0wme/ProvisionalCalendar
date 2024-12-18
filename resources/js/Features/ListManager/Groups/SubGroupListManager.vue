<script setup lang="ts">
import ListManager from "@/Components/ListManager/ListManager.vue";
import { defineProps } from "vue";
import { Subgroup } from "@/types/models";

defineProps<{
    subgroups: Subgroup[];
}>();

const handleEdit = (item: Subgroup) => {
    console.log(item);
};
</script>

<template>
    <ListManager
        title="rr-groupes"
        hasAdd
        :items="subgroups"
        @edit="handleEdit"
    />
</template>
