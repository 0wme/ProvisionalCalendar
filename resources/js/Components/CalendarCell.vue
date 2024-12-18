<script setup lang="ts">
defineProps<{
    title: string;
}>();
</script>

<template>
    <div class="flex w-max h-full">
        <div class="w-96 flex items-center justify-center border-r-2">
            {{ title }}
        </div>
        <div class="flex flex-col">
            <slot />
        </div>
    </div>
</template>
