<script setup lang="ts">
import {index as category_index} from "@/routes/category";
import {Button} from "@/components/ui/button";
import {Form, Head, Link} from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import {Input} from "@/components/ui/input";
import {Label} from "@/components/ui/label";
import type {BreadcrumbItem, Recipe} from "@/types";
import {destroy, index as dashboard} from '@/routes/recipe';
import {Clock, Image, Printer, UserMinus, UserPlus, Plus, Play, Square, Pause, StepForward} from 'lucide-vue-next';
import {ref, shallowRef} from "vue";
import RecipeController from "@/actions/App/Http/Controllers/RecipeController";
import DeleteModal from "@/components/DeleteModal.vue";
import IconButton from "@/components/IconButton.vue";
import {useCountdown} from "@vueuse/core";
import TimeIsUpModal from "@/components/TimeIsUpModal.vue";

const props = defineProps<{
    recipe: Recipe
}>()

let recipeToBeDeleted:Recipe;
const canEdit = ref(false);
const openDelete = ref(false);
const openTimeUp = ref(false);

function openDeleteModal(item: Recipe) {
    openDelete.value = true;
    recipeToBeDeleted = item;
}

const baseAmount = props.recipe.base_amount;
let addedOrRemoved = ref(0);

const addPerson = () => {
    addedOrRemoved.value++;
}

const removePerson = () => {
    addedOrRemoved.value--;
}

const regulateIngredient = (ingredient) => {
    const onePersonIngredient = ingredient / baseAmount;
    return Math.round(ingredient + (onePersonIngredient * addedOrRemoved.value))
}

const countdownSeconds = shallowRef(500)
const isCounting  = ref(false)
const { remaining, start, stop, pause, resume } = useCountdown(countdownSeconds, {
    onComplete() {
        isCounting.value = false
        openTimeUp.value = true;
    },
    onTick() {

    }
})

function startCountdown() {
    start(countdownSeconds)
    isCounting.value = true
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
                            <div class="flex flex-col md:flex-row md:justify-between items-start md:items-center">
                                <p class="md:w-2/3">{{ recipe.description }}</p>
                                <a :href="'/pdf/' + recipe.id + '/' + addedOrRemoved" target="_blank" class="align-middle mt-3 md:ml-4">
                                    <IconButton>
                                        <template #icon>
                                            <Printer class="hover:cursor-pointer m-1" />
                                        </template>
                                    </IconButton>
                                </a>
                            </div>
                            <div class="flex flex-col-reverse md:flex-row justify-between mt-6">
                                <div> <!-- Holds country, amount of people, cook time, timer, category, courses, and ingredients, to flex with image -->
                                    <p class="mt-2">Oprindelsesland: {{ recipe.country }}</p>
                                    <div class="flex flex-row gap-2 my-3 items-center">
                                        <IconButton @click="removePerson">
                                            <template #icon>
                                                <UserMinus class="h-5 w-5"/>
                                            </template>
                                        </IconButton>
                                        <p>Til {{ recipe.base_amount + addedOrRemoved }} personer</p>
                                        <IconButton @click="addPerson">
                                            <template #icon>
                                                <UserPlus class="h-5 w-5"/>
                                            </template>
                                        </IconButton>
                                    </div>
                                    <div class="flex flex-row">
                                        <Clock class="mr-2"/>
                                        <p>Arbejdestid {{ recipe.cook_time }} min.</p>
                                    </div>
                                    <div class="mt-3">
                                        <p>Timer:</p>
                                        <div class="border-2 border-gray-800 w-min p-1 rounded">
                                            <p v-if="isCounting" class="w-48 my-1 px-2">{{remaining}}</p>
                                            <Input v-if="!isCounting" v-model="countdownSeconds" type="number" class="w-48 my-2" />
                                            <div class="flex flex-row gap-2">
                                                <Button variant="outline" @click="startCountdown"><Play/></Button>
                                                <Button variant="outline" @click="stop"><Square/></Button>
                                                <Button variant="outline" @click="pause"><Pause/></Button>
                                                <Button variant="outline" @click="resume"><StepForward/></Button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-3">
                                        <p class="mb-1">Kategorier:</p>
                                        <div class="flex flex-row flex-wrap gap-2">
                                            <div v-for="item in recipe.categories" class="border border-gray-400 py-1 px-2 text-sm text-gray-700 dark:text-gray-300 rounded">
                                                <div class="">{{item.name}}</div>
                                            </div>
    <!--                                    <div class="border border-gray-400 p-1 text-sm text-gray-700 dark:text-gray-300 rounded">-->
    <!--                                        <Plus class="h-5"/>-->
    <!--                                    </div>-->
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="mb-1">Ret:</p>
                                        <div class="flex flex-row flex-wrap gap-2">
                                            <div v-for="item in recipe.courses" class="border border-gray-400 py-1 px-2 text-sm text-gray-700 dark:text-gray-300 rounded">
                                                <div>{{item.name}}</div>
                                            </div>
    <!--                                    <div class="border border-gray-400 p-1 text-sm text-gray-700 dark:text-gray-300 rounded">-->
    <!--                                        <Plus class="h-5"/>-->
    <!--                                    </div>-->
                                        </div>
                                    </div>

                                    <div>
                                        <p>Ingredienser:</p>
                                        <div v-if="recipe.ingredients" v-for="item in recipe.ingredients">
                                            {{ regulateIngredient(item.pivot.measurements) }} {{ item.pivot.unit }} {{ item.name }}
                                        </div>
                                        <div v-if="!recipe.ingredients">Ingen ingredienser tilføjet</div>
                                    </div>
                                </div>
                                <div class="border border-gray-800 mb-3 items-center md:max-w-1/2">
                                    <Image v-if="!recipe.image_name" class="w-full h-full" />
                                    <img v-if="recipe.image_name" :src="`/storage/${recipe.image_name}`" alt="Billede af retten" class="w-full h-full">
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
                                    <div v-if="!canEdit" class="p-2 mt-2 md:w-2/3 border border-emerald-600 dark:border-emerald-800 rounded">
                                        <p class="wrap-break-word">{{ recipe.pivot.notes ?? 'Tilføj noter ved at klikke rediger' }}</p>
                                    </div>
                                    <div class="flex flex-row items-center gap-2">
                                        <Button v-if="canEdit" type="submit" variant="submit">Gem</Button>
                                        <Button :variant="canEdit ? 'outline' : 'submit'" @click.prevent="canEdit = !canEdit" class="my-2">{{canEdit?'Anuller':'Rediger'}}</Button>
                                    </div>
                                </Form>
                            </div>
                            <div class="flex md:justify-end mt-5 md:mt-0">
                                <Button variant="destructive" class="" @click="openDeleteModal(recipe)">Fjern opskrift fra kogebog</Button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <DeleteModal :open="openDelete" @close="openDelete = false" title="Vil du fjerne denne opskrift?">
            <template #description>
                Er du sikker på du vil fjerne {{ recipe.name }} fra din kogebog?
                <br>Du kan altid gemme den igen, men dine noter vil gå tabt
            </template>
            <template #action>
                <Link :href="destroy(recipe.id)" variant="destructive" class="w-full sm:w-auto">
                    <Button variant="destructive" class="w-full">
                        Fjern opskrift
                    </Button>
                </Link>
            </template>
        </DeleteModal>
        <TimeIsUpModal :open="openTimeUp" @close="openTimeUp = false">
            <template #action>
                <Button variant="submit" @click="openTimeUp = false">
                    Forsæt
                </Button>
            </template>
        </TimeIsUpModal>
    </AppLayout>
</template>
