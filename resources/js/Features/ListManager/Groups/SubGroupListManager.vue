<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { defineProps, onMounted, computed } from 'vue';
import { Subgroup } from '@/types/models';
import { useLabelsStore } from '@/Stores/labelsStore';

const labelsStore = useLabelsStore();

defineProps<{
    subgroups: Subgroup[];
}>();

const title = computed(() => {
    return labelsStore.getLabel('Sous-groupes');
});

onMounted(async () => {
    await labelsStore.fetchLabels();
});

const handleEdit = (item: Subgroup) => {
    console.log(item);
}
</script>

<template>
    <ListManager
        :title="title"
        hasAdd
        :items="subgroups"
        @edit="handleEdit"
    />
</template>