<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { Teaching, Period } from '@/types/models';
import { defineProps } from 'vue';
import AddTeachingPopup from '@/Components/Popup/AddTeachingPopup.vue';
import EditTeachingPopup from '@/Components/Popup/EditTeachingPopup.vue';
import { ref } from 'vue';

defineProps<{
    title: string;
    periods: Period[];
    teachings: Teaching[];
}>();

const showPopup = ref(false);
const showPopupEdit = ref(false);
const openPopup = () => {
    showPopup.value = true;
}

const handleEdit = (teaching: Teaching) => {
    showPopupEdit.value = true;
}
</script>

<template>
    <div class="teachings-list-manager h-full w-full">
        <ListManager
            title="Enseignements"
            hasAdd
            hasImport
            :periods
            :items="teachings"
            @add="openPopup"
            @edit="handleEdit"
        />
        
        <AddTeachingPopup 
            class="z-50"
            v-if="showPopup" 
            :is-editing="false"
            @close="showPopup = false" 
        />

        <EditTeachingPopup 
            class="z-50"
            v-if="showPopupEdit" 
            :is-editing="true"
            @close="showPopupEdit = false" 
            />
    </div>
</template>
