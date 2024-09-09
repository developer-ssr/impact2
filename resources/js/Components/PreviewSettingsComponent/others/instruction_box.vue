<template>
    <div
        v-if="insCon"
        class="bodyBoxCon fixed z-20 translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%] shadow-2xl border-gray-400"
    >
        <div
            class="bg-white h-[50vmin] w-[100vmin] shadow-lg p-5"
            v-html="props.instruction"
        ></div>
        <div
            class="bg-white h-[10vmin] w-[100vmin] shadow-lg p-5 flex items-center justify-center"
        >
            <button
                id="selected_trial"
                class="bg-orange-500 p-4 rounded-lg w-40 text-white text-[2vmin]"
            >
                Start
            </button>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, inject } from "vue";
const props = inject("status");

onMounted(() => {});
</script>
