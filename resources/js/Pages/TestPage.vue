<script setup lang="ts">
import TeachingsListManager from "@/Features/ListManagers/TeachingsListManager.vue";
import { ref } from "vue";

const isAddTeachingPopupVisible = ref(false);

const showAddTeachingPopup = () => {
    isAddTeachingPopupVisible.value = true;
};

const hideAddTeachingPopup = () => {
    isAddTeachingPopupVisible.value = false;
};
</script>

<template>
    <div class="m-10">
        <TeachingsListManager />
    </div>
</template>
