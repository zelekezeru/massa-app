<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ customerType: Object });

const form = useForm({
  name: props.customerType?.name || '',
  description: props.customerType?.description || '',
});

function submit() {
  if (props.customerType) {
    form.put(route('customer-types.update', props.customerType.id));
  } else {
    form.post(route('customer-types.store'));
  }
}

</script>

<template>
  <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
    <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
      <i class="fas fa-tags text-green-600"></i>
      {{ props.customerType ? 'Edit Customer Type' : 'New Customer Type' }}
    </h1>
    <form @submit.prevent="submit" class="space-y-6">
      <div class="grid grid-cols-1 gap-6">
        <div>
          <label class="block text-sm font-semibold mb-1">Name</label>
          <input v-model="form.name" required type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Type Name" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Description</label>
          <textarea v-model="form.description" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Description"></textarea>
        </div>
      </div>
      <div class="flex justify-end gap-2 mt-8">
        <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
          <i class="fas fa-save mr-2"></i> {{ props.customerType ? 'Update' : 'Create' }} Customer Type
        </button>
      </div>
    </form>
  </div>
</template>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.3s;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(16px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
