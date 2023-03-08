<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">Delivery Collection</span>
        <router-link
            :to="{path: '/deliveries/add'}"
            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 sm:rounded-lg text-white"
        >
            Add Delivery
        </router-link>
    </div>
    <div class="relative overflow-x-auto">
        <table v-if="this.deliveries !== null" class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 border uppercase bg-blue-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Delivery Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Delivery DateTime
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created By
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="delivery in deliveries" :key="delivery.id" class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ delivery.id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ delivery.order_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ delivery.delivery_datetime.replace("T", " ").slice(0, -3) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ delivery.user_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ delivery.created_at.replace("T", " ").slice(0, -11) }}
                    </td>
                    <td class="py-4 px-6 space-x-2">
                    <button
                        @click="editDelivery(delivery)"
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
                    </button>
                    <button
                        @click="deleteDelivery(delivery)"
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
            deliveries: null
        }
    },
    mounted() {
        this.getDeliveries();
    },
    methods: {
        getDeliveries() {
            axios.get("http://127.0.0.1:8080/api/deliveries")
                .then((response) => {
                    this.deliveries = response.data;
                });
        },
        async deleteDelivery(delivery) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://127.0.0.1:8080/api/deliveries/" + delivery.id);
            this.deliveries = null;
            this.getDeliveries();
        },
        editDelivery(delivery) {
            this.$router.push({name: 'EditDelivery', params: { id: delivery.id }});
        }
    }
}
</script>

<style>

</style>