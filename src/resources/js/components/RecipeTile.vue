<script setup lang="ts">
import { Clock, Image } from 'lucide-vue-next';
import type {Recipe} from '@/types';
import {Link} from "@inertiajs/vue3";
import { show } from "@/routes/recipe"
defineProps<{
    recipes: Recipe[],
}>()
</script>

<template>
    <div v-for="item in recipes" :key="item.id" class="text-center border-4 border-emerald-700 rounded-lg p-2 shadow-md">
        <Link :href="show(item.id)" >
            <div class="w-full mb-4">
                <Image v-if="!item.image_name" class="mx-auto h-24 w-24"/>
                <img v-if="item.image_name" :src="`/storage/${item.image_name}`" alt="Billede af retten">
            </div>
            <p class="font-bold">{{ item.name }}</p>
            <p>{{ item.description }}</p>
            <div class="flex flex-row justify-end w-full mt-2">
                <div class="flex flex-row">
                    <Clock class="w-5"/>
                    <p class="ml-2">{{ item.cook_time }} min.</p>
                </div>
            </div>
            <div class="grid gap-2 grid-cols-3 mt-4">
                <div v-for="course in item.courses" class="border border-gray-400 text-sm text-gray-300 rounded">
                    {{ course.name }}
                </div>
                <div v-for="category in item.categories" class="border border-gray-400 text-sm text-gray-300 rounded">
                    {{ category.name }}
                </div>
            </div>
        </Link>
    </div>
</template>
