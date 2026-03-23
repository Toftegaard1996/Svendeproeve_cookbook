<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import { Image, Clock } from 'lucide-vue-next';

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
            <div class="grid gap-4 md:grid-cols-5">
                <div class="text-center border-4 border-green-900 rounded-lg p-2 shadow-md">
                    <div class="w-full mb-4">
                        <Image class="mx-auto h-24 w-24"/>
                    </div>
                    <p>Opkrift titel</p>
                    <p>Opkrift beksrivelse?</p>
                    <div class="flex flex-row justify-end w-full mt-2">
                        <div class="flex flex-row">
                            <Clock class="w-5"/>
                            <p class="ml-2">Prep time</p>
                        </div>
                    </div>
                    <div class="grid gap-2 grid-cols-3 mt-4">
                        <div class="border border-gray-400 text-sm text-gray-300 rounded">
                            Frokost
                        </div>
                        <div class="border border-gray-400 text-sm text-gray-300 rounded">
                            Suppe
                        </div>
                        <div class="border border-gray-400 text-sm text-gray-300 rounded">
                            Forret
                        </div>
                    </div>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <PlaceholderPattern />
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <PlaceholderPattern />
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <PlaceholderPattern />
                </div>
            </div>
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
            >
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
