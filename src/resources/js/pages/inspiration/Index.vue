<script setup lang="ts">
import {Form, Head} from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { index as dashboard } from '@/routes/recipe';
import type {BreadcrumbItem, Category} from '@/types';
import { inspiration }  from "@/routes";
import RecipeController from "@/actions/App/Http/Controllers/RecipeController";
import {Clock, Image, Printer, UserMinus, UserPlus} from "lucide-vue-next";
import {Label} from "@/components/ui/label";
import {Input} from "@/components/ui/input";
import IconButton from "@/components/IconButton.vue";
import {Button} from "@/components/ui/button";


defineProps<{
    randomRecipe: []
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Din kogebog',
        href: dashboard(),
    },
    {
        title: "Inspiration",
        href: inspiration(),
    },
];

</script>

<template>
    <Head title="Inspiration" />

    <AppLayout :breadcrumbs="breadcrumbs" class="">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="py-12">
                <div class="mx-auto w-4/5 sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-gray-100 dark:bg-gray-700 rounded-lg"
                    >
                        <div class="p-6">
                            <h2 class="text-xl font-semibold border-b border-gray-900 mb-4">Inspiration - Random måltid</h2>
                            <p>Denne side snakker sammen med The Meal DB, for at hente en tilfældig opskrift fra deres database, til inspiration</p>
                            <div>
                                <h2 class="text-xl font-semibold border-b border-gray-900 my-4">{{ randomRecipe[0].strMeal }}</h2>
                            </div>
                            <div class="flex flex-col-reverse md:flex-row md:justify-between items-center">
                            </div>
                            <p class="my-2">Oprindelsesland: {{ randomRecipe[0].strArea }}</p>
                            <div class="flex flex-row">
                                <Clock class="mr-2"/>
                                <p>Arbejdestid XX min.</p>
                            </div>
                            <div class="my-3">
                                <p class="mb-1">Kategorier:</p>
                                <div class="flex flex-row gap-2">
                                    <div  class="border border-gray-400 py-1 px-2 text-sm text-gray-300 rounded">
                                        <div>{{randomRecipe[0].strCategory}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col-reverse md:flex-row justify-between mt-6">
                                <div>
                                    <p>Ingredienser:</p>
                                    <div v-if="randomRecipe[0].strIngredient1">
                                        {{ randomRecipe[0].strMeasure1 }} {{ randomRecipe[0].strIngredient1 }}
                                    </div>
                                    <div v-if="randomRecipe[0].strIngredient2">
                                        {{ randomRecipe[0].strMeasure2 }} {{ randomRecipe[0].strIngredient2 }}
                                    </div>
                                    <div v-if="randomRecipe[0].strIngredient3">
                                        {{ randomRecipe[0].strMeasure3 }} {{ randomRecipe[0].strIngredient3 }}
                                    </div>
                                    <div v-if="randomRecipe[0].strIngredient4">
                                        {{ randomRecipe[0].strMeasure4 }} {{ randomRecipe[0].strIngredient4 }}
                                    </div>
                                    <div v-if="randomRecipe[0].strIngredient5">
                                        {{ randomRecipe[0].strMeasure5 }} {{ randomRecipe[0].strIngredient5 }}
                                    </div>
                                    <div v-if="randomRecipe[0].strIngredient6">
                                        {{ randomRecipe[0].strMeasure6 }} {{ randomRecipe[0].strIngredient6 }}
                                    </div>
                                    <div v-if="randomRecipe[0].strIngredient7">
                                        {{ randomRecipe[0].strMeasure7 }} {{ randomRecipe[0].strIngredient7 }}
                                    </div>
                                    <div v-if="randomRecipe[0].strIngredient8">
                                        {{ randomRecipe[0].strMeasure8 }} {{ randomRecipe[0].strIngredient8 }}
                                    </div>
                                    <div v-if="randomRecipe[0].strIngredient9">
                                        {{ randomRecipe[0].strMeasure9 }} {{ randomRecipe[0].strIngredient9 }}
                                    </div>
                                    <div v-if="randomRecipe[0].strIngredient10">
                                        {{ randomRecipe[0].strMeasure10 }} {{ randomRecipe[0].strIngredient10 }}
                                    </div>
<!--                                    <div v-if="!randomRecipe[0].ingredients">Ingen ingredienser tilføjet</div>-->
                                </div>
                                <div class="w-1/3">
                                    <Image v-if="!randomRecipe[0].strMealThumb" class="w-full h-44" />
                                    <img v-if="randomRecipe[0].strMealThumb" :src="`${randomRecipe[0].strMealThumb}/medium`" alt="Billede af retten">
                                </div>
                            </div>
                            <div v-if="randomRecipe[0].strInstructions" class="mt-6 w-2/3">
                                <p>Fremgangsmåde:</p>
                                <div class="whitespace-pre-wrap">{{ randomRecipe[0].strInstructions }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

