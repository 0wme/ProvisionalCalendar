<script setup lang="ts">
import Popup from "@/Components/Popup/PopupComponent.vue";

const emit = defineEmits(["close"]);

defineProps<{
    message: string;
}>();
</script>

<template>
    <Popup title="Erreur" @close="emit('close')">
        <p>{{ message }}</p>
    </Popup>
</template>
