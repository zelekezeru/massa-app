<template>
  <div>
    <h1>Seed Details</h1>
    <p><strong>Name:</strong> {{ seed.name }}</p>
    <p><strong>Variety:</strong> {{ seed.variety }}</p>
    <p><strong>Description:</strong> {{ seed.description }}</p>
    <inertia-link :href="route('seeds.edit', seed.id)" class="btn btn-secondary">Edit</inertia-link>
    <inertia-link :href="route('seeds.index')" class="btn btn-light">Back</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ seed: Object });
</script>
