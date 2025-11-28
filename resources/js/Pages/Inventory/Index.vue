<template>
  <div>
    <h1>Inventory</h1>
    <inertia-link :href="route('inventory.create')" class="btn btn-primary mb-4">Add Inventory</inertia-link>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Location</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in inventory.data" :key="item.id">
          <td>{{ item.product?.name }}</td>
          <td>{{ item.quantity }}</td>
          <td>{{ item.location }}</td>
          <td>
            <inertia-link :href="route('inventory.edit', item.id)" class="btn btn-sm btn-secondary">Edit</inertia-link>
            <inertia-link :href="route('inventory.show', item.id)" class="btn btn-sm btn-info">View</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ inventory: Object });
</script>
