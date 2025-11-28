<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ cropCategories: Array, crop: Object });

const form = useForm({
  name: props.crop?.name || '',
  category_id: props.crop?.category_id || '',
  description: props.crop?.description || ''
});

const submit = () => {
  if (props.crop) {
    form.put(route('crops.update', props.crop.id));
  } else {
    form.post(route('crops.store'));
  }
};
</script>

<template>
  <form @submit.prevent="submit" class="space-y-6">
    <div>
      <label class="block text-sm font-semibold mb-1">Crop Name</label>
      <input v-model="form.name" required class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" />
    </div>
    <div>
      <label class="block text-sm font-semibold mb-1">Category</label>
      <select v-model="form.category_id" required class="form-select w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500">
        <option value="" disabled>Select category</option>
        <option v-for="cat in cropCategories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
      </select>
    </div>
    <div>
      <label class="block text-sm font-semibold mb-1">Description</label>
      <textarea v-model="form.description" class="form-textarea w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500"></textarea>
    </div>
    <div>
      <button type="submit" class="btn btn-success">{{ props.crop ? 'Update Crop' : 'Create Crop' }}</button>
    </div>
  </form>
</template>
