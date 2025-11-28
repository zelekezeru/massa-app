<template>
  <div>
    <h1>Nursery Details</h1>
    <p><strong>Name:</strong> {{ nursery.name }}</p>
    <p><strong>Location:</strong> {{ nursery.location }}</p>
    <p><strong>Description:</strong> {{ nursery.description }}</p>
    <inertia-link :href="route('nurseries.edit', nursery.id)" class="btn btn-secondary">Edit</inertia-link>
    <inertia-link :href="route('nurseries.index')" class="btn btn-light">Back</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ nursery: Object });
</script>
