<template>
  <div>
    <h1>Edit Customer</h1>
    <form @submit.prevent="submit">
      <label>Name</label>
      <input v-model="form.name" required />
      <label>Email</label>
      <input v-model="form.email" type="email" />
      <label>Phone</label>
      <input v-model="form.phone" />
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
const props = defineProps({ customer: Object });
const form = useForm({
  name: props.customer.name,
  email: props.customer.email,
  phone: props.customer.phone,
});
function submit() {
  form.put(route('customers.update', props.customer.id));
}
</script>
