<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center ml-10 text-2xl font-semibold whitespace-nowrap">
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
    <div class="relative mt-5 m-2 p-2">
        <form v-if="this.suppliers !== null">
            <div class="grid grid-cols-2">
                <div>
                    <div class="flex mb-12">
                        <label
                            for="name"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
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
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Supplier
                        </label>
                        <!-- Dropdown menu -->
                        <select v-model="supplierId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                            <option disabled value="">Select a supplier</option>
                            <option :key="supplier.id" v-for="supplier in suppliers" :value="supplier.id">
                                {{ supplier.name }}
                            </option>
                        </select>
                    </div>
                    <div class="flex mb-12">
                        <label for="name"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Gender
                        </label>
                        <!-- Dropdown menu -->
                        <select v-model="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                            <option disabled value="">Select a gender</option>
                            <option :key="gender.id" v-for="gender in genders" :value="gender.name">
                                {{ gender.name }}
                            </option>
                        </select>
                    </div>
                    <div class="flex mb-12">
                        <label for="name"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Brand
                        </label>
                        <!-- Dropdown menu -->
                        <select v-model="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                            <option disabled value="">Select a brand</option>
                            <option :key="brand.id" v-for="brand in brands" :value="brand.value">
                                {{ brand.value }}
                            </option>
                        </select>
                    </div>
                    <div class="flex mb-12">
                        <label for="name"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Colour
                        </label>
                        <!-- Dropdown menu -->
                        <select v-model="colour" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                            <option disabled value="">Select a colour</option>
                            <option :key="colour.id" v-for="colour in colours" :value="colour.name">
                                {{ colour.name }}
                            </option>
                        </select>
                    </div>
                    <div class="flex mb-12">
                        <label for="name"
                            class="block ml-10 w-32 text-sm font-medium text-gray-900"
                        >
                            Shoe Size
                        </label>
                        <input
                            v-model="stockItem.shoe_size"
                            type="number"
                            min="1"
                            step="any"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5"
                        required>
                    </div>
                </div>
                <div>
                    <div class="flex mb-12">
                        <label for="name"
                            class="block w-32 text-sm font-medium text-gray-900"
                        >
                            Material
                        </label>
                        <select v-model="material" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                            <option disabled value="">Select a material</option>
                            <option :key="material.id" v-for="material in materials" :value="material.value">
                                {{ material.value }}
                            </option>
                        </select>
                    </div>
                    <div class="flex mb-12">
                        <label for="name"
                            class="block w-32 text-sm font-medium text-gray-900"
                        >
                            Category
                        </label>
                        <select v-model="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5">
                            <option disabled value="">Select a category</option>
                            <option :key="category.id" v-for="category in categories" :value="category.value">
                                {{ category.value }}
                            </option>
                        </select>
                    </div>
                    <div class="flex mb-12">
                        <label for="name"
                            class="block w-32 text-sm font-medium text-gray-900"
                        >
                            Price (£)
                        </label>
                        <input
                            v-model="stockItem.price"
                            type="number"
                            id="price"
                            min="1"
                            step="any"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5"
                        required>
                    </div>
                    <div class="flex mb-12">
                        <label for="name"
                            class="block w-32 text-sm font-medium text-gray-900"
                        >
                            Stock Level
                        </label>
                        <input
                            v-model="stockItem.stock_level"
                            type="number"
                            id="price"
                            min="1"
                            step="any"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2.5"
                        required>
                    </div>
                </div>
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
            suppliers: [],
            supplierId: '',
            gender: '',
            brand: '',
            colour: '',
            category: '',
            material: '',
            materials: [],
            genders: [
                {
                    id: 1,
                    name: 'men'
                },
                {
                    id: 2,
                    name: 'women'
                },
                {
                    id: 3,
                    name: 'unisex'
                },
                {
                    id: 4,
                    name: 'kids'
                }
            ],
            categories: [],
            brands: [],
            colours: [
                {
                    id: 1,
                    name: 'Black'
                },
                {
                    id: 2,
                    name: 'Blue'
                },
                {
                    id: 3,
                    name: 'Brown'
                },
                {
                    id: 4,
                    name: 'Green'
                },
                {
                    id: 5,
                    name: 'Grey'
                },
                {
                    id: 6,
                    name: 'Multi'
                },
                {
                    id: 7,
                    name: 'Orange'
                },
                {
                    id: 8,
                    name: 'Pink'
                },
                {
                    id: 9,
                    name: 'Purple'
                },
                {
                    id: 10,
                    name: 'Red'
                },
                {
                    id: 11,
                    name: 'White'
                },
                {
                    id: 12,
                    name: 'Yellow'
                }
            ],
        }
    },
    mounted() {
        this.getSuppliers();
        this.getDropdowns();
    },
    methods: {
        async addStockItem() {
            try {
                this.stockItem.gender = this.gender;
                this.stockItem.brand = this.brand;
                this.stockItem.colour = this.colour;
                this.stockItem.material = this.material;
                this.stockItem.category = this.category;
                this.stockItem.supplier_id = this.supplierId;
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
                });
        },
        getDropdowns() {
            axios.get("http://127.0.0.1:8080/api/dropdown_group/" + 'brand')
                .then((response) => {
                    this.brands = response.data;
                });
            axios.get("http://127.0.0.1:8080/api/dropdown_group/" + 'category')
                .then((response) => {
                    this.categories = response.data;
                });
            axios.get("http://127.0.0.1:8080/api/dropdown_group/" + 'material')
                .then((response) => {
                    this.materials = response.data;
                });
        }
    }
}
</script>

<style>

</style>