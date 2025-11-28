<template>
  <div>
    <h1>Edit Product Category</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Name</label>
        <input v-model="form.name" required />
      </div>
      <div>
        <label>Description</label>
        <textarea v-model="form.description"></textarea>
      </div>
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
const props = defineProps({ productcategory: Object });
const form = useForm({ ...props.productcategory });
const submit = () => form.put(route('productcategories.update', props.productcategory.id));
</script>
