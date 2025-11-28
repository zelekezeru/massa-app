<template>
  <div>
    <h1>Edit Payment</h1>
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
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
const props = defineProps({ payment: Object });
const form = useForm({ ...props.payment });
const submit = () => form.put(route('payments.update', props.payment.id));
</script>
