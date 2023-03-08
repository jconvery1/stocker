<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center ml-4 text-2xl font-semibold whitespace-nowrap">
            Add Order
        </span>
        <button
            @click="this.redirectFromAddOrder"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
  <div class="relative overflow-x-auto mt-5 m-2 p-2">
    <form v-if="this.stockItems !== null">
        <div class="grid grid-cols-2">
            <div>
                <div class="flex mb-12">
                    <label for="name"
                        class="block ml-4 w-32 text-sm font-medium text-gray-900"
                    >
                        Stock Item
                    </label>
                    <!-- Dropdown menu -->
                    <select v-model="stockItemId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                        <option disabled value="">Please select one</option>
                        <option :key="stockItem.id" v-for="stockItem in stockItems" :value="stockItem.id">
                            {{ stockItem.name }}
                        </option>
                    </select>
                </div>
                <div class="flex mb-6">
                    <label for="name"
                        class="block ml-4 w-32 text-sm font-medium text-gray-900"
                    >
                        Quantity
                    </label>
                    <input
                        v-model="stockQuantity"
                        type="number"
                        id="quantity"
                        min="1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/6 p-2.5"
                        required
                    >
                </div>
                <div class="flex mb-12">
                    <button
                        v-if="stockItemId"
                        @click="addItemToOrder"
                        type="button"
                        class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto ml-[330px] px-5 py-2.5 text-center"
                    >
                        Add to order
                    </button>
                </div>
                <div class="flex mb-12">
                    <label for="name"
                        class="block ml-4 w-32 text-sm font-medium text-gray-900"
                    >
                        Notes
                    </label>
                    <textarea v-model="notes" id="notes" name="about" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5" placeholder="Enter notes about this order here!"></textarea>
                </div>
            </div>
            <div>
                <div class="mb-12">
                    <label for="name" class="block mb-6 w-32 text-sm font-medium text-gray-900">
                        Order Summary:
                    </label>
                    <table v-if="this.order.length > 0" class="w-96 text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-blue-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Item
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in order" :key="item.stock_item_id" class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ item.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.quantity }}
                                </td>
                                <td class="py-4 px-6 space-x-2">
                                    <button
                                    @click="removeItemFromOrder(item)"
                                        class="
                                            px-4
                                            py-2
                                            bg-red-500
                                            hover:bg-red-700
                                            text-white
                                            rounded"
                                    >
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="w-96 text-sm text-left text-gray-500">
                        <div class="flex items-center gap-2 text-gray-500">
                            There are no items added to the order.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end pr-4">
            <button
                v-if="this.order.length > 0"
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
    props: {
        id: {
            type: Number
        },
        stockCollectionRedirect: {
            type: Boolean
        }
    },
    data() {
        return {
            dropdown: false,
            stockItems: null,
            stockItem: {},
            stockItemId: '',
            stockQuantity: 1,
            notes: '',
            stockOrder: {},
            order: [],
            test: 'test',
            errors: {}
        }
    },
    mounted() {
        this.getStockItems();
        if (this.stockCollectionRedirect) {
            this.populateOrder(this.$route.params.id);
        }
    },
    methods: {
        populateOrder(id) {
            this.stockItemId = id;
        },
        getStockItems() {
            axios.get("http://127.0.0.1:8080/api/stockitems")
                .then((response) => {
                    this.stockItems = response.data;
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
            const order = {
                notes: this.notes,
                supplier_id: this.order[0].supplier_id,
                user_id: 1,
                order_datetime: now.slice(0, -5),
                fulfilled: 0,
                stock_orders: this.order
            }
            try {
                await axios.post("http://127.0.0.1:8080/api/orders", order)
                await this.$router.push({path: '/orders'})
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            }
        },
        addItemToOrder() {
            //build and add item to order
            const item = this.stockItems.find(item => item.id === this.stockItemId || item.stock_item_id === this.stockItemId);
            const stockOrder = {
                stock_item_id: this.stockItemId,
                quantity: this.stockQuantity,
                name: item.name,
                supplier_id: item.supplier_id
            };
            this.order.push(stockOrder);

            //remove added item from item dropdown
            const index = this.stockItems.findIndex((stockItem) => {
                return stockItem.id === item.id;
            })
            this.stockItems.splice(index, 1);

            //only show stock that belongs to the same supplier
            this.stockItems = this.stockItems.filter((stockItem) => {
                return stockItem.supplier_id == item.supplier_id;
            })

            //reset form fields
            this.stockItemId = '';
            this.stockQuantity = 1;
        },
        toggleDropdown() {
            this.dropdown = !this.dropdown;
        },
        removeItemFromOrder(item) {
            const index = this.order.findIndex((stockItem) => {
                return stockItem.stock_item_id == item.stock_item_id;
            })
            this.order.splice(index, 1);

            //add removed item back into item dropdown
            item.id = item.stock_item_id;
            this.stockItems.push(item);

            //fetch all stock items for dropdown if order is now empty
            if (this.order.length == 0) {
                this.getStockItems();
            }
        },
        redirectFromAddOrder() {
            this.stockCollectionRedirect ? this.$router.push({path: '/stock'}) : this.$router.push({path: '/orders'});
        }
    }
}
</script>

<style>

</style>