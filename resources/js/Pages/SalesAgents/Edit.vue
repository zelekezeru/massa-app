<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SalesAgentForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ salesAgent: Object, salesLocations: Array, users: Array });
</script>

<template>
  <Head title="Edit Sales Agent" />
  <AuthenticatedLayout>
    <SalesAgentForm :salesAgent="salesAgent" :salesLocations="salesLocations" :users="users" />
  </AuthenticatedLayout>
</template>
