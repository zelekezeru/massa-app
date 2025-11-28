<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SalesLocationForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({});
</script>

<template>
  <Head title="Create Sales Location" />
  <AppLayout>
    <SalesLocationForm />
  </AppLayout>
</template>

