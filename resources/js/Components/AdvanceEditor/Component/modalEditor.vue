<script setup>
import { onMounted, ref, inject } from "vue";

let count = ref(0);
const disable = ref(false);
const btnColor = ref(null);

const $emits = defineEmits(["update:btnColor"]);

const updateBtnColor = (i) => {
    $emits("update:btnColor", {
        color: btnColor.value,
    });
};

const _method = {
    showPosition: (obj) => {
        //console.log(obj.x);
    },

    numberlist: () => {
        document.execCommand("insertOrderedList");
    },

    bullets: () => {
        document.execCommand(
            "insertUnorderedList",
            false,
            window.getSelection().toString()
        );
    },

    incrementsize: () => {
        document.execCommand("fontSize", false, count.value++);
    },

    decrementsize: () => {
        document.execCommand("fontSize", false, count.value--);
    },

    backColor: () => {
        const backColordata =
            document.getElementById("nativeColorPicker1").value;
        document.execCommand("backColor", true, backColordata);
    },

    FontColor: () => {
        const foreColordata =
            document.getElementById("nativeColorPicker2").value;
        document.execCommand("foreColor", false, foreColordata);
    },

    createLink: () => {
        document.execCommand("createLink", false, "edit the link");
    },

    underline: () => {
        document.execCommand(
            "underline",
            false,
            window.getSelection().toString()
        );
    },

    fontnames: () => {
        document.execCommand(
            "fontName",
            false,
            window.getSelection().toString()
        );
    },
    removeformat: () => {
        document.execCommand("removeformat", false, "");
    },
    justifyRight: () => {
        document.execCommand("justifyRight", false, "");
    },
    justifyCenter: () => {
        document.execCommand("justifyCenter", false, "");
    },
    justifyleft: () => {
        document.execCommand("justifyleft", false, "");
    },
    undocom: () => {
        document.execCommand("undo", false, null);
    },
    redocom: () => {
        document.execCommand("redo", false, "");
    },
};
onMounted(() => {
    window.onmousedown = (event2) => {
        let Newevent = event2.target;
        let SetEvent = Newevent.classList.contains("drag");

        if (SetEvent) {
            window.onmousemove = (event) => {
                var height = window.innerHeight;
                var width = window.innerWidth;
                var x = (event.clientX / width) * 100;
                var y = (event.clientY / height) * 100;

                // Update current position

                Newevent.dataset.currentX = x;
                Newevent.dataset.currentY = y;

                Newevent.style.position = "fixed";
                Newevent.style.top = y + "%";
                Newevent.style.left = x + "%";
                Newevent.style.transform = "translate(-50%,-50%)";
                _method.showPosition({ x: x, y: y });
                window.onmouseup = (event) => {
                    var height = window.innerHeight;
                    var width = window.innerWidth;
                    var x = (event.clientX / width) * 100;
                    var y = (event.clientY / height) * 100;

                    Newevent.style.position = "absolute";
                    Newevent.style.top = y + "%";
                    Newevent.style.left = x + "%";
                    Newevent.style.transform = "translate(-50%,-50%)";

                    window.onmousemove = null;
                    window.onmouseup = null;
                };
            };
        }
    };
});
</script>

<style>
font[size="1"] {
    font-size: 1vmin;
}
font[size="2"] {
    font-size: 2vmin;
}

font[size="3"] {
    font-size: 3vmin;
}
font[size="4"] {
    font-size: 4vmin;
}
font[size="5"] {
    font-size: 5vmin;
}

.drag {
    cursor: move;
    padding: 10px;
}
.card {
    position: fixed;
    z-index: 700;
    top: 50%;
    left: 50%;

    transform: translate(-50%, -50%);
    width: 50%;
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
    padding: 16px;
}
</style>
<template>
    <Teleport to="body">
        <div class="drag card">
            <span>Move</span>
            <div class="bg-gray-200">
                <div class="card-header">
                    <h2>Tools</h2>
                </div>
                <div class="card-content">
                    <button
                        @click="_method.removeformat"
                        type="button"
                        class="bg-gray p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        Remove Format
                        <!-- <span class="sr-only">center</span> -->
                    </button>
                    <button
                        @click="_method.decrementsize"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 18 2"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.4"
                                d="M1 1h16"
                            />
                        </svg>
                    </button>

                    <button
                        @click="_method.incrementsize"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 18 18"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.4"
                                d="M9 1v16M1 9h16"
                            />
                        </svg>
                    </button>

                    <button
                        @click="_method.underline"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 16 20"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.6"
                                d="M12 1v9.5a4.5 4.5 0 1 1-9 0V1M1 1h4m5 0h4M1 19h14"
                            />
                        </svg>
                    </button>

                    <button
                        onmousedown="document.execCommand('bold', false, null); return false"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 16"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.6"
                                d="M3 1h4.5a3.5 3.5 0 1 1 0 7H3m0-7v7m0-7H1m2 7h6.5a3.5 3.5 0 1 1 0 7H3m0-7v7m0 0H1"
                            />
                        </svg>
                    </button>

                    <button
                        onmousedown="document.execCommand('italic', false, null); return false"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 16"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.6"
                                d="m3.874 15 6.143-14M1 15h6.33M6.67 1H13"
                            />
                        </svg>
                    </button>

                    <button
                        @click="_method.createLink"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 19 19"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.6"
                                d="M11.013 7.962a3.519 3.519 0 0 0-4.975 0l-3.554 3.554a3.518 3.518 0 0 0 4.975 4.975l.461-.46m-.461-4.515a3.518 3.518 0 0 0 4.975 0l3.553-3.554a3.518 3.518 0 0 0-4.974-4.975L10.3 3.7"
                            />
                        </svg>
                    </button>

                    <button
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            @click="_method.undocom"
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 16 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.6"
                                d="m12 7 3-3-3-3m0 12H5.5a4.5 4.5 0 1 1 0-9H14"
                            />
                        </svg>

                        <!-- <span class="sr-only">Add emoji</span> -->
                    </button>

                    <button
                        @click="_method.redocom"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 16 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.6"
                                d="M4 7 1 4l3-3m0 12h6.5a4.5 4.5 0 1 0 0-9H2"
                            />
                        </svg>
                        <!-- <span class="sr-only">redo</span> -->
                    </button>

                    <button
                        @click="_method.justifyleft"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 16 12"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.6"
                                d="M1 1h14M1 6h14M1 11h7"
                            />
                        </svg>
                        <!-- <span class="sr-only">left</span> -->
                    </button>

                    <button
                        @click="_method.justifyCenter"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.4"
                                d="M3 1h8M1 5h12M3 9h8M1 13h12"
                            />
                        </svg>
                        <!-- <span class="sr-only">left</span> -->
                    </button>
                    <button
                        onmousedown="document.execCommand('justifyRight', false, null); return false"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm8.25 5.25a.75.75 0 01.75-.75h8.25a.75.75 0 010 1.5H12a.75.75 0 01-.75-.75z"
                                clip-rule="evenodd"
                            />
                        </svg>

                        <!-- <span class="sr-only">right</span> -->
                    </button>

                    <button
                        @click="_method.numberlist"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 21 18"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.4"
                                d="M9.5 3h9.563M9.5 9h9.563M9.5 15h9.563M1.5 13a2 2 0 1 1 3.321 1.5L1.5 17h5m-5-15 2-1v6m-2 0h4"
                            />
                        </svg>
                        <!-- <span class="sr-only">center</span> -->
                    </button>

                    <button
                        @click="_method.bullets"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[17px] h-[17px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 17 10"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-width="1.4"
                                d="M6 1h10M6 5h10M6 9h10M1.49 1h.01m-.01 4h.01m-.01 4h.01"
                            />
                        </svg>
                        <!-- <span class="sr-only">center</span> -->
                    </button>

                    <input
                        id="nativeColorPicker1"
                        type="color"
                        value="#6590D5"
                        @blur="_method.backColor"
                    />

                    <input
                        id="nativeColorPicker2"
                        type="color"
                        value="#6590D5"
                        @blur="_method.FontColor"
                    />

                    <select @change="_method.fontnames">
                        <option value="Arial" selected>Arial</option>
                        <option value="Calibri">Calibri</option>
                        <option value="Comic Sans MS">Comic Sans MS</option>
                        <option value="Verdana">Verdana (sans-serif)</option>
                        <option value="Tahoma">Tahoma (sans-serif)</option>
                        <option value="Trebuchet MS">Trebuchet MS</option>
                        <option value="Times New Roman">Times New Roman</option>
                    </select>
                    <input
                        id="nativeColorPicker1"
                        type="color"
                        v-model="btnColor"
                        @blur="updateBtnColor(practice_instruction)"
                    />
                </div>
            </div>
        </div>
    </Teleport>
</template>
