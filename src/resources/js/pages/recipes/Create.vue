<script setup lang="ts">

import {index as category_index, store} from "@/routes/category";
import {Button} from "@/components/ui/button";
import {Form, Head, useForm} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import {Input} from "@/components/ui/input";
import {Label} from "@/components/ui/label";
import type {BreadcrumbItem, Category} from "@/types";
import { index as dashboard } from '@/routes/recipe';
import InputError from "@/components/InputError.vue";
import TextAreaInput from "@/components/ui/input/TextAreaInput.vue";
import RecipeController from "@/actions/App/Http/Controllers/RecipeController";
import TagInput from "@/components/TagInput.vue";

// const form = useForm({
//     name: '',
//     description: '',
//     cook_time: 0,
//     base_amount: 0,
//     guide: '',
//     country: '',
// })

defineProps<{
    categories: Category[],
}>()

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Din kogebog',
        href: dashboard(),
    },
    {
        title: "Tilføj opskrift",
        href: category_index(),
    },
];
</script>

<template>
    <Head title="Tilføj opskrift" />

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
                            <h2 class="text-xl font-semibold border-b border-gray-900">Tilføj opskrift</h2>
                            <Form v-bind="RecipeController.store.form()"
                                  class="w-full p-8"
                                  v-slot="{ errors, processing, recentlySuccessful }"
                            >
                                <div class="grid gap-2">
                                    <Label for="name">Navn på opskriften</Label>
                                    <Input id="name" name="name" placeholder="Lasagne"/>
                                    <InputError :message="errors.name" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="description">Beskrivelse</Label>
                                    <Input id="description" name="description" placeholder="Verdens bedste lasagne til den studerende"/>
                                    <InputError :message="errors.description" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="cook_time">Arbejdstid (angivet i minutter)</Label>
                                    <Input id="cook_time" name="cook_time" placeholder="90"/>
                                    <InputError :message="errors.cook_time" />
                                </div>
                                <!-- TODO: Add ingredients -->
                                <div class="grid gap-2 mt-6">
                                    <Label for="ingredients">Ingredienser</Label>
<!--                                    <Input id="base_amount" name="base_amount" placeholder="4"/>-->
<!--                                    <InputError :message="errors.base_amount" />-->
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="base_amount">Antal personer</Label>
                                    <Input id="base_amount" name="base_amount" placeholder="4"/>
                                    <InputError :message="errors.base_amount" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="guide">Fremgangsmåde</Label>
                                    <TextAreaInput id="guide" name="guide" placeholder="Til kødet, varmer du først en pande på høj varme ..."/>
                                    <InputError :message="errors.guide" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="country">Oprindelses land</Label>
                                    <Input id="country" name="country" placeholder="Danmark"/>
                                    <InputError :message="errors.country" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="notes">Egne noter (Disse noter kan kun ses af dig)</Label>
                                    <Input id="notes" name="notes" placeholder="Til min ovn, passer 240 grader bedst"/>
                                    <InputError :message="errors.notes" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="categories">Kategorier (Vælg en til flere)</Label>
                                    <TagInput :category="categories"></TagInput>
<!--                                    <Input id="country" name="country" placeholder="Danmark"/>-->
<!--                                    <InputError :message="errors.country" />-->
                                </div>

                                <div class="grid gap-2 mt-6">
                                    <Label for="country">Tilføj billede (coming soon)</Label>
                                </div>
                                <!-- TODO: Add categories and course -->
                                <Button type="submit" variant="submit" class="mt-6">Gem opskrift</Button>
                            </Form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
