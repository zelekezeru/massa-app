<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CropForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ crop: Object, cropCategories: Array });
</script>

<template>
  <Head title="Edit Crop" />
  <AppLayout>
    <CropForm :crop="crop" :crop-categories="cropCategories" />
  </AppLayout>
</template>
