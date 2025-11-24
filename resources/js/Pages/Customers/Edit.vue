<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CustomerForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ customer: Object, locations: Array, salesLocations: Array, salesAgents: Array });
</script>

<template>
  <Head title="Edit Customer" />
  <AuthenticatedLayout>
    <CustomerForm :customer="customer" :locations="locations" :salesLocations="salesLocations", :salesAgents="salesAgents" />
  </AuthenticatedLayout>
</template>
