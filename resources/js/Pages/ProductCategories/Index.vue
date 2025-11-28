<template>
  <div>
    <h1>Product Categories</h1>
    <inertia-link :href="route('productcategories.create')" class="btn btn-primary mb-4">Create Category</inertia-link>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="category in productcategories.data" :key="category.id">
          <td>{{ category.name }}</td>
          <td>{{ category.description }}</td>
          <td>
            <inertia-link :href="route('productcategories.edit', category.id)" class="btn btn-sm btn-secondary">Edit</inertia-link>
            <inertia-link :href="route('productcategories.show', category.id)" class="btn btn-sm btn-info">View</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ productcategories: Object });
</script>
