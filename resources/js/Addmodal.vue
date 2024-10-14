<script setup>
import { defineProps, ref } from "vue";
</script>
<template>
    <Teleport to="body">
        <div
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div
                class="m-4 w-full max-w-md scale-95 transform rounded-lg border border-gray-300 bg-white shadow-lg transition-transform duration-300 ease-in-out hover:scale-100"
            >
                <header>
                    <div
                        class="rounded-t-lg bg-blue-600 p-4 text-white shadow-md"
                    >
                        <h2 class="text-xl font-semibold">
                            <slot name="header"></slot>
                        </h2>
                    </div>
                </header>
                <div class="p-6">
                    <!-- <header>
                    <p class="mb-4 text-gray-700">
                        <slot name="header"></slot>
                    </p>
                </header> -->

                    <slot name="main"></slot>
                </div>
                <div
                    class="flex justify-end rounded-b-lg bg-gray-100 p-4 shadow-md"
                >
                    <footer>
                        <slot name="footer"></slot>
                        <!-- <button
                    class="rounded bg-blue-500 px-4 py-2 text-white transition duration-200 hover:bg-blue-600"
                >
                    Cancel
                </button>
                <button
                    class="ml-2 rounded bg-green-500 px-4 py-2 text-white transition duration-200 hover:bg-green-600"
                >
                    Add
                </button> -->
                    </footer>
                </div>
            </div>
        </div>
    </Teleport>
</template>
