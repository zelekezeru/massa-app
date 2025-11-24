<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SalesForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ sale: Object, customers: Array, products: Array, agents: Array });
</script>

<template>
  <Head title="Edit Sale" />
  <AuthenticatedLayout>
    <SalesForm :sale="sale" :customers="customers" :products="products" :agents="agents" />
  </AuthenticatedLayout>
</template>
