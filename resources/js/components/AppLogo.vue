<script setup lang="ts">
import { computed } from 'vue'
import { getInitials } from '@/composables/useInitials'

const appName = import.meta.env.VITE_APP_NAME
const initials = computed(() => getInitials(appName))
</script>

<template>
    <div
        class="flex aspect-square size-8 items-center justify-center rounded-md bg-sidebar-primary text-sidebar-primary-foreground">
        <p class="text-white dark:text-black">{{ initials }}</p>
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="mb-0.5 truncate font-semibold leading-none">{{ appName }}</span>
    </div>
</template>
