<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CustomerForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ salesLocations: Array, salesAgents: Array});
</script>

<template>
  <Head title="Create Customer" />
  <AuthenticatedLayout>
    <CustomerForm :salesLocations="salesLocations", :salesAgents="salesAgents" />
  </AuthenticatedLayout>
</template>

