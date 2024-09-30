<template>
    <div class="relative">
        <div
            class="w-full h-full grid grid-cols-2 grid-flow-col mt-[20vmin] gap-4"
        >
            <!-- Implicit Section -->
            <div
                class="bg-white border-2 border-gray-500 relative aspect-ratio-box"
            >
                <h2 class="text-center font-bold text-lg">Implicit</h2>
                <img
                    class="object-cover"
                    :src="props.imagesrc"
                    :style="{
                        position: 'absolute',
                        top: 0,
                        left: 0,
                        width: '100%',
                        height: '100%',
                        zIndex: 1,
                    }"
                />
                <div
                    :style="{
                        display: 'grid',
                        gridTemplateColumns: `repeat(${props.rows}, minmax(0, 1fr))`,
                        position: 'absolute',
                        top: 0,
                        left: 0,
                        width: '100%',
                        height: '100%',
                        zIndex: 2,
                    }"
                >
                    <div v-for="(cell, i) in props.implicit_data" :key="i">
                        {{ cell.rt_sum }}
                        <!-- <div
                            v-bind:class="{
                                'bg-red-500':
                                    cell.rt_sum ===
                                    props.rt_values_implicit.lowest,
                                'bg-blue-500':
                                    cell.rt_sum ===
                                    props.rt_values_implicit.highest,
                                'bg-gray-200':
                                    cell.rt_sum ===
                                    props.rt_values_implicit.median,
                            }"
                        >
                            {{ cell.rt_sum }}
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Explicit Section -->

            <div
                class="bg-white border-2 border-gray-500 relative aspect-ratio-box"
            >
                <img
                    class="object-cover"
                    :src="props.imagesrc"
                    :style="{
                        position: 'absolute',
                        top: 0,
                        left: 0,
                        width: '100%',
                        height: '100%',
                        zIndex: 1,
                    }"
                />
                <div
                    :style="{
                        display: 'grid',
                        gridTemplateColumns: `repeat(${props.rows}, minmax(0, 1fr))`,
                        position: 'absolute',
                        top: 0,
                        left: 0,
                        width: '100%',
                        height: '100%',
                        zIndex: 2,
                    }"
                >
                    <div v-for="(cell, i) in props.explicit_data" :key="i">
                        {{ cell.rt_sum }}
                        <div
                            v-if="
                                cell.rt_sum > props.rt_values_explicit.lowest &&
                                cell.rt_sum < props.rt_values_explicit.median
                            "
                            class="bg-red-500"
                        >
                            {{ cell.rt_sum }}
                        </div>

                        <div
                            class="bg-blue-500"
                            v-else-if="
                                cell.rt_sum > props.rt_values_explicit.median &&
                                cell.rt_sum < props.rt_values_explicit.highest
                            "
                        >
                            {{ cell.rt_sum }}
                        </div>

                        <div
                            class="bg-blue-500"
                            v-else-if="
                                cell.rt_sum == props.rt_values_explicit.median
                            "
                        >
                            {{ cell.rt_sum }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.aspect-ratio-box {
    aspect-ratio: 16 / 9; /* Change this to your desired aspect ratio */
    position: relative; /* Ensure positioning for absolute children */
}
.object-cover {
    object-fit: cover; /* Ensures the image covers the box without distortion */
}
.text-center {
    text-align: center; /* Center the text */
}
.font-bold {
    font-weight: bold; /* Bold text */
}
.text-lg {
    font-size: 1.125rem; /* Adjust font size as needed */
}
</style>

<script setup>
import { defineProps } from "vue";
const props = defineProps([
    "implicit_data",
    "rt_values_implicit",
    "explicit_data",
    "rt_values_explicit",
    "rows",
    "imagesrc",
    "image_ratio",
]);

console.log(props);
</script>
