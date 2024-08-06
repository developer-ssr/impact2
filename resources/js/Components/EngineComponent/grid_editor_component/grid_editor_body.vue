<template>
    <input type="range" v-model="header.Hheight" />
    <div class="bg-gray-700 h-[8vmin] relative">
        <div
            class="headerStyling h-[8vmin] relative"
            :style="{
                '--BgColor': header.bgColor,
                '--Hheight': header.Hheight,
                '--Hwidht': header.Hwidht,
            }"
        >
            {{ header.content }}
        </div>
    </div>
    <div class="bg-gray-500 relative h-[70vmin]">editor body</div>
    <div class="bg-gray-400 h-[10%] relative">Footer</div>
</template>
<script setup>
import { inject, reactive } from "vue";

const props = inject("testData");
const header = reactive({
    content: props.grid.header.content,
    bgColor: props.grid.header.bgColor,
    textColor: props.grid.header.textColor,
    Xaxis: props.grid.header.Xaxis,
    Yaxis: props.grid.header.Yaxis,
    Hheight: props.grid.header.Hheight,
    Hwidht: props.grid.header.Hwidht,
});
console.log(header);
</script>
<style scoped>
.headerStyling {
    background-color: var(--BgColor);
    height: v-bind("header.Hheight");
    width: var(--Hwidht);
}
</style>
