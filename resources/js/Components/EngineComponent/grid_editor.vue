<template>
    <!-- <main class="p-4 flex grow-[1]"> -->
    <input type="range" v-model="DivHeight" @change="setHeight" />
    <input type="range" v-model="DivWidht" @change="setWidth" />
    <img
        style="position: absolute; height: 100%; width: 100%; object-fit: cover"
        src="https://photographylife.com/wp-content/uploads/2014/02/Nikon-35mm-f1.8G-Sample-Image-1.jpg"
    />
    <div class="main-container relative"></div>
    <div
        class="drag grid-container grid gap-1 relative"
        :style="{
            'grid-template-columns': 'repeat(5,1fr)',
            '--imageratio': ratio,
        }"
        ref="drag"
    >
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
    </div>
    <!-- </main> -->
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
onMounted(() => {
    const img = new Image();

    img.onload = function () {
        ratio.value = this.width / this.height;
    };

    img.src = "http://www.google.com/intl/en_ALL/images/logo.gif";

    window.onmousedown = (event2) => {
        let Newevent = event2.target;
        let SetEvent = Newevent.classList.contains("drag");

        drag.value.style.height = DivHeight.value + "vmin";
        drag.value.style.width = DivWidht.value + "vmin";

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

                drag.value.style.height = DivHeight.value + "vmin";
                drag.value.style.width = DivWidht.value + "vmin";

                window.onmouseup = (event) => {
                    var height = window.innerHeight;
                    var width = window.innerWidth;
                    var x = (event.clientX / width) * 100;
                    var y = (event.clientY / height) * 100;

                    Newevent.style.position = "absolute";

                    Newevent.style.top = y + "%";
                    Newevent.style.left = x + "%";

                    drag.value.style.height = DivHeight.value + "vmin";
                    drag.value.style.width = DivWidht.value + "vmin";

                    window.onmousemove = null;
                    window.onmouseup = null;
                };
            };
        }
    };
});
</script>

<style scoped>
.grid-container {
    z-index: 1;
    display: grid;
    grid-template-columns: auto auto;
    background-color: transparent;
    aspect-ratio: var(--imageratio);
    border-width: 4px 1.25em;
}

.grid-container > div {
    z-index: 1;
    background-color: rgba(255, 255, 255, 0.8);
    text-align: center;
    font-size: 2vmin;
}
.dragging {
    height: 10vmin;
    width: 10vmin;
    z-index: 99;
    resize: both;
    overflow: auto;
    background-color: red;
    aspect-ratio: var(--imageratio);
}
</style>
