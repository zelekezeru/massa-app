<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SalesAgentForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ salesLocations: Array, users: Array });
</script>

<template>
  <Head title="Create Sales Agent" />
  <AuthenticatedLayout>
    <SalesAgentForm :salesLocations="salesLocations" />
  </AuthenticatedLayout>
</template>

