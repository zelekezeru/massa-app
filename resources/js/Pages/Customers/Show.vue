<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ customer: Object });

function deleteCustomer() {
  if (confirm('Are you sure you want to delete this customer?')) {
    router.delete(route('customers.destroy', props.customer.id));
  }
}
</script>

<template>
  <Head :title="props.customer ? props.customer.name : 'Customer Details'" />
  <AppLayout>
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
      <div v-if="!props.customer" class="text-center text-gray-400 text-lg py-12">
        Customer not found.
      </div>
      <div v-else>
        <div class="flex items-center justify-between mb-6">
          <h1 class="text-2xl font-bold text-green-800 flex items-center gap-2">
            <i class="fas fa-user text-green-600"></i> {{ props.customer.name }}
          </h1>
          <div class="flex gap-2">
            <Link :href="route('customers.edit', props.customer.id)" class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-sm font-semibold">
              <i class="fas fa-edit mr-1"></i> Edit
            </Link>
            <!-- Delete -->
            <form @submit.prevent="deleteCustomer" class="inline">
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded hover:bg-red-200 transition text-sm font-semibold">
              <i class="fas fa-trash mr-1"></i> Delete
              </button>
            </form>
            <Link :href="route('customers.index')" class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-sm font-semibold">
              <i class="fas fa-list mr-1"></i> Back to List
            </Link>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div>
            <p class="mb-2"><span class="font-semibold text-green-700">Email:</span> {{ props.customer.email }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Phone:</span> {{ props.customer.phone }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Location:</span> {{ props.customer.location }}</p>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
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
