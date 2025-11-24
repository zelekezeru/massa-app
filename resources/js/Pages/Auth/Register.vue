<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
            <div class="w-full max-w-md bg-white/90 dark:bg-gray-900/90 rounded-2xl shadow-xl p-8 md:p-10 flex flex-col items-center animate-fade-in">
                <img src="/assets/img/massa-logo.svg" alt="MASSA Farm" class="w-20 h-20 rounded-full shadow mb-4 border-4 border-green-200 object-cover" />
                
                <h1 class="text-3xl font-extrabold text-green-800 dark:text-green-300 mb-2 tracking-tight text-center">Create Your MASSA Farm Account</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-6 text-center text-sm">Join the smart agriculture revolution. Manage your farm, sales, and team with ease.</p>
                <form @submit.prevent="submit" class="w-full space-y-5">
                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div>
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div>
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <Link
                            :href="route('login')"
                            class="text-green-700 hover:text-green-900 text-sm font-semibold underline focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                        >
                            Already registered?
                        </Link>
                        <PrimaryButton
                            class="ml-4 bg-gradient-to-r from-green-500 to-green-700 border-0 text-white px-6 py-2 rounded-lg shadow hover:from-green-600 hover:to-green-800 transition-all duration-200"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Register
                        </PrimaryButton>
                    </div>
                </form>
            </div>
    </GuestLayout>
</template>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.3s;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(16px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
