<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">Sale Collection</span>
        <router-link
            :to="{path: '/sales/add'}"
            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 sm:rounded-lg text-white"
        >
            Add Sale
        </router-link>
    </div>
    <div class="relative overflow-x-auto">
        <div v-if="this.sales !== null">
            <div class="p-2 bg-white">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input v-model="search" type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search by sale number">
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 border uppercase bg-blue-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex">
                                Sale Number
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created By
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Customer
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sale Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="sale in filteredResults" :key="sale.id" class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ sale.id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ sale.user_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ sale.customer_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ sale.created_at.replace("T", " ").slice(0, -11) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ '£' + sale.sale_price }}
                        </td>
                        <td class="py-4 px-6 space-x-2">
                        <button
                            @click="deleteSale(sale)"
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
                            @click="editSale(sale)"
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
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    Showing {{ sales.from }} to {{ sales.to }} of {{ sales.total }} Entries
                </span>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    <button v-if="sales.current_page > 1" @click="getSales(sales.current_page - 1)" class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded hover:bg-gray-900 m-1">
                        Prev
                    </button>
                    <button v-if="sales.current_page < sales.last_page" @click="getSales(sales.current_page + 1)" class="px-4 py-2 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded hover:bg-gray-900 m-1">
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
            sales: null,
            selectAll: false,
            search: null,
            allSales: null
        }
    },
    mounted() {
        this.getSales();
        this.getAllSales();
    },
    computed: {
        filteredResults() {
            if (!this.search) {
                return this.sales.data;
            }
            return this.allSales.filter((sale) => sale.id.toString().includes(this.search));
        }
    },
    methods: {
        getSales(page = 1) {
            axios.get(`http://127.0.0.1:8080/api/sales?page=${page}`)
                .then((response) => {
                    this.sales = Object.assign({}, response.data);
                });
        },
        getAllSales() {
            axios.get(`http://127.0.0.1:8080/api/all_sales`)
                .then((response) => {
                    this.allSales = response.data;
                });
        },
        async deleteSale(sale) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://127.0.0.1:8080/api/sales/" + sale.id);
            this.sales = null;
            this.getSales();
        },
        editSale(sale) {
            this.$router.push({name: 'EditSale', params: { id: sale.id } })
        }
    }
}
</script>

<style>

</style>