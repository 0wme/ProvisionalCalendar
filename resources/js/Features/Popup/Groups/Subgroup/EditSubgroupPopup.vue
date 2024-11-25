<script setup lang="ts">
import SubgroupPopup from './SubgroupPopup.vue';
import DeleteConfirmationPopup from '@/Features/Popup/DeleteConfirmationPopup.vue';
import { Subgroup } from '@/types/models';
import Button from '@/Components/Button.vue';
import { ref, watch } from 'vue';
import CloseWithoutSaveConfirmationPopup from '@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue';

const emit = defineEmits(['cancel', 'delete', 'save']);

const props = defineProps<{
    group?: Subgroup;
    show?: boolean;
}>();

const isDeleteConfirmationPopupVisible = ref<boolean>(false);
const editedSubgroup = ref<Subgroup | undefined>();
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
    emit('delete', editedSubgroup.value);
};

const handleUpdateSubgroupName = (groupName: string) => {
    editedSubgroup.value!.name = groupName;
};

watch(() => props.show, () => {
    if (props.show && props.group) {
        editedSubgroup.value = { ...props.group };
    }
});

const showCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = true;
};

const handleClose = () => {
    if (editedSubgroup.value?.name !== props.group?.name) {
        showCloseWithoutSaveConfirmationPopup();
    } else {
        emit('cancel');
    }
};

const handleSave = () => {
    emit('save', editedSubgroup.value);
};
</script>

<template>
    <SubgroupPopup :group="editedSubgroup" :show title="Modifier un sous-groupe" @updateSubgroupName="handleUpdateSubgroupName" @close="handleClose">
        <div class="flex gap-4">
            <Button class="bg-green-500 text-white w-full" @click="handleSave">Sauvegarder</Button>
            <Button class="bg-red-500 text-white w-full" @click="showDeleteConfirmationPopup">Supprimer</Button>
        </div>
    </SubgroupPopup>
    <CloseWithoutSaveConfirmationPopup
        :show="isCloseWithoutSaveConfirmationPopupVisible"
        @close="handleCloseWithoutSaving"
        @cancel="handleCancelCloseWithoutSaving"
    />
    <DeleteConfirmationPopup :show="isDeleteConfirmationPopupVisible" @delete="handleDelete" @cancel="hideDeleteConfirmationPopup" />
</template>