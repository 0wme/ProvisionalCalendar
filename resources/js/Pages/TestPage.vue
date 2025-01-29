<script setup lang="ts">
import FormButton from "@/Components/FormButton.vue";
import AddTeachingPopup from "@/Features/Popup/Teachings/AddTeachingPopup.vue";
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
        <FormButton @click="showAddTeachingPopup"
            >Ajouter une enseignement</FormButton
        >
        <AddTeachingPopup
            v-if="isAddTeachingPopupVisible"
            :yearId="1"
            @cancel="hideAddTeachingPopup"
            @successfullyAdded="hideAddTeachingPopup"
        />
    </div>
</template>
