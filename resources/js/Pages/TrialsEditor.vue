<style scoped>
.circle {
    margin: 10px;
    text-align: center;
    width: 50vmin;
}

.circle img {
    pointer-events: none;
    text-align: center;
}

.box {
    transform: translate(-50%, -50%);
    pointer-events: all;
}

img {
    text-align: center;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 1px solid #ccc;
    background: #f2f2f2;
}

.modal {
    resize: both;
    display: none;
    position: fixed;
    z-index: 1;
    overflow: auto;
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

#myModal {
    resize: both;
}

.img-size {
    height: 30vmin;
    width: 30vmin;
}

.rangvalue {
    padding: 5px;
}

.straightLine,
.hrLine {
    position: absolute;
    background-color: red;
}

.line_class {
    margin-top: -38%;
    transform: translate(-50%, -50%);
    width: 200vw;
    height: 1px;
    left: 0;
    position: fixed;
    background: blue;
}
</style>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import "flowbite";
import { onMounted, ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import axios from "axios";

const settings = useForm({
    width: null,
    height: null,
    primes: null,
    x: null,
    y: null,
});

const props = defineProps(["primes", "id"]);

const close = () => {
    var modal = document.querySelector(".modal");
    modal.style.display = "none";
};
onMounted(() => {
    initFlowbite();

    document.querySelectorAll(".circle").forEach((circle) => {
        circle.addEventListener("mousedown", (event2) => {
            const primeId = event2.target.getAttribute("Primeid");

            window.onmousemove = async (event) => {
                // console.log( event2.target.offsetWidth );
                var height = window.innerHeight;
                var width = window.innerWidth;
                var x = (event.clientX / width) * 100;
                var y = (event.clientY / height) * 100;

                event2.target.style.position = "fixed";
                event2.target.style.top = y + "%";
                event2.target.style.left = x + "%";
                event2.target.style.transform = "translate(-50%,-50%)";
                var Line = event2.target.querySelector(".line");
                var Line2 = event2.target.querySelector(".line2");

                Line.setAttribute(
                    "style",
                    "background:green; height:1vmin;     width: 300vw; padding:1px;  transform: translate(-50%, -50%); left: 0;position: fixed;  margin-top: -38%; z-index:1000;"
                );
                Line2.setAttribute(
                    "style",
                    "background:green; height:300vw;     width: 1vmin; padding:1px;  transform: translate(-50%, -50%); left: 30%;position: fixed;  margin-top: -38%; z-index:1000;"
                );
            };
            window.onmouseup = async (event) => {
                var Line = event2.target.querySelector(".line");
                var Line2 = event2.target.querySelector(".line2");
                Line.removeAttribute("style");
                Line2.removeAttribute("style");
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

                const res = await axios({
                    method: "post",
                    url: "/updateTrial",
                    data: {
                        primeid: primeId,
                        x: parseFloat(x),
                        y: parseFloat(y),
                    },
                });
            };
        });

        circle.addEventListener("click", (ev2) => {
            const primeId = ev2.target.getAttribute("Primeid");
            var input = document.createElement("input");
            input.type = "file";
            input.addEventListener("change", async (event) => {
                const res = await axios({
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                    method: "post",
                    url: "/uploadimages",
                    data: {
                        id: primeId,
                        images: event.target.files[0],
                    },
                });

                ev2.target.querySelector("img").src = res.data;
            });

            input.click();
        });
    });

    document.addEventListener("contextmenu", (event2) => {
        event2.preventDefault();
        const primeId = event2.target.getAttribute("Primeid");
        var modal = document.querySelector(".modal");
        modal.style.display = "inline-grid";
        settings.primes = event2.target.innerText;

        var inputWidthrange = document.createElement("input");

        inputWidthrange.type = "range";
        inputWidthrange.min = "0";
        inputWidthrange.max = "200";
        inputWidthrange.id = "rangeNumber";
        inputWidthrange.classList.add("rangvalue");
        var div = document.querySelector(".modalBody");

        inputWidthrange.addEventListener("change", (event) => {
            var rangeValue = event.target.value;
            inputWidthrange.value = rangeValue;
            event2.target.style.transform = "scale(" + rangeValue + "%)";
        });

        div.replaceChildren(inputWidthrange);
        var removeElement = document.createElement("button");
        removeElement.innerHTML = "Remove Element";
        removeElement.setAttribute(
            "class",
            "px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        );

        div.appendChild(removeElement);
        removeElement.addEventListener("click", async (event) => {
            event2.target.remove();
            const res = await axios({
                method: "delete",
                url: "/deleteTrial",
                data: {
                    id: primeId,
                },
            });
        });
    });
});

const addPrime = async (event2) => {
    let circleBody = document.getElementById("circleBody");
    var div = document.createElement("div");
    div.style.backgroundColor = "white";
    div.style.boxshadow = "3px 2px #888888";
    div.style.border = "1px solid";
    div.style.padding = "8px";
    div.style.height = "200px";
    div.style.width = "200px";
    div.style.borderRadius = "100%";
    div.className = "circle";
    div.contentEditable = true;
    div.innerHTML = "circle";

    // router.post( route( "addtrials", { project_id: props.id, id: props.id, prime: div.innerHTML } ), {
    //     preserveScroll: true,
    //     preserveState: true,
    //     onSuccess: () =>
    //     {
    //         e.target.value = "";
    //     },
    // } );

    const res = await axios({
        method: "post",
        url: "/addtrials",
        data: {
            project_id: props.id,
            prime: div.innerHTML,
        },
    });

    div.setAttribute("Primeid", res.data);
    circleBody.append(div);

    var input = document.createElement("input");
    input.type = "file";
    input.addEventListener("change", async (event) => {
        const res = await axios({
            headers: {
                "Content-Type": "multipart/form-data",
            },
            method: "post",
            url: "/uploadimages",
            data: {
                id: res.data,
                images: event2.target.files[0],
            },
        });
        event2.target.querySelector("img").src = res.data;
    });
    input.click();
};
</script>
<template>
    <div id="myModal" class="modal resize">
        <div class="modal-content">
            <button type="button" @click="close($event)" class="close">
                &times;
            </button>
            <label
                for="small-input"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Prime Value</label
            >
            <input
                type="text"
                v-model="settings.primes"
                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
            <label
                for="small-input"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Prime Circle Size</label
            >
            <div class="modalBody"></div>
        </div>
    </div>

    <AppLayout title="Trial Editor">
        <button
            @click="addPrime($event)"
            type="button"
            class="AddPrime text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 m-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"
        >
            Add Prime
        </button>

        <button
            @click="GenerateID"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 m-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"
        >
            Generate
        </button>
        <div class="circle">
            <div id="circleBody"></div>
        </div>

        <div
            class="circle"
            v-for="prime in props.primes"
            :Primeid="prime.id"
            :style="{
                transform: 'translate(-50%,-50%)',
                position: 'fixed',
                top: prime.y + '%',
                left: prime.x + '%',
            }"
        >
            <img
                class="object-contain h-100 w-100 img-size"
                :src="'././storage/images/' + prime.images"
            />
            {{ prime.primes }}

            <div class="line" :LineID="prime.id"></div>
            <div class="line2" :LineID="prime.id"></div>
        </div>
    </AppLayout>
</template>
