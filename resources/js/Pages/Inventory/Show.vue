<template>
  <div>
    <h1>Inventory Details</h1>
    <p><strong>Product:</strong> {{ inventory.product?.name }}</p>
    <p><strong>Quantity:</strong> {{ inventory.quantity }}</p>
    <p><strong>Location:</strong> {{ inventory.location }}</p>
    <inertia-link :href="route('inventory.edit', inventory.id)" class="btn btn-secondary">Edit</inertia-link>
    <inertia-link :href="route('inventory.index')" class="btn btn-light">Back</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ inventory: Object });
</script>
