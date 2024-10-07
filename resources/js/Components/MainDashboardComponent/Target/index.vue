<template>
    <div class="h-full bg-white">
        <div class="flex flex-col">
            <div class="bg-gray-600 h-[22vmin] p-1 m-1 rounded-lg">
                <div
                    class="bg-blue-900 text-white h-[5vmin] p-3 text-center rounded-lg"
                >
                    Practice Target
                </div>
                <div
                    class="bg-white h-[16vmin] p-1 rounded-lg"
                    @click="selectFile({ Trial: 'practiceTrial' })"
                >
                    <img
                        :src="props.images.practiceTrial.message.imagesrc"
                        class="object-fill h-[15vmin] w-[30vmin] relative left-[50%] translate-x-[-50%]"
                    />
                </div>
            </div>

            <div class="bg-gray-600 h-[22vmin] p-1 m-1 rounded-lg">
                <div
                    class="bg-blue-900 text-white h-[5vmin] p-3 text-center rounded-lg"
                >
                    Dummy Target
                </div>
                <div
                    class="bg-white h-[16vmin] p-1 rounded-lg"
                    @click="selectFile({ Trial: 'DummyTrial' })"
                >
                    <img
                        :src="props.images.DummyTrial.message.imagesrc"
                        class="object-fill h-[15vmin] w-[30vmin] relative left-[50%] translate-x-[-50%]"
                    />
                </div>
            </div>
            <div class="bg-gray-600 h-[22vmin] p-1 m-1 rounded-lg">
                <div
                    class="bg-blue-900 text-white h-[5vmin] p-3 text-center rounded-lg"
                >
                    Main Target
                </div>
                <div
                    class="bg-white h-[16vmin] p-1 rounded-lg"
                    @click="selectFile({ Trial: 'MainTrial' })"
                >
                    <img
                        :src="props.images.MainTrial.message.imagesrc"
                        class="object-fill h-[15vmin] w-[30vmin] relative left-[50%] translate-x-[-50%]"
                    />
                </div>
            </div>
            <div class="bg-gray-600 h-[22vmin] p-1 m-1 rounded-lg">
                <div
                    class="bg-blue-900 text-white h-[5vmin] p-3 text-center rounded-lg"
                >
                    Explicit Target
                </div>
                <div
                    class="bg-white h-[16vmin] p-1 rounded-lg"
                    @click="selectFile({ Trial: 'ExplicitTrial' })"
                >
                    <img
                        :src="props.images.ExplicitTrial.message.imagesrc"
                        class="object-fill h-[15vmin] w-[30vmin] relative left-[50%] translate-x-[-50%]"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { inject } from "vue";
const props = inject(["Alldata"]);
console.log(props.images.practiceTrial.message.imagesrc);

const selectFile = (obj) => {
    console.log(props.images[obj.Trial].message.imagesrc);
    // Create an input element dynamically
    const input = document.createElement("input");
    input.type = "file";
    input.accept = "*"; // Specify accepted file types

    input.onchange = (event) => {
        const file = event.target.files[0]; // Get the selected file
        const img = new Image();
        if (file) {
            const reader = new FileReader();
            reader.onload = async (e) => {
                const formData = new FormData();
                formData.append("image", file);
                const res = await axios.post("/upload_images", formData, {
                    headers: { "Content-Type": "multipart/form-data" },
                });

                console.log(props.images[obj.Trial].message);
                img.src = e.target.result;

                img.onload = () => {
                    const width = img.naturalWidth;
                    const height = img.naturalHeight;
                    const aspectRatio = width / height;
                    props.images[obj.Trial].message.image_ratio = aspectRatio;
                    console.log(
                        `Width: ${width}, Height: ${height}, Aspect Ratio: ${aspectRatio}`
                    );
                };

                props.images[obj.Trial].message.imagesrc = res.data;

                // console.log(props.images[obj.Trial].message.image_ratio);
            };
            reader.onerror = (e) => {
                console.error("Error reading file:", e.target.error);
            };
            reader.readAsDataURL(file); // Read the file as a data URL
        }
    };

    input.click(); // Programmatically click the input to open the file dialog
};
</script>
