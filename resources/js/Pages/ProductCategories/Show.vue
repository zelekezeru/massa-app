<template>
  <div>
    <h1>Product Category Details</h1>
    <p><strong>Name:</strong> {{ productcategory.name }}</p>
    <p><strong>Description:</strong> {{ productcategory.description }}</p>
    <inertia-link :href="route('productcategories.edit', productcategory.id)" class="btn btn-secondary">Edit</inertia-link>
    <inertia-link :href="route('productcategories.index')" class="btn btn-light">Back</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ productcategory: Object });
</script>
