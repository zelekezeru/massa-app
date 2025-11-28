<template>
  <div>
    <h1>Payments</h1>
    <inertia-link :href="route('payments.create')" class="btn btn-primary mb-4">Add Payment</inertia-link>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="payment in payments.data" :key="payment.id">
          <td>{{ payment.customer?.name }}</td>
          <td>{{ payment.amount }}</td>
          <td>{{ payment.date }}</td>
          <td>
            <inertia-link :href="route('payments.edit', payment.id)" class="btn btn-sm btn-secondary">Edit</inertia-link>
            <inertia-link :href="route('payments.show', payment.id)" class="btn btn-sm btn-info">View</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ payments: Object });
</script>
