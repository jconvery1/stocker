<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">Material Collection</span>
        <div class="flex justify-end">
            <span class="self-center text-l whitespace-nowrap mr-5">Add a new material here!</span>
            <div>
                <input
                    v-model="newMaterial.value"
                    type="text"
                    id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block mr-3"
                    required
                >
            </div>
            <button
                @click="addMaterial(newMaterial)"
                class="
                px-2
                py-1
                bg-green-500
                hover:bg-green-600
                text-white
                rounded
                "
            >
                <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" fill-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
    <div class="relative overflow-x-auto">
        <table
            id="tableId"
            v-if="this.materials !== null"
            class="w-full text-sm text-left text-gray-500"
        >
            <thead class="text-xs text-gray-700 border uppercase bg-blue-50">
                <tr>
                    <th scope="col" class="pl-4 py-3">
                        <div class="flex items-center">
                            <input
                                v-model="selectAll"
                                id="checkbox-all-search"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2"
                            >
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="pl-4 py-3">
                        <div class="flex">
                            Name
                            <a href="#" class="w-2 h-3 ml-1 mt-[1.5px]">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                    <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                </svg>
                            </a>
                        </div>
                    </th>
                    <th scope="col" class="pl-4 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="material in materials"
                    :key="material.value"
                    class="bg-white border hover:bg-gray-50"
                >
                    <td class="pl-4 py-4">
                        <div class="flex items-center">
                            <input
                                v-model="material.checked"
                                id="checkbox-table-search-1"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2"
                            >
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="pl-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ material.value }}
                    </td>
                    <td class="py-4 pl-4 space-x-2">
                    <button
                    @click="deleteMaterial(material)"
                        class="
                            px-2
                            py-1
                            bg-red-500
                            hover:bg-red-700
                            text-white
                            rounded"
                    >
                        <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else class="grid min-h-screen place-content-center">
            <div class="flex items-center gap-2 text-gray-500">
            <span class="h-6 w-6 block rounded-full border-4 border-t-blue-300 animate-spin"></span>
            loading...
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            materials: null,
            tableId: 1,
            selectAll: false,
            newMaterial: {
                dropdown_group: 'material',
                value: null
            }
        }
    },
    mounted() {
        this.getMaterials();
    },
    methods: {
        getMaterials() {
            axios.get("http://127.0.0.1:8080/api/dropdown_group/material")
                .then((response) => {
                    this.materials = response.data;
                    this.tableId++;
                });
        },
        async deleteMaterial(material) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://127.0.0.1:8080/api/dropdowns/" + material.id);
            this.materials = null;
            this.getMaterials();
        },
        async addMaterial(material) {
            try {
                await axios.post("http://127.0.0.1:8080/api/dropdowns", this.newMaterial)
                this.newMaterial = {
                    dropdown_group: 'material',
                    value: null
                };
                this.materials = null;
                this.getMaterials();
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            }
        }
    }
}
</script>

<style>

</style>