<template>
<div class="mt-12">
  <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="px-6 py-3">
                      Order DateTime
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Notes
                  </th>
                  <th scope="col" class="px-6 py-3">
                      UserID
                  </th>
                  <th scope="col" class="px-6 py-3">
                      SupplierID
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Created At
                  </th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="order in orders" :key="order.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="px-6 py-4">
                      {{ order.order_datetime }}
                  </td>
                  <td class="px-6 py-4">
                      {{ order.notes }}
                  </td>
                  <td class="px-6 py-4">
                      {{ order.user_id }}
                  </td>
                  <td class="px-6 py-4">
                      {{ order.supplier_id }}
                  </td>
                  <td class="px-6 py-4">
                      {{ order.created_at }}
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
                });
        }
    }
}
</script>

<style>

</style>