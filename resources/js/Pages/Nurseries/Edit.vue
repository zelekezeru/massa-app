<template>
  <div>
    <h1>Edit Nursery</h1>
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
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
const props = defineProps({ nursery: Object });
const form = useForm({ ...props.nursery });
const submit = () => form.put(route('nurseries.update', props.nursery.id));
</script>
