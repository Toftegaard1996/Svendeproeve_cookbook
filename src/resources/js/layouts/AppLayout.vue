<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="h-full bg-[url(/img/background2.webp)]">
            <div class="h-full backdrop-blur-[3px]">
                <slot />
            </div>
        </div>
    </AppLayout>
</template>
