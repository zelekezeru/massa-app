<template>
  <div>
    <h1>Product Details</h1>
    <p><strong>Name:</strong> {{ product.name }}</p>
    <p><strong>Category:</strong> {{ product.category?.name }}</p>
    <p><strong>Price:</strong> {{ product.price }}</p>
    <inertia-link :href="route('products.edit', product.id)" class="btn btn-secondary">Edit</inertia-link>
    <inertia-link :href="route('products.index')" class="btn btn-light">Back</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ product: Object });
</script>
