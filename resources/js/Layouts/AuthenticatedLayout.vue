<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, Head } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);

import jquery from "../public/kaiadmin/js/plugin/jquery-scrollbar/jquery-scrollbar.js";
import bootstrap from "../public/kaiadmin/js/plugin/bootstrap/bootstrap.min.js";
import kaiadmin from "../public/kaiadmin/js/kaiadmin.min.js";

</script>

<template>
    <Head>

    </Head>

    <!-- WRAPPER -->
    <div class="wrapper">

        <!-- === NAVBAR === -->
        <nav class="navbar navbar-header navbar-expand-lg">
            <div class="container-fluid d-flex justify-between">

                <!-- Logo -->
                <div class="navbar-brand">
                    <Link :href="route('dashboard')" class="text-decoration-none">
                        <ApplicationLogo class="h-8 w-auto text-success" />
                    </Link>
                </div>

                <!-- Desktop Menu -->
                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center d-none d-lg-flex">
                    <li class="nav-item dropdown hidden-caret">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <a class="nav-link dropdown-toggle" href="#">
                                    <span class="me-2 fw-bold text-dark">
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
                    class="navbar-toggler"
                    type="button"
                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div
                class="collapse navbar-collapse"
                :class="{ show: showingNavigationDropdown }"
            >
                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </li>
                </ul>

                <div class="border-top mt-3 pt-3 px-3">
                    <div class="fw-bold text-dark">
                        {{ $page.props.auth.user.name }}
                    </div>
                    <div class="text-muted small">
                        {{ $page.props.auth.user.email }}
                    </div>

                    <div class="mt-3">
                        <ResponsiveNavLink :href="route('profile.edit')">
                            Profile
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                            Logout
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- === MAIN PANEL === -->
        <div class="main-panel">

            <!-- PAGE HEADER -->
            <div v-if="$slots.header" class="page-header bg-white shadow-sm py-3 px-4">
                <slot name="header" />
            </div>

            <!-- PAGE CONTENT -->
            <div class="container">
                <slot />
            </div>

        </div>
    </div>
</template>

<style scoped>
    @import "/kaiadmin/css/bootstrap.min.css";
    @import "/kaiadmin/css/kaiadmin.min.css";
</style>