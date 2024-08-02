export default {
    config: {
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
                "--componentY": null,
                "--componentX": null,
                "--componentW": null,
                "--componentH": null,
                "--componentBG": "transparent",
                "--componentFontColor": "black",
                "--componentFontSize": null,
            },
        },
        settings: {
            response: {
                urlAppend: false,
                variable: "",
            },
            pairwiseTargets: false,
            practiceTrial: {
                enable: true,
                primes: 1,
                retrial: {
                    enable: true,
                    average: true,
                },
                firstTrialDelay: 1,
            },
            mainTrial: {
                enable: true,
                blocks: 1,
                breaks: 0,
                retrial: {
                    enable: true,
                    average: true,
                },
                firstTrialDelay: 1,
            },
        },
        instructions: {
            practiceTrial: {
                message:
                    "<h1>INSTRUCTIONS</h1>This test measures how you feel about the products.<br>Your job is to drag and drop the word to the product that you think fits best.<br>Let's do some practice. click start when you're ready to begin.",
                button: "Start",
            },
            mainTrial: {
                message:
                    "<h1>WELL DONE!</h1>Just do the same for the main trials. Click start when you're ready to begin.",
                button: "Start",
            },
            blockBreaks: {
                message: "Press <strong>NEXT</strong> to continue",
                button: "Next",
            },
        },
        warnings: {
            practiceRetrial: {
                message: "<h1>WARNING</h1>Please react faster.",
                button: "Try Again",
            },
            mainRetrial: {
                message: "<h1>WARNING</h1>Please react faster.",
                button: "Continue",
            },
            qualityControl: {
                message:
                    "<h1>SORRY</h1>Your response time too slow. Would you like to take the test again?",
                button: "Yes",
                button2: "No",
            },
        },
        others: {
            loading: "Loading...",
            saving: "Saving...",
            savingFail:
                "Unable to connect with server. Please check your internet connection.",
            redirect: "Preparing the next part...",
            practiceBlockLabel: "Practice Trail",
            mainBlockLabel: "Main Trial",
        },
        custom: {
            style: "",
            js: "",
        },
    },
    primes: [
        {
            id: 1,
            name: "Prime 1",
            equivalent: "Prime 1",
            value: 1,
            valence: 1,
            dimension: 1,
            active: 1,
            style: {
                "--componentY": null,
                "--componentX": null,
                "--componentW": null,
                "--componentH": null,
                "--componentBG": null,
                "--componentFontColor": "black",
                "--componentFontSize": null,
            },
        },
        {
            id: 2,
            name: "Prime 2",
            equivalent: "Prime 2",
            value: 2,
            valence: 1,
            valence: 1,
            dimension: 1,
            active: 0,
            style: {
                "--componentY": null,
                "--componentX": null,
                "--componentW": null,
                "--componentH": null,
                "--componentBG": null,
                "--componentFontColor": "black",
                "--componentFontSize": null,
            },
        },
    ],

    targets: [
        {
            id: 1,
            class: "draggable",
            name: "Target 1",
            equivalent: "Target 1",
            value: 1,
            style: {
                "--componentY": null,
                "--componentX": null,
                "--componentW": null,
                "--componentH": null,
                "--componentBG": null,
                "--componentFontColor": "black",
                "--componentFontSize": null,
            },
        },

        {
            id: 2,
            class: "draggable",
            name: "Target 2",
            equivalent: "Target 2",
            value: 2,
            style: {
                "--componentY": null,
                "--componentX": null,
                "--componentW": null,
                "--componentH": null,
                "--componentBG": null,
                "--componentFontColor": "black",
                "--componentFontSize": null,
            },
        },
    ],
};
