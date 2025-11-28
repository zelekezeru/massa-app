<template>
  <div>
    <h1>Edit Tray</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Name</label>
        <input v-model="form.name" required />
      </div>
      <div>
        <label>Type</label>
        <input v-model="form.type" />
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
const props = defineProps({ tray: Object });
const form = useForm({ ...props.tray });
const submit = () => form.put(route('trays.update', props.tray.id));
</script>
