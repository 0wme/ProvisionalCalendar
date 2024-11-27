<script setup lang="ts">
import ClassPopup from './ClassPopup.vue';
import { Class } from '@/types/models';
import Button from '@/Components/Button.vue';
import { ref, watch } from 'vue';
import CloseWithoutSaveConfirmationPopup from '@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue';
import axios from 'axios';

const emit = defineEmits(['cancel', 'add', 'error']);

const props = defineProps<{
    show?: boolean;
}>();

const classe = ref<Class>({
    id: 0,
    name: '',
    groups: []
});

watch(() => props.show, () => {
    if (props.show) {
        classe.value = {
            id: 0,
            name: '',
            groups: []
        };
    }
});

const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);

const handleUpdateClassName = (newClassName: string) => {
    classe.value.name = newClassName;
};

const handleCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
    emit('cancel');
};

const handleCancelCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
};

const showCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = true;
};

const hideCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = false;
};

const handleClose = () => {
    if (classe.value.name !== '') {
        showCloseWithoutSaveConfirmationPopup();
    } else {
        emit('cancel');
    }
};

const handleAdd = async () => {
    try {
        const response = await axios.post('/api/groupes/promotion/1', classe.value);
        emit('add', response.data.promotion);
    } catch (error: any) {
        if (error.response?.status === 422) {
            emit('error', error.response.data.error);
            return;
        }
        return;
    }
};
</script>

<template>
    <ClassPopup :show :classe title="Ajouter un sous-groupe" @updateClassName="handleUpdateClassName" @close="handleClose">
        <div class="flex gap-4">
            <Button class="bg-green-500 text-white w-full" @click="handleAdd">Ajouter</Button>
        </div>
        <CloseWithoutSaveConfirmationPopup
            :show="isCloseWithoutSaveConfirmationPopupVisible"
            @close="handleCloseWithoutSaving"
            @cancel="handleCancelCloseWithoutSaving"
        />
    </ClassPopup>
</template>