<template>
  <div>
    <h1>Products</h1>
    <inertia-link :href="route('products.create')" class="btn btn-primary mb-4">Create Product</inertia-link>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th>Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products.data" :key="product.id">
          <td>{{ product.name }}</td>
          <td>{{ product.category?.name }}</td>
          <td>{{ product.price }}</td>
          <td>
            <inertia-link :href="route('products.edit', product.id)" class="btn btn-sm btn-secondary">Edit</inertia-link>
            <inertia-link :href="route('products.show', product.id)" class="btn btn-sm btn-info">View</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ products: Object });
</script>
