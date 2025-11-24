<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Bars3Icon, MoonIcon, SunIcon } from "@heroicons/vue/24/outline";
import { ArrowPathIcon } from '@heroicons/vue/24/solid';
import { router } from "@inertiajs/vue3";
import { route } from 'ziggy-js';


// Logout
const logout = () => {
    router.post(route("logout"));
};

// Role switcher function
const changeRole = (roleName) => {
    router.visit(route("switch-role"), {
        method: "post",
        data: { role: roleName },
    });
};
</script>

<template>
    <Head>
        
    </Head>
    <div :class="{ dark: darkMode }">
        <div
            class="flex h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 relative"
        >
            <Sidebar
                :active-role="loggedInAs?.name"
                :is-open="isSidebarOpen"
                :is-mobile="isMobile"
                :class="sidebarTransition"
            />

            <transition name="fade">
                <div
                    v-if="isMobile && isSidebarOpen"
                    class="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-200"
                    @click="toggleSidebar"
                    aria-label="Close sidebar overlay"
                    tabindex="0"
                />
            </transition>

            <div class="flex-1 flex flex-col overflow-x-hidden">
                <header
                    class="sticky top-0 flex items-center justify-between bg-white dark:bg-gray-800 px-4 py-3 shadow z-30 transition-shadow duration-200"
                    :class="{'shadow-lg': isSidebarOpen}"
                >
                    <!-- Sidebar toggle -->
                    <button
                        @click="toggleSidebar"
                        class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md"
                        aria-label="Toggle sidebar"
                        tabindex="0"
                    >
                        <Bars3Icon class="h-6 w-6" />
                    </button>

                    <!-- Right side controls -->
                    <div class="flex items-center gap-4">
                        <!-- User Dropdown with logout and roles below -->
                        <div class="relative" ref="dropdownRef">
                            <button
                                ref="dropdownButtonRef"
                                @click="toggleDropdown"
                                @keydown.esc="closeDropdown"
                                class="flex items-center gap-2 px-2 py-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500"
                                aria-haspopup="true"
                                :aria-expanded="dropdownVisible.toString()"
                                aria-controls="user-menu"
                                tabindex="0"
                            >
                                <span
                                    class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center overflow-hidden"
                                >
                                    <template v-if="user?.profileImg">
                                        <img
                                            :src="user.profileImg"
                                            alt="Profile"
                                            class="h-8 w-8 object-cover rounded-full"
                                        />
                                    </template>
                                    <template v-else>
                                        <!-- Default profile icon -->
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 text-gray-500 dark:text-gray-300"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.225.805 5.879 2.137M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>
                                    </template>
                                </span>

                                <span
                                    class="hidden md:block text-sm font-medium text-gray-800 dark:text-gray-200"
                                >
                                    {{ user?.name || "Guest" }}
                                </span>

                                <svg
                                    :class="[
                                        'h-4 w-4 transition-transform text-gray-500 dark:text-gray-300',
                                        { 'rotate-180': dropdownVisible },
                                    ]"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"
                                    />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <transition name="fade">
                                <ul
                                    v-show="dropdownVisible"
                                    id="user-menu"
                                    class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl rounded-md z-50 overflow-hidden animate-fade-in"
                                    role="menu"
                                    aria-label="User menu"
                                    @keydown.esc="closeDropdown"
                                    @keydown.tab="handleDropdownKeydown"
                                    tabindex="0"
                                >
                                    <!-- Profile Info -->
                                    <li
                                        class="px-4 py-3 flex items-center space-x-3"
                                    >
                                        <div
                                            class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center overflow-hidden"
                                        >
                                            <template v-if="user?.profileImg">
                                                <img
                                                    :src="user.profileImg"
                                                    alt="Profile Large"
                                                    class="h-10 w-10 object-cover rounded-full"
                                                />
                                            </template>
                                            <template v-else>
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-6 w-6 text-gray-500 dark:text-gray-300"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.225.805 5.879 2.137M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />
                                                </svg>
                                            </template>
                                        </div>
                                        <div>
                                            <p
                                                class="font-semibold text-gray-900 dark:text-gray-100"
                                            >
                                                {{ user?.name }}
                                            </p>
                                            <p
                                                class="text-xs text-gray-500 dark:text-gray-400"
                                            >
                                                {{ user?.email }}
                                            </p>
                                        </div>
                                    </li>

                                    <li>
                                        <hr
                                            class="border-gray-200 dark:border-gray-700"
                                        />
                                    </li>

                                    <!-- Profile Links -->
                                    <li>
                                        <Link
                                            :href="route('profile.edit')"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 focus:bg-gray-200 dark:focus:bg-gray-600"
                                            role="menuitem"
                                            tabindex="0"
                                        >
                                            My Profile
                                        </Link>
                                    </li>
                                    <li>
                                        <Link
                                            href="#"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 focus:bg-gray-200 dark:focus:bg-gray-600"
                                            @click.prevent="logout"
                                            role="menuitem"
                                            tabindex="0"
                                        >
                                            Logout
                                        </Link>
                                    </li>

                                    <li>
                                        <hr
                                            class="border-gray-200 dark:border-gray-700"
                                        />
                                    </li>

                                    <!-- Switch Role Section below logout -->
                                    <li
                                        class="px-4 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100"
                                        v-if="userRoles.length > 1"
                                    >
                                        Switch Role
                                    </li>
                                    <li v-if="userRoles.length > 1">
                                        <div
                                            class="flex flex-col space-y-1 px-4 py-2 max-h-40 overflow-auto"
                                            style="scrollbar-width: thin"
                                        >
                                            <button
                                                v-for="role in userRoles"
                                                :key="role"
                                                @click="changeRole(role)"
                                                :class="[
                                                    'text-left px-2 py-1 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:bg-gray-200 dark:focus:bg-gray-600',
                                                    role === loggedInAs?.name
                                                        ? 'font-bold bg-gray-300 dark:bg-gray-600'
                                                        : '',
                                                ]"
                                                role="menuitem"
                                                tabindex="0"
                                            >
                                                {{ role }}
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </transition>
                        </div>

                        <!-- Language toggle -->
                        <LanguageToggle :collapsed="isMobile" />

                        <!-- Dark mode toggle -->
                        <button
                            @click="toggleDarkMode"
                            class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md"
                            aria-label="Toggle dark mode"
                            tabindex="0"
                        >
                            <component
                                :is="darkMode ? SunIcon : MoonIcon"
                                class="h-6 w-6"
                            />
                        </button>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto p-4">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.2s;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
.animate-fade-in {
  animation: fadeIn 0.2s;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-8px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
