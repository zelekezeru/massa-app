<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ cropCategories: Array });

const showModal = ref(false);
const isEdit = ref(false);
const editingCategory = ref(null);

const form = useForm({
  name: '',
  description: '',
});

function openCreateModal() {
  isEdit.value = false;
  form.reset();
  showModal.value = true;
}
function openEditModal(category) {
  isEdit.value = true;
  editingCategory.value = category;
  form.name = category.name;
  form.description = category.description;
  showModal.value = true;
}
function submitCategory() {
  if (isEdit.value && editingCategory.value) {
    form.put(route('crop-categories.update', editingCategory.value.id), {
      onSuccess: () => showModal.value = false
    });
  } else {
    form.post(route('crop-categories.store'), {
      onSuccess: () => showModal.value = false
    });
  }
}
</script>

<template>
  <Head title="Crop Categories" />
  <div class="page-inner py-6 px-4 bg-light min-vh-100">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
      <h1 class="text-3xl font-extrabold text-green-800 mb-2 md:mb-0 tracking-tight drop-shadow-sm">
        <i class="fas fa-leaf mr-2 text-green-600"></i> Crop Categories
      </h1>
      <button @click="openCreateModal" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-6 py-2 rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
        <i class="fas fa-plus"></i> New Crop Category
      </button>
    </div>
    <Modal :show="showModal" @close="showModal.value = false">
      <div class="p-6">
        <h2 class="text-xl font-bold mb-4">{{ isEdit ? 'Edit' : 'Create' }} Crop Category</h2>
        <form @submit.prevent="submitCategory" class="space-y-4">
          <div>
            <label class="block text-sm font-semibold mb-1">Name</label>
            <input v-model="form.name" required type="text" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Category Name" />
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
          <tr v-if="!cropCategories || cropCategories.length === 0">
            <td colspan="3" class="text-center py-8 text-gray-400 text-lg">No crop categories found.</td>
          </tr>
          <tr v-for="cat in cropCategories" :key="cat.id" class="hover:bg-green-50 transition">
            <td class="px-4 py-3 font-semibold text-green-900">{{ cat.name }}</td>
            <td class="px-4 py-3">{{ cat.description }}</td>
            <td class="px-4 py-3 text-center flex gap-2 justify-center">
              <button @click="openEditModal(cat)" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs font-semibold">
                <i class="fas fa-edit mr-1"></i> Edit
              </button>
              <Link :href="route('crop-categories.show', cat.id)" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold">
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
