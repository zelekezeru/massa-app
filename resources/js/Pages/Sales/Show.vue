<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
const props = defineProps({ sale: Object });

function deleteSale() {
  if (confirm('Are you sure you want to delete this sale?')) {
    router.delete(route('sales.destroy', props.sale.id));
  }
}
</script>

<template>
  <Head title="Sale Details" />
  <AuthenticatedLayout>
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
      <div v-if="!sale" class="text-center text-gray-400 text-lg py-12">
        Sale not found.
      </div>
      <div v-else>
        <div class="flex items-center justify-between mb-6">
          <h1 class="text-2xl font-bold text-green-800 flex items-center gap-2">
            <i class="fas fa-file-invoice-dollar text-green-600"></i> Sale Details
          </h1>
          <div class="flex gap-2">
            <Link :href="route('sales.edit', sale.id)" class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-sm font-semibold">
              <i class="fas fa-edit mr-1"></i> Edit
            </Link>
            <!-- Delete -->
            <form @submit.prevent="deleteSale" class="inline">
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded hover:bg-red-200 transition text-sm font-semibold">
              <i class="fas fa-trash mr-1"></i> Delete
              </button>
            </form>
            <Link :href="route('sales.index')" class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded hover:bg-green-200 transition text-sm font-semibold">
              <i class="fas fa-list mr-1"></i> Back to List
            </Link>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <div>
            <p class="mb-2"><span class="font-semibold text-green-700">Invoice No:</span> {{ sale.invoice_no }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Customer:</span> {{ sale.customer?.name }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Agent:</span> {{ sale.agent?.name }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Date:</span> {{ sale.invoice_date }}</p>
          </div>
          <div>
            <p class="mb-2"><span class="font-semibold text-green-700">Subtotal:</span> {{ sale.sub_total }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Discount:</span> {{ sale.discount }}</p>
            <p class="mb-2"><span class="font-semibold text-green-700">Total:</span> <span class="text-lg font-bold">{{ sale.total }}</span></p>
            <p class="mb-2"><span class="font-semibold text-green-700">Balance Due:</span> {{ sale.balance_due }}</p>
          </div>
        </div>
        <div>
          <h2 class="text-lg font-bold text-green-700 mb-2 flex items-center gap-2">
            <i class="fas fa-list-ul"></i> Items
          </h2>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-green-100 bg-green-50 rounded-lg">
              <thead>
                <tr>
                  <th class="px-4 py-2 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Product</th>
                  <th class="px-4 py-2 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Quantity</th>
                  <th class="px-4 py-2 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Unit Price</th>
                  <th class="px-4 py-2 text-left text-xs font-bold text-green-700 uppercase tracking-wider">Line Total</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-green-50">
                <tr v-for="item in sale.items" :key="item.id">
                  <td class="px-4 py-2">{{ item.product?.name || item.product_id }}</td>
                  <td class="px-4 py-2">{{ item.quantity }}</td>
                  <td class="px-4 py-2">{{ item.unit_price }}</td>
                  <td class="px-4 py-2">{{ item.line_total }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
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
