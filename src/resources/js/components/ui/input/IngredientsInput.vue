<script setup lang="ts">
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import {computed, ref, watch} from 'vue';
import { X, Plus, CheckIcon, ChevronDown } from 'lucide-vue-next';
import Input from "@/components/ui/input/Input.vue";
import {
    Command,
    CommandEmpty,
    CommandGroup,
    CommandInput,
    CommandItem,
    CommandList,
} from '@/components/ui/command'
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover'
import {Button} from "@/components/ui/button";
import {cn} from "@/lib/utils";

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

const open = ref(false)
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

function selectIngredient(selectedValue: string) {
    ingredientTag.value = selectedValue === ingredientTag.value ? '' : selectedValue
    open.value = false
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
            <Popover v-model:open="open" v-model="ingredientTag">
                <PopoverTrigger as-child>
                    <Button
                        variant="outline"
                        role="combobox"
                        :aria-expanded="open"
                        class="w-50 justify-between"
                    >
                        {{ idToName(ingredientTag) || "Vælg ingredient..." }}
                        <ChevronDown class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                    </Button>
                </PopoverTrigger>
                <PopoverContent class="w-50 p-0" v-model="ingredientTag">
                    <Command>
                        <CommandInput placeholder="Søg ingredient..." />
                        <CommandList>
                            <CommandEmpty>Ingen ingredienser fundet.</CommandEmpty>
                            <CommandGroup>
                                <CommandItem
                                    v-for="item in items"
                                    :key="item.id"
                                    :value="item.id"
                                    @select="(ev) => {
                                        selectIngredient(ev.detail.value as string)
                                    }"
                                >
                                    {{ item.name }}
                                    <CheckIcon
                                        :class="cn(
                                          'mr-2 h-4 w-4',
                                          ingredientTag === item.id ? 'opacity-100' : 'opacity-0',
                                        )"
                                    />
                                </CommandItem>
                            </CommandGroup>
                        </CommandList>
                    </Command>
                </PopoverContent>
            </Popover>
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
