<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, defineProps } from 'vue';
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ customerTypes: Array });

const showModal = ref(false);
const isEdit = ref(false);
const editingType = ref(null);

const form = useForm({
  name: '',
  description: '',
});

function openCreateModal() {
  isEdit.value = false;
  form.reset();
  showModal.value = true;
}
function openEditModal(type) {
  isEdit.value = true;
  editingType.value = type;   
  form.name = type.name;
  form.description = type.description;
  showModal.value = true;
}
function submitType() {
  if (isEdit.value && editingType.value) {
    form.put(route('customer-types.update', editingType.value.id), {
      onSuccess: () => showModal.value = false
    });
  } else {
    form.post(route('customer-types.store'), {
      onSuccess: () => showModal.value = false
    });
  }
}

</script>

<template>
  <Head title="Customer Types" />

    <div class="page-inner py-6 px-4 bg-light min-vh-100">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-green-800 mb-2 md:mb-0 tracking-tight drop-shadow-sm">
          <i class="fas fa-tags mr-2 text-green-600"></i> Customer Types
        </h1>
        <button @click="openCreateModal" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-6 py-2 rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
          <i class="fas fa-plus"></i> New Customer Type
        </button>
      </div>
      <Modal :show="showModal" @close="showModal.value = false">
        <div class="p-6">
          <h2 class="text-xl font-bold mb-4">{{ isEdit ? 'Edit' : 'Create' }} Customer Type</h2>
          <form @submit.prevent="submitType" class="space-y-4">
            <div>
              <label class="block text-sm font-semibold mb-1">Name</label>
              <input v-model="form.name" required type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Type Name" />
            </div>
            <div>
              <label class="block text-sm font-semibold mb-1">Description</label>
              <textarea v-model="form.description" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Description"></textarea>
            </div>
            <div class="flex justify-end gap-2 mt-4">
              <button type="button" @click="showModal.value = false" class="px-4 py-2 rounded bg-gray-200 text-gray-700 font-semibold">Cancel</button>
              <button type="submit" class="px-6 py-2 rounded bg-gradient-to-r from-green-500 to-green-700 text-white font-bold shadow">{{ isEdit ? 'Update' : 'Create' }}</button>
            </div>
          </form>
        </div>
      </Modal>
      <div class="bg-white rounded-xl shadow-lg overflow-x-auto animate-fade-in">
        <table class="min-w-full divide-y divide-green-100">
          <thead class="bg-green-50">
            <tr>
              <th class="px-4 py-3 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Name</th>
              <th class="px-4 py-3 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Description</th>
              <th class="px-4 py-3 text-center text-xs font-bold text-green-700 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-green-50">
            <tr v-if="customerTypes.length === 0">
              <td colspan="3" class="text-center py-8 text-gray-400 text-lg">No customer types found.</td>
            </tr>
            <tr v-for="type in customerTypes" :key="type.id" class="hover:bg-green-50 transition">
              <td class="px-4 py-3 font-semibold text-green-900">{{ type.name }}</td>
              <td class="px-4 py-3">{{ type.description }}</td>
              <td class="px-4 py-3 text-center flex gap-2 justify-center">
                <button @click="openEditModal(type)" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs font-semibold">
                  <i class="fas fa-edit mr-1"></i> Edit
                </button>
                <Link :href="route('customer-types.show', type.id)" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold">
                  <i class="fas fa-eye mr-1"></i> View
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
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
