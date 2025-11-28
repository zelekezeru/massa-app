<template>
  <div>
    <h1>Seeds</h1>
    <inertia-link :href="route('seeds.create')" class="btn btn-primary mb-4">Create Seed</inertia-link>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th>Name</th>
          <th>Variety</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="seed in seeds.data" :key="seed.id">
          <td>{{ seed.name }}</td>
          <td>{{ seed.variety }}</td>
          <td>{{ seed.description }}</td>
          <td>
            <inertia-link :href="route('seeds.edit', seed.id)" class="btn btn-sm btn-secondary">Edit</inertia-link>
            <inertia-link :href="route('seeds.show', seed.id)" class="btn btn-sm btn-info">View</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ seeds: Object });
</script>
