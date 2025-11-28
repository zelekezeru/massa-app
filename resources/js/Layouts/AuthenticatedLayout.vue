<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, Head } from "@inertiajs/vue3";
import AdminSideNavigation from '@/Layouts/AdminSideNavigation.vue';

const showingNavigationDropdown = ref(false);
const showSidebar = ref(true);
</script>

<template>
    <Head />
    <div class="wrapper flex">
        <!-- Sidebar -->
        <transition name="slide">
            <AdminSideNavigation v-if="showSidebar" />
        </transition>
        <!-- Main Content -->
        <div class="flex-1 min-w-0">
            <!-- === NAVBAR === -->
            <nav class="navbar navbar-header navbar-expand-lg massa-navbar flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <!-- Hamburger Button -->
                    <button
                        class="navbar-toggler massa-navbar-toggler mr-2"
                        type="button"
                        @click="showSidebar = !showSidebar"
                        aria-label="Toggle sidebar"
                    >
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <div class="container-fluid d-flex align-items-center justify-content-end ms-auto">
                    <!-- Desktop Menu -->
                    <ul class="navbar-nav topbar-nav align-items-center d-none d-lg-flex">
                        <li class="nav-item dropdown hidden-caret">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <a class="nav-link dropdown-toggle massa-nav-link" href="#">
                                        <span class="me-2 fw-bold massa-nav-user">
                                            {{ $page.props.auth.user.name }}
                                        </span>
                                        <i class="fa fa-user-circle"></i>
                                    </a>
                                </template>
                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Logout
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </li>
                    </ul>
                    <!-- Mobile Toggle -->
                    <button
                        class="navbar-toggler massa-navbar-toggler"
                        type="button"
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <!-- Mobile Menu -->
                <div
                    class="collapse navbar-collapse massa-navbar-collapse"
                    :class="{ show: showingNavigationDropdown }"
                >
                    <ul class="navbar-nav ms-3">
                        <li class="nav-item">
                            <ResponsiveNavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                                class="massa-nav-link"
                            >
                                Dashboard
                            </ResponsiveNavLink>
                        </li>
                    </ul>
                    <div class="border-top mt-3 pt-3 px-3">
                        <div class="fw-bold massa-nav-user">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="text-muted small">
                            {{ $page.props.auth.user.email }}
                        </div>
                        <div class="mt-3">
                            <ResponsiveNavLink :href="route('profile.edit')" class="massa-nav-link">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="massa-nav-link">
                                Logout
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- === MAIN PANEL === -->
            <div class="main-panel">
                <!-- PAGE HEADER -->
                <div v-if="$slots.header" class="page-header refined-header shadow-sm px-4">
                    <slot name="header" />
                </div>
                <!-- PAGE CONTENT -->
                <div class="container mt-3">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.slide-enter-active, .slide-leave-active {
  transition: margin-left 0.3s, opacity 0.3s;
}
.slide-enter-from, .slide-leave-to {
  margin-left: -260px;
  opacity: 0;
}

/* === NAVBAR STYLING === */
.massa-navbar {
    background: linear-gradient(90deg, #38c172 0%, #218838 100%) !important;
    color: #fff;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
    box-shadow: 0 2px 8px rgba(56,193,114,0.10);
    padding: 0.5rem 1.25rem; /* smaller, cleaner */
    height: 64px; /* reduced height */
}
.massa-navbar .navbar-brand {
    display: flex;
    align-items: center;
    padding-top: 2px;
}
.massa-nav-link {
    color: #fff !important;
    font-weight: 600;
    letter-spacing: 0.6px;
    font-size: 0.95rem; /* smaller & cleaner */
    border-radius: 0.6rem;
    padding: 0.55rem 1rem;
    transition: 0.25s ease;
}
.massa-nav-link:hover,
.massa-nav-link.active {
    background: rgba(255,255,255,0.20) !important;
    color: #ffe082 !important;
}
.massa-nav-user {
    color: #ffe082;
    font-weight: 800;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    text-shadow: 0 1px 3px #21883844;
}

.massa-navbar-toggler {
    border: none;
    background: rgba(255,255,255,0.2);
    border-radius: 0.4rem;
    color: #fff;
    padding: 0.35rem;
}

/* === MOBILE COLLAPSE === */
.massa-navbar-collapse {
    background: linear-gradient(90deg, #38c172 0%, #218838 100%) !important;
    border-radius: 1rem;
    padding-bottom: 1rem;
}

/* === REFINED PAGE HEADER === */
.refined-header {
    background: #ffffff;
    padding: 0.75rem 1.25rem; /* smaller height */
    border-left: 4px solid #38c172; /* subtle accent */
    border-radius: 0.5rem;
    margin-top: 0.75rem;
}
</style>
