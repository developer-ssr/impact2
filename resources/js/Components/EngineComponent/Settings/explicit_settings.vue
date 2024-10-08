<template>
    <!-- Mouse position is at: {{ x }}, {{ y }} -->
    <Teleport to="body">
        <devTools
            class="z-50"
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
    </Teleport>

    <!-- this part should be a component -->
    <div
        v-show="modalGrid"
        class="drag container bg-gray-100 fixed translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%] z-50 w-[50vmin] h-[30vmin] rounded-md shadow-xl"
    >
        <div class="bg-gray-900 h-12">
            <button
                @click="close"
                class="float-right bg-gray-300 p-2 rounded-sm m-1"
            >
                Close
            </button>
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

    <!-- this part should be a component / -->
    <!-- this part should be a component -->
    <div
        v-if="imageSetVisible"
        class="fixed z-50 bg-gray-dark translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%] h-[50vmin] w-[100vmin] rounded-lg shadow-xl"
    >
        <div class="bg-white h-[5vmin]">
            <button
                @click="_methods.closeImageSet"
                class="float-right bg-gray-300 p-3 rounded-lg"
            >
                Close
            </button>
        </div>

        <div
            class="bg-gray-100 m-5 h-[40vmin] rounded-lg relative object-scale-down"
        >
            <input
                type="file"
                id="upload"
                accept="image/*"
                @change="handleImageUpload"
            />

            <img :src="imageURL" class="object-fill h-[35vmin] p-5 w-full" />
        </div>
    </div>

    <!-- this part should be a component / -->
    <div class="container mx-auto relative">
        <div v-for="(data, index) in inst_D" :key="index">
            <img
                class="bg-gray-500 fixed top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2"
                @click="_methods.search"
                :src="data.imagesrc"
                :style="{
                    'aspect-ratio': data.image_ratio,
                    width: data.Hwidht,
              
                }"
            />

            <div
                @click="_methods.search"
                :style="{
                    width: data.Hwidht,
                 
                    'aspect-ratio': data.image_ratio,
                    fontSize: '1vmin',
                    display: 'grid',
                    gridTemplateColumns: `repeat(${data.column}, minmax(0, 1fr))`,
                }"
                class="fixed top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2"
            >
                <div
                    class="cell"
                    :class="{ active: cell.active }"
                    v-for="(cell, i) in data.cells"
                    :key="i"
                    @click="
                        _methods.detectCells({
                            keys: cell.keys,
                            index: i,
                            cell: cell,
                        })
                    "
                >
                    <div
                        :class="{ active: cell.active }"
                        class="bg-transparent text-center"
                    >
                        {{ cell.index }}
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
const imageSetVisible = ref(false);
const img = new Image();
const draggableElement = ref(null);
const modalGrid = ref(false);
const imageURL = ref(null);
const ratio = ref(null);
//const imgVisible = ref(false);
const grid_RC = reactive({
    rows: null,
    column: null,
});
const close = () => {
    modalGrid.value = false;
};

const handleImageUpload = (event) => {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = async (e) => {
            var formData = new FormData();
            formData.append("image", file);
            const res = await axios.post("/upload_images", formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            });

            // Get the image ratio
            const img = new Image();
            img.src = e.target.result;
            imageURL.value = res.data;
            if (imageURL.value) {
                JsonData.value["imagesrc"] = imageURL.value;
                JsonData.value["image_ratio"] = img.width / img.height;
                //imgVisible.value = !imgVisible.value;
            }

            img.onload = () => {
                ratio.value = img.width / img.height;
                JsonData.value["image_ratio"] = img.width / img.height;
                //console.log(JsonData.value["image_ratio"]);
                //console.log(`Image ratio: ${ratio.value}`);
            };
        };

        reader.readAsDataURL(file);
    }
};
const _methods = {
    search: () => {
        divEditor.value = true;

        Object.keys(inst_D.value).forEach((element) => {
            JsonData.value = inst_D.value[element];
            ObjName.value = element;
            //console.log(JsonData.value);
        });
    },
    detectCells: (obj) => {
        // console.log(obj);
        obj.cell.active = !obj.cell.active;
        obj.ladybug = !obj.ladybug;
        // console.log(obj.index);
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
        //console.log(instruction_data);
    },
    closeImageSet: () => {
        imageSetVisible.value = false;
    },
    setupGrid: () => {
        Object.keys(inst_D.value).forEach((items) => {
            let q = inst_D.value[items];
            let cellid = 1;
            let cells = [];
            for (let i = 0; i < grid_RC.rows; i++) {
                for (let j = 0; j < grid_RC.column; j++) {
                    let cell = {
                        cellid: `${cellid++}`,
                        index: `(${i}, ${j})`,
                        active: false,
                        ladybug: false,
                    };
                    cells.push(cell);
                }
            }

            Object.assign(q, {
                cells: cells,
                rows: grid_RC.rows,
                column: grid_RC.column,
            });

            const flattened = cells.map((cell) => cell.index);

            flattened.sort();

            const n = flattened.length;
            let median;
            if (n % 2 === 0) {
                median = `(${
                    (parseInt(flattened[n / 2 - 1][1]) +
                        parseInt(flattened[n / 2][1])) /
                    2
                }, ${
                    (parseInt(flattened[n / 2 - 1][4]) +
                        parseInt(flattened[n / 2][4])) /
                    2
                })`;
            } else {
                median = flattened[Math.floor(n / 2)];
            }

            //console.log(`Median: ${median}`);
            // console.log(q);
        });
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

onMounted(() => {
    document
        .querySelector("#selected_trial")
        .addEventListener("show_grid_modal", () => {
            modalGrid.value = !modalGrid.value;
        });

    document
        .querySelector("#selected_trial")
        .addEventListener("show_image_modal", () => {
            imageSetVisible.value = !imageSetVisible.value;
        });

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

.bgimage {
    aspect-ratio: var(--imageRatio, 1.5);
}

.grid-container {
    display: grid;
    row-gap: 0px;
    column-gap: 0px;
    padding: 0px;
}

.grid-container > .grid-item {
    text-align: center;
    font-size: 1vmin;
    color: white;
}
.cell {
    padding: 1vmin;
    text-align: center;
    cursor: pointer;
    /* background: rgb(255, 255, 255); */
    background: rgba(255, 255, 255, 0.2);
}
.cell.active {
    text-align: center;
    color: rgb(246, 245, 245);
    /* background: rgb(136, 138, 87); */
    background: rgba(254, 1, 1, 0.912);
}
</style>
