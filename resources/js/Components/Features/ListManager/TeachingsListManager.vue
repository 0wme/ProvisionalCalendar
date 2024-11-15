<script setup lang="ts">
import ListManager from '@/Components/ListManager/ListManager.vue';
import { Teaching, Period } from '@/types/models';
import { defineProps } from 'vue';
import TeachingPopup from '@/Components/Popup/TeachingPopup.vue';
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
    <ListManager
        title="Enseignements"
        hasAdd
        hasImport
        :periods
        :items="teachings"
        @add="openPopup"
        @edit="handleEdit"
    />
    
    <TeachingPopup 
        v-if="showPopup" 
        :is-editing="false"
        @close="showPopup = false" 
    />

    <TeachingPopup 
        v-if="showPopupEdit" 
        :is-editing="true"
        @close="showPopupEdit = false" 
    />
</template>
