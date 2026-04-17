<script setup lang="ts">
import {RadioGroup, RadioGroupLabel, RadioGroupOption} from "@headlessui/vue";
import {Head} from '@inertiajs/vue3';
import {ref, watch} from "vue";
import RecipeTile from "@/components/RecipeTile.vue";
import TextLink from "@/components/TextLink.vue";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select";
import AppLayout from '@/layouts/AppLayout.vue';
import { allRecipes } from '@/routes';
import {index as dashboard, create} from '@/routes/recipe';
import type {BreadcrumbItem, Category, Course, Recipe} from '@/types';

const props = defineProps<{
    recipes: Recipe[]
    categories: Category[]
    courses: Course
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Din kogebog',
        href: dashboard(),
    },
];

const Options = [
    { name: 'Overskrift', inStock: true },
    { name: 'Arbejdstid', inStock: true },
    { name: 'Land', inStock: true },
]

const chosenSort = ref('')
const chosenCategory = ref('')

watch(chosenSort, async (sortedRecipe) => {
    switch (sortedRecipe.name) {
        case 'Overskrift':
            props.recipes.sort((a, b) => (a.name < b.name ? -1 : 1));
            break
        case 'Arbejdstid':
            props.recipes.sort((a, b) => (a.cook_time < b.cook_time ? -1 : 1));
            break
        case 'Land':
            props.recipes.sort((a, b) => (a.country < b.country ? -1 : 1));
            break
    }
})

const filteredRecipes = () => {
    return props.recipes.filter(props.recipes.categories?.id === chosenCategory.value)
}
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
                        <div class="flex flex-col lg:flex-row items-center mb-4">
                            <p class="ml-2 mr-4">Sorter efter:</p>
                            <RadioGroup v-model="chosenSort">
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 2xl:grid-cols-6">
                                    <RadioGroupOption
                                        v-for="option in Options"
                                        :key="option.name"
                                        v-slot="{ checked }"
                                        as="template"
                                        :value="option"
                                        :disabled="!option.inStock"
                                    >
                                        <div
                                            :class="[
                                                  option.inStock
                                                    ? 'cursor-pointer focus:outline-none'
                                                    : 'opacity-25 cursor-not-allowed',
                                                    checked
                                                    ? 'bg-emerald-500/75 hover:bg-emerald-600/75 dark:bg-emerald-800 border-transparent dark:hover:bg-emerald-900'
                                                    : 'hover:bg-gray-200 dark:hover:bg-accent',
                                                    'border rounded-md py-2 px-2 flex items-center justify-center text-xs font-semibold uppercase shadow-md sm:flex-1',
                                                ]"
                                        >
                                            <RadioGroupLabel as="p">
                                                {{ option.name }}
                                            </RadioGroupLabel>
                                        </div>
                                    </RadioGroupOption>
                                </div>
                            </RadioGroup>
                        </div>
                        <div class="mb-2">  <!--TODO: for filtering -->
                            <Select v-model="chosenCategory">
                                <SelectTrigger>
                                    <SelectValue placeholder="Vælg en kategori"/>
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem v-for="item in categories" :key="item.id" :value="item.id">
                                        {{ item.name }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div v-if="recipes.length > 0" class="grid gap-4 grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 ">
                            <RecipeTile :recipes="recipes"/>
                        </div>
                        <div v-if="recipes.length == 0" class="mt-6 flex flex-col">
                            <p>Du har ikke nogen gemte opskrifter endnu</p>
                            <TextLink :href="create()" :tabindex="5">Tilføj en manuelt her</TextLink>
                            <TextLink :href="allRecipes()" :tabindex="5">Eller find en allerede oprettet opskrift her</TextLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
