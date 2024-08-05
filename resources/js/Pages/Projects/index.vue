<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Sidebar from "@/Components/Sidebar.vue";
import { provide } from "vue";
const props = defineProps(["menu", "data"]);
provide("props", { props });
</script>

<template>
    <AppLayout :title="props.menu.title">
        <div class="py-[4rem]">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <button type="button" class="inline-flex items-center px-3 py-2 absolute top-[5rem] right-12 h-10 w-[10rem] justify-right text-sm font-medium text-center text-white bg-orange-600 rounded-lg hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Add Projects <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" class="w-7 ml-6" viewBox="0 0 512 243.58"><path fill-rule="nonzero" fill="white" d="M373.57 0 512 120.75 371.53 243.58l-20.92-23.91 94.93-83L0 137.09v-31.75l445.55-.41-92.89-81.02z"/></svg></button>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Sidebar />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
