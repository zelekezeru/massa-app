<template>
  <div>
    <h1>Payment Details</h1>
    <p><strong>Customer:</strong> {{ payment.customer?.name }}</p>
    <p><strong>Amount:</strong> {{ payment.amount }}</p>
    <p><strong>Date:</strong> {{ payment.date }}</p>
    <inertia-link :href="route('payments.edit', payment.id)" class="btn btn-secondary">Edit</inertia-link>
    <inertia-link :href="route('payments.index')" class="btn btn-light">Back</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ payment: Object });
</script>
