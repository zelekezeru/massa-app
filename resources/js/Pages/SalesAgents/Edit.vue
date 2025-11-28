<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SalesAgentForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ salesAgent: Object, salesLocations: Array, users: Array });
</script>

<template>
  <Head title="Edit Sales Agent" />
  <AppLayout>
    <SalesAgentForm :salesAgent="salesAgent" :salesLocations="salesLocations" :users="users" />
  </AppLayout>
</template>
