<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CropForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ cropCategories: Array });
</script>

<template>
  <Head title="Create Crop" />
  <AppLayout>

    <!-- Crop Form -->
    <CropForm :crop-categories="cropCategories" />
    
  </AppLayout>
</template>

