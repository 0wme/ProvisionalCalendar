<script setup lang="ts">
defineProps<{
    name: string,
    selected?: boolean
}>()
</script>

<template>
    <button :class="['selectionnable-button rounded-2xl p-4 shadow-lg text-left', selected ? 'bg-red-100 border border-red-600 border-2' : 'bg-gray-100']">
        <p>{{ name }}</p>
    </button>
</template>