<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center ml-80 text-2xl font-semibold whitespace-nowrap">
            Add Order
        </span>
        <button
            @click="$router.push({path: '/orders'})"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
  <div class="relative overflow-x-auto mt-5 m-2 p-2">
    <form v-if="this.stockItems !== null">
        <div class="flex mb-12">
            <label for="name"
                class="block ml-80 w-32 text-sm font-medium text-gray-900"
            >
                Stock Item
            </label>
            <!-- Dropdown menu -->
            <select v-model="stockItemId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/5 p-2.5">
                <option disabled value="">Please select one</option>
                <option :key="stockItem.id" v-for="stockItem in stockItems" :value="stockItem.id">
                    {{ stockItem.name }}
                </option>
            </select>
        </div>
        <div class="flex mb-12">
            <label for="name"
                class="block ml-80 w-32 text-sm font-medium text-gray-900"
            >
                Quantity
            </label>
            <input
                v-model="stockQuantity"
                type="number"
                id="quantity"
                min="1"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/12 p-2.5"
                required
            >
        </div>
        <div class="flex mb-12">
            <label for="name"
                class="block ml-80 w-32 text-sm font-medium text-gray-900"
            >
                Notes
            </label>
            <!-- <input
                v-model="notes"
                type="textarea"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
            > -->
            <textarea v-model="notes" id="notes" name="about" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5" placeholder="Enter notes about this order here!"></textarea>
        </div>
        <div class="flex justify-end pr-4">
            <button
                @click="addOrder"
                type="button"
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
    data() {
        return {
            dropdown: false,
            stockItems: null,
            stockItem: {},
            stockItemId: '',
            stockQuantity: 1,
            notes: ''
        }
    },
    mounted() {
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
        async getStockItem(id) {
            axios.get("http://127.0.0.1:8080/api/stockitems/" + id)
                .then((response) => {
                    this.stockItem = response.data.data;
                });
        },
        async addOrder() {
            const timeElapsed = Date.now();
            const today = new Date(timeElapsed).toISOString();
            const now = today.replace("T", " ");
            console.log(now);
            const order = {
                notes: this.notes,
                supplier_id: 1,
                user_id: 1,
                order_datetime: now.slice(0, -5),
                stock_item_id: this.stockItemId,
                quantity: this.stockQuantity
            }
            try {
                await axios.post("http://127.0.0.1:8080/api/orders", order)
                await this.$router.push({path: '/orders'})
            } catch (error) {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            }
        },
        toggleDropdown() {
            this.dropdown = !this.dropdown;
        }
    }
}
</script>

<style>

</style>