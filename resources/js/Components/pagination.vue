<script setup>
import { provide, inject, ref, onMounted, watchEffect } from "vue";
const textPage = ref(null);
const props = inject("props");
const page = props.props.data.links;

page.forEach((element) => {
    element.label == "&laquo; Previous";
    if (element.label == "&laquo; Previous") {
        element.label = "Previous";
    } else if (element.label == "Next &raquo;") {
        element.label = "Next";
    }
});
</script>

<template>
    <div class="fixed bottom-0 left-[50%] z-50 translate-x-[-50%]">
        <div class="flex justify-center">
            <div class="flex items-center justify-between border-t">
                <div
                    class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                >
                    <div></div>
                    <div>
                        <nav
                            class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                            aria-label="Pagination"
                        >
                            <div
                                v-for="(data, index) in props.props.data.links"
                                :key="index"
                            >
                                <a
                                    :href="data.url"
                                    :class="{ active: true }"
                                    ref="textPage"
                                    class="relative z-10 inline-flex items-center bg-gray-900 p-1 border-2 rounded-md text-white border-gray-300"
                                    >{{ data.label }}
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
