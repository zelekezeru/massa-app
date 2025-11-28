<template>
  <div>
    <h1>Add Payment</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Customer</label>
        <input v-model="form.customer_id" required />
      </div>
      <div>
        <label>Amount</label>
        <input v-model="form.amount" type="number" required />
      </div>
      <div>
        <label>Date</label>
        <input v-model="form.date" type="date" required />
      </div>
      <button type="submit">Add</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
const form = useForm({ customer_id: '', amount: '', date: '' });
const submit = () => form.post(route('payments.store'));
</script>
