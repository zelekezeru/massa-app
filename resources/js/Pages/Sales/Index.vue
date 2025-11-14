<template>
  <div>
    <h1>Sales List</h1>
    <div v-if="sales.length === 0">No sales found.</div>
    <table v-else class="table-auto w-full">
      <thead>
        <tr>
          <th>Invoice No</th>
          <th>Customer</th>
          <th>Agent</th>
          <th>Date</th>
          <th>Total</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sale in sales" :key="sale.id">
          <td>{{ sale.invoice_no }}</td>
          <td>{{ sale.customer?.name }}</td>
          <td>{{ sale.agent?.name }}</td>
          <td>{{ sale.invoice_date }}</td>
          <td>{{ sale.total }}</td>
          <td>
            <inertia-link :href="route('sales.show', sale.id)">View</inertia-link>
            <inertia-link :href="route('sales.edit', sale.id)">Edit</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
    <inertia-link :href="route('sales.create')" class="btn">Create Sale</inertia-link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ sales: Array });
</script>
