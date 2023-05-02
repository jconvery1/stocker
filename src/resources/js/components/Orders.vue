<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">Order Collection</span>
        <router-link
            :to="{path: '/orders/add'}"
            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 sm:rounded-lg text-white"
        >
            Add Order
        </router-link>
    </div>
    <div class="relative overflow-x-auto">
        <div v-if="this.orders !== null">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 border uppercase bg-blue-50">
                    <tr>
                        <th scope="col" class="pl-6 py-3">
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
                        <th scope="col" class="pl-6 py-3">
                            <div class="flex">
                                Order Number
                                <a href="#" class="w-2 h-3 ml-1 mt-[1.5px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                        <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                    </svg>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="pl-6 py-3">
                            Order DateTime
                        </th>
                        <th scope="col" class="pl-6 py-3">
                            Notes
                        </th>
                        <th scope="col" class="pl-6 py-3">
                            Supplier
                        </th>
                        <th scope="col" class="pl-6 py-3">
                            Created By
                        </th>
                        <th scope="col" class="pl-6 py-3">
                            Created At
                        </th>
                        <th scope="col" class="pl-6 py-3">
                            Fulfilled
                        </th>
                        <th scope="col" class="pl-6 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders.data" :key="order.id" class="bg-white border-b hover:bg-gray-50">
                        <td class="pl-6 py-4">
                            <div class="flex items-center">
                                <input
                                    v-model="order.checked"
                                    id="checkbox-table-search-1"
                                    type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2"
                                >
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ order.id }}
                        </td>
                        <td class="pl-6 py-4">
                            {{ order.order_datetime }}
                        </td>
                        <td class="pl-6 py-4">
                            {{ order.notes }}
                        </td>
                        <td class="pl-6 py-4">
                            {{ order.supplier_name }}
                        </td>
                        <td class="pl-6 py-4">
                            {{ order.user_name }}
                        </td>
                        <td class="pl-6 py-4">
                            {{ order.created_at.replace("T", " ").slice(0, -11) }}
                        </td>
                        <td class="pl-6 py-4">
                            {{ order.fulfilled ? 'Yes' : 'No' }}
                        </td>
                        <td class="py-4 pl-6 space-x-2">
                        <button
                            @click="deleteOrder(order)"
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
                            @click="editOrder(order)"
                            v-if="!order.fulfilled"
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
                        </button
                        >
                        <button
                            @click="fulfillOrder(order)"
                            v-if="!order.fulfilled"
                            class="
                            px-2
                            py-1
                            bg-green-500
                            hover:bg-green-600
                            text-white
                            rounded"
                        >
                            <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex flex-col items-center mt-2">
                <!-- Help text -->
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    Showing {{ orders.from }} to {{ orders.to }} of {{ orders.total }} Entries
                </span>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    <button v-if="orders.current_page > 1" @click="getOrders(orders.current_page - 1)" class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded hover:bg-gray-900 m-1">
                        Prev
                    </button>
                    <button v-if="orders.current_page < orders.last_page" @click="getOrders(orders.current_page + 1)" class="px-4 py-2 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded hover:bg-gray-900 m-1">
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
            orders: null,
            selectAll: false
        }
    },
    mounted() {
        this.getOrders();
    },
    methods: {
        getOrders(page = 1) {
            axios.get(`http://127.0.0.1:8080/api/orders?page=${page}`)
                .then((response) => {
                    this.orders = Object.assign({}, response.data);
                });
        },
        async deleteOrder(order) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://127.0.0.1:8080/api/orders/" + order.id);
            this.orders = null;
            this.getOrders();
        },
        async fulfillOrder(order) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.post("http://127.0.0.1:8080/api/orders/fulfill_order/" + order.id);
            this.orders = null;
            this.getOrders();
        },
        editOrder(order) {
            this.$router.push({name: 'EditOrder', params: { id: order.id } })
        }
    }
}
</script>

<style>

</style>