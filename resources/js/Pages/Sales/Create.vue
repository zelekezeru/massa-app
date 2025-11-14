<template>
  <div>
    <h1>Create Sale</h1>
    <!-- Form fields for creating a sale -->
    <form @submit.prevent="submit">
      <!-- Example: Customer -->
      <label>Customer</label>
      <select v-model="form.customer_id" required>
        <option v-for="c in customers" :key="c.id" :value="c.id">{{ c.name }}</option>
      </select>
      <!-- Add more fields for products, agents, locations, items, etc. -->
      <button type="submit">Save</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
const props = defineProps({ customers: Array, products: Array, agents: Array, locations: Array });
const form = useForm({
  customer_id: '',
  // Add other fields as needed
});
function submit() {
  form.post(route('sales.store'));
}
</script>
