<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, defineProps } from 'vue';

const props = defineProps({ customers: Array });

</script>

<template>
  <Head title="Customers" />

  <AuthenticatedLayout>

    <div class="page-inner py-6 px-4 bg-light min-vh-100">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-green-800 mb-2 md:mb-0 tracking-tight drop-shadow-sm">
          <i class="fas fa-users mr-2 text-green-600"></i> Customers
        </h1>
        <Link :href="route('customers.create')" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-6 py-2 rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
          <i class="fas fa-plus"></i> New Customer
        </Link>
      </div>
      <div class="bg-white rounded-xl shadow-lg overflow-x-auto animate-fade-in">
        <table class="min-w-full divide-y divide-green-100">
          <thead class="bg-green-50">
            <tr>
              <th class="px-4 py-3 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Name</th>
              <th class="px-4 py-3 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Email</th>
              <th class="px-4 py-3 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Phone</th>
              <th class="px-4 py-3 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Location</th>
              <th class="px-4 py-3 text-center text-xs font-bold text-green-700 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-green-50">
            <tr v-if="customers.length === 0">
              <td colspan="5" class="text-center py-8 text-gray-400 text-lg">No customers found.</td>
            </tr>
            <tr v-for="customer in customers" :key="customer.id" class="hover:bg-green-50 transition">
              <td class="px-4 py-3 font-semibold text-green-900">{{ customer.name }}</td>
              <td class="px-4 py-3">{{ customer.email }}</td>
              <td class="px-4 py-3">{{ customer.phone }}</td>
              <td class="px-4 py-3">{{ customer.location }}</td>
              <td class="px-4 py-3 text-center flex gap-2 justify-center">
                <Link :href="route('customers.show', customer.id)" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold">
                  <i class="fas fa-eye mr-1"></i> View
                </Link>
                <Link :href="route('customers.edit', customer.id)" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs font-semibold">
                  <i class="fas fa-edit mr-1"></i> Edit
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
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
