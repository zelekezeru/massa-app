<script setup>
import AdminSidebar from "./AdminSidebar.vue";
// import SalesSidebar from "./SalesSidebar.vue";
// import FinanceSidebar from "./FinanceSidebar.vue";
// import FarmManagerSidebar from "./FarmManagerSidebar.vue";
// import CustomerSidebar from "./CustomerSidebar.vue";
// import FarmerSidebar from "./FarmerSidebar.vue";
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    isOpen: Boolean,
    isMobile: Boolean,
});

const user = usePage().props.auth?.user || {};

let sidebarComponent = AdminSidebar;
if (user.role === "SUPER-ADMIN") {
    sidebarComponent = AdminSidebar;
}

// else if (user.role === "ADMIN") {
//     sidebarComponent = AdminSidebar;
// }
// else if (user.role === "SALES-AGENT") {
//     sidebarComponent = SalesSidebar;
// }
// else if (user.role === "FINANCE") {
//     sidebarComponent = FinanceSidebar;
// }
// else if (user.role === "FARM-MANAGER") {
//     sidebarComponent = FarmManagerSidebar;
// }
// else if (user.role === "CUSTOMER") {
//     sidebarComponent = CustomerSidebar;
// }
// else if (user.role === "FARMER") {
//     sidebarComponent = FarmerSidebar;
// }
// else {
//     sidebarComponent = GuestSidebar; // Default sidebar
// }
// Add more role checks here if you add more sidebar components
// e.g. if (user.role === "SALES-AGENT") { sidebarComponent = SalesSidebar; }
</script>

<template>
    <component :is="sidebarComponent" :is-open="isOpen" :is-mobile="isMobile" />
</template>
