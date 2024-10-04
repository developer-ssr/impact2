<template>
    <div class="h-full bg-white">
        <div class="flex flex-col">
            <div class="bg-gray-600 h-[22vmin] p-1 m-1 rounded-lg">
                <div
                    class="bg-blue-900 text-white h-[5vmin] p-3 text-center rounded-lg"
                >
                    Practice Target
                </div>
                <div class="bg-white h-[16vmin] p-1 rounded-lg">
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
                <div class="bg-white h-[16vmin] p-1 rounded-lg">
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
                <div class="bg-white h-[16vmin] p-1 rounded-lg">
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
                <div class="bg-white h-[16vmin] p-1 rounded-lg">
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
</script>
