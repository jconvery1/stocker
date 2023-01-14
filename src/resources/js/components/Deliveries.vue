<template>
<div class="mt-12">
  <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="px-6 py-3">
                      UserID
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Delivery DateTime
                  </th>
                  <th scope="col" class="px-6 py-3">
                      OrderID
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Created At
                  </th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="delivery in deliveries" :key="delivery.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="px-6 py-4">
                      {{ delivery.user_id }}
                  </td>
                  <td class="px-6 py-4">
                      {{ delivery.delivery_datetime }}
                  </td>
                  <td class="px-6 py-4">
                      {{ delivery.order_id }}
                  </td>
                  <td class="px-6 py-4">
                      {{ delivery.created_at }}
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
                    this.deliveries = response.data.data;
                });
        }
    }
}
</script>

<style>

</style>