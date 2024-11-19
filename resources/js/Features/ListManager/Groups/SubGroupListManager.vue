<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { defineProps } from 'vue';
import { SubGroup } from '@/types/models';

defineProps<{
  subGroups: SubGroup[];
}>();

const handleEdit = (item: SubGroup) => {
    console.log(item);
}
</script>

<template>
    <div>
        <ListManager
            title="Sous-groupes"
            class="w-full h-full"
            hasAdd
            :items="subGroups"
            @edit="handleEdit"
        />
    </div>
</template>