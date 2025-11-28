<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, inject } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const kpis = [
    { icon: 'fas fa-seedling', label: t('monthly_sales'), value: '78,450 birr', color: 'success' },
    { icon: 'fas fa-users', label: t('active_customers'), value: '1,230', color: 'primary' },
    { icon: 'fas fa-box', label: t('products_sold'), value: '3,400', color: 'warning' },
    { icon: 'fas fa-chart-line', label: t('growth_rate'), value: '12.5%', color: 'info' },
];

// Theme from layout
// const darkMode = inject('darkMode', ref(false));

// Chart.js example
let chartInstance = null;
onMounted(async () => {
    const Chart = (await import('chart.js/auto')).default;
    const ctx = document.getElementById('salesChart').getContext('2d');
    chartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                t('months.jan'),
                t('months.feb'),
                t('months.mar'),
                t('months.apr'),
                t('months.may'),
                t('months.jun')
            ],
            datasets: [{
                label: 'Sales',
                data: [12000, 15000, 14000, 18000, 20000, 22000],
                borderColor: '#38c172',
                backgroundColor: 'rgba(56,193,114,0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: '#38c172',
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#e9ecef' } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>

<template>  
    <Head title="Dashboard" />

    <AppLayout>
        <div class="space-y-8">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-white">{{ t('dashboard') }}</h2>
                <button class="btn btn-success shadow-sm d-none d-md-inline-flex">
                    <i class="fas fa-plus me-2"></i> {{ t('new_report') }}
                </button>
            </div>
            <!-- KPI Cards -->
            <div class="row g-4 mb-5">
                <div v-for="kpi in kpis" :key="kpi.label" class="col-12 col-sm-6 col-lg-3 ">
                <!-- <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"> -->
                    <div class="p-6 transition shadow dark:bg-gray-800 rounded-xl hover:shadow-lg">
                        <div class="flex items-center space-x-4">
                            <AcademicCapIcon class="w-8 h-8 text-blue-500" />
                            <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ kpi.label }}</p>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ kpi.value }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="transition shadow dark:bg-gray-800 rounded-xl hover:shadow-lg">
                        <div class="transition shadow dark:bg-gray-800 rounded-xl hover:shadow-lg">
                            <h5 class="card-title text-success mb-0">{{ t('sales_trend') }}</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 space-y-4">

                <!-- Quick Stats Card -->
                <div class="rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 dark:bg-gray-800 p-5 border border-gray-100 dark:border-gray-700">
                    <h6 class="text-center text-2xl font-extrabold text-emerald-700 dark:text-emerald-400 tracking-wide">
                        {{ t('quick_stats') }}
                    </h6>

                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-2 flex justify-between items-center text-gray-600 dark:text-gray-300 text-sm">
                            <span class="font-medium flex items-center gap-2">
                                <i class="fas fa-basket-shopping text-emerald-500"></i>
                                {{ t('new_orders') }}
                            </span>
                            <span class="px-3 py-1 bg-emerald-500 text-white rounded-full shadow text-xs">34</span>
                        </li>

                        <li class="py-2 flex justify-between items-center text-gray-600 dark:text-gray-300 text-sm">
                            <span class="font-medium flex items-center gap-2">
                                <i class="fas fa-truck-loading text-yellow-500"></i>
                                {{ t('pending_deliveries') }}
                            </span>
                            <span class="px-3 py-1 bg-yellow-400 text-gray-900 rounded-full shadow text-xs">7</span>
                        </li>

                        <li class="py-2 flex justify-between items-center text-gray-600 dark:text-gray-300 text-sm">
                            <span class="font-medium flex items-center gap-2">
                                <i class="fas fa-headset text-blue-500"></i>
                                {{ t('support_tickets') }}
                            </span>
                            <span class="px-3 py-1 bg-blue-500 text-white rounded-full shadow text-xs">3</span>
                        </li>
                    </ul>
                </div>

                <!-- Notifications Card -->
                <div class="rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 dark:bg-gray-800 p-6 border border-gray-100 dark:border-gray-700">
                    <h6 class="text-center text-2xl font-extrabold text-emerald-700 dark:text-emerald-400 tracking-wide">
                        {{ t('notifications') }}
                    </h6>

                    <ul class="space-y-2">
                        <!-- Success Notification -->
                        <li class="dark:bg-gray-800 text-sm text-gray-600 dark:text-gray-300">
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 dark:bg-gray-900 border border-emerald-200 dark:border-gray-700 rounded-xl shadow">
                                <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                                <span>{{ t('sales_target_reached') }}</span>
                            </div>
                        </li>

                        <!-- Warning Notification -->
                        <li class="dark:bg-gray-800 text-sm text-gray-600 dark:text-gray-300">
                            <div class="flex items-center gap-3 p-3 bg-yellow-50 dark:bg-gray-900 border border-yellow-300 dark:border-gray-700 rounded-xl shadow">
                                <i class="fas fa-exclamation-triangle text-yellow-500 text-lg"></i>
                                <span>{{ t('low_stock') }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.icon-lg {
    width: 3.5rem;
    height: 3.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
}
.bg-opacity-10 {
    opacity: 0.1;
}
</style>
