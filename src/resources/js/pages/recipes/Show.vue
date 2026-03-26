<script setup lang="ts">
import {index as category_index} from "@/routes/category";
import {Button} from "@/components/ui/button";
import {Form, Head, Link} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import {Input} from "@/components/ui/input";
import {Label} from "@/components/ui/label";
import type {BreadcrumbItem, Recipe} from "@/types";
import {destroy, index as dashboard} from '@/routes/recipe';
import {Clock, Image, Printer, UserMinus, UserPlus} from 'lucide-vue-next';
import {ref} from "vue";
import RecipeController from "@/actions/App/Http/Controllers/RecipeController";
import DeleteModal from "@/components/DeleteModal.vue";
import IconButton from "@/components/IconButton.vue";

defineProps<{
    recipe: Recipe
}>()

let recipeToBeDeleted:Recipe;
const canEdit = ref(false);
const openDelete = ref(false);

function openDeleteModal(item: Recipe) {
    openDelete.value = true;

    recipeToBeDeleted = item;

}

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
                            <div>
                                <h2 class="text-xl font-semibold border-b border-gray-900 mb-4">{{ recipe.name }}</h2>
                            </div>
                            <div class="flex flex-col-reverse md:flex-row md:justify-between items-center">
                                <p>{{ recipe.description }}</p>
                                <IconButton class="p-2">
                                    <template #icon>
                                        <Printer />
                                    </template>
                                </IconButton>
                            </div>
                            <p class="mt-2">Oprindelsesland: {{ recipe.country }}</p>
                            <div class="flex flex-row gap-2 my-3">
                                <IconButton>
                                    <template #icon>
                                        <UserMinus class="h-4 w-4"/>
                                    </template>
                                </IconButton>
                                <p>Til {{ recipe.base_amount }} personer</p>
                                <IconButton>
                                    <template #icon>
                                        <UserPlus class="h-4 w-4"/>
                                    </template>
                                </IconButton>
                            </div>
                            <div class="flex flex-row">
                                <Clock class="mr-2"/>
                                <p>Arbejdestid {{ recipe.cook_time }} min.</p>
                            </div>
                            <div class="flex flex-col-reverse md:flex-row justify-between mt-6">
                                <div>
                                    <p>Ingredienser:</p>
                                    <div v-for="item in recipe.ingredients">
                                        {{ item.pivot.measurements }} {{ item.pivot.unit }} {{ item.name }}
                                    </div>
                                </div>
                                <div class="border border-red-500 w-1/3">
                                    <Image class="w-full h-44" />
                                </div>
                            </div>
                            <div v-if="recipe.guide" class="mt-6 w-2/3">
                                <p>Fremgangsmåde:</p>
                                <div class="whitespace-pre-wrap">{{ recipe.guide }}</div>
                            </div>
                            <div >
                                <Form v-bind="RecipeController.update.form(recipe)">
                                    <div class="grid gap-2 mt-6">
                                        <Label for="notes">Egne noter (Disse noter kan kun ses af dig)</Label>
                                        <Input v-if="canEdit" id="notes" name="notes" :default-value="recipe.pivot.notes"/>
<!--                                        <InputError :message="errors.notes" />-->
                                    </div>
                                    <div v-if="!canEdit" class="p-2 mt-2 w-2/3 border border-emerald-600 dark:border-emerald-800 rounded">
                                        <p>{{ recipe.pivot.notes }}</p>
                                    </div>
                                    <div class="flex flex-row items-center gap-2">
                                        <Button v-if="canEdit" type="submit" variant="submit">Gem</Button>
                                        <Button :variant="canEdit ? 'outline' : 'submit'" @click.prevent="canEdit = !canEdit" class="my-2">{{canEdit?'Anuller':'Rediger'}}</Button>
                                    </div>
                                </Form>
                            </div>
                            <div class="flex justify-end">
                                <Button variant="destructive" class="" @click="openDeleteModal(recipe)">Fjern opskrift fra kogebog</Button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <DeleteModal :open="openDelete" @close="openDelete = false" title="Vil du fjerne denne opskrift?">
            <template #description>Er du sikker på du vil fjerne {{ recipe.name }} fra din kogebog?<br>Du kan altid gemme den igen, men dine noter vil gå tabt</template>
            <template #action>
                <Link :href="destroy(recipe.id)" variant="destructive">
                    <Button variant="destructive">
                        Fjern opskrift
                    </Button>
                </Link>
            </template>
        </DeleteModal>
    </AppLayout>
</template>
