<script setup lang="ts">
import {Head, useForm} from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type {BreadcrumbItem, Categories} from '@/types';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from "@/components/InputError.vue";
import { index as category_index }  from "@/routes/categories";
import { Image, Clock } from 'lucide-vue-next';
import {Button} from "@/components/ui/button";

const props = defineProps<{
    categories: Categories[]
}>()

const form = useForm({
    name: '',
})

function submit(){
    form.post(route('categories.store'))
}

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
</script>

<template>
    <Head title="Tilføj kategori" />

    <AppLayout :breadcrumbs="breadcrumbs" class="">
        <div class="h-full bg-[url(/img/background2.webp)]">
            <div
                class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4 backdrop-blur-[3px]"
            >
                <div class="py-12">
                    <div class="mx-auto w-4/5 sm:px-6 lg:px-8">
                        <div
                            class="overflow-hidden bg-gray-100 dark:bg-gray-700 rounded-lg"
                        >
                            <div class="p-6">
                                <h2 class="text-xl font-semibold border-b border-gray-900 mb-4">Tilføj kategori</h2>
                                <p>Kategorien skal være unik</p>
                                <form class="w-full p-8" @submit.prevent="submit">
                                    <div class="grid gap-2">
                                        <Label for="name">Kategori navn</Label>
                                        <Input v-model="form.name" placeholder="Suppe"/>
<!--                                        <InputError :message="errors.name" />-->
                                    </div>
                                    <Button variant="submit" class="mt-4">Gem kategori</Button>
                                </form>
                                <h2 class="text-xl font-semibold border-b border-gray-900 mt-10 mb-4">Kategorier der er registreret</h2>
                                <div v-for="row in categories" :key="row.id" class="flex flex-row">
                                    <p>{{row.name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

