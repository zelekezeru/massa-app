<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, defineProps } from 'vue';
import { UserGroupIcon, ClipboardDocumentListIcon } from '@heroicons/vue/24/outline';
import ShowCustomerTypes from "./Tabs/ShowCustomerTypes.vue";

const props = defineProps({ customers: Array, customerTypes: Array });

// Multi-tab navigation logic
const selectedTab = ref('all');
const tabs = [
  { key: 'all', label: 'All Customers', icon: UserGroupIcon },
  { key: 'customer_type', label: 'Customer Types', icon: ClipboardDocumentListIcon },
];

const filteredCustomers = computed(() => {
  if (selectedTab.value === 'all') return props.customers;
  return props.customers.filter(c => c.type === selectedTab.value);
});

</script>

<template>

  <AuthenticatedLayout>

      <!-- Tabs Navigation -->
      <nav class="flex space-x-4 mb-6 border-b border-green-200">
        <button
          v-for="tab in tabs"
          :key="tab.key"
          @click="selectedTab = tab.key"
          :class="[
            'flex items-center px-4 py-2 space-x-2 text-sm font-medium transition',
            selectedTab === tab.key
              ? 'border-b-2 border-green-600 text-green-700'
              : 'text-gray-600 hover:text-green-800',
          ]"
        >
          <component :is="tab.icon" class="w-5 h-5" />
          <span>{{ tab.label }}</span>
        </button>
      </nav>

      <!-- Tabbed Content Transition -->
      <transition
        mode="out-in"
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="opacity-0 scale-75"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-75"
      >
        <div :key="selectedTab">
          <template v-if="selectedTab === 'all'">
            <div class="bg-white rounded-xl shadow-lg overflow-x-auto animate-fade-in">

            <Head title="Customers" />
            
            <div class="page-inner py-6 px-4 bg-light min-vh-100">
              <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h1 class="text-3xl font-extrabold text-green-800 mb-2 md:mb-0 tracking-tight drop-shadow-sm">
                  <i class="fas fa-users mr-2 text-green-600"></i> Customers
                </h1>
                <Link :href="route('customers.create')" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-6 py-2 rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
                  <i class="fas fa-plus"></i> New Customer
                </Link>
              </div>

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
                  <tr v-if="filteredCustomers.length === 0">
                    <td colspan="5" class="text-center py-8 text-gray-400 text-lg">No customers found.</td>
                  </tr>
                  <tr v-for="customer in filteredCustomers" :key="customer.id" class="hover:bg-green-50 transition">
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
          </template>
          <template v-else-if="selectedTab === 'customer_type'">

            <Head title="Customer Types" />

            <ShowCustomerTypes :customerTypes="props.customerTypes" />
          </template>
          <!-- Add more tab content as needed for wholesale, hotel, other -->
        </div>
      </transition>
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
