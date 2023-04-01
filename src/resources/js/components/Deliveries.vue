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
                    <th scope="col" class="px-6 py-3">
                        <div class="flex">
                            Delivery Number
                            <a href="#" class="w-2 h-3 ml-1 mt-[1.5px]">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                    <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                </svg>
                            </a>
                        </div>
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
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <input
                                v-model="delivery.checked"
                                id="checkbox-table-search-1"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2"
                            >
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
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
            deliveries: null,
            selectAll: false
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