<template>
  <div>
    <h1>Price Lists</h1>
    <inertia-link :href="route('pricelists.create')" class="btn btn-primary mb-4">Create Price List</inertia-link>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="pricelist in pricelists.data" :key="pricelist.id">
          <td>{{ pricelist.name }}</td>
          <td>{{ pricelist.description }}</td>
          <td>
            <inertia-link :href="route('pricelists.edit', pricelist.id)" class="btn btn-sm btn-secondary">Edit</inertia-link>
            <inertia-link :href="route('pricelists.show', pricelist.id)" class="btn btn-sm btn-info">View</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ pricelists: Object });
</script>
