<script setup lang="ts">
import CloseWithoutSaveConfirmationPopup from "@/Components/CloseWithoutSaveConfirmationPopup.vue";
import { onMounted, ref } from "vue";
import Popup from "@/Components/Popup/PopupComponent.vue";
import AddTeacherForm from "@/Features/Forms/Teachers/AddTeacherForm.vue";
import { User } from "@/types/models/teachers";
import { useUserService } from "@/services/userService";

const props = defineProps<{ yearId: number }>();

const userService = useUserService();

const emit = defineEmits(["cancel", "successfullyAdded"]);

const isCloseWithoutSaveConfirmationPopupVisible = ref(false);
const hasBeenEdited = ref<boolean>(false);
const users = ref<User[] | undefined>();

onMounted(() => fetchUsers());

const showCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = true;
};

const hideCloseWithoutSaveConfirmationPopup = () => {
    isCloseWithoutSaveConfirmationPopupVisible.value = false;
};

const handleCancel = () =>
    hasBeenEdited.value
        ? showCloseWithoutSaveConfirmationPopup()
        : emit("cancel");

const handleCloseWithoutSaving = () => {
    hideCloseWithoutSaveConfirmationPopup();
    emit("cancel");
};

const handleHasBeenEdited = () => {
    hasBeenEdited.value = true;
};

const fetchUsers = async () => {
    userService.getUsers().then((res) => (users.value = res));
};
</script>

<template>
    <Popup title="Ajouter un enseignement" @close="handleCancel">
        <AddTeacherForm
            v-if="users !== undefined"
            :users
            :yearId
            @successfullyAdded="$emit('successfullyAdded')"
            @edited="handleHasBeenEdited"
        />
        <div v-else class="w-full flex justify-center">
            <div>Chargement...</div>
        </div>
    </Popup>
    <CloseWithoutSaveConfirmationPopup
        v-if="isCloseWithoutSaveConfirmationPopupVisible"
        @close="handleCloseWithoutSaving"
        @cancel="hideCloseWithoutSaveConfirmationPopup"
    />
</template>
