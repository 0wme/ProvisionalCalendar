<script setup lang="ts">
import ListManager from "@/Components/ListManager/ListManager.vue";
import { Teacher } from "@/types/models/teachers";
import { defineProps, defineEmits, computed } from "vue";
import { ref } from "vue";
import { useLabelsStore } from "@/stores/labelsStore";

const labelsStore = useLabelsStore();

defineProps<{
    selectedTeacherIds: number[];
}>();

const teachers = ref<Teacher[]>([
    {
        id: 0,
        name: "Laurent DUBREUIL",
        firstname: "Laurent",
        lastname: "DUBREUIL",
        code: "LD",
    },
    {
        id: 1,
        name: "Anais POURSAT",
        firstname: "Anaïs",
        lastname: "POURSAT",
        code: "PA",
    },
    {
        id: 2,
        name: "Cristina ONETE",
        firstname: "Cristina",
        lastname: "ONETE",
        code: "CO",
    },
]);

const emit = defineEmits(["select", "add", "edit"]);

const title = computed(() => {
    return labelsStore.getLabel("Enseignants");
});

const handleSelect = (teacher: Teacher) => {
    emit("select", teacher);
};

const handleEdit = (teacher: Teacher) => {
    showPopupEdit.value = true;
};

const showPopup = ref(false);
const showPopupEdit = ref(false);

const openPopup = () => {
    showPopup.value = true;
};
</script>

<template>
    <ListManager
        :title="title"
        hasAdd
        :items="teachers"
        :selectedItemsId="selectedTeacherIds"
        @select="handleSelect"
        @add="emit('add')"
        @edit="emit('edit', $event)"
    />
</template>
