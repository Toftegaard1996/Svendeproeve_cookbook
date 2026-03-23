<script setup lang="ts">

import {index as category_index, store} from "@/routes/categories";
import {Button} from "@/components/ui/button";
import {Form, Head, useForm} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import {Input} from "@/components/ui/input";
import {Label} from "@/components/ui/label";
import type {BreadcrumbItem} from "@/types";
import {dashboard} from "@/routes";
import InputError from "@/components/InputError.vue";
import TextAreaInput from "@/components/ui/input/TextAreaInput.vue";

const form = useForm({
    name: '',
    description: '',
    cook_time: 0,
    base_amount: 0,
    guide: '',
    country: '',
})

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
                            <form v-bind="store.form()"
                                  :reset-on-success="['password']"
                                  class="w-full p-8">
                                <div class="grid gap-2">
                                    <Label for="name">Navn på opskriften</Label>
                                    <Input v-model="form.name" placeholder="Lasagne"/>
                                    <InputError :message="form.errors.name" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="description">Beskrivelse</Label>
                                    <Input v-model="form.description" placeholder="Verdens bedste lasagne til den studerende"/>
                                    <InputError :message="form.errors.description" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="cook_time">Arbejdstid (angivet i minutter)</Label>
                                    <Input v-model="form.cook_time" placeholder="90"/>
                                    <InputError :message="form.errors.cook_time" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="base_amount">Antal personer</Label>
                                    <Input v-model="form.base_amount" placeholder="Lasagne"/>
                                    <InputError :message="form.errors.base_amount" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="guide">Fremgangsmåde</Label>
                                    <TextAreaInput v-model="form.guide" placeholder="Til kødet, varmer du først en pande på høj varme ..."/>
                                    <InputError :message="form.errors.guide" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="country">Oprindelses land</Label>
                                    <Input v-model="form.country" placeholder="Danmark"/>
                                    <InputError :message="form.errors.country" />
                                </div>
                                <div class="grid gap-2 mt-6">
                                    <Label for="country">Tilføj billede (coming soon)</Label>
                                </div>
                                <Button type="submit" variant="submit" class="mt-6">Gem opskrift</Button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
