<template>
  <div>
    <h1>Price List Details</h1>
    <p><strong>Name:</strong> {{ pricelist.name }}</p>
    <p><strong>Description:</strong> {{ pricelist.description }}</p>
    <inertia-link :href="route('pricelists.edit', pricelist.id)" class="btn btn-secondary">Edit</inertia-link>
    <inertia-link :href="route('pricelists.index')" class="btn btn-light">Back</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ pricelist: Object });
</script>
