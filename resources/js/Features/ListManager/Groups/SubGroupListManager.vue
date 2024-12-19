<script setup lang="ts">
import ListManager from "@/Components/ListManager/ListManager.vue";
import { defineProps } from "vue";
import { Subgroup } from "@/types/models";

defineProps<{
    subgroups: Subgroup[];
}>();
</script>

<template>
    <ListManager title="Sous-groupes" hasAdd :items="subgroups" />
</template>
