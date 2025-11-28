<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const kpis = [
    { icon: 'fas fa-seedling', label: t('monthly_sales'), value: '78,450 birr', color: 'success' },
    { icon: 'fas fa-users', label: t('active_customers'), value: '1,230', color: 'primary' },
    { icon: 'fas fa-box', label: t('products_sold'), value: '3,400', color: 'warning' },
    { icon: 'fas fa-chart-line', label: t('growth_rate'), value: '12.5%', color: 'info' },
];

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
        <div class="page-inner py-6 px-4 bg-light min-vh-100">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-success mb-0">{{ t('dashboard') }}</h2>
                <button class="btn btn-success shadow-sm d-none d-md-inline-flex">
                    <i class="fas fa-plus me-2"></i> {{ t('new_report') }}
                </button>
            </div>

            <!-- KPI Cards -->
            <div class="row g-4 mb-5">
                <div v-for="kpi in kpis" :key="kpi.label" class="col-12 col-sm-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center">
                            <div :class="`icon-lg rounded-circle bg-${kpi.color} bg-opacity-10 text-${kpi.color} me-3`" style="font-size:2rem;">
                                <i :class="kpi.icon"></i>
                            </div>
                            <div>
                                <div class="text-muted small">{{ kpi.label }}</div>
                                <div class="fw-bold fs-5">{{ kpi.value }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 pb-0">
                            <h5 class="card-title text-success mb-0">{{ t('sales_trend') }}</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="text-muted">{{ t('quick_stats') }}</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ t('new_orders') }} <span class="badge bg-success rounded-pill">34</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ t('pending_deliveries') }} <span class="badge bg-warning rounded-pill">7</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ t('support_tickets') }} <span class="badge bg-info rounded-pill">3</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">{{ t('notifications') }}</h6>
                            <div class="alert alert-success mb-2 py-2 px-3">
                                <i class="fas fa-check-circle me-2"></i> {{ t('sales_target_reached') }}
                            </div>
                            <div class="alert alert-warning mb-0 py-2 px-3">
                                <i class="fas fa-exclamation-triangle me-2"></i> {{ t('low_stock') }}
                            </div>
                        </div>
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
