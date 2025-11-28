<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SalesLocationForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ salesLocation: Object });
</script>

<template>
  <Head title="Edit Sales Location" />
  <AppLayout>
    <SalesLocationForm :salesLocation="salesLocation" />
  </AppLayout>
</template>
