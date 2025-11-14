<template>
  <div>
    <h1>Add Customer</h1>
    <form @submit.prevent="submit">
      <label>Name</label>
      <input v-model="form.name" required />
      <label>Email</label>
      <input v-model="form.email" type="email" />
      <label>Phone</label>
      <input v-model="form.phone" />
      <button type="submit">Save</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
const form = useForm({ name: '', email: '', phone: '' });
function submit() {
  form.post(route('customers.store'));
}
</script>
