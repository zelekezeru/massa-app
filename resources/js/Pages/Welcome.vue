<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-green-100 to-blue-200 dark:from-gray-900 dark:to-gray-800">
        <div class="w-full max-w-2xl px-6 py-16 bg-white/90 dark:bg-gray-900/90 rounded-xl shadow-lg flex flex-col items-center">
            <svg class="h-16 w-16 mb-4 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <rect width="48" height="48" rx="12" fill="currentColor" fill-opacity="0.1"/>
                <path d="M24 14v20M14 24h20" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            </svg>
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">Welcome to Farm App</h1>
            <p class="text-lg text-gray-700 dark:text-gray-300 mb-8 text-center">
                Manage your sales, customers, and more with a modern, intuitive dashboard.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 w-full justify-center mb-6">
                <Link v-if="canLogin && $page.props.auth?.user" :href="route('dashboard')" class="px-6 py-3 rounded-lg bg-green-600 text-white font-semibold shadow hover:bg-green-700 transition">Dashboard</Link>
                <!-- <Link :href="route('sales.index')" class="px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition">Sales</Link> -->
                <!-- <Link :href="route('customers.index')" class="px-6 py-3 rounded-lg bg-indigo-600 text-white font-semibold shadow hover:bg-indigo-700 transition">Customers</Link> -->
                <template v-if="canLogin && !$page.props.auth?.user">
                    <!-- <Link :href="route('login')" class="px-6 py-3 rounded-lg bg-gray-700 text-white font-semibold shadow hover:bg-gray-800 transition">Log in</Link>
                    <Link v-if="canRegister" :href="route('register')" class="px-6 py-3 rounded-lg bg-gray-500 text-white font-semibold shadow hover:bg-gray-600 transition">Register</Link> -->
                </template>
            </div>
            <div class="w-full flex flex-col items-center mt-4">
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">Get started by exploring your dashboard or managing your data.</div>
            </div>
            <footer class="mt-10 text-xs text-gray-400 dark:text-gray-500 text-center">
                Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
            </footer>
        </div>
    </div>
</template>
