<script setup lang="ts">
import FormButton from "@/Components/FormButton.vue";
import EditTeachingPopup from "@/Features/Popup/Teachings/EditTeachingPopup.vue";
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
        <EditTeachingPopup
            v-if="isAddTeachingPopupVisible"
            :yearId="1"
            :teachingId="1"
            @cancel="hideAddTeachingPopup"
            @successfullyEdited="hideAddTeachingPopup"
            @successfullyDeleted="hideAddTeachingPopup"
        />
    </div>
</template>
