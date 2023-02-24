<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">
            Edit Order
        </span>
        <button
            @click="$router.push({path: '/orders'})"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
  <div class="relative overflow-x-auto m-2 p-2">
    <form v-if="this.stockItems !== null">
        <div class="mb-6">
            <label for="name"
                class="block mb-2 text-sm font-medium text-gray-900"
            >
                Stock Item
            </label>
            <!-- Dropdown menu -->
            <select v-model="stockOrder.stock_item_id">
                <option :key="stockItem.id" v-for="stockItem in stockItems" :value="stockItem.id">
                    {{ stockItem.name }}
                </option>
            </select>
        </div>
        <div class="mb-6">
            <label for="name"
                class="block mb-2 text-sm font-medium text-gray-900"
            >
                Quantity
            </label>
            <input
                v-model="stockOrder.quantity"
                type="number"
                id="quantity"
                min="1"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5"
                required
            >
        </div>
        <div class="mb-6">
            <label for="name"
                class="block mb-2 text-sm font-medium text-gray-900"
            >
                Notes
            </label>
            <input
                v-model="order.notes"
                type="textarea"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
            >
        </div>
        <div class="flex justify-end pr-4">
            <button
                type="button"
                @click="editOrder"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
            >
                Save
            </button>
        </div>
    </form>
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
    props: {
        id: {
            type: Number
        }
    },
    data() {
        return {
            stockItems: null,
            order: null,
            stockOrder: null
        }
    },
    mounted() {
        this.getOrder(this.$route.params.id);
        this.getStockItems();
    },
    methods: {
        getStockItems() {
            axios.get("http://127.0.0.1:8080/api/stockitems")
                .then((response) => {
                    this.stockItems = response.data.data;
                    this.tableId++;
                });
        },
        getOrder(id) {
            axios.get("http://127.0.0.1:8080/api/orders/" + id)
                .then((response) => {
                    this.order = response.data[0];
                    this.stockOrder = response.data[1];
                });
        },
        async editOrder() {
            try {
                await axios.put("http://127.0.0.1:8080/api/orders/" + this.id, this.order);
                await axios.put("http://127.0.0.1:8080/api/stockorders/" + this.stockOrder.id, this.stockOrder);
                await this.$router.push({path: '/orders'})
            } catch (error) {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            }
        }
    }
}
</script>

<style>

</style>