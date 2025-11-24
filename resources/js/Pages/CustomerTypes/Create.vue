<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CustomerTypeForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({});
</script>

<template>
  <Head title="Create Customer Type" />
  <AuthenticatedLayout>
    <CustomerTypeForm />
  </AuthenticatedLayout>
</template>

