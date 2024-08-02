<style scope>
:root {
    --componentY: null;
    --componentX: null;
    --componentW: null;
    --componentH: null;
    --componentBG: red;
    --componentFontColor: "black";
    --componentFontSize: null;
}
.resizable {
    resize: both;
    overflow: hidden;
}
.jboy-btn {
    background-color: var(--componentBG, orange);
    position: relative;
    transform: translateX(-50%);
    padding: 1vmin 2vmin;
    border-radius: 1vmin;
}

.warning {
    background-color: red;
    padding: auto;
    border-radius: 10px;
}

.card {
    position: fixed;
    z-index: 600;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 90%;
    max-width: 50%;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-header {
    background-color: #007bff;
    color: white;
    padding: 16px;
}

.card-content {
    padding: 16px;
}
.warningMessage {
    background-color: #ff002f;
    color: white;
    padding: 16px;
    position: fixed;
    z-index: 1;
}
label {
    background-color: black;
    color: white;
    padding: 5px;
    border-radius: 10px;
}
.content {
    margin: 10px;
}
</style>
<script setup>
import { ref, onMounted, inject } from "vue";
const test = inject("test");

const practice_instruction =
    test.value.settings.instruction.practice_instruction;

const main_instruction = test.value.settings.instruction.main_instruction;

import Editor from "@/Components/AdvanceEditor/Component/modalEditor.vue";
const props = defineProps(["data"]);
const demoPart = ref(null);
const itemRef = ref(null);

const saveIns = () => {
    let btnTextValue = document.querySelector(".jboy-btn");

    const storedElement = {};
    itemRef.value.forEach((element) => {
        if (element.innerHTML.trim()) {
            let keyvalue = element.getAttribute("keyValues");
            let ElemValue = element.innerHTML;
            Object.assign(storedElement, { keyvalue, ElemValue });
        }
    });

    Object.keys(props.data).forEach((ObjKeys) => {
        if (ObjKeys == storedElement.keyvalue) {
            props.data[ObjKeys] = storedElement.ElemValue;
            demoPart.value[ObjKeys] = props.data[ObjKeys];
        } else if (ObjKeys == "button") {
            props.data["button"] = btnTextValue.innerHTML;
            demoPart.value["button"] = props.data["button"];
        }
    });

    console.log(props.data);
};

onMounted(() => {
    if (props.data["DemoPart"] == "practice") {
        demoPart.value = practice_instruction;
    } else if (props.data["DemoPart"] == "main") {
        demoPart.value = main_instruction;
    }

    itemRef.value.forEach((element) => {
        if (!element.innerHTML.trim()) {
            element.contentEditable = false;
        } else {
            element.contentEditable = true;
        }
    });
});
</script>
<template>
    <div class="container">
        <div class="card resizable">
            <div class="card-header">
                <h2>Instructions</h2>
            </div>
            <div class="card-content">
                <div v-for="(data, index) in props" :key="index">
                    <div
                        class="content"
                        contenteditable="true"
                        ref="itemRef"
                        v-html="data.message"
                        keyValues="message"
                    ></div>

                    <div
                        class="content"
                        contenteditable="true"
                        ref="itemRef"
                        v-html="data.warnings"
                        keyValues="warnings"
                    ></div>

                    <div
                        class="content"
                        contenteditable="true"
                        ref="itemRef"
                        v-html="data.saving"
                        keyValues="saving"
                    ></div>

                    <div
                        class="content"
                        contenteditable="true"
                        ref="itemRef"
                        v-html="data.savingFail"
                        keyValues="savingFail"
                    ></div>

                    <div
                        class="content"
                        contenteditable="true"
                        ref="itemRef"
                        v-html="data.loading"
                        keyValues="loading"
                    ></div>

                    <div
                        class="content"
                        contenteditable="true"
                        ref="itemRef"
                        v-html="data.redirect"
                        keyValues="redirect"
                    ></div>

                    <button
                        @blur="saveIns"
                        :style="{
                            backgroundColor: data.style['--componentBG'],
                            top: data.style['--componentY'],
                            left: data.style['--componentX'],
                        }"
                        class="content jboy-btn border-double border-1"
                        contenteditable="true"
                        keyValues="button"
                        v-html="data.button"
                    ></button>
                </div>
            </div>
        </div>
    </div>

    <editor
        @update:btnColor="
            (obj) => {
                props.data.style['--componentBG'] = obj.color;
            }
        "
    />
</template>
