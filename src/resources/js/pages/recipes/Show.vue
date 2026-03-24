<script setup lang="ts">
import {index as category_index, store} from "@/routes/category";
import {Button} from "@/components/ui/button";
import {Form, Head} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import {Input} from "@/components/ui/input";
import {Label} from "@/components/ui/label";
import type {BreadcrumbItem, Recipe} from "@/types";
import { index as dashboard } from '@/routes/recipe';

defineProps<{
    recipe: Recipe
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Din kogebog',
        href: dashboard(),
    },
    {
        title: "Se opskrift",
        href: category_index(),
    },
];
</script>

<template>
    <Head title="Se opskrift" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="py-12">
                <div class="mx-auto w-4/5 sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-gray-100 dark:bg-gray-700 rounded-lg"
                    >
                        <div class="p-6">
                            <h2 class="text-xl font-semibold border-b border-gray-900 mb-4">Se opskrift</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
