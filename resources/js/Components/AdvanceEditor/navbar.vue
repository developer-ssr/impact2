<script setup>
import { defineEmits, ref, inject, onMounted } from "vue";
const code = inject("code");
const props = defineProps(["demo"]);
const $Emits = defineEmits(["save:SaveSettings", "load:demoPart"]);

const _method = {
    Save_Settings: () => {
        $Emits("save:SaveSettings");
    },
    PreviewDemo: () => {
        // console.log(props.demo);
        console.log(code.value);
        window.location.href =
            "preview_index?code=" + code.value + "&demo=" + props.demo;
        //    :href="'preview_index?code=' + code"
    },
};
</script>

<template>
    <nav
        class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Breadcrumb"
    >
        <ol
            class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
        >
            <li class="inline-flex items-center">
                <button
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                    type="button"
                    data-drawer-target="drawer-navigation"
                    data-drawer-show="drawer-navigation"
                    aria-controls="drawer-navigation"
                >
                    <svg
                        class="w-6 h-6 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14"
                        />
                    </svg>
                </button>
            </li>
            <li class="inline-flex items-center">
                <button
                    @click="_method.PreviewDemo"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white float-right"
                >
                    Preview
                </button>
            </li>

            <li class="inline-flex items-center">
                <button
                    @click="_method.Save_Settings"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white float-right"
                >
                    Save
                </button>
            </li>
        </ol>
    </nav>
</template>
