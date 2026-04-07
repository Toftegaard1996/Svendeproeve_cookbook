<script setup lang="ts">
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { ref, watch } from 'vue';

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
        <Select v-model="tag">
            <SelectTrigger>
                <SelectValue placeholder="Vælg en kategori"/>
            </SelectTrigger>
            <SelectContent>
                <SelectItem v-for="item in items" :key="item.id" :value="item.id">
                    {{ item.name }}
                </SelectItem>
            </SelectContent>
        </Select>
        <div class="mt-1">
            <div v-for="item in model" @click="removeItem(item)">{{ idToName(item) }}</div>
        </div>
    </div>
</template>
