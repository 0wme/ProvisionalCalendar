<script setup lang="ts">
import GroupPopup from './GroupPopup.vue';
import DeleteConfirmationPopup from '@/Features/Popup/DeleteConfirmationPopup.vue';
import { Group } from '@/types/models';
import Button from '@/Components/Button.vue';
import { ref, watch } from 'vue';
import CloseWithoutSaveConfirmationPopup from '@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue';

const emit = defineEmits(['cancel', 'delete', 'save']);

const props = defineProps<{
    group?: Group;
    show?: boolean;
}>();

const isDeleteConfirmationPopupVisible = ref<boolean>(false);
const editedGroup = ref<Group | undefined>();
const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);

const showDeleteConfirmationPopup = () => {
    isDeleteConfirmationPopupVisible.value = true;
};

const hideDeleteConfirmationPopup = () => {
    isDeleteConfirmationPopupVisible.value = false;
};

const handleCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
    emit('cancel');
};

const handleCancelCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
};

const hideCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = false;
};

const handleDelete = () => {
    hideDeleteConfirmationPopup();
    emit('delete', editedGroup.value);
};

const handleUpdateGroupName = (groupName: string) => {
    editedGroup.value!.name = groupName;
};

watch(() => props.show, () => {
    if (props.show && props.group) {
        editedGroup.value = { ...props.group };
    }
});

const showCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = true;
};

const handleClose = () => {
    if (editedGroup.value?.name !== props.group?.name) {
        showCloseWithoutSaveConfirmationPopup();
    } else {
        emit('cancel');
    }
};

const handleSave = () => {
    emit('save', editedGroup.value);
};
</script>

<template>
    <GroupPopup :group="editedGroup" :show title="Modifier un groupe" @updateGroupName="handleUpdateGroupName" @close="handleClose">
        <div class="flex gap-4">
            <Button class="bg-green-500 text-white w-full" @click="handleSave">Sauvegarder</Button>
            <Button class="bg-red-500 text-white w-full" @click="showDeleteConfirmationPopup">Supprimer</Button>
        </div>
    </GroupPopup>
    <CloseWithoutSaveConfirmationPopup
        :show="isCloseWithoutSaveConfirmationPopupVisible"
        @close="handleCloseWithoutSaving"
        @cancel="handleCancelCloseWithoutSaving"
    />
    <DeleteConfirmationPopup :show="isDeleteConfirmationPopupVisible" @delete="handleDelete" @cancel="hideDeleteConfirmationPopup" />
</template>