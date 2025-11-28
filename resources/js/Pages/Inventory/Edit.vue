<template>
  <div>
    <h1>Edit Inventory</h1>
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
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
const props = defineProps({ inventory: Object });
const form = useForm({ ...props.inventory });
const submit = () => form.put(route('inventory.update', props.inventory.id));
</script>
