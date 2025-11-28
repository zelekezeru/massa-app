<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UserForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ user: Object, roles: Array });
</script>

<template>
  <Head title="Create User" />
  <AppLayout>
    <UserForm :user="props.user" :roles="props.roles" />
  </AppLayout>
</template>

