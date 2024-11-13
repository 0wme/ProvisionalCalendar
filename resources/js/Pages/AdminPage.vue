<script setup lang="ts">
import Sidebar from '@/Components/Navigation/Sidebar.vue';
import { ref, onMounted, onUnmounted } from 'vue';
import HeaderMenu from '@/Components/Navigation/HeaderMenu.vue';
import { sidebarMenuItems } from '@/config/navigation';
import { Head } from '@inertiajs/vue3';

const mainContentHeight = ref<number>(0);
const adminPage = ref<HTMLElement | null>(null);
const headerMenu = ref<HTMLElement | null>(null);
const observer = ref<MutationObserver | null>(null);
const currentPath = ref(window.location.pathname.split('/')[1]);

const getCurrentSubmenu = () => {
    const currentItem = sidebarMenuItems.find(item => item.route === currentPath.value);
    return currentItem?.submenu;
};

const updateMainContentHeight = () => {
    requestAnimationFrame(() => {
        const headerMenuHeight = headerMenu.value?.getBoundingClientRect().bottom ?? 0;
        mainContentHeight.value = window.innerHeight - headerMenuHeight - 80;
    });
};

onMounted(() => {
    headerMenu.value = adminPage.value!.querySelector('.header-menu');
    
    window.addEventListener('resize', updateMainContentHeight);
    
    observer.value = new MutationObserver(() => {
        setTimeout(() => updateMainContentHeight(), 1);
    });
    
    observer.value.observe(adminPage.value!, {
        attributes: true,
        subtree: true
    });
    
    updateMainContentHeight();
});

onUnmounted(() => {
    observer.value?.disconnect();
    window.removeEventListener('resize', updateMainContentHeight);
});
</script>

<template>
    <Head title="Calendrier prévisionnel" />
    <div ref="adminPage" class="admin-page w-screen h-screen bg-gray-100 flex">
        <Sidebar :items="sidebarMenuItems" />
        <div class="w-full h-full">
            <HeaderMenu :items="getCurrentSubmenu()!" />
            <div class="main-content bg-red-900 m-10" :style="{ '--header-menu-height': mainContentHeight + 'px' }">
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>
.main-content {
    width: calc(100% - 80px);
    height: var(--header-menu-height);
}
</style>