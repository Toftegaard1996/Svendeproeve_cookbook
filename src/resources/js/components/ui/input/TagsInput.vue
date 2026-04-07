<script setup lang="ts">
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { ref, watch } from 'vue';
import { X } from 'lucide-vue-next';

const props = defineProps<{
    items: Array
}>()

const model = defineModel({
    default: []
})

const tag = ref('')

watch(tag, (value) => {
    if (value !== '') {
        model.value.push(value)
        tag.value = ''
    }
})

const idToName = (id) => {
    return props.items.find(i => i.id === id)?.name
}

const removeItem = (id) => {
    model.value = model.value.filter(i => i !== id)
}

</script>

<template>
    <div>
        <Select v-model="tag" class="hover:cursor-pointer">
            <SelectTrigger>
                <SelectValue placeholder="Vælg en til flere fra listen"/>
            </SelectTrigger>
            <SelectContent>
                <SelectItem v-for="item in items" :key="item.id" :value="item.id">
                    {{ item.name }}
                </SelectItem>
            </SelectContent>
        </Select>
        <div class="mt-1">
            <div v-for="item in model" @click="removeItem(item)" class="border border-black p-1 rounded mb-1 flex flex-row items-center size-fit">
                <div class="hover:cursor-pointer">{{ idToName(item) }}</div>
                <X class="h-4 ml-2 hover:cursor-pointer"/>
            </div>
        </div>
    </div>
</template>
