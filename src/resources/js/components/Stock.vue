<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">Stock Collection</span>
        <router-link
            :to="{path: '/stock/add'}"
            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 sm:rounded-lg text-white"
        >
            Add Stock Item
        </router-link>
    </div>
    <div class="relative overflow-x-auto">
        <table
            id="tableId"
            v-if="this.stockItems !== null"
            class="w-full text-sm text-left text-gray-500"
        >
            <thead class="text-xs text-gray-700 uppercase bg-blue-50">
                <tr>
                    <th scope="col" class="pl-6 py-3">
                        Stock Number
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Supplier
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Gender
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Brand
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Colour
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Size
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Material
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="pl-6 py-3">
                        Stock Level
                    </th>
                    <th scope="col" class="pl-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="stockItem in stockItems"
                    :key="stockItem.id"
                    class="bg-white border-b hover:bg-gray-50"
                >
                    <td class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ stockItem.id }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ stockItem.name }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ stockItem.supplier_name }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ '£' + stockItem.price }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ stockItem.gender }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ stockItem.brand }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ stockItem.colour }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ stockItem.shoe_size }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ stockItem.material }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ stockItem.category }}
                    </td>
                    <td class="pl-6 py-4">
                        {{ stockItem.stock_level }}
                    </td>
                    <td class="py-4 pl-6 space-x-2">
                    <RouterLink
                        :to="{ name: 'EditStockItem', params: { id: stockItem.id } }"
                        class="
                        px-4
                        py-2
                        bg-blue-500
                        hover:bg-blue-600
                        text-white
                        rounded
                        "
                    >
                        Edit
                    </RouterLink>
                    <RouterLink
                        :to="{ name: 'AddOrder', params: { id: stockItem.id, stockCollectionRedirect: true } }"
                        class="
                        px-4
                        py-2
                        bg-violet-500
                        hover:bg-violet-600
                        text-white
                        rounded"
                    >
                        Order
                    </RouterLink>
                    <button
                    @click="deleteStockItem(stockItem)"
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
            stockItems: null,
            tableId: 1
        }
    },
    mounted() {
        this.getStockItems();
    },
    methods: {
        getStockItems() {
            axios.get("http://127.0.0.1:8080/api/stockitems")
                .then((response) => {
                    this.stockItems = response.data;
                    this.tableId++;
                });
        },
        async deleteStockItem(stockItem) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://127.0.0.1:8080/api/stockitems/" + stockItem.id);
            this.stockItems = null;
            this.getStockItems();
        }
    }
}
</script>

<style>

</style>