<script setup lang="ts">
defineProps<{
    message: string;
}>();
</script>

<template>
    <Popup>
        <p>{{ message }}</p>
    </Popup>
</template>
