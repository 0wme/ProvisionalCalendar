<script setup lang="ts">
import ClassPopup from './ClassPopup.vue';
import DeleteConfirmationPopup from '@/Features/Popup/DeleteConfirmationPopup.vue';
import { Class } from '@/types/models';
import Button from '@/Components/Button.vue';
import { ref, watch } from 'vue';
import CloseWithoutSaveConfirmationPopup from '@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue';

const emit = defineEmits(['cancel', 'delete', 'save']);

const props = defineProps<{
    classe?: Class;
    show?: boolean;
}>();

const isDeleteConfirmationPopupVisible = ref<boolean>(false);
const editedClass = ref<Class | undefined>();
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
    emit('delete', editedClass.value);
};

const handleUpdateClassName = (groupName: string) => {
    editedClass.value!.name = groupName;
};

watch(() => props.show, () => {
    if (props.show && props.classe) {
        editedClass.value = { ...props.classe };
    }
});

const showCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = true;
};

const handleClose = () => {
    if (editedClass.value?.name !== props.classe?.name) {
        showCloseWithoutSaveConfirmationPopup();
    } else {
        emit('cancel');
    }
};

const handleSave = () => {
    emit('save', editedClass.value);
};
</script>

<template>
    <ClassPopup :classe="editedClass" :show title="Modifier un sous-groupe" @updateClassName="handleUpdateClassName" @close="handleClose">
        <div class="flex gap-4">
            <Button class="bg-green-500 text-white w-full" @click="handleSave">Sauvegarder</Button>
            <Button class="bg-red-500 text-white w-full" @click="showDeleteConfirmationPopup">Supprimer</Button>
        </div>
    </ClassPopup>
    <CloseWithoutSaveConfirmationPopup
        :show="isCloseWithoutSaveConfirmationPopupVisible"
        @close="handleCloseWithoutSaving"
        @cancel="handleCancelCloseWithoutSaving"
    />
    <DeleteConfirmationPopup :show="isDeleteConfirmationPopupVisible" @delete="handleDelete" @cancel="hideDeleteConfirmationPopup" />
</template>