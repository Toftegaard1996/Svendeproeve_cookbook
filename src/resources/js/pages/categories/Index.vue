<script setup lang="ts">
import {Form, Head, useForm} from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { index as dashboard } from '@/routes/recipe';
import type {BreadcrumbItem, Category} from '@/types';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from "@/components/InputError.vue";
import { index as category_index, store }  from "@/routes/category";
import { Image, Clock } from 'lucide-vue-next';
import {Button} from "@/components/ui/button";
import CategoryController from "@/actions/App/Http/Controllers/CategoryController";

defineProps<{
    categories: Category[]
}>()

// const form = useForm({
//     name: '',
// })


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Din kogebog',
        href: dashboard(),
    },
    {
        title: "Tilføj kategori",
        href: category_index(),
    },
];

// function submit(){
//     form.post(route('category.store'));
// }
</script>

<template>
    <Head title="Tilføj kategori" />

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
                            <h2 class="text-xl font-semibold border-b border-gray-900 mb-4">Tilføj kategori</h2>
                            <p>Kategorien skal være unik</p>
                            <Form v-bind="CategoryController.store.form()"
                                  :reset-on-success="['name']"
                                  class="w-full pt-8 md:p-8"
                                  v-slot="{ errors, processing, recentlySuccessful }"
                            >
                                <div class="grid gap-2">
                                    <Label for="name">Kategori navn</Label>
                                    <Input id="name" name="name" placeholder="Suppe" required/>
                                    <InputError :message="errors.name" />
                                </div>
                                <Button type="submit" variant="submit" class="mt-4">Gem kategori</Button>
                            </Form>
                            <h2 class="text-xl font-semibold border-b border-gray-900 mt-10 mb-4">Kategorier der er registreret</h2>
                            <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6">
                                <div
                                    v-for="row in categories"
                                    :key="row.id"
                                    class="flex flex-row gap-2 p-2 items-center justify-around border-2 border-emerald-600 dark:border-emerald-800 rounded"
                                >
                                    <p>{{row.name}}</p>
<!--                                    <Button variant="ghost" class="p-1">X</Button>--> <!-- TODO: Add deletemodal, so the categori can be deleted -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

