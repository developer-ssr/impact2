<script setup>
import { computed, reactive, onMounted, ref, provide } from "vue";
import Editor from "@/Components/AdvanceEditor/index.vue";
import {
    router,
    Head,
    Link,
    useForm,
    usePage,
    useRemember,
} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import navbar from "@/Components/AdvanceEditor/navbar.vue";
import Index from "@/Components/Editor/index.vue";
const IsdrawerVisible = ref(false);
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
});

const props = defineProps(["test", "code"]);

const test = ref(props.test);
const code = ref(props.code);
provide("test", test);
provide("code", code);


onMounted(() => {
    // _method.resizeCont();
});
</script>

<template>
    <AppLayout>
        <!-- <Index /> -->
        <Editor />
    </AppLayout>
</template>
