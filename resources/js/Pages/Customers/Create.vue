<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CustomerForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ salesLocations: Array, salesAgents: Array, customerTypes: Array });
</script>

<template>
  <Head title="Create Customer" />
  <AppLayout>
    <CustomerForm :salesLocations="salesLocations" :salesAgents="salesAgents" :customerTypes="customerTypes" />
  </AppLayout>
</template>

