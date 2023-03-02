<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">
            Add Stock Item
        </span>
        <button
            @click="$router.push({path: '/stock'})"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
  <div class="relative overflow-x-auto m-2 p-2">
    <form v-if="this.suppliers !== null">
        <div class="flex mb-12">
            <label
                for="name"
                class="block mr-2 w-32 text-sm font-medium text-gray-900"
            >
                Name
            </label>
            <input
                v-model="stockItem.name"
                type="text"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
                required
            >
        </div>
        <div class="flex mb-12">
            <label for="name"
                class="block mr-2 w-32 text-sm font-medium text-gray-900"
            >
                Supplier
            </label>
            <!-- Dropdown menu -->
            <select v-model="stockItem.supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/5 p-2.5">
                <option disabled value="">Please select one</option>
                <option :key="supplier.id" v-for="supplier in suppliers" :value="supplier.id">
                    {{ supplier.name }}
                </option>
            </select>
        </div>
        <div class="flex mb-12">
            <label for="name"
                class="block mr-2 w-32 text-sm font-medium text-gray-900"
            >
                Shoe Size
            </label>
            <input
                v-model="stockItem.shoe_size"
                type="number"
                min="1"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/12 p-2.5"
            required>
        </div>
        <div class="flex mb-12">
            <label for="name"
                class="block mr-2 w-32 text-sm font-medium text-gray-900"
            >
                Material
            </label>
            <input
                v-model="stockItem.material"
                type="text"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/5 p-2.5"
            required>
        </div>
        <div class="flex mb-12">
            <label for="name"
                class="block mr-2 w-32 text-sm font-medium text-gray-900"
            >
                Category
            </label>
            <input
                v-model="stockItem.category"
                type="text"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/5 p-2.5"
            required>
        </div>
        <div class="flex justify-end pr-4">
            <button
                @click="addStockItem"
                type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
            >
                Save
            </button>
        </div>
    </form>
  </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            stockItem: {},
            suppliers: []
        }
    },
    mounted() {
        this.getSuppliers();
    },
    methods: {
        async addStockItem() {
            try {
                await axios.post("http://127.0.0.1:8080/api/stockitems", this.stockItem)
                await this.$router.push({path: '/stock'})
            } catch (error) {
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors;
                }
            }
        },
        getSuppliers() {
            axios.get("http://127.0.0.1:8080/api/suppliers")
                .then((response) => {
                    this.suppliers = response.data.data;
                    this.supplierDefault = this.suppliers[0].name
                });
        }
    }
}
</script>

<style>

</style>