<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center ml-4 text-2xl font-semibold whitespace-nowrap">
            Edit Delivery
        </span>
        <button
            @click="$router.push({path: '/deliveries'})"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
    <div class="relative overflow-x-auto mt-5 m-2 p-2">
        <form v-if="this.orders !== null">
            <div class="grid grid-cols-2">
                <div>
                    <label for="name"
                        class="block ml-4 mb-6 w-80 text-sm font-medium text-gray-900"
                    >
                        Which order has been delivered?
                    </label>
                    <div class="flex mb-12">
                        <!-- Dropdown menu -->
                        <select v-model="orderId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ml-4 w-1/2 p-2.5">
                            <option disabled value="">Please select one</option>
                            <option :key="order.id" v-for="order in orders" :value="order.id">
                                {{ order.id }}
                            </option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="name" class="block mb-6 w-32 text-sm font-medium text-gray-900">
                        Delivery Summary:
                    </label>
                    <div v-if="this.order.length > 0" class="mb-12">
                        <table class="w-96 text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 border uppercase bg-blue-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Item
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in order" :key="item.stock_item_id" class="bg-white border hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ item.stock_item_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.quantity }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="w-96 text-sm text-left text-gray-500">
                        <div class="flex items-center gap-2 text-gray-500">
                            Select an order from the dropdown.
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end pr-4">
                <button
                    @click="editDelivery"
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
    props: {
        id: {
            type: Number
        }
    },
    data() {
        return {
            delivery: null,
            orderId: null,
            order: [],
            orders: null,
            stockOrders: null,
            errors: [],
            gettingDelivery: false
        }
    },
    mounted() {
        this.getDelivery(this.$route.params.id);
        this.getOrders();
    },
    watch: {
        orderId(newVal, oldVal) {
            if (newVal != oldVal && newVal > 0 && !this.gettingDelivery) {
                this.getOrder(newVal);
            }
        }
    },
    methods: {
        getOrders() {
            axios.get("http://127.0.0.1:8080/api/orders")
                .then((response) => {
                    this.orders = response.data;
                    this.orders = this.orders.filter((order) => order.fulfilled == 0);
                    this.tableId++;
                });
        },
        getOrder(id) {
            axios.get("http://127.0.0.1:8080/api/orders/" + id)
                .then((response) => {
                    this.order = response.data;
                    this.gettingDelivery = false;
                });
        },
        getDelivery(id) {
            axios.get("http://127.0.0.1:8080/api/deliveries/" + id)
                .then((response) => {
                    this.delivery = response.data.data;
                    this.gettingDelivery = true;
                    this.orderId = this.delivery.order_id;
                    this.getOrder(this.delivery.order_id);
                });
        },
        async editDelivery() {
            const timeElapsed = Date.now();
            const today = new Date(timeElapsed).toISOString();
            const now = today.replace("T", " ");
            const delivery = {
                user_id: 1,
                delivery_datetime: now.slice(0, -5),
                order_id: this.orderId
            }
            try {
                await axios.put("http://127.0.0.1:8080/api/deliveries/" + this.id, delivery)
                await this.$router.push({path: '/deliveries'})
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors.value = error.response.data.errors;
                }
            }
        }
    }
}
</script>

<style>

</style>