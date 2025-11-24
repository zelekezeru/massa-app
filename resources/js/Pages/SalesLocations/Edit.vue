<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SalesLocationForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ salesLocation: Object });
</script>

<template>
  <Head title="Edit Sales Location" />
  <AuthenticatedLayout>
    <SalesLocationForm :salesLocation="salesLocation" />
  </AuthenticatedLayout>
</template>
