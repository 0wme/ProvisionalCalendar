<script setup lang="ts">
import SelectionnableButton from "./SelectionnableButton.vue";
import IconButton from "@/Components/IconButton.vue";
import { Item } from "@/types/models";

const props = defineProps<{
    item: Item;
    selected?: boolean;
}>();

const emit = defineEmits(["select", "edit"]);

const handleEdit = () => {
    emit("edit", props.item.id);
};

const handleSelect = () => {
    emit("select", props.item.id);
};

const handleDrag = (event: DragEvent) => {
    if (event.dataTransfer) {
        // Format attendu par CalendarCell
        const teacherData = {
            id: props.item.id,
            name: props.item.name
        };
        event.dataTransfer.setData('teacher', JSON.stringify(teacherData));
        event.dataTransfer.effectAllowed = 'move';
    }
};
</script>

<template>
    <div class="selectionnable-button-editable flex items-center gap-2">
        <SelectionnableButton
            class="w-full"
            :name="item.name"
            :selected
            @click="handleSelect"
            @dragstart="handleDrag"
        />
        <IconButton
            iconClass="Pencil"
            bgColor="#E8DEF8"
            @click="handleEdit"
            hasShadow
        />
    </div>
</template>
