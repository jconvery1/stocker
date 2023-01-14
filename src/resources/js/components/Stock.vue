<template>
<div>
  <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                  <th scope="col" class="px-6 py-3">
                      Name
                  </th>
                  <th scope="col" class="px-6 py-3">
                      SupplierID
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Image
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Shoe Size
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Material
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Category
                  </th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="stockItem in stockItems" :key="stockItem.id" class="bg-white border-b hover:bg-gray-50">
                  <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                      {{ stockItem.name }}
                  </td>
                  <td class="px-6 py-4">
                      {{ stockItem.supplier_id }}
                  </td>
                  <td class="px-6 py-4">
                      {{ stockItem.image }}
                  </td>
                  <td class="px-6 py-4">
                      {{ stockItem.shoe_size }}
                  </td>
                  <td class="px-6 py-4">
                      {{ stockItem.material }}
                  </td>
                  <td class="px-6 py-4">
                      {{ stockItem.category }}
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            stockItems: null
        }
    },
    mounted() {
        this.getStockItems();
    },
    methods: {
        getStockItems() {
            axios.get("http://127.0.0.1:8080/api/stockitems")
                .then((response) => {
                    this.stockItems = response.data.data;
                });
        }
    }
}
</script>

<style>

</style>