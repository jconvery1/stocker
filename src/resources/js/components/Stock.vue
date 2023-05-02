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
        <div v-if="(this.stockItems && this.settings) !== null">
            <table
                id="tableId"
                class="w-full text-sm text-left text-gray-500"
            >
                <thead class="text-xs text-gray-700 border uppercase bg-blue-50">
                    <tr>
                        <th scope="col" class="pl-4 py-3">
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
                        <th scope="col" class="pl-4 py-3">
                            <div class="flex">
                                Stock Number
                                <a href="#" class="w-2 h-3 ml-1 mt-[1.5px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                        <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                    </svg>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Name
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Supplier
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Price
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Gender
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Brand
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Colour
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Size
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Material
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Category
                        </th>
                        <th scope="col" class="pl-4 py-3">
                            Stock Level
                        </th>
                        <th scope="col" class="pl-4 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="stockItem in stockItems.data"
                        :key="stockItem.id"
                        class="bg-white border hover:bg-gray-50"
                    >
                        <td class="pl-4 py-4">
                            <div class="flex items-center">
                                <input
                                    v-model="stockItem.checked"
                                    id="checkbox-table-search-1"
                                    type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2"
                                >
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="pl-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ stockItem.id }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ stockItem.name }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ stockItem.supplier_name }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ '£' + stockItem.price }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ stockItem.gender }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ stockItem.brand }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ stockItem.colour }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ stockItem.shoe_size }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ stockItem.material }}
                        </td>
                        <td class="pl-4 py-4">
                            {{ stockItem.category }}
                        </td>
                        <td class="pl-4 py-4">
                            <div class="flex">
                                <div>
                                    {{ stockItem.stock_level }}
                                </div>
                                <div v-if="orders !== null && itemHasUnfulfilledOrder(stockItem)">
                                    <div class="tooltip">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white ml-1" fill="orange" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" fill-rule="evenodd"></path>
                                        </svg>
                                        <span class="tooltiptext">Item has been reordered</span>
                                    </div>
                                </div>
                                <div v-else-if="stockItem.stock_level <= settings.reorder_level">
                                    <div class="tooltip">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white ml-1" fill="red" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" fill-rule="evenodd"></path>
                                        </svg>
                                        <span class="tooltiptext">Stock level <= reorder level!</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 pl-4 space-x-2">
                        <button
                        @click="deleteStockItem(stockItem)"
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
                            @click="editStockItem(stockItem)"
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
                        </button>
                        <button
                            @click="orderStockItem(stockItem)"
                            class="
                            px-2
                            py-1
                            bg-violet-500
                            hover:bg-violet-600
                            text-white
                            rounded"
                        >
                            <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path>
                                <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path>
                            </svg>
                        </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex flex-col items-center mt-2">
                <!-- Help text -->
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    Showing {{ stockItems.from }} to {{ stockItems.to }} of {{ stockItems.total }} Entries
                </span>
                <!-- Buttons -->
                <div class="inline-flex mt-2 xs:mt-0">
                    <button v-if="stockItems.current_page > 1" @click="getStockItems(stockItems.current_page - 1)" class="px-4 py-2 text-sm font-medium text-white bg-gray-800 rounded hover:bg-gray-900 m-1">
                        Prev
                    </button>
                    <button v-if="stockItems.current_page < stockItems.last_page" @click="getStockItems(stockItems.current_page + 1)" class="px-4 py-2 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded hover:bg-gray-900 m-1">
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
import TailwindPagination from 'laravel-vue-pagination';

export default {
    name: 'Stock',
    components: {
        'tailwind-pagination': TailwindPagination
    },
    data() {
        return {
            stockItems: {},
            stockItemsObject: null,
            tableId: 1,
            selectAll: false,
            settings: null,
            orders: null,
        }
    },
    mounted() {
        this.getStockItems();
        this.getSettings();
        this.getOrders();
    },
    methods: {
        itemHasUnfulfilledOrder(item) {
            return this.orders.filter((order) => order.notes == "Automated Reorder: " + item.name).length > 0;
        },
        getSettings() {
            axios.get("http://127.0.0.1:8080/api/automation/1")
                .then((response) => {
                    this.settings = response.data.data;
            });
        },
        getStockItems(page = 1) {
            this.stockItems = null;
            axios.get(`http://127.0.0.1:8080/api/stockitems?page=${page}`)
                .then((response) => {
                    this.stockItems = Object.assign({}, response.data);
                    this.stockItemsObject = Object.assign({}, this.stockItems);
                    this.tableId++;
                });
        },
        getOrders() {
            axios.get("http://127.0.0.1:8080/api/orders")
                .then((response) => {
                    this.orders = response.data;
                    this.orders = this.orders.filter((order) =>
                        order.fulfilled == 0 && order.notes.includes('Automated Reorder')
                    )
                });
        },
        async deleteStockItem(stockItem) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://127.0.0.1:8080/api/stockitems/" + stockItem.id);
            this.stockItems = null;
            this.getStockItems();
        },
        editStockItem(stockItem) {
            this.$router.push({name: 'EditStockItem', params: { id: stockItem.id } })
        },
        orderStockItem(stockItem) {
            this.$router.push({name: 'AddOrder', params: { id: stockItem.id, stockCollectionRedirect: true } })
        }
    }
}
</script>

<style>
 /* Tooltip container */
.tooltip {
  position: relative;
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;

  /* Position the tooltip text */
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;

  /* Fade in tooltip */
  opacity: 0;
  transition: opacity 0.3s;
}

/* Tooltip arrow */
.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
} 
</style>