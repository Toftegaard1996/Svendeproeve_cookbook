<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ChefHat } from 'lucide-vue-next';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="flex min-h-svh flex-col items-center justify-center gap-6 bg-[url(/img/background.png)] p-6 md:p-10"
    >
        <div class="flex w-full max-w-md flex-col gap-6">

            <div class="flex flex-col gap-6">
                <Card class="rounded-xl">
                    <ChefHat
                        class="size-9 flex items-center self-center font-medium text-black dark:text-white"
                    />
                    <CardHeader class="px-10 text-center">
                        <CardTitle class="text-xl">{{ title }}</CardTitle>
                        <CardDescription>
                            {{ description }}
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="px-10 py-8">
                        <slot />
                    </CardContent>
                </Card>
            </div>
        </div>
    </div>
</template>
