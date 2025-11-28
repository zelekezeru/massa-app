<script setup>
import { ref, computed } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({ customers: Array, products: Array, agents: Array, locations: Array });

const form = useForm({
  customer_id: '',
  sales_agent_id: '',
invoice_date: new Date().toISOString().slice(0, 10),
  discount: 0,
  items: [
    { product_id: '', quantity: 1, unit_price: 0 }
  ]
});

</script>

<template>
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8 animate-fade-in">
      <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
        <i class="fas fa-plus-circle text-green-600"></i> New Sale
      </h1>
      <form @submit.prevent="submit" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-semibold mb-1">Customer</label>
            <select v-model="form.customer_id" required class="form-select w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500">
              <option value="" disabled>Select customer</option>
              <option v-for="c in customers" :key="c.id" :value="c.id">{{ c.name }}</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-semibold mb-1">Sales Agent</label>
            <select v-model="form.sales_agent_id" class="form-select w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500">
              <option value="">-- None --</option>
              <option v-for="a in agents" :key="a.id" :value="a.id">{{ a.user?.name }}</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-semibold mb-1">Invoice Date</label>
            <input
              type="date"
              v-model="form.invoice_date"
              required
              class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500"
              :max="today"
            />
          </div>
        </div>
        <div>
          <label class="block text-sm font-semibold mb-2">Sale Items</label>
          <div class="space-y-4">
            <div v-for="(item, idx) in form.items" :key="idx" class="flex gap-2 items-end">
              <select v-model="item.product_id" required class="form-select rounded border-gray-300 focus:border-green-500 focus:ring-green-500">
                <option value="" disabled>Select product</option>
                <option v-for="p in products" :key="p.id" :value="p.id">{{ p.name }}</option>
              </select>
              <input type="number" min="0.001" step="0.001" v-model.number="item.quantity" required placeholder="Qty" class="form-input w-20 rounded border-gray-300 focus:border-green-500 focus:ring-green-500" />
              <input type="number" min="0" step="0.01" v-model.number="item.unit_price" required placeholder="Unit Price" class="form-input w-28 rounded border-gray-300 focus:border-green-500 focus:ring-green-500" />
              <span class="font-semibold text-green-700">{{ (item.quantity * item.unit_price).toFixed(2) }}</span>
              <button type="button" @click="removeItem(idx)" class="text-red-500 hover:text-red-700 px-2 py-1" v-if="form.items.length > 1">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>
          <button type="button" @click="addItem" class="mt-3 text-green-700 hover:text-green-900 font-semibold flex items-center gap-1">
            <i class="fas fa-plus"></i> Add Item
          </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-semibold mb-1">Discount</label>
            <input type="number" min="0" step="0.01" v-model.number="form.discount" class="form-input w-full rounded border-gray-300 focus:border-green-500 focus:ring-green-500" />
          </div>
        </div>
        <div class="flex justify-end gap-4 mt-8">
          <button type="submit" class="bg-gradient-to-r from-green-500 to-green-700 text-white font-bold px-8 py-2 rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200">
            <i class="fas fa-save mr-2"></i> Save Sale
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
