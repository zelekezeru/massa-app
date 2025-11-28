<template>
  <div>
    <h1>Farm Details</h1>
    <p><strong>Name:</strong> {{ farm.name }}</p>
    <p><strong>Location:</strong> {{ farm.location }}</p>
    <p><strong>Description:</strong> {{ farm.description }}</p>
    <inertia-link :href="route('farms.edit', farm.id)" class="btn btn-secondary">Edit</inertia-link>
    <inertia-link :href="route('farms.index')" class="btn btn-light">Back</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ farm: Object });
</script>
