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
            <Grid_Editor />
        </div>
    </AppLayout>
</template>
