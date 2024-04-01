<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">Supplier Collection</span>
        <router-link
            :to="{path: '/suppliers/add'}"
            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 sm:rounded-lg text-white"
        >
            Add Supplier
        </router-link>
    </div>
    <div class="relative overflow-x-auto">
        <div v-if="this.suppliers !== null">
            <div class="p-2 bg-white">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input v-model="search" type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search by supplier name">
                </div>
            </div>
            <table
                id="tableId"
                class="w-full text-sm text-left text-gray-500"
            >
                <thead class="text-xs text-gray-700 border uppercase bg-blue-50">
                    <tr>
                        <th scope="col" class="pl-4 py-3">
                            <div class="flex">
                                Supplier Number
                            </div>
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Name
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Email
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Phone
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Address
                        </th>
                        <th scope="col" class="pl-4 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="supplier in filteredResults"
                        :key="supplier.id"
                        class="bg-white border hover:bg-gray-50"
                    >
                        <td class="pl-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ supplier.id }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ supplier.name }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ supplier.email }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ supplier.phone_number }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ supplier.address }}
                        </td>
                        <td class="py-4 pl-4 space-x-2">
                        <button
                        @click="deleteSupplier(supplier)"
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
                        <button
                            @click="editSupplier(supplier)"
                            class="
                            px-2
                            py-1
                            bg-blue-500
                            hover:bg-blue-600
                            text-white
                            rounded
                            "
                        >
                            <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex flex-col items-center mt-2">
                <!-- Help text -->
                <span v-if="suppliers.from" class="text-sm text-gray-700 dark:text-gray-400">
                    Showing {{ suppliers.from }} to {{ suppliers.to }} of {{ suppliers.total }} Entries
                </span>
                <span v-else class="text-sm text-gray-700 dark:text-gray-400">
                    No entries found
                </span>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    <button v-if="suppliers.current_page > 1" @click="getSuppliers(suppliers.current_page - 1)" class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded hover:bg-gray-900 m-1">
                        Prev
                    </button>
                    <button v-if="suppliers.current_page < suppliers.last_page" @click="getSuppliers(suppliers.current_page + 1)" class="px-4 py-2 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded hover:bg-gray-900 m-1">
                        Next
                    </button>
                </div>
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
            suppliers: null,
            tableId: 1,
            selectAll: false,
            search: null,
            allSuppliers: null
        }
    },
    mounted() {
        this.getSuppliers();
        this.getAllSuppliers();
    },
    computed: {
        filteredResults() {
            if (!this.search) {
                return this.suppliers?.data || [];
            }
            return (this.allSuppliers || []).filter(supplier => supplier.name.includes(this.search));
        }
    },
    methods: {
        getSuppliers(page = 1) {
            axios.get(`http://localhost:8888/api/suppliers?page=${page}`)
                .then((response) => {
                    this.suppliers = response.data;
                    this.tableId++;
                }).catch((error) => {
                    console.log(error);
                });
        },
        getAllSuppliers() {
            axios.get(`http://localhost:8888/api/supplier_dropdown`)
                .then((response) => {
                    this.allSuppliers = response.data;
                    this.tableId++;
                }).catch((error) => {
                    console.log(error);
                });
        },
        async deleteSupplier(supplier) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://localhost:8888/api/suppliers/" + supplier.id);
            window.location.reload();
        },
        editSupplier(supplier) {
            this.$router.push({name: 'EditSupplier', params: { id: supplier.id } })
        }
    }
}
</script>

<style>

</style>
