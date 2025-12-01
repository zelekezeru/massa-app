<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, defineProps } from 'vue';
import { UserGroupIcon, ClipboardDocumentListIcon } from '@heroicons/vue/24/outline';
import ShowCustomerTypes from "./CustomerTypes.vue";
import ShowCustomers from "./Customers.vue";

const props = defineProps({ customers: Array, customerTypes: Array, salesLocations: Array });

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

  <AppLayout>

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

            <ShowCustomers :customers="filteredCustomers" :customerTypes="props.customerTypes" :salesLocations="props.salesLocations" />
          </template>
          <template v-else-if="selectedTab === 'customer_type'">

            <ShowCustomerTypes :customerTypes="props.customerTypes" />
          </template>
          <!-- Add more tab content as needed for wholesale, hotel, other -->
        </div>
      </transition>
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
