<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center ml-10 text-2xl font-semibold whitespace-nowrap">
            Edit Supplier
        </span>
        <button
            @click="$router.push({path: '/suppliers'})"
            type="submit"
            class="text-white bg-slate-500 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
        >
            Cancel
        </button>
    </div>
    <div class="relative mt-5 m-2 p-2">
        <form v-if="this.supplier !== null">
            <div class="grid grid-cols-2">
                <div>
                    <div class="flex" :class="{ 'mb-12': !errors.name }">
                        <label
                            for="name"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Name
                        </label>
                        <input
                            v-model="supplier.name"
                            type="text"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
                            required
                        >
                    </div>
                    <div class="flex my-4" v-if="errors.name">
                        <span class="ml-44 text-sm text-red-400">{{ errors.name[0] }}</span>
                    </div>
                    <div class="flex" :class="{ 'mb-12': !errors.email }">
                        <label
                            for="email"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Email
                        </label>
                        <input
                            v-model="supplier.email"
                            type="text"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
                            required
                        >
                    </div>
                    <div class="flex my-4" v-if="errors.email">
                        <span class="ml-44 text-sm text-red-400">{{ errors.email[0] }}</span>
                    </div>
                    <div class="flex" :class="{ 'mb-12': !errors.phone_number }">
                        <label
                            for="phone_number"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Phone Number
                        </label>
                        <input
                            v-model="supplier.phone_number"
                            type="text"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
                            required
                        >
                    </div>
                    <div class="flex my-4" v-if="errors.phone_number">
                        <span class="ml-44 text-sm text-red-400">{{ errors.phone_number[0] }}</span>
                    </div>
                    <div class="flex" :class="{ 'mb-12': !errors.address }">
                        <label
                            for="address"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Address
                        </label>
                        <textarea
                            v-model="supplier.address"
                            rows="3"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
                            placeholder="Enter the supplier address here!"
                            required
                        ></textarea>
                    </div>
                    <div class="flex my-4" v-if="errors.address">
                        <span class="ml-44 text-sm text-red-400">{{ errors.address[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-end pr-4">
                <button
                    @click="editSupplier"
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
            errors: {},
            supplier: null
        }
    },
    mounted() {
        this.getSupplier(this.$route.params.id);
    },
    methods: {
        getSupplier(id) {
            axios.get("http://localhost:8888/api/suppliers/" + id)
                .then((response) => {
                    this.supplier = response.data.data;
                });
        },
        async editSupplier() {
            try {
                await axios.put("http://localhost:8888/api/suppliers/" + this.id, this.supplier)
                await this.$router.push({path: '/suppliers'})
            } catch (error) {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            }
        }
    }
}
</script>

<style>

</style>
