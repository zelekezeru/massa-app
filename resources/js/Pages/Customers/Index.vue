<template>
  <div>
    <h1>Customers</h1>
    <inertia-link :href="route('customers.create')" class="btn">Add Customer</inertia-link>
    <table class="table-auto w-full">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers" :key="customer.id">
          <td>{{ customer.name }}</td>
          <td>{{ customer.email }}</td>
          <td>{{ customer.phone }}</td>
          <td>
            <inertia-link :href="route('customers.show', customer.id)">View</inertia-link>
            <inertia-link :href="route('customers.edit', customer.id)">Edit</inertia-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
const props = defineProps({ customers: Array });
</script>
