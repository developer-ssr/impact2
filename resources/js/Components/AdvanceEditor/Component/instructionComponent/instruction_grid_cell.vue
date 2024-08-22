<template>
    <main class="p-4 flex grow-[1] items-center justify-center">
        <div class="main-container relative">
            <div
                class="grid-container relative"
                :style="{
                    '--imageRatio': imageRatio,
                }"
            >
                <div
                    v-for="(data, index) in props.data.quadrants"
                    class="quadrants grid gap-1"
                    :style="{
                        'grid-template-columns':
                            'repeat(' + data.column + ',1fr)',
                    }"
                    :key="index"
                    :char="data.keys"
                >
                    <div
                        class="cell relative"
                        :class="{ active: cell.active }"
                        v-for="(cell, i) in data.cells"
                        :key="i"
                        @click="
                            detectCells({
                                keys: cell.keys,
                                index: index,
                                cell: cell,
                            })
                        "
                    >
                        {{ cell.keys }}
                        <small
                            v-show="cell.active"
                            class="ladybug text-sm absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"
                            ><img :src="img"
                        /></small>
                    </div>
                    
                </div>
            </div>
            <div
                class="img-container absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] w-[100%] h-[100%] z-9"
            >
                <img :src="images" />
            </div>
        </div>
    </main>

    <div class="dFooter"></div>
</template>
<script setup>
import { defineEmits, ref } from "vue";
import img from "@/Pages/Ladybugs/ld.png";

const props = defineProps(["data"]);
const demoPart = ref({});
const imageRatio = ref("null");
const $Emits = defineEmits(["edit:detectCells"]);
const images = ref("null");

const detectCells = (obj) => {
    $Emits("edit:detectCells", obj);
};

if (props.data["DemoPart"] == "practice") {
    demoPart.value = props.data;
    imageRatio.value = props.data.target.imageRatio;
    images.value = props.data.target.img;
} else if (props.data["DemoPart"] == "main") {
    demoPart.value = props.data;
    imageRatio.value = props.data.target.imageRatio;
    images.value = props.data.target.img;
}
</script>
<style scoped>
.img-container > img {
    background-color: rgb(255, 255, 255);
}

.grid-container {
    z-index: 90;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5vmin;
    width: 90vh;
    aspect-ratio: var(--imageRatio, 1.8);
    background-color: transparent;
}
.grid-container > .quadrants {
    text-align: center;
    font-size: 2vmin;
    display: grid;
}
.trials {
    position: fixed;
    z-index: 2;
    height: calc(78vh - 11rem);
    width: 100vmin;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: red;
}
.grid-container > .quadrants {
    text-align: center;
    font-size: 2vmin;
    display: grid;
}

.ladybug > img {
    position: relative;
    height: 3vmin;
    width: 3vmin;
}

.quadrants > .boxsizing {
    background-color: rgb(213, 212, 201);
}

.cell {
    cursor: pointer;
    /* background: rgb(255, 255, 255); */
    background: rgba(255, 255, 255, 0.2);
}
.cell.active {
    color: rgb(246, 245, 245);
    /* background: rgb(136, 138, 87); */
    background: rgba(136, 138, 87, 0.8);
}

.editorDiv {
    cursor: pointer;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    position: absolute;
    background-color: azure;
    height: 25vmin;
    width: 40vmin;
    z-index: 1;
    border-radius: 10px;
}

.editorDiv > .closingX {
    float: right;
    background-color: cornflowerblue;
    height: 4vmin;
    width: 4vmin;
}
</style>
