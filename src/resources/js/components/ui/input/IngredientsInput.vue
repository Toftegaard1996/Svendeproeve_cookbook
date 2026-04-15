<script setup lang="ts">
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { ref, watch } from 'vue';
import { X, Plus } from 'lucide-vue-next';
import Input from "@/components/ui/input/Input.vue";

const props = defineProps<{
    items: Array
}>()

interface Ingredient {
    measurement: string,
    unit: string,
    ingredient: string
}

const model = defineModel<Ingredient[]>({
    default: []
})

const measurementTag = ref('')
const unitTag = ref('')
const ingredientTag = ref('')
const unit = ['liter','deciliter', 'stk', 'dåse', 'spiseske','teske', 'slat','skvulp','skvis', 'gr', 'kg'];


const idToName = (id) => {
    return props.items.find(i => i.id === id)?.name
}

const addItem = (measurementValue: string, unitValue: string, id: string) => {
    model.value.push({'measurement': measurementValue, 'unit': unitValue, 'ingredient': id})
    measurementTag.value = ''
    unitTag.value = ''
    ingredientTag.value = ''
}

const removeItem = (id) => {
    model.value = model.value.filter(i => i !== id)
}

const searchIngredientFunction = () => {
    const input = document.getElementById("searchIngredient");
    const filter = input.value.toUpperCase();
    const ingredientDropdown = document.getElementById("ingredientSelect");
    const selectItem = ingredientDropdown.getElementsByTagName("p");
    let textValue
    for (let i = 0; i < selectItem.length; i++) {
        textValue = selectItem[i].textContent || selectItem[i].innerText;
        if (textValue.toUpperCase().indexOf(filter) > -1) {
            selectItem[i].style.display = "";
        } else {
            selectItem[i].style.display = "none";
        }
    }
}

</script>

<template>
    <div>
        <div class="flex flex-row flex-wrap gap-2">
            <Input v-model="measurementTag" placeholder="400" class="w-16"/>
            <Select v-model="unitTag" class="hover:cursor-pointer">
                <SelectTrigger>
                    <SelectValue placeholder="gram"/>
                </SelectTrigger>
                <SelectContent>
                    <SelectItem v-for="item in unit" :key="item" :value="item">
                        {{ item }}
                    </SelectItem>
                </SelectContent>
            </Select>
            <Select v-model="ingredientTag" class="hover:cursor-pointer" id="ingredientSelect">
                <SelectTrigger>
                    <SelectValue placeholder="Gulerødder"/>
                </SelectTrigger>
                <SelectContent>
                    <Input type="text" placeholder="Søg .." id="searchIngredient" @change="searchIngredientFunction()" class="mb-1"/>
                    <SelectItem v-for="item in items" :key="item.id" :value="item.id" id="ingredientSelect">
                        <p id="itemName">{{ item.name }}</p>
                    </SelectItem>
                </SelectContent>
            </Select>
            <div @click="addItem(measurementTag, unitTag, ingredientTag)" class="border-2 border-gray-800 p-1 rounded flex items-center hover:cursor-pointer hover:bg-accent">
                <Plus class="h-4"/>
            </div>
        </div>
        <div v-if="model" class="mt-1">
            <div v-for="item in model" @click="removeItem(item)" class="border border-black p-1 rounded mb-1 flex flex-row items-center size-fit hover:cursor-pointer">
                <div>{{ item.measurement }} {{ item.unit }} {{ idToName(item.ingredient) }}</div>
                <X class="h-4 ml-2"/>
            </div>
        </div>
    </div>
</template>
