<template>
  <div>
    <h1>Create Product</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Name</label>
        <input v-model="form.name" required />
      </div>
      <div>
        <label>Category</label>
        <input v-model="form.category_id" />
      </div>
      <div>
        <label>Price</label>
        <input v-model="form.price" type="number" step="0.01" />
      </div>
      <button type="submit">Create</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
const form = useForm({ name: '', category_id: '', price: '' });
const submit = () => form.post(route('products.store'));
</script>
