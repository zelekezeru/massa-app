<template>
  <div>
    <h1>Edit Seed</h1>
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
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
const props = defineProps({ seed: Object });
const form = useForm({ ...props.seed });
const submit = () => form.put(route('seeds.update', props.seed.id));
</script>
