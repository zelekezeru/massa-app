<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import { Squares2X2Icon, ClipboardDocumentListIcon } from '@heroicons/vue/24/outline';
import ShowCropCategories from './Tabs/ShowCropCategories.vue';
import ShowCrops from './Tabs/ShowCrops.vue';

const props = defineProps({ crops: Array, cropCategories: Array });

const selectedTab = ref('crops');
const tabs = [
  { key: 'crops', label: 'Crops', icon: Squares2X2Icon },
  { key: 'categories', label: 'Crop Categories', icon: ClipboardDocumentListIcon },
];

</script>

<template>
  <AppLayout>
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
        <template v-if="selectedTab === 'crops'">
          <ShowCrops :crops="crops" :cropCategories="cropCategories" />
        </template>
          
        <template v-else-if="selectedTab === 'categories'">
          <ShowCropCategories :cropCategories="cropCategories" />
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
