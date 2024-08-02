<style scoped>
.card {
    position: fixed;
    z-index: 500;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 80%;
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
    height: 100%;
    width: 100%;
}
canvas {
    position: absolute;
    height: 100%;
    width: 100%;
}
</style>

<template>
    <div class="card">
        <div class="card-header">Images Editor</div>

        <input
            type="file"
            id="upload"
            accept="image/*"
            @change="handleImageUpload"
        />

        <input
            type="range"
            id="resize"
            min="1"
            max="100"
            value="100"
            step="1"
            style="display: none"
            @input="handleResize"
        />
        <img :src="imageURL.value" />
        <canvas id="canvas" @blur="convertCanvasToBlob" tabindex="0"></canvas>
    </div>
</template>

<script setup>
import { onMounted, ref, inject } from "vue";
import { router } from "@inertiajs/vue3";
import axios from "axios";

const test = inject("test");

const practice_instruction =
    test.value.settings.instruction.practice_instruction;
const main_instruction = test.value.settings.instruction.main_instruction;

const demoPart = ref(null);

const props = defineProps(["data"]);

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
    if (props.data["DemoPart"] == "practice") {
        demoPart.value = practice_instruction;
    } else if (props.data["DemoPart"] == "main") {
        demoPart.value = main_instruction;
    }

    uploadInput.value = document.getElementById("upload");
    resizeInput.value = document.getElementById("resize");
    canvas.value = document.getElementById("canvas");
    ctx = canvas.value.getContext("2d");

    canvas.value.addEventListener("mousedown", startDragging);
    canvas.value.addEventListener("mousemove", dragImage);
    canvas.value.addEventListener("mouseup", stopDragging);
    canvas.value.addEventListener("mouseleave", stopDragging);
});

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    let ratio = 1;
    if (file) {
        const reader = new FileReader();

        reader.onload = async (e) => {
            img.onload = async () => {
                resizeInput.value.style.display = "block";
                imgX = 0;
                imgY = 0;
                imgWidth = img.width;
                imgHeight = img.height;
                drawImage();
                ratio = img.width / img.height;
                var formData = new FormData();
                formData.append("image", file);

                const res = await axios.post("/targets_store", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                demoPart.value["target"]["img"] = res.data;
                demoPart.value["target"]["height"] = imgHeight;
                demoPart.value["target"]["width"] = imgWidth;
                demoPart.value["target"]["imageRatio"] = ratio;
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
