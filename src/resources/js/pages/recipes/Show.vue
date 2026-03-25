<script setup lang="ts">
import {index as category_index, store} from "@/routes/category";
import {Button} from "@/components/ui/button";
import {Form, Head} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import {Input} from "@/components/ui/input";
import {Label} from "@/components/ui/label";
import type {BreadcrumbItem, Recipe} from "@/types";
import { index as dashboard } from '@/routes/recipe';
import { Clock, Image } from 'lucide-vue-next';

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
                            <h2 class="text-xl font-semibold border-b border-gray-900 mb-4">{{ recipe.name }}</h2>
                            <p>{{ recipe.description }}</p>
                            <div class="flex md:flex-row justify-between mt-6">
                                <div>
                                    <p>Ingredienser:</p>
                                    <div v-for="item in recipe.ingredients">
                                        {{ item.pivot.measurements }} {{ item.pivot.unit }} {{ item.name }}
                                    </div>
                                </div>
                                <div class="border border-red-500">
                                    <Image class="w-44 h-44" />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
