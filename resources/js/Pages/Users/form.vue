<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ user: Object, roles: Array });

const form = useForm({
  name: props.user?.name || '',
  username: props.user?.username || '',
  email: props.user?.email || '',
  phone: props.user?.phone || '',
  address: props.user?.address || '',
  roles: props.user?.roles || [],
});

function submit() {
  if (props.user) {
    form.put(route('users.update', props.user.id));
  } else {
    form.post(route('users.store'));
  }
}

</script>

<template>
  <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
    <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
      <i class="fas fa-user text-green-600"></i>
      {{ props.user ? 'Edit User' : 'New User' }}
    </h1>
    <form @submit.prevent="submit" class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold mb-1">Name</label>
          <input v-model="form.name" required type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Full Name" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Email</label>
          <input v-model="form.email" required type="email" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Email Address" />
        </div>
        <div>
          <label class="block text-sm font-semibold mb-1">Phone</label>
          <input v-model="form.phone" type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Phone Number" />
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold mb-1">Address</label>
          <textarea v-model="form.address" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Address"></textarea>
        </div>
        <!-- Roles -->
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold mb-1">Roles</label>
          <select v-model="form.roles" multiple class="form-select w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500">
            <option v-for="role in props.roles" :key="role.id" :value="role.id">{{ role.name }}</option>
          </select>
        </div>
      </div>
      <div class="flex justify-end gap-2 mt-8">
        <button type="submit" class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
          <i class="fas fa-save mr-2"></i> {{ props.user ? 'Update' : 'Create' }} User
        </button>
      </div>
    </form>
  </div>
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
