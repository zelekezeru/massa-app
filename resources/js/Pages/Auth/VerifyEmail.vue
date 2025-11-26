<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />
        <div class="flex min-h-[60vh] items-center justify-center">
            <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 border border-green-200 animate-fade-in">
                <div class="flex flex-col items-center">
                    <img src="/assets/img/massa-logo.svg" alt="MASSA Farm Logo" class="h-14 mb-4" />
                    <h2 class="text-2xl font-bold text-green-700 mb-2 tracking-tight">Verify Your Email</h2>
                    <p class="mb-4 text-gray-600 text-center">
                        Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed you.<br>
                        If you didn't receive the email, we will gladly send you another.
                    </p>
                    <transition name="fade">
                        <div
                            v-if="verificationLinkSent"
                            class="mb-4 w-full text-center px-4 py-2 rounded bg-green-50 border border-green-200 text-green-700 font-medium animate-pulse"
                        >
                            <i class="fa fa-check-circle mr-2 text-green-500"></i>
                            A new verification link has been sent to your email address.
                        </div>
                    </transition>
                    <form @submit.prevent="submit" class="w-full">
                        <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                            <PrimaryButton
                                :class="['w-full sm:w-auto', { 'opacity-50': form.processing }]"
                                :disabled="form.processing"
                            >
                                <i class="fa fa-paper-plane mr-2"></i>
                                Resend Verification Email
                            </PrimaryButton>
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="w-full sm:w-auto rounded-md text-sm text-gray-600 underline hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 px-4 py-2"
                            >
                                <i class="fa fa-sign-out-alt mr-2"></i>
                                Log Out
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.7s cubic-bezier(0.4,0,0.2,1);
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: none; }
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.4s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
