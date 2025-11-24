<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ customerType: Object });
</script>

<template>
  <Head :title="props.customerType ? props.customerType.name : 'Customer Type Details'" />
  <AuthenticatedLayout>
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
      <div v-if="!props.customerType" class="text-center text-gray-400 text-lg py-12">
        Customer Type not found.
      </div>
      <div v-else>
        <div class="flex items-center justify-between mb-6">
          <h1 class="text-2xl font-bold text-green-800 flex items-center gap-2">
            <i class="fas fa-tags text-green-600"></i> {{ props.customerType.name }}
          </h1>
          <div class="flex gap-2">
            <Link :href="route('customer-types.edit', props.customerType.id)" class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-sm font-semibold">
              <i class="fas fa-edit mr-1"></i> Edit
            </Link>
            <Link :href="route('customer-types.index')" class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-sm font-semibold">
              <i class="fas fa-list mr-1"></i> Back to List
            </Link>
          </div>
        </div>
        <div class="mb-8">
          <p class="mb-2"><span class="font-semibold text-green-700">Description:</span> {{ props.customerType.description }}</p>
        </div>
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
