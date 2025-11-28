<template>
  <div>
    <h1>Create Seed</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Name</label>
        <input v-model="form.name" required />
      </div>
      <div>
        <label>Variety</label>
        <input v-model="form.variety" />
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
import { reactive } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
const form = useForm({ name: '', variety: '', description: '' });
const submit = () => form.post(route('seeds.store'));
</script>
