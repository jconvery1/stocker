<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">
            Add Sale
        </span>
        <button
            @click="$router.push({path: '/sales'})"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
  <div class="relative overflow-x-auto m-2 p-2">
    <form v-if="this.stockItems !== null">
        <div class="flex mb-12">
            <label for="name"
                class="block mr-2 w-32 text-sm font-medium text-gray-900"
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
                class="block mr-2 w-32 text-sm font-medium text-gray-900"
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
                class="block mr-2 w-32 text-sm font-medium text-gray-900"
            >
                Price
            </label>
            <input
                disabled
                v-model="price"
                type="textarea"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/12 p-2.5"
            >
        </div>
        <div class="flex justify-end pr-4">
            <button
                @click="addSale"
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
    computed: {
        price() {
            if (this.stockItemId) {
                const stockitem = this.stockItems.find(item => item.id == this.stockItemId);
                return stockitem.price * this.stockQuantity;
            } else {
                return 0;
            }
        }
    },
    methods: {
        getStockItems() {
            axios.get("http://127.0.0.1:8080/api/stockitems")
                .then((response) => {
                    this.stockItems = response.data.data;
                    this.tableId++;
                });
        },
        async addSale() {
            const sale = {
                customer_id: 1,
                sale_price: this.price,
                user_id: 1,
                quantity: this.stockQuantity
            }
            try {
                await axios.post("http://127.0.0.1:8080/api/sales", sale)
                await this.$router.push({path: '/sales'})
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