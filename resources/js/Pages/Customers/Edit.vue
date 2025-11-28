<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CustomerForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ customer: Object, locations: Array, salesLocations: Array, salesAgents: Array, customerTypes: Array });
</script>

<template>
  <Head title="Edit Customer" />
  <AppLayout>
    <CustomerForm :customer="customer" :locations="locations" :salesLocations="salesLocations" :salesAgents="salesAgents" :customerTypes="customerTypes" />
  </AppLayout>
</template>
