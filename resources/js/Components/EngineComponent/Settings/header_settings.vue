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

    <div v-for="(data, index) in inst_D" :key="index">
        <div
            @click="_methods.search"
            @mousedown="startDrag"
            ref="draggableElement"
            @blur="_methods.getContent"
            :textid="data.id"
            class="fixed translate-x-[-50%] leading-normal translate-y-[-50%] pointer-events-auto z-20"
            :style="{
                backgroundColor: data.bgColor,
                height: data.Hheight,
                width: data.Hwidht,
                top: data.Yaxis,
                left: data.Xaxis,
                borderStyle: 'solid',
                borderRadius: data.borderRadius,
                borderWidth: data.borderWidth,
                borderColor: data.borderColor,
                color: data.textColor,
            }"
            contenteditable="true"
            v-html="data.content"
        ></div>
    </div>
</template>
<script setup>
import devTools from "@/Components/EngineComponent/grid_editor_component/devTools.vue";

import { inject, onMounted, ref, watch } from "vue";
const props = defineProps(["demo"]);
const instruction_data = inject("Header_Settings");
const inst_D = ref(null);
const vsIns = ref(true);
const JsonData = ref({});
const ObjName = ref(null);
const divEditor = ref(false);
const demoName = ref(null);
const draggableElement = ref(null);

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
</style>
