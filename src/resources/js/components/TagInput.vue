<template>
    <vue3-tags-input v-model:tags="tags"
                     v-model="tag"
                     :select="true"
                     :select-items="categories"
                     @on-select="handleSelectedTag"
                     @on-tags-changed="handleChangeTag"
                     placeholder="Select the tag"
                     class="text-black"
    >
        <template #item="{ tag, index }">
            {{ tag.name }}
        </template>
        <template #no-data>
            No Data
        </template>
        <template #select-item="tag">
            {{ tag.name }}
        </template>
    </vue3-tags-input>
</template>

<script>
import {defineComponent, ref} from 'vue';
import Vue3TagsInput from 'vue3-tags-input';

export default defineComponent ({
    name: 'SlotTemplate',

    props: {
        categories: Array,
    },

    setup(props) {
        const categoryList = ref(props.categories);
    },

    components: {
        Vue3TagsInput
    },

    data() {
        return {
            tags: [],
            tag: '',
        }
    },
    methods: {
        handleSelectedTag(tag) {
            this.tags.push(tag);
        },
        handleChangeTag(tags) {
            this.tags = tags;
        },
    }
})
</script>
