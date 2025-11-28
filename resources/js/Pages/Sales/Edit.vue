<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SalesForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ sale: Object, customers: Array, products: Array, agents: Array });
</script>

<template>
  <Head title="Edit Sale" />
  <AppLayout>
    <SalesForm :sale="sale" :customers="customers" :products="products" :agents="agents" />
  </AppLayout>
</template>
