<template>
    <div class="h-full bg-white">
        <div class="flex flex-col">
            <div
                class="bg-gray-600 h-[22vmin] p-1 m-1 rounded-lg"
                @mouseenter="practiceAction = true"
                @mouseleave="practiceAction = false"
            >
                <div
                    class="bg-blue-900 text-white h-[5vmin] p-3 text-center rounded-lg"
                >
                    Practice Target
                </div>

                <div
                    v-if="practiceAction"
                    class="hover:bg-transparent fixed text-white h-[16vmin] w-[30vmin] text-center rounded-lg z-30"
                >
                    <button
                        class="bg-red-500 mt-12 p-1 rounded-lg"
                        @click="
                            deletePracticeTarget({ Trial: 'practiceTrial' })
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                            />
                        </svg>
                    </button>

                    <button
                        class="bg-blue-500 mt-12 ml-1 p-1 rounded-lg"
                        @click="selectFile({ Trial: 'practiceTrial' })"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"
                            />
                        </svg>
                    </button>
                </div>

                <div class="bg-white h-[16vmin] p-1 rounded-lg">
                    <img
                        :src="props.images.practiceTrial.message.imagesrc"
                        class="object-fill h-[15vmin] w-[30vmin] relative left-[50%] translate-x-[-50%] z-10"
                    />
                </div>
            </div>

            <div
                class="bg-gray-600 h-[22vmin] p-1 m-1 rounded-lg"
                @mouseenter="dummyAction = true"
                @mouseleave="dummyAction = false"
            >
                <div
                    class="bg-blue-900 text-white h-[5vmin] p-3 text-center rounded-lg"
                >
                    Dummy Target
                </div>
                <div class="bg-white h-[16vmin] p-1 rounded-lg">
                    <div
                        v-if="dummyAction"
                        class="hover:bg-transparent fixed text-white h-[16vmin] w-[30vmin] text-center rounded-lg z-30"
                    >
                        <button
                            class="bg-red-500 mt-12 p-1 rounded-lg"
                            @click="
                                deletePracticeTarget({ Trial: 'DummyTrial' })
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                        </button>

                        <button
                            class="bg-blue-500 mt-12 ml-1 p-1 rounded-lg"
                            @click="selectFile({ Trial: 'DummyTrial' })"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"
                                />
                            </svg>
                        </button>
                    </div>

                    <img
                        :src="props.images.DummyTrial.message.imagesrc"
                        class="object-fill h-[15vmin] w-[30vmin] relative left-[50%] translate-x-[-50%]"
                    />
                </div>
            </div>

            <div
                class="bg-gray-600 h-[22vmin] p-1 m-1 rounded-lg"
                @mouseenter="mainAction = true"
                @mouseleave="mainAction = false"
            >
                <div
                    class="bg-blue-900 text-white h-[5vmin] p-3 text-center rounded-lg"
                >
                    Main Target
                </div>
                <div class="bg-white h-[16vmin] p-1 rounded-lg">
                    <div
                        v-if="mainAction"
                        class="hover:bg-transparent fixed text-white h-[16vmin] w-[30vmin] text-center rounded-lg z-30"
                    >
                        <button
                            class="bg-red-500 mt-12 p-1 rounded-lg"
                            @click="
                                deletePracticeTarget({ Trial: 'MainTrial' })
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                        </button>

                        <button
                            class="bg-blue-500 mt-12 ml-1 p-1 rounded-lg"
                            @click="selectFile({ Trial: 'MainTrial' })"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"
                                />
                            </svg>
                        </button>
                    </div>
                    <img
                        :src="props.images.MainTrial.message.imagesrc"
                        class="object-fill h-[15vmin] w-[30vmin] relative left-[50%] translate-x-[-50%]"
                    />
                </div>
            </div>
            <div
                class="bg-gray-600 h-[22vmin] p-1 m-1 rounded-lg"
                @mouseenter="expAction = true"
                @mouseleave="expAction = false"
            >
                <div
                    class="bg-blue-900 text-white h-[5vmin] p-3 text-center rounded-lg"
                >
                    Explicit Target
                </div>
                <div class="bg-white h-[16vmin] p-1 rounded-lg">
                    <div
                        v-if="expAction"
                        class="hover:bg-transparent fixed text-white h-[16vmin] w-[30vmin] text-center rounded-lg z-30"
                    >
                        <button
                            class="bg-red-500 mt-12 p-1 rounded-lg"
                            @click="
                                deletePracticeTarget({ Trial: 'ExplicitTrial' })
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                        </button>

                        <button
                            class="bg-blue-500 mt-12 ml-1 p-1 rounded-lg"
                            @click="selectFile({ Trial: 'ExplicitTrial' })"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"
                                />
                            </svg>
                        </button>
                    </div>
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
import { inject, ref } from "vue";
const practiceAction = ref(false);
const dummyAction = ref(false);
const mainAction = ref(false);
const expAction = ref(false);
const props = inject(["Alldata"]);

const deletePracticeTarget = (obj) => {
    props.images[obj.Trial].message.imagesrc = null;
};

//console.log(props.images.practiceTrial.message.imagesrc);

const selectFile = (obj) => {
    //console.log(props.images[obj.Trial].message.imagesrc);
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

                //console.log(props.images[obj.Trial].message);
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
                // console.error("Error reading file:", e.target.error);
            };
            reader.readAsDataURL(file); // Read the file as a data URL
        }
    };

    input.click(); // Programmatically click the input to open the file dialog
};
</script>
