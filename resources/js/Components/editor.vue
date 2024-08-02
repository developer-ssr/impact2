<style>
[draggable="true"] {
    cursor: move;
}

#movableDiv {
    position: absolute;
    cursor: grab;
    resize: both;
}

.box {
    resize: both;
    pointer-events: none;
}

.display {
    display: none;
}
</style>
<script setup>
import { ref, onMounted } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import axios from "axios";

const htmlInput = ref();
const txtareadom = ref();
const textareaRenderDom = ref();
const Selectfontnames = ref();
const cssinput = ref();
const currentlanguage = ref();
const translatedlang = ref();
const x = ref(0);
const y = ref(0);
const rangedata = ref(0);
let isOpen = ref(false);

const fileimage = useForm({
    images: null,
});

const changedata = () => {
    const box = document.querySelector(".box");
    box.style.position = "relative";
    box.style.width = document.getElementById("rangedata").value + "vmin";
};
let count = ref(0);

const display = () => {
    isOpen = !isOpen;
    console.log(isOpen);
    let displayEditor = document.querySelector(".display");
    if (isOpen == false) {
        displayEditor.style.display = "none";
    } else {
        displayEditor.style.display = "grid";
    }
};
const numberlist = () => {
    document.execCommand("insertorderedlist");
};
const bullets = () => {
    document.execCommand("insertUnorderedList");
};
const incrementsize = () => {
    document.execCommand("fontSize", false, count.value++);
};
const decrementsize = () => {
    document.execCommand("fontSize", false, count.value--);
};
const backColor = () => {
    const backColordata = document.getElementById("nativeColorPicker1").value;
    document.execCommand("backColor", true, backColordata);
};

const FontColor = () => {
    const foreColordata = document.getElementById("nativeColorPicker2").value;
    document.execCommand("foreColor", false, foreColordata);
};
const createLink = () => {
    document.execCommand("createLink", false, "edit the link");
};
const bold = () => {
    console.log(htmlInput.value);
};

const changeimages = async () => {
    const image1 = document.getElementById("fileimage");
    const [file] = image1.files;
    fileimage.images = image1.files[0];

    const res = await axios({
        headers: {
            "Content-Type": "multipart/form-data",
        },
        method: "post",
        url: "/uploadimages",
        data: {
            images: fileimage.images,
        },
    });

    let wrappedselection = '<img src="' + res.data + '"/>';
    document.execCommand("insertHTML", false, wrappedselection);

    return false;
    // router.post( route( 'uploadimages', {
    //     onSu,
    //      data: {
    //         imagefile: image1.files[ 0 ],
    //     },
    // } ) );
    // const path = URL.createObjectURL( file );

    // const image = new Image();
    // image.crossOrigin = "anonymous";
    // image.onload = () =>
    // {
    //     const canvas = document.createElement( "canvas" );
    //     const ctx = canvas.getContext( "2d" );
    //     canvas.height = image.naturalHeight;
    //     canvas.width = image.naturalWidth;
    //     ctx.drawImage( image, 0, 0 );
    //     const dataUrl = canvas.toDataURL();
    //     let wrappedselection = '<img src="' + dataUrl + '"/>';

    //     document.execCommand( "insertHTML", false, wrappedselection );

    //     // document.execCommand("insertImage", true, dataUrl);
    // };
    // image.src = path;
};

const insertHTML = () => {
    let stylecode = prompt("Add Style Code");
    let selection = window.getSelection().toString();
    let basenode = window.getSelection().baseNode;

    // let wrappedselection =
    // '<div style="' + stylecode + '">' + selection + "</div>";

    if (!Object.hasOwn(basenode, "style")) {
        document.execCommand(
            "insertHTML",
            false,
            '<span style="' + stylecode + '">' + selection + "</span>"
        );
        // basenode.innerHTML = "<span>" + basenode.innerHTML + "</span>";
        // basenode.querySelector("figure").style.cssText = stylecode;
    } else {
        basenode.style.cssText = stylecode;
        basenode.remove();
        let clone = basenode.outerHTML;
        document.execCommand("insertHTML", false, clone);
    }
};

const undocom = () => {
    document.execCommand("undo", false, null);
};
const redocom = () => {
    document.execCommand("redo", false, "");
};
const justifyleft = () => {
    document.execCommand("justifyLeft", false, "");
};

const justifyRight = () => {
    window.execCommand("justifyRight", false, "");
};
const justifyCenter = () => {
    document.execCommand("justifyCenter", false, "");
};

const underline = () => {
    document.execCommand("underline", false, "");
};

const fontnames = () => {
    document.execCommand("fontName", false, Selectfontnames.value);
};

const removeformat = () => {
    document.execCommand("removeformat", false, "");
};
const contenteditor = () => {
    // removeEmptyParagraphs();
    if (htmlInput && typeof htmlInput.value === "string") {
        let currentHtml = htmlInput.value;
        currentHtml = currentHtml
            .replace(/<div>/g, "<p>")
            .replace(/<\/div>/g, "</p>");
        // removeEmptyParagraphs();
        htmlInput.value = currentHtml;
        currentHtml = textareaRenderDom.value.innerHTML;
    }
};

const insertParagraph = () => {
    document.execCommand("formatblock", false, "p");
};

onMounted(() => {
    // window.addEventListener("mousemove", update);

    textareaRenderDom.value.addEventListener("mouseleave", () => {
        if (htmlInput && typeof htmlInput.value === "string") {
            let currentHtml = htmlInput.value;
            currentHtml = currentHtml
                .replace(/<div>/g, "<p>")
                .replace(/<\/div>/g, "</p>");
            // removeEmptyParagraphs();
            htmlInput.value = currentHtml;
            currentHtml = textareaRenderDom.value.innerHTML;
        }
    });

    const mutations = new MutationObserver(function (entries) {
        htmlInput.value = textareaRenderDom.value.innerHTML;
    });

    txtareadom.value.addEventListener("mouseleave", () => {
        textareaRenderDom.value.innerHTML = txtareadom.value.value;
    });

    mutations.observe(textareaRenderDom.value, {
        subtree: true,
        attributes: true,
        childList: true,
        characterData: true,
        characterDataOldValue: true,
    });
    
});

const cssrender = () => {
    var style = document.createElement("style");
    if (document.querySelector("style[editorStyle='1']")) {
        style = document.querySelector("style[editorStyle='1']");
        style.innerHTML = cssinput.value;
    } else {
        style.type = "text/css";
        style.innerHTML = cssinput.value;
        style.setAttribute("editorStyle", "1");
        document.getElementsByTagName("head")[0].appendChild(style);
    }
};

const removeEmptyParagraphs = () => {
    const paragraphs = document.querySelectorAll("p");
    paragraphs.forEach(function (paragraph) {
        if (!paragraph.textContent.trim()) {
            paragraph.remove();
        }
    });
};

const translate = () => {
    let currnetLan = document.getElementById("selcurrentLang").value;
    let lang = document.getElementById("translateLanguageto").value;
    var sourceLang = currnetLan;
    var targetLang = lang;

    var url =
        "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" +
        sourceLang +
        "&tl=" +
        targetLang +
        "&dt=t&q=" +
        encodeURI(currentlanguage.value.innerHTML);
    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            translatedlang.value.innerHTML = data[0][0][0];
        })
        .catch((error) => {
            console.error("Error:", error);
        });
};

const translateInputHtml = () => {
    let sourceText = window.getSelection().toString();
    currentlanguage.value.innerHTML = sourceText;
};
const translateback = () => {
    var language = document.getElementById("translatedlang").value;
    document.execCommand("insertText", false, language);
};
</script>
<template>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div
            class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4"
        >
            <div class="flex items-center"></div>
        </div>
    </nav>

    <div class="display">
        <label
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            for="small_size"
            >Custom Css</label
        >
        <textarea
            v-model="cssinput"
            @mouseleave="cssrender"
            class="resize block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        ></textarea>

        <label
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            for="small_size"
            >Html Output</label
        >

        <textarea
            id="textoutput"
            ref="txtareadom"
            v-model="htmlInput"
            rows="4"
            class="resize block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        ></textarea>
    </div>

    <label
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        for="small_size"
    >
    </label>
    <div
        class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600"
    >
        <div
            class="flex items-center justify-between px-3 py-2 border-b dark:border-gray-600"
        >
            <div
                class="flex flex-wrap items-center divide-gray-200 sm:divide-x dark:divide-gray-600"
            >
                <button
                    @click="insertParagraph"
                    type="button"
                    class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                >
                    <svg
                        class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="17"
                        height="16"
                        fill="none"
                        viewBox="0 0 17 16"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.4"
                            d="M8.5 1v14m4.286-14v14M16 1H4.75a3.89 3.89 0 0 0-2.652 1.025A3.386 3.386 0 0 0 1 4.5c0 .928.395 1.819 1.098 2.475A3.89 3.89 0 0 0 4.75 8H8.5"
                        />
                    </svg>
                    <!-- <span class="sr-only">center</span> -->
                </button>
                <div class="flex items-center space-x-1 sm:pr-4">
                    <button
                        @click="decrementsize"
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
                        @click="incrementsize"
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
                        @click="underline"
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
                        @click="createLink"
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
                            @click="undocom"
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
                </div>
                <div class="flex flex-wrap items-center space-x-1 sm:pl-4">
                    <button
                        @click="redocom"
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
                        @click="justifyleft"
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
                        @click="justifyRight"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-6 h-6"
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
                        @click="justifyCenter"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[20px] h-[20px] text-gray-800 dark:text-white"
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
                        <!-- <span class="sr-only">center</span> -->
                    </button>

                    <button
                        @click="numberlist"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[20px] h-[20px] text-gray-800 dark:text-white"
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
                        @click="bullets"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[20px] h-[20px] text-gray-800 dark:text-white"
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

                    <button
                        @click="insertHTML"
                        type="button"
                        class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        <svg
                            class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M.906 0 2.5 17.683l7.5 2.159 7.544-2.158L19.092 0H.906ZM15.1 6H7.044l.174 2h7.776l-.632 6.513-4.29 1.371-4.326-1.444-.29-2.909H7.5l.163 1.4 2.424.809 2.37-.757.3-2.982H5.368L4.8 4h10.519L15.1 6Z"
                            />
                        </svg>
                        <!-- <span class="sr-only">center</span> -->
                    </button>

                    <button
                        @click="removeformat"
                        type="button"
                        class="bg-gray p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                    >
                        Remove Format
                        <!-- <span class="sr-only">center</span> -->
                    </button>
                </div>

                <label>Back Color</label>
                <div class="flex justify-center space-x-2">
                    <input
                        id="nativeColorPicker1"
                        type="color"
                        value="#6590D5"
                        @change="backColor"
                    />
                </div>

                <label>Font Color</label>
                <div class="flex justify-center space-x-2">
                    <input
                        id="nativeColorPicker2"
                        type="color"
                        value="#6590D5"
                        @change="FontColor"
                    />
                </div>
                Font Name
                <select @change="fontnames" v-model="Selectfontnames">
                    <option value="Arial" selected>Arial</option>
                    <option value="Calibri">Calibri</option>
                    <option value="Comic Sans MS">Comic Sans MS</option>
                    <option value="Verdana">Verdana (sans-serif)</option>
                    <option value="Tahoma">Tahoma (sans-serif)</option>
                    <option value="Trebuchet MS">Trebuchet MS</option>
                    <option value="Times New Roman">Times New Roman</option>
                </select>

                <button
                    @click="translateInputHtml"
                    data-modal-target="extralarge-modal"
                    data-modal-toggle="extralarge-modal"
                    class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                    type="button"
                >
                    Translate
                </button>

                <button
                    @click="display"
                    class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button"
                >
                    Show Custom Additional Editor
                </button>

                <!-- Extra Large Modal -->
                <div
                    id="extralarge-modal"
                    tabindex="-1"
                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
                >
                    <div class="relative w-full max-w-7xl max-h-full">
                        <!-- Modal content -->
                        <div
                            class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                        >
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600"
                            >
                                <h3
                                    class="text-xl font-medium text-gray-900 dark:text-white"
                                >
                                    Translation Modal
                                </h3>
                                <button
                                    type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="extralarge-modal"
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
                            </div>
                            <!-- Modal body@change="translate" -->
                            <div class="p-6 space-y-6">
                                Select current language
                                <select id="selcurrentLang">
                                    <option value="en" selected>
                                        Default(US Standard English)
                                    </option>
                                    <option value="af">Afrikaans</option>
                                    <option value="sq">Albanian</option>
                                    <option value="am">Amharic</option>
                                    <option value="ar">Arabic</option>
                                    <option value="hy">Armenian</option>
                                    <option value="az">Azerbaijani</option>
                                    <option value="eu">Basque</option>
                                    <option value="be">Belarusian</option>
                                    <option value="bn">Bengali</option>
                                    <option value="bs">Bosnian</option>
                                    <option value="bg">Bulgarian</option>
                                    <option value="ca">Catalan</option>
                                    <option value="ceb">Cebuano</option>
                                    <option value="zh-CN">
                                        Chinese (Simplified)
                                    </option>
                                    <option value="zh-TW">
                                        Chinese (Traditional)
                                    </option>
                                    <option value="co">Corsican</option>
                                    <option value="hr">Croatian</option>
                                    <option value="cs">Czech</option>
                                    <option value="da">Danish</option>
                                    <option value="nl">Dutch</option>
                                    <option value="en">English</option>
                                    <option value="eo">Esperanto</option>
                                    <option value="et">Estonian</option>
                                    <option value="fi">Finnish</option>
                                    <option value="fr">French</option>
                                    <option value="fy">Frisian</option>
                                    <option value="gl">Galician</option>
                                    <option value="ka">Georgian</option>
                                    <option value="de">German</option>
                                    <option value="el">Greek</option>
                                    <option value="gu">Gujarati</option>
                                    <option value="ht">Haitian Creole</option>
                                    <option value="ha">Hausa</option>
                                    <option value="haw">Hawaiian</option>
                                    <option value="iw">Hebrew</option>
                                    <option value="hi">Hindi</option>
                                    <option value="hmn">Hmong</option>
                                    <option value="hu">Hungarian</option>
                                    <option value="is">Icelandic</option>
                                    <option value="ig">Igbo</option>
                                    <option value="id">Indonesian</option>
                                    <option value="ga">Irish</option>
                                    <option value="it">Italian</option>
                                    <option value="ja">Japanese</option>
                                    <option value="jw">Javanese</option>
                                    <option value="kn">Kannada</option>
                                    <option value="kk">Kazakh</option>
                                    <option value="km">Khmer</option>
                                    <option value="ko">Korean</option>
                                    <option value="ku">Kurdish</option>
                                    <option value="ky">Kyrgyz</option>
                                    <option value="lo">Lao</option>
                                    <option value="la">Latin</option>
                                    <option value="lv">Latvian</option>
                                    <option value="lt">Lithuanian</option>
                                    <option value="lb">Luxembourgish</option>
                                    <option value="mk">Macedonian</option>
                                    <option value="mg">Malagasy</option>
                                    <option value="ms">Malay</option>
                                    <option value="ml">Malayalam</option>
                                    <option value="mt">Maltese</option>
                                    <option value="mi">Maori</option>
                                    <option value="mr">Marathi</option>
                                    <option value="mn">Mongolian</option>
                                    <option value="my">
                                        Myanmar (Burmese)
                                    </option>
                                    <option value="ne">Nepali</option>
                                    <option value="no">Norwegian</option>
                                    <option value="ny">
                                        Nyanja (Chichewa)
                                    </option>
                                    <option value="ps">Pashto</option>
                                    <option value="fa">Persian</option>
                                    <option value="pl">Polish</option>
                                    <option value="pt">
                                        Portuguese (Portugal, Brazil)
                                    </option>
                                    <option value="pa">Punjabi</option>
                                    <option value="ro">Romanian</option>
                                    <option value="ru">Russian</option>
                                    <option value="sm">Samoan</option>
                                    <option value="gd">Scots Gaelic</option>
                                    <option value="sr">Serbian</option>
                                    <option value="st">Sesotho</option>
                                    <option value="sn">Shona</option>
                                    <option value="sd">Sindhi</option>
                                    <option value="si">
                                        Sinhala (Sinhalese)
                                    </option>
                                    <option value="sk">Slovak</option>
                                    <option value="sl">Slovenian</option>
                                    <option value="so">Somali</option>
                                    <option value="es">Spanish</option>
                                    <option value="su">Sundanese</option>
                                    <option value="sw">Swahili</option>
                                    <option value="sv">Swedish</option>
                                    <option value="tl">
                                        Tagalog (Filipino)
                                    </option>
                                    <option value="tg">Tajik</option>
                                    <option value="ta">Tamil (India)</option>
                                    <option value="te">Telugu (India)</option>
                                    <option value="th">Thai</option>
                                    <option value="tr">Turkish</option>
                                    <option value="uk">Ukrainian</option>
                                    <option value="ur">Urdu</option>
                                    <option value="uz">Uzbek</option>
                                    <option value="vi">Vietnamese</option>
                                    <option value="cy">Welsh</option>
                                    <option value="xh">Xhosa</option>
                                    <option value="yi">Yiddish</option>
                                    <option value="yo">Yoruba</option>
                                    <option value="zu">Zulu</option>
                                </select>

                                <textarea
                                    ref="currentlanguage"
                                    id="currentlanguage"
                                    rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                ></textarea>
                                Translate language to
                                <select
                                    id="translateLanguageto"
                                    @change="translate"
                                >
                                    <option value="af">Afrikaans</option>
                                    <option value="sq">Albanian</option>
                                    <option value="am">Amharic</option>
                                    <option value="ar">Arabic</option>
                                    <option value="hy">Armenian</option>
                                    <option value="az">Azerbaijani</option>
                                    <option value="eu">Basque</option>
                                    <option value="be">Belarusian</option>
                                    <option value="bn">Bengali</option>
                                    <option value="bs">Bosnian</option>
                                    <option value="bg">Bulgarian</option>
                                    <option value="ca">Catalan</option>
                                    <option value="ceb">Cebuano</option>
                                    <option value="zh-CN">
                                        Chinese (Simplified)
                                    </option>
                                    <option value="zh-TW">
                                        Chinese (Traditional)
                                    </option>
                                    <option value="co">Corsican</option>
                                    <option value="hr">Croatian</option>
                                    <option value="cs">Czech</option>
                                    <option value="da">Danish</option>
                                    <option value="nl">Dutch</option>
                                    <option value="en">English</option>
                                    <option value="eo">Esperanto</option>
                                    <option value="et">Estonian</option>
                                    <option value="fi">Finnish</option>
                                    <option value="fr">French</option>
                                    <option value="fy">Frisian</option>
                                    <option value="gl">Galician</option>
                                    <option value="ka">Georgian</option>
                                    <option value="de">German</option>
                                    <option value="el">Greek</option>
                                    <option value="gu">Gujarati</option>
                                    <option value="ht">Haitian Creole</option>
                                    <option value="ha">Hausa</option>
                                    <option value="haw">Hawaiian</option>
                                    <option value="iw">Hebrew</option>
                                    <option value="hi">Hindi</option>
                                    <option value="hmn">Hmong</option>
                                    <option value="hu">Hungarian</option>
                                    <option value="is">Icelandic</option>
                                    <option value="ig">Igbo</option>
                                    <option value="id">Indonesian</option>
                                    <option value="ga">Irish</option>
                                    <option value="it">Italian</option>
                                    <option value="ja">Japanese</option>
                                    <option value="jw">Javanese</option>
                                    <option value="kn">Kannada</option>
                                    <option value="kk">Kazakh</option>
                                    <option value="km">Khmer</option>
                                    <option value="ko">Korean</option>
                                    <option value="ku">Kurdish</option>
                                    <option value="ky">Kyrgyz</option>
                                    <option value="lo">Lao</option>
                                    <option value="la">Latin</option>
                                    <option value="lv">Latvian</option>
                                    <option value="lt">Lithuanian</option>
                                    <option value="lb">Luxembourgish</option>
                                    <option value="mk">Macedonian</option>
                                    <option value="mg">Malagasy</option>
                                    <option value="ms">Malay</option>
                                    <option value="ml">Malayalam</option>
                                    <option value="mt">Maltese</option>
                                    <option value="mi">Maori</option>
                                    <option value="mr">Marathi</option>
                                    <option value="mn">Mongolian</option>
                                    <option value="my">
                                        Myanmar (Burmese)
                                    </option>
                                    <option value="ne">Nepali</option>
                                    <option value="no">Norwegian</option>
                                    <option value="ny">
                                        Nyanja (Chichewa)
                                    </option>
                                    <option value="ps">Pashto</option>
                                    <option value="fa">Persian</option>
                                    <option value="pl">Polish</option>
                                    <option value="pt">
                                        Portuguese (Portugal, Brazil)
                                    </option>
                                    <option value="pa">Punjabi</option>
                                    <option value="ro">Romanian</option>
                                    <option value="ru">Russian</option>
                                    <option value="sm">Samoan</option>
                                    <option value="gd">Scots Gaelic</option>
                                    <option value="sr">Serbian</option>
                                    <option value="st">Sesotho</option>
                                    <option value="sn">Shona</option>
                                    <option value="sd">Sindhi</option>
                                    <option value="si">
                                        Sinhala (Sinhalese)
                                    </option>
                                    <option value="sk">Slovak</option>
                                    <option value="sl">Slovenian</option>
                                    <option value="so">Somali</option>
                                    <option value="es">Spanish</option>
                                    <option value="su">Sundanese</option>
                                    <option value="sw">Swahili</option>
                                    <option value="sv">Swedish</option>
                                    <option value="tl">
                                        Tagalog (Filipino)
                                    </option>
                                    <option value="tg">Tajik</option>
                                    <option value="ta">Tamil (India)</option>
                                    <option value="te">Telugu (India)</option>
                                    <option value="th">Thai</option>
                                    <option value="tr">Turkish</option>
                                    <option value="uk">Ukrainian</option>
                                    <option value="ur">Urdu</option>
                                    <option value="uz">Uzbek</option>
                                    <option value="vi">Vietnamese</option>
                                    <option value="cy">Welsh</option>
                                    <option value="xh">Xhosa</option>
                                    <option value="yi">Yiddish</option>
                                    <option value="yo">Yoruba</option>
                                    <option value="zu">Zulu</option>
                                </select>

                                <textarea
                                    id="translatedlang"
                                    ref="translatedlang"
                                    rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                ></textarea>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                            >
                                <button
                                    @click="translateback"
                                    data-modal-hide="extralarge-modal"
                                    type="button"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                                >
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800 container mx-auto"
        >
            <input
                class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                type="file"
                id="fileimage"
                @change="changeimages"
            />

            <div
                class="content border-double border-2 border-indigo-600"
                ref="textareaRenderDom"
                contenteditable="true"
                @keyup.enter="contenteditor"
            ></div>
        </div>
    </div>
</template>
