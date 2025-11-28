<script setup>
import { computed } from "vue";

// ✔ Correct Heroicons for each route group
import {
    AcademicCapIcon,        // Dashboard
    CubeIcon,               // products.index
    BuildingOffice2Icon,    // productions.index
    QueueListIcon,          // nurseries.index
    SunIcon,             // crops.index
    UsersIcon,              // customers.index
    UserGroupIcon,          // employees.index
    UserIcon,               // users.index
    MapPinIcon,             // sales-locations.index
    UserPlusIcon,           // sales-agents.index
    ChartBarSquareIcon,     // sales.index
    KeyIcon,                // permissions, roles
    Cog6ToothIcon,           // dropdown headers
    ShoppingCartIcon,
    BanknotesIcon,
    CurrencyDollarIcon
} from "@heroicons/vue/24/outline";

import SidebarItem from "./SidebarItem.vue";
import SidebarDropdownMenu from "./SidebarDropdownMenu.vue";

const props = defineProps({
    isOpen: Boolean,
    isMobile: Boolean,
});

// Sidebar collapse logic
const wrapperClasses = computed(() => {
    if (props.isMobile) {
        return [
            "fixed inset-y-0 left-0 z-50 bg-white dark:bg-gray-800 shadow-md transition-transform duration-300",
            props.isOpen ? "translate-x-0 w-64" : "-translate-x-full w-64",
        ];
    }
    return [
        "bg-white dark:bg-gray-800 shadow-md transition-all duration-300 flex-shrink-0 h-full",
        props.isOpen ? "w-64" : "w-14",
    ];
});

// ✔ Correct Icons Assigned
const productionNavLinks = [
    { route: 'products.index', icon: CubeIcon, label: 'sidebar.products' },
    { route: 'productions.index', icon: BuildingOffice2Icon, label: 'sidebar.productions' },
];

const nurseryNavLinks = [
    { route: 'crops.index', icon: SunIcon, label: 'sidebar.crops' },
    { route: 'nurseries.index', icon: BanknotesIcon, label: 'sidebar.nurseries' },
];

const salesNavLinks = [
    { route: 'customers.index', icon: UsersIcon, label: 'sidebar.customers' },
    { route: 'sales-agents.index', icon: UserPlusIcon, label: 'sidebar.sales_agents' },
    { route: 'sales.index', icon: CurrencyDollarIcon, label: 'sidebar.sales' },
    { route: 'sales-locations.index', icon: MapPinIcon, label: 'sidebar.sales_locations' },
];

const usersNavLinks = [
    { route: 'employees.index', icon: UserGroupIcon, label: 'sidebar.employees' },
    { route: 'users.index', icon: UserIcon, label: 'sidebar.users' },
];

const rolesNavLinks = [
    { route: 'roles.index', icon: KeyIcon, label: 'sidebar.roles' },
    { route: 'permissions.index', icon: KeyIcon, label: 'sidebar.permissions' },
    { route: 'employees.index', icon: UserGroupIcon, label: 'sidebar.employees' },
];

// If you have settingsNavLinks defined elsewhere, keep it.
// Otherwise define it here to prevent errors:
const settingsNavLinks = [
    { route: 'profile.edit', icon: Cog6ToothIcon, label: 'sidebar.profile' },
];
</script>

<template>
    <aside :class="wrapperClasses">
        <div
            class="flex flex-col h-full overflow-y-auto scrollbar-thin scrollbar-thumb-gray-500 scrollbar-track-gray-200 py-2"
        >
            <!-- Logo + Dashboard -->
            <a
                :href="route('dashboard')"
                class="flex items-center justify-center h-16 px-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
            >
                <AcademicCapIcon class="h-8 w-8 text-indigo-600 dark:text-indigo-400" />
                <span
                    v-if="props.isOpen"
                    class="ml-2 text-xl font-bold text-gray-800 dark:text-white"
                >
                    {{ $t('admin_dashboard.title') }}
                </span>
            </a>

            <div class="space-y-2 text-md">

                <!-- PRODUCTION -->
                <SidebarDropdownMenu
                    :label="$t('sidebar.productions')"
                    :icon="Cog6ToothIcon"
                    :sidebar-visible="isOpen"
                >
                    <SidebarItem
                        v-for="item in productionNavLinks"
                        :key="item.route"
                        :icon="item.icon"
                        :label="$t(item.label)"
                        :href="route(item.route)"
                        :isCollapsed="!props.isOpen"
                        icon-class="h-7 w-7 font-bold"
                    />
                </SidebarDropdownMenu>

                <!-- NURSERY -->
                <SidebarDropdownMenu
                    :label="$t('sidebar.nursery')"
                    :icon="Cog6ToothIcon"
                    :sidebar-visible="isOpen"
                >
                    <SidebarItem
                        v-for="nursery in nurseryNavLinks"
                        :key="nursery.route"
                        :icon="nursery.icon"
                        :label="$t(nursery.label)"
                        :href="route(nursery.route)"
                        :isCollapsed="!props.isOpen"
                        icon-class="h-7 w-7 font-bold"
                    />
                </SidebarDropdownMenu>

                <!-- SALES -->
                <SidebarDropdownMenu
                    :label="$t('sidebar.sales')"
                    :icon="ShoppingCartIcon"
                    :sidebar-visible="isOpen"
                >
                    <SidebarItem
                        v-for="sale in salesNavLinks"
                        :key="sale.route"
                        :icon="sale.icon"
                        :label="$t(sale.label)"
                        :href="route(sale.route)"
                        :isCollapsed="!props.isOpen"
                        icon-class="h-7 w-7 font-bold"
                    />
                </SidebarDropdownMenu>

                <!-- USERS -->
                <SidebarDropdownMenu
                    :label="$t('sidebar.users')"
                    :icon="Cog6ToothIcon"
                    :sidebar-visible="isOpen"
                >
                    <SidebarItem
                        v-for="user in usersNavLinks"
                        :key="user.route"
                        :icon="user.icon"
                        :label="$t(user.label)"
                        :href="route(user.route)"
                        :isCollapsed="!props.isOpen"
                        icon-class="h-7 w-7 font-bold"
                    />
                </SidebarDropdownMenu>

                <!-- ROLES -->
                <SidebarDropdownMenu
                    :label="$t('sidebar.roles')"
                    :icon="Cog6ToothIcon"
                    :sidebar-visible="isOpen"
                >
                    <SidebarItem
                        v-for="role in rolesNavLinks"
                        :key="role.route"
                        :icon="role.icon"
                        :label="$t(role.label)"
                        :href="route(role.route)"
                        :isCollapsed="!props.isOpen"
                        icon-class="h-7 w-7 font-bold"
                    />
                </SidebarDropdownMenu>

                <!-- SETTINGS -->
                <SidebarDropdownMenu
                    :label="$t('sidebar.settings')"
                    :icon="Cog6ToothIcon"
                    :sidebar-visible="isOpen"
                >
                    <SidebarItem
                        v-for="setting in settingsNavLinks"
                        :key="setting.route"
                        :icon="setting.icon"
                        :label="$t(setting.label)"
                        :href="route(setting.route)"
                        :isCollapsed="!props.isOpen"
                        icon-class="h-7 w-7 font-bold"
                    />
                </SidebarDropdownMenu>

            </div>
        </div>
    </aside>
</template>
