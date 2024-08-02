<script setup>
import { reactive, onMounted, ref, inject, nextTick } from "vue";
import { useForm } from "@inertiajs/vue3";
import sidebar from "@/Components/AdvanceEditor/Component/sidebar.vue";
import Navbar from "@/Components/AdvanceEditor/navbar.vue";
import gridModal from "@/Components/AdvanceEditor/Component/instructionComponent/gridmodal.vue";
import instruction_grid_cell from "@/Components/AdvanceEditor/Component/instructionComponent/instruction_grid_cell.vue";

const test = inject("test");
const ishowGr = ref(false);
const demoPart = ref(null);
const collections = reactive(test.value.quadrants);
const ins_grid = ref(false);

const settings = reactive(test.value.settings);

const insData = ref([]);

const form = useForm({
    id: test.value.id,
});

const _method = {
    updateGrid: (val) => {
        insData.value = val;
    },

    updateCell: (obj) => {
        // console.log(demoPart.value);
        Object.keys(insData.value.quadrants).forEach((quadrants) => {
            let q = insData.value.quadrants[quadrants];

            q.rows = obj.rows;
            q.column = obj.column;

            let qnumber = quadrants.replace(/^\D+/g, "");

            let cells = [];
            let l = parseInt(q.column) * parseInt(q.rows);

            for (let x = 1; x <= l; x++) {
                let cell = {
                    index: x,
                    keys: q.keys + x,
                    active: false,
                    ladybug: false,
                    quadrant: qnumber,
                };
                cells.push(cell);
            }
            Object.assign(q, { cells: cells });
        });
    },

    showLadyBug: (obj) => {
        let target = collections["quadrant" + obj.quadrant];
        let index = target.cells.findIndex((o) => {
            return o.keys == obj.keys;
        });
        target.cells[index].ladybug = true;
    },

    detectCells: (obj) => {
        obj.cell.active = !obj.cell.active;
    },

    ShowBugs: () => {
        console.log(insData.value);
        axios({
            method: "post",
            url: "/updateTest",
            data: {
                id: form.id,
                settings: settings,
            },
        });
    },

    RecieveDemoPart: (demo) => {
        demoPart.value = demo;
    },
};

onMounted(async () => {
    await nextTick();
    setTimeout(() => {
        //isReady.value = true;
    }, 3000);
});
</script>

<template>
    <Navbar
        :demo="demoPart"
        @save:SaveSettings="
            () => {
                _method.ShowBugs();
            }
        "
    />

    <gridModal
        :state="ishowGr"
        :demoPart="demoPart"
        @update:state="
            (val) => {
                ishowGr = val;
            }
        "
        @edit:editCell="
            (obj) => {
                _method.updateCell(obj);
            }
        "
    />

    <sidebar
        @update:gridcell="
            (val) => {
                ins_grid = !ins_grid;
                _method.updateGrid(val);
            }
        "
        @update:gridState="
            () => {
                ishowGr = !ishowGr;
            }
        "
        @load:demoPart="
            (demoPart) => {
                _method.RecieveDemoPart(demoPart);
            }
        "
    />

    <instruction_grid_cell
        v-if="ins_grid"
        @edit:detectCells="
            (obj) => {
                _method.detectCells(obj);
            }
        "
        :data="insData"
    />
</template>
