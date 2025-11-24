<script setup>
import { ref, computed } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({ customer: Object, salesLocations: Array, salesAgents: Array, customerTypes: Array });

const form = useForm({
  name: props.customer?.name || '',
  contact_person: props.customer?.contact_person || '',
  phone: props.customer?.phone || '',
  email: props.customer?.email || '',
  type: props.customer?.type || '',
  credit_limit: props.customer?.credit_limit || 0,
  sales_location_id: props.customer?.sales_location_id || '',
  address: props.customer?.address || '',
  sales_agent_id: props.customer?.sales_agent_id || '',
});

function submit() {
  if (props.customer) {
    form.put(route('customers.update', props.customer.id));
  } else {
    form.post(route('customers.store'));
  }
}

</script>

<template>
  <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
    <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
      <i class="fas fa-user-plus text-green-600"></i>
      {{ props.customer ? 'Edit Customer' : 'New Customer' }}
    </h1>
    <form @submit.prevent="submit" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold mb-1">Name</label>
          <input v-model="form.name" required type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Full Name" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Contact Person</label>
          <input v-model="form.contact_person" type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Contact Person" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Phone</label>
          <input v-model="form.phone" type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Phone Number" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Email</label>
          <input v-model="form.email" type="email" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Email Address" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Type</label>
          <select v-model="form.type" class="form-select w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500">
            <option value="" disabled>Select customer type</option>
            <option v-for="type in props.customerTypes" :key="type.id" :value="type.name">{{ type.name }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Credit Limit</label>
          <input v-model="form.credit_limit" type="number" step="0.01" min="0" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Credit Limit" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Sales Location</label>
          <select v-model="form.sales_location_id" class="form-select w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500">
            <option value="">-- Select Sales Location --</option>
            <option v-for="location in props.salesLocations" :key="location.id" :value="location.id">{{ location.name }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Sales Agent</label>
          <select v-model="form.sales_agent_id" class="form-select w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500">
            <option value="">-- Select Sales Agent --</option>
            <option v-for="agent in props.salesAgents" :key="agent.id" :value="agent.id">{{ agent.user?.name }}</option>
          </select>
        </div>
      </div>
      <div class="flex justify-end gap-2 mt-8">
        <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
          <i class="fas fa-save mr-2"></i> {{ props.customer ? 'Update' : 'Create' }} Customer
        </button>
      </div>
    </form>
  </div>
</template>
