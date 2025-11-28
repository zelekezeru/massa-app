<template>
  <div>
    <h1>Edit Price List</h1>
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
const props = defineProps({ pricelist: Object });
const form = useForm({ ...props.pricelist });
const submit = () => form.put(route('pricelists.update', props.pricelist.id));
</script>
