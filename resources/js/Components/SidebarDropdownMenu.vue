<script setup>
import {
    ChevronDownIcon,
    ChevronUpIcon,
} from "@heroicons/vue/24/outline";
import { ref } from "vue";

const props = defineProps({
    label: { type: String, required: true },
    icon: { type: Function, required: true },
    sidebarVisible: { type: Boolean, required: true },
});

const isOpen = ref(false);

// Smooth height animation hooks
const beforeEnter = (el) => {
    el.style.height = "0";
    el.style.opacity = "0";
};
const enter = (el) => {
    el.style.transition = "all 0.2s ease";
    el.style.height = el.scrollHeight + "px";
    el.style.opacity = "1";
};
const afterEnter = (el) => {
    el.style.height = "auto";
};
const beforeLeave = (el) => {
    el.style.height = el.scrollHeight + "px";
    el.style.opacity = "1";
};
const leave = (el) => {
    el.style.transition = "all 0.2s ease";
    void el.offsetHeight;
    el.style.height = "0";
    el.style.opacity = "0";
};
const afterLeave = (el) => {
    el.style.height = "";
};
</script>

<template>
    <div>

        <!-- BUTTON -->
        <button
            @click="isOpen = !isOpen"
            :class="{
                'bg-green-200 dark:bg-green-800 border-l-4 border-green-600 shadow-sm':
                    isOpen,
            }"
            class="transition shadow dark:bg-gray-800 rounded-xl hover:shadow-lg
                w-full flex items-center justify-between px-4 py-3 focus:outline-none"
        >
            <!-- ICON + LABEL -->
            <div class="flex items-center">
                <component
                    :is="icon"
                    class="w-6 h-6 text-green-700 dark:text-green-400"
                />
                <transition name="fade">
                    <span
                        v-if="sidebarVisible"
                        class="ml-3 text-gray-900 dark:text-gray-100 font-semibold"
                    >
                        {{ label }}
                    </span>
                </transition>
            </div>

            <!-- CHEVRON -->
            <component
                v-if="sidebarVisible"
                :is="isOpen ? ChevronUpIcon : ChevronDownIcon"
                class="w-5 h-5 text-gray-600 dark:text-gray-300 transition-transform"
            />
        </button>

        <!-- DROPDOWN CONTENT -->
        <transition
            @before-enter="beforeEnter"
            @enter="enter"
            @after-enter="afterEnter"
            @before-leave="beforeLeave"
            @leave="leave"
            @after-leave="afterLeave"
        >
            <div
                  v-if="isOpen && sidebarVisible"
                  class="ml-10 mr-3 mt-2 p-3 rounded-xl 
                      bg-gray-50 dark:bg-gray-800/70 
                      text-sm text-gray-700 dark:text-gray-200 shadow-inner space-y-2 border border-gray-200 dark:border-gray-700"
            >
                <slot />
            </div>
        </transition>
    </div>
</template>
