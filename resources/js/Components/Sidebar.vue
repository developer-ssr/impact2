<script setup>
import Content from "@/Components/content.vue";

import { onMounted } from "vue";
import { provide, inject } from "vue";
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

// initialize components based on data attribute selectors
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
</script>

<style scoped>
.containerSidebar {
    height: 200vmin;
    width: 400px;
    background-color: gray;
    position: fixed;
    z-index: 9;
    left: 0px;
    transform: translateX(0%);
    padding-left: 6rem;
    padding-top: 64px;
    top: 0px;
}
</style>
<template>
    <div class="bg-gray-200 flex absolute w-full h-full">
        <!-- Sidebar -->
        <div class="bg-gray-900 text-gray-100 w-[20vmin]">
            <ul class="space-y-2 font-medium">
                <li>
                    <a
                        :href="props.props.menu.folderlink"
                        class="flex items-center p-2 text-gray-100 dark:text-white hover:bg-gray-500 dark:hover:bg-gray-900 group"
                    >
                        <span class="flex-1 ms-3 whitespace-nowrap">{{
                            props.props.menu.folder
                        }}</span>
                    </a>
                </li>

                <li>
                    <a
                        class="flex items-center p-2 text-gray-100 dark:text-white hover:bg-gray-500 dark:hover:bg-gray-900 group"
                    >
                        <span class="flex-1 ms-3 whitespace-nowrap">{{
                            props.props.menu.title
                        }}</span>
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="flex items-center p-2 text-gray-100 dark:text-white hover:bg-gray-500 dark:hover:bg-gray-900 group"
                        type="button"
                        data-drawer-target="drawer-right-example"
                        data-drawer-show="drawer-right-example"
                        data-drawer-placement="right"
                        aria-controls="drawer-right-example"
                    >
                        <span class="flex-1 ms-3 whitespace-nowrap">{{
                            props.props.menu.add
                        }}</span>
                    </a>
                </li>
            </ul>
        </div>

        
            <Content />
      
    </div>
</template>
