<template>
    <nav class="sidebar sidebar-style-2" data-background-color="dark2">
        <div class="sidebar-wrapper scrollbar-inner">
            <div class="sidebar-content">
                
                <!-- Logo -->
                <div class="user">
                    <div class="avatar-sm float-left mr-2">
                        <img src="/assets/img/massa-logo.svg" alt="MASSA Logo" class="avatar-img rounded-circle" />
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-white fw-bold">MASSA FARMS</a>
                    </div>
                </div>

                <!-- Navigation -->
                <ul class="nav nav-primary">
                    <li class="nav-item">
                        <Link :href="route('dashboard')" class="nav-link">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </Link>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                        <h4 class="text-section">Management</h4>
                    </li>

                    <li class="nav-item" v-for="item in managementLinks" :key="item.route">
                        <Link :href="route(item.route)" class="nav-link">
                            <i :class="item.icon"></i>
                            <p>{{ item.title }}</p>
                        </Link>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                        <h4 class="text-section">Admin</h4>
                    </li>

                    <li class="nav-item" v-for="item in adminLinks" :key="item.route">
                        <Link :href="route(item.route)" class="nav-link">
                            <i :class="item.icon"></i>
                            <p>{{ item.title }}</p>
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

const managementLinks = [
    { route: 'sales.index', icon: 'fas fa-seedling', title: 'Sales' },
    { route: 'customers.index', icon: 'fas fa-users', title: 'Customers' },
    { route: 'products.index', icon: 'fas fa-box', title: 'Products' },
    { route: 'productions.index', icon: 'fas fa-industry', title: 'Production' },
    { route: 'nurseries.index', icon: 'fas fa-leaf', title: 'Nurseries' },
    { route: 'crops.index', icon: 'fas fa-tractor', title: 'Crops' },
    { route: 'employees.index', icon: 'fas fa-user-tie', title: 'Employees' },
    { route: 'sales-locations.index', icon: 'fas fa-map-marker-alt', title: 'Sales Locations' },
    { route: 'sales-agents.index', icon: 'fas fa-user-friends', title: 'Sales Agents' },
]

const adminLinks = [
    { route: 'users.index', icon: 'fas fa-user-cog', title: 'Users' },
    { route: 'roles.index', icon: 'fas fa-user-shield', title: 'Roles' },
    { route: 'permissions.index', icon: 'fas fa-key', title: 'Permissions' },
]
</script>

<style scoped>
/* Sidebar Container */
.sidebar {
    min-height: 100vh;
    background: linear-gradient(180deg, #144529 0%, #021b0c 100%) !important;
    color: #fff;
    border-top-right-radius: 1.75rem;
    border-bottom-right-radius: 1.75rem;
    padding-top: 1rem;
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s ease-in-out;
}

/* User Section */
.user {
    margin-bottom: 2.2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-left: 0.5rem;
}

.avatar-img {
    background: #fff;
    padding: 3px;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(255, 255, 255, 0.15);
}

/* Brand Name */
.user .info a {
    font-size: 1.4rem;
    font-weight: 900;
    background: linear-gradient(90deg, #ffffff 0%, #f1c40f 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    text-shadow: 0 1px 3px rgba(0,0,0,0.25);
}

/* Navigation */
.nav-primary .nav-link {
    color: #ffffff;
    padding: 0.85rem 1.15rem;
    border-radius: 0.75rem;
    margin-bottom: 0.3rem;
    gap: 1rem;
    display: flex;
    align-items: center;
    font-weight: 600;
    font-size: 0.98rem;
    background: transparent;
    transition: all 0.25s ease;
    position: relative;
}

/* Hover + Active */
.nav-primary .nav-link.active,
.nav-primary .nav-link:hover {
    background: rgba(255, 255, 255, 0.18);
    color: #f1c40f;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
    transform: translateX(4px);
}

/* Icons */
.nav-primary .nav-link i {
    font-size: 1.25rem;
    opacity: 0.9;
    transition: transform 0.2s ease;
}

.nav-primary .nav-link:hover i {
    transform: scale(1.07);
}

/* Menu Titles */
.nav-section {
    margin: 1.7rem 0 0.8rem 0.6rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    opacity: 0.85;
}

.text-section {
    color: #f1c40f;
    font-size: 1.05rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.8px;
}

/* Scrollbar */
::-webkit-scrollbar {
    width: 7px;
}
::-webkit-scrollbar-thumb {
    background: #26804b55;
    border-radius: 4px;
}
</style>
