<template>
    <!-- DevTools -->
    <Teleport to="body">
        <devTools
            class="z-50"
            v-show="divEditor"
            @update:Height="_methods.updateHeight"
            @update:Width="_methods.updateWidth"
            @update:br="_methods.updateBorderSize"
            @update:brWidth="_methods.updateBorderWidth"
            @update:brColor="_methods.updateBorderBGColor"
            @update:bgColor="_methods.updateBgColor"
        />
    </Teleport>

    <!-- Modal Grid -->
    <div
        v-show="modalGrid"
        class="drag container bg-gray-100 fixed left-[50%] top-[50%] z-50 w-[50vmin] h-[30vmin] rounded-md shadow-xl transform -translate-x-1/2 -translate-y-1/2"
    >
        <div class="bg-gray-900 h-12 flex justify-end p-1">
            <button @click="close" class="bg-gray-300 p-2 rounded-sm">
                Close
            </button>
        </div>
        <div class="p-10">
            <label>Rows</label>
            <input
                type="text"
                class="w-full rounded-md"
                v-model="grid_RC.rows"
            />
            <label>Column</label>
            <input
                type="text"
                class="w-full rounded-md"
                v-model="grid_RC.column"
            />
            <button
                @click="_methods.setupGrid"
                class="bg-blue-400 mt-5 h-[4vmin] w-[10vmin] rounded-md"
            >
                Save
            </button>
        </div>
    </div>

    <!-- Image Set -->
    <div
        v-if="imageSetVisible"
        class="fixed z-50 bg-gray-dark translate-x-[-50%] translate-y-[-50%] left-[50%] top-[50%] h-[50vmin] w-[100vmin] rounded-lg shadow-xl"
    >
        <div class="bg-white h-[5vmin] flex justify-end p-3">
            <button
                @click="_methods.closeImageSet"
                class="bg-gray-300 p-3 rounded-lg"
            >
                Close
            </button>
        </div>
        <div class="bg-gray-100 m-5 h-[40vmin] rounded-lg relative">
            <input
                type="file"
                id="upload"
                accept="image/*"
                @change="handleImageUpload"
            />
            <img :src="imageURL" class="object-fill h-[35vmin] p-5 w-full" />
        </div>
    </div>

    <!-- Main Container -->
    <div class="container mx-auto relative">
        <div v-for="(data, index) in inst_D" :key="index">
            <img
                @click="_methods.search"
                class="bg-gray-500 fixed top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2"
                :src="data.imagesrc"
                :style="{
                    'aspect-ratio': data.image_ratio,
                    width: data.Hwidht,
                    height: data.Hheight,
                }"
            />

            <div
                @click="_methods.search"
                :style="{
                    width: data.Hwidht,
                    height: data.Hheight,
                    'aspect-ratio': data.image_ratio,
                    fontSize: '1vmin',
                    display: 'grid',
                    gridTemplateColumns: `repeat(${data.column}, minmax(0, 1fr))`,
                }"
                class="fixed top-[50%] left-[50%] transform -translate-x-1/2 -translate-y-1/2"
            >
                <div
                    v-for="(cell, i) in data.cells"
                    :key="i"
                    class="cell p-0"
                    :class="{ active: cell.active }"
                    @click="
                        _methods.detectCells({
                            keys: cell.keys,
                            index: i,
                            cell,
                        })
                    "
                >
                    <div>
                        {{ cell.index }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import devTools from "@/Components/EngineComponent/grid_editor_component/devTools.vue";
import { inject, onMounted, ref, reactive, watch } from "vue";

const props = defineProps(["demo"]);
const instruction_data = inject("Image_Settings");

const inst_D = ref(null);
const vsIns = ref(true);
const JsonData = ref({});
const ObjName = ref(null);
const divEditor = ref(false);
const demoName = ref(null);
const imageSetVisible = ref(false);
const imageURL = ref(null);
const ratio = ref(null);
const modalGrid = ref(false);
const grid_RC = reactive({ rows: null, column: null });

const close = () => {
    modalGrid.value = false;
};

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = async (e) => {
        const formData = new FormData();
        formData.append("image", file);
        const res = await axios.post("/upload_images", formData, {
            headers: { "Content-Type": "multipart/form-data" },
        });

        const img = new Image();
        img.src = e.target.result;
        imageURL.value = res.data;
        JsonData.value["imagesrc"] = res.data;

        img.onload = () => {
            ratio.value = img.width / img.height;
            JsonData.value["image_ratio"] = ratio.value;
        };
    };
    reader.readAsDataURL(file);
};

const _methods = {
    search: () => {
        divEditor.value = true;
        Object.keys(inst_D.value).forEach((element) => {
            JsonData.value = inst_D.value[element];
            ObjName.value = element;
        });
    },
    detectCells: ({ cell }) => {
        cell.active = !cell.active;
    },
    updateHeight: (height) => {
        JsonData.value["Hheight"] = `${height}vmin`;
    },
    updateWidth: (width) => {
        JsonData.value["Hwidht"] = `${width}vmin`;
    },
    updateBgColor: (bgColor) => {
        JsonData.value["bgColor"] = bgColor;
    },
    updateBorderSize: (br) => {
        JsonData.value["borderRadius"] = `${br}px`;
    },
    updateBorderWidth: (brWidth) => {
        JsonData.value["borderWidth"] = `${brWidth}px`;
    },
    updateBorderBGColor: (brColor) => {
        JsonData.value["borderColor"] = brColor;
    },
    closeImageSet: () => {
        imageSetVisible.value = false;
    },
    setupGrid: () => {
        Object.keys(inst_D.value).forEach((item) => {
            const q = inst_D.value[item];
            const cells = [];

            for (let i = 0; i < grid_RC.rows; i++) {
                for (let j = 0; j < grid_RC.column; j++) {
                    cells.push({
                        cellid: `${i * grid_RC.column + j + 1}`,
                        index: `(${i}, ${j})`,
                        active: false,
                        ladybug: false,
                    });
                }
            }

            q.cells = cells;
            q.rows = grid_RC.rows;
            q.column = grid_RC.column;

            const flattened = cells.map((cell) => cell.index).sort();
            const median =
                flattened.length % 2 === 0
                    ? `(${
                          (parseInt(flattened[flattened.length / 2 - 1][1]) +
                              parseInt(flattened[flattened.length / 2][1])) /
                          2
                      }, 
                    ${
                        (parseInt(flattened[flattened.length / 2 - 1][4]) +
                            parseInt(flattened[flattened.length / 2][4])) /
                        2
                    })`
                    : flattened[Math.floor(flattened.length / 2)];

            // console.log(`Median: ${median}`);
            console.log(instruction_data);
        });
    },
};

watch(
    props,
    (newDemo) => {
        demoName.value = newDemo.demo;
        inst_D.value = instruction_data[demoName.value];
    },
    { immediate: true }
);

onMounted(() => {
    document
        .querySelector("#selected_trial")
        .addEventListener("show_grid_modal", () => {
            modalGrid.value = !modalGrid.value;
            // modalGrid.value = true;
        });
    document
        .querySelector("#selected_trial")
        .addEventListener("show_image_modal", () => {
            imageSetVisible.value = !imageSetVisible.value;
        });

    if (!demoName.value) {
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
.cell {
    background: rgba(255, 255, 255, 0.2);
    cursor: pointer;
    text-align: center;
}
.cell.active {
    background: rgba(254, 1, 1, 0.912);
    color: #f6f5f5;
}
</style>
