<template>
    <input type="file" id="upload" accept="image/*" />
    <input
        type="range"
        id="resize"
        min="1"
        max="100"
        value="100"
        step="1"
        style="display: none"
        placeholder="  Images Size"
    />
    <div>
        <canvas id="canvas" @blur="convertCanvasToBlob" tabindex="0"></canvas>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

const uploadInput = ref(null);
const resizeInput = ref(null);
const canvas = ref(null);
const imageURL = ref("");
let ctx;
let img = new Image();
let imgX = 0,
    imgY = 0;
let imgWidth, imgHeight;
let isDragging = false;
let startX, startY;

onMounted(() => {
    uploadInput.value = document.getElementById("upload");
    resizeInput.value = document.getElementById("resize");
    canvas.value = document.getElementById("canvas");
    ctx = canvas.value.getContext("2d");

    uploadInput.value.addEventListener("change", handleImageUpload);
    resizeInput.value.addEventListener("input", handleResize);

    canvas.value.addEventListener("mousedown", startDragging);
    canvas.value.addEventListener("mousemove", dragImage);
    canvas.value.addEventListener("mouseup", stopDragging);
    canvas.value.addEventListener("mouseleave", stopDragging);
});

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            img.onload = () => {
                resizeInput.value.style.display = "block";
                imgX = 0;
                imgY = 0;
                imgWidth = img.width;
                imgHeight = img.height;
                drawImage();
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const handleResize = () => {
    const scale = resizeInput.value.value / 100;
    imgWidth = img.width * scale;
    imgHeight = img.height * scale;
    drawImage();
};

const drawImage = () => {
    canvas.value.width = canvas.value.clientWidth;
    canvas.value.height = canvas.value.clientHeight;
    ctx.clearRect(0, 0, canvas.value.width, canvas.value.height);
    ctx.drawImage(img, imgX, imgY, imgWidth, imgHeight);
};

const convertCanvasToBlob = () => {
    canvas.value.toBlob((blob) => {
        const url = URL.createObjectURL(blob);
        console.log("Blob:", blob);
        imageURL.value = url;
    }, "image/png");
};

const startDragging = (event) => {
    const rect = canvas.value.getBoundingClientRect();
    startX = event.clientX - rect.left - imgX;
    startY = event.clientY - rect.top - imgY;
    isDragging = true;
};

const dragImage = (event) => {
    if (isDragging) {
        const rect = canvas.value.getBoundingClientRect();
        imgX = event.clientX - rect.left - startX;
        imgY = event.clientY - rect.top - startY;
        drawImage();
    }
};

const stopDragging = () => {
    isDragging = false;
};
</script>

<style scoped>
#canvas {
    height: 100%;
    width: 100%;
    position: absolute;
    outline: none; /* Remove the default focus outline */
}
</style>
