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
        <table v-if="this.orders !== null" class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-blue-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Order DateTime
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Notes
                    </th>
                    <th scope="col" class="px-6 py-3">
                        UserID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        SupplierID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fulfilled
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id" class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ order.order_datetime }}
                    </td>
                    <td class="px-6 py-4">
                        {{ order.notes }}
                    </td>
                    <td class="px-6 py-4">
                        {{ order.user_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ order.supplier_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ order.created_at.replace("T", " ").slice(0, -5) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ order.fulfilled ? 'Yes' : 'No' }}
                    </td>
                    <td class="py-4 px-6 space-x-2">
                    <RouterLink
                        :to="{ name: 'EditOrder', params: { id: order.id } }"
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
                    <RouterLink
                        v-if="!order.fulfilled"
                        :to="{ name: 'EditOrder', params: { id: order.id } }"
                        class="
                        px-4
                        py-2
                        bg-green-500
                        hover:bg-green-600
                        text-white
                        rounded
                        "
                        >Fulfill</RouterLink
                    >
                    <button
                    @click="deleteOrder(order)"
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
            orders: null
        }
    },
    mounted() {
        this.getOrders();
    },
    methods: {
        getOrders() {
            axios.get("http://127.0.0.1:8080/api/orders")
                .then((response) => {
                    this.orders = response.data.data;
                });
        },
        async deleteOrder(order) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://127.0.0.1:8080/api/orders/" + order.id);
            this.orders = null;
            this.getOrders();
        }
    }
}
</script>

<style>

</style>