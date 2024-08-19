<style scoped>
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
.editor_container {
    background-size: 40px 40px;
    background-image: linear-gradient(to right, grey 1px, transparent 1px),
        linear-gradient(to bottom, grey 1px, transparent 1px);
}
</style>
<template>
    <div class="bg-gray-100 relative h-full editor_container" id="custom_modal">
        <div
            class="fixed translate-x-[-50%] left-[50%] h-[5vmin] w-[20vmin] bg-yellow-500 text-center text-wrap inline-block align-middle rounded-b-lg"
        ></div>

        <select
            id="selected_trial"
            class="float-right z-10 bg-gray-300 relative h-[4vmin] w-[20vmin]"
            v-model="demo.demoName"
            @change="_methods.displayDemo"
        >
            <option value="practiceTrial" selected="selected">
                Practice Trial
            </option>
            <option value="DummyTrial">Dummy Trial</option>
            <option value="MainTrial">Main Trial</option>
        </select>

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

        <div v-for="(data, index) in test_Settings" :key="index">
            <div
                ref="content"
                @blur="_methods.getContent()"
                v-show="vsIns"
                :textid="data.id"
                class="drag fixed translate-x-[-50%] translate-y-[-50%] p-[5vmin] pointer-events-auto"
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
    </div>
</template>
<script setup>
import { inject, onMounted, reactive, ref, defineEmits } from "vue";
import devTools from "@/Components/EngineComponent/grid_editor_component/devTools.vue";

const demo = reactive({
    demoName: null,
});

const vsIns = ref(true);
const $emits = defineEmits(["vs:inst"]);

const divEditor = ref(false);
const props = inject("Instructions");

const test_Settings = ref({});
const JsonData = ref({});
const ObjName = ref(null);
const content = ref(null);
const _methods = {
    search: (obj) => {
        Object.keys(test_Settings.value).forEach((element) => {
            JsonData.value = props[demo.demoName];
            if (JsonData.value[element].id == obj.id) {
                ObjName.value = element;
                divEditor.value = !divEditor.value;

                JsonData.value[element].Xaxis = obj.PositionX + "%";
                JsonData.value[element].Yaxis = obj.PositionY + "%";
            }
        });
    },
    updateHeight: (height) => {
        JsonData.value[ObjName.value].Hheight = height + "%";
    },

    updateWidth: (width) => {
        JsonData.value[ObjName.value].Hwidht = width + "%";
    },
    updateBgColor: (bgColor) => {
        JsonData.value[ObjName.value].bgColor = bgColor;
    },
    updateBorderSize: (br) => {
        JsonData.value[ObjName.value].borderRadius = br + "px";
    },
    updateBorderWidth: (brWidth) => {
        JsonData.value[ObjName.value].borderWidth = brWidth + "px";
    },

    updateBorderBGColor: (brColor) => {
        JsonData.value[ObjName.value].borderColor = brColor;
    },

    displayDemo: () => {
        test_Settings.value = props[demo.demoName];
    },
    getContent: () => {
        JsonData.value[ObjName.value].content = content.value[0].innerHTML;
    },
};
onMounted(() => {
    if (test_Settings.value == null) {
        test_Settings.value = props.practiceTrial.tests;
    }

    document
        .querySelector("#selected_trial")
        .addEventListener("hide_data", () => {
            vsIns.value = !vsIns.value;
        });

    window.addEventListener("click", (event) => {
        var targetid = event.target.getAttribute("textid");
        var PosX = event.target.getAttribute("data-current-x");
        var PosY = event.target.getAttribute("data-current-y");

        _methods.search({ id: targetid, PositionX: PosX, PositionY: PosY });
        window.onmousemove = null;
        window.onmouseup = null;
    });

    window.onmousedown = (event2) => {
        let Newevent = event2.target;
        let SetEvent = Newevent.classList.contains("drag");

        if (SetEvent) {
            window.onmousemove = (event) => {
                var height = window.innerHeight;
                var width = window.innerWidth;

                var x = (event.clientX / width) * 100;
                var y = (event.clientY / height) * 100;

                Newevent.dataset.currentX = x;
                Newevent.dataset.currentY = y;

                Newevent.style.position = "fixed";

                Newevent.style.top = y + "%";
                Newevent.style.left = x + "%";

                window.onmouseup = (event) => {
                    var height = window.innerHeight;
                    var width = window.innerWidth;
                    var x = (event.clientX / width) * 100;
                    var y = (event.clientY / height) * 100;

                    Newevent.style.position = "fixed";

                    Newevent.style.top = y + "%";
                    Newevent.style.left = x + "%";

                    window.onmousemove = null;
                    window.onmouseup = null;
                };
            };
        }
    };
});
</script>
