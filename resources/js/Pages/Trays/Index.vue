<template>
  <div>
    <h1>Trays</h1>
    <inertia-link :href="route('trays.create')" class="btn btn-primary mb-4">Create Tray</inertia-link>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tray in trays.data" :key="tray.id">
          <td>{{ tray.name }}</td>
          <td>{{ tray.type }}</td>
          <td>{{ tray.description }}</td>
          <td>
            <inertia-link :href="route('trays.edit', tray.id)" class="btn btn-sm btn-secondary">Edit</inertia-link>
            <inertia-link :href="route('trays.show', tray.id)" class="btn btn-sm btn-info">View</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ trays: Object });
</script>
