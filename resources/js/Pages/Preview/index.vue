<script setup>
import { ref, onMounted, reactive } from "vue";
import img from "@/Pages/Ladybugs/ld.png";

const props = defineProps(["previewData", "demoPart"]);

const start = ref(null);
const SelectedGrid = ref(null);
const newGrid = ref(null);
const buttonIns = ref(null);

const main_instruction_grid = ref(
    props.previewData.settings.instruction.main_instruction
);

const practice_instruction_grid = ref(
    props.previewData.settings.instruction.practice_instruction
);

const SchedCollection = ref([]);

const shuffleActiveObject = (array) => {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
};

const filterActiveValues = () => {
    Object.keys(SelectedGrid.value["quadrants"]).forEach((qd) => {
        let q = SelectedGrid.value["quadrants"];
        let activeCells = q[qd]["cells"].filter((obj) => obj.active === true);
        SchedCollection.value = SchedCollection.value.concat(activeCells);
    });
    SchedCollection.value = shuffleActiveObject(SchedCollection.value);
};

const display_grid = ref(false);
const display_instructions = ref(true);
const current = ref({ index: 0 });
const tempData = ref([]);
const imageRatio = ref(null);
const images = ref(null);
const instruction = ref(null);
const display_image = ref(false);
const warnings = ref(null);
const redirect = ref(null);
const warningsRef = ref(null);
const redirectRef = ref(null);

const btnStyle = reactive({
    BGcolor: null,
    Fontcolor: null,
});

const flow = {
    startGame: () => {
        if (display_instructions.value == true) {
            display_grid.value = true;
            display_image.value = true;
            setTimeout(() => {
                display_image.value = false;
                filterActiveValues();
                flow.next();
            }, 1000);
            display_instructions.value = false;
        }
    },

    next: () => {
        let targetIndex = SchedCollection.value[current.value.index];
        var host = window.location.href;
        var mainHost = host.replace("practice", "main");

        if (typeof targetIndex == "undefined") {
            if (props.demoPart == "practice") {
                display_grid.value = false;
                redirectRef.value = true;
                window.location.assign(mainHost);
            } else {
                console.log(tempData.value);
                redirectRef.value = true;
                display_grid.value = false;
            }

            return;
        }
        flow.getTrialData(targetIndex);
    },

    getTrialData: (targetIndex) => {
        let quadrant =
            SelectedGrid.value.quadrants["quadrant" + targetIndex.quadrant];
        let trial = quadrant.cells[targetIndex.index - 1];

        Object.assign(trial, { show: true, rt: null });
        start.value = performance.now();

        const process = (res) => {
            if (res == quadrant.keys.toLowerCase()) {
                display_image.value = true;

                setTimeout(() => {
                    display_image.value = false;
                }, 1000);

                const end = performance.now();
                trial.show = false;
                trial.rt = end - start.value;

                current.value.index += 1;

                tempData.value.push(trial);
                flow.next();
            } else {
                keys(process);

                display_grid.value = false;
                warningsRef.value = true;

                setTimeout(() => {
                    if (redirect.value == true) {
                        display_grid.value = false;
                    } else {
                        display_grid.value = true;
                        warningsRef.value = false;
                    }
                }, 1000);
            }
        };
        keys(process);
    },
};

const keys = (callback) => {
    const fn = (event) => {
        window.removeEventListener("keypress", fn);
        callback(event.key.toLowerCase());
    };
    window.addEventListener("keypress", fn);
};

onMounted(() => {
    if (props.demoPart == "practice") {
        SelectedGrid.value = practice_instruction_grid.value;
        newGrid.value = SelectedGrid.value.quadrants;

        imageRatio.value = SelectedGrid.value.target.imageRatio;
        images.value = SelectedGrid.value.target.img;

        instruction.value = SelectedGrid.value.message;
        buttonIns.value = SelectedGrid.value.button;

        btnStyle.BGcolor = SelectedGrid.value.style["--componentBG"];
        btnStyle.Fontcolor = SelectedGrid.value.style["--componentFontColor"];

        warnings.value = SelectedGrid.value["warnings"];
        redirect.value = SelectedGrid.value["redirect"];
    } else if (props.demoPart == "main") {
        SelectedGrid.value = main_instruction_grid.value;
        newGrid.value = SelectedGrid.value.quadrants;

        imageRatio.value = SelectedGrid.value.target.imageRatio;
        images.value = SelectedGrid.value.target.img;

        instruction.value = SelectedGrid.value.message;
        buttonIns.value = SelectedGrid.value.button;

        btnStyle.BGcolor = SelectedGrid.value.style["--componentBG"];
        btnStyle.Fontcolor = SelectedGrid.value.style["--componentFontColor"];
        warnings.value = SelectedGrid.value["warnings"];
        redirect.value = SelectedGrid.value["redirect"];
    }
});
</script>

<style>
font[size="1"] {
    font-size: 1vmin;
}
font[size="2"] {
    font-size: 2vmin;
}

font[size="3"] {
    font-size: 3vmin;
}
font[size="4"] {
    font-size: 4vmin;
}
font[size="5"] {
    font-size: 5vmin;
}

.btnInstruction {
    background-color: var(--componentBG);
    color: var(--componentFontColor);
    z-index: 209;
    height: 5vmin;
    width: 10vmin;
    border-radius: 48px 48px 48px 48px;
    -webkit-border-radius: 48px 48px 48px 48px;
    -moz-border-radius: 48px 48px 48px 48px;
}
.ins-container {
    z-index: 30;
    background-color: rgb(255, 255, 255);
    box-shadow: 1px 0px 13px 3px rgba(0, 0, 0, 0.39);
    -webkit-box-shadow: 1px 0px 13px 3px rgba(0, 0, 0, 0.39);
    -moz-box-shadow: 1px 0px 13px 3px rgba(0, 0, 0, 0.39);
}
.img-container {
    z-index: 2;
    background-color: rgb(255, 255, 255);
}

.grid-container {
    z-index: 10;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5vmin;
    width: 90vh;
    aspect-ratio: var(--imageRatio);
    background-color: transparent;
}
.grid-container > .quadrants {
    text-align: center;
    font-size: 2vmin;
    display: grid;
    box-shadow: 0px 1px 4px 1px rgba(0, 0, 0, 0.42);
    -webkit-box-shadow: 0px 1px 4px 1px rgba(0, 0, 0, 0.42);
    -moz-box-shadow: 0px 1px 4px 1px rgba(0, 0, 0, 0.42);

    border-radius: 10px 10px 10px 11px;
    -webkit-border-radius: 10px 10px 10px 11px;
    -moz-border-radius: 10px 10px 10px 11px;
    border: 2px solid #050505;
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
    /* background: rgba(255, 255, 255, 0.2); */
    color: transparent;
    background: transparent;
}
.cell.active {
    color: transparent;
    background: transparent;
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

.editorDiv > .cellComs {
    position: relative;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
    background-color: cornflowerblue;
    padding: 1vmin;
}

.editorDiv > .closingX {
    float: right;
    background-color: cornflowerblue;
    height: 4vmin;
    width: 4vmin;
}
.warning-message {
    background-color: rgb(251, 34, 14);
    height: 10%;
    width: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    position: fixed;
    z-index: 500;
    box-shadow: 2px 7px 5px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 2px 7px 5px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 2px 7px 5px -3px rgba(0, 0, 0, 0.3);
    border-radius: 31px 31px 31px 31px;
    -webkit-border-radius: 31px 31px 31px 31px;
    -moz-border-radius: 31px 31px 31px 31px;
    border: 7px solid #f0dfd8;
    color: white;
}
.end-message {
    background-color: rgb(8, 171, 236);
    height: 10%;
    width: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    position: fixed;
    z-index: 500;
    box-shadow: 2px 7px 5px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 2px 7px 5px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 2px 7px 5px -3px rgba(0, 0, 0, 0.3);
    border-radius: 31px 31px 31px 31px;
    -webkit-border-radius: 31px 31px 31px 31px;
    -moz-border-radius: 31px 31px 31px 31px;
    border: 7px solid #f0dfd8;
    color: white;
}
</style>

<template>
    <Teleport to="body">
        <div
            v-if="warningsRef"
            class="warning-message relative"
            v-html="warnings"
        ></div>

        <div
            v-if="redirectRef"
            class="end-message relative"
            v-html="redirect"
        ></div>
    </Teleport>
    <div class="flex">
        <!-- Main content -->
        <div class="flex-1 grow-[1] flex flex-col w-[100vw] h-[100vh]">
            <header
                class="flex items-center w-[100vw] justify-center p-4 bg-white shadow-md"
            >
                <h4>Impact V2</h4>
            </header>

            <main class="p-4 flex grow-[1] items-center justify-center">
                <div class="main-container relative">
                    <div
                        v-if="display_grid"
                        class="grid-container relative"
                        :style="{
                            '--imageRatio': imageRatio,
                        }"
                    >
                        <div
                            v-for="(data, index) in newGrid"
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
                                :class="{ active: cell.show }"
                                v-for="(cell, i) in data.cells"
                                :key="i"
                            >
                                {{ cell.keys }}
                                <small
                                    v-show="cell.show"
                                    class="ladybug text-sm absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"
                                >
                                    <img :src="img" />
                                </small>
                            </div>
                        </div>

                        <div
                            v-if="display_image"
                            class="image-container absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] w-[100%] h-[100%] z-9"
                        >
                            <img :src="images" />
                        </div>
                    </div>

                    <div
                        v-if="display_instructions"
                        class="grid-container relative"
                        :style="{
                            '--imageRatio': imageRatio,
                        }"
                    >
                        <div
                            class="ins-container absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] w-[100%] h-[100%] z-9"
                            v-html="instruction"
                        ></div>

                        <button
                            @click="flow.startGame"
                            class="btnInstruction absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] w-[10%] z-9"
                            :style="{
                                '--componentBG': btnStyle.BGcolor,
                                '--componentFontColor': btnStyle.Fontcolor,
                            }"
                            v-html="buttonIns"
                        ></button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
