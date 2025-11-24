<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage, Link, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import { ArrowPathIcon, HomeModernIcon, BanknotesIcon, UserGroupIcon, MapPinIcon, CircleStackIcon } from "@heroicons/vue/24/solid";
import { ref, computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth?.user);

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
                    :href="route('login')"
                    class="bg-green-600 px-4 py-2 rounded-lg text-white hover:bg-green-700 transition font-semibold text-sm"
                >
                    Login
                </Link>
                <Link
                    :href="route('register')"
                    class="bg-green-600 px-4 py-2 rounded-lg text-white hover:bg-green-700 transition"
                >
                    Get Started
                </Link>
            </div>
            </header>

            <!-- Hero Section -->
            <section class="bg-white/80 rounded-3xl shadow-xl p-8 md:p-12 flex flex-col items-center animate-fade-in">
                <h2 class="text-5xl md:text-6xl font-extrabold text-green-800 leading-tight text-center drop-shadow-lg">
                    Smart Farm Management<br>
                    <span class="bg-gradient-to-r from-green-400 via-green-600 to-green-400 bg-clip-text text-transparent">
                        For Modern Agriculture
                    </span>
                </h2>
                <p class="mt-6 text-gray-700 text-lg md:text-xl text-center max-w-2xl">
                    MASSA FARMS App empowers you to streamline farm operations with ease, all in one intuitive platform.
                </p>
                <div class="mt-8 flex flex-col md:flex-row gap-4 w-full justify-center">
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="bg-gradient-to-r from-green-500 to-green-700 px-8 py-3 rounded-xl text-white text-lg font-bold shadow-md hover:scale-105 hover:bg-green-800 transition-all duration-200"
                    >
                        Get Started Free
                    </Link>
                    <Link
                        v-if="canLogin"
                        :href="route('login')"
                        class="border-2 border-green-700 px-8 py-3 rounded-xl text-green-700 text-lg font-bold bg-white hover:bg-green-50 hover:scale-105 transition-all duration-200"
                    >
                        Login
                    </Link>
                </div>
            </section>

            <!-- Features Section -->
            <section class="px-10 py-16 bg-white rounded-t-3xl shadow-xl mt-12">

            <h3 class="text-3xl font-bold text-center text-green-700">App Features</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-12">

                <!-- Feature 1 -->
                <Link
                    :href="route('productions.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <HomeModernIcon class="mx-auto w-16 text-green-600" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Production Management</h4>
                    <p class="text-gray-600 mt-2">
                        Track all crop production, harvests, batches, expenses, irrigation and more.
                    </p>
                </Link>

                <!-- Feature 2 -->
                <Link
                    :href="route('nurseries.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center">
                    
                    <ArrowPathIcon class="mx-auto w-16 text-green-600" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Nursery & Seedlings</h4>
                    <p class="text-gray-600 mt-2">
                        Manage seedlings, nursery beds, transplanting schedules and inputs.
                    </p>
                </Link>

                <!-- Feature 3 -->
                <Link
                    :href="route('sales.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <BanknotesIcon class="mx-auto w-16 text-green-600" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Sales & Customers</h4>
                    <p class="text-gray-600 mt-2">
                        Record sales, manage commissions, track customers and generate reports.
                    </p>
                </Link>

            </div>

            <!-- More Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10">

                <Link
                    :href="route('crops.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <CircleStackIcon class="mx-auto w-16 text-green-600" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Crop Inventory</h4>
                    <p class="text-gray-600 mt-2">
                        Manage harvested crops, stock, dispatch, packaging and delivery.
                    </p>
                </Link>

                <Link
                    :href="route('employees.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <UserGroupIcon class="mx-auto w-16 text-green-600" />
                    <h4 class="mt-4 text-xl font-bold text-green-800">Employees & Teams</h4>
                    <p class="text-gray-600 mt-2">
                        Track employee work, salaries, responsibilities and activity logs.
                    </p>
                </Link>

                <Link
                    :href="route('locations.index')"
                    class="bg-green-50 p-8 rounded-2xl shadow-sm hover:shadow-lg transition text-center"
                >
                    <MapPinIcon class="mx-auto w-16 text-green-600" />
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