<template>
  <div>
    <h1>Create Nursery</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Name</label>
        <input v-model="form.name" required />
      </div>
      <div>
        <label>Location</label>
        <input v-model="form.location" />
      </div>
      <div>
        <label>Description</label>
        <textarea v-model="form.description"></textarea>
      </div>
      <button type="submit">Create</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
const form = useForm({ name: '', location: '', description: '' });
const submit = () => form.post(route('nurseries.store'));
</script>
