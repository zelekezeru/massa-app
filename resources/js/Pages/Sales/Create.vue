<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SalesForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ customers: Array, products: Array, agents: Array });
</script>

<template>
  <Head title="Create Sales" />
  <AuthenticatedLayout>

    <!-- Sales Form -->
    <SalesForm :customers="customers" :products="products" :agents="agents" />
    
  </AuthenticatedLayout>
</template>

