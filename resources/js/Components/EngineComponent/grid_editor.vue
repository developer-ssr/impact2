<template>
    <div class="bg-gray-300 relative w-full h-full">
        <gridBody />
    </div>
</template>
<script setup>
import { ref, onMounted, defineProps, inject } from "vue";
import gridBody from "@/Components/EngineComponent/grid_editor_component/grid_editor_body.vue";
const drag = ref(null);

const ratio = ref(null);

onMounted(() => {
    const img = new Image();

    img.onload = function () {
        ratio.value = this.width / this.height;
    };

    img.src = "http://www.google.com/intl/en_ALL/images/logo.gif";

    // window.onmousedown = (event2) => {
    //     let Newevent = event2.target;
    //     let SetEvent = Newevent.classList.contains("drag");

    //     drag.value.style.height = DivHeight.value + "vmin";
    //     drag.value.style.width = DivWidht.value + "vmin";

    //     window.onmousemove = (event) => {
    //         var height = window.innerHeight;
    //         var width = window.innerWidth;
    //         var x = (event.clientX / width) * 100;
    //         var y = (event.clientY / height) * 100;

    //         Newevent.dataset.currentX = x;
    //         Newevent.dataset.currentY = y;

    //         Newevent.style.position = "fixed";

    //         Newevent.style.top = y + "%";
    //         Newevent.style.left = x + "%";

    //         drag.value.style.height = DivHeight.value + "vmin";
    //         drag.value.style.width = DivWidht.value + "vmin";

    //         window.onmouseup = (event) => {
    //             var height = window.innerHeight;
    //             var width = window.innerWidth;
    //             var x = (event.clientX / width) * 100;
    //             var y = (event.clientY / height) * 100;

    //             Newevent.style.position = "fixed";

    //             Newevent.style.top = y + "%";
    //             Newevent.style.left = x + "%";

    //             drag.value.style.height = DivHeight.value + "vmin";
    //             drag.value.style.width = DivWidht.value + "vmin";

    //             window.onmousemove = null;
    //             window.onmouseup = null;
    //         };
    //     };
    // };
});
</script>

<style scoped>
#canvas {
    background: #fff;
    margin: 20px;
}
</style>
