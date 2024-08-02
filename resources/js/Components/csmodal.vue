<style scoped>
.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 1.25rem;
    width: 500px;
    padding: 0%;
    margin: 0%;
}
</style>
<template>
    <div class="modal">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div
                class="relative bg-white rounded-lg dark:bg-gray-700 shadow-lg shadow-black-500"
            >
                <button
                    type="button"
                    @click="close"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                >
                    <svg
                        class="w-3 h-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

                <div class="p-4 md:p-5 text-center">
                    <slot name="header"> </slot>

                    <slot name="body"> </slot>

                    <slot name="footer"> </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineEmits, defineExpose, onMounted } from "vue";

const emits = defineEmits(["close"]);

const close = () => {
    emits("close");
};

defineExpose({
    close: () => {
        close();
    },
});
onMounted(() => {
    window.onmousedown = (event) => {
        let Newevent = event.target;
        let SetEvent = Newevent.getAttribute("class");
        if (SetEvent == "modal") {
            let event2 = event;
           
            window.onmousemove = (event) => {
                var height = window.innerHeight;
                var width = window.innerWidth;
                var x = (event.clientX / width) * 100;
                var y = (event.clientY / height) * 100;

                event2.target.style.position = "fixed";
                event2.target.style.top = y + "%";
                event2.target.style.left = x + "%";
                event2.target.style.transform = "translate(-50%,-50%)";

                window.onmouseup = (event) => {
                    var height = window.innerHeight;
                    var width = window.innerWidth;
                    var x = (event.clientX / width) * 100;
                    var y = (event.clientY / height) * 100;
                    event2.target.style.position = "fixed";
                    event2.target.style.top = y + "%";
                    event2.target.style.left = x + "%";
                    event2.target.style.transform = "translate(-50%,-50%)";
                    window.onmousemove = null;
                    window.onmouseup = null;
                };
            };
          
        }
    };
});
</script>
