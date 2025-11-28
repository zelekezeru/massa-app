<template>
  <div>
    <h1>Farms</h1>
    <inertia-link :href="route('farms.create')" class="btn btn-primary mb-4">Create Farm</inertia-link>
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
        <tr v-for="farm in farms.data" :key="farm.id">
          <td>{{ farm.name }}</td>
          <td>{{ farm.location }}</td>
          <td>{{ farm.description }}</td>
          <td>
            <inertia-link :href="route('farms.edit', farm.id)" class="btn btn-sm btn-secondary">Edit</inertia-link>
            <inertia-link :href="route('farms.show', farm.id)" class="btn btn-sm btn-info">View</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ farms: Object });
</script>
