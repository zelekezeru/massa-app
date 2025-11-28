<template>
  <div>
    <h1>Edit Farm</h1>
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
const props = defineProps({ farm: Object });
const form = useForm({ ...props.farm });
const submit = () => form.put(route('farms.update', props.farm.id));
</script>
