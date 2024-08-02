<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Grid_Editor from "@/Components/EngineComponent/grid_editor.vue";
import { provide } from "vue";
const props = defineProps(["menu", "data"]);
provide("props", { props });
</script>

<template>
    <AppLayout :title="title">
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Grid_Editor />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
