<template>
  <div>
    <h1>Sale Details</h1>
    <div v-if="!sale">Sale not found.</div>
    <div v-else>
      <p><strong>Invoice No:</strong> {{ sale.invoice_no }}</p>
      <p><strong>Customer:</strong> {{ sale.customer?.name }}</p>
      <p><strong>Agent:</strong> {{ sale.agent?.name }}</p>
      <p><strong>Date:</strong> {{ sale.invoice_date }}</p>
      <p><strong>Total:</strong> {{ sale.total }}</p>
      <h2>Items</h2>
      <ul>
        <li v-for="item in sale.items" :key="item.id">
          {{ item.product_id }} - {{ item.quantity }} x {{ item.unit_price }} = {{ item.line_total }}
        </li>
      </ul>
      <inertia-link :href="route('sales.edit', sale.id)">Edit</inertia-link>
      <inertia-link :href="route('sales.index')">Back to List</inertia-link>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ sale: Object });
</script>
