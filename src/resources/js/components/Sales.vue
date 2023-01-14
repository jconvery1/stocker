<template>
<div>
  <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="px-6 py-3">
                      CustomerID
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Sale Price
                  </th>
                  <th scope="col" class="px-6 py-3">
                      UserID
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Created At
                  </th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="sale in sales" :key="sale.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ sale.customer_id }}
                  </td>
                  <td class="px-6 py-4">
                      {{ sale.sale_price }}
                  </td>
                  <td class="px-6 py-4">
                      {{ sale.user_id }}
                  </td>
                  <td class="px-6 py-4">
                      {{ sale.created_at }}
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
            sales: null
        }
    },
    mounted() {
        this.getSales();
    },
    methods: {
        getSales() {
            axios.get("http://127.0.0.1:8080/api/sales")
                .then((response) => {
                    this.sales = response.data.data;
                });
        }
    }
}
</script>

<style>

</style>