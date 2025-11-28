<template>
  <div>
    <h1>Tray Details</h1>
    <p><strong>Name:</strong> {{ tray.name }}</p>
    <p><strong>Type:</strong> {{ tray.type }}</p>
    <p><strong>Description:</strong> {{ tray.description }}</p>
    <inertia-link :href="route('trays.edit', tray.id)" class="btn btn-secondary">Edit</inertia-link>
    <inertia-link :href="route('trays.index')" class="btn btn-light">Back</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ tray: Object });
</script>
