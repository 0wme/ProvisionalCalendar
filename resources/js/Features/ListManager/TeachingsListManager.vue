<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { Teaching, Period } from '@/types/models';
import AddTeachingPopup from '@/Components/Popup/AddTeachingPopup.vue';
import EditTeachingPopup from '@/Components/Popup/EditTeachingPopup.vue';
import { ref } from 'vue';

const props = defineProps<{
    title: string;
    periods: Period[];
    teachings: Teaching[];
}>();

const emit = defineEmits(['update', 'delete']);

const showPopup = ref(false);
const showPopupEdit = ref(false);
const selectedTeaching = ref<Teaching | null>(null);

const openPopup = () => {
    showPopup.value = true;
};

const handleEdit = (teaching: Teaching) => {
    selectedTeaching.value = teaching;
    showPopupEdit.value = true;
};

const handleUpdate = (updatedTeaching: Teaching) => {
    emit('update', updatedTeaching);
    showPopupEdit.value = false;
};

const handleDelete = () => {
    if (selectedTeaching.value) {
        emit('delete', selectedTeaching.value);
    }
    showPopupEdit.value = false;
};
</script>

<template>
    <div class="teachings-list-manager h-full w-full">
        <ListManager
            title="Enseignements"
            hasAdd
            hasImport
            :periods="periods"
            :items="teachings"
            @add="openPopup"
            @edit="handleEdit"
        />
        
        <AddTeachingPopup 
            class="z-50"
            v-if="showPopup"
            @close="showPopup = false" 
        />

        <EditTeachingPopup 
            v-if="showPopupEdit && selectedTeaching"
            class="z-50"
            :initial-values="selectedTeaching"
            @close="showPopupEdit = false"
            @update="handleUpdate"
            @delete="handleDelete"
        />
    </div>
</template>
