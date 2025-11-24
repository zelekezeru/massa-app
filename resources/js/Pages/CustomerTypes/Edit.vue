<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CustomerTypeForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ customerType: Object });
</script>

<template>
  <Head title="Edit Customer Type" />
  <AuthenticatedLayout>
    <CustomerTypeForm :customerType="customerType" />
  </AuthenticatedLayout>
</template>
