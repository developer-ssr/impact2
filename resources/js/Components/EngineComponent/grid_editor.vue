<template>
    <div class="grid_container relative w-[50%] h-full left-[25%]">
        <!-- <input type="range" v-model="DivHeight" @change="setHeight" />
        <input type="range" v-model="DivWidht" @change="setWidth" /> -->
        <!-- <img
            class="relative w-full h-full object-fill"
            src="https://photographylife.com/wp-content/uploads/2014/02/Nikon-35mm-f1.8G-Sample-Image-1.jpg"
        /> -->
        <!-- <div ref="drag">
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
            <div>1</div>
        </div> -->
    </div>
</template>
<script setup>
import { ref, defineEmits, inject, onMounted } from "vue";
const drag = ref(null);
const ratio = ref(null);
const DivHeight = ref(null);
const DivWidht = ref(null);

const setHeight = () => {
    drag.value.style.height = DivHeight.value + "vmin";
};
const setWidth = () => {
    drag.value.style.width = DivWidht.value + "vmin";
};

const pxToVmin = (px) => {
    const vmin = Math.min(window.innerWidth, window.innerHeight);
    return (px / vmin) * 100;
};

window.onclick = (event) => {
    console.log(event.target);
};
// onMounted(() => {
//     const img = new Image();

//     img.onload = function () {
//         ratio.value = this.width / this.height;
//     };

//     img.src = "http://www.google.com/intl/en_ALL/images/logo.gif";

//     window.onmousedown = (event2) => {
//         let Newevent = event2.target;
//         let SetEvent = Newevent.classList.contains("drag");

//         drag.value.style.height = DivHeight.value + "vmin";
//         drag.value.style.width = DivWidht.value + "vmin";

//         window.onmousemove = (event) => {
//             var height = window.innerHeight;
//             var width = window.innerWidth;
//             var x = (event.clientX / width) * 100;
//             var y = (event.clientY / height) * 100;

//             Newevent.dataset.currentX = x;
//             Newevent.dataset.currentY = y;

//             Newevent.style.position = "fixed";

//             Newevent.style.top = y + "%";
//             Newevent.style.left = x + "%";

//             drag.value.style.height = DivHeight.value + "vmin";
//             drag.value.style.width = DivWidht.value + "vmin";

//             window.onmouseup = (event) => {
//                 var height = window.innerHeight;
//                 var width = window.innerWidth;
//                 var x = (event.clientX / width) * 100;
//                 var y = (event.clientY / height) * 100;

//                 Newevent.style.position = "fixed";

//                 Newevent.style.top = y + "%";
//                 Newevent.style.left = x + "%";

//                 drag.value.style.height = DivHeight.value + "vmin";
//                 drag.value.style.width = DivWidht.value + "vmin";

//                 window.onmousemove = null;
//                 window.onmouseup = null;
//             };
//         };
//     };
// });
</script>

<style scoped></style>
