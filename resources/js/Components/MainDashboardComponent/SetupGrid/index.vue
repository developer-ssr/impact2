<template>
    <div class="bg-white">
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            <h4>Grids Settings</h4>
            <li class="pb-3 sm:pb-4">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <div class="flex-shrink-0"></div>

                    <div class="flex-1 min-w-0">
                        <br />
                        <p
                            class="text-sm font-medium text-gray-900 truncate dark:text-white"
                        >
                            Rows
                        </p>

                        <input class="truncate dark:text-white" type="text" />

                        <div class="flex-1 min-w-0">
                            <br />
                            <p
                                class="text-sm font-medium text-gray-900 truncate dark:text-white"
                            >
                                Columns
                            </p>

                            <input
                                class="truncate dark:text-white"
                                type="text"
                            />
                            <br /><button class="bg-blue-100 p-2 rounded-lg">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
