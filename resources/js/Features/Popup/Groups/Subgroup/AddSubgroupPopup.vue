<script setup lang="ts">
import SubgroupPopup from './SubgroupPopup.vue';
import { Subgroup } from '@/types/models';
import Button from '@/Components/Button.vue';
import { ref, watch } from 'vue';
import CloseWithoutSaveConfirmationPopup from '@/Features/Popup/CloseWithoutSaveConfirmationPopup.vue';

const emit = defineEmits(['cancel', 'add']);

const props = defineProps<{
    show?: boolean;
}>();

const subgroup = ref<Subgroup>({
    id: 0,
    name: ''
});

watch(() => props.show, () => {
    if (props.show) {
        subgroup.value = {
            id: 0,
            name: ''
        };
    }
});

const isCloseWithoutSaveConfirmationPopupVisible = ref<boolean>(false);

const handleUpdateSubgroupName = (newSubgroupName: string) => {
    subgroup.value.name = newSubgroupName;
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
    if (subgroup.value.name !== '') {
        showCloseWithoutSaveConfirmationPopup();
    } else {
        emit('cancel');
    }
};

const handleAdd = () => {
    emit('add', subgroup.value);
};
</script>

<template>
    <SubgroupPopup :show :subgroup title="Ajouter un sous-groupe" @updateSubgroupName="handleUpdateSubgroupName" @close="handleClose">
        <div class="flex gap-4">
            <Button class="bg-green-500 text-white w-full" @click="handleAdd">Ajouter</Button>
        </div>
        <CloseWithoutSaveConfirmationPopup
            :show="isCloseWithoutSaveConfirmationPopupVisible"
            @close="handleCloseWithoutSaving"
            @cancel="handleCancelCloseWithoutSaving"
        />
    </SubgroupPopup>
</template>