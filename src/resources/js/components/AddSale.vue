<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center ml-4 text-2xl font-semibold whitespace-nowrap">
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
                <div class="flex mb-12">
                    <label for="name"
                        class="block ml-4 w-32 text-sm font-medium text-gray-900"
                    >
                        Barcode
                    </label>
                    <input
                        @keyup.enter="addItemToSale(true)"
                        v-model="barcode"
                        type="search"
                        id="barcode"
                        min="1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
                    >
                </div>
                <div class="flex mb-12">
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
                <div class="flex mb-6">
                    <label for="name"
                        class="block ml-4 w-32 text-sm font-medium text-gray-900"
                    >
                        Price (£)
                    </label>
                    <input
                        disabled
                        v-model="price"
                        type="textarea"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/6 p-2.5"
                    >
                </div>
                <div class="flex mb-12">
                    <button
                        v-if="stockItemId"
                        @click="addItemToSale(false)"
                        type="button"
                        class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto ml-[330px] px-5 py-2.5 text-center"
                    >
                        Add to sale
                    </button>
                </div>
            </div>
            <div>
                <div class="mb-12">
                    <label for="name" class="block mb-6 w-32 text-sm font-medium text-gray-900">
                        Sale Summary:
                    </label>
                    <table v-if="this.sale.length > 0" class="w-96 text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 border uppercase bg-blue-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Item
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in sale" :key="item.stock_item_id" class="bg-white border hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ item.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ item.quantity }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ '£' + item.price }}
                                </td>
                                <td class="py-4 px-6 space-x-2">
                                    <button
                                        @click="removeItemFromSummary(item)"
                                        class="
                                            px-4
                                            py-2
                                            bg-red-500
                                            hover:bg-red-700
                                            text-white
                                            rounded"
                                        type="button"
                                    >
                                        Remove
                                    </button>
                                </td>
                            </tr>
                            <tr class="text-xs text-gray-700 border uppercase bg-blue-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    Total
                                </td>
                                <td class="px-6 py-4">
                                    {{ this.totalQuantity }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ '£' + this.totalPrice }}
                                </td>
                                <th scope="col" class="px-6 py-3">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="w-96 text-sm text-left text-gray-500">
                        <div class="flex items-center gap-2 text-gray-500">
                            There are no items added to the sale.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end pr-4">
            <button
                v-if="this.sale.length > 0"
                @click="addSale"
                type="button"
                class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
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
            notes: '',
            stockSale: {},
            sale: [],
            sale2: [],
            test: 'test',
            errors: {},
            totalQuantity: 0,
            totalPrice: 0,
            barcode: '',
            scannedItems: [],
            stockItems2: []
        }
    },
    mounted() {
        this.getStockItems();
    },
    computed: {
        salePrice() {
            return 100;
        },
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
        removeItemFromDropdown(item) {
            console.log('remove item from dropdown');
            const index = this.stockItems.findIndex((stockItem) => {
                return stockItem.id === item.id;
            })
            this.stockItems.splice(index, 1);
        },
        getStockItems() {
            axios.get("http://127.0.0.1:8080/api/stockitems")
                .then((response) => {
                    this.stockItems = response.data;
                    this.stockItems2 = this.stockItems;
                    this.tableId++;
                });
        },
        async getStockItem(id) {
            axios.get("http://127.0.0.1:8080/api/stockitems/" + id)
                .then((response) => {
                    this.stockItem = response.data.data;
                });
        },
        async addSale() {
            const sale = {
                customer_id: 1,
                sale_price: this.totalPrice,
                user_id: 1,
                stock_sales: this.sale
            }
            try {
                await axios.post("http://127.0.0.1:8080/api/sales", sale)
                await this.$router.push({path: '/sales'})
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            }
        },
        addItemToSale(barcode) {
            //build and add item to sale
            let item;
            let stockSale;
            const foundIndex = this.sale.findIndex(saleItem => saleItem.barcode == this.barcode);
            if (foundIndex > -1) {
                console.log(1);
                const item = this.sale.find(saleItem => saleItem.barcode == this.barcode);
                this.sale[foundIndex].quantity++;
                this.sale[foundIndex].price = item.itemPrice * this.sale[foundIndex].quantity;

                //adjust totals
                this.totalQuantity++;
                this.totalPrice += item.itemPrice;
            } else {
                console.log(2);
                if (barcode) {
                    item = this.stockItems.find(item => item.barcode === this.barcode);
                    stockSale = {
                        name: item.name,
                        stock_item_id: item.id,
                        quantity: 1,
                        price: item.price,
                        barcode: item.barcode,
                        itemPrice: item.price
                    };
                } else {
                    item = this.stockItems.find(item => item.id === this.stockItemId || item.stock_item_id === this.stockItemId);
                    stockSale = {
                        name: item.name,
                        stock_item_id: this.stockItemId,
                        quantity: this.stockQuantity,
                        price: this.price,
                        barcode: item.barcode,
                        itemPrice: item.price
                    };
                }
                this.sale.push(stockSale);

                //adjust totals
                this.totalQuantity += Number(this.stockQuantity);
                this.totalPrice = barcode ? this.totalPrice += item.price : this.totalPrice += this.price;

                this.removeItemFromDropdown(item);
            }

            //reset form fields
            this.stockItemId = '';
            this.stockQuantity = 1;
            this.barcode = '';
        },
        removeItemFromSummary(item) {
            console.log('remove from summary');
            const index = this.sale.findIndex((stockItem) => {
                return stockItem.stock_item_id == item.stock_item_id;
            })
            this.sale.splice(index, 1);

            //adjust totals
            this.totalQuantity -= item.quantity;
            this.totalPrice -= item.price;

            //reset price to original item price in case the item is scanned again
            item.price = item.itemPrice;

            //add removed item back into item dropdown
            item.id = item.stock_item_id;
            this.stockItems.push(item);
        }
    }
}
</script>

<style>

</style>