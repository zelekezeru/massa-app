<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UserForm from './form.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ user: Object, roles: Array });
</script>

<template>
  <Head title="Edit User" />
  <AuthenticatedLayout>
    <UserForm :user="user" :roles="roles" />
  </AuthenticatedLayout>
</template>
