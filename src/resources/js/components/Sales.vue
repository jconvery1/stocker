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
        <table v-if="this.sales !== null" class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-blue-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        CustomerID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sale Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        UserID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="sale in sales" :key="sale.id" class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ sale.customer_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ sale.sale_price }}
                    </td>
                    <td class="px-6 py-4">
                        {{ sale.user_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ sale.created_at.replace("T", " ").slice(0, -5) }}
                    </td>
                    <td class="py-4 px-6 space-x-2">
                    <RouterLink
                        :to="{ name: 'EditSale', params: { id: sale.id } }"
                        class="
                        px-4
                        py-2
                        bg-blue-500
                        hover:bg-blue-600
                        text-white
                        rounded
                        "
                        >Edit</RouterLink
                    >
                    <button
                        class="
                            px-4
                            py-2
                            bg-red-500
                            hover:bg-red-700
                            text-white
                            rounded"
                    >
                        Delete
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
            sales: null
        }
    },
    mounted() {
        this.getSales();
    },
    methods: {
        getSales() {
            axios.get("http://127.0.0.1:8080/api/sales")
                .then((response) => {
                    this.sales = response.data.data;
                });
        }
    }
}
</script>

<style>

</style>