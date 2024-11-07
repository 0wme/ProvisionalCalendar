<script setup lang="ts">
import Icon from '@/Components/Icon.vue';
import IconButton from '@/Components/IconButton.vue';

const props = defineProps<{
    placeholder: string
}>()
</script>

<template>
    <div class="search-bar flex items-center gap-2 border border-gray-300 rounded-2xl p-1">
        <Icon name="Search" />
        <input class="border-none focus:ring-0 w-full" type="text" :placeholder="placeholder" />
        <IconButton v-for="i in 2" :key="i" iconClass="Pen" />
    </div>
</template>

<style scoped>

</style>
