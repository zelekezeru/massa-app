<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'; // Added useForm from '@inertiajs/vue3'
import { ref, defineProps } from 'vue';
import Modal from '@/Components/Modal.vue'; // Assuming Modal is the component that handles the overlay/backdrop
import { useI18n } from 'vue-i18n';
import { computed } from 'vue';
import { route } from 'ziggy-js';


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
function cancelModal() {
    showModal.value = false;
    isEdit.value = false;
    editingCategory.value = null;
    form.reset();
}

function submitCategory() {
    if (isEdit.value && editingCategory.value) {
        // Use 'put' for updating an existing resource
        form.put(safeRoute('crop-categories.update', editingCategory.value.id), {
            onSuccess: () => cancelModal() // Use cancelModal to also reset state
        });
    } else {
        // Use 'post' for creating a new resource
        form.post(safeRoute('crop-categories.store'), {
            onSuccess: () => cancelModal() // Use cancelModal to also reset state
        });
    }
}

// Helper to call Ziggy's route() safely and fall back to a reasonable URL
function safeRoute(name, params = {}) {
    try {
        // If Ziggy has the route, this will return a URL string
        return typeof params === 'object' ? route(name, params) : route(name, params);
    } catch (e) {
        // Fallbacks for common resource routes
        // name examples: 'crop-categories.store', 'crop-categories.update', 'crop-categories.show'
        if (name.endsWith('.store')) {
            return '/crop-categories';
        }
        if (name.endsWith('.update')) {
            // params may be id or object with id
            const id = typeof params === 'object' ? params.id || params : params;
            return `/crop-categories/${id}`;
        }
        if (name.endsWith('.show')) {
            const id = typeof params === 'object' ? params.id || params : params;
            return `/crop-categories/${id}`;
        }
        // Generic fallback: return root
        return '/';
    }
}
</script>

<template>
    <Head title="Crop Categories" />
    <div class="page-inner py-6 px-4 min-vh-100 text-gray-900 dark:text-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-green-800 mb-2 md:mb-0 tracking-tight drop-shadow-sm dark:text-green-300">
                <i class="fas fa-leaf mr-2 text-green-600 dark:text-green-400"></i> Crop Categories
            </h1>
            <button type="button" @click="openCreateModal" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-6 py-2 rounded-lg shadow-lg hover:from-green-600 hover:to-green-800 transition-all duration-200 transform hover:scale-[1.01] dark:from-green-600 dark:to-green-800">
                <i class="fas fa-plus text-current"></i> New Crop Category
            </button>
        </div>

        <Modal :show="showModal" @close="cancelModal">
    <div
        class="relative w-full overflow-hidden rounded-3xl 
               dark:bg-gray-800 
               shadow-2xl ring-1 ring-black/5 dark:ring-white/5 
               animate-modalIn"
    >
        <form @submit.prevent="submitCategory">
            <div class="px-6 py-5 flex items-center justify-between border-b border-gray-200 dark:border-gray-700/50">
                <h2 class="text-2xl font-extrabold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                    <i 
                        :class="isEdit 
                            ? 'fas fa-edit text-yellow-600 dark:text-yellow-400 text-xl' 
                            : 'fas fa-plus-circle text-green-600 dark:text-green-400 text-xl'"
                    ></i>
                    <span class="text-gray-800 dark:text-gray-100">
                        {{ isEdit ? 'Edit Crop Category' : 'Create New Category' }}
                    </span>
                </h2>

                <button type="button" @click="cancelModal"
                    class="p-2 -m-2 rounded-full text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-200 transition-colors hover:bg-gray-100 dark:hover:bg-gray-700/50">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="px-6 py-6 space-y-6">

                <div class="space-y-2">
                    <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-200">
                        Category Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        required
                        :placeholder="isEdit ? editingCategory.name : 'e.g., Grains, Vegetables, Fruits'"
                        class="w-full px-4 py-2.5 rounded-xl
                               bg-gray-50 dark:bg-gray-700/70
                               border-2 border-gray-200 dark:border-gray-700
                               text-gray-900 dark:text-gray-100
                               placeholder-gray-500 dark:placeholder-gray-400
                               focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400
                               focus:border-green-500 dark:focus:border-green-400 transition duration-150"
                    />
                    <div v-if="form.errors.name" class="text-sm text-red-500 mt-1">{{ form.errors.name }}</div>
                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-bold text-gray-700 dark:text-gray-200">
                        Description (Optional)
                    </label>
                    <textarea
                        id="description"
                        v-model="form.description"
                        rows="4"
                        placeholder="Provide a brief description of this crop category..."
                        class="w-full px-4 py-2.5 rounded-xl
                               bg-gray-50 dark:bg-gray-700/70
                               border-2 border-gray-200 dark:border-gray-700
                               text-gray-900 dark:text-gray-100
                               placeholder-gray-500 dark:placeholder-gray-400
                               focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400
                               focus:border-green-500 dark:focus:border-green-400 transition duration-150 resize-none"
                    ></textarea>
                    <div v-if="form.errors.description" class="text-sm text-red-500 mt-1">{{ form.errors.description }}</div>
                </div>

            </div>

            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700/50 flex justify-end gap-3">

                <button
                    @click="cancelModal"
                    type="button"
                    class="px-5 py-2.5 rounded-xl font-semibold text-sm
                           bg-gray-200 hover:bg-gray-300
                           text-gray-700
                           dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200
                           transition duration-150"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    :disabled="form.processing"
                    :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                    class="px-6 py-2.5 rounded-xl font-extrabold text-sm text-white shadow-lg shadow-green-500/30
                           bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800
                           dark:from-green-700 dark:to-green-800 dark:hover:from-green-800 dark:hover:to-green-900
                           transition duration-200 transform hover:scale-[1.02]"
                >
                    <i v-if="form.processing" class="fas fa-spinner fa-spin mr-2"></i>
                    {{ isEdit ? 'Update Category' : 'Create Category' }}
                </button>

            </div>
        </form>

    </div>
</Modal>

        <div class="rounded-xl shadow-lg overflow-x-auto animate-fade-in dark:bg-gray-800 text-gray-900 dark:text-gray-100 mt-8">
          <table class="min-w-full divide-y divide-green-100 dark:divide-green-900/30">
            <thead class="bg-green-50 dark:bg-green-900/20">
              <tr>
          <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">Name</th>
          <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">Description</th>
          <th class="px-4 py-3 text-center text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-green-50 dark:divide-green-900/20">
              <tr v-if="!cropCategories || cropCategories.length === 0">
          <td colspan="3" class="text-center py-8 text-gray-400 dark:text-gray-300 text-lg">No crop categories found.</td>
              </tr>

              <tr v-for="cat in cropCategories" :key="cat.id" class="dark:bg-transparent hover:bg-green-50 dark:hover:bg-green-900/30 transition">
          <td class="px-4 py-3 font-semibold text-green-900 dark:text-green-300">{{ cat.name }}</td>
          <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ cat.description }}</td>
          <td class="px-4 py-3 text-center flex gap-2 justify-center">
            <Link :href="safeRoute('crop-categories.show', cat.id)" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold dark:bg-green-900/30 dark:text-green-200 dark:hover:bg-green-800/30">
              <i class="fas fa-eye mr-1 text-current"></i> View
            </Link>

            <button @click="openEditModal(cat)" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs font-semibold dark:bg-yellow-900/20 dark:text-yellow-200 dark:hover:bg-yellow-800/20">
              <i class="fas fa-edit mr-1 text-current"></i> Edit
            </button>
          </td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</template>

<style scoped>
.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes modalIn {
    from {
        opacity: 0;
        transform: scale(0.95) translateY(20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}
.animate-modalIn {
    animation: modalIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>