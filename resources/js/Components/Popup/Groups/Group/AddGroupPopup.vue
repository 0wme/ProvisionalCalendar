<script setup lang="ts">
import GroupPopup from './GroupPopup.vue';
import { Group } from '@/types/models';
import Button from '@/Components/Button.vue';

const emit = defineEmits(['close']);

defineProps<{
    groups?: Group[];
    show?: boolean;
}>();
</script>

<template>
    <GroupPopup :groups :show title="Ajouter un groupe" @close="emit('close')">
        <div class="flex gap-4">
            <Button class="bg-green-500 text-white w-full">Ajouter</Button>
        </div>
    </GroupPopup>
</template>