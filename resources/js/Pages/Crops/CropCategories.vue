<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'; // Added useForm from '@inertiajs/vue3'
import { ref, defineProps } from 'vue';
import Modal from '@/Components/Modal.vue'; // Assuming Modal is the component that handles the overlay/backdrop
import { useI18n } from 'vue-i18n';
import { computed } from 'vue';
import { route } from 'ziggy-js';
import Swal from 'sweetalert2';

const props = defineProps({ cropCategories: Array });

const showModal = ref(false);
const isEdit = ref(false);
const editingCategory = ref(null);

const form = useForm({
    name: '',
    description: '',
});

const { t } = useI18n();

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
        form.put(safeRoute('crop-categories.update', editingCategory.value.id), {
            onSuccess: () => {
                cancelModal();
                Swal.fire({
                  title: t('Updated!'),
                  text: t('Crop category updated successfully.'),
                  icon: 'success',
                  timer: 1800,
                  showConfirmButton: false
                });
            }
        });
    } else {
        form.post(safeRoute('crop-categories.store'), {
            onSuccess: () => {
                cancelModal();
                Swal.fire({
                  title: t('Created!'),
                  text: t('Crop category created successfully.'),
                  icon: 'success',
                  timer: 1800,
                  showConfirmButton: false
                });
            }
        });
    }
}

function deleteCategory(category) {
  Swal.fire({
    title: t('Are you sure?'),
    text: t('This will permanently delete the crop category.'),
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: t('Yes, delete it!'),
    cancelButtonText: t('Cancel'),
    reverseButtons: true,
    focusCancel: true,
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return new Promise((resolve, reject) => {
        form.delete(safeRoute('crop-categories.destroy', category.id), {
          onSuccess: () => {
            Swal.fire({
              title: t('Deleted!'),
              text: t('Crop category has been deleted.'),
              icon: 'success',
              timer: 1800,
              showConfirmButton: false
            });
            resolve();
          },
          onError: () => {
            Swal.fire({
              title: t('Error'),
              text: t('Failed to delete crop category.'),
              icon: 'error',
              confirmButtonText: t('OK')
            });
            reject();
          }
        });
      });
    },
    allowOutsideClick: () => !Swal.isLoading()
  });
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

const showDetailsModal = ref(false);
const detailsCategory = ref(null);

function openDetailsModal(category) {
    detailsCategory.value = category;
    showDetailsModal.value = true;
}
function closeDetailsModal() {
    showDetailsModal.value = false;
    detailsCategory.value = null;
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
                class="relative w-full overflow-hidden
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

        <Modal :show="showDetailsModal" @close="closeDetailsModal">
          <div
            class="px-6 py-4 flex items-center justify-between
                    bg-gradient-to-r from-green-600 to-green-500
                    dark:from-green-700 dark:to-green-600
                    shadow-inner"
          >

            <!-- HEADER -->
                <h2 class="text-xl font-extrabold flex items-center justify-center w-full gap-3 text-white drop-shadow text-center">
                <i class="fas fa-leaf text-white text-xl opacity-90"></i>
                {{ detailsCategory?.name }} {{ t('Crop Category Details') }}
                </h2>

              <button
                @click="closeDetailsModal"
                class="p-2 rounded-full text-white/80 hover:text-white hover:bg-white/10 transition"
              >
                <i class="fas fa-times text-lg"></i>
              </button>
            </div>

            <!-- BODY -->
            <div class="px-6 py-6 space-y-8 dark:bg-gray-800 ">

              <!-- FIELD BLOCK -->
              <div class="flex items-start gap-4 group">

                <div>
                  <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
                    {{ t('Name') }}
                  </p>
                  <p class="text-xl font-bold text-green-800 dark:text-green-300 tracking-wide">
                    {{ detailsCategory?.name }}
                  </p>
                </div>
              </div>

              <!-- DESCRIPTION -->
              <div class="flex items-start gap-4 group">

                <div>
                  <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
                    {{ t('Description') }}
                  </p>
                  <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">
                    {{ detailsCategory?.description || t('No description provided.') }}
                  </p>
                </div>
              </div>

            </div>

            <!-- FOOTER -->
            <div
              class="px-6 py-4 border-t border-gray-200 
                      dark:bg-gray-800 backdrop-blur-md flex justify-end"
            >
              <button
                @click="closeDetailsModal"
                class="px-5 py-2.5 rounded-xl text-sm font-semibold
                      bg-gray-200 hover:bg-gray-300
                      dark:bg-gray-700 dark:hover:bg-gray-600
                      text-gray-800 dark:text-gray-200
                      shadow-sm transition"
              >
                {{ t('Close') }}
              </button>
            <!-- </div> -->

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
            <button @click="openDetailsModal(cat)" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold dark:bg-green-900/30 dark:text-green-200 dark:hover:bg-green-800/30">
                <i class="fas fa-eye mr-1 text-current"></i> {{ t('View') }}
            </button>
            <button @click="openEditModal(cat)" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs font-semibold dark:bg-yellow-900/20 dark:text-yellow-200 dark:hover:bg-yellow-800/20">
              <i class="fas fa-edit mr-1 text-current"></i> {{ t('Edit') }}
            </button>

            <button
              @click="deleteCategory(cat)"
              class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded hover:bg-red-200 transition text-xs font-semibold dark:bg-red-900/20 dark:text-red-200 dark:hover:bg-red-800/20"
            >
              <i class="fas fa-trash-alt mr-1 text-current"></i> {{ t('Delete') }}
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