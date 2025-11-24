<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ salesAgent: Object, salesLocations: Array, users: Array });

const form = useForm({
  name: props.salesAgent?.name || '',
  position: props.salesAgent?.position || '',
  email: props.salesAgent?.email || '',
  phone: props.salesAgent?.phone || '',
  address: props.salesAgent?.address || '',
  sales_location_id: props.salesAgent?.sales_location_id || '',
});

function submit() {
  if (props.salesAgent) {
    form.put(route('sales-agents.update', props.salesAgent.id));
  } else {
    form.post(route('sales-agents.store'));
  }
}

</script>

<template>
  <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
    <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
      <i class="fas fa-user-tie text-green-600"></i>
      {{ props.salesAgent ? 'Edit Sales Agent' : 'New Sales Agent' }}
    </h1>
    <form @submit.prevent="submit" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold mb-1">Name</label>
          <input v-model="form.name" required type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Full Name" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Position</label>
          <input v-model="form.position" type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Position" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Email</label>
          <input v-model="form.email" required type="email" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Email Address" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Phone</label>
          <input v-model="form.phone" type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Phone Number" />
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold mb-1">Address</label>
          <textarea v-model="form.address" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Address"></textarea>
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Sales Location</label>
          <select v-model="form.sales_location_id" required class="form-select w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500">
            <option value="">-- Select Sales Location --</option>
            <option v-for="l in salesLocations" :key="l.id" :value="l.id">{{ l.name }}</option>
          </select>
        </div>
      </div>
      <div class="flex justify-end gap-2 mt-8">
        <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
          <i class="fas fa-save mr-2"></i> {{ props.salesAgent ? 'Update' : 'Create' }} Sales Agent
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
