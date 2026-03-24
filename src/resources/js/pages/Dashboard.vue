<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import {index as dashboard} from '@/routes/recipe';
import type {BreadcrumbItem, Recipe} from '@/types';
import RecipeTile from "@/components/RecipeTile.vue";

defineProps<{
    recipes: Recipe[]
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Din kogebog',
        href: dashboard(),
    },
];
</script>

<template>
    <Head title="Din kogebog" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="py-12">
                <div class="mx-auto w-4/5 sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-gray-100 dark:bg-gray-700 rounded-lg p-6"
                    >
                        <h2 class="text-xl font-semibold mb-4">Dine gemte opskrifter</h2>
                        <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                            <RecipeTile :recipes="recipes"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
