<template>
<div>
    <div class="flex justify-between m-2 p-2">
        <span class="self-center text-xl font-semibold whitespace-nowrap">
            Add Stock Item
        </span>
    </div>
  <div class="relative overflow-x-auto m-2 p-2">
    <form>
        <div class="mb-6">
            <label for="name"
                class="block mb-2 text-sm font-medium text-gray-900"
            >
                Name
            </label>
            <input
                v-model="stockItem.name"
                type="text"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-3/4 p-2.5"
            required>
        </div>
        <div class="mb-6">
            <label for="name"
                class="block mb-2 text-sm font-medium text-gray-900"
            >
                Supplier
            </label>
            <input
                v-model="stockItem.supplier_id"
                type="text"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
            required>
        </div>
        <div class="mb-6">
            <label for="name"
                class="block mb-2 text-sm font-medium text-gray-900"
            >
                Shoe Size
            </label>
            <input
                v-model="stockItem.shoe_size"
                type="text"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/5 p-2.5"
            required>
        </div>
        <div class="mb-6">
            <label for="name"
                class="block mb-2 text-sm font-medium text-gray-900"
            >
                Material
            </label>
            <input
                v-model="stockItem.material"
                type="text"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
            required>
        </div>
        <div class="mb-6">
            <label for="name"
                class="block mb-2 text-sm font-medium text-gray-900"
            >
                Category
            </label>
            <input
                v-model="stockItem.category"
                type="text"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5"
            required>
        </div>
        <div class="flex justify-end pr-4">
            <button
                @click="editStockItem"
                type="submit"
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
    props: {
        id: {
            type: Number
        }
    },
    data() {
        return {
            stockItem: {}
        }
    },
    mounted() {
        console.log(this.$route.params);
        console.log(this.$route.params.id);
        // this.id = this.$route.params.id;
        this.getStockItem(this.$route.params.id);
    },
    methods: {
        getStockItem(id) {
            axios.get("http://127.0.0.1:8080/api/stockitems/" + id)
                .then((response) => {
                    this.stockItem = response.data.data;
                });
        },
        editStockItem() {
            try {
            axios.put("http://127.0.0.1:8080/api/stockitems/" + id, this.stockItem).then(
                this.$router.push({path: '/stock'})
            );
            } catch (error) {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
            }

//   const updateSkill = async (id) => {
//     try {
//       await axios.put("skills/" + id, skill.value);
//       await router.push({ name: "SkillIndex" });
//     } catch (error) {
//       if (error.response.status === 422) {
//         errors.value = error.response.data.errors;
//       }
//     }
//   };
        }
    }
}
</script>

<style>

</style>