<script setup lang="ts">
import SelectionnableButton from './SelectionnableButton.vue';
import IconButton from '@/Components/IconButton.vue';

const props = defineProps<{
    item: any,
    selected: boolean
}>()

const emit = defineEmits(['select']);

const handleEdit = () => {
    // TODO: Ouverture de la popup
    console.log('edit');
}

const handleSelect = () => {
    emit('select', props.item.id);
}
</script>

<template>
    <div class="selectionnable-button-editable flex items-center gap-2">
        <SelectionnableButton class="w-full" :name="item.name" :selected @click="handleSelect" />
        <IconButton iconClass="Pencil" bgColor="#E8DEF8" @click="handleEdit" hasShadow />
    </div>
</template>