<script setup lang="ts">
/**
 * A script setup for a component that allows the user to add a subgroup to a year.
 *
 * It emits a "successfullyAdded" event with the newly created subgroup as argument when the
 * addition is successful.
 *
 * It uses the yearId prop to determine the year to which the subgroup should be added.
 */
import FormInput from "@/Components/FormInput.vue";
import FormButton from "@/Components/FormButton.vue";
import { Subgroup } from "@/types/models/groups";
import { MESSAGES } from "@/constants";
import { ref } from "vue";
import ErrorPopup from "@/Features/Popups/ErrorPopup.vue";
import { useSubgroupService } from "@/services/groups/subgroupService";

const props = defineProps<{ groupId: number }>();

const emit = defineEmits(["successfullyAdded", "edited"]);

const subgroupService = useSubgroupService();
const subgroup = ref<Subgroup>({ id: 0, name: "" });
const nameError = ref<string | undefined>();

const errorMessage = ref<string | undefined>();

const updateName = (value: string) => {
    nameError.value = undefined;
    subgroup.value.name = value;
    emit("edited");
};

const showErrorPopup = (error: string) => (errorMessage.value = error);

const resetErrorMessage = () => (errorMessage.value = undefined);

const handleAdd = () => {
    if (subgroup.value.name.trim() === "") {
        nameError.value = MESSAGES.EMPTY_SUBGROUP_NAME_ERROR_MESSAGE;
        return;
    }
    subgroupService
        .addSubgroup(props.groupId, subgroup.value)
        .then((returnedSubgroup) => emit("successfullyAdded", returnedSubgroup))
        .catch(showErrorPopup);
};
</script>

<template>
    <div class="flex flex-col gap-6">
        <FormInput
            label="Nom du sous-groupe"
            :value="subgroup.name"
            :error="nameError"
            @input="updateName($event.target.value)"
        />
        <FormButton class="bg-green-500 text-white" @click="handleAdd"
            >Ajouter</FormButton
        >
        <ErrorPopup
            v-if="errorMessage"
            :message="errorMessage"
            @close="resetErrorMessage"
        />
    </div>
</template>
