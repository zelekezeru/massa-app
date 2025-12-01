<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import Modal from '@/Components/Modal.vue';
import { useI18n } from 'vue-i18n';
import { computed } from 'vue';
import { route } from 'ziggy-js';
import Swal from 'sweetalert2';

const props = defineProps({ crops: Array, cropCategories: Array, farms: Array });
const { t } = useI18n();

const showModal = ref(false);
const isEdit = ref(false);
const editingCrop = ref(null);

const form = useForm({
    name: '',
    variety: '',
    description: '',
    crop_categories_id: '',
    farm_id: '',
});

function openCreateModal() {
    isEdit.value = false;
    form.reset();
    showModal.value = true;
}
function openEditModal(crop) {
    isEdit.value = true;
    editingCrop.value = crop;
    form.name = crop.name;
    form.variety = crop.variety;
    form.description = crop.description;
    form.crop_categories_id = crop.crop_categories_id;
    form.farm_id = crop.farm_id;
    showModal.value = true;
}
function cancelModal() {
    showModal.value = false;
    isEdit.value = false;
    editingCrop.value = null;
    form.reset();
}

function submitCrop() {
    if (isEdit.value && editingCrop.value) {
        form.put(safeRoute('crops.update', editingCrop.value.id), {
            onSuccess: () => {
                cancelModal();
                Swal.fire({
                  title: t('updated'),
                  text: t('crop_updated'),
                  icon: 'success',
                  timer: 1800,
                  showConfirmButton: false
                });
            }
        });
    } else {
        form.post(safeRoute('crops.store'), {
            onSuccess: () => {
                cancelModal();
                Swal.fire({
                  title: t('created'),
                  text: t('crop_created'),
                  icon: 'success',
                  timer: 1800,
                  showConfirmButton: false
                });
            }
        });
    }
}

function deleteCrop(crop) {
  Swal.fire({
    title: t('are_you_sure'),
    text: t('delete_crop_confirm'),
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: t('yes_delete_it'),
    cancelButtonText: t('cancel'),
    reverseButtons: true,
    focusCancel: true,
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return new Promise((resolve, reject) => {
        form.delete(safeRoute('crops.destroy', crop.id), {
          onSuccess: () => {
            Swal.fire({
              title: t('deleted'),
              text: t('crop_deleted'),
              icon: 'success',
              timer: 1800,
              showConfirmButton: false
            });
            resolve();
          },
          onError: () => {
            Swal.fire({
              title: t('error'),
              text: t('failed_to_delete_crop'),
              icon: 'error',
              confirmButtonText: t('ok')
            });
            reject();
          }
        });
      });
    },
    allowOutsideClick: () => !Swal.isLoading()
  });
}

function safeRoute(name, params = {}) {
    try {
        return typeof params === 'object' ? route(name, params) : route(name, params);
    } catch (e) {
        if (name.endsWith('.store')) {
            return '/crops';
        }
        if (name.endsWith('.update')) {
            const id = typeof params === 'object' ? params.id || params : params;
            return `/crops/${id}`;
        }
        if (name.endsWith('.show')) {
            const id = typeof params === 'object' ? params.id || params : params;
            return `/crops/${id}`;
        }
        return '/';
    }
}

const showDetailsModal = ref(false);
const detailsCrop = ref(null);

function openDetailsModal(crop) {
    detailsCrop.value = crop;
    showDetailsModal.value = true;
}
function closeDetailsModal() {
    showDetailsModal.value = false;
    detailsCrop.value = null;
}

const yourRef = ref(null);

if (yourRef.value) {
  const locale = yourRef.value.getAttribute('data-locale');
}
</script>

<template>
    <Head :title="t('crops')" />
    <div class="page-inner py-6 px-4 min-vh-100 text-white-900 dark:text-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-green-800 mb-2 md:mb-0 tracking-tight drop-shadow-sm dark:text-green-300">
                <i class="fas fa-seedling mr-2 text-green-600 dark:text-green-400"></i> {{ t('crops') }}
            </h1>
            <button type="button" @click="openCreateModal" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-6 py-2 rounded-lg shadow-lg hover:from-green-600 hover:to-green-800 transition-all duration-200 transform hover:scale-[1.01] dark:from-green-600 dark:to-green-800">
                <i class="fas fa-plus text-current"></i> {{ t('new_crop') }}
            </button>
        </div>

        <div class="rounded-xl shadow-lg overflow-x-auto animate-fade-in dark:bg-gray-800 text-white-900 dark:text-gray-100 mt-8">
          <table class="min-w-full divide-y divide-green-100 dark:divide-green-900/30">
            <thead class="bg-green-50 dark:bg-green-900/20">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('name') }}</th>
                <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('variety') }}</th>
                <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('category') }}</th>
                <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('description') }}</th>
                <th class="px-4 py-3 text-center text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('actions') }}</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-green-50 dark:divide-green-900/20">
              <tr v-if="!crops || crops.length === 0">
                <td colspan="4" class="text-center py-8 text-gray-400 dark:text-gray-300 text-lg">{{ t('no_crops_found') }}</td>
              </tr>
              <tr v-for="crop in crops" :key="crop.id" class="dark:bg-transparent hover:bg-green-50 dark:hover:bg-green-900/30 transition">
                <td class="px-4 py-3 font-semibold text-green-900 dark:text-green-300">{{ crop.name }}</td> 
                <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ crop.variety }}</td>
                <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ crop.crop_category?.name }}</td>
                <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ crop.description }}</td>
                <td class="px-4 py-3 text-center flex gap-2 justify-center">
                  <button @click="openDetailsModal(crop)" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold dark:bg-green-900/30 dark:text-green-200 dark:hover:bg-green-800/30">
                    <i class="fas fa-eye mr-1 text-current"></i> {{ t('view') }}
                  </button>
                  <button @click="openEditModal(crop)" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs font-semibold dark:bg-yellow-900/20 dark:text-yellow-200 dark:hover:bg-yellow-800/20">
                    <i class="fas fa-edit mr-1 text-current"></i> {{ t('edit') }}
                  </button>
                  <button @click="deleteCrop(crop)" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded hover:bg-red-200 transition text-xs font-semibold dark:bg-red-900/20 dark:text-red-200 dark:hover:bg-red-800/20">
                    <i class="fas fa-trash-alt mr-1 text-current"></i> {{ t('delete') }}
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>

        <!-- Crop Details Modal -->
    <Modal :show="showDetailsModal" @close="closeDetailsModal">
      <div class="px-6 py-4 flex items-center justify-between bg-gradient-to-r from-green-600 to-green-500 dark:from-green-700 dark:to-green-600 shadow-inner">
        <h2 class="text-xl font-extrabold flex items-center justify-center w-full gap-3 text-white drop-shadow text-center">
          <i class="fas fa-seedling text-white text-xl opacity-90"></i>
          {{ detailsCrop?.name }} {{ t('crop_details') }}
        </h2>
        <button @click="closeDetailsModal" class="p-2 rounded-full text-white/80 hover:text-white hover:bg-white/10 transition">
          <i class="fas fa-times text-lg"></i>
        </button>
      </div>
      <div class="px-6 py-6 space-y-8 dark:bg-gray-800 ">
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('name') }}
            </p>
            <p class="text-xl font-bold text-green-800 dark:text-green-300 tracking-wide">
              {{ detailsCrop?.name }}
            </p>
          </div>
        </div>
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('variety') }}
            </p>
            <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">
              {{ detailsCrop?.variety || t('no_variety_provided') }}
            </p>
          </div>
        </div>
        
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('category') }}
            </p>
            <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">
              {{ detailsCrop?.crop_category?.name || t('no_category') }}
            </p>
          </div>
        </div>
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('description') }}
            </p>
            <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">
              {{ detailsCrop?.description || t('no_description_provided') }}
            </p>
          </div>
        </div>
      </div>
      <div class="px-6 py-4 border-t border-gray-200 dark:bg-gray-800 backdrop-blur-md flex justify-end">
        <button @click="closeDetailsModal" class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 shadow-sm transition">
          {{ t('close') }}
        </button>
      </div>
    </Modal>

    <!-- Crop Create & Edit Modal -->
    <Modal :show="showModal" @close="cancelModal">
        <div class="relative w-full overflow-hidden dark:bg-gray-800 shadow-2xl ring-1 ring-black/5 dark:ring-white/5 animate-modalIn">
            <form @submit.prevent="submitCrop">
                <div class="px-6 py-5 flex items-center justify-between border-b border-gray-200 dark:border-gray-700/50">
                    <h2 class="text-2xl font-extrabold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                        <i :class="isEdit 
                                ? 'fas fa-edit text-yellow-600 dark:text-yellow-400 text-xl' 
                                : 'fas fa-plus-circle text-green-600 dark:text-green-400 text-xl'"
                        ></i>
                        <span class="text-gray-800 dark:text-gray-100">
                            {{ isEdit ? t('edit_crop') : t('create_new_crop') }}
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
                            {{ t('crop_name') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                            :placeholder="isEdit ? editingCrop.name : t('name')"
                            class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-green-500 dark:focus:border-green-400 transition duration-150"
                        />
                        <div v-if="form.errors.name" class="text-sm text-red-500 mt-1">{{ form.errors.name }}</div>
                    </div>
                    <div class="space-y-2">
                        <label for="variety" class="block text-sm font-bold text-gray-700 dark:text-gray-200">
                            {{ t('variety') }}
                        </label>
                        <input
                            id="variety"
                            v-model="form.variety"
                            type="text"
                            :placeholder="isEdit ? editingCrop.variety : t('variety')"
                            class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-green-500 dark:focus:border-green-400 transition duration-150"
                        />
                        <div v-if="form.errors.variety" class="text-sm text-red-500 mt-1">{{ form.errors.variety }}</div>
                    </div>
                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-bold text-gray-700 dark:text-gray-200">
                            {{ t('description') }}
                        </label>
                        <textarea
                            id="description"
                            v-model="form.description"
                            rows="4"
                            :placeholder="isEdit ? editingCrop.description : t('description')"
                            class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-green-500 dark:focus:border-green-400 transition duration-150 resize-none"
                        ></textarea>
                        <div v-if="form.errors.description" class="text-sm text-red-500 mt-1">{{ form.errors.description }}</div>
                    </div>
                    <div class="space-y-2">
                        <label for="crop_categories_id" class="block text-sm font-bold text-gray-700 dark:text-gray-200">
                            {{ t('crop_category') }} <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="crop_categories_id"
                            v-model="form.crop_categories_id"
                            required
                            class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-green-500 dark:focus:border-green-400 transition duration-150"
                        >
                            <option value="" disabled>{{ t('select_crop_category') }}</option>
                            <option v-for="cat in cropCategories" :key="cat.id" :value="cat.id">
                                {{ cat.name }}
                            </option>
                        </select>
                        <div v-if="form.errors.crop_categories_id" class="text-sm text-red-500 mt-1">{{ form.errors.crop_categories_id }}</div>
                    </div>
                    <div class="space-y-2">
                      <label for="farm_id" class="block text-sm font-bold text-gray-700 dark:text-gray-200">
                        {{ t('farm') }} <span class="text-red-500">*</span>
                      </label>
                      <select
                        id="farm_id"
                        v-model="form.farm_id"
                        required
                        class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900 dark:text-gray-100 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-green-500 dark:focus:border-green-400 transition duration-150"
                      >
                        <option value="" disabled>{{ t('select_farm') }}</option>
                        <option v-for="farm in farms" :key="farm.id" :value="farm.id">
                          {{ farm.name }}
                        </option>
                      </select>
                      <div v-if="form.errors.farm_id" class="text-sm text-red-500 mt-1">{{ form.errors.farm_id }}</div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700/50 flex justify-end gap-3">
                    <button @click="cancelModal" type="button" class="px-5 py-2.5 rounded-xl font-semibold text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 transition duration-150">
                        {{ t('cancel') }}
                    </button>
                    <button type="submit" :disabled="form.processing" :class="{ 'opacity-50 cursor-not-allowed': form.processing }" class="px-6 py-2.5 rounded-xl font-extrabold text-sm text-white shadow-lg shadow-green-500/30 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 dark:from-green-700 dark:to-green-800 dark:hover:from-green-800 dark:hover:to-green-900 transition duration-200 transform hover:scale-[1.02]">
                        <i v-if="form.processing" class="fas fa-spinner fa-spin mr-2"></i>
                        {{ isEdit ? t('update_crop') : t('create_crop') }}
                    </button>
                </div>
            </form>
        </div>
    </Modal>
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