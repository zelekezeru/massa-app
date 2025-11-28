<template>
  <div>
    <h1>Add Inventory</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Product</label>
        <input v-model="form.product_id" required />
      </div>
      <div>
        <label>Quantity</label>
        <input v-model="form.quantity" type="number" required />
      </div>
      <div>
        <label>Location</label>
        <input v-model="form.location" />
      </div>
      <button type="submit">Add</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
const form = useForm({ product_id: '', quantity: '', location: '' });
const submit = () => form.post(route('inventory.store'));
</script>
