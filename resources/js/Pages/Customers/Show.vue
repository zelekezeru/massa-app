<template>
  <div>
    <h1>Customer Details</h1>
    <div v-if="!customer">Customer not found.</div>
    <div v-else>
      <p><strong>Name:</strong> {{ customer.name }}</p>
      <p><strong>Email:</strong> {{ customer.email }}</p>
      <p><strong>Phone:</strong> {{ customer.phone }}</p>
      <inertia-link :href="route('customers.edit', customer.id)">Edit</inertia-link>
      <inertia-link :href="route('customers.index')">Back to List</inertia-link>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ customer: Object });
</script>
