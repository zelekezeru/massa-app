<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SalesForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ customers: Array, products: Array, agents: Array });
</script>

<template>
  <Head title="Create Sales" />
  <AppLayout>

    <!-- Sales Form -->
    <SalesForm :customers="customers" :products="products" :agents="agents" />
    
  </AppLayout>
</template>

