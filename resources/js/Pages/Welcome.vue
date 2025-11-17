<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage, Link, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import { ArrowPathIcon } from "@heroicons/vue/24/solid";
import { ref, computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth?.user);

const userCanViewSales = computed(() => user.value?.permissions?.includes('view-sales'));
const userCanViewCustomers = computed(() => user.value?.permissions?.includes('view-customers'));
const userCanViewProducts = computed(() => user.value?.permissions?.includes('view-products'));
const userCanViewSalesLocations = computed(() => user.value?.permissions?.includes('view-sales-locations'));
const userCanViewProductions = computed(() => user.value?.permissions?.includes('view-productions'));
const userCanViewNurseries = computed(() => user.value?.permissions?.includes('view-nurseries'));
const userCanViewCrops = computed(() => user.value?.permissions?.includes('view-crops'));
const userCanViewEmployees = computed(() => user.value?.permissions?.includes('view-employees'));
const userCanViewLocations = computed(() => user.value?.permissions?.includes('view-locations'));

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>
<style scoped>
body {
  font-family: "Inter", sans-serif;
}
</style>

<template>
    <Head title="Welcome" />

    <AuthLayout>
        <div class="min-h-screen bg-gradient-to-br from-green-100 to-green-200 flex flex-col">

            <!-- Navigation -->
            <header class="w-full py-6 px-10 flex justify-between items-center shadow-sm">
            <h1 class="text-3xl font-bold text-green-700">MASSA FARMS</h1>
            <div class="space-x-4">
                
                <Link
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </Link>
                <Link
                    v-if="canLogin"
                    :href="route('login')"
                    class="rounded-md text-sm text-green-700 underline hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 font-semibold"
                >
                    Login
                </Link>
                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="bg-green-600 px-4 py-2 rounded-lg text-white hover:bg-green-700 transition"
                >
                    Get Started
                </Link>
            </div>
            </header>

            <!-- Hero Section -->
            <section class="flex flex-col md:flex-row items-center justify-between px-10 mt-12 mb-6">

            <!-- Left Text -->
            <div class="max-w-xl">
                <h2 class="text-5xl md:text-6xl font-bold text-green-800 leading-tight">
                Smart Farm Management<br />
                For Modern Agriculture
                </h2>

                <p class="mt-6 text-gray-700 text-lg">
                MASSA FARMS App helps you manage your farm operations efficiently, 
                including sales, production, nursery, employees, locations, and real-time farm analytics.
                </p>

                <div class="mt-8 flex space-x-4">
                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="bg-green-600 px-6 py-3 rounded-lg text-white text-lg hover:bg-green-700 transition"
                >
                    Create Account
                </Link>
                <Link
                    v-if="canLogin"
                    :href="route('login')"
                    class="border border-green-700 px-6 py-3 rounded-lg text-green-700 text-lg hover:bg-green-800 hover:text-white transition"
                >
                    Login
                </Link>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="mt-10 md:mt-0">
                <img
                src="/assets/img/farm-hero.jpg"
                alt="Farm Image"
                class="w-full max-w-md drop-shadow-xl rounded-xl"
                />
            </div>
            </section>

            <!-- Features Section -->
            <section class="px-10 py-16 bg-white rounded-t-3xl shadow-xl mt-12">

            <h3 class="text-3xl font-bold text-center text-green-700">App Features</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-12">

                <!-- Feature 1 -->
                <Link
                    v-if="userCanViewProductions"
                    :href="route('productions.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <img src="/assets/img/icons/manage.png" class="mx-auto w-16" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Production Management</h4>
                    <p class="text-gray-600 mt-2">
                        Track all crop production, harvests, batches, expenses, irrigation and more.
                    </p>
                </Link>

                <!-- Feature 2 -->
                <Link
                    v-if="userCanViewNurseries"
                    :href="route('nurseries.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <img src="/assets/img/icons/nursery.png" class="mx-auto w-16" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Nursery & Seedlings</h4>
                    <p class="text-gray-600 mt-2">
                        Manage seedlings, nursery beds, transplanting schedules and inputs.
                    </p>
                </Link>

                <!-- Feature 3 -->
                <Link
                    v-if="view-sales"
                    :href="route('sales.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <img src="/assets/img/icons/sales.jpg" class="mx-auto w-16" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Sales & Customers</h4>
                    <p class="text-gray-600 mt-2">
                        Record sales, manage commissions, track customers and generate reports.
                    </p>
                </Link>

            </div>

            <!-- More Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10">

                <Link
                    v-if="userCanViewCrops"
                    :href="route('crops.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <img src="/assets/img/icons/crop.png" class="mx-auto w-16" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Crop Inventory</h4>
                    <p class="text-gray-600 mt-2">
                        Manage harvested crops, stock, dispatch, packaging and delivery.
                    </p>
                </Link>

                <Link
                    v-if="userCanViewEmployees"
                    :href="route('employees.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <img src="/assets/img/icons/team.png" class="mx-auto w-16" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Employees & Teams</h4>
                    <p class="text-gray-600 mt-2">
                        Track employee work, salaries, responsibilities and activity logs.
                    </p>
                </Link>

                <Link
                    v-if="userCanViewLocations"
                    :href="route('locations.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <img src="/assets/img/icons/location.jpg" class="mx-auto w-16" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Farm Locations</h4>
                    <p class="text-gray-600 mt-2">
                        Manage multiple farm sites, plots, beds and irrigation zones.
                    </p>
                </Link>

            </div>
            </section>

            <!-- Footer -->
            <footer class="py-10 text-center text-gray-600">
            © 2025 MASSA FARMS — Smart Agriculture Solutions
            </footer>

        </div>
    </AuthLayout>
</template>
