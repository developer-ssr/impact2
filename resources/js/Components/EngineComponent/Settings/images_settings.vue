<template>
    <!-- Mouse position is at: {{ x }}, {{ y }} -->
    <devTools
        v-if="vsIns"
        v-show="divEditor"
        @update:Height="
            (height) => {
                _methods.updateHeight(height);
            }
        "
        @update:Width="
            (width) => {
                _methods.updateWidth(width);
            }
        "
        @update:br="
            (br) => {
                _methods.updateBorderSize(br);
            }
        "
        @update:brWidth="
            (brWidth) => {
                _methods.updateBorderWidth(brWidth);
            }
        "
        @update:brColor="
            (brColor) => {
                _methods.updateBorderBGColor(brColor);
            }
        "
        @update:bgColor="
            (bgColor) => {
                _methods.updateBgColor(bgColor);
            }
        "
    />
    <div
        v-show="modalGrid"
        class="container bg-gray-100 fixed translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%] z-50 w-[50vmin] h-[30vmin] rounded-md"
    >
        <div class="float-right pr-3">
            <button @click="close">Close</button>
        </div>
        <div class="p-10">
            <label>Rows</label>
            <input
                type="text"
                class="w-full relative rounded-md"
                v-model="grid_RC.rows"
            />
            <label>Column</label>
            <input
                type="text"
                class="w-full relative rounded-md"
                v-model="grid_RC.column"
            />
            <button
                @click="_methods.setupGrid"
                class="bg-blue-400 mt-5 h-[4vmin] w-[10vmin] rounded-md"
                id="selected_trial"
            >
                Save
            </button>
        </div>
    </div>

    <div class="container mx-auto relative">
        <div
            class="bg-image bg-gray-500 translate-x-[-50%] translate-y-[-50%] fixed top-[50%] left-[50%] h-[50vmin] w-[100vmin] bg-[url('https://mma.prnewswire.com/media/2041559/Perplexity_AI_Logo.jpg?p=facebook')] bg-no-repeat bg-cover bg-center"
        >
            <div v-for="(data, index) in inst_D" :key="index">
                <div
                    :style="{
                        display: 'grid',
                        'grid-template-columns': `repeat(${grid_RC.column}, minmax(0, 1fr))`,
                    }"
                >
                    <div
                        class="cell relative"
                        :class="{ active: cell.active }"
                        v-for="(cell, i) in data.cells"
                        :key="i"
                    >
                        <div class="bg-blue-500 p-5">{{ cell.index }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import devTools from "@/Components/EngineComponent/grid_editor_component/devTools.vue";

import { inject, onMounted, ref, watch, reactive } from "vue";

const props = defineProps(["demo"]);
const instruction_data = inject("Image_Settings");
const inst_D = ref(null);
const vsIns = ref(true);
const JsonData = ref({});
const ObjName = ref(null);
const divEditor = ref(false);
const demoName = ref(null);
const ratio = ref(null);
const draggableElement = ref(null);
const modalGrid = ref(false);

const grid_RC = reactive({
    rows: null,
    column: null,
});
const close = () => {
    modalGrid.value = false;
};
const startDrag = () => {
    const height = window.innerHeight;
    const width = window.innerWidth;
    const onMouseMove = (e) => {
        var xAxis = (e.clientX / width) * 100;
        var yAxis = (e.clientY / height) * 100;

        JsonData.value["Xaxis"] = xAxis + "%";
        JsonData.value["Yaxis"] = yAxis + "%";
    };

    const onMouseUp = () => {
        document.removeEventListener("mousemove", onMouseMove);
        document.removeEventListener("mouseup", onMouseUp);
    };

    document.addEventListener("mousemove", onMouseMove);
    document.addEventListener("mouseup", onMouseUp);
};

const _methods = {
    search: () => {
        divEditor.value = !divEditor.value;

        Object.keys(inst_D.value).forEach((element) => {
            JsonData.value = inst_D.value[element];
            ObjName.value = element;
        });
    },

    updateHeight: (height) => {
        JsonData.value["Hheight"] = height + "%";
    },

    updateWidth: (width) => {
        JsonData.value["Hwidht"] = width + "%";
    },
    updateBgColor: (bgColor) => {
        JsonData.value["bgColor"] = bgColor;
    },
    updateBorderSize: (br) => {
        JsonData.value["borderRadius"] = br + "px";
    },
    updateBorderWidth: (brWidth) => {
        JsonData.value["borderWidth"] = brWidth + "px";
    },

    updateBorderBGColor: (brColor) => {
        JsonData.value["borderColor"] = brColor;
    },
    getContent: () => {
        JsonData.value["content"] = draggableElement.value[0].innerHTML;
        console.log(instruction_data);
    },
    setupGrid: () => {
        Object.keys(inst_D.value).forEach((items) => {
            // var obj = {};
            // obj = inst_D.value[items];
            // console.log(obj);
            let q = inst_D.value[items];

            let cells = [];
            let l = parseInt(grid_RC.column) * parseInt(grid_RC.rows);
            for (let x = 1; x <= l; x++) {
                let cell = {
                    index: x,

                    active: false,
                    ladybug: false,
                };
                cells.push(cell);
            }
            Object.assign(q, { cells: cells });
            console.log(q);
        });

        //console.log(grid_RC);
    },
};

watch(
    props,
    (newDemo, oldDemo) => {
        demoName.value = newDemo.demo;

        inst_D.value = instruction_data[newDemo.demo];
    },
    { immediate: true }
);
function pxToVmin(px) {
    const vmin = Math.min(window.innerWidth, window.innerHeight) / 100;
    return px / vmin;
}

// Usage

onMounted(() => {
    document
        .querySelector("#selected_trial")
        .addEventListener("show_grid_modal", () => {
            modalGrid.value = !modalGrid.value;
        });

    window.onload = function () {
        const img = document.getElementById("myImage");

        // const width = pxToVmin(img.naturalWidth);
        // const height = pxToVmin(img.naturalHeight);
        // ratio.value = width / height;
    };

    if (demoName.value == null) {
        demoName.value = "practiceTrial";
        inst_D.value = instruction_data[demoName.value];
    }
});
</script>
<style scoped>
.drag {
    cursor: pointer;
}

.grid-container {
    z-index: 90;
    display: grid;
    width: 95vh;
    background-color: transparent;
    aspect-ratio: var(--imageRatio, 1.5);
}

.grid-container > .grid-item {
    text-align: center;
    font-size: 2vmin;
    display: grid;
    color: white;
}
.cell {
    cursor: pointer;
    /* background: rgb(255, 255, 255); */
    background: rgba(255, 255, 255, 0.2);
}
</style>
