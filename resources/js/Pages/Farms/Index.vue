<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import { Squares2X2Icon } from '@heroicons/vue/24/outline';
import Farms from './Farms.vue';

const props = defineProps({ farms: Object });

const selectedTab = ref('farms');
const tabs = [
  { key: 'farms', label: 'Farms', icon: Squares2X2Icon },
];
</script>

<template>
  <AppLayout>
    <Head title="Farms" />
    <!-- Tabs Navigation -->
    <nav class="flex space-x-4 mb-6 border-b">
      <button
        v-for="tab in tabs"
        :key="tab.key"
        @click="selectedTab = tab.key"
        :class="['flex items-center px-4 py-2 space-x-2 text-sm font-medium transition', selectedTab === tab.key ? 'border-b-2 border-green-600 text-green-700 dark:text-green-300' : 'text-gray-600 dark:text-gray-300 hover:text-green-800 dark:hover:text-green-300']"
      >
        <component :is="tab.icon" class="w-5 h-5 text-gray-600 dark:text-gray-300" />
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
        <template v-if="selectedTab === 'farms'">
          <Farms :farms="farms" />
        </template>
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
