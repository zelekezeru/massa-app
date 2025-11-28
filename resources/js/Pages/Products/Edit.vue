<template>
  <div>
    <h1>Edit Product</h1>
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
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
const props = defineProps({ product: Object });
const form = useForm({ ...props.product });
const submit = () => form.put(route('products.update', props.product.id));
</script>
