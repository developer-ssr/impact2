<script setup>
import { onMounted, ref, inject, provide } from "vue";
import Drawer from "@/Components/Drawer.vue";
import Cards from "@/Components/ProjectsComponent/card.vue";
import TestsCardsComponent from "@/Components/TestsComponent/card.vue";
import moment from "moment";
import Pagination from "@/Components/pagination.vue";
import {
    initAccordions,
    initCarousels,
    initCollapses,
    initDials,
    initDismisses,
    initDrawers,
    initDropdowns,
    initModals,
    initPopovers,
    initTabs,
    initTooltips,
} from "flowbite";
const props = inject("props");

const TestsCards = ref(false);
const ProjectCards = ref(false);

onMounted(() => {
    initAccordions();
    initCarousels();
    initCollapses();
    initDials();
    initDismisses();
    initDrawers();
    initDropdowns();
    initModals();
    initPopovers();
    initTabs();
    initTooltips();

    if (props.props.menu.title == "Projects") {
        TestsCards.value = false;
        ProjectCards.value = true;
    } else if (props.props.menu.title == "Tests") {
        TestsCards.value = true;
        ProjectCards.value = false;
    }
});
</script>

<template>
    <Drawer />

    <div v-show="ProjectCards">
        <Cards />
    </div>

    <div v-show="TestsCards">
        <TestsCardsComponent />
    </div>
    
    <Pagination />
</template>
