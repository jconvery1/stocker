<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">Brand Collection</span>
        <div class="flex justify-end">
            <span class="self-center text-l whitespace-nowrap mr-5">Add a new brand here!</span>
            <div>
                <input
                    v-model="newBrand.value"
                    type="text"
                    id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block mr-3"
                    required
                >
            </div>
            <button
                @click="addBrand(newBrand)"
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
            <button
                @click="$router.push({path: '/settings'})"
                type="submit"
                class="ml-6 text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
            >
                Cancel
            </button>
        </div>
    </div>
    <div class="relative overflow-x-auto">
        <div v-if="this.brands !== null">
            <table
                id="tableId"
                class="w-full text-sm text-left text-gray-500"
            >
                <thead class="text-xs text-gray-700 border uppercase bg-blue-50">
                    <tr>
                        <th scope="col" class="pl-4 py-3">
                            <div class="flex">
                                Name
                            </div>
                        </th>
                        <th scope="col" class="pl-4 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="brand in brands"
                        :key="brand.value"
                        class="bg-white border hover:bg-gray-50"
                    >
                        <td class="pl-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ brand.value }}
                        </td>
                        <td class="py-4 pl-4 space-x-2">
                        <button
                        @click="deleteBrand(brand)"
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
            <div class="flex flex-col items-center mt-2">
                <span v-if="brands.length == 0" class="text-sm text-gray-700 dark:text-gray-400">
                    No entries found
                </span>
            </div>
        </div>
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
            brands: null,
            tableId: 1,
            selectAll: false,
            newBrand: {
                dropdown_group: 'brand',
                value: null
            }
        }
    },
    mounted() {
        this.getBrands();
    },
    methods: {
        getBrands() {
            axios.get("http://127.0.0.1:8080/api/dropdown_group/brand")
                .then((response) => {
                    this.brands = response.data;
                    this.tableId++;
                });
        },
        async deleteBrand(brand) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://127.0.0.1:8080/api/dropdowns/" + brand.id);
            this.brands = null;
            this.getBrands();
        },
        async addBrand(brand) {
            try {
                await axios.post("http://127.0.0.1:8080/api/dropdowns", this.newBrand)
                this.newBrand = {
                    dropdown_group: 'brand',
                    value: null
                };
                this.brands = null;
                this.getBrands();
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