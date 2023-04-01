<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">Supplier Collection</span>
        <router-link
            :to="{path: '/suppliers/add'}"
            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 sm:rounded-lg text-white"
        >
            Add Supplier
        </router-link>
    </div>
    <div class="relative overflow-x-auto">
        <table
            id="tableId"
            v-if="this.suppliers !== null"
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
                            Supplier Number
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
                        Email
                    </th>
                    <th scope="col" class="pl-4 py-3">
                        Phone
                    </th>
                    <th scope="col" class="pl-4 py-3">
                        Address
                    </th>
                    <th scope="col" class="pl-4 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="supplier in suppliers"
                    :key="supplier.id"
                    class="bg-white border hover:bg-gray-50"
                >
                    <td class="pl-4 py-4">
                        <div class="flex items-center">
                            <input
                                v-model="supplier.checked"
                                id="checkbox-table-search-1"
                                type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2"
                            >
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <td class="pl-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ supplier.id }}
                    </td>
                    <td class="pl-4 py-4">
                        {{ supplier.name }}
                    </td>
                    <td class="pl-4 py-4">
                        {{ supplier.email }}
                    </td>
                    <td class="pl-4 py-4">
                        {{ supplier.phone_number }}
                    </td>
                    <td class="pl-4 py-4">
                        {{ supplier.address }}
                    </td>
                    <td class="py-4 pl-4 space-x-2">
                    <button
                    @click="deleteSupplier(supplier)"
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
                    <button
                        @click="editSupplier(supplier)"
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
            suppliers: null,
            tableId: 1,
            selectAll: false
        }
    },
    mounted() {
        this.getSuppliers();
    },
    methods: {
        getSuppliers() {
            axios.get("http://127.0.0.1:8080/api/suppliers")
                .then((response) => {
                    this.suppliers = response.data.data;
                    this.tableId++;
                });
        },
        async deleteSupplier(supplier) {
            if (!window.confirm("Are You Sure?")) {
                return;
            }
            await axios.delete("http://127.0.0.1:8080/api/suppliers/" + supplier.id);
            this.suppliers = null;
            this.getSuppliers();
        },
        editSupplier(supplier) {
            this.$router.push({name: 'EditSupplier', params: { id: supplier.id } })
        }
    }
}
</script>

<style>

</style>