<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ salesLocation: Object });

const form = useForm({
  name: props.salesLocation?.name || '',
  address: props.salesLocation?.address || '',
  city: props.salesLocation?.city || '',
  state: props.salesLocation?.state || '',
  zip: props.salesLocation?.zip || '',
});

function submit() {
  if (props.salesLocation) {
    form.put(route('sales-locations.update', props.salesLocation.id));
  } else {
    form.post(route('sales-locations.store'));
  }
}

</script>

<template>
  <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
    <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
      <i class="fas fa-map-marker-alt text-green-600"></i>
      {{ props.salesLocation ? 'Edit Sales Location' : 'New Sales Location' }}
    </h1>
    <form @submit.prevent="submit" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold mb-1">Name</label>
          <input v-model="form.name" required type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Location Name" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Address</label>
          <input v-model="form.address" type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Address" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">City</label>
          <input v-model="form.city" type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="City" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">State</label>
          <input v-model="form.state" type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="State" />
        </div>
      </div>
      <div class="flex justify-end gap-2 mt-8">
        <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
          <i class="fas fa-save mr-2"></i> {{ props.salesLocation ? 'Update' : 'Create' }} Sales Location
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
