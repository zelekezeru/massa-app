<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import Modal from '@/Components/Modal.vue';
import { useI18n } from 'vue-i18n';
import { computed } from 'vue';
import { route } from 'ziggy-js';
import Swal from 'sweetalert2';

const props = defineProps({ sales: Array, customers: Array, products: Array, salesAgents: Array, salesLocations: Array });
const { t } = useI18n();

const showModal = ref(false);
const isEdit = ref(false);
const editingSale = ref(null);

const form = useForm({
    invoice_no: '',
    customer_id: '',
    sales_agent_id: '',
    invoice_date: '',
    status: '',
    sub_total: 0,
    discount: 0,
    tax: 0,
    total: 0,
    balance_due: 0,
    notes: '',
    items: [], // [{ product_id, quantity, unit_price, line_total }]
});

function openCreateModal() {
    isEdit.value = false;
    form.reset();
    form.items = [{ product_id: '', quantity: 1, unit_price: 0, line_total: 0 }];
    showModal.value = true;
}
function openEditModal(sale) {
    isEdit.value = true;
    editingSale.value = sale;
    form.invoice_no = sale.invoice_no;
    form.customer_id = sale.customer_id;
    form.sales_agent_id = sale.sales_agent_id;
    form.invoice_date = sale.invoice_date;
    form.status = sale.status;
    form.sub_total = sale.sub_total;
    form.discount = sale.discount;
    form.tax = sale.tax;
    form.total = sale.total;
    form.balance_due = sale.balance_due;
    form.notes = sale.notes;
    form.items = sale.items.map(it => ({ ...it }));
    showModal.value = true;
}
function cancelModal() {
    showModal.value = false;
    isEdit.value = false;
    editingSale.value = null;
    form.reset();
    form.items = [];
}

function submitSale() {
    // Calculate totals before submit
    form.sub_total = form.items.reduce((sum, it) => sum + (it.unit_price * it.quantity), 0);
    form.total = form.sub_total - (form.discount || 0) + (form.tax || 0);
    form.balance_due = form.total;
    if (isEdit.value && editingSale.value) {
        form.put(safeRoute('sales.update', editingSale.value.id), {
            onSuccess: () => {
                cancelModal();
                Swal.fire({
                  title: t('updated'),
                  text: t('sale_updated'),
                  icon: 'success',
                  timer: 1800,
                  showConfirmButton: false
                });
            }
        });
    } else {
        form.post(safeRoute('sales.store'), {
            onSuccess: () => {
                cancelModal();
                Swal.fire({
                  title: t('created'),
                  text: t('sale_created'),
                  icon: 'success',
                  timer: 1800,
                  showConfirmButton: false
                });
            }
        });
    }
}

function deleteSale(sale) {
  Swal.fire({
    title: t('are_you_sure'),
    text: t('delete_sale_confirm'),
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
        form.delete(safeRoute('sales.destroy', sale.id), {
          onSuccess: () => {
            Swal.fire({
              title: t('deleted'),
              text: t('sale_deleted'),
              icon: 'success',
              timer: 1800,
              showConfirmButton: false
            });
            resolve();
          },
          onError: () => {
            Swal.fire({
              title: t('error'),
              text: t('failed_to_delete_sale'),
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
            return '/sales';
        }
        if (name.endsWith('.update')) {
            const id = typeof params === 'object' ? params.id || params : params;
            return `/sales/${id}`;
        }
        if (name.endsWith('.show')) {
            const id = typeof params === 'object' ? params.id || params : params;
            return `/sales/${id}`;
        }
        return '/';
    }
}

const showDetailsModal = ref(false);
const detailsSale = ref(null);

function openDetailsModal(sale) {
    detailsSale.value = sale;
    showDetailsModal.value = true;
}
function closeDetailsModal() {
    showDetailsModal.value = false;
    detailsSale.value = null;
}

const yourRef = ref(null);

if (yourRef.value) {
  const locale = yourRef.value.getAttribute('data-locale');
}
</script>

<template>
    <Head :title="t('sales')" />
    <div class="page-inner py-6 px-4 min-vh-100 text-white-900 dark:text-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-green-800 mb-2 md:mb-0 tracking-tight drop-shadow-sm dark:text-green-300">
                <i class="fas fa-cash-register mr-2 text-green-600 dark:text-green-400"></i> {{ t('sales') }}
            </h1>
            <button type="button" @click="openCreateModal" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-6 py-2 rounded-lg shadow-lg hover:from-green-600 hover:to-green-800 transition-all duration-200 transform hover:scale-[1.01] dark:from-green-600 dark:to-green-800">
                <i class="fas fa-plus text-current"></i> {{ t('new_sale') }}
            </button>
        </div>
        <div class="rounded-xl shadow-lg overflow-x-auto animate-fade-in dark:bg-gray-800 text-white-900 dark:text-gray-100 mt-8">
          <table class="min-w-full divide-y divide-green-100 dark:divide-green-900/30">
            <thead class="bg-green-50 dark:bg-green-900/20">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('invoice_no') }}</th>
                <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('customer') }}</th>
                <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('invoice_date') }}</th>
                <th class="px-4 py-3 text-left text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('total') }}</th>
                <th class="px-4 py-3 text-center text-xs font-bold text-green-700 dark:text-green-300 uppercase tracking-wider">{{ t('actions') }}</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-green-50 dark:divide-green-900/20">
              <tr v-if="!sales || sales.length === 0">
                <td colspan="5" class="text-center py-8 text-gray-400 dark:text-gray-300 text-lg">{{ t('no_sales_found') }}</td>
              </tr>
              <tr v-for="sale in sales" :key="sale.id" class="dark:bg-transparent hover:bg-green-50 dark:hover:bg-green-900/30 transition">
                <td class="px-4 py-3 font-semibold text-green-900 dark:text-green-300">{{ sale.invoice_no }}</td>
                <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ sale.customer?.name }}</td>
                <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ sale.invoice_date }}</td>
                <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ sale.total }}</td>
                <td class="px-4 py-3 text-center flex gap-2 justify-center">
                  <button @click="openDetailsModal(sale)" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-xs font-semibold dark:bg-green-900/30 dark:text-green-200 dark:hover:bg-green-800/30">
                    <i class="fas fa-eye mr-1 text-current"></i> {{ t('view') }}
                  </button>
                  <button @click="openEditModal(sale)" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs font-semibold dark:bg-yellow-900/20 dark:text-yellow-200 dark:hover:bg-yellow-800/20">
                    <i class="fas fa-edit mr-1 text-current"></i> {{ t('edit') }}
                  </button>
                  <button @click="deleteSale(sale)" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded hover:bg-red-200 transition text-xs font-semibold dark:bg-red-900/20 dark:text-red-200 dark:hover:bg-red-800/20">
                    <i class="fas fa-trash-alt mr-1 text-current"></i> {{ t('delete') }}
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
    <!-- Sale Details Modal -->
    <Modal :show="showDetailsModal" @close="closeDetailsModal">
      <div class="px-6 py-4 flex items-center justify-between bg-gradient-to-r from-green-600 to-green-500 dark:from-green-700 dark:to-green-600 shadow-inner">
        <h2 class="text-xl font-extrabold flex items-center justify-center w-full gap-3 text-white drop-shadow text-center">
          <i class="fas fa-cash-register text-white text-xl opacity-90"></i>
          {{ detailsSale?.invoice_no }} {{ t('sale_details') }}
        </h2>
        <button @click="closeDetailsModal" class="p-2 rounded-full text-white/80 hover:text-white hover:bg-white/10 transition">
          <i class="fas fa-times text-lg"></i>
        </button>
      </div>
      <div class="px-6 py-6 space-y-8 dark:bg-gray-800 ">
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('customer') }}
            </p>
            <p class="text-xl font-bold text-green-800 dark:text-green-300 tracking-wide">
              {{ detailsSale?.customer?.name }}
            </p>
          </div>
        </div>
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('invoice_date') }}
            </p>
            <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">
              {{ detailsSale?.invoice_date }}
            </p>
          </div>
        </div>
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('total') }}
            </p>
            <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">
              {{ detailsSale?.total }}
            </p>
          </div>
        </div>
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('status') }}
            </p>
            <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">
              {{ detailsSale?.status }}
            </p>
          </div>
        </div>
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('notes') }}
            </p>
            <p class="text-base text-gray-700 dark:text-gray-300 leading-relaxed">
              {{ detailsSale?.notes || '-' }}
            </p>
          </div>
        </div>
        <div class="flex items-start gap-4 group">
          <div>
            <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
              {{ t('items') }}
            </p>
            <ul>
              <li v-for="item in detailsSale?.items || []" :key="item.id">
                {{ item.product?.name }} - {{ t('quantity') }}: {{ item.quantity }}, {{ t('unit_price') }}: {{ item.unit_price }}, {{ t('line_total') }}: {{ item.line_total }}
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="px-6 py-4 border-t border-gray-200 dark:bg-gray-800 backdrop-blur-md flex justify-end">
        <button @click="closeDetailsModal" class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 shadow-sm transition">
          {{ t('close') }}
        </button>
      </div>
    </Modal>
    <!-- Sale Create & Edit Modal -->
    <Modal :show="showModal" @close="cancelModal">
        <div class="relative w-full overflow-hidden dark:bg-gray-800 shadow-2xl ring-1 ring-black/5 dark:ring-white/5 animate-modalIn">
            <form @submit.prevent="submitSale">
                <div class="px-6 py-5 flex items-center justify-between border-b border-gray-200 dark:border-gray-700/50">
                    <h2 class="text-2xl font-extrabold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                        <i :class="isEdit 
                                ? 'fas fa-edit text-yellow-600 dark:text-yellow-400 text-xl' 
                                : 'fas fa-plus-circle text-green-600 dark:text-green-400 text-xl'"
                        ></i>
                        <span class="text-gray-800 dark:text-gray-100">
                            {{ isEdit ? t('edit_sale') : t('create_new_sale') }}
                        </span>
                    </h2>
                    <button type="button" @click="cancelModal"
                        class="p-2 -m-2 rounded-full text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-200 transition-colors hover:bg-gray-100 dark:hover:bg-gray-700/50">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="px-6 py-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-200">{{ t('customer') }} <span class="text-red-500">*</span></label>
                        <select v-model="form.customer_id" required class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900 dark:text-gray-100">
                          <option value="">{{ t('customer') }}</option>
                          <option v-for="c in customers" :key="c.id" :value="c.id">{{ c.name }}</option>
                        </select>
                        <div v-if="form.errors.customer_id" class="text-sm text-red-500 mt-1">{{ form.errors.customer_id }}</div>
                      </div>
                      <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-200">{{ t('invoice_date') }} <span class="text-red-500">*</span></label>
                        <input v-model="form.invoice_date" type="date" required class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900 dark:text-gray-100" />
                        <div v-if="form.errors.invoice_date" class="text-sm text-red-500 mt-1">{{ form.errors.invoice_date }}</div>
                      </div>
                      <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-200">{{ t('sales_agent') }}</label>
                        <select v-model="form.sales_agent_id" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900 dark:text-gray-100">
                          <option value="">{{ t('sales_agent') }}</option>
                          <option v-for="a in salesAgents" :key="a.id" :value="a.id">{{ a.user?.name }}</option>
                        </select>
                        <div v-if="form.errors.sales_agent_id" class="text-sm text-red-500 mt-1">{{ form.errors.sales_agent_id }}</div>
                      </div>
                      <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-200">{{ t('discount') }}</label>
                        <input v-model="form.discount" type="number" min="0" step="any" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900" />
                        <div v-if="form.errors.discount" class="text-sm text-red-500 mt-1">{{ form.errors.discount }}</div>
                      </div>
                      <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-200">{{ t('notes') }}</label>
                        <textarea v-model="form.notes" rows="2" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700 text-white-900" />
                        <div v-if="form.errors.notes" class="text-sm text-red-500 mt-1">{{ form.errors.notes }}</div>
                      </div>
                    </div>
                    <div class="mt-6">
                      <h3 class="text-lg font-bold mb-2">{{ t('items') }}</h3>
                      <table class="min-w-full divide-y divide-green-100 dark:divide-green-900/30 mb-2">
                        <thead>
                          <tr>
                            <th class="px-2 py-2">{{ t('product') }}</th>
                            <th class="px-2 py-2">{{ t('quantity') }}</th>
                            <th class="px-2 py-2">{{ t('unit_price') }}</th>
                            <th class="px-2 py-2">{{ t('line_total') }}</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(item, idx) in form.items" :key="idx">
                            <td>
                              <select v-model="item.product_id" class="w-full rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700">
                                <option value="">{{ t('product') }}</option>
                                <option v-for="p in products" :key="p.id" :value="p.id">{{ p.name }}</option>
                              </select>
                            </td>
                            <td>
                              <input v-model.number="item.quantity" type="number" min="0.001" step="any" class="w-20 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700" @input="item.line_total = item.quantity * item.unit_price" />
                            </td>
                            <td>
                              <input v-model.number="item.unit_price" type="number" min="0" step="any" class="w-24 rounded-xl bg-gray-50 dark:bg-gray-700/70 border-2 border-gray-200 dark:border-gray-700" @input="item.line_total = item.quantity * item.unit_price" />
                            </td>
                            <td>
                              <span>{{ item.line_total = item.quantity * item.unit_price }}</span>
                            </td>
                            <td>
                              <button type="button" @click="form.items.splice(idx, 1)" v-if="form.items.length > 1" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <button type="button" @click="form.items.push({ product_id: '', quantity: 1, unit_price: 0, line_total: 0 })" class="px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 text-xs font-semibold"><i class="fas fa-plus"></i> {{ t('add_item') }}</button>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700/50 flex justify-end gap-3">
                    <button @click="cancelModal" type="button" class="px-5 py-2.5 rounded-xl font-semibold text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 transition duration-150">
                        {{ t('cancel') }}
                    </button>
                    <button type="submit" :disabled="form.processing" :class="{ 'opacity-50 cursor-not-allowed': form.processing }" class="px-6 py-2.5 rounded-xl font-extrabold text-sm text-white shadow-lg shadow-green-500/30 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 dark:from-green-700 dark:to-green-800 dark:hover:from-green-800 dark:hover:to-green-900 transition duration-200 transform hover:scale-[1.02]">
                        <i v-if="form.processing" class="fas fa-spinner fa-spin mr-2"></i>
                        {{ isEdit ? t('update_sale') : t('create_sale') }}
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