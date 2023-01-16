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
      <table class="w-full text-sm text-left text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-blue-50">
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
              <tr v-for="delivery in deliveries" :key="delivery.id" class="bg-white border-b hover:bg-gray-50">
                  <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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