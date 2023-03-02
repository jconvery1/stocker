<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">
            Add Delivery
        </span>
        <button
            @click="$router.push({path: '/deliveries'})"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
    <div class="relative overflow-x-auto m-2 p-2">
        <form  v-if="this.orders !== null">
            <div class="mb-6">
                <label for="name"
                    class="block mb-2 text-sm font-medium text-gray-900"
                >
                    Which order has been delivered?
                </label>
                <!-- Dropdown menu -->
                <select v-model="orderId">
                    <option :key="order.id" v-for="order in orders" :value="order.id">
                        {{ order.id }}
                    </option>
                </select>
            </div>
            <div class="flex justify-end pr-4">
                <button
                    @click="addDelivery"
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
            orderId: null,
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
                    this.tableId++;
                });
        },
        async addDelivery() {
            const timeElapsed = Date.now();
            const today = new Date(timeElapsed).toISOString();
            const now = today.replace("T", " ");
            console.log(now);
            const delivery = {
                user_id: 1,
                delivery_datetime: now.slice(0, -5),
                order_id: this.orderId
            }
            try {
                await axios.post("http://127.0.0.1:8080/api/deliveries", delivery)
                await this.$router.push({path: '/deliveries'})
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