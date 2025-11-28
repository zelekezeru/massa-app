<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SalesAgentForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ salesLocations: Array, users: Array });
</script>

<template>
  <Head title="Create Sales Agent" />
  <AppLayout>
    <SalesAgentForm :salesLocations="salesLocations" />
  </AppLayout>
</template>

