<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="page-inner">

        <!-- Page Header -->
        <div class="page-header">
            <h4 class="page-title text-success">Dashboard</h4>
        </div>

        <!-- KPI Cards -->
        <div class="row">
            <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                    <div class="icon-big text-center icon-success bubble-shadow-small">
                        <i class="fas fa-seedling"></i>
                    </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                    <div class="numbers">
                        <p class="card-category">Monthly Sales</p>
                        <h4 class="card-title">78,450 birr</h4>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <!-- more cards… -->
        </div>

        <!-- Charts Section -->
        <div class="row">
            <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title text-success">Sales Trend</h4>
                </div>
                <div class="card-body">
                <canvas id="salesChart"></canvas>
                </div>
            </div>
            </div>

            <!-- side cards -->
        </div>

        </div>
    </AuthenticatedLayout>
</template>
