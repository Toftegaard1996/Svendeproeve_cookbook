<script setup lang="ts">
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { TriangleAlert } from "lucide-vue-next";

defineProps<{
    open: boolean,
    title: String
}>()

</script>
<template>
    <div>
        <TransitionRoot as="template" :show="open">
            <Dialog class="relative z-10" @click="$emit('close', true)">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="" leave="ease-in duration-200" leave-from="" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-900/50 transition-opacity"></div>
                </TransitionChild>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to=" translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from=" translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl outline -outline-offset-1 outline-white/10 transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-500/10 sm:mx-0 sm:size-10">
                                            <TriangleAlert class="size-6 text-red-400" aria-hidden="true" />
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <DialogTitle as="h3" class="text-base font-semibold text-white">{{title}}</DialogTitle>
                                            <div class="mt-2 text-sm text-gray-400">
                                                <slot name="description"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                    <button @click="$emit('close', true)" type="button" class="my-3 inline-flex w-full justify-center rounded-md bg-white/10 px-3 py-2 text-sm sm:ml-3 font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 sm:my-0 sm:w-auto" ref="cancelButtonRef">Cancel</button>
                                    <slot name="action"/>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>
