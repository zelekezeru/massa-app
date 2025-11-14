<template>
  <div>
    <h1>Edit Sale</h1>
    <form @submit.prevent="submit">
      <label>Customer</label>
      <select v-model="form.customer_id" required>
        <option v-for="c in customers" :key="c.id" :value="c.id">{{ c.name }}</option>
      </select>
      <!-- Add more fields for products, agents, locations, items, etc. -->
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
const props = defineProps({ sale: Object, customers: Array, products: Array, agents: Array, locations: Array });
const form = useForm({
  customer_id: props.sale.customer_id,
  // Add other fields as needed
});
function submit() {
  form.put(route('sales.update', props.sale.id));
}
</script>
