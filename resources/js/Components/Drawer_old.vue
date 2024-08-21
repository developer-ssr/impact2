<script setup>
import { router, useForm } from "@inertiajs/vue3";
import { reactive } from "vue";
import { provide, inject } from "vue";
const props = inject("props");

const form = useForm({
    folder_name: null,
    uuid: null,
    quadrants: {
        quadrant1: {
            style: {
                rows: 1,
                bgColor: null,
                class: "quadrants",
            },
            keys: "E",
            rows: 1,
            column: 3,
        },

        quadrant2: {
            style: {
                rows: 1,
                bgColor: null,
                class: "quadrants",
            },
            keys: "O",
            rows: 1,
            column: 3,
        },

        quadrant3: {
            style: {
                rows: 1,
                bgColor: null,
                class: "quadrants",
            },
            keys: "C",
            rows: 1,
            column: 3,
        },

        quadrant4: {
            style: {
                rows: 1,
                bgColor: null,
                class: "quadrants",
            },
            keys: "M",
            rows: 1,
            column: 3,
        },
    },

    settings: {
        pageTitle: "",
        header: {
            content: "HEADER HERE....",
            style: {
                "--componentY": null,
                "--componentX": null,
                "--componentW": null,
                "--componentH": null,
                "--componentBG": "transparent",
                "--componentFontColor": "black",
                "--componentFontSize": null,
            },
        },
        footer: {
            content: "FOOTER HERE....",
            style: {
                "--componentY": "50%",
                "--componentX": "50%",
                "--componentW": null,
                "--componentH": null,
                "--componentBG": "transparent",
                "--componentFontColor": "black",
                "--componentFontSize": null,
            },
        },
        instruction: {
            practice_instruction: {
                title: "Practice Instructions",
                message:
                    "INSTRUCTIONS This test measures how you feel about the products.Your job is to drag and drop the word to the product that you think fits best.Let's do some practice. click start when you're ready to begin.",
                button: "Start",
                warnings: "<h1>WARNING</h1>Please react faster.",
                loading: "Loading...",
                saving: "Saving...",
                savingFail:
                    "Unable to connect with server. Please check your internet connection.",
                redirect: "Preparing the next part...",

                style: {
                    "--componentY": "50%",
                    "--componentX": "50%",
                    "--componentW": null,
                    "--componentH": null,
                    "--componentBG": "transparent",
                    "--componentFontColor": "black",
                    "--componentFontSize": null,
                },
                target: {
                    img: "",
                    name: "",
                    img: "",
                    height: "",
                    width: "",
                    countdown: "",
                },

                quadrants: {
                    quadrant1: {
                        style: {
                            rows: 1,
                            bgColor: null,
                            class: "quadrants",
                        },
                        keys: "E",
                        rows: 1,
                        column: 3,
                    },

                    quadrant2: {
                        style: {
                            rows: 1,
                            bgColor: null,
                            class: "quadrants",
                        },
                        keys: "O",
                        rows: 1,
                        column: 3,
                    },

                    quadrant3: {
                        style: {
                            rows: 1,
                            bgColor: null,
                            class: "quadrants",
                        },
                        keys: "C",
                        rows: 1,
                        column: 3,
                    },

                    quadrant4: {
                        style: {
                            rows: 1,
                            bgColor: null,
                            class: "quadrants",
                        },
                        keys: "M",
                        rows: 1,
                        column: 3,
                    },
                },
            },

            main_instruction: {
                title: "Main Instructions",
                message:
                    "WELL DONE!Just do the same for the main trials. Click start when you're ready to begin.",
                button: "Start",
                warnings: "<h1>WARNING</h1>Please react faster.",
                loading: "Loading...",
                saving: "Saving...",
                savingFail:
                    "Unable to connect with server. Please check your internet connection.",
                redirect: "Preparing the next part...",
                target: {
                    img: "",
                    name: "",
                    img: "",
                    height: "",
                    width: "",
                    countdown: "",
                },

                style: {
                    "--componentY": "50%",
                    "--componentX": "50%",
                    "--componentW": null,
                    "--componentH": null,
                    "--componentBG": "red",
                    "--componentFontColor": "black",
                    "--componentFontSize": null,
                },
                quadrants: {
                    quadrant1: {
                        style: {
                            rows: 1,
                            bgColor: null,
                            class: "quadrants",
                        },
                        keys: "E",
                        rows: 1,
                        column: 3,
                    },

                    quadrant2: {
                        style: {
                            rows: 1,
                            bgColor: null,
                            class: "quadrants",
                        },
                        keys: "O",
                        rows: 1,
                        column: 3,
                    },

                    quadrant3: {
                        style: {
                            rows: 1,
                            bgColor: null,
                            class: "quadrants",
                        },
                        keys: "C",
                        rows: 1,
                        column: 3,
                    },

                    quadrant4: {
                        style: {
                            rows: 1,
                            bgColor: null,
                            class: "quadrants",
                        },
                        keys: "M",
                        rows: 1,
                        column: 3,
                    },
                },
            },

            qualityControl: {
                message:
                    "<h1>SORRY</h1>Your response time too slow. Would you like to take the test again?",
                button: "Yes",
                button2: "No",
            },
        },

        ladybug: {
            name: "",
            img: "",
            height: "",
            width: "",
            countdown: "",
        },

        custom: {
            style: "",
            js: "",
        },
    },
});

const save = () => {
    form.post(props.props.menu.save, {
        onSuccess: (success) => {
            console.log(success);
        },
        onError: (errors) => {
            console.log(errors);
        },
    });
};
</script>
<template>
    <div
        id="drawer-right-example"
        class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1"
        aria-labelledby="drawer-right-label"
    >
        <h5
            id="drawer-right-label"
            class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"
        >
            <svg
                class="w-4 h-4 me-2.5"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                />
            </svg>
        </h5>


        <div class="grid grid-cols-2 gap-4">
            <label
                >{{ props.props.menu.placeholder }}
                <input
                    type="text"
                    v-model="form.folder_name"
                    @keyup.enter="save()"
                />
            </label>
        </div>
    </div>
</template>
