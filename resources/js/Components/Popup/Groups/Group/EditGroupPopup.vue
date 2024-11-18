<script setup lang="ts">
import GroupPopup from './GroupPopup.vue';
import DeleteConfirmationPopup from '@/Components/Popup/DeleteConfirmationPopup.vue';
import { Group } from '@/types/models';
import Button from '@/Components/Button.vue';
import { ref } from 'vue';

const emit = defineEmits(['cancel', 'delete', 'save']);

defineProps<{
    groupId?: number;
    groups?: Group[];
    show?: boolean;
}>();

const isVisibleDeleteConfirmationPopup = ref<boolean>(false);

const showDeleteConfirmationPopup = () => {
    isVisibleDeleteConfirmationPopup.value = true;
};

const hideDeleteConfirmationPopup = () => {
    isVisibleDeleteConfirmationPopup.value = false;
};

const handleDelete = () => {
    hideDeleteConfirmationPopup();
    emit('delete');
};
</script>

<template>
    <GroupPopup :groups :groupId :show title="Modifier un groupe" @close="emit('cancel')">
        <div class="flex gap-4">
            <Button class="bg-green-500 text-white w-full" @click="emit('save')">Sauvegarder</Button>
            <Button class="bg-red-500 text-white w-full" @click="showDeleteConfirmationPopup">Supprimer</Button>
        </div>
    </GroupPopup>
    <DeleteConfirmationPopup :show="isVisibleDeleteConfirmationPopup" @delete="handleDelete" @cancel="hideDeleteConfirmationPopup" />
</template>