<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import { Squares2X2Icon, ClipboardDocumentListIcon } from '@heroicons/vue/24/outline';
import ShowCropCategories from './Tabs/ShowCropCategories.vue';

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
          <!-- Crops Table -->
          <Head title="Crops" />
          <div class="page-inner py-6 px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
              <h1 class="text-3xl font-extrabold text-green-800 mb-2 md:mb-0 tracking-tight drop-shadow-sm dark:text-green-300">
                <i class="fas fa-seedling mr-2 text-green-600 dark:text-green-400"></i> Crops
              </h1>
              <Link :href="route('crops.create')" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-6 py-2 rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200 dark:from-green-600 dark:to-green-800">
                <i class="fas fa-plus"></i> New Crop
              </Link>
            </div>
              <div class=" rounded-xl shadow-lg overflow-x-auto animate-fade-in dark:bg-gray-800 text-gray-900 dark:text-gray-100">
              <table class="min-w-full divide-y divide-green-100 dark:divide-green-900/30">
                <thead class="bg-green-50 dark:bg-green-900/20">
                  <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">Description</th>
                    <th class="px-4 py-3 text-center text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-green-50 dark:divide-green-900/20">
                  <tr v-if="crops.length === 0">
                    <td colspan="4" class="text-center py-8 text-gray-400 dark:text-gray-300 text-lg">No crops found.</td>
                  </tr>
                  <tr v-for="crop in crops" :key="crop.id" class=" dark:bg-transparent hover:bg-green-50 dark:hover:bg-green-900/30 transition">
                    <td class="px-4 py-3 font-semibold text-green-900 dark:text-green-300">{{ crop.name }}</td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ crop.category?.name }}</td>
                    <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ crop.description }}</td>
                    <td class="px-4 py-3 text-center flex gap-2 justify-center">
                      <Link :href="route('crops.show', crop.id)" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold dark:bg-green-900/30 dark:text-green-200 dark:hover:bg-green-800/30">
                        <i class="fas fa-eye mr-1 text-current"></i> View
                      </Link>
                      <Link :href="route('crops.edit', crop.id)" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs font-semibold dark:bg-yellow-900/20 dark:text-yellow-200 dark:hover:bg-yellow-800/20">
                        <i class="fas fa-edit mr-1 text-current"></i> Edit
                      </Link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
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
