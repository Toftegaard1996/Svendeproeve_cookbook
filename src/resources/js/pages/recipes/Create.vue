<script setup lang="ts">

import {Form, Head, useForm} from "@inertiajs/vue3";
import InputError from "@/components/InputError.vue";
import {Button} from "@/components/ui/button";
import {Input} from "@/components/ui/input";
import TagsInput from "@/components/ui/input/TagsInput.vue";
import TextAreaInput from "@/components/ui/input/TextAreaInput.vue";
import {Label} from "@/components/ui/label";
import AppLayout from "@/layouts/AppLayout.vue";
import {index as category_index} from "@/routes/category";
import { index as dashboard } from '@/routes/recipe';
import { store } from '@/routes/recipe'
import type {BreadcrumbItem, Category, Course, Ingredient} from "@/types";
import IngredientsInput from "@/components/ui/input/IngredientsInput.vue";

const form = useForm({
    name: '',
    description: '',
    cook_time: '',
    base_amount: '',
    guide: '',
    country: '',
    image_name: '',
    notes: '',
    categories: [],
    courses: [],
    ingredients: [],
})

defineProps<{
    categories: Category[],
    courses: Course[],
    ingredients: Ingredient[]
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

function submit() {
    form.submit(store())
}
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
                            <Form @submit.prevent="submit"
                                  class="w-full p-8"
                            >
                                <div class="grid gap-2">
                                    <Label for="name">Navn på opskriften</Label>
                                    <Input id="name" v-model="form.name" placeholder="Lasagne"/>
                                    <InputError :message="form.errors.name" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="description">Beskrivelse</Label>
                                    <Input id="description" v-model="form.description" placeholder="Verdens bedste lasagne til den studerende"/>
                                    <InputError :message="form.errors.description" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="cook_time">Arbejdstid (angivet i minutter)</Label>
                                    <Input id="cook_time" v-model="form.cook_time" placeholder="90"/>
                                    <InputError :message="form.errors.cook_time" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="ingredients">Ingredienser</Label>
                                    <IngredientsInput id="ingredients" v-model="form.ingredients" :items="ingredients" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="base_amount">Antal personer</Label>
                                    <Input id="base_amount" v-model="form.base_amount" placeholder="4"/>
                                    <InputError :message="form.errors.base_amount" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="guide">Fremgangsmåde</Label>
                                    <TextAreaInput id="guide" v-model="form.guide" placeholder="Til kødet, varmer du først en pande på høj varme ..."/>
                                    <InputError :message="form.errors.guide" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="country">Oprindelses land</Label>
                                    <Input id="country" v-model="form.country" placeholder="Danmark"/>
                                    <InputError :message="form.errors.country" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="notes">Egne noter (Disse noter kan kun ses af dig)</Label>
                                    <Input id="notes" v-model="form.notes" placeholder="Til min ovn, passer 240 grader bedst"/>
                                    <InputError :message="form.errors.notes" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="categories">Kategorier (Vælg en til flere)</Label>
                                    <TagsInput id="categories" v-model="form.categories" :items="categories"></TagsInput>
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="courses">Ret (Vælg en til flere)</Label>
                                    <TagsInput id="courses" v-model="form.courses" :items="courses"></TagsInput>
                                </div>

                                <div class="grid gap-2 mt-6">
                                    <Label for="image_name">Tilføj billede</Label>
                                    <Input type="file" @input="form.image_name = $event.target.files[0]" id="image_name" v-model="form.image_name"/>
                                </div>
                                <Button type="submit" variant="submit" class="mt-6">Gem opskrift</Button>
                            </Form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
