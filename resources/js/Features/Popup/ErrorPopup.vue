<script setup lang="ts">
defineProps<{
    message: string;
    show?: boolean;
}>();
</script>

<template>
    <Popup :show>
        <p>{{ message }}</p>
    </Popup>
</template>
