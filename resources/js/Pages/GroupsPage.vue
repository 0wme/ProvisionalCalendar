<script setup lang="ts">
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ClassListManager from '@/Features/ListManager/Groups/ClassListManager.vue';
import GroupListManager from '@/Features/ListManager/Groups/GroupListManager.vue';
import SubGroupManager from '@/Features/ListManager/Groups/SubGroupListManager.vue';
import { ref, computed } from 'vue';
import { Class } from '@/types/models';

const classes = ref<Class[]>([
    { id: 1, name: 'BUT 1', groups: [
        { id: 1, name: 'G1', subGroups: [
            { id: 1, name: 'A' },
            { id: 2, name: 'B' },
        ] },
        { id: 2, name: 'G2', subGroups: [
            { id: 3, name: 'A' },
            { id: 4, name: 'B' },
        ] },
        { id: 3, name: 'G3', subGroups: [
            { id: 5, name: 'A' },
            { id: 6, name: 'B' },
        ] },
    ] },
    { id: 2, name: 'BUT 2', groups: [
        { id: 4, name: 'G4', subGroups: [
            { id: 7, name: 'A' },
            { id: 8, name: 'B' },
        ] },
        { id: 5, name: 'G5', subGroups: [
            { id: 9, name: 'A' },
            { id: 10, name: 'B' },
        ] },
    ] },
    { id: 3, name: 'BUT 3', groups: [
        { id: 6, name: 'G7', subGroups: [
            { id: 11, name: 'A' },
            { id: 12, name: 'B' },
        ] },
        { id: 7, name: 'G8', subGroups: [
            { id: 13, name: 'A' },
            { id: 14, name: 'B' },
        ] },
    ] },
]);

const selectedClassId = ref<number | undefined>();
const selectedGroupId = ref<number | undefined>();

const groups = computed(() => classes.value.find(c => c.id === selectedClassId.value)?.groups ?? []);
const subGroups = computed(() => groups.value?.find(g => g.id === selectedGroupId.value)?.subGroups ?? []);

const handleClassSelect = (id: number) => {
    if (id === selectedClassId.value) {
        selectedClassId.value = undefined;
        selectedGroupId.value = undefined;
    } else {
        selectedClassId.value = id;
        selectedGroupId.value = undefined;
    }
}

const handleGroupSelect = (id: number) => {
    if (id === selectedGroupId.value) {
        selectedGroupId.value = undefined;
    } else {
        selectedGroupId.value = id;
    }
}
</script>

<template>
    <AdminLayout>
        <div class="flex gap-10 w-full h-full">
            <ClassListManager class="w-full" :classes :selectedClassId @select="handleClassSelect" />
            <GroupListManager class="w-full" :groups :selectedGroupId @select="handleGroupSelect" />
            <SubGroupManager class="w-full" :subGroups />
        </div>
    </AdminLayout>
</template>