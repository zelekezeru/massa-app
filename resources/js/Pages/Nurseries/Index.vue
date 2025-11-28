<template>
  <div>
    <h1>Nurseries</h1>
    <inertia-link :href="route('nurseries.create')" class="btn btn-primary mb-4">Create Nursery</inertia-link>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th>Name</th>
          <th>Location</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="nursery in nurseries.data" :key="nursery.id">
          <td>{{ nursery.name }}</td>
          <td>{{ nursery.location }}</td>
          <td>{{ nursery.description }}</td>
          <td>
            <inertia-link :href="route('nurseries.edit', nursery.id)" class="btn btn-sm btn-secondary">Edit</inertia-link>
            <inertia-link :href="route('nurseries.show', nursery.id)" class="btn btn-sm btn-info">View</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ nurseries: Object });
</script>
