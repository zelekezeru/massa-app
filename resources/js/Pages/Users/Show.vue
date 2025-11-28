<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ user: Object, roles: Object });

function deleteUser() {
  if (confirm('Are you sure you want to delete this user?')) {
    router.delete(route('users.destroy', props.user.id));
  }
}
</script>

<template>
  <Head :title="props.user ? props.user.name : 'User Details'" />
  <AppLayout>
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
      <div v-if="!props.user" class="text-center text-gray-400 text-lg py-12">
        User not found.
      </div>
      <div v-else>
        <div class="flex items-center justify-between mb-6">
          <h1 class="text-2xl font-bold text-green-800 flex items-center gap-2">
            <i class="fas fa-user text-green-600"></i> {{ props.user.name }}
          </h1>
          <div class="flex gap-2">
            <Link :href="route('users.edit', props.user.id)" class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-sm font-semibold">
              <i class="fas fa-edit mr-1"></i> Edit
            </Link>
            <!-- Delete -->
            <form @submit.prevent="deleteUser" class="inline">
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded hover:bg-red-200 transition text-sm font-semibold">
              <i class="fas fa-trash mr-1"></i> Delete
              </button>
            </form>

            <Link :href="route('users.index')" class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-sm font-semibold">
              <i class="fas fa-list mr-1"></i> Back to List
            </Link>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div>
            <p class="mb-2"><span class="font-semibold text-green-700">Username:</span> {{ props.user.username }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Email:</span> {{ props.user.email }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Phone:</span> {{ props.user.phone }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Address:</span> {{ props.user.address }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Role:</span> <template v-for="role in props.roles" :key="role.id">{{ role.name }}<span v-if="!$last">, </span></template></p>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.3s;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(16px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
